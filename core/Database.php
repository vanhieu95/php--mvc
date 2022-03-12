<?php

namespace app\core;

use PDO;

class Database
{
  public PDO $pdo;

  public function __construct(array $config)
  {
    [$dsn, $user, $password] = array_values($config);
    $this->pdo = new PDO($dsn, $user, $password);
    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
}
