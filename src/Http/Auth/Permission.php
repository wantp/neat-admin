<?php

namespace Wantp\Neat\Http\Auth;

use Illuminate\Support\Str;

class Permission
{
    /**
     * @param array $method
     * @return bool
     */
    public static function checkMethod(array $method)
    {
        $request = request();

        $method = collect($method)->filter()->map(function ($method) {
            return strtoupper($method);
        });

        return $method->contains($request->method());
    }

    /**
     * @param $path
     * @return bool|int
     */
    public static function checkPath($path)
    {
        $request = request();

        $httpPath = $request->decodedPath();

        if ($request->routeIs($path)) {
            return true;
        }

        if (!Str::contains($path, '*')) {
            return $path === $httpPath;
        }

        $path = str_replace(['*', '/'], ['([0-9a-z-_,])*', "\/"], ltrim($path, '/'));

        return preg_match("/$path/i", $httpPath);
    }
}