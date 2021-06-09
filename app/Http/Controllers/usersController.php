<?php

namespace IrcScheduledRoom\Http\Controllers;

// use Illuminate\Http\Request;
// use IrcScheduledRoom\Http\Requests;
// use IrcScheduledRoom\Http\Controllers\Controller;
use IrcScheduledRoom\Http\Controllers\CrudController;


class usersController extends CrudController
{
 
   protected $model = '\IrcScheduledRoom\Users';
   protected $path  = 'users';
    
    
}
