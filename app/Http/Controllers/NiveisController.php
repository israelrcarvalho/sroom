<?php

namespace IrcScheduledRoom\Http\Controllers;

use Illuminate\Http\Request;
use IrcScheduledRoom\Models\EventoNivel;


class NiveisController extends CrudController
{

    protected $model = '\IrcScheduledRoom\Models\Nivel';
    protected $path = 'niveis';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function destroyModal($id)
    {
        $objModel = EventoNivel::find($id);
        $objModel->delete();
        return redirect()->route('eventos.show', ['id' => $objModel->evento_id]);
    }

    public function storeModal(Request $request)
    {
        $dados = $request->all();
        $objModel = EventoNivel::create($dados);
       // return redirect()->route('eventos.show', ['id' => $objModel->evento_id,'tab'=>'nivel']);
        return redirect()->route('eventos.show',  ['id'=>$objModel->evento_id,'tab'=>'alimenta']);
        //return redirect()->route('eventos.create'); //,  ['id'=>$objModel->evento_id,'tab'=>'alimenta']);

    }
}
