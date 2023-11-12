<?php

namespace Database\Seeders\Support;

use Illuminate\Support\Facades\File;

final class ReadJsonFile
{
    public static function read(string $file): array
    {
        return File::json($file);
    }
}
