<?php

namespace IrcScheduledRoom\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

class UnidadesController extends CrudController {

    protected $model = '\IrcScheduledRoom\Models\Unidade';
    protected $path = 'unidades';
        
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function store(Request $request)
    {
        
        $dadosForm = $request->all();
        $rules = [
            'nome' => 'required|min:6',
            'sigla' => 'required|min:3',
            'tipo' => 'required',
            'razao_social' => 'required|min:4'
        ];

        $messages = [
            'nome.required' => 'O campo NOME é obrigatório.',
            'nome.min' => 'O campo NOME deve ter pelo menos :min caracteres.',
            'sigla.required' => 'O campo SIGLA é obrigatório.',
            'sigla.min' => 'O campo SIGLA deve ter pelo menos :min caracteres.',
            'tipo.required' => 'O campo TIPO é obrigatório.',
            'razao_social.required' => 'O campo RAZÃO SOCIAL é obrigatório.'
        ];
        $validator = Validator::make($dadosForm,$rules,$messages );

        if($validator->fails()){
            return redirect()->route($this->path . '.create')
                ->withErrors($validator)
                ->withInput();
        }
        
        $objTipoEspaco = $this->getModel()->create($request->all());
        
        return redirect()
            ->route($this->path .'.index')
            ->withSuccess('Salvo com sucesso');
        
    }
    
    public function update(Request $request, $id)
    {
        $dadosForm = $request->all();
        $rules = [
            'nome' => 'required|min:4'
        ];

        $messages = [
            'nome.required' => 'O campo NOME é obrigatório.',
            'nome.min' => 'O campo NOME deve ter pelo menos :min caracteres.'
        ];
        $validator = Validator::make($dadosForm,$rules,$messages );
        
        
        if($validator->fails()){
            return redirect(url() . "/tiposEspaco/$id/edit")
                ->withErrors($validator)
                ->withInput();
        }

        
        $objTipoEspaco = $this->getModel()->findOrFail($id);

        $objTipoEspaco->fill($request->all());

        $objTipoEspaco->save();

        return redirect()
            ->route($this->path .'.index')
            ->withSuccess('Registro atualizado com sucesso');
    }


    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
//    public function edit($id) {
//
//        $objModel = $this->getModel()->find($id);
//        return view($this->path . '.edit', ['objModel' => $objModel]);
//
//    }


    public function show($id) {
        $objModel = $this->getModel()->find($id);
        $orcamento = $objModel->orcamentos ;
        return view($this->path . '.show', ['p' => $objModel,'orcamento' => $orcamento]);
    }


    public function index() {

        $objModel = $this->getModel()->orderBy('tipo', 'asc')->orderBy('nome', 'asc')->get();
        return view($this->path . '.index', ['objModel' => $objModel]);
    }

}
