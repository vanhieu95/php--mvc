<?php

use app\core\Application;

class m0001_create_user_table
{
  public function up()
  {
    $database = Application::$app->database;
    $sqlQuery = "CREATE TABLE user (
      id INT AUTO_INCREMENT PRIMARY KEY,
      email VARCHAR(255) NOT NULL,
      firstname VARCHAR(255) NOT NULL,
      lastname VARCHAR(255) NOT NULL,
      status TINYINT NOT NULL,
      created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=INNODB;";
    $database->pdo->exec($sqlQuery);
  }

  public function down()
  {
    $database = Application::$app->database;
    $sqlQuery = "DROP TABLE users;";
    $database->pdo->exec($sqlQuery);
  }
}