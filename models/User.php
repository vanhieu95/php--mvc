<?php

namespace app\models;

use app\core\ActiveRecord;

class User extends ActiveRecord
{
  public string $firstname = '';
  public string $lastname = '';
  public string $email = '';
  public string $password = '';
  public string $passwordConfirm = '';

  public function table(): string
  {
    return 'user';
  }

  public function attributes(): array
  {
    return [
      'firstname', 'lastname', 'email', 'password'
    ];
  }

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

  public function save()
  {
    $this->password = password_hash($this->password, PASSWORD_DEFAULT);
    return parent::save();
  }
}
