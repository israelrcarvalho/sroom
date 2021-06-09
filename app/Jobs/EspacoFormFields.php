<?php

namespace IrcScheduledRoom\Jobs;
use IrcScheduledRoom\Models\Espaco;
use IrcScheduledRoom\Models\Recurso;
use IrcScheduledRoom\Models\TipoEspaco;
use Illuminate\Contracts\Bus\SelfHandling;

class EspacoFormFields extends Job implements SelfHandling
{
  /**
   * @var integer
   */
  protected $id;

  /**
   * List of fields and default value for each field
   * @var array
   */
  protected $fieldList = [
      'espaco_tipo'=>'',
      'nome' => '',
      'local' => '',
      'cod' => '',
      'capacidade' => '',
      'ativa' => '',
      'cor' => '',
      'recursos' => [],
      'listTipos'=>[],
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
   * @return array of fieldnames => values
   */
  public function handle()
  {
    $fields = $this->fieldList;

    if ($this->id) {
        $fields = $this->fieldsFromModel($this->id, $fields);
    }

    foreach ($fields as $fieldName => $fieldValue) {
             $fields[$fieldName] = old($fieldName, $fieldValue);
    }
    $aux = array_merge($fields,['listTipos' => TipoEspaco::lists('nome','id')->all()]);
    return array_merge($aux,['allRecursos' => Recurso::lists('nome')->all()]);
  }


  protected function fieldsFromModel($id, array $fields)
  {
    $post = Espaco::findOrFail($id);

    $fieldNames = array_keys(array_except($fields, ['recursos']));

    $fields = ['id' => $id];
    foreach ($fieldNames as $field) {
      $fields[$field] = $post->{$field};
    }

    $fields['recursos'] = $post->recursos()->lists('nome')->all();

    return $fields;
  }

}