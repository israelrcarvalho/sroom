<?php

namespace IrcScheduledRoom\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Evento extends Model
{
    protected $table = 'eventos';
    public $timestamps = true;
    public $modelName = 'Evento';

    protected $primaryKey = "id";
    protected $fillable = array(
        'nome',
        'descricao',
        'dt_solicitacao',
        'dt_realizar_inicio',
        'dt_realizar_fim',
        'h_inicio',
        'h_fim',
        'cadastrado_por',
        'empresa_solicitante',
        'fone_solicitante',
        'email_solicitante',
        'pago',
        'vlr_onus',
        'publicado',
        'externo',
        'tipo_pb',
        'prioridade',
        'unidade_id',
        'status',
        'layout_espaco',
        'num_participantes',
        'tipo_evento',
        'magnitude',
        'diasSelecionados',
        'obs');


    /**
     * Unidade do Evento
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function unidadeEvento()
    {
        return $this->belongsTo('IrcScheduledRoom\Models\Unidade','unidade_id','id');
    }

    public function cadastroPor()
    {
        return $this->belongsTo(Usuario::class,'cadastrado_por','id');
    }

    public function getDtrealizarinicioAttribute($dt_realizar_inicio)
    {
        return Carbon::parse($dt_realizar_inicio)->format('d.m.Y');
    }

    public function getDtrealizarfimAttribute($dt_realizar_fim)
    {
        return Carbon::parse($dt_realizar_fim)->format('d.m.Y');
    }

    public function getVlronusAttribute($vlr_onus)
    {
        return number_format($vlr_onus, 2, ',', '.');
    }

    // Relação com Model Recurso
    public function recursos()
    {
        return $this->belongsToMany('IrcScheduledRoom\Models\Recurso', 'evento_recurso');
    }

//    public function testemul()
//    {
//        return $this->belongsToMany(Periodo::class, PeriodoRecurso::class, 'evento_id', 'periodo_id');
//    }



    // Relação com Model Espaco
    public function espacos()
    {
        return $this->belongsToMany('IrcScheduledRoom\Models\Espaco', 'evento_espaco');
    }

    /**
     * Retorna todos os periodos deste evento ordenados pela data
     * O Model Periodo está mapeado com  a table evento_periodo
     * O campo de ligação é evento_id
     * @return mixed
     */
    public function periodos()
    {
        return $this->hasMany(Periodo::class)->orderBy('dt_realizacao');
    }
//---------------------------------------------------------------------------------------

    public function singleRecurso()
    {
        return $this->hasMany(EventoRecurso::class, 'evento_id');
    }

//----

    public function getUnidadeById($id){
        return Unidade::find($id);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function singleNivel()
    {
        return $this->hasMany('IrcScheduledRoom\Models\EventoNivel', 'evento_id');
    }

//----
    // Relação com Model Nivel
    public function niveis()
    {
        return $this->belongsToMany('IrcScheduledRoom\Models\Nivel', 'evento_nivel');
    }

    /**
     * Sincroniza recursos do evento
     * @param array $recursos
     */
    public function syncRecursos(array $recursos)
    {
        Recurso::addNeededRecursos($recursos);

        if (count($recursos)) {
            $this->recursos()->sync(
                Recurso::whereIn('nome', $recursos)->lists('id')->all()
            );
            return;
        }

        $this->recursos()->detach();
    }

    /**
     * Sincronizar escços do evento
     * @param array $espacos
     */
    public function syncEspacos(array $espacos)
    {
        if (count($espacos)) {
            $this->espacos()->sync(
                Espaco::whereIn('nome', $espacos)->lists('id')->all()
            );
            return;
        }
        $this->espacos()->detach();
    }


    public function getMes(){

        return $meses = array(  ''=>'- Selecione o mês-',
                                '01'=>'Janeiro',
                                '02'=>'Fevereiro',
                                '03'=>'Março'   ,
                                '04'=>'Abril'  ,
                                '05'=>'Maio'    ,
                                '06'=>'Junho',
                                '07'=>'Julho',
                                '08'=>'Agosto'   ,
                                '09'=>'Setembro',
                                '10'=>'Outubro',
                                '11'=>'Novembro',
                                '12'=>'Dezembro' );
    }

    /**
     *
     * @return array
     */
    public function getAno(){

        return $meses = array(
            ''=>'- Selecione o Ano-',
                        '2016'=>'2016',
                        '2017'=>'2017',
                        '2018'=>'2018',
                        '2018'=>'2018',
                        '2019'=>'2019'
            );
    }

}