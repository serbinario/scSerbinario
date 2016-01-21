<?php

namespace SCSerbinario\Models;

use Illuminate\Database\Eloquent\Model;

class Aplicacao extends Model
{
    protected $table = 'aplicacoes';

    protected $fillable = [
        'projetos_id',
        'nome_aplicacao',
        'table_name_aplicacao'
    ];

    public function projetos()
    {
        return $this->belongsTo('SCSerbinario\Models\Projetos');
    }

    public function operacoes()
    {
        //Um pra muitos
        return $this->hasMany('SCSerbinario\Models\Operacao');
    }
}
