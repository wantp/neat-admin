# 后台用户

## 后台用户列表

> 请求路径:

`GET` /api/admin/neat/users


> 请求参数

- Headers:

| 参数名称 | 参数值 | 是否必填 | 示例 |说明 |
| --- | --- | --- | --- | --- |
| Accept | application/json | 否 |  | |
| Authorization | Bearer your_access_token | 是 | Bearer 2\|XpmhJBQLmd77U0eG5ugtNCS3kusW7qMrmnjUGhNa | your_access_token 为登录接口返回得access_token |

- Query:

| 参数 | 类型 | 是否必填 | 说明 |
| --- | --- | ----| --- |
| id | string | 是 | 用户名 |
| username | string | 是 | 用户名 |
| nickname | string | 是 | 用户名 |

> 返回结果

| 参数 | 类型 | 说明 |
| --- | --- | ---|
| data | array | User[] |
| meta | array | Meta |

- User

| 参数 | 类型 | 说明 |
| --- | --- | ---|
| id | string | ID |
| username | string | 用户名 |
| nickname | string | 昵称 |
| avatar | string | 头像 |
| created_at | string | 创建时间 |
| updated_at | string | 更新时间 |

> 请求示例

```http
GET /api/admin/neat/users?username=admin HTTP/1.1
Accept: application/json
Authorization: Bearer 3|g9VGpvVvydbc2TZWfWDnZQMaAPhjBlA7HZsKvpPi
User-Agent: PostmanRuntime/7.26.10
Postman-Token: 08376192-91f7-473e-8820-c5106b94f1d2
Host: 127.0.0.1:8888
Accept-Encoding: gzip, deflate, br
Connection: keep-alive
```

> 返回示例

``` http
HTTP/1.1 200 OK
Host: 127.0.0.1:8888
Date: Wed, 10 Mar 2021 07:54:05 GMT
Date: Wed, 10 Mar 2021 07:54:05 GMT
Connection: close
X-Powered-By: PHP/7.4.8
Cache-Control: no-cache, private
Content-Type: application/json
X-RateLimit-Limit: 60
X-RateLimit-Remaining: 59
Access-Control-Allow-Origin: *
{"data":[{"id":1,"username":"admin","nickname":"Admin super","avatar":"","last_login_ip":"","last_login_time":null,"created_at":"2021-03-09 08:48:59","updated_at":"2021-03-09 08:48:59"}],"links":{"first":"http:\/\/127.0.0.1:8888\/api\/admin\/neat\/users?page=1","last":"http:\/\/127.0.0.1:8888\/api\/admin\/neat\/users?page=1","prev":null,"next":null},"meta":{"current_page":1,"from":1,"last_page":1,"path":"http:\/\/127.0.0.1:8888\/api\/admin\/neat\/users","per_page":10,"to":1,"total":1}}

```

## 后台用户详情

> 请求路径:

`GET` /api/admin/neat/users/{user}


> 请求参数

- 路径参数:

| 参数 | 类型 | 是否必填 | 说明 |
| --- | --- | ----| --- |
| user | int | 是 | 用户ID |

- Headers:

| 参数名称 | 参数值 | 是否必填 | 示例 |说明 |
| --- | --- | --- | --- | --- |
| Accept | application/json | 否 |  | |
| Authorization | Bearer your_access_token | 是 | Bearer 2\|XpmhJBQLmd77U0eG5ugtNCS3kusW7qMrmnjUGhNa | your_access_token 为登录接口返回得access_token |

> 返回结果

| 参数 | 类型 | 说明 |
| --- | --- | ---|
| id | string | ID |
| username | string | 用户名 |
| nickname | string | 昵称 |
| avatar | string | 头像 |
| created_at | string | 创建时间 |
| updated_at | string | 更新时间 |

> 请求示例

