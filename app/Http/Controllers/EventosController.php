<?php

namespace IrcScheduledRoom\Http\Controllers;

use Carbon\Carbon;

use Illuminate\Http\Request;
use Input;

use IrcScheduledRoom\Jobs\EventoFormFields;
use IrcScheduledRoom\Models\Espaco;
use IrcScheduledRoom\Models\Evento;
use IrcScheduledRoom\Models\Nivel;
use IrcScheduledRoom\Models\Periodo;
use IrcScheduledRoom\Models\Recurso;
use IrcScheduledRoom\Models\StatusEvento;
use IrcScheduledRoom\Models\Unidade;
use Validator;
use Mail;
use DB;
use Route;

use Yajra\Datatables\Datatables;


class EventosController extends CrudController
{
    protected $model = '\IrcScheduledRoom\Models\Evento';
    protected $path = 'eventos';
    protected $params;

    public function __construct()
    {
        // $this->middleware('auth');
        $this->params = Route::current()->getParameter('tab');
    }
//----

    public function basicData()
    {
        $objModel = StatusEvento::orderBy('dataevento', 'desc');
        return Datatables::of($objModel)->make(true);
    }

//----

    public function index()
    {
        $query = Input::get('query');
        $status = Input::get('status');
        $data_i = Input::get('data_i');
        $data_f = Input::get('data_f');
        $espaco = Input::get('espaco_id');
        $tipo_pb = Input::get('tipo_pb');
        return view($this->path . '.index', compact('listaSalas', 'status', 'tipo_pb', 'data_i', 'data_f', 'espaco'));
    }

    public function listAllEvents()
    {
        $objModel = StatusEvento::orderBy('id_linha', 'desc')->paginate(5);
        return view($this->path . '.lista-eventos-solicitados', ['objModel' => $objModel]);
    }

