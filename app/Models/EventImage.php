<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    public const STATUS_UPLOADED = "Carregado";
    public const STATUS_SEPARATED = "Analisado";
    public const STATUS_UPLOAD_ERROR = "Erro";
    public const STATUS_DELETED = "Deletado";

    protected $fillable = [
        'event_id',
        'status',
        'name',
        'encrypted_name',
        'path',
        'size',
        'price',
    ];
}
