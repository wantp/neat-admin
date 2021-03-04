<?php

namespace Wantp\Neat;

use Illuminate\Database\Eloquent\Builder as Query;
use Illuminate\Database\Eloquent\Model;

abstract class Filter
{
    /**
     * @var Query|Model
     */
    protected $query;

    public function __filter($query, $inputs)
    {
        $this->query = $query;
        foreach ($inputs as $input => $inputValue) {
            if (method_exists($this, $input)) {
                call_user_func([$this, $input], $inputValue);
            }
        }
    }
}