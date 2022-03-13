<?php

use VanHieu\PhpMvcCore\form\Form;

/**
 * @var \VanHieu\PhpMvcCore\View $this
 * @var \app\models\User $user
 */

$this->title = 'Sign Up';
?>

<h1 class="my-5">Sign up</h1>

<?php $form = Form::begin('', "post") ?>
<div class="row">
  <div class="col"><?php echo $form->field($user, 'firstname') ?></div>
  <div class="col"><?php echo $form->field($user, 'lastname') ?></div>
</div>
<?php echo $form->field($user, 'email')->email() ?>
<?php echo $form->field($user, 'password')->password() ?>
<?php echo $form->field($user, 'passwordConfirm')->password() ?>
<button type="submit" class="btn btn-primary">Register</button>
<?php Form::end() ?>