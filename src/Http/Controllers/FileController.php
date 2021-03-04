<?php

namespace Wantp\Neat\Http\Controllers;

use Wantp\Neat\Http\Traits\HasUploadedFile;

class FileController extends Controller
{
    use HasUploadedFile;

    public function store()
    {
        return $this->uploadFile();
    }
}
