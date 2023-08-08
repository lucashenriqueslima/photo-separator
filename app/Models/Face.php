<?php

namespace App\Models;

use App\Models\Image;
use App\Models\Indentification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Face extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function image()
    {
        return $this->belongsTo(Image::class);
    }

    public function identification()
    {
        return $this->belongsTo(Indentification::class);
    }
}