```http
GET /api/admin/neat/users/1 HTTP/1.1
Accept: application/json
Authorization: Bearer 3|g9VGpvVvydbc2TZWfWDnZQMaAPhjBlA7HZsKvpPi
User-Agent: PostmanRuntime/7.26.10
Postman-Token: 3bb026f7-7263-4cd0-aaa6-7ff547876765
Host: 127.0.0.1:8888
Accept-Encoding: gzip, deflate, br
Connection: keep-alive
```

> 返回示例

``` http
HTTP/1.1 200 OK
Host: 127.0.0.1:8888
Date: Wed, 10 Mar 2021 08:03:13 GMT
Date: Wed, 10 Mar 2021 08:03:13 GMT
Connection: close
X-Powered-By: PHP/7.4.8
Cache-Control: no-cache, private
Content-Type: application/json
X-RateLimit-Limit: 60
X-RateLimit-Remaining: 59
Access-Control-Allow-Origin: *
{"id":1,"username":"admin","nickname":"Admin super","avatar":"","last_login_ip":"","last_login_time":null,"created_at":"2021-03-09 08:48:59","updated_at":"2021-03-09 08:48:59"}

```

## 添加后台用户

> 请求路径:

`POST` /api/admin/neat/users


> 请求参数

- Headers:

| 参数名称 | 参数值 | 是否必填 | 示例 |说明 |
| --- | --- | --- | --- | --- |
| Content-Type | application/x-www-form-urlencoded | 是 |  | |
| Accept | application/json | 否 |  | |
| Authorization | Bearer your_access_token | 是 | Bearer 2\|XpmhJBQLmd77U0eG5ugtNCS3kusW7qMrmnjUGhNa | your_access_token 为登录接口返回得access_token |

- Body:

| 参数 | 类型 | 是否必填 | 说明 |
| --- | --- | ----| --- |
| username | string | 是 | 用户名 |
| nickname | string | 否 | 昵称 |
| password | string | 是 | 密码 |
| password_confirmation | string | 是 | 确认密码 |
| roles | array | 否 | 赋予角色 e.g. [{id:2},{id:3}]|

> 返回结果

| 参数 | 类型 | 说明 |
| --- | --- | ---|
| id | string | ID |
| username | string | 用户名 |
| nickname | string | 昵称 |
| avatar | string | 头像 |
| created_at | string | 创建时间 |
| updated_at | string | 更新时间 |

> 请求示例

```http
POST /api/admin/neat/users HTTP/1.1
Accept: application/json
Authorization: Bearer 3|g9VGpvVvydbc2TZWfWDnZQMaAPhjBlA7HZsKvpPi
User-Agent: PostmanRuntime/7.26.10
Postman-Token: 1960bbf0-c9d0-4b1e-8f17-edd7ae9feb6d
Host: 127.0.0.1:8888
Accept-Encoding: gzip, deflate, br
Connection: keep-alive
Content-Type: application/x-www-form-urlencoded
Content-Length: 59
username=guest&password=123456&password_confirmation=123456
```

> 返回示例

``` http
HTTP/1.1 201 Created
Host: 127.0.0.1:8888
Date: Wed, 10 Mar 2021 08:11:27 GMT
Date: Wed, 10 Mar 2021 08:11:27 GMT
Connection: close
X-Powered-By: PHP/7.4.8
Cache-Control: no-cache, private
Content-Type: application/json
X-RateLimit-Limit: 60
X-RateLimit-Remaining: 59
Access-Control-Allow-Origin: *
{"id":2,"username":"guest","nickname":null,"avatar":null,"last_login_ip":null,"last_login_time":null,"created_at":"2021-03-10 08:11:27","updated_at":"2021-03-10 08:11:27"}
```

## 编辑后台用户

> 请求路径:

`PUT` /api/admin/neat/users/{user}


> 请求参数

- 路径参数:

| 参数 | 类型 | 是否必填 | 说明 |
| --- | --- | ----| --- |
| user | int | 是 | 用户ID |

- Body:

| 参数 | 类型 | 是否必填 | 说明 |
| --- | --- | ----| --- |
| username | string | 否 | 用户名 |
| nickname | string | 否 | 昵称 |
| password | string | 否 | 密码 |
| password_confirmation | string | 否 | 确认密码 |
| roles | array | 否 | 赋予角色 e.g. [{id:2},{id:3}]|

