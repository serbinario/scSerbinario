<?php

namespace SCSerbinario\Models;

use Illuminate\Database\Eloquent\Model;

class Projetos extends Model
{
    protected $table = 'projetos';

    protected $fillable = [
        'nome_projeto',
        'descricao_projeto',
        'name_space_projeto',
        'name_db_projeto',
        'bundle'
    ];

    public function aplicacoes()
    {
        return $this->hasMany('SCSerbinario\Models\Aplicacao');
    }
}
