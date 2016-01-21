<?php

namespace SCSerbinario\Models;

use Illuminate\Database\Eloquent\Model;

class Operacao extends Model
{

    protected $table = 'operacoes';

    protected $fillable = [
        'nome_operacoes',
    ];

    public function tipo_crud()
    {
        //return $this->belongsTo('SCSerbinario\Models\TipoCrud', 'id');
        return $this->belongsTo('SCSerbinario\Models\TipoCrud');
    }

    public function aplicacao()
    {
        return $this->belongsTo('SCSerbinario\Models\Aplicacao', 'id');
    }




}
