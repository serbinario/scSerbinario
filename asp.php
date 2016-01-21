<?php

namespace Serbinario\Models;
   
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    protected $table    = 'municipios';
    protected $fillable = [ 
		'nome_municipios',
	];

    
}