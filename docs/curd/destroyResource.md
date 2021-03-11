# 删除资源

`\Wantp\Neat\Http\Controllers\Controller` 的 `__destroy` 方法对删除资源进行了封装。  
**使用方法：**

1. （推荐）使用命令行快速构建CURD控制器，阅读[命令行](../guide/command.md)了解更多命令行使用方法
2. 如果是自定义控制器，继承`\Wantp\Neat\Http\Controllers\Controller`，设置$modelClass，调用 `__destroy`方法

```php
class UserController extends \Wantp\Neat\Http\Controllers\Controller
{
    public function destroy(\App\Models\User $user)
    {
        return $this->__destroy($user);
    }
}
```

## 删除资源

控制器完成后，要获取资源还需要配置路由 配置destroy路由

```php
Route::DELETE('users/{user}',[\App\Modules\Admin\Http\Controllers\UserController::class,'destroy']);
```

然后可以通过客户端请求接口删除资源了
`DELETE` /api/admin/users/1
