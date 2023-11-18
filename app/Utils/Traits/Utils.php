<?php

declare(strict_types=1);

namespace App\Utils\Traits;

use Carbon\Carbon;

trait Utils
{
    public function parseToDate(string $date): Carbon
    {
        return Carbon::parse($date);
    }
}
