<?php

namespace app\core;

abstract class User extends ActiveRecord
{
  abstract public function getDisplayName();
}
