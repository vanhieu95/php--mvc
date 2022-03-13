<?php

use app\core\form\Form;

/**
 * @var \app\models\LoginForm $loginForm
 */
?>

<h1 class="my-5">Sign In</h1>

<?php $form = Form::begin('', "post") ?>
<?php echo $form->field($loginForm, 'email')->email() ?>
<?php echo $form->field($loginForm, 'password')->password() ?>
<button type="submit" class="btn btn-success">Login</button>
<?php Form::end() ?>