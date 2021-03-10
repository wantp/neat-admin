# 身份认证


## 颁发令牌（登录）

> 请求路径:

`POST` /api/admin/tokens


> 请求参数
 
- Headers:

| 参数名称 | 参数值 | 是否必填 | 示例 |说明 |
| --- | --- | --- | --- | --- |
| Accept | application/json | 否 |  | |

- Body:

| 参数 | 类型 | 是否必填 | 说明 |
| --- | --- | ----| --- |
| username | string | 是 | 用户名 |
| password | string | 是 | 密码 |


> 返回结果

| 参数 | 类型 | 说明 |
| --- | --- | --- |
| access_token | string | 访问令牌 |

> 请求示例

```http
POST /api/admin/tokens HTTP/1.1
Accept: application/json
User-Agent: PostmanRuntime/7.26.10
Postman-Token: e3d66e5f-84c1-461d-a756-7441e653e76e
Host: 127.0.0.1:8888
Accept-Encoding: gzip, deflate, br
Connection: keep-alive
Content-Type: application/x-www-form-urlencoded
Content-Length: 35
username=admin&password=admin123456
```

> 返回示例

``` http
HTTP/1.1 200 OK
Host: 127.0.0.1:8888
Date: Wed, 10 Mar 2021 01:46:13 GMT
Date: Wed, 10 Mar 2021 01:46:13 GMT
Connection: close
X-Powered-By: PHP/7.4.8
Cache-Control: no-cache, private
Content-Type: application/json
X-RateLimit-Limit: 60
X-RateLimit-Remaining: 59
Access-Control-Allow-Origin: *
{"access_token":"2|XpmhJBQLmd77U0eG5ugtNCS3kusW7qMrmnjUGhNa"}
```


## 废弃令牌（退出登录）

> 请求路径: 

`DELETE` /api/admin/tokens


> 请求参数

- Headers:

| 参数名称 | 参数值 | 是否必填 | 示例 |说明 |
| --- | --- | --- | --- | --- |
| Accept | application/json | 否 |  | |
| Authorization | Bearer your_access_token | 是 | Bearer 2\|XpmhJBQLmd77U0eG5ugtNCS3kusW7qMrmnjUGhNa | your_access_token 为登录接口返回得access_token |


> 返回结果

| 参数 | 类型 | 说明 |
| --- | --- | --- |
| message | string | 提示信息 |

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

> 返回示例

``` http
HTTP/1.1 200 OK
Host: 127.0.0.1:8888
Date: Wed, 10 Mar 2021 01:48:36 GMT
Date: Wed, 10 Mar 2021 01:48:36 GMT
Connection: close
X-Powered-By: PHP/7.4.8
Cache-Control: no-cache, private
Content-Type: application/json
X-RateLimit-Limit: 60
X-RateLimit-Remaining: 59
Access-Control-Allow-Origin: *
{"message":"Success"}
```


## 当前登录用户

> 请求路径:

`GET` /api/admin/current


> 请求参数

- Headers:

| 参数名称 | 参数值 | 是否必填 | 示例 |说明 |
| --- | --- | --- | --- | --- |
| Accept | application/json | 否 |  | |
| Authorization | Bearer your_access_token | 是 | Bearer 2\|XpmhJBQLmd77U0eG5ugtNCS3kusW7qMrmnjUGhNa | your_access_token 为登录接口返回得access_token |


> 返回结果

| 参数 | 类型 | 说明 |
| --- | --- | --- |
| id | string | ID |
| username | string | 用户名 |
| nickname | string | 昵称 |
| avatar | string | 头像 |
| created_at | string | 创建时间 |
| updated_at | string | 更新时间 |

> 请求示例

```http
GET /api/admin/current HTTP/1.1
Accept: application/json
Authorization: Bearer 3|g9VGpvVvydbc2TZWfWDnZQMaAPhjBlA7HZsKvpPi
User-Agent: PostmanRuntime/7.26.10
Postman-Token: ff3fdcfc-0172-4ad2-83fa-68384e463de2
Host: 127.0.0.1:8888
Accept-Encoding: gzip, deflate, br
Connection: keep-alive
```

