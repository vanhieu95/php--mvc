<?php

use VanHieu\PhpMvcCore\Application;

class m0002_add_password_into_user_table
{
  public function up()
  {
    $database = Application::$app->database;
    $sqlQuery = "ALTER TABLE user ADD COLUMN password VARCHAR(255) NOT NULL;";
    $database->pdo->exec($sqlQuery);
  }

  public function down()
  {
    $database = Application::$app->database;
    $sqlQuery = "ALTER TABLE user DROP COLUMN password VARCHAR(255);";
    $database->pdo->exec($sqlQuery);
  }
}