    /**
     * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listEventsByStatus()
    {
        try {

            // muda o status dos eventos agendados para realizado
            DB::table('evento_periodo')->where('STATUS','=', 5)
                ->whereRaw('DATE(dt_realizacao) < CURDATE()')
                ->update(['STATUS' => 4]);
            // ------------------------------------------------- --
            $query = Input::get('query');
            $status = Input::get('status');
            $data_i = Input::get('data_i');
            $data_f = Input::get('data_f');
            $espaco = Input::get('espaco_id');
            $unidade = Input::get('unidade_id');
            $tipo_pb = Input::get('tipo_pb');

            // ------------------------------------------------- --

            $objModelx = StatusEvento::orderBy('dataevento', 'desc');

            if (!empty($status)) {
                $objModelx->whereRaw("(pstatus = '$status')");
            }

            if ($query) {
                $objModelx->whereRaw("(nome_evento LIKE '%$query%' OR espaco_nome LIKE '%$query%')");
            }
            if ($data_i) {
                $auxData_i = Carbon::parse(Input::get('data_i'))->format('Y-m-d');
                $objModelx->whereRaw("DATE(dataevento) >= '$auxData_i'");
            } else {
                $auxData_i = Carbon::now()->format('Y-m-d');
                $objModelx->whereRaw("DATE(dataevento) = '$auxData_i'");
            }

            if ($data_f) {
                $auxData_f = Carbon::parse(Input::get('data_f'))->format('Y-m-d');
                $objModelx->whereRaw("DATE(dataevento) <= '$auxData_f'");
            } else {
                $auxData_f = Carbon::now()->format('Y-m-d');
                $objModelx->whereRaw("DATE(dataevento) = '$auxData_f'");
            }

            if ($espaco){
                $espaco = join(',', $espaco);
                $objModelx->whereRaw("espaco_id in($espaco)");
            }
            if ($unidade) {
                $unidade = join(',', $unidade);
                $objModelx->whereRaw("unidade_id in($unidade)");
            }
            if ($tipo_pb) {
                $tipo_pb = join(',', $tipo_pb);
                $objModelx->whereRaw("tipo_pb in ($tipo_pb)");

            } else{
                $objModelx->whereRaw("tipo_pb in (0,1,2)");
            }

                $objModel = $objModelx->get();
               // $objModel = $objModelx->toSql();
            // dd($objModel);


            $listaSalas = Espaco::listEspacoGroupByLocal();
            $listaUnidades = Unidade::listaUnidadeGroupByTipo();

            return view('eventos.lista-eventos-solicitados', compact('objModel', 'listaSalas', 'status', 'tipo_pb', 'data_i', 'data_f', 'espaco','unidade','listaUnidades'));

        } catch (\Illuminate\Database\QueryException $e) {

            $tt = $e->getMessage() . "<hr />" . $e->getCode();
            return redirect('/dberros')->withErrors($tt);
        }

    }


    //----
    public function rel01(){

        // $auxObjModel = $this->getModel()->query();
        $auxObjModel = Periodo::query();

        $query = Input::get('query');
        $status = Input::get('status');
        $data_i = Input::get('data_i');
        $data_f = Input::get('data_f');
        $espaco = Input::get('espaco_id');
        $unidade = Input::get('unidade_id');
        $tipo_pb = Input::get('tipo_pb');

        if ($data_i) {
            $auxData_i = Carbon::parse(Input::get('data_i'))->format('Y-m-d');
            $auxObjModel->whereRaw("DATE(dt_realizacao) >= '$auxData_i'");
        } else {
            $auxData_i = Carbon::now()->format('Y-m-d');
            $auxObjModel->whereRaw("DATE(dt_realizacao) = '$auxData_i'");
        }

        if ($data_f) {
            $auxData_f = Carbon::parse(Input::get('data_f'))->format('Y-m-d');
            $auxObjModel->whereRaw("DATE(dt_realizacao) <= '$auxData_f'");
        } else {
            $auxData_f = Carbon::now()->format('Y-m-d');
            $auxObjModel->whereRaw("DATE(dt_realizacao) = '$auxData_f'");
        }

        if ($espaco){
            $espaco = join(',', $espaco);
            $auxObjModel->whereRaw("espaco_id in($espaco)");
        }

        if ($unidade) {
            $auxObjModel->whereHas('eventoPeriodo', function($q) use ($unidade) {
                $q->whereIn('unidade_id',$unidade);
            });
        }
        if (!empty($status)) {
            $auxObjModel->where('status',$status);
        }

        if ($tipo_pb) {
            $auxObjModel->whereHas('eventoPeriodo', function($q) use ($tipo_pb) {
                $q->whereIn('tipo_pb',$tipo_pb);
            });

        } else{
            //$auxObjModel->whereRaw("tipo_pb in (0,1,2)");
            $auxObjModel->whereHas('eventoPeriodo', function($q) use ($tipo_pb) {
                $q->whereIn('tipo_pb',array(0,1,2));
            });
        }

        $listaSalas = Espaco::listEspacoGroupByLocal();
        $listaUnidades = Unidade::listaUnidadeGroupByTipo();

        // $auxObjModel->where('evento_id','13527');

        //$objModel = $auxObjModel->paginate(50);
        $auxObjModel->orderBy('dt_realizacao','asc');
        // $objModel = $auxObjModel->toSql();
        $objModel = $auxObjModel->get();

         // dd($objModel);

        return view('eventos.rel-01', compact('objModel', 'listaSalas', 'status', 'tipo_pb', 'data_i', 'data_f', 'espaco','unidade','listaUnidades'));
    }


    //---
    public function create()
    {
        return view($this->path . '.create', $this->dispatch(new EventoFormFields()));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function formSolicitacao()
    {
        $objModel = $this->dispatch(new EventoFormFields());

        return view('front-end/form-solicitacao', $objModel);

    }

    /*

    public function store(Request $request)
    {
        $dadosForm = $request->all();

        $rules = [
            'nome' => 'required|min:4',
            'empresa_solicitante' => 'required',
            'fone_solicitante' => 'required',
            'dt_realizar_inicio' => 'required',
            'dt_realizar_fim' => 'required',
            'h_inicio' => 'required',
            'h_fim' => 'required',
            'fone_solicitante' => 'required',
            'email_solicitante' => 'required|email',
            'tipo_evento'=>'required',
            'diasSelecionados'=>'required',
            'unidade_id'=>'required',
            'magnitude'=>'required'
        ];

       $messages = [ 'required' => 'O campo :attribute é obrigatório.'];

        $validator = Validator::make($dadosForm, $rules, $messages);

        if ($validator->fails()) {
            return redirect()
                ->route($this->path . '.create')
                ->withErrors($validator)
                ->withInput();
        }

        $request['pago'] = $request->input('pago') == 'on' ? 1 : 0;
        $request['publicado'] = $request->input('publicado') == 'on' ? 1 : 0;
        $request['externo'] = $request->input('externo') == 'on' ? 1 : 0;

        $dadosForm['dt_realizar_inicio'] = dataPTbrToDb($request->input('dt_realizar_inicio'));
        $dadosForm['dt_realizar_fim'] = dataPTbrToDb($request->input('dt_realizar_fim'));

        $dadosForm['h_inicio'] = $request->input('h_inicio');
        $dadosForm['h_fim'] = $request->input('h_fim');

        $dadosForm['dt_solicitacao'] = date('Y-m-d');

        // ---------------------------------------------------------

        $diasSelStr = implode(';',$dadosForm['diasSelecionados']);
        $diasSelecionados = $dadosForm['diasSelecionados'];
        unset($dadosForm['diasSelecionados']);
        $dadosForm['diasSelecionados'] = $diasSelStr;

        if($dadosForm['tipo_evento'] > 0){
           $dadosForm['tipo_evento'] = $dadosForm['tipo_evento'] ;
        } else {
            unset($dadosForm['tipo_evento']);
        }
        // ---------------------------------------------------------
        $objEvento = Evento::create($dadosForm);
        $objEvento->syncRecursos($request->get('recursos', []));

        $objPeriodo = [
            'evento_id' => $objEvento->id,
            'dt_realizacao' => $objEvento->dt_realizar_inicio,
            'hora_inicio' => $objEvento->h_inicio,
            'hora_fim' => $objEvento->h_fim,
            'status' => 8
        ];

        $qtdDias = totalDias($objEvento->dt_realizar_inicio, $objEvento->dt_realizar_fim);

        for ($i = 0; $i <= $qtdDias ; $i++) {

            $diaInicio = $objEvento->dt_realizar_inicio;
            $objPeriodo['dt_realizacao'] = adicionaDia($diaInicio, $i);
            $diaDaSemana = Carbon::parse($objPeriodo['dt_realizacao'])->format('w');

            if (in_array($diaDaSemana, $diasSelecionados)) {
                Periodo::create($objPeriodo);
            }

        }
// ----
        $link = route('eventos.show', ['id' => $objEvento->id]);
        $auxEmail = strlen(trim($request->email_solicitante)) > 8 ? explode(",", $request->email_solicitante) : explode(",","eventos@sfiec.org.br");

        $input = [
            'nome' => $request->nome ,
            'tipo_evento' => $request->tipo_evento,
            'empresa_solicitante' => $request->empresa_solicitante,
            'unidade' => $objEvento->getUnidadeById($request->unidade_id)->nome,
            'fone_solicitante' => $request->fone_solicitante,
            'email_solicitante' => $auxEmail,
            'num_participantes' => $request->num_participantes,
            'layout_espaco' => $request->layout_espaco,
            'nomeDoEspaco' => 'Aguardando analise',
            'dataDoEvento' => '<b>Data:</b>'.$request->dt_realizar_inicio.' - '. $request->dt_realizar_fim . '<br /><b>Horário:</b>'.$request->h_inicio .' às '.$request->h_fim,
            'msg' => 'Aguardando analise',
            'observacao' => $request->obs,
            'recursos'=> $request->get('recursos')
        ];

        // EMAIL PARA A GECEV
         Mail::send("front-end.template-gecev", ["input" => $input, 'link'=>$link], function ($mail) use ($input){
            $mail->from('sroom@sfiec.org.br'   , '[GECEV - Scheduled Room]');
            $mail->to('eventos@sfiec.org.br'   , '[GECEV - Scheduled Room]')->subject('[SCHEDULED ROOM] - Solicitação de Espaço');
            $mail->bcc("ircarvalho@sfiec.org.br", $input['empresa_solicitante']);
            $mail->replyTo($input['email_solicitante'], $input['empresa_solicitante']);
        });
// ----
        // email para SOLICITANTE
        Mail::send("front-end.respEmailCliente", ["input" => $input, 'link'=>''], function ($emailCliente) use ($input){
            $emailCliente->from('sroom@sfiec.org.br'     , '[GECEV - Scheduled Room]');
            $emailCliente->to($input['email_solicitante'], "[GECEV - Scheduled Room]")->subject('[SCHEDULED ROOM] - Solicitação de Espaço');
            $emailCliente->replyTo('eventos@sfiec.org.br', '[GECEV - Scheduled Room]');
        });
// ----
        return redirect()->route('eventos.show', ['id' => $objEvento->id])->withSuccess('Salvo com sucesso');
    }

    public function update(Request $request, $id)
    {
        $dadosForm = $request->all();
        unset($dadosForm['diasSelecionados']);

        $dadosForm['vlr_onus'] = reaisParaDecimal($dadosForm['vlr_onus']);

        $rules = [
            'nome' => 'required|min:4',
            'descricao' => 'required',
            'empresa_solicitante' => 'required',
            'fone_solicitante' => 'required',
            'fone_solicitante' => 'required',
            'fone_solicitante' => 'required',
            'email_solicitante' => 'required'
        ];

        $messages = [
            'nome.required' => 'O campo NOME é obrigatório.',
            'nome.min' => 'O campo NOME deve ter pelo menos :min caracteres.',
            'descricao.required' => 'O campo DESCRIÇÃO é obrigatório.',
            'empresa_solicitante.required' => 'O campo NOME DO SOLICITANTE é obrigatório.',
            'fone_solicitante.required' => 'O campo TELEFONE DO SOLICITANTE é obrigatório.',
            'email_solicitante.required' => 'O campo E-MAIL O SOLICITANTE é obrigatório.'
        ];

        $validator = Validator::make($dadosForm, $rules, $messages);

        if ($validator->fails()) {
            return redirect(url() . "/eventos/$id/edit")
                ->withErrors($validator)
                ->withInput();
        }


        $objEvento = $this->getModel()->findOrFail($id);
        // $objEvento->fill($request->all());
        $objEvento->fill($dadosForm);
        $objEvento->pago = $objEvento->pago == 'on' ? 1 : 0;
        $objEvento->publicado = $objEvento->publicado == 'on' ? 1 : 0;
        $objEvento->externo = $objEvento->externo == 'on' ? 1 : 0;

        $objEvento->dt_realizar_inicio = dataPTbrToDb($objEvento->dt_realizar_inicio);
        $objEvento->dt_realizar_fim = dataPTbrToDb($objEvento->dt_realizar_fim);

        unset($objEvento->cadastrado_por);

        $objEvento->save();

        $objEvento->syncRecursos($request->get('recursos', []));
        $objEvento->syncEspacos($request->get('espacos', []));

        return redirect()
            ->route('eventos.show', ['id' => $id])
            ->withSuccess('Registro atualizado com sucesso');

    }

    */

