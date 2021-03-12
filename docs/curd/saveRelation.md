# 保存关联

**添加或更新资源时，入参中`参数名`与模型中定义关联关系的`方法名`一致时，就会以此方法的定义关联来处理同名的参数**

## 一对一

##### 定义关联关系

例如，一个用户与用户资料是一对一关系，分别对应模型`User`和`Profile`，在`User`模型中定义关联

```php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public function profile()
    {
        return $this->hasOne('App\Models\Profile');
    }
}
```

##### 添加、更新关联

在添加或更新资源时，添加请求参数`profile`来更新用户资料，例如，更新用户资料中的学历

```
profile: {"edu":"本科"}
```

如果关联不存在则会新建一条，存在则更新

不需要对关联更新时，可以不传或传空值

```
profile: ""
```

##### 删除关联

想要删除关联的资源，传递一个空对象，例如，删除用户关联的用户资料

```
profile: {}
```

## 一对多

##### 定义关联关系

例如，一个用户与手机号是一对多关系，分别对应模型`User`和`Phone`，在`User`模型中定义关联

```php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public function phones()
    {
        return $this->hasMany('App\Models\Phone');
    }
}
```

##### 添加关联

添加请求参数`phones`来添加手机数据，`phones`是一个数组，每一元素对应一个`phone`的信息

```
phones: [{"phone":"13133334444"},{"phone":"13566667777"}]
```

添加了两条`phone`的记录并与`user`建立了关联

##### 更新关联

添加请求参数`phones`来添加手机数据，`phones`是一个数组，每一元素对应一个`phone`的信息，并且需要包含`phone`的主键（没有主键的元素会被当做新增处理）

```
phones: [{"id":1, "phone":"13133334445"},{"id":2, phone":"13566667776"}]
```

更新了ID为1和2的两条`phone`记录

##### 删除关联

传递的参数`phones`数组中不包含对应的元素时，该元素会被删除

```
phones: [{"id":1}]
```

删除了ID为2的`phone`记录，并且ID为1的`phone`记录没有任何变化

## 多对多

##### 定义关联关系

例如，一个用户与标签是多对多关系，分别对应模型`User`和`Tag`，中间表为`tag_user`，在`User`模型中定义关联

```php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag');
    }
}
```

##### 添加、更新、删除关联

添加请求参数`tags`来表示要建立的关联，`phones`是一个数组，每一元素对应一个`phone`的信息，并且需要包含`phone`的主键

```
tags: [{"id": 1},{"id": 3}]
```

tags 说明
- 在数组中，关联不存在，则新增
- 在数组中，关联已存在，没有任何变化
- 不在数组中，关联已存在，则删除

例如`user`已关联了`1`、`2`两个`tag`，请求参数`tags: [{"id": 1},{"id": 3}]`，将会
- 新增`user`和`tag` `3` 的关联
- 删除`user`和`tag` `2` 的关联
- `user`和`tag` `1`的关联没有任何变化