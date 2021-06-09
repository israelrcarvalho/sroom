<?php

namespace IrcScheduledRoom\Http\Controllers;

use IrcScheduledRoom\Http\Controllers\CrudController;

use IrcScheduledRoom\Jobs\EventoFormFields;
use Illuminate\Http\Request;
use IrcScheduledRoom\Models\TipoEspaco;

use Validator;

class TiposEspacoController extends CrudController {

    protected $model = '\IrcScheduledRoom\Models\TipoEspaco';
    protected $path = 'tiposEspaco';
        
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function store(Request $request)
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
    
    public function edit($id) {
        
        $objModel = $this->getModel()->find($id);
       // $objModel = TipoEspaco::find($id);
        return view($this->path . '.edit', ['objModel' => $objModel]);
        
        return view($this->path . '.edit', [
                'objModel' => $objModel
            ]
        );
    }

}
