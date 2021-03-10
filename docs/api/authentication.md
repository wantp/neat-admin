# 身份认证


## 颁发令牌（登录）

- Http Method

`
POST
`

- 接口地址

`
/api/admin/tokens
`

- 请求参数

| 参数        | 类型   | 是否必填 | 说明                   |
| ----------- | ------ | -------- | ---------------------- |
| username          | string    | 是       | 用户名                 |
| password       | string    | 是       | 密码              |


- 返回结果

| 参数 | 类型   | 说明     |
| ---- | ------ | -------- |
| access_token | string | 访问令牌 |

- 请求示例

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

- 返回示例

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

- Http Method

`
DELETE
`

- 接口地址

`
/api/admin/tokens
`

- 请求参数

| 参数        | 类型   | 是否必填 | 说明                   |
| ----------- | ------ | -------- | ---------------------- |
|           |     |        |                  |


- 返回结果

| 参数 | 类型   | 说明     |
| ---- | ------ | -------- |
| message | string | 提示信息 |

- 请求示例

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

- 返回示例

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