    public function edit($id)
    {
        $objModel = $this->dispatch(new EventoFormFields($id));
        $allRecursos = $objModel['allRecursos'];
        $listaDeUnidade = $objModel['listaDeUnidade'];


       // $id = $objModel['id'];
        $recursos = $objModel['recursos'];
        $espacos = $objModel['espacos'];
        $pago = $objModel['pago'];
        $publicado = $objModel['publicado'];
        $externo = $objModel['externo'];
        $prioridade = $objModel['prioridade'];
        $dt_realizar_inicio = $objModel['dt_realizar_inicio'];
        $dt_realizar_fim = $objModel['dt_realizar_fim'];
        $h_inicio = $objModel['h_inicio'];
        $h_fim = $objModel['h_fim'];

        return view($this->path . '.edit', [
                'objModel' => $objModel,
                'allRecursos' => $allRecursos,
                'allDays' => $objModel['allDays'],
                'listaDeUnidade' => $listaDeUnidade,
                'recursos' => $recursos,
                'espacos' => $espacos,
                'pago' => $pago,
                'publicado' => $publicado,
                'externo' => $externo,
                'prioridade' => $prioridade,
                'dt_realizar_inicio' => $dt_realizar_inicio,
                'dt_realizar_fim' => $dt_realizar_fim,
                'h_inicio' => $h_inicio,
                'h_fim' => $h_fim,
                'id'=>$objModel['id']
                ,'diasSelecionados'=>$objModel['diasSelecionados']
            ]
        );
    }

