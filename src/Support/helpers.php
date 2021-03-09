<?php


if (!function_exists('getAppPsr4NamespaceByPath')) {
    function getAppPsr4NamespaceByPath(string $path)
    {
        return 'App' . str_replace([app_path(), '/', '.php'], ['', '\\', ''], $path);
    }
}
