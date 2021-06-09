<?php

namespace IrcScheduledRoom\Http\Controllers;

use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Input;
use IrcScheduledRoom\Models\EventoRecurso;
use IrcScheduledRoom\Models\PeriodoRecurso;
use Validator;

class RecursosController extends CrudController {

    protected $model = '\IrcScheduledRoom\Models\Recurso';
    protected $path = 'recursos';

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function store(Request $request)
    {
        $dadosForm = $request->all();
        $dadosForm['valor'] = reaisParaDecimal($dadosForm['valor']);

        $rules = [
            'nome' => 'required|min:4',
            'sigla' => 'required'
        ];

        $messages = [
            'nome.required' => 'O campo NOME é obrigatório.',
            'nome.min' => 'O campo NOME deve ter pelo menos :min caracteres.',
            'sigla.required' => 'O campo SIGLA é obrigatório.'
        ];

        $validator = Validator::make($dadosForm,$rules,$messages );

        if($validator->fails()){
            return redirect()->route($this->path . '.create')
                ->withErrors($validator)
                ->withInput();
        }
        
        $objRecurso = $this->getModel()->create($request->all());
        
        return redirect()
            ->route($this->path .'.index')
            ->withSuccess('Salvo com sucesso');

    }
    
    public function update(Request $request, $id)
    {
        $dadosForm = $request->all();
        $dadosForm['valor'] = reaisParaDecimal($dadosForm['valor']);


        $rules = [
            'nome' => 'required|min:4',
            'sigla' => 'required'
        ];

        $messages = [
            'nome.required' => 'O campo NOME é obrigatório.',
            'nome.min' => 'O campo NOME deve ter pelo menos :min caracteres.',
            'sigla.required' => 'O campo SIGLA é obrigatório.'
        ];
        
        $validator = Validator::make($dadosForm,$rules,$messages );
        
        
        if($validator->fails()){
            return redirect(url() . "/recursos/$id/edit")
                ->withErrors($validator)
                ->withInput();
        }

        
        $objRecurso = $this->getModel()->findOrFail($id);

        //$objRecurso->fill($request->all());
        $objRecurso->fill($dadosForm);

        $objRecurso->save();

        return redirect()
            ->route($this->path .'.index')
            ->withSuccess('Registro atualizado com sucesso');
    }  
    
    public function edit($id) {

        $objModel = $this->getModel()->find($id);

        if(Gate::denies('edit',$objModel)){
            // abort(403,'Não autorizado');
            return redirect()->back();
        }

        return view($this->path . '.edit', ['objModel' => $objModel]);
    }

    public function updateModal(Request $request, $id) {
        $objModel = EventoRecurso::find($id);
        $idEvento = $objModel['evento_id'];
        $objModel->update($request->all());
        return redirect()->route('eventos.show',['id'=>$idEvento]);
    }

    public function destroyModal($id){

        $objModel = EventoRecurso::find($id);
        $objModel->delete();
        return redirect()->route('eventos.show',['id'=>$objModel->evento_id,'tab'=>'recurso']);
    }

    /**
     * Deleta os recursos de alimentação
     * @param $id - Identifica o registro que será excluído
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyAlimentacaoModal($id){

        $objModel = PeriodoRecurso::find($id);
        $objModel->delete();
        return redirect()->route('eventos.show',['id'=>$objModel->periodosDeste->evento_id,'tab'=>'alimenta']);
    }


    public function storeModal(Request $request)    {

        $objModel = EventoRecurso::create($request->all());
        return redirect()->route('eventos.show',['id'=>$objModel->evento_id,'tab'=>'recurso']);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeModalRecursosAlimentacao(Request $request){

        // $objModel = PeriodoRecurso::create($request->all());
        PeriodoRecurso::create($request->all());
        return redirect()->route('eventos.show',['id'=>$request->evento_id,'tab'=>'alimenta']);
    }

    /**
     * @return mixed
     */
    public function listRecursosAlimentacaoAjax(){

         $unidade  = Input::get('unidade_id');
         $idRecurso  = Input::get('recurso_id');
         $sel = $this->getModel()->listRecursosAlimentacaoAjax($unidade,$idRecurso);
        return Response::json($sel);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function recursoById(){
        $id = Input::get('recurso_id');
        $result = $this->getModel()->recursoById($id);
        return Response::json($result);
    }

}
