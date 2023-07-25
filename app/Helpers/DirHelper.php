<?php

namespace App\Helpers;

use Illuminate\Support\Str;


class DirHelper
{
    public static function formatDirName(string $path): string
    {
        return Str::slug($path, '-');
    }
}
