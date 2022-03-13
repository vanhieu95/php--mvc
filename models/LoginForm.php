<?php

namespace app\models;

use VanHieu\PhpMvcCore\Application;
use VanHieu\PhpMvcCore\Model;

class LoginForm extends Model
{
  public string $email = '';
  public string $password = '';

  public function rules(): array
  {
    return [
      'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
      'password' => [self::RULE_REQUIRED]
    ];
  }

  public function labels(): array
  {
    return [];
  }

  public function login()
  {
    $user = User::findOne(['email' => $this->email]);
    if (!$user) {
      $this->addErrorMessage('email', 'User credentials invalid!');
      return false;
    }
    if (!password_verify($this->password, $user->password)) {
      $this->addErrorMessage('password', 'User credentials invalid!');
      return false;
    }

    return Application::$app->login($user);
  }
}
