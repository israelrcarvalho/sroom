<?php

namespace IrcScheduledRoom\Http\Controllers;

use IrcScheduledRoom\Http\Controllers\CrudController;

use Illuminate\Http\Request;

use Validator;

use IrcScheduledRoom\Models\Perfil;

use Illuminate\Support\Facades\Input;


class PerfilController extends CrudController {

    protected $model = '\IrcScheduledRoom\Models\Perfil';
    protected $path = 'perfil';
        
    private $perfil;
    
    public function __construct(Perfil $perfil) {
        
        $this->middleware('auth');        
        $this->perfil = $perfil;
        
    }
    
    public function update(Request $request, $id)
    {
        
        $dadosForm = $request->all();
        $rules = [
            'password' => 'required|min:6',
            'password_confirmation' => 'required|min:6'
        ];

        $messages = [
            'password.required' => 'O campo SENHA é obrigatório.',
            'password_confirmation.required' => 'O campo CONFIRMAR SENHA é obrigatório.',
            'password.min' => 'O campo NOME deve ter pelo menos :min caracteres.'
        ];
        $validator = Validator::make($dadosForm,$rules,$messages );
        
        
        if($validator->fails()){
            return redirect(url() . "/perfil/$id/edit")
                ->withErrors($validator)
                ->withInput();
        }
        
        $objperfil = $this->getModel()->findOrFail($id);
    
        if($request->password != $request->password_confirmation):
            return back()->withErrors('Senhas diferentes');
        endif;

        $objperfil->fill($request->all());
        $objperfil['password'] = bcrypt($request['password']);
        
        $objperfil->save();

        return redirect('eventos/index');
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
    
    public function show($id) {        
        
        $minhasImagens = glob(public_path() . "/imagens-perfil/*.*");
        
        $objModel = $this->getModel()->find($id);
        return view($this->path . '.show', ['p' => $objModel, 'minhasImagens' => $minhasImagens]);
    }
    
    public function updateImagem(Request $request, $id)
    {
        
        $dadosForm = $request->all();
        $rules = [
            'imagem' => 'required|mimes:jpeg,png'
        ];

        $messages = [
            'imagem.required' => 'É necessário escolher uma IMAGEM pra alterar.',
            'imagem.mimes' => 'O arquivo selecionado não é um arquivo de imagem válido.'
        ];
        $validator = Validator::make($dadosForm,$rules,$messages );
        
        
        if($validator->fails()){
            return redirect(url() . "/perfil/$id/show")
                ->withErrors($validator)
                ->withInput();
        }
        
        $nomeImagem = $request->id;
                
        if (Input::file('imagem')) {
            $imagem = Input::file('imagem');
            $imagem->move(public_path() . '/imagens-perfil', $nomeImagem . '.' . $imagem->getClientOriginalExtension());
        }


        $objperfil = $this->getModel()->findOrFail($id);
    
        $objperfil->fill($request->all());
        $objperfil['imagem'] = $nomeImagem . '.' . $imagem->getClientOriginalExtension();
        
        $objperfil->update();

        return redirect(url() . "/perfil/$id/show");
    }  
    
}
