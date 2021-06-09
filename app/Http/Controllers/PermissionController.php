<?php

namespace IrcScheduledRoom\Http\Controllers;
use Illuminate\Http\Request;
use IrcScheduledRoom\Models\Permission;

//use Validator;
//use Gate;

class PermissionController extends CrudController {

    protected $model = Permission::class ; // '\IrcScheduledRoom\Models\Permission';
    protected $path = 'permissions';

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function store(Request $request) {

        $this->getModel()->create($request->all());
        return redirect()->route('permission.index');
    }
//    public function index(){
//        if(Gate::denies('view')){
//            abort(403,"sem permissão");
//        }
//    }
}