> 返回示例

``` http
HTTP/1.1 200 OK
Host: 127.0.0.1:8888
Date: Wed, 10 Mar 2021 07:36:12 GMT
Date: Wed, 10 Mar 2021 07:36:12 GMT
Connection: close
X-Powered-By: PHP/7.4.8
Cache-Control: no-cache, private
Content-Type: application/json
X-RateLimit-Limit: 60
X-RateLimit-Remaining: 59
Access-Control-Allow-Origin: *
{"id":1,"username":"admin","nickname":"Admin super","avatar":"","last_login_ip":"","last_login_time":null,"created_at":"2021-03-09 08:48:59","updated_at":"2021-03-09 08:48:59"}
```


## 当前登录用户菜单

> 请求路径:

`GET` /api/admin/current/menus


> 请求参数

- Headers:

| 参数名称 | 参数值 | 是否必填 | 示例 |说明 |
| --- | --- | --- | --- | --- |
| Accept | application/json | 否 |  | |
| Authorization | Bearer your_access_token | 是 | Bearer 2\|XpmhJBQLmd77U0eG5ugtNCS3kusW7qMrmnjUGhNa | your_access_token 为登录接口返回得access_token |


> 返回结果

| 参数 | 类型 | 说明 |
| --- | --- | ---|
|  | array | Menu[] |

- Menu

| 参数 | 类型 | 说明 |
| --- | --- | ---|
| id | string | ID |
| parent_id | string | 父级菜单ID |
| name | string | 菜单名 |
| path | string | 请求地址 |
| icon | string | ICON |
| created_at | string | 创建时间 |
| update_at | string | 更新时间 | 
| children | string | menu[] |


> 请求示例

```http
GET /api/admin/current/menus HTTP/1.1
Accept: application/json
Authorization: Bearer 3|g9VGpvVvydbc2TZWfWDnZQMaAPhjBlA7HZsKvpPi
User-Agent: PostmanRuntime/7.26.10
Postman-Token: fbcbe4f3-16d7-42ab-b76b-a62d8e41fcc2
Host: 127.0.0.1:8888
Accept-Encoding: gzip, deflate, br
Connection: keep-alive
```

> 返回示例

``` http
HTTP/1.1 200 OK
Host: 127.0.0.1:8888
Date: Wed, 10 Mar 2021 07:38:55 GMT
Date: Wed, 10 Mar 2021 07:38:55 GMT
Connection: close
X-Powered-By: PHP/7.4.8
Cache-Control: no-cache, private
Content-Type: application/json
X-RateLimit-Limit: 60
X-RateLimit-Remaining: 59
Access-Control-Allow-Origin: *
[{"id":1,"parent_id":0,"name":"home","path":"\/home","icon":"HomeOutlined","order":1,"created_at":"2021-03-09 16:48:59","update_at":"2021-03-09 16:48:59"},{"id":2,"parent_id":0,"name":"neat","path":"\/neat","icon":"WindowsOutlined","order":1,"created_at":"2021-03-09 16:48:59","update_at":"2021-03-09 16:48:59","children":[{"id":3,"parent_id":2,"name":"users","path":"\/neat\/users","icon":"","order":1,"created_at":"2021-03-09 16:48:59","update_at":"2021-03-09 16:48:59"},{"id":4,"parent_id":2,"name":"roles","path":"\/neat\/roles","icon":"","order":1,"created_at":"2021-03-09 16:48:59","update_at":"2021-03-09 16:48:59"},{"id":6,"parent_id":2,"name":"permissions","path":"\/neat\/permissions","icon":"","order":1,"created_at":"2021-03-09 16:48:59","update_at":"2021-03-09 16:48:59"},{"id":7,"parent_id":2,"name":"menus","path":"\/neat\/menus","icon":"","order":1,"created_at":"2021-03-09 16:48:59","update_at":"2021-03-09 16:48:59"}]}]
```
