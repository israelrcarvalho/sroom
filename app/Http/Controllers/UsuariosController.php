<?php

namespace IrcScheduledRoom\Http\Controllers;
use Illuminate\Http\Request;
use IrcScheduledRoom\Models\Role;
use IrcScheduledRoom\Models\Usuario;
use Validator;

class UsuariosController extends CrudController {

    protected $model = '\IrcScheduledRoom\Models\Usuario';
    protected $path = 'usuarios';

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    
    public function index()
    {
        $objModel = Usuario::orderBy('id', 'desc')->paginate(100);
        return view($this->path . '.index', ['objModel' => $objModel]);
    }

    public function store(Request $request)
    {
        $dadosForm = $request->all();

        $rules = [
            'name' => 'required|min:4',
            'email' => 'required',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|min:6'
        ];

        $messages = [
            'name.required' => 'O campo NOME é obrigatório.',
            'name.min' => 'O campo NOME deve ter pelo menos :min caracteres.',
            'email.required' => 'O campo E-MAIL é obrigatório.',
            'password.required' => 'O campo SENHA é obrigatório.',
            'password_confirmation.required' => 'O campo CONFIRMAR SENHA é obrigatório.',
            'password.min' => 'O campo SENHA deve ter pelo menos :min caracteres.'
        ];
        $validator = Validator::make($dadosForm,$rules,$messages );

        if($validator->fails()){
            return redirect()->route($this->path . '.create')
                ->withErrors($validator)
                ->withInput();
        }
        
        $request['password'] = bcrypt($request['password']);
        
        $objUsuario = $this->getModel()->create($request->all());

        $objUsuario->syncGroups($request->get('roles',[]));
                
        return redirect()
            ->route($this->path .'.index')
            ->withSuccess('Salvo com sucesso');

    }
    
    public function update(Request $request, $id)
    {
        $dadosForm = $request->all();
        $rules = [
            'name' => 'required|min:4',
            'email' => 'required',
            'password' => 'min:6',
            'password_confirmation' => 'min:6'
        ];

        $messages = [
            'name.required' => 'O campo NOME é obrigatório.',
            'name.min' => 'O campo NOME deve ter pelo menos :min caracteres.',
            'email.required' => 'O campo E-MAIL é obrigatório.',
            'password.min' => 'O campo SENHA deve ter pelo menos :min caracteres.',
            'password_confirmation.min' => 'O campo CONFIRMAR SENHA está menor que o permitido.',
        ];
        
        $validator = Validator::make($dadosForm,$rules,$messages );
        
        
        if($validator->fails()){
            return redirect(url() . "/usuarios/$id/edit")
                ->withErrors($validator)
                ->withInput();
        }

        $objUsuario = $this->getModel()->findOrFail($id);
        
        if($request->password != $request->password_confirmation):
            return back()->withErrors('Senhas diferentes');
        endif;        

                
        if(!empty($request['password'])):
            $request['password'] = bcrypt($request['password']);
        else:
            unset($request['password']);
        endif;
        
        $objUsuario->fill($request->all());
        $objUsuario->save();

        $objUsuario->syncGroups($request->get('roles',[]));

        return redirect()
            ->route($this->path .'.index')
            ->withSuccess('Registro atualizado com sucesso');
    }


    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id) {

        $objModel = $this->getModel()->find($id);
        $allRoles = Role::all()->lists('name','id');

        return view($this->path . '.edit', [

                'objModel' => $objModel,
                'allRoles' => $allRoles,
                'roles' => $objModel->UserGroups->lists('name')->all()
            ]
        );
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create() {

        return view($this->path . '.create', [
            'objModel' => $this->getModel(),
            'allRoles' => Role::all()->lists('name','id'),
            'roles' => $this->getModel()->UserGroups->lists('name')->all()
        ]);
    }

}
