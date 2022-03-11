<?php

namespace app\models;

use app\core\Model;

class User extends Model
{
  public string $firstname = '';
  public string $lastname = '';
  public string $email = '';
  public string $password = '';
  public string $passwordConfirm = '';

  public function rules(): array
  {
    return [
      'firstname' => [
        self::RULE_REQUIRED,
        [self::RULE_MIN, 'min' => 2],
        [self::RULE_MAX, 'max' => 20]
      ],
      'lastname' => [
        self::RULE_REQUIRED,
        [self::RULE_MIN, 'min' => 2],
        [self::RULE_MAX, 'max' => 20]
      ],
      'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
      'password' => [
        self::RULE_REQUIRED,
        [self::RULE_MIN, 'min' => 8],
        [self::RULE_MAX, 'max' => 50]
      ],
      'passwordConfirm' => [
        self::RULE_REQUIRED,
        [self::RULE_MATCH, 'match' => 'password'],
        [self::RULE_MIN, 'min' => 8],
        [self::RULE_MAX, 'max' => 50]
      ]
    ];
  }
}
