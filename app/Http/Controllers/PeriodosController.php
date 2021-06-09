<?php

namespace IrcScheduledRoom\Http\Controllers;

use Illuminate\Http\Request;
use IrcScheduledRoom\Http\Requests;
use IrcScheduledRoom\Jobs\PeriodoFormFields;
use IrcScheduledRoom\Models\Espaco;
use IrcScheduledRoom\Models\Periodo;
use IrcScheduledRoom\Models\Evento;

use Mail;

class PeriodosController extends CrudController
{

    protected $model = '\IrcScheduledRoom\Models\Periodo';
    protected $path = 'periodos';
    protected $eventos = 'eventos';


    public function createPar($id)
    {
        $listaSalas = Espaco::all()->lists('nome', 'id');
        return view($this->path . '.create', ['idEvento' => $id, 'listaSalas' => $listaSalas]);
    }

    public function store(Request $request)
    {

        try {

            $request['dt_realizacao'] = dataPTbrToDb($request->input('dt_realizacao'));
            $request['hora_inicio'] = $request->input('hora_inicio');
            $request['hora_fim'] = $request->input('hora_fim');
            $idEvento = $request->input('evento_id');

            $result = $this->getModel()->create($request->all());
            $auxEvento = Evento::find($request->evento_id);

            // ----------------------------------------------------------------------------------
            $dataPorExtenso = dataPorExtenso($request->dt_realizacao);
            $nomeDoEspaco = $request->espaco_id > 0 ? $this->getModel()->nomeDoespacoPorId($request->espaco_id)->nome . ' - '.$this->getModel()->nomeDoespacoPorId($request->espaco_id)->local : 'Aguardando análise';
            $dataDoEvento = "<b>Data:</b>{$dataPorExtenso} <br /><b>Horário:</b>{$request->hora_inicio} às {$request->hora_fim}";
            $msg = "Evento " . iRcGetSysVal_('STATUS_EVENTO', $request->status);
            // ----------------------------------------------------------------------------------
            $auxR = array();
            foreach($result->eventoPeriodo->recursos as $r){
                $auxR[]= $r->nome;
            }
            // ----------------------------------------------------------------------------------

            $auxEmail = strlen(trim($auxEvento->email_solicitante)) > 8 ? explode(",", $auxEvento->email_solicitante) : explode(",","eventos@sfiec.org.br");

            $input = [
                'nome' => $auxEvento->nome,
                'tipo_evento' => 1,
                'empresa_solicitante' => $auxEvento->empresa_solicitante,
                'unidade' => iRcGetSysVal_('TIPO_UNIDADE',$result->eventoPeriodo->unidadeEvento->tipo).' / '. $result->eventoPeriodo->unidadeEvento->nome,
                'fone_solicitante' => $auxEvento->fone_solicitante,
                'email_solicitante' => $auxEmail,
                'num_participantes' => $auxEvento->num_participantes,
                'layout_espaco' => $auxEvento->layout_espaco,
                'nomeDoEspaco' => $nomeDoEspaco,
                'dataDoEvento' => $dataDoEvento,
                'observacao' => $auxEvento->obs,
                'msg' => $msg,
                'recursos'=> $auxR
            ];

            Mail::send("front-end.template-gecev", ["input" => $input, 'link'=>''], function ($mail) use ($input){

                $mail->from('sroom@sfiec.org.br', '[GECEV - Scheduled Room]');
                $mail->to('eventos@sfiec.org.br', '[GECEV - Scheduled Room]')->subject('Solicitação de Espaço');
                $mail->replyTo($input['email_solicitante'], $input['empresa_solicitante']);
                $mail->BCC('IRCARVALHO@sfiec.org.br', '[GECEV - Scheduled Room]');

            });

            Mail::send("front-end.respEmailCliente", ["input" => $input], function ($emailCliente) use ($input) {

                    $emailCliente->from('eventos@sfiec.org.br', '[GECEV - Scheduled Room]');
                    $emailCliente->to($input['email_solicitante'], '[GECEV - Scheduled Room]');
                    $emailCliente->subject('[SCHEDULED ROOM] - Solicitação de Espaço');
                    $emailCliente->replyTo('eventos@sfiec.org.br', 'Eventos');

            });

            return redirect($this->eventos . '/' . $idEvento . '/show');

        } catch (\Illuminate\Database\QueryException $e) {
            $tt = $e->getMessage() . "<hr />" . $e->getCode();
            return redirect('/dberros')->withErrors($tt);
        }

    }

    public function destroy($id)
    {
        $objModel = $this->getModel()->find($id);
        $objModel->delete();

        return redirect()->route($this->eventos . '.show', ['id' => $objModel->evento_id]);
    }

    public function edit($id)
    {

        $objModel = $this->getModel()->find($id);
        $objModel['dt_realizacao'] = dataSQLtoPTbr($objModel['dt_realizacao']);

        $listaSalas = Espaco::all()->lists('nome', 'id');

        return view($this->path . '.edit', [
            'objModel' => $objModel,
            'listaSalas' => $listaSalas
        ]);
    }

    public function updateModalNivel(Request $request, $id)
    {
        $objModel = $this->getModel()->find($id);
        $objModel->setAttribute('nivel_id', $request->nivel_id);
        $objModel->update();
        return redirect()->route('eventos.show',  ['id'=>$objModel->evento_id,'tab'=>'nivel']);
    }

