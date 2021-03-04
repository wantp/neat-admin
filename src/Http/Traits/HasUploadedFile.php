<?php

namespace Wantp\Neat\Http\Traits;

use Illuminate\Support\Facades\Storage;
use function request;

trait HasUploadedFile
{
    protected function uploadFile($path = '')
    {
        $disk = config('admin.filesystem.disk');
        $path = rtrim(config('admin.filesystem.path') . '/' . ltrim($path, '/'), '/');

        $filepath = request()->file('file')->store($path, $disk);

        return [
            'path' => $filepath,
            'url' => Storage::disk($disk)->url($filepath)
        ];
    }

}