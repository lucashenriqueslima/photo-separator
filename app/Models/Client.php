<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cpf',
        'cnpj',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'user_id'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
