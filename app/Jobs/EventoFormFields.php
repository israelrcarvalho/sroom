<?php

namespace IrcScheduledRoom\Jobs;

use Carbon\Carbon;
use Illuminate\Contracts\Bus\SelfHandling;
use IrcScheduledRoom\Models\Evento;
use IrcScheduledRoom\Models\Orcamento;
use IrcScheduledRoom\Models\Recurso;
use IrcScheduledRoom\Models\Unidade;

class EventoFormFields extends Job implements SelfHandling
{
    /**
     * The id (if any) of the Post row
     * O id (se houver) da linha Pós
     * @var integer
     */
    protected $id;

    /**
     * List of fields and default value for each field
     *
     * @var array
     */
    protected $fieldList = [
        'nome' => '',
        'recursos' => [],
        'espacos' => [],
        'diasSelecionados' => '',
        'descricao' => '',
        'dt_realizar_inicio' => '',
        'dt_realizar_fim' => '',
        'h_inicio' => '',
        'h_fim' => '',
        'created_at' => '',
        'empresa_solicitante' => '',
        'fone_solicitante' => '',
        'email_solicitante' => '',
        'pago' => '',
        'vlr_onus' => '0.0',
        'publicado' => '',
        'externo' => '',
        'prioridade' => '',
        'unidade_id' => '',
        'num_participantes' => '',
        'layout_espaco' => '',
        'status' => '',
        'tipo_pb' => '',
        'obs' => '',
        'tipo_evento' => '',
        'magnitude' => '',
        'id'=>''
    ];

    /**
     * Create a new command instance.
     * @param integer $id
     */
    public function __construct($id = null)
    {
        $this->id = $id;
    }

    /**
     * Execute the command.
     *
     * @return array of fieldnames => values
     */
    public function handle()
    {
        $fields = $this->fieldList;
        $allDays = array('0' => 'Domingo', '1' => 'Segunda', '2' => 'Terça', '3' => 'Quarta', '4' => 'Quinta', '5' => 'Sexta', '6' => 'Sábado');

        if ($this->id) {

            $fields = $this->fieldsFromModel($this->id, $fields);
            $diasSelecionados = explode(';',$fields['diasSelecionados']);
            $auxDiasSelecionados = array();
            foreach($diasSelecionados as $d){
                if(array_key_exists($d,$allDays )){
                    $auxDiasSelecionados[$d] = $allDays[$d];
                }
            }
            $fields['diasSelecionados'] = $auxDiasSelecionados ;
        } else {
            $when = Carbon::now();
            $fields['dt_realizar_inicio'] = $when->format('d.m.Y');
            $fields['dt_realizar_fim'] = $when->format('d.m.Y');
            $fields['h_inicio'] = $when->format('H:i');
            $fields['h_fim'] = $when->addHour(1)->format('H:i');
            $fields['diasSelecionados'] = array();
        }

        foreach ($fields as $fieldName => $fieldValue) {
            $fields[$fieldName] = old($fieldName, $fieldValue);
        }

        $r = new Recurso();
        return array_merge($fields, ['listaDeUnidade' => Unidade::listaUnidadeGroupByTipo()],
                                    ['allDays' => $allDays],
                                    ['allRecursos_' => $r->listRecursoByTipo(array(1,3,4))],
                                    ['allRecursos' => Recurso::orderBy('nome','asc')->whereNotIn('tipo_recurso',[2])->lists('nome')->all()],
                                    ['allRecursosAlimentacao' => Recurso::orderBy('nome','asc')->where('tipo_recurso','2')->lists('nome','id')->all()]
        );
    }


    protected function fieldsFromModel($id, array $fields)
    {
        $auxEve = Evento::findOrFail($id);
        $fieldNames = array_keys(array_except($fields, ['recursos']));
        $fields = ['id' => $id];

        foreach ($fieldNames as $field) {
            $fields[$field] = $auxEve->{$field};
        }

        $fields['recursos'] = $auxEve->recursos()->lists('nome')->all();
        $fields['espacos'] = $auxEve->espacos()->lists('nome')->all();
        $fields['dt_realizar_inicio'] = ($fields['dt_realizar_inicio']);
        $fields['dt_realizar_fim'] = ($fields['dt_realizar_fim']);

        return $fields;
    }

}