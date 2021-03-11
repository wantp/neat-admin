# 身份认证

`neat-admin` 使用 [sanctum](https://github.com/laravel/sanctum) 实现身份认证


阅读 [身份认证 接口文档](../api/authentication.md) 获取详细接口信息


## 认证流程

##### 1. 登录获取访问令牌 `access_token`
[登录](../api/authentication.md?id=颁发令牌（登录）) ，登录成功返回访问令牌 `access_token`， 在后续接口请求中传递访问令牌来认证身份

##### 2. 在路由中添加`auth:sanctum`中间件

`neat-admin`安装后的路由文件中已经添加了相关的理由组
```php
Route::group(['middleware' => ['auth:sanctum', 'permission']], function () {
    // 在这里添加需要身份认证的路由
});
```

##### 3. 请求接口时添加 `Authorization` Header头

> 请求参数

- Headers:

| 参数名称 | 参数值 | 是否必填 | 示例 |说明 |
| --- | --- | --- | --- | --- |
| Authorization | Bearer your_access_token | 是 | Bearer 2\|XpmhJBQLmd77U0eG5ugtNCS3kusW7qMrmnjUGhNa | your_access_token 为登录接口返回得access_token |

> 请求示例

```http
DELETE /api/admin/tokens HTTP/1.1
Accept: application/json
Authorization: Bearer 2|XpmhJBQLmd77U0eG5ugtNCS3kusW7qMrmnjUGhNa
User-Agent: PostmanRuntime/7.26.10
Postman-Token: d6858127-63e7-4441-be54-570922509044
Host: 127.0.0.1:8888
Accept-Encoding: gzip, deflate, br
Connection: keep-alive
```
