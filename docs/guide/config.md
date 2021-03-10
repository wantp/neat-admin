# 配置文件
执行发布资源命令后会创建 *config/neat.php* 配置文件
```shell
php artisan neat:publish
```

通常不需要修改配置项，根据需要自定义配置项


### 配置项

## root
类型 - `string`  
neat-admin安装目录，绝对路径

*config/neat.php*
```php
'root' => app_path('Modules/Admin'),
```

## database
类型 - `array`  
数据库相关配置

#### database.connection
类型 - `string`  
数据库连接设置，未配置时使用默认数据库 

*config/neat.php*
```php
'database' => [
    'connection' => 'mysql_admin',
]
```

#### database.tables
类型 - `array`  
配置`neat-admin`后台表名称

*config/api-admin.php*
```php
'database' => [
    'tables' => [
        'users' => 'neat_users', // 后台用户表
        'roles' => 'neat_roles', // 后台角色表
        'permissions' => 'neat_permissions', // 后台权限表
        'menus' => 'neat_menus', // 后台菜单表
        'role_user' => 'neat_role_user', // 用户角色关联表
        'role_permission' => 'neat_role_permission', // 权限角色关联表
        'role_menu' => 'neat_role_menu', // 菜单角色关联表
    ]
]
```

## models
类型 - `array`  
`Model`相关配置

#### models.path
类型 - `string`  
`Model` 的根目录，绝对路径

*config/neat.php*
```php
'models' => [
    'path' => app_path('Models'),
],
```

## route
类型 - `array`  
路由配置

#### route.prefix
类型 - `string`  
路由前缀

*config/neat.php*
```php
'route' => [
    'prefix' => 'api/admin',
]
```


## filesystem
类型 - `array`  
文件系统相关配置

#### filesystem.disk
类型 - `string`  
文件系统disk，disk取值为 *config/filesystem.php* 中配置的disks

*config/neat.php*
```php
'filesystem' => [
    'disk' => 'public',
]
```

#### filesystem.path
类型 - `string`  
文件存储目录

*config/neat.php*
```php
'filesystem' => [
    'path' => 'admin',
]
```
