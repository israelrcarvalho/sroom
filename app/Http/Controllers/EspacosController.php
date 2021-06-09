<?php

namespace IrcScheduledRoom\Http\Controllers;

use Carbon\Carbon;

use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Input;
use IrcScheduledRoom\Jobs\EspacoFormFields;
use IrcScheduledRoom\Models\TipoEspaco;
use Validator;


class EspacosController extends CrudController
{

    protected $model = '\IrcScheduledRoom\Models\Espaco';
    protected $path = 'espacos';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        $objModel = $this->dispatch(new EspacoFormFields());
        return view($this->path . '.create', $objModel);

    }


    public function store(Request $request)
    {

       $dadosForm = $request->all();

        $request['ativa'] = $request->input('ativa') == 'on' ? 1:0;
        $rules = [
            'nome' => 'required|min:4',
            'local' => 'required|min:4',
            'cod' => 'required',
            'capacidade' => 'required',
            'cor' => 'required'
        ];

        $messages = [
            'nome.required' => 'O campo NOME é obrigatório.',
            'nome.min' => 'O campo NOME deve ter :min ou mais caracteres.',
            'local.required' => 'O campo LOCAL é obrigatório.',
            'local.min' => 'O campo LOCAL deve ter :min ou mais caracteres.',
            'cod.required' => 'O campo CÓDIGO é obrigatório.',
            'capacidade.required' => 'O campo CAPACIDADE é obrigatório.'
        ];

        $validator = Validator::make($dadosForm,$rules,$messages );

        if($validator->fails()){
            return redirect()->route($this->path . '.create')
                ->withErrors($validator)
                ->withInput();
        }

        $objEspaco = $this->getModel()->create($request->all());
        $objEspaco->syncRecursos($request->get('recursos', []));

        return redirect()
            ->route('espacos.index')
            ->withSuccess('Registro salvo com sucesso');
    }


    /**
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    // public function updatex(Request $request, $id)
    public function update(Request $request, $id)
    {
        $dadosForm = $request->all();



        $objEspaco = $this->getModel()->findOrFail($id);
        $objEspaco->fill($request->all());
        $objEspaco->ativa = $objEspaco->ativa == 'on' ? 1:0;

        $rules = [
            'nome' => 'required|min:4',
            'local' => 'required|min:4',
            'cod' => 'required',
            'capacidade' => 'required',
            'cor' => 'required'
        ];

        $messages = [
            'nome.required' => 'O campo NOME é obrigatório.',
            'nome.min' => 'O campo NOME deve ter :min ou mais caracteres.',
            'local.required' => 'O campo LOCAL é obrigatório.',
            'local.min' => 'O campo LOCAL deve ter :min ou mais caracteres.',
            'cod.required' => 'O campo CÓDIGO é obrigatório.',
            'capacidade.required' => 'O campo CAPACIDADE é obrigatório.'
        ];
        
        $validator = Validator::make($dadosForm,$rules,$messages );

        if($validator->fails()){
               return redirect(url()."/".$this->path."/".$id."/edit")
                ->withErrors($validator)
                ->withInput();
        }
        $objEspaco->save();

        $objEspaco->syncRecursos($request->get('recursos', []));

        return redirect()
            ->route('espacos.index')
            ->withSuccess('Registro atualizado com sucesso');

    }

    public function edit($id)
    {
        $objModel = $this->dispatch(new EspacoFormFields($id));
        $allRecursos = $objModel['allRecursos'];
        $recursos = $objModel['recursos'];
        $ativa = $objModel['ativa'];
        $listaTipos = TipoEspaco::all()->lists('nome', 'id');

        return view($this->path . '.edit', [
                'objModel' => $objModel,
                'allRecursos' => $allRecursos,
                'recursos' => $recursos,
                'ativa' => $ativa,
                'listTipos' => $listaTipos
            ]
        );
    }


    /**
     * @return mixed
     */
    public function listEspacoGroupByLocalDisponivelAjax(){

        $data  = Carbon::parse(Input::get('data_inicio'))->format('Y-m-d');
        $horaInicio  = Input::get('hora_i');
        $horaFim  = Input::get('hora_f');
        $espacoAtual = (Input::get('espacoAtual') > 0) ? Input::get('espacoAtual') :0 ;

        $sel = $this->getModel()->testeajax($data,$horaInicio,$horaFim,$espacoAtual);

        return Response::json($sel);
    }

}
