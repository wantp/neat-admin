# 资源详情

`\Wantp\Neat\Http\Controllers\Controller` 的 `__show` 方法对获取资源进行了封装。  
**使用方法：**

1. （推荐）使用命令行快速构建CURD控制器，阅读[命令行](../guide/command.md)了解更多命令行使用方法
2. 如果是自定义控制器，继承`\Wantp\Neat\Http\Controllers\Controller`，设置$modelClass，调用 `__show`方法

```php
class UserController extends \Wantp\Neat\Http\Controllers\Controller
{
    /**
     * @var string
     */
    protected $modelClass = \App\Models\User::class;

    /**
     * @return mixed
     */
    public function show($id)
    {
        return $this->__show($id);
    }
}
```

## 获取资源

控制器完成后，要获取资源还需要配置路由 配置show路由

```php
Route::get('users/{user}',[\App\Modules\Admin\Http\Controllers\UserController::class,'show']);
```

然后可以通过客户端请求接口获取资源了
`GET` /api/admin/users/1


## 关联关系

使用`include`机制可以很灵活地获取资源的关联，阅读 [关联关系](getResources.md?id=关联关系) 了解如何通过 `include` 获取关联资源