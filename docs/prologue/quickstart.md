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
```shell
php artisan neat:generate
```

配置路由
```php

```

