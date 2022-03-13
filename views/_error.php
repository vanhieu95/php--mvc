<?php


/** 
 * @var \VanHieu\PhpMvcCore\View $this
 * @var Exception $exception
 */

$this->title = $exception->getMessage();
?>
<h3><?= "{$exception->getCode()} - {$exception->getMessage()}" ?></h3>