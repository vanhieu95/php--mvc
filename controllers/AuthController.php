<?php

namespace app\controllers;

use VanHieu\PhpMvcCore\Application;
use VanHieu\PhpMvcCore\Controller;
use VanHieu\PhpMvcCore\middlewares\AuthMiddleware;
use VanHieu\PhpMvcCore\Request;
use VanHieu\PhpMvcCore\Response;
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
