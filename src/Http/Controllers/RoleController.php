<?php

namespace Wantp\Neat\Http\Controllers;

use Wantp\Neat\Http\Filters\RoleFilter;
use Wantp\Neat\Http\Requests\RoleStoreRequest;
use Wantp\Neat\Http\Requests\RoleUpdateRequest;
use Wantp\Neat\Http\Resources\RoleResource;
use Wantp\Neat\Models\Role;

class RoleController extends Controller
{
    /**
     * @var string
     */
    protected $modelClass = Role::class;

    /**
     * @var string
     */
    protected $resourceClass = RoleResource::class;

    /**
     * @var string
     */
    protected $filterClass = RoleFilter::class;

    /**
     * @return mixed
     */
    public function index()
    {
        return parent::__index();
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
     * @param RoleStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RoleStoreRequest $request)
    {
        return parent::__store($request->all());
    }

    /**
     * @param Role $role
     * @param RoleUpdateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(Role $role, RoleUpdateRequest $request)
    {
        return parent::__update($role, $request->all());
    }

    /**
     * @param Role $role
     * @return string[]
     */
    public function destroy(Role $role)
    {
        return parent::__destroy($role);
    }
}