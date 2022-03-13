<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\middlewares\AuthMiddleware;
use app\core\Request;
use app\core\Response;
use app\models\LoginForm;
use app\models\User;

class AuthController extends Controller
{
  public function __construct()
  {
    $this->registerMiddleware(new AuthMiddleware(['profile']));
  }

  public function login(Request $request, Response $response)
  {
    $loginForm = new LoginForm();
    if ($request->isPost()) {
      $loginForm->load($request->body());

      if ($loginForm->validate() && $loginForm->login()) {
        $response->redirect('/');
        return true;
      }
    }

    $this->setLayout('auth');
    return $this->render('login', [
      'loginForm' => $loginForm
    ]);
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
    }

    $this->setLayout('auth');
    return $this->render('register', [
      'user' => $user
    ]);
  }

  public function logout(Request $request, Response $response)
  {
    Application::$app->logout();
    $response->redirect('/');
  }

  public function profile()
  {
    return $this->render('profile');
  }
}
