# 文件上传


## 使用方法

##### 在控制器中引用文件上传trait，添加上传方法

```php
<?php

use Wantp\Neat\Http\Traits\HasUploadedFile;
use Wantp\Neat\Http\Controllers\Controller;

class UserController extends Controller
{
    use HasUploadedFile;


    public function avatar()
    {
        $this->uploadFile();
    }
    
}

```

##### 添加路由
```php
Route::get('users/avatar',[UserControler::class, 'avatar']);
```


##### 请求导出
> 请求路径:

`GET` /api/admin/users/avatar

> 请求参数

- Query:

| 参数 | 类型 | 是否必填 | 说明 |
| --- | --- | ----| --- |
| files | file | 是 | 要上传的文件 |

