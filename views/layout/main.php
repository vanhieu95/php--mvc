<?php

use app\core\Application;
use app\core\View;

/**
 * @var View $this
 */

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://unpkg.com/open-props" />
  <link rel="stylesheet" href="https://unpkg.com/open-props/normalize.min.css" />
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/style.css">
  <title><?= $this->title ?></title>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/contact">Contact</a>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
          <?php if (Application::isGuest()) : ?>
            <li class="nav-item">
              <a class="nav-link" href="/login">Sign in</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/register">Sign up</a>
            </li>
          <?php else : ?>
            <li class="nav-item">
              <a class="nav-link" href="/profile">
                Welcome <?= Application::$app->user->getDisplayName() ?>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/logout">
                Logout
              </a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>
  <main class="container">
    <?php if (Application::$app->session->getFlash('success')) : ?>
      <div class="alert alert-success">
        <?= Application::$app->session->getFlash('success') ?>
      </div>
    <?php endif; ?>
    {{ content }}
  </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>