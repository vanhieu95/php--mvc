<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\ContactForm;

class SiteController extends Controller
{
  public function home()
  {
    $params = [
      'name' => Application::$app->user?->getDisplayName() ?? "Guest"
    ];

    return $this->render('home', $params);
  }

  public function contact(Request $request, Response $response)
  {
    $contactForm = new ContactForm();

    if ($request->isPost()) {
      $contactForm->load($request->body());
      if ($contactForm->validate() && $contactForm->send()) {
        Application::$app->session->setFlash('success', 'Thanks for contacting us!');
        return $response->redirect('/contact');
      }
    }

    return $this->render('contact', [
      'contactForm' => $contactForm
    ]);
  }
}