    public function show($id)
    {
        try {

            $objModel = $this->getModel()->find($id);
            $auxListaDeRecursos = new Recurso();
            $listaDeRecursos = $auxListaDeRecursos->whereIn('tipo_recurso',[1,3,4])->lists('nome','id')->all();
            $allRecursosAlimentacao = Recurso::orderBy('nome','asc')->where('tipo_recurso','2')->lists('nome','id')->all();

            $nomeUnidade = "Não Informado";
            $nomeEmpresa = "Não Informado";

            if($objModel->unidade_id){
               $nomeUnidade = $objModel->unidadeEvento->nome;
               $nomeEmpresa = iRcGetSysVal_('TIPO_UNIDADE',$objModel->unidadeEvento->tipo) ;
            }

            $active = "$('li#periodo').addClass('active'); $('#tab-periodo').addClass('active in');";

            switch ($this->params) {

                case "periodo":
                    $active = "$('li#periodo').addClass('active'); $('#tab-periodo').addClass('active in');";
                    break;

                case "recurso":
                     $active = "$('li#recurso').addClass('active'); $('#tab-recursos').addClass('active in');";
                    break;

                case "nivel":
                    $active = "$('li#nivel').addClass('active'); $('#tab-niveis').addClass('active in');";
                    break;

                case "alimenta":
                    $active = "$('li#alimenta').addClass('active'); $('#tab-alimentacao').addClass('active in');";
                    break;
            }

            // Monta array com datas
            $datas = array();
            foreach($objModel->periodos as $d){
                    $datas[$d->id]= $d->dt_realizacao;
            }
            $datas = array_unique($datas);

            return view(
                $this->path . '.show', [
                    'p' => $objModel,
                    'nomeUnidade' => $nomeUnidade,
                    'nomeEmpresa' => $nomeEmpresa,
                    'listaSalas' => Espaco::listEspacoGroupByLocalDisponivel(),
                    'listaDeRecursos' => $listaDeRecursos,
                    'allRecursosAlimentacao' => $allRecursosAlimentacao,
                    'listaDeUnidade' => Unidade::listaUnidadeGroupByTipoForAlimentation(),
                    'active'=>$active,
                    'calendario'=>$datas,
                    'listaDeNiveis' => Nivel::listaNivelGroupByTipo()
                ]
            );

        } catch (\Illuminate\Database\QueryException $e) {

            $tt = $e->getMessage() . "<hr />" . $e->getCode();
            return redirect('/dberros')->withErrors($tt);
        }
    }

