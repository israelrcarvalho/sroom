<?php

namespace IrcScheduledRoom\Http\Controllers;

use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Input;
use IrcScheduledRoom\Models\Espaco;
use IrcScheduledRoom\Models\Evento;
use IrcScheduledRoom\Models\Recurso;
use IrcScheduledRoom\Models\StatusEvento;
use IrcScheduledRoom\Models\TimeSheet;
use IrcScheduledRoom\Models\Unidade;


class RelatoriosController extends Controller
{
    protected $model = '\IrcScheduledRoom\Models\Evento';
    protected $path = 'eventos';

    public function __construct()
    {
        // $this->middleware('auth');
    }


    public function mapaEventosxxxxx()
    {
        try {

            $objRel = StatusEvento::orderBy('dataevento', 'asc');
            $objRel->whereRaw("dataevento = CURDATE() AND tipo_pb = 1");
            $objRel_ = $objRel->get();

            return view('relatorios.relatorio-mapa-de-eventos', compact('objRel_'));

        } catch (\Illuminate\Database\QueryException $e) {

            $tt = $e->getMessage() . "<hr />" . $e->getCode();
            return redirect('/dberros')->withErrors($tt);
        }

    }


    public function mapaEventos_()
    {
        try {

            $query = Input::get('query');
            $status = Input::get('status');
            $data_i = Input::get('data_i');
            $data_f = Input::get('data_f');
            $espaco = Input::get('espaco_id');
            $unidade = Input::get('unidade_id');
            $tipo_pb = Input::get('tipo_pb');

            // ------------------------------------------------- --

            $objModelx = StatusEvento::orderBy('empresa', 'asc');
            //    ->where('tipo_pb','<','2')
          //  ;

            // dd($tipo_pb);

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


            if ($espaco != 'null' && isset($espaco)){
                $objModelx->whereRaw("espaco_id in($espaco)");
            }

            if ($unidade) {
                $objModelx->whereRaw("unidade_id = $unidade");
            }

            if ($tipo_pb != 'null' && isset($tipo_pb)) {
                $objModelx->whereRaw("tipo_pb in ($tipo_pb)");
            } else {
                $objModelx->whereRaw("tipo_pb in (0,1)");
            }

            //  $objModel = $objModelx->paginate(25);
            $objModel = $objModelx->get();

             // $objModel = $objModelx->toSql(); //(30);
              // dd($objModel);

            $listaSalas = Espaco::listEspacoGroupByLocal();
            $listaUnidades = Unidade::listaUnidadeGroupByTipo();

            return view('relatorios.relatorio-mapa-de-eventos', compact('objModel', 'listaSalas', 'status', 'tipo_pb', 'data_i', 'data_f', 'espaco', 'unidade', 'listaUnidades'));

        } catch (\Illuminate\Database\QueryException $e) {

            $tt = $e->getMessage() . "<hr />" . $e->getCode();
            return redirect('/dberros')->withErrors($tt);
        }

    }

    /**
     * Relatorio whats UP
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function whatsUp(){

        try {

            $query = Input::get('query');
            $status = Input::get('status');
            $data_i = Input::get('data_i');
            $data_f = Input::get('data_f');
            $espaco = Input::get('espaco_id');
            $unidade = Input::get('unidade_id');
            $tipo_pb = Input::get('tipo_pb');

            $objRel = StatusEvento::orderBy('dataevento', 'asc');
            $objRel->whereRaw("espaco_id in(66,68,69,74,59,61)");

            // -----------------------------------------------------------------------------------------------
            if ($data_i) {
                $auxData_i = Carbon::parse(Input::get('data_i'))->format('Y-m-d');
                $objRel->whereRaw("DATE(dataevento) >= '$auxData_i'");
            } else {
                $auxData_i = Carbon::now()->format('Y-m-d');
                $objRel->whereRaw("DATE(dataevento) = '$auxData_i'");
            }

            if ($data_f) {
                $auxData_f = Carbon::parse(Input::get('data_f'))->format('Y-m-d');
                $objRel->whereRaw("DATE(dataevento) <= '$auxData_f'");
            } else {
                $auxData_f = Carbon::now()->format('Y-m-d');
                $objRel->whereRaw("DATE(dataevento) = '$auxData_f'");
            }
            // -----------------------------------------------------------------------------------------------

            $objModel = $objRel->get();

           // dd($objModel);
           // exit;
// ---
            $listaSalas = Espaco::listEspacoGroupByLocal();
            $listaUnidades = Unidade::listaUnidadeGroupByTipo();

            return view('relatorios.rel-default', compact('objModel', 'listaSalas', 'status', 'tipo_pb', 'data_i', 'data_f', 'espaco','unidade','listaUnidades'));

        } catch (\Illuminate\Database\QueryException $e) {

            $tt = $e->getMessage() . "<hr />" . $e->getCode();
            return redirect('/dberros')->withErrors($tt);
        }

    }




    public function timeSheet(TimeSheet $objModel, Evento $e, Request $r) {

        $array = $objModel->select('unidade_id', 'nome', 'ano','mes', DB::raw('SUM(quant_nivel) AS snivel'),DB::raw('SUM(esforco) AS esforco'));

        $r->flash();

        $auxAno = Input::get('ano');
        $auxMes = Input::get('mes');

        if($auxMes){
           $array->where('mes',$auxMes);
        }
        else{
            $array->where('mes',Carbon::now()->format('m'));
        }

        if($auxAno){
            $array->where('ano',$auxAno);
        }
        else{
            $array->where('ano',Carbon::now()->format('Y'));
        }

        $ano = $e->getAno() ;
        $mes = $e->getMes() ;


        return view('orcamento.timesheet', ['objModel' => $array->groupBy('unidade_id')->get(), 'ano' => $ano,'mes'=>$mes]);
    }






    public function relPorSala(){

        $query = Input::get('query');
        $status = Input::get('status');
        $data_i = Input::get('data_i');
        $data_f = Input::get('data_f');
        $espaco = Input::get('espaco_id');
        $unidade = Input::get('unidade_id');
        $tipo_pb = Input::get('tipo_pb');

        $objRel = StatusEvento::orderBy('dataevento', 'asc');

        $objRel->whereRaw("espaco_id in(66,68,69,74,59,61)");

        // -----------------------------------------------------------------------------------------------
        if ($data_i) {
            $auxData_i = Carbon::parse(Input::get('data_i'))->format('Y-m-d');
            $objRel->whereRaw("DATE(dataevento) >= '$auxData_i'");
        } else {
            $auxData_i = Carbon::now()->format('Y-m-d');
            $objRel->whereRaw("DATE(dataevento) = '$auxData_i'");
        }

        if ($data_f) {
            $auxData_f = Carbon::parse(Input::get('data_f'))->format('Y-m-d');
            $objRel->whereRaw("DATE(dataevento) <= '$auxData_f'");
        } else {
            $auxData_f = Carbon::now()->format('Y-m-d');
            $objRel->whereRaw("DATE(dataevento) = '$auxData_f'");
        }
        // -----------------------------------------------------------------------------------------------

        $listaSalas = Espaco::listEspacoGroupByLocal();
        $listaUnidades = Unidade::listaUnidadeGroupByTipo();

         $arrSalas = Espaco::orderBy('nome', 'asc')->get();

       // $arrSalas = StatusEvento::orderBy('dataevento', 'asc')->get();

        // return view('relatorios.rel-espaco',compact('arrSalas'));
        return view('relatorios.rel-espaco', compact('arrSalas', 'listaSalas', 'status', 'tipo_pb', 'data_i', 'data_f', 'espaco','unidade','listaUnidades'));
    }
}