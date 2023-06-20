<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\EventStatus;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
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

    public function users () 
    {
        return $this->belongsTo(User::class);
    }

    public function eventStatus () 
    {
        return $this->belongsTo(EventStatus::class);
    }
    
}
