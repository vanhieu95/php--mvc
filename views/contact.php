<?php

/**
 * @var \app\core\View $this
 */

use app\core\form\Form;

$this->title = 'Contact';
?>

<h1 class="my-5">Contact Us</h1>

<?php $form = Form::begin('', "post") ?>
<?php echo $form->field($contactForm, 'subject') ?>
<?php echo $form->field($contactForm, 'email')->email() ?>
<?php echo $form->textarea($contactForm, 'body') ?>
<button type="submit" class="btn btn-primary">Send</button>
<?php Form::end() ?>