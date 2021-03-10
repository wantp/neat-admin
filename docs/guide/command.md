# 命令行

`neat-admin` 提供了一些cli命令行来完成一些工作和辅助开发

## neat

获取`neat-admin`基本信息。包括当前版本、可用命令列表

```shell
php artisan neat
```

## neat:publish

发布资源文件。发布配置文件和翻译文件

```shell
php artisan neat:publish
```

## neat:install

安装`neat-admin`。执行此命令会将neat-admin安装到指定目录、执行数据库迁移并填充初始数据

```shell
php artisan neat:install
```

## neat:generate

##### 使用代码生成器，快速构建`CURD`控制器

```shell
php artisan neat:generate YourController
```

`neat:generate` 根据控制器名称分别生成(已存在则跳过)对应的`Model`、`Filter`、`Resource`和`Controller`

- `Model`  Eloquent 模型
- `Filter` 查询过滤器，默认过滤器为空，查询过滤器使用请参考[资源列表](../curd/getResources.md)章节
- `Resource` API 资源，默认返回模型所有字段，`Api 资源`参考[Api Resource](https://laravel.com/docs/8.x/eloquent-resources)。推荐使用`Api Resource`返回资源信息

**通常我们约定控制器的名称为对应表的单数名，如`users`表对应`UserController`，这样命名，对象对应关系非常清晰，也不需要多余的配置**

##### 获取生成器帮助

`php artisan neat:generate -h`

```shell
$ php artisan neat:generate -h
Description:
  Generate api

Usage:
  neat:generate [options] [--] <controller>

Arguments:
  controller                 controllerName e.g. UserController

Options:
      --model[=MODEL]        Custom model name e.g. User
      --filter[=FILTER]      Custom filter name e.g. UserFilter
      --resource[=RESOURCE]  Custom resource name e.g. UserResource
      --without-filter       This option will set the property $filterClass to null
      --without-resource     This option will set the property $resourceClass to null
  -h, --help                 Display help for the given command. When no command is given display help for the list command
  -q, --quiet                Do not output any message
  -V, --version              Display this application version
      --ansi                 Force ANSI output
      --no-ansi              Disable ANSI output
  -n, --no-interaction       Do not ask any interactive question
      --env[=ENV]            The environment the command should run under
  -v|vv|vvv, --verbose       Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

```
