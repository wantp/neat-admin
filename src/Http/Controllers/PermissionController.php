<?php

namespace Wantp\Neat\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Wantp\Neat\Http\Filters\PermissionFilter;
use Wantp\Neat\Http\Requests\PermissionStoreRequest;
use Wantp\Neat\Http\Requests\PermissionUpdateRequest;
use Wantp\Neat\Http\Resources\PermissionResource;
use Wantp\Neat\Models\Permission;
use Wantp\Neat\ArrayTree;

class PermissionController extends Controller
{
    /**
     * @var string
     */
    protected $modelClass = Permission::class;

    /**
     * @var string
     */
    protected $resourceClass = PermissionResource::class;

    /**
     * @var string
     */
    protected $filterClass = PermissionFilter::class;

    /**
     * @return mixed
     */
    public function index()
    {
        return parent::__index();
    }

    /**
     * @return mixed
     */
    public function tree(ArrayTree $arrayTree)
    {
        $permissions = Permission::orderBy('order')->get();
        return $arrayTree->build(PermissionResource::collection($permissions)->resolve());
    }

    /**
     * @param Request $request
     * @param ArrayTree $arrayTree
     * @return string[]
     * @throws \Exception
     */
    public function updateOrder(Request $request, ArrayTree $arrayTree)
    {
        DB::beginTransaction();
        $newTree = $request->get('tree');
        $newTree = is_string($newTree) ? json_decode($newTree, true) : $newTree;
        try {
            $arrayTree->setModelClass($this->modelClass)->updateOrder($this->tree($arrayTree), $newTree);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }

        return $this->successMessage();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function show($id)
    {
        return parent::__show($id);
    }

    /**
     * @param PermissionStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PermissionStoreRequest $request)
    {
        return parent::__store($request->all());
    }

    /**
     * @param Permission $permission
     * @param PermissionUpdateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(Permission $permission, PermissionUpdateRequest $request)
    {
        return parent::__update($permission, $request->all());
    }

    /**
     * @param Permission $permission
     * @return string[]
     */
    public function destroy(Permission $permission)
    {
        return parent::__destroy($permission);
    }
}