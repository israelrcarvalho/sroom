<?php

namespace IrcScheduledRoom\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use IrcScheduledRoom\Http\Requests;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $rr = $this->relEventosPorRecursos();
       $status = DB::table('evento_periodo')->select(DB::raw('COUNT(STATUS) total, STATUS'))->groupBy('STATUS')->get();


        $adiado         = 0;
        $antecipado     = 0;
        $cancelado      = 0;
        $realizado      = 0;
        $agendado       = 0;
        $transferido    = 0;
        $indeferido     = 0;
        $solicitado     = 0;
        $aguardandoAutorizacao    = 0;

        foreach($status as $v){


            if($v->STATUS == 1 ){$adiado = $v->total ;}
            if($v->STATUS == 2 ){$antecipado = $v->total ;}
            if($v->STATUS == 3 ){$cancelado = $v->total ;}
            if($v->STATUS == 4 ){$realizado = $v->total ;}
            if($v->STATUS == 5 ){$agendado = $v->total ;}
            if($v->STATUS == 6 ){$transferido = $v->total ;}
            if($v->STATUS == 7 ){$indeferido = $v->total ;}
            if($v->STATUS == 8 ){$solicitado = $v->total ;}
            if($v->STATUS == 9 ){$aguardandoAutorizacao = $v->total ;}

        }

        return view('/home', [
            'solicitado' => $solicitado,
            'adiado' => $adiado,
            'antecipado' => $antecipado,
            'cancelado' => $cancelado,
            'concluido' => $realizado,
            'agendado' => $agendado,
            'recursos' =>$rr,
            'atenSindMes' => $this->relAtendimentoASindicatosPormes(),
            'graficoAtendimentoPorIntituicao'=>$this->graficoAtendimentoPorIntituicao(),
            'graficoPorStatusNoMes' =>$this->graficoPorStatusNoMes(),
          //  'drill'=>$this->relAtendimentoDrillDrown(),
            'atenSindMesEstatusCancelado'=>$this->relAtendimentoASindicatosPormesEstatus(3),
            'atenSindMesEstatusAguardando' =>$this->relAtendimentoASindicatosPormesEstatus(8),
            'atenSindMesEstatusAgendado' =>$this->relAtendimentoASindicatosPormesEstatus(5)

        ]);
    }


    public function relEventosPorRecursos(){

        $eventoRecurso = DB::table('evento_recurso as er')
            ->select(DB::raw('COUNT(evento_id) total, r.nome'))->groupBy('recurso_id')
            ->join('recursos as r','r.id','=','er.recurso_id')->get();

       $erAux = array();
        foreach($eventoRecurso as $v){
             $erAux[$v->nome] = $v->total;
        }

        return $erAux ;

    }

    public function relAtendimentoASindicatosPormes(){

                                    DB::statement("SET lc_time_names = 'pt_BR'");
        $relAtenASindicatosPormes = DB::table('atend_sindicato as e')->get();
        $erAuxSind = null;
        foreach($relAtenASindicatosPormes as $v){
            $erAuxSind.= "['".$v->mes."',".$v->totalMes."],";
        }
        return $erAuxSind ;
    }

//-----
    /**
     * Grafico atendimento por instituição
     * @return mixed
     */
    public function graficoAtendimentoPorIntituicao(){

        DB::statement("SET lc_time_names = 'pt_BR'");
        $mesAtual = date('m');
        $anoAtual = date('Y');

        $atendimento = DB::table('atend_por_inst as atendimento')
            ->where('atendimento.ano','=',"{$anoAtual}")
            ->where('atendimento.mes','=',"{$mesAtual}")
            ->get();
                $auxInsti = null;
        foreach($atendimento as $a){
                $instNo = removeRetorno(iRcGetSysVal_('TIPO_UNIDADE',trim($a->instituicao)));
                $auxInsti .= "['{$instNo}',".$a->atendimentos."],";
        }
        return $auxInsti ;
    }


    /**
     * Gera gráfico por status no mês atual
     */
    public function graficoPorStatusNoMes(){

        $atendimento = DB::table('grafico_por_status_no_mes')->get();
        $result = null;
        foreach($atendimento as $a){
            $instNo = removeRetorno(iRcGetSysVal_('STATUS_EVENTO',trim($a->status)));
            $result .= "['{$instNo}',".$a->total."],";
        }
        return $result ;
    }




    public function relAtendimentoDrillDrown_(){

        DB::statement("SET lc_time_names = 'pt_BR'");
        $relAtenASindicatosPormes = DB::table('atend_sindicato as e')->get();
        $erAuxSind = null;

        foreach($relAtenASindicatosPormes as $v){

            $erAuxSind[] = "{name: '$v->mes'";
            $erAuxSind[] = "y: $v->totalMes";
            $erAuxSind[] = "drilldown: '$v->nmes'}";
        }
        $retorno = implode(",", $erAuxSind);
        return $retorno ;
    }


/*
    public function relAtendimentoDrillDrown(){
                                    DB::statement("SET lc_time_names = 'pt_BR'");
        $relAtenASindDrill = DB::table('atendsindagrupadoporsindicato as ep')
            ->where('ep.ano','=','2016')
            ->where('ep.nmes','=','4')
            ->get();
        return $relAtenASindDrill;
    }
*/


    public function relAtendimentoASindicatosPormesEstatus($tipo){

        DB::statement("SET lc_time_names = 'pt_BR'");
        $relAtenASindicatosPormes = DB::table('graf_sindicato as e')
            ->select(DB::raw('COUNT(mes) AS total, e.status'))->groupBy('e.mes')
            ->where('e.tipo','=','508')
            ->where('e.status','=',$tipo)
            ->get();

        /*
        echo "<pre>";
        print_r($relAtenASindicatosPormes);
        exit;
        */


        $erAuxSind = null;
        foreach($relAtenASindicatosPormes as $v){
            //$erAuxSind[$v->mes] = $v->totalMes;
            $erAuxSind.= "['".$v->status."',".$v->total."],";
            // $erAuxSind['mes'] = $v->mes;
        }

        return $erAuxSind ;
    }
}
