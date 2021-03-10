# RBAC 权限管理

RBAC(Role-Based Access Control)基于角色的访问控制

首先给角色设置一个或多个权限，然后通过给用户赋予不同的角色来实现用户的访问控制


## 超级管理员
为了便于管理，通常会设置一个超级管理员，超级管理员无需配置即拥有所有权限  
`neat-admin` 内置了一个超级管理员角色`Administrator`，并为`admin`用户赋予了该角色
**赋予了`Administrator`角色的用户都是超级管理员，拥有所有权限**


## Role Slug
每个角色都有个唯一值`slug`作为标识，通过`slug`识别角色，超级管理员的`Slug` 是 `Administrator`


## 权限
一个权限对应一个或一组接口，通过配置权限实现接口的访问控制

## Permission Slug
每个权限也有个唯一值`slug`作为标识，可以便于前端通过权限`slug`来控制一些模块的显示方式
