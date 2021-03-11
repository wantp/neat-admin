# 拖拽排序

对于树形结构的数据拖拽排序是更友好的排序方式，`\Wantp\Neat\ArrayTree` 的 `updateOrder` 方法实现了拖拽排序

## 使用说明

```php
class ArrayTree
{
    ...

    public function updateOrder($originalTree, $newTree, $parentId = 0)
    {
        ...
    }
}
```

`updateOrder` 用来更新树形结构数据的排序，方法结束三个参数

- $originalTree 原始树
- $newTree 新树
- $parentId 顶级父级ID

`updateOrder` 遍历比较`$originalTree`、`$newTree`两颗树的各个节点，更新排序发生变化的节点，并持久化到数据库

**注意：数据量级和嵌套深度都影响处理速度，数据太大或嵌套很深时不应该使用`updateOrder`**

`\Wantp\Neat\ArrayTree` 的 `build` 方法可以将列表数据转化成树形结构

一般可以这么使用
```php
<?php

class TestController extends Controller{

    public function sort(Request $request, ArrayTree $arrayTree)
    {
        DB::beginTransaction();
        
        $newTree = $request->get('tree');
        $newTree = is_string($newTree) ? json_decode($newTree, true) : $newTree;
        $originalTree = $arrayTree->build(\App\Models\Menu::all());
        try {
            $arrayTree->setModelClass(\App\Models\Menu::class)->updateOrder($originalTree, $newTree);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }

    }
}


```


一个原始树的结构应该是这样的

```json
[
    {
        "id": 1,
        "order": 1,
        "children": [
            {
                "id": 2,
                "order": 2
            },
            {
                "id": 3,
                "order": 3
            }
        ]
    },
    {
        "id": 4,
        "order": 4
    }
]
```

一个新树的结构应该是这样的

```json
[
    {
        "id": 4
    },
    {
        "id": 1,
        "children": [
            {
                "id": 3
            },
            {
                "id": 2
            }
        ]
    }
]
```