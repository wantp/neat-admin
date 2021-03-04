<?php

namespace Wantp\Neat\Http\Filters;

use Wantp\Neat\Filter;

class MenuFilter extends Filter
{
    public function id($id)
    {
        $this->query->where('id', '=', $id);
    }

    public function name($name)
    {
        $this->query->where('name', 'like', '%' . $name . '%');
    }

    public function path($path)
    {
        $this->query->where('path', 'like', '%' . $path . '%');
    }
}