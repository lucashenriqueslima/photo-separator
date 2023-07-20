<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\ClientScope;

class Identification extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'indentifier',
        'name',
        'email',
        'phone',
        'image_path',
    ];

    protected static function booted()
    {
        static::addGlobalScope(new ClientScope());
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function identificationImage()
    {
        return $this->hasOne(IdentificationImage::class);
    }
}
