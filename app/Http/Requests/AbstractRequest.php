<?php

namespace IrcScheduledRoom\Http\Requests;
use IrcScheduledRoom\Http\Requests\Request;

abstract class AbstractRequest extends Request {

    protected $actionsToValidate = ['store', 'update'];

    public function authorize() {
        return true;
    }
//
    public function rules()
    {
        if ($this->isMethod('post') or $this->isMethod('put'))
            return $this->rules;
            
        return [];
    }    
//    
       
    public function messages() {
        return [
            'required' => ':attribute não deve ficar vazio.'
        ];
    }

    protected function checkAction() {
        if (empty($this->route()->getAction()['as'])){
        return false;}

        $base = explode('.', $this->route()->getAction()['as']);

        if (empty($base[1])){
        return false;}

        return in_array($base[1], $this->actionsToValidate);
    }

}
