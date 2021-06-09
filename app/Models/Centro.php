<?php
/**
 * Created by PhpStorm.
 * User: ircarvalho
 * Date: 12/07/2016
 * Time: 10:17
 */

namespace IrcScheduledRoom\Models;
use Illuminate\Database\Eloquent\Model;

class Centro extends Model
{
    protected $table = 'centroresp';


    /**
     * Retorna uma lista com os centros de responsabilidades
     * @return boolean
     */
    public function listCentros(){
        try {
            return self::all()->sortBy('nome')->pluck('nome','id');
        } catch(\Exception $e) {
            return FALSE;
        }
    }
}