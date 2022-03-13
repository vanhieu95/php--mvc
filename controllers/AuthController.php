<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
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

  public function register(Request $request, Response $response)
  {
    $user = new User();
    if ($request->isPost()) {
      $user->load($request->body());

      if ($user->validate() && $user->save()) {
        Application::$app->session->setFlash('success', 'Your account have been registered!');
        $response->redirect('/');
        return true;
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
