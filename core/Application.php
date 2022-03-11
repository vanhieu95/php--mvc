<?php

namespace app\core;

class Application
{
  public static string $ROOT_DIR;
  public static Application $app;
  private Controller $controller;

  public Router $router;

  public function __construct(
    string $rootDir,
    public Request $request = new Request(),
    public Response $response = new Response(),
    Router $router = null,
    public $database = new Database()
  ) {
    self::$app = $this;
    self::$ROOT_DIR = $rootDir;
    $this->router = new Router($request, $response);
  }

  public function run(): void
  {
    echo $this->router->resolve();
  }

  public function getController(): Controller
  {
    return $this->controller;
  }

  public function setController(Controller $controller): void
  {
    $this->controller = $controller;
  }
}
