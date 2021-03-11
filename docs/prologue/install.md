# 安装

## 环境依赖
 - PHP >= 7.3
 - Laravel > 7.0.0

## 进入Laravel项目
如果没有先创建Laravel项目
```shell
# 创建laravel项目
composer create-project laravel/laravel my-laravel "^7.0" --prefer-dist
# 进入项目目录
cd my-laravel
```

## 获取`neat-admin`扩展包

```shell
composer require wantp/neat-admin
```

## 发布配置、翻译文件

```shell
php artisan neat:publish
```
以上命令会生成
- 配置文件 `config/neat.php` 
- 语言包 `resources/lang/en/admin.php`、 `resources/lang/en/admin.php`

## 安装neat-admin
`neat-admin` 默认安装在 `app/Modules/Admin` 目录下, 通过修改配置文件 `config/neat.php` 的配置项 `root` 调整
```shell
php artisan neat:install
```
以上命令会
1. 安装 `neat` 到指定目录
2. 执行数据库迁移
3. 创建后台超级管理员账号（用户名：`admin`，密码： `admin123456`）


## 安装完成后的目录结构 
```
app/Modules/Admin
├── Http
│   └── Controllers
│   └── Filters
│   └── Resources
└── routes.php
```
1. `app/Modules/Admin/routes.php` 后台路由文件
2. `app/Modules/Admin/Http/Controllers` 后台控制器目录
3. `app/Modules/Admin/Http/Filters` 查询过滤器目录
4. `app/Modules/Admin/Http/Resources` API资源目录

