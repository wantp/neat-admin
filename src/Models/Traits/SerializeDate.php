<?php

namespace Wantp\Neat\Models\Traits;

use Carbon\Carbon;
use DateTimeInterface;

trait SerializeDate
{
    /**
     * @param DateTimeInterface $date
     * @return string
     */
    public function serializeDate(DateTimeInterface $date)
    {
        return Carbon::instance($date)->toDateTimeString();
    }
}