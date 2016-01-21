<?php

namespace SCSerbinario\Models;

use Illuminate\Database\Eloquent\Model;

class TipoCrud extends Model
{
    protected $table = 'tipo_crud';

    protected $fillable = [
        'tipo_crud'
    ];

    public function operacao()
    {
        //Um pra muitos
        return $this->hasMany('SCSerbinario\Models\Operacoes');
    }
}
