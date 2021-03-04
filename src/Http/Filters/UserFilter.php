<?php

namespace Wantp\Neat\Http\Filters;

use Wantp\Neat\Filter;

class UserFilter extends Filter
{
    public function id($id)
    {
        $this->query->where('id', '=', $id);
    }

    public function username($username)
    {
        $this->query->where('username', 'like', '%' . $username . '%');
    }

    public function nickname($nickname)
    {
        $this->query->where('nickname', 'like', '%' . $nickname . '%');
    }
}