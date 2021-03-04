<?php

namespace Wantp\Neat\Contracts;

interface Relation
{
    public function save();

    /**
     * @return array
     */
    public function getInputs();
}