<?php

namespace Wantp\Neat;

use Illuminate\Support\Arr;

class ArrayTree
{
    /**
     * @var string
     */
    protected $parentKey;

    /**
     * @var string
     */
    protected $primaryKey;

    /**
     * @var string
     */
    protected $childrenKey;

    /**
     * @var string
     */
    protected $orderKey;

    /**
     * @var
     */
    protected $modelClass;

    /**
     * @var int
     */
    protected $order = 0;

    /**
     * ArrayTree constructor.
     * @param string $primaryKey
     * @param string $parentKey
     * @param string $childrenKey
     * @param string $orderKey
     */
    public function __construct(
        string $primaryKey = 'id',
        string $parentKey = 'parent_id',
        string $childrenKey = 'children',
        string $orderKey = 'order',
        string $modelClass = ''
    ) {
        $this->primaryKey = $primaryKey;
        $this->parentKey = $parentKey;
        $this->childrenKey = $childrenKey;
        $this->orderKey = $orderKey;
        $this->modelClass = $modelClass;
    }

    /**
     * @param $data
     * @param int $parentId
     * @return array
     */
    public function build($data, $parentId = 0)
    {
        $data = array_column($data, null, $this->primaryKey);
        $tree = [];
        foreach ($data as $key => $item) {
            if ($item[$this->parentKey] == $parentId) {
                $tree[$item[$this->primaryKey]] = &$data[$key];
            } else {
                $data[$item[$this->parentKey]][$this->childrenKey][] = &$data[$key];
            }
        }
        return array_values($tree);
    }

    /**
     * @param $originalTree
     * @param $newTree
     * @param int $parentId
     */
    public function updateOrder($originalTree, $newTree, $parentId = 0)
    {
        foreach ($newTree as $index => $newTreeNode) {
            $this->order++;
            $originalTreeNode = Arr::get($originalTree, $index);
            if ($newTreeNode[$this->primaryKey] != Arr::get($originalTreeNode, $this->primaryKey)
                || $this->order != Arr::get($originalTreeNode, $this->orderKey)) {
                $model = app()->make($this->modelClass);
                $model->where($this->primaryKey, $newTreeNode[$this->primaryKey])
                    ->update([$this->parentKey => $parentId, $this->orderKey => $this->order]);
            }
            if (isset($newTreeNode[$this->childrenKey])) {
                $this->updateOrder(Arr::get($originalTreeNode, $this->childrenKey), $newTreeNode[$this->childrenKey],
                    $newTreeNode[$this->primaryKey]);
            }
        }
    }

    /**
     * @param $allTree
     * @param $hasNodes
     * @return mixed
     */
    public function prune($allTree, $hasNodes)
    {
        foreach ($allTree as $key => &$node) {
            if (!empty($node[$this->childrenKey])) {
                $node[$this->childrenKey] = $this->prune($node[$this->childrenKey], $hasNodes);
            }

            if (!(isset($hasNodes[$node[$this->primaryKey]]) || !empty($node[$this->childrenKey]))) {
                unset($allTree[$key]);
            }
        }

        return $allTree;
    }

    /**
     * @param string $primaryKey
     * @return $this
     */
    public function setPrimaryKey(string $primaryKey)
    {
        $this->primaryKey = $primaryKey;

        return $this;
    }

    /**
     * @param string $parentKey
     * @return $this
     */
    public function setParentKey(string $parentKey)
    {
        $this->parentKey = $parentKey;

        return $this;
    }

    /**
     * @param string $childrenKey
     * @return $this
     */
    public function setChildrenKey(string $childrenKey)
    {
        $this->childrenKey = $childrenKey;

        return $this;
    }

    /**
     * @param string $orderKey
     * @return $this
     */
    public function setOrderKey(string $orderKey)
    {
        $this->orderKey = $orderKey;

        return $this;
    }

    /**
     * @param $model
     * @return $this
     */
    public function setModelClass($modelClass)
    {
        $this->modelClass = $modelClass;

        return $this;
    }
}