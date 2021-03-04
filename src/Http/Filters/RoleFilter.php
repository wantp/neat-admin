<?php

namespace Wantp\Neat\Http\Filters;

use Wantp\Neat\Filter;

class RoleFilter extends Filter
{
    public function id($id)
    {
        $this->query->where('id', '=', $id);
    }

    public function name($name)
    {
        $this->query->where('name', 'like', '%' . $name . '%');
    }

    public function slug($slug)
    {
        $this->query->where('slug', 'like', '%' . $slug . '%');
    }
}