<?php

namespace IrcScheduledRoom\Http\Requests;

use IrcScheduledRoom\Http\Requests\Request;

class UsersRequest extends Request
{
        protected $rules = [
                'name' => 'required|min:3',
                'email' => 'required|email'
         ];
        
//    public function authorize()
//    {
//        return false;
//    }
//
//    public function rules()
//    {
//        return [
//            //
//        ];
//    }
        
}
