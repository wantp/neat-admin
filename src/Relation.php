<?php

namespace Wantp\Neat;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Collection;

class Relation
{
    protected $model;

    protected $inputs = [];

    /**
     * Relation constructor.
     * @param $model
     * @param $inputs
     */
    public function __construct($model, $inputs)
    {
        $this->model = $model;
        $this->setInputs($inputs);
    }

    /**
     * @param $inputs
     */
    protected function setInputs($inputs)
    {
        foreach ($inputs as $key => $value) {
            if (method_exists($this->model, $key)) {
                $this->inputs[$key] = $value;
            }
        }
    }

    /**
     * @return mixed
     */
    public function getInputs()
    {
        return $this->inputs;
    }

    /**
     * Save relations
     */
    public function save()
    {
        foreach ($this->inputs as $key => $value) {
            $relation = call_user_func([$this->model, $key]);
            if ($relation instanceof BelongsToMany) {
                $this->saveBelongsToMany($relation, $value);
            } elseif ($relation instanceof HasOne) {
                $this->saveHasOne($relation, $value);
            } elseif ($relation instanceof HasMany) {
                $this->saveHasMany($relation, $value);
            }
        }
    }

    /**
     * @param BelongsToMany $relation
     * @param $value
     */
    protected function saveBelongsToMany(BelongsToMany $relation, $value)
    {
        if (is_string($value)) {
            $value = json_decode($value, true);
        }
        $relation->sync(array_column($value, $relation->getRelatedKeyName()));
    }

    /**
     * @param HasOne $relation
     * @param $value
     */
    protected function saveHasOne(HasOne $relation, $value)
    {
        if (is_string($value)) {
            $value = json_decode($value, true);
        }

        if (empty($value)) {
            return $relation->delete();
        }

        $relationModle = $relation->first() ?? $relation->getModel();
        foreach ($value as $field => $item) {
            $relationModle->{$field} = $item;
        }

        return $relation->save($relationModle);
    }

    /**
     * @param HasMany $relation
     * @param $values
     */
    protected function saveHasMany(HasMany $relation, $values)
    {
        if (is_string($values)) {
            $values = collect(json_decode($values, true));
        }

        $localKey = $relation->getLocalKeyName();

        $existsRelationValues = [];
        $newRelationValues = [];
        $values->map(function ($value) use (&$existsRelationValues, &$newRelationValues, $localKey) {
            if (!empty($value[$localKey])) {
                $existsRelationValues[$value[$localKey]] = $value;
            } else {
                $newRelationValues[] = $value;
            }
        });

        $models = new Collection();
        $relationModels = collect($relation->getModels())->keyBy($localKey);
        $relationModels->map(function (Model $model) use ($models, $localKey, $existsRelationValues) {
            if (isset($existsRelationValues[$model->{$localKey}])) {
                $model->fill($existsRelationValues[$model->{$localKey}]);
                $models->add($model);
            } else {
                $model->delete();
            }
        });
        $models = $models->concat($relation->makeMany($newRelationValues));

        return $relation->saveMany($models);
    }
}