# 更新资源

`\Wantp\Neat\Http\Controllers\Controller` 的 `__update` 方法对更新资源进行了封装。  
**使用方法：**

1. （推荐）使用命令行快速构建CURD控制器，阅读[命令行](../guide/command.md)了解更多命令行使用方法
2. 如果是自定义控制器，继承`\Wantp\Neat\Http\Controllers\Controller`，设置$modelClass，调用 `__update`方法

```php
use Illuminate\Http\Request;

class UserController extends \Wantp\Neat\Http\Controllers\Controller
{
    public function update(User $user, Request $request)
    {
        return $this->__update($user, $request->all());
    }
}
```

## 更新资源

控制器完成后，要更新资源还需要配置路由 配置update路由

```php
Route::PUT('users',[\App\Modules\Admin\Http\Controllers\UserController::class,'update']);
```

然后可以通过客户端请求接口更新资源了
`PUT` /api/admin/users

## 模型关联

阅读 [保存关联](saveRelation.md) 了解保存模型关联的使用方法