    /**
     * @param Request $request
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function updateModal(Request $request, $id)
    {

        try {

            $objModel = $this->getModel()->find($id);
            $idEvento = $objModel->evento_id;
            $objModel->status = $request->status;
            $objModel->espaco_id = $request->idEspacoAtual_;
            $objModel->espaco_id = $request->idEspacoAtual_ >= 1 ? $request->idEspacoAtual_ : $request->espaco_id;

            $objModel->justificativa = $request->justificativa;
            // ---------------------------------------------------------------------------------------------------------
            $newObjModel = new Periodo();
            $newObjModel->setAttribute('evento_id', $objModel->evento_id);
            $newObjModel->setAttribute('dt_realizacao', dataPTbrToDb($request->dt_realizacao));
            $newObjModel->setAttribute('hora_inicio', $request->hora_inicio);
            $newObjModel->setAttribute('hora_fim', $request->hora_fim);
            $newObjModel->setAttribute('status', 5);
            $newObjModel->setAttribute('espaco_id', $request->espaco_id);
            // ---------------------------------------------------------------------------------------------------------

            $auxEvento = Evento::find($idEvento);
            $objModel->save();

            $recarrega = [1, 2, 6];

            if (in_array($request->status, $recarrega)) {

                $newObjModel->save();

                $dataPorExtenso = dataPorExtenso($newObjModel->dt_realizacao);
                $nomeDoEspaco = $newObjModel->espaco_id > 0 ? $newObjModel->nomeDoespacoPorId($newObjModel->espaco_id)->nome . ' - ' . $newObjModel->nomeDoespacoPorId($newObjModel->espaco_id)->local : 'Aguardando análise';
                $dataDoEvento = "<b>Data:</b>{$newObjModel->dt_realizacao} - {$dataPorExtenso} <br /><b>Horário:</b>{$newObjModel->hora_inicio} às {$newObjModel->hora_fim}";

                $msg = "Evento " . iRcGetSysVal_('STATUS_EVENTO', $request->status);

            } else {

                $dataPorExtenso = dataPorExtenso($objModel->dt_realizacao);
                $nomeDoEspaco = $objModel->espaco_id > 0 ? $objModel->nomeDoespacoPorId($objModel->espaco_id)->nome . ' - ' . $objModel->nomeDoespacoPorId($objModel->espaco_id)->local : 'Aguardando análise';
                $dataDoEvento = "<b>Data:</b>{$objModel->dt_realizacao} - {$dataPorExtenso} <br /><b>Horário:</b>{$objModel->hora_inicio} às {$objModel->hora_fim}";

                $msg = "Evento " . iRcGetSysVal_('STATUS_EVENTO', $request->status);
            }

            $auxR = array();
            foreach ($objModel->eventoPeriodo->recursos as $r) {
                $auxR[] = $r->nome;
            }

            $link = route('eventos.show', ['id' => $objModel->id]);
            // $auxEmail = strlen(trim($auxEvento->email_solicitante)) > 8 ? $auxEvento->email_solicitante : "eventos@sfiec.org.br";
            $auxEmail = strlen(trim($auxEvento->email_solicitante)) > 8 ? explode(",", $auxEvento->email_solicitante) : explode(",","eventos@sfiec.org.br");

            $input = [
                'nome' => $auxEvento->nome,
                'tipo_evento' => $auxEvento->tipo_evento,
                'empresa_solicitante' => $auxEvento->empresa_solicitante,
                'unidade' => iRcGetSysVal_('TIPO_UNIDADE', $objModel->eventoPeriodo->unidadeEvento->tipo) . ' / ' . $objModel->getUnidadeById($objModel->eventoPeriodo->unidade_id)->nome,
                'fone_solicitante' => $auxEvento->fone_solicitante,
                'email_solicitante' => $auxEmail,
                'num_participantes' => $auxEvento->num_participantes,
                'layout_espaco' => $auxEvento->layout_espaco,
                'nomeDoEspaco' => $nomeDoEspaco,
                'dataDoEvento' => $dataDoEvento,
                'observacao' => $auxEvento->obs,
                'msg' => $msg,
                'recursos' => $auxR
            ];

            // email para gecev
            Mail::send("front-end.template-gecev", ["input" => $input, 'link' => ''], function ($mail) use ($input) {

                $mail->from('sroom@sfiec.org.br', '[GECEV - Scheduled Room]');
                $mail->to('eventos@sfiec.org.br', '[GECEV - Scheduled Room]')->subject('Solicitação de Espaço - [SCHEDULED ROOM]');
                $mail->replyTo($input['email_solicitante'], $input['empresa_solicitante']);
            });

            // email para SOLICITANTE
            //foreach ($input['email_solicitante'] as $emailSolicitante) {

                Mail::send("front-end.respEmailCliente", ["input" => $input], function ($emailCliente) use ($input) {
                    $emailCliente->from('eventos@sfiec.org.br', '[GECEV - Scheduled Room]');
                    $emailCliente->to($input['email_solicitante'], "GECEV")->subject('[SCHEDULED ROOM] - Solicitação de Espaço');
                    $emailCliente->replyTo('eventos@sfiec.org.br', 'Eventos');

                });
          //  }
            // ---------
            return redirect()->route('eventos.show', ['id' => $idEvento]);

        } catch (\Illuminate\Database\QueryException $e) {
            $tt = $e->getMessage() . "<hr />" . $e->getCode();
            return redirect('/dberros')->withErrors($tt);
        }
    }

    public function editModel($id)
    {

        $objModel = $this->getModel()->find($id);
        $objModel['dt_realizacao'] = dataSQLtoPTbr($objModel['dt_realizacao']);

        $listaSalas = Espaco::all()->lists('nome', 'id');

        return view('eventos.model-editar-periodo-espaco', [
            'objModel' => $objModel,
            'listaSalas' => $listaSalas
        ]);
    }

}
