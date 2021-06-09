<?php

namespace IrcScheduledRoom\Http\Controllers\Auth;

use IrcScheduledRoom\User;
use Validator;
use IrcScheduledRoom\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    | Este controlador manipula o registro de novos usuários, bem como a
    | autenticação de usuários existentes. Por padrão, este controlador usa
    | um traço simples de adicionar esses comportamentos.
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Cria uma nova instância do controlador de autenticação.
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     * Obtem um validador para uma requisição de entrada
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
    
//    protected function getLogoutcreate()
//    {
//        return redirect ('home');
//    }
}
