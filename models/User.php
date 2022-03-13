<?php

namespace app\models;

use app\core\User as CoreUser;

class User extends CoreUser
{
  const STATUS_INACTIVE = 0;
  const STATUS_ACTIVE = 1;
  const STATUS_DELETED = 2;

  public string $firstname = '';
  public string $lastname = '';
  public string $email = '';
  public int $status = self::STATUS_INACTIVE;
  public string $password = '';
  public string $passwordConfirm = '';

  public static function table(): string
  {
    return 'user';
  }

  public function attributes(): array
  {
    return [
      'firstname', 'lastname', 'email', 'password', 'status'
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
      'email' => [
        self::RULE_REQUIRED,
        self::RULE_EMAIL,
        [self::RULE_UNIQUE, 'class' => self::class]
      ],
      'password' => [
        self::RULE_REQUIRED,
        [self::RULE_MIN, 'min' => 6],
        [self::RULE_MAX, 'max' => 50]
      ],
      'passwordConfirm' => [
        self::RULE_REQUIRED,
        [self::RULE_MATCH, 'match' => 'password'],
        [self::RULE_MIN, 'min' => 6],
        [self::RULE_MAX, 'max' => 50]
      ]
    ];
  }

  public function labels(): array
  {
    return [
      'firstname' => 'First Name',
      'lastname' => 'Last Name',
      'email' => 'Email',
      'password' => 'Password',
      'passwordConfirm' => 'Repeat Password',
    ];
  }

  public static function primaryKey(): string
  {
    return 'id';
  }

  public function save()
  {
    $this->status = self::STATUS_INACTIVE;
    $this->password = password_hash($this->password, PASSWORD_DEFAULT);
    return parent::save();
  }

  public function getDisplayName()
  {
    return "{$this->firstname} {$this->lastname}";
  }
}
