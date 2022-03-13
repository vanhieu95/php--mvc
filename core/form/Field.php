<?php

namespace app\core\form;

use app\core\Model;

class Field
{
  public const TYPE_TEXT = 'text';
  public const TYPE_PASSWORD = 'password';
  public const TYPE_NUMBER = 'number';
  public const TYPE_EMAIL = 'email';

  public string $type;

  public function __construct(public Model $model, public string $attribute)
  {
    $this->type = self::TYPE_TEXT;
  }

  public function __toString()
  {
    return sprintf(
      '<div class="form-group mb-3">
        <label for="%s" class="form-label">%s</label>
        <input type="%s" name="%s" id="%s" value="%s" class="form-control %s">
        <div class="invalid-feedback">
          %s
        </div>
      </div>',
      $this->attribute,
      $this->model->label($this->attribute),
      $this->type,
      $this->attribute,
      $this->attribute,
      $this->model->{$this->attribute},
      $this->model->hasErrors($this->attribute) ? 'is-invalid' : '',
      $this->model->firstError($this->attribute)
    );
  }

  public function password()
  {
    $this->type = self::TYPE_PASSWORD;
    return $this;
  }

  public function number()
  {
    $this->type = self::TYPE_NUMBER;
    return $this;
  }

  public function email()
  {
    $this->type = self::TYPE_EMAIL;
    return $this;
  }
}
