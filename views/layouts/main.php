<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$auth = isset($_SESSION["user"]);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous" defer></script>
    <link rel="stylesheet" href="<?= ROOT_PATH ?>/styles/style.css">
    <title><?= $title ?></title>
</head>

<body id="<?= $override_id ?? "main" ?>">
    <!-- Simple notification check for errors -->
    <?php if (isset($errors)) : ?>
        <div class="alert alert-danger">
            <?php
            if (is_string($errors)) {
                echo "<p>$errors</p>";
            } else {
                foreach ($errors as $error) echo "<p>$error</p>";
            }
            ?>
        </div>

    <?php endif ?>

    <!-- Simple notification check for successes -->
    <?php if (isset($success)) : ?>
        <div class="alert alert-success">
            <?php
            if (is_string($success)) {
                echo "<p>$success</p>";
            } else {
                foreach ($success as $s) echo "<p>$s</p>";
            }
            ?>
        </div>
    <?php endif ?>

    <!-- Global navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= ROOT_PATH ?>"><img src="<?= ROOT_PATH ?>/assets/paw-filled.png" alt="" width="30" class="d-inline-block align-text-top">helpets</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <?php if ($auth) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= ROOT_PATH ?>">Home</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Animals
                            </a>

                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?= ROOT_PATH ?>/animals/new">Drop Off</a></li>
                                <li><a class="dropdown-item" href="<?= ROOT_PATH ?>/animals/show">Adopt</a></li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Breeds
                            </a>

                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?= ROOT_PATH ?>/breeds/new">New</a></li>
                                <li><a class="dropdown-item" href="<?= ROOT_PATH ?>/breeds">List</a></li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="<?= ROOT_PATH ?>/about">About</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="<?= ROOT_PATH ?>/contact">Contact</a>
                        </li>

                        <li class="nav-item">
                            <a onclick="return confirm('Are you sure you are ready to log out?')" class="nav-link" href="<?= ROOT_PATH ?>/logout">Logout</a>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= ROOT_PATH ?>/users/new">Register</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="<?= ROOT_PATH ?>/login">Login</a>
                        </li>
                    <?php endif ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- View specific output -->
    <?= $yield ?? null ?>

    <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">&copy; 2017-2023 Helpets</p>
        <ul class="list-inline">
            <li class="list-inline-item"><a href="#">Privacy</a></li>
            <li class="list-inline-item"><a href="#">Terms</a></li>
            <li class="list-inline-item"><a href="#">Support</a></li>
        </ul>
    </footer>
</body>

</html>