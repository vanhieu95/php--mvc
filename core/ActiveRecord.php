<?php

namespace app\core;

use app\core\Application;
use app\core\Model;

abstract class ActiveRecord extends Model
{
  abstract static public function table(): string;

  abstract public function attributes(): array;

  public function save()
  {
    $table = $this->table();
    $attributes = $this->attributes();
    $params = array_map(array: $attributes, callback: fn ($attribute) => ":{$attribute}");
    $statement = self::prepare("INSERT INTO {$table} (" . implode(',', $attributes) . ") 
      VALUES(" . implode(',', $params) . ")");

    foreach ($attributes as $attribute) {
      $statement->bindValue(":{$attribute}", $this->{$attribute});
    }

    $statement->execute();
    return true;
  }
}
