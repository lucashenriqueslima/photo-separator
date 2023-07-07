<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\EventStatus;

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

    public function client()
    {
        return $this->hasOne(Client::class);
    }

    public function eventStatus()
    {
        return $this->belongsTo(EventStatus::class);
    }
}
