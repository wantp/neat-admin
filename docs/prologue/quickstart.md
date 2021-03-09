# 快速开始

## 请求接口
为所有请求添加请求头`Accept`，系统根据`Accept`会返回不同格式的内容，尤其是接口异常信息。默认情况下接口异常会返回异常页。  
通过添加`Accept`来获取`json`响应
```http request
Accept: application/json
```

为需要授权认证的请求添加请求头`Authorization`，系统根据`Authorization`的内容来进行身份认证。
通过添加`Authorization`来认证身份
```http request
Authorization: Bearer your_access_token
```
其中 `your_access_token` 为 *颁发令牌* 接口返回的 `access_token`

## 授权认证
`neat-admin` 使用 [sanctum](https://github.com/laravel/sanctum) 实现身份认证
安装成功后，会生成初始超级管理员账号

| 账号 | 密码 |
| --- | --- |
| admin | admin123456 |

## RBAC
`neat-admin` 内置了开箱即用的RBAC的权限管理  
详情参考[RBAC 权限管理](../guide/rbac.md)

## 菜单管理
`neat-admin` 菜单支持子菜单、拖拽排序、权限控制
菜单权限控制是基于角色的，可以为菜单绑定一个或多个角色，系统根据用户角色返回拥有权限的菜单列表，不同用户看到不同的菜单
详情参考[菜单管理](../guide/menu.md)

## CURD
简单两步即可快速构建`RESTFUL`风格的`CURD`接口

#### 使用 `Artisan` 命令行构建`CURD`接口 
以`users`表的`CURD`为例
```shell
php artisan neat:generate UserController
```
`neat:generate` 根据控制器名称分别生成(已存在则跳过)对应的`Model`、`Filter`、`Resource`和`Controller`  
`UserController`生成的分别是:
- Model *app/Models/User.php* 
- Filter *app/Modules/Admin/Http/Filers/UserFilter*
- Resource *app/Modules/Admin/Http/Filers/UserResource*
- Controller *app/Modules/Admin/Http/Controller/UserController*

#### 配置路由
添加路由到`neat-admin`安装目录下的 *route.php*  
以添加`UserController` resource 路由为例
```php
<?php

use Illuminate\Support\Facades\Route;
use Wantp\Neat\Facades\Neat;


Route::group(['prefix' => Neat::routePrefix(), 'middleware' => ['api'],], function () {
    //
    Route::group(['middleware' => ['auth:sanctum', 'permission']], function () {
    
        // 在这里添加UserController路由
        Route::resource('users',\App\Modules\Admin\Http\Controllers\UserController::class);
    });
});
```

#### 接口请求
接口已就绪，使用客户端请求接口查看效果

| Method | URI | Action |
| --- | --- | --- |
| GET | api/admin/users | App\Modules\Admin\Http\Controllers\UserController@index |
| GET | api/admin/users/{user} | App\Modules\Admin\Http\Controllers\UserController@show |
| POST | api/admin/users | App\Modules\Admin\Http\Controllers\UserController@store |
| PUT | api/admin/users/{user} | App\Modules\Admin\Http\Controllers\UserController@update |
| DELETE | api/admin/users/{user} | App\Modules\Admin\Http\Controllers\UserController@destroy |