- Headers:

| 参数名称 | 参数值 | 是否必填 | 示例 |说明 |
| --- | --- | --- | --- | --- |
| Content-Type | application/x-www-form-urlencoded | 是 |  | |
| Accept | application/json | 否 |  | |
| Authorization | Bearer your_access_token | 是 | Bearer 2\|XpmhJBQLmd77U0eG5ugtNCS3kusW7qMrmnjUGhNa | your_access_token 为登录接口返回得access_token |

> 返回结果

| 参数 | 类型 | 说明 |
| --- | --- | ---|
| id | string | ID |
| username | string | 用户名 |
| nickname | string | 昵称 |
| avatar | string | 头像 |
| created_at | string | 创建时间 |
| updated_at | string | 更新时间 |

> 请求示例

```http
PUT /api/admin/neat/users/2 HTTP/1.1
Accept: application/json
Authorization: Bearer 3|g9VGpvVvydbc2TZWfWDnZQMaAPhjBlA7HZsKvpPi
User-Agent: PostmanRuntime/7.26.10
Postman-Token: efa53076-3bfe-489d-b36d-ae782f3724f3
Host: 127.0.0.1:8888
Accept-Encoding: gzip, deflate, br
Connection: keep-alive
Content-Type: application/x-www-form-urlencoded
Content-Length: 39
username=wangzai&nickname=zhangrongwang
```

> 返回示例

``` http
HTTP/1.1 200 OK
Host: 127.0.0.1:8888
Date: Wed, 10 Mar 2021 08:14:39 GMT
Date: Wed, 10 Mar 2021 08:14:39 GMT
Connection: close
X-Powered-By: PHP/7.4.8
Cache-Control: no-cache, private
Content-Type: application/json
X-RateLimit-Limit: 60
X-RateLimit-Remaining: 59
Access-Control-Allow-Origin: *
{"id":2,"username":"wangzai","nickname":"zhangrongwang","avatar":"","last_login_ip":"","last_login_time":null,"created_at":"2021-03-10 08:11:27","updated_at":"2021-03-10 08:14:39"}
```

## 删除后台用户

> 请求路径:

`DELETE` /api/admin/neat/users/{user}


> 请求参数

- 路径参数:

| 参数 | 类型 | 是否必填 | 说明 |
| --- | --- | ----| --- |
| user | int | 是 | 用户ID |

- Headers:

| 参数名称 | 参数值 | 是否必填 | 示例 |说明 |
| --- | --- | --- | --- | --- |
| Accept | application/json | 否 |  | |
| Authorization | Bearer your_access_token | 是 | Bearer 2\|XpmhJBQLmd77U0eG5ugtNCS3kusW7qMrmnjUGhNa | your_access_token 为登录接口返回得access_token |

> 返回结果

| 参数 | 类型 | 说明 |
| --- | --- | ---|
| message | string | 提示信息 |

> 请求示例

```http
ELETE /api/admin/neat/users/2 HTTP/1.1
Accept: application/json
Authorization: Bearer 3|g9VGpvVvydbc2TZWfWDnZQMaAPhjBlA7HZsKvpPi
User-Agent: PostmanRuntime/7.26.10
Postman-Token: 0e80e8bb-772e-4eb1-a6f9-07acf3c6bcbc
Host: 127.0.0.1:8888
Accept-Encoding: gzip, deflate, br
Connection: keep-alive
```

> 返回示例

``` http
HTTP/1.1 200 OK
Host: 127.0.0.1:8888
Date: Wed, 10 Mar 2021 08:16:13 GMT
Date: Wed, 10 Mar 2021 08:16:13 GMT
Connection: close
X-Powered-By: PHP/7.4.8
Cache-Control: no-cache, private
Content-Type: application/json
X-RateLimit-Limit: 60
X-RateLimit-Remaining: 59
Access-Control-Allow-Origin: *
{"message":"Success"}
```

