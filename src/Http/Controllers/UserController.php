<?php

namespace Wantp\Neat\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Wantp\Neat\Http\Filters\UserFilter;
use Wantp\Neat\Http\Requests\UserStoreRequest;
use Wantp\Neat\Http\Requests\UserUpdateRequest;
use Wantp\Neat\Http\Resources\UserResource;
use Wantp\Neat\Http\Traits\HasDataExport;
use Wantp\Neat\Models\User;

class UserController extends Controller
{
    /**
     * @var string
     */
    protected $modelClass = User::class;

    /**
     * @var string
     */
    protected $resourceClass = UserResource::class;

    /**
     * @var string
     */
    protected $filterClass = UserFilter::class;


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
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(UserStoreRequest $request)
    {
        $inputs = $request->all();
        $inputs['password'] = Hash::make($inputs['password']);
        unset($inputs['password_confirmation']);

        return parent::__store($inputs);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, UserUpdateRequest $request)
    {
        $inputs = $request->all();
        if (!empty($request->input('password'))) {
            $inputs['password'] = Hash::make($inputs['password']);
        }
        unset($inputs['password_confirmation']);
        return parent::__update($user, $inputs);
    }

    /**
     * @param User $user
     * @return string[]
     */
    public function destroy(User $user)
    {
        return parent::__destroy($user);
    }
}
