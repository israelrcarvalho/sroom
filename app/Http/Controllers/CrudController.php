<?php

namespace IrcScheduledRoom\Http\Controllers;

use Illuminate\Http\Request;

abstract class CrudController extends Controller {

    protected $model_instance;
    protected $rules = [];

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $objModel = $this->getModel()->all();
        return view($this->path . '.index', ['objModel' => $objModel]);
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view($this->path . '.create');
    }
   

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

         $this->getModel()->create($request->all());
         return redirect()->route($this->path . '.index');
    }

    /**
     * Display the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $objModel = $this->getModel()->find($id);
        return view($this->path . '.show', ['p' => $objModel]);
    }

/*
        public function mostra($id){
		$produto = Produto::find($id);
		if(empty($produto)) {
			return "Esse produto não existe";
		}
		return view('produto.detalhes')->with('p', $produto);
	}
 
 */    
    /**
     * Show the form for editing the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        
        $objModel = $this->getModel()->find($id);        
        return view($this->path . '.edit', ['objModel' => $objModel]);
       // return view($this->path . '.edit', compact($objModel));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        $objModel = $this->getModel()->find($id);
        $objModel->update($request->all());
       return redirect($this->path);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        
        $objModel = $this->getModel()->find($id);
        $objModel->delete();
        
        return redirect()->route($this->path . '.index');
       // return redirect('produtos');
    }

    /**
     * @return type
     */
    protected function getModel() {

        if ($this->model_instance === null) {
            $this->model_instance = new $this->model;
        }

        return $this->model_instance;
    }

}
