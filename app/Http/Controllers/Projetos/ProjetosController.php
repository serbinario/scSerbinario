<?php

namespace SCSerbinario\Http\Controllers\Projetos;

use SCSerbinario\Http\Controllers\Controller;
use SCSerbinario\Http\Requests\ProjetosRequest;
use SCSerbinario\Models\Projetos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ProjetosController extends Controller
{
    /**
     * @var Projetos
     */
    private $projetos;

    public function __construct(Projetos $projetos){

        $this->projetos = $projetos;
    }
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {

        $projetos = $this->projetos->all();
        //dd($projetos);
        return view('Projetos.index', compact('projetos'));
        //return 'oi';

    }

    public function create()
    {
        return view('Projetos.create');
    }

    /**
     * @param Request $request
     * @return string
     */
    public function store(ProjetosRequest $request)
    {
        $this->projetos->create($request->all());
        return redirect()->route('projetos.index');
    }

    public function edit($id)
    {

        $projetos = $this->projetos->find($id);
        return view('Projetos.edit', compact('projetos'));
    }

    public function update($id, ProjetosRequest $request)
    {

        /** @var TYPE_NAME $this */
        $this->projetos->find($id)->update($request->all());
        return redirect()->route('projetos.index');
    }

    public function destroy($id)
    {
        $this->projetos->find($id)->delete();
        return redirect()->route('projetos.index');
    }



}
