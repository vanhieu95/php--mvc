<?php

use VanHieu\PhpMvcCore\form\Form;

/**
 * @var \VanHieu\PhpMvcCore\View $this
 * @var \app\models\LoginForm $loginForm
 */

$this->title = 'Sign In';
?>

<h1 class="my-5">Sign In</h1>

<?php $form = Form::begin('', "post") ?>
<?php echo $form->field($loginForm, 'email')->email() ?>
<?php echo $form->field($loginForm, 'password')->password() ?>
<button type="submit" class="btn btn-success">Login</button>
<?php Form::end() ?>