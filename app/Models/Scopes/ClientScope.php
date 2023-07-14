<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class ClientScope implements Scope
{

    private string $client_id_column;

    public function __construct(string $client_id_column = 'client_id')
    {
        $this->client_id_column = $client_id_column;
    }

    public function apply(Builder $builder, Model $model): void
    {
        $builder->where($this->client_id_column, auth()->user()->client_id);
    }
}
