<?php

namespace IrcScheduledRoom\Http\Controllers;
use Illuminate\Http\Request;
use IrcScheduledRoom\Models\Role;


class RoleController extends CrudController {

    protected $model = '\IrcScheduledRoom\Models\Role';
    protected $path = 'roles';

    private $role ;

    public function __construct(Role $role)
    {
        // $this->middleware('auth');

        $this->role = $role;
    }

    public function permissions($id){

        $role = $this->role->find($id);
        $permissions = $role->permissions;

        return view('teste',compact('role', 'permissions'));
    }


    public function store(Request $request) {

        $this->getModel()->create($request->all());
        return redirect()->route('role.index');
    }

//    public function index(){
//        if(Gate::denies('view')){
//            abort(403,"sem permissão");
//        }
//    }

}
