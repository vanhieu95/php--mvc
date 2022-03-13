<?php

namespace app\controllers;

use VanHieu\PhpMvcCore\Application;
use VanHieu\PhpMvcCore\Controller;
use VanHieu\PhpMvcCore\Request;
use VanHieu\PhpMvcCore\Response;
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
