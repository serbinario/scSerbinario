<?php

namespace SCSerbinario\Http\Controllers\Aplicacoes;

use Illuminate\Http\Request;
use SCSerbinario\Http\Requests;
use SCSerbinario\Http\Controllers\Controller;
use SCSerbinario\Models\Aplicacao;
use SCSerbinario\Models\Operacao;
use SCSerbinario\Models\Projetos;

class AplicacoesController extends Controller
{

    /**
     * @var Aplicacoes
     */
    private $aplicacao;
    /**
     * @var Projetos
     */
    private $projetos;
    /**
     * @var Operacao
     */
    private $operacao;

    public function __construct(Aplicacao $aplicacao, Projetos $projetos, Operacao $operacao)
    {

        $this->aplicacao = $aplicacao;
        $this->projetos = $projetos;
        $this->operacao = $operacao;
    }

    public function index()
    {
       // $operacao = $this->operacao->find(1)->tipo_crud;

        $aplicacoes = $this->aplicacao->all();
        return view('Aplicacoes.index', compact('aplicacoes'));
    }

    public function create()
    {
        $projetos = $this->projetos->all()->lists('nome_projeto', 'id');

        return view('Aplicacoes.create', compact('projetos'));
    }

    public function store(Request $request)
    {
        $this->aplicacao->create($request->all());
        return redirect()->route('aplicacoes.index');
    }

    public function edit($id)
    {
        $projetos = $this->projetos->all()->lists('nome_projeto', 'id');
        //dd($projetos);
        $aplicacoes = $this->aplicacao->find($id);

        return view('Aplicacoes.edit', compact('aplicacoes', 'projetos'));
    }

    public function update($id, Request $request)
    {

        /** @var TYPE_NAME $this */
        //dd($request->all());
        $this->aplicacao->find($id)->update($request->all());
        return redirect()->route('aplicacoes.index');
    }

    public function destroy($id)
    {
        //$this->projetos->find($id)->delete();
        //return redirect()->route('projetos.index');
    }


}
