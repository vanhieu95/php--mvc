<?php

namespace app\core;

class Controller
{
  public string $layout = 'main';

  public function setLayout($layout)
  {
    $this->layout = $layout;
  }

  public function render(string $view, array $params = []): string
  {
    return Application::$app->router->renderView($view, $params);
  }
}
