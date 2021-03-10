# 资源列表

`\Wantp\Neat\Http\Controllers\Controller` 的 `__index` 方法对获取资源列表进行了封装。  
**使用方法：**

1. （推荐）使用命令行快速构建CURD控制器，阅读[命令行](../guide/command.md)获取命令行使用方法
2. 如果是自定义控制器，继承`\Wantp\Neat\Http\Controllers\Controller`，设置$modelClass，调用 `__index`方法

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
    public function index()
    {
        return parent::__index();
    }
}
```

## 获取列表

控制器完成后，要获取资源列表还需要配置路由 配置index路由

```php
Route::get('users',[\App\Modules\Admin\Http\Controllers\UserController::class,'index']);
```

然后可以通过客户端请求接口获取资源列表了
`GET` /api/admin/users

## 查询过滤

使用查询过滤需要三个步骤

1. 创建Filter Filter需要继承`\Wantp\Neat\Filter`, 需要过滤的字段作为方法名，方法中写入过滤的方式

```php
<?php
class UserFilter extends \Wantp\Neat\Filter
{
    public function id($id)
    {
        $this->query->where('id', '=', $id);
    }

    public function username($username)
    {
        $this->query->where('username', 'like', '%' . $username . '%');
    }

    public function nickname($nickname)
    {
        $this->query->where('nickname', 'like', '%' . $nickname . '%');
    }
}
```

2. 配置Filter到控制器

```php
class UserController extends Controller
{
    /**
     * @var string
     */
    protected $filterClass = UserFilter::class;
}
```   

3. 请求接口时传递过滤参数

> 请求示例

`GET` /api/admin/users?nickname=a&username=b

以上请求代表查询资源列表中nickname like %a% 且 username like %b% 数据

## 分页

`__index` 默认对资源列表进行分页，使用参数page、page_size控制列表分页

> 请求参数

| 参数 | 类型 | 是否必填 | 说明 |
| --- | --- | ----| --- |
| page | int | 否 | 页码 默认1 |
| page_size | int | 否 | 单页数据量 默认10 |

> 请求示例

`GET` /api/admin/users?page=3&page_size=10

##### 不使用分页

如果不需要分页，可以通过传参page_size=-1来获取所有数据

> 请求示例

`GET` /api/admin/users?page_size=-1

## 排序

列表排序是很常见的需求，`neat-admin`中可以使用`sorter`对资源列表进行排序

在请求资源列表时附加参数`sorter`来排序，`sorter` 非常简单，使用json字符串来表示，其中`key`是需要排序的字段，`value`是排序方式，有两个取值： 1. asc(升序) 2. desc(降序)

> 请求参数

| 参数 | 类型 | 是否必填 | 说明 |
| --- | --- | ----| --- |
| sorter | string | 否 | 排序器 |

> 请求示例

`GET` /api/admin/users?sorter={"id":"desc","updated_at":"desc"}

这个`sorter`表示对请求的资源，先进行id降序排序，再进行updated_at降序排序

## 关联关系

要获取资源的关联资源也很简单，只需要定义好模型关联关系，请求资源时传递`include`说明需要获取的关联数据，`neat-admin`会自动解析并返回关联的数据

> 请求参数

| 参数 | 类型 | 是否必填 | 说明 |
| --- | --- | ----| --- |
| include | string | 否 | 需要获得关联资源，取值为模型关联的名称，多个关联用","分隔，嵌套关联用"."表示 |

1. 定义模型关联

```
class User extends Model
{
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
```

2. 请求资源附加include参数，include的值为模型关联名称

> 请求示例

`GET` /api/admin/users?include=roles

返回的列表资源中每个user资源会以关联名称roles返回关联roles资源

```json
[
    {
        "id": 1,
        "username": "admin",
        "nickname": "Admin super",
        "roles": [
            {
                "id": 1,
                "name": "Administrator",
                "slug": "Administrator",
                "remarks": "Super administrator!"
            }
        ]
    }
]
```

##### 嵌套关联

想要获取关联资源的关联资源，比如上面例子中还要获取角色中的权限，我们可以这么做

1. 定义模型关联

```
class Role extends Model
{
    public function permissions()
    {
        return $this->belongsToMany(Permissions::class);
    }
}
```

2. 请求资源附加include参数，`include`使用`.`表示嵌套关系

> 请求示例

`GET` /api/admin/users?include=roles.permissions

会得到如下结构的返回

```json
[
    {
        "id": 1,
        "username": "admin",
        "nickname": "Admin super",
        "avatar": "",
        "last_login_ip": "",
        "last_login_time": null,
        "created_at": "2021-03-09 08:48:59",
        "updated_at": "2021-03-09 08:48:59",
        "roles": [
            {
                "id": 1,
                "name": "Administrator",
                "slug": "Administrator",
                "remarks": "Super administrator!",
                "created_at": "2021-03-09 08:48:59",
                "updated_at": "2021-03-09 08:48:59",
                "permissions": [
                    {
                        "id": 1,
                        "name": "Permission",
                        "slug": "Permission",
                        "created_at": "2021-03-09 08:48:59",
                        "updated_at": "2021-03-09 08:48:59"
                    }
                ]
            }
        ]
    }
]
```

##### N+1 问题

`include`不会产生`N+1`问题
