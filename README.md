# Neat Admin

## 简介

`Neat Admin` 用于构建前后端分离的后台系统

- [neat-admin](https://github.com/wantp/neat-admin) 是 `Neat Admin` 的后端项目，只提供接口，是基于`Laravel`开发的扩展包。标准的`RBAC`权限管理，约定了接口的调用，简化了接口开发

- [neat-admin-react](https://github.com/wantp/neat-admin-react) 是 `Neat Admin` 的前端项目，基于 `Antd Pro(v5)` 开发


## 环境

 - PHP >= 7.3
 - Laravel > 7.0.0

## 安装

在laravel项目中：
```
composer require wantp/neat-admin
```

发布配置文件及语言包：

```
php artisan neat:publish
```

然后运行下面的命令完成安装：

```
php artisan neat:install
```

初始管理员 `admin` ，密码 `admin123456`。


## License

------------

`Neat admin` is licensed under [The MIT License (MIT)](LICENSE).