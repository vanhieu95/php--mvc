<?php

namespace app\core;

use app\core\exception\NotFoundException;

class Router
{
  protected array $routers = [];

  public function __construct(
    public Request $request,
    public Response $response
  ) {
  }

  /**
   * Store to routers the get route
   *
   * @param string $path
   * @param callable|string|array $callback
   * @return void
   */
  public function get(string $path, callable|string|array $callback): void
  {
    $this->routers['get'][$path] = $callback;
  }

  /**
   * Store to routers the post route
   *
   * @param string $path
   * @param callable|array|string $callback
   * @return void
   */
  public function post(string $path, callable|array|string $callback): void
  {
    $this->routers['post'][$path] = $callback;
  }

  public function resolve(): mixed
  {
    $path = $this->request->getPath();
    $method = $this->request->method();

    $callback = $this->routers[$method][$path] ?? false;

    if (!$callback) {
      throw new NotFoundException();
    }

    if (is_string($callback)) {
      return $this->renderView($callback);
    }

    if (is_array($callback)) {
      Application::$app->setController(new $callback[0]());
      $controller = $callback[0] = Application::$app->getController();
      Application::$app->getController()->setAction($callback[1]);

      $middlewares = $controller->getMiddlewares();
      foreach ($middlewares as $middleware) {
        $middleware->execute();
      }
    }

    return call_user_func($callback, $this->request, $this->response);
  }

  public function renderView(string $view, array $params = []): string
  {
    $layoutContent = $this->layoutContent();
    $viewContent = $this->renderOnlyView($view, $params);
    return str_replace('{{ content }}', $viewContent, $layoutContent);
  }

  public function renderContent(string $viewContent): string
  {
    $layoutContent = $this->layoutContent();
    return str_replace('{{ content }}', $viewContent, $layoutContent);
  }

  protected function layoutContent(): string
  {
    $layout = Application::$app->getController()?->layout ?? Application::$app->layout;
    ob_start();
    include_once Application::$ROOT_DIR . "/views/layout/{$layout}.php";
    return ob_get_clean();
  }

  protected function renderOnlyView(string $view, array $params): string
  {
    foreach ($params as $key => $value) {
      $$key = $value;
    }

    ob_start();
    include_once Application::$ROOT_DIR . "/views/{$view}.php";
    return ob_get_clean();
  }
}
