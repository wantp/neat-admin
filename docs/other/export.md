# 导出表格

导出表格的功能是对 [box/spout](https://github.com/box/spout) 的封装


## 使用方法

##### 在控制器中引用数据导出trait，添加导出方法

```php
<?php

use Wantp\Neat\Http\Traits\HasDataExport;
use Wantp\Neat\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    use HasDataExport;
    
        /**
     * @var string
     */
    protected $modelClass = User::class;

    public function export()
    {
        $this->__export();
    }
    
}

```

##### 添加路由
```php
Route::get('users_export',[UserControler::class, 'export']);
```


##### 请求导出
> 请求路径:

`GET` /api/admin/users_export

> 请求参数

- Query:

| 参数 | 类型 | 是否必填 | 说明 |
| --- | --- | ----| --- |
| export_columns | object | 是 | 要导出的列 key是要导出的字段，value为字段对应导出表中标题 |
| export_file_type | string | 否 | 文件类型 xlsx,csv,ods 默认xlsx |
| export_file_name | string | 否 | 导出文件名 |
| page | int | 是 | 页码 |
| pageSize | int | 是 | 单页数据量 |


请求示例
`GET` /api/admin/users_export?export_columns={"id":"ID"}&export_file_name=test&export_file_type=csv