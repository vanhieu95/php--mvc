<?php

namespace app\core;

class Application
{
  public static string $ROOT_DIR;
  public static Application $app;
  private Controller $controller;
  public string $userClass;

  public Request $request;
  public Response $response;
  public Router $router;
  public Session $session;
  public Database $database;
  public ?User $user;

  public function __construct(
    string $rootDir,
    array $config,
  ) {
    self::$app = $this;
    self::$ROOT_DIR = $rootDir;
    $this->userClass = $config['userClass'];

    $this->request = new Request();
    $this->response = new Response();
    $this->session = new Session();
    $this->router = new Router($this->request, $this->response);

    $this->database = new Database($config['db']);

    $primaryValue = $this->session->get('user');
    if ($primaryValue) {
      $primaryKey = $this->userClass::primaryKey();
      $this->user = $this->userClass::findOne([$primaryKey => $primaryValue]);
    } else {
      $this->user = null;
    }
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

  public function login(ActiveRecord $user)
  {
    $this->user = $user;
    $primaryKey = $user->primaryKey();
    $id = $user->{$primaryKey};

    $this->session->set('user', $id);
    return true;
  }

  public function logout()
  {
    $this->user = null;
    $this->session->remove('user');
  }

  public static function isGuest()
  {
    return !self::$app->user;
  }
}
