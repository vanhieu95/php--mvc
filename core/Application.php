<?php

namespace app\core;

class Application
{
  public static string $ROOT_DIR;
  public static Application $app;
  private Controller $controller;

  public Request $request;
  public Response $response;
  public Router $router;
  public Session $session;
  public Database $database;

  public function __construct(
    string $rootDir,
    array $config,
  ) {
    self::$app = $this;
    self::$ROOT_DIR = $rootDir;

    $this->request = new Request();
    $this->response = new Response();
    $this->session = new Session();
    $this->router = new Router($this->request, $this->response);

    $this->database = new Database($config['db']);
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
