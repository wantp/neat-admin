<?php

namespace Wantp\Neat\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Wantp\Neat\Http\Requests\MenuStoreRequest;
use Wantp\Neat\Http\Requests\MenuUpdateRequest;
use Wantp\Neat\Http\Resources\MenuResource;
use Wantp\Neat\Models\Menu;
use Wantp\Neat\ArrayTree;
use Wantp\Neat\Http\Filters\MenuFilter;


class MenuController extends Controller
{
    /**
     * @var string
     */
    protected $modelClass = Menu::class;

    /**
     * @var string
     */
    protected $resourceClass = MenuResource::class;

    /**
     * @var string
     */
    protected $filterClass = MenuFilter::class;

    /**
     * @return mixed
     */
    public function index()
    {
        return parent::__index();
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function tree(ArrayTree $arrayTree)
    {
        $menus = Menu::orderBy('order')->get();
        return $arrayTree->build(MenuResource::collection($menus)->resolve());
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
     * @param MenuStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(MenuStoreRequest $request)
    {
        return parent::__store($request->all());
    }

    /**
     * @param Menu $menu
     * @param MenuUpdateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(Menu $menu, MenuUpdateRequest $request)
    {
        return parent::__update($menu, $request->all());
    }

    /**
     * @param Menu $menu
     * @return string[]
     */
    public function destroy(Menu $menu)
    {
        return parent::__destroy($menu);
    }
}
