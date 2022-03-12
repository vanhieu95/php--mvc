<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\models\User;

class AuthController extends Controller
{
  public function login(Request $request)
  {
    if ($request->isPost()) {
      return 'Handle Post';
    }

    $this->setLayout('auth');
    return $this->render('login');
  }

  public function register(Request $request)
  {
    $user = new User();
    if ($request->isPost()) {
      $user->load($request->body());

      if ($user->validate() && $user->save()) {
        echo "Success";
      }

      return $this->render('register', [
        'user' => $user
      ]);
    }

    $this->setLayout('auth');
    return $this->render('register', [
      'user' => $user
    ]);
  }
}
