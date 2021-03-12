<?php


if (!function_exists('getAppPsr4NamespaceByPath')) {
    function getAppPsr4NamespaceByPath(string $path)
    {
        return 'App' . str_replace([app_path(), '/', '.php'], ['', '\\', ''], $path);
    }
}


if (!function_exists('filterNullInput')) {
    function filterNullInput(array $inputs)
    {
        return array_filter($inputs, function ($input) {
            return $input !== '' && !is_null($input);
        });
    }
}
