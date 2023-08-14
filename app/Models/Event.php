<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Client;
use App\Models\EventStatus;
use App\Models\Indentification;
use App\Models\Image;
use App\Models\Scopes\ClientScope;

class Event extends Model
{
    use HasFactory;

    public const STATUS_WAITING = 1;
    public const STATUS_HAPPENED = 2;
    public const STATUS_CANCELED = 3;

    protected $fillable = [
        'client_id',
        'title',
        'description',
        'place',
        'localization',
        'start',
        'end'
    ];

    protected $casts = [
        'start' => 'datetime',
        'end' => 'datetime'
    ];

    protected $dates = [
        'start',
        'end'
    ];

    protected static function booted()
    {
        static::addGlobalScope(new ClientScope());
    }

    public function client()
    {
        return $this->hasOne(Client::class);
    }

    public function eventStatus()
    {
        return $this->belongsTo(EventStatus::class);
    }

    public function indentifications()
    {
        return $this->hasMany(Indentification::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
