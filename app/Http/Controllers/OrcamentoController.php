<?php

namespace IrcScheduledRoom\Http\Controllers;

use IrcScheduledRoom\Http\Requests;
use Illuminate\Http\Request;
use IrcScheduledRoom\Models\Orcamento;
use IrcScheduledRoom\Models\Recurso;
use IrcScheduledRoom\Models\Unidade;
use IrcScheduledRoom\Models\Centro;

class OrcamentoController extends CrudController
{
    protected $model = Orcamento::class;  // '\IrcScheduledRoom\Models\Orcamento';
    protected $path = 'orcamento';


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {

        $objModel = $this->getModel()->all();
        $c = new Centro();
        $r = new Recurso();

        return view($this->path . '.index',
            [
                'listaDeUnidade'=>Unidade::listaUnidadeGroupByTipoForAlimentation(),
                'listaCentros'  =>$c->listCentros(),
                'listaRecursos' =>$r->listRecursoByTipo(array(2)),
                'objModel' => $objModel,
                'listaAno' => $this->getModel()->getAno()

            ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request) {

        $this->getModel()->create($request->all());
        return redirect()->route('lista-orcamento');
    }


}