<?php

namespace Wantp\Neat;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Support\Traits\Macroable;

class Relation
{
    use Macroable;

    /**
     * @var Model
     */
    protected $model;

    /**
     * @var array
     */
    protected $inputs = [];

    /**
     * Relation constructor.
     * @param $model
     * @param $inputs
     */
    public function __construct(Model $model, $inputs = [])
    {
        $this->model = $model;
        $this->setInputs($inputs);
    }

    /**
     * @param $inputs
     */
    public function setInputs($inputs)
    {
        foreach ($inputs as $key => $value) {
            if (!is_null($value) && method_exists($this->model, $key)) {
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
            $relationName = Str::afterLast(get_class($relation), '\\');
            $saveRelationMehodName = 'save' . $relationName;

            call_user_func_array([$this, $saveRelationMehodName], [$relation, $value]);
        }
    }

    /**
     * Save HasOne Relation
     *
     * @param HasOne $relation
     * @param $attributes
     */
    protected function saveHasOne(HasOne $relation, $attributes)
    {
        $attributes = $this->attributes2Collection($attributes);

        if ($attributes->isEmpty()) {
            $relation->delete();
            return;
        }

        $model = $relation->first() ?? $relation->newModelInstance();
        foreach ($attributes as $field => $attribute) {
            $model->{$field} = $attribute;
        }

        $relation->save($model);
    }

    /**
     * Save HasMany Relation
     *
     * @param HasMany $relation
     * @param $values
     */
    protected function saveHasMany(HasMany $relation, $attributes)
    {
        $attributes = $this->attributes2Collection($attributes);

        $localKey = $relation->getLocalKeyName();

        $addAttributes = new Collection();
        $updateAttributes = new Collection();
        foreach ($attributes as $attribute) {
            if (empty($attribute[$localKey])) {
                $addAttributes->add($attribute);
            } else {
                $updateAttributes->put($attribute[$localKey], $attribute);
            }
        }

        $models = $relation->makeMany($addAttributes);
        $relationModels = collect($relation->getModels())->keyBy($localKey);
        foreach ($relationModels as $key => $model) {
            if (!$updateAttributes->has($key)) {
                $model->delete();
                continue;
            }
            $model->fill($updateAttributes[$model->{$localKey}]);
            $models->add($model);
        }

        $relation->saveMany($models);
    }


    /**
     * Save BelongsToMany Relation
     *
     * @param BelongsToMany $relation
     * @param $value
     */
    protected function saveBelongsToMany(BelongsToMany $relation, $attributes)
    {
        $attributes = $this->attributes2Collection($attributes);
        $relation->sync($attributes->pluck($relation->getRelatedKeyName()));
    }

    /**
     * @param $attributes
     * @return Collection
     */
    protected function attributes2Collection($attributes)
    {
        if (is_string($attributes)) {
            $attributes = json_decode($attributes, true);
        }

        return collect($attributes);
    }
}