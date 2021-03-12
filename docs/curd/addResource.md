# 添加资源

`\Wantp\Neat\Http\Controllers\Controller` 的 `__store` 方法对添加资源进行了封装。  
**使用方法：**

1. （推荐）使用命令行快速构建CURD控制器，阅读[命令行](../guide/command.md)了解更多命令行使用方法
2. 如果是自定义控制器，继承`\Wantp\Neat\Http\Controllers\Controller`，设置$modelClass，调用 `__store`方法

```php
use Illuminate\Http\Request;

class UserController extends \Wantp\Neat\Http\Controllers\Controller
{
    public function store(Request $request)
    {
        return parent::__store($request->all());
    }
}
```

## 添加资源

控制器完成后，要添加资源还需要配置路由 配置store路由

```php
Route::POST('users',[\App\Modules\Admin\Http\Controllers\UserController::class,'store']);
```

然后可以通过客户端请求接口添加资源了
`POST` /api/admin/users

## 模型关联

阅读 [保存关联](saveRelation.md) 了解保存模型关联的使用方法
