<?php

namespace Serbinario\Models;

use Illuminate\Database\Eloquent\Model;

class ClienteFornecedor extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'clientes_fornecedores';

    protected $fillable = [
        'nome_clientes_fornecedores',
        'tipo_cliente_tipos_cadastros_id',
        'tipo_cliente_tipos_clientes_id',
        'end_clientes_fornecedores',
        'numero_clientes_fornecedores',
        'complemento_clientes_fornecedores',
        'bairro_clientes_fornecedores',
        'cep_clientes_fornecedores',
        'municipio_municipios_id',
        'uf_ufs_id',
        'email_clientes_fornecedores',
        'site_clientes_fornecedores',
        'cpf_cnpj_clientes_fornecedores',
        'rg_clientes_fornecedores',
        'inscricao_estadual_clientes_fornecedores',
        'inscricao_municipal_clientes_fornecedores',
        'ativo_clientes_fornecedores',
        'codigo_clientes_fornecedores',
        'data_cadastro_clientes_fornecedores',
        'obs_clientes_fornecedores',

    ];


    public function uf()
    {
        return $this->belongsTo('Serbinario\Models\Uf');
    }

    public function municipio()
    {
        return $this->belongsTo('Serbinario\Models\Municipio');
    }

    public function tipocadastro()
    {
        return $this->belongsTo('Serbinario\Models\TipoCadastro');
    }

    public function tipocliente()
    {
        return $this->belongsTo('Serbinario\Models\TipoCliente');
    }
}