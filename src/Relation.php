<?php

namespace Wantp\Neat;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
}