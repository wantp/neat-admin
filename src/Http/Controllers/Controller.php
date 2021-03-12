<?php

namespace Wantp\Neat\Http\Controllers;

use Illuminate\Database\Eloquent\Builder as Query;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Wantp\Neat\Contracts\Relation;
use Wantp\Neat\Filter;
use function request;

class Controller extends BaseController
{
    /**
     * @var string Model class
     */
    protected $modelClass;

    /**
     * @var string Resource class
     */
    protected $resourceClass;

    /**
     * @var string Filter class
     */
    protected $filterClass;

    /**
     * @var Model
     */
    protected $model;

    /**
     * @var
     */
    protected $inputs;

    /**
     * @var
     */
    protected $relation;


    /**
     * Resource List
     *
     * @return mixed
     */
    public function __index()
    {
        $query = app()->make($this->modelClass);
        $this->inputs = filterNullInput(request()->all());
        $this->includes($query);
        $this->filter($query);
        $this->sorter($query);

        $data = $this->pagesize() == -1 ? $query->get() : $query->paginate($this->pagesize());

        return $this->responseResource($data, true);
    }

    /**
     * Resource detail
     *
     * @param $id
     * @return mixed
     */
    public function __show($id)
    {
        $query = app()->make($this->modelClass);
        $this->includes($query);

        return $this->responseResource($query->find($id));
    }

    /**
     * Save new resource
     *
     * @return JsonResponse
     */
    public function __store($inputs)
    {
        $this->model = app()->make($this->modelClass);
        $this->inputs = filterNullInput($inputs);
        $this->save();

        return $this->responseResource($this->model);
    }

    /**
     * Update resource
     *
     * @param $model
     * @return \Illuminate\Http\Response
     */
    public function __update(Model $model, $inputs)
    {
        $this->model = $model;
        $this->inputs = filterNullInput($inputs);
        $this->save();

        return $this->responseResource($this->model);
    }

    /**
     * @param $model
     * @return string[]
     */
    public function __destroy(Model $model)
    {
        $this->model = $model;
        $this->model->delete();

        return $this->successMessage();
    }

    /**
     * @param Query|Model $query
     * Handle includes
     */
    private function includes(&$query)
    {
        if ($includes = request()->get(config('neat_default.param_name.include'))) {
            $includes = explode(',', $includes);
            foreach ($includes as $include) {
                $query = $query->with($include);
            }
        }
    }

    /**
     * @param Query|Model $query
     * Handle filter
     */
    private function filter($query)
    {
        if (!class_exists($this->filterClass)) {
            return;
        }
        /**
         * @var Filter $filter
         */
        $filter = app()->make($this->filterClass);
        $filter->__filter($query, $this->inputs);
    }

    /**
     * @param Query|Model $query
     * Handle sorter
     */
    private function sorter($query)
    {
        if ($sorter = request()->input(config('neat_default.param_name.sorter'))) {
            $sorter = is_array($sorter) ? $sorter : json_decode($sorter, true);
            foreach ($sorter as $field => $order) {
                $order = str_replace(['ascend', 'descend'], ['asc', 'desc'], strtolower($order));
                $query->orderBy($field, $order);
            }
        }
    }

    /**
     * Save
     */
    protected function save()
    {
        $this->saveModel();
        $this->relation()->save();
    }

    /**
     * @param $resourceData
     * @param false $isCollection
     * @return mixed
     */
    protected function responseResource($resourceData, $isCollection = false)
    {
        if (!class_exists($this->resourceClass)) {
            return $resourceData;
        }

        if ($isCollection) {
            return call_user_func_array([$this->resourceClass, 'collection'], [$resourceData]);
        }

        return app($this->resourceClass, ['resource' => $resourceData]);
    }

    /**
     * Get per page
     *
     * @return int
     */
    protected function pagesize()
    {
        return (int)request(config('neat_default.param_name.pageSize'), config('neat_default.default_pagesize'));
    }

    /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function saveModel()
    {
        $attributies = $this->getSaveAttribute();

        foreach ($attributies as $field => $attribute) {
            $this->model->{$field} = $attribute;
        }

        $this->model->save();
    }

    /**
     * @return array
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function getRelationInputs()
    {
        return $this->relation()->getInputs();
    }

    /**
     * @return array
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function getSaveAttribute()
    {
        $relationInputs = $this->getRelationInputs();

        return array_filter($this->inputs, function ($key) use ($relationInputs) {
            return !array_key_exists($key, $relationInputs);
        }, ARRAY_FILTER_USE_KEY);
    }

    /**
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    private function relation()
    {
        if (!$this->relation instanceof Relation) {
            $this->relation = app()->make(Relation::class, ['model' => $this->model, 'inputs' => $this->inputs]);
        }

        return $this->relation;
    }

    /**
     * @return string[]
     */
    protected function successMessage()
    {
        return ['message' => __('neat.success')];
    }
}