    public function atendimentoSindicatos(Request $request, Evento $mes){

        try{

                //            $meses = array( '01'=>'Janeiro',
                //                            '02'=>'Fevereiro',
                //                            '03'=>'Março'   ,
                //                            '04'=>'Abril'  ,
                //                            '05'=>'Maio'    ,
                //                            '06'=>'Junho',
                //                            '07'=>'Julho',
                //                            '08'=>'Agosto'   ,
                //                            '09'=>'Setembro',
                //                            '10'=>'Outubro',
                //                            '11'=>'Novembro',
                //                            '12'=>'Dezembro'
                //                        );

                            $meses = $mes->getMes();

                //            print_r($meses);
                //            exit;

            $atendimentoSindicatos = StatusEvento::orderBy('dataevento', 'desc')
                ->where('tipo','=','508')
                ->whereRaw("pstatus in(4,5)")
                ->join('unidades as u','u.id','=','unidade_id')
                ->select(DB::raw('u.sigla, COUNT(nome) AS totalMes'))
                ->groupBy('nome');

// ------------------------------------------------------------------------------------
            $atendimentoInstituicoes = StatusEvento::orderBy('dataevento', 'desc')
               // ->whereIn('tipo',['108','208','308','408'])
                ->whereRaw("pstatus in(4,5)")
                ->join('unidades as u','u.id','=','unidade_id')
                ->select(DB::raw('tipo as sigla, COUNT(nome) AS totalMes'))
                ->groupBy('tipo');
// ------------------------------------------------------------------------------------
            $data_i = Input::get('data_i');
            $auxData_i = null ;

            if ($data_i) {
                $auxData_i = substr($data_i,0,2);
                $atendimentoSindicatos->whereRaw("MONTH(dataevento) = '$auxData_i'");
                $atendimentoInstituicoes->whereRaw("MONTH(dataevento) = '$auxData_i'");

            } else {
                $auxData_i = Carbon::now()->format('m');
                $atendimentoSindicatos->whereRaw("MONTH(dataevento) = '$auxData_i'");
                $atendimentoInstituicoes->whereRaw("MONTH(dataevento) = '$auxData_i'");
            }
                $sindicatos = $atendimentoSindicatos->get();
                $instituicoes = $atendimentoInstituicoes->get();

           return view('eventos.atendimento-sindicatos', compact('sindicatos','instituicoes','meses','auxData_i'))->with($request->flash());

        } catch (\Illuminate\Database\QueryException $e) {

            $tt = $e->getMessage() . "<hr />" . $e->getCode();
            return redirect('/dberros')->withErrors($tt);
        }
    }

