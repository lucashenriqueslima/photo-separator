<?php

namespace App\Helpers;

use Illuminate\Support\Str;
use App\Models\Event;

class DirHelper
{

    public static function getDirName($model, string $entity, string $fileName = ''): string
    {

        $clientPath = self::formatDirName("{auth()->user()->client_id}-{auth()->user()->client->name}");
        $eventPath = self::formatDirName("{$model->event->id}-{$model->event->name}");

        return "{$clientPath}/{$eventPath}/{$entity}/{$fileName}";
    }

    public static function getDirNameByEventId($eventId, $fileName): string
    {
        $clientPath = self::formatDirName(auth()->user()->client_id . '-' . auth()->user()->client->name);
        $eventPath = self::formatDirName($eventId . '-' . Event::find($eventId)->title);

        return "{$clientPath}/{$eventPath}/imagens/{$fileName}";
    }

    public static function formatDirName(string $path): string
    {
        return Str::slug($path, '-');
    }
}
