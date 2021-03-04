<?php


if (!function_exists('psr4Namespace')) {
    function psr4Namespace(array $path)
    {
        return 'App' . str_replace([app_path(), '/'], ['', '\\'], $path);
    }
}