    // -----

    /**
     * @param Request $request
     * @return mixed
     */

    public function frontend(Request $request)
    {
        $dadosForm = $request->all();

        $rules = [
            'nome' => 'required|min:4',
            'empresa_solicitante' => 'required',
            'fone_solicitante' => 'required',
            'dt_realizar_inicio' => 'required',
            'dt_realizar_fim' => 'required',
            'h_inicio' => 'required',
            'h_fim' => 'required',
            'fone_solicitante' => 'required',
            'email_solicitante' => 'required|email',
            'diasSelecionados'=>'required',
        ];

        $messages = [
            'required' => 'O campo :attribute é obrigatório.',
            'diasSelecionados.required'=>'Selecione o(s) dia(s) da semana que este evento se repetirá'
        ];


        $validator = Validator::make($dadosForm, $rules, $messages);

        if ($validator->fails()) {
            return redirect()
                ->route('form-solicitacao')
                ->withErrors($validator)
                ->withInput();
        }

        $dadosForm['dt_realizar_inicio'] = dataPTbrToDb($request->input('dt_realizar_inicio'));
        $dadosForm['dt_realizar_fim'] = dataPTbrToDb($request->input('dt_realizar_fim'));
        $dadosForm['h_inicio'] = $request->input('h_inicio');
        $dadosForm['h_fim'] = $request->input('h_fim');
        $dadosForm['dt_solicitacao'] = date('Y-m-d');
        // ---------------------------------------------------------
        $diasSelStr = implode(';',$dadosForm['diasSelecionados']);
        $diasSelecionados = $dadosForm['diasSelecionados'];

        unset($dadosForm['diasSelecionados']);
              $dadosForm['diasSelecionados'] = $diasSelStr;

        if($dadosForm['tipo_evento'] > 0){
           $dadosForm['tipo_evento'] = $dadosForm['tipo_evento'] ;
        } else {
            unset($dadosForm['tipo_evento']);
        }
        // ---------------------------------------------------------

        $objEvento = Evento::create($dadosForm);

        $objEvento->syncRecursos($request->get('recursos', []));

        $objPeriodo = [
            'evento_id' => $objEvento->id,
            'dt_realizacao' => $objEvento->dt_realizar_inicio,
            'hora_inicio' => $objEvento->h_inicio,
            'hora_fim' => $objEvento->h_fim,
            'status' => 8
        ];


        $qtdDias = totalDias($objEvento->dt_realizar_inicio, $objEvento->dt_realizar_fim);

        if($qtdDias == 0){

            $textoData = "<b>Data:</b>{$request->dt_realizar_inicio} <br /><b>Horário:</b> {$request->h_inicio} às {$request->h_fim}";
        } else {
            $textoData = "<b>Data:</b>{$request->dt_realizar_inicio} - {$request->dt_realizar_fim} <br /><b>Horário:</b> {$request->h_inicio} às {$request->h_fim}";
        }

        for ($i = 0; $i <= $qtdDias ; $i++) {

            $diaInicio = $objEvento->dt_realizar_inicio;
            $objPeriodo['dt_realizacao'] = adicionaDia($diaInicio, $i);
            $diaDaSemana = Carbon::parse($objPeriodo['dt_realizacao'])->format('w');

            if (in_array($diaDaSemana, $diasSelecionados)) {
                Periodo::create($objPeriodo);
            }

        }

        $link = route('eventos.show', ['id' => $objEvento->id]);
        $auxEmail = strlen(trim($request->email_solicitante)) > 8 ? explode(",", $request->email_solicitante) : explode(",","eventos@sfiec.org.br");

        $input = [
            'nome' => $request->nome ,
            'tipo_evento' => $request->tipo_evento,
            'empresa_solicitante' => $request->empresa_solicitante,
            'unidade' => $objEvento->getUnidadeById($request->unidade_id)->nome,
            'fone_solicitante' => $request->fone_solicitante,
            'email_solicitante' => $auxEmail,
            'num_participantes' => $request->num_participantes,
            'layout_espaco' => $request->layout_espaco,
            'nomeDoEspaco' => 'Aguardando analise',
            'dataDoEvento' => $textoData,
            'msg' => 'Aguardando analise',
            'imagem'=> $request['imagem'],
            'recursos'=> $request->get('recursos')
        ];


        // Email para a GECEV
        Mail::send("front-end.template-gecev", ["input" => $input, 'link'=>$link], function ($mail) use ($input){

            $mail->from('sroom@sfiec.org.br', '[GECEV - Scheduled Room]');
            $mail->to('eventos@sfiec.org.br', '[GECEV - Scheduled Room]')->subject('[SCHEDULED ROOM] - Solicitação de Espaço');
            $mail->replyTo($input['email_solicitante'], $input['empresa_solicitante']);
           // $mail->bcc("ircarvalho@sfiec.org.br", $input['empresa_solicitante']);

            if (array_key_exists("imagem", $input) && !empty($input['imagem'])) {

                $mail->attach($input['imagem']->getRealPath(), array(
                        'as' => 'arquivo.' . $input['imagem']->getClientOriginalExtension(),
                        'mime' => $input['imagem']->getMimeType())
                );
            }
        });

        // Email para O SOLICITANTE
        Mail::send("front-end.respEmailCliente", ["input" => $input], function ($emailCliente) use ($input) {

            $emailCliente->from('eventos@sfiec.org.br', '[GECEV - Scheduled Room]');
            $emailCliente->to($input['email_solicitante'], "[GECEV - Scheduled Room]")->subject('[SCHEDULED ROOM] - Solicitação de Espaço');
            $emailCliente->replyTo('eventos@sfiec.org.br', '[GECEV - Scheduled Room]');
        });

        return redirect('/form-sol')->withSuccess('Solicitação enviada com sucesso');
    }

//-----------


}
