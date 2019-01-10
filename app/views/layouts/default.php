<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <?=\fw\core\base\View::getMeta()?>
</head>
<body>
<div class="container">
    <div class="row">
        <ul class="nav nav-pills">
            <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="/page/about">About</a></li>
            <li class="nav-item"><a class="nav-link" href="/admin">AdminPanel</a></li>
            <li class="nav-item"><a class="nav-link" href="/user/signup">SignUp</a></li>
            <li class="nav-item"><a class="nav-link" href="/user/login">Login</a></li>
            <li class="nav-item"><a class="nav-link" href="/user/logout">Logout</a></li>
        </ul>
    </div>

    <?php if (isset($_SESSION['error'])):?>
        <div class="alert alert-danger">
            <?=$_SESSION['error']; unset($_SESSION['error']);?>
        </div>
    <?php endif;?>

    <?php if (isset($_SESSION['success'])):?>
        <div class="alert alert-success">
            <?=$_SESSION['success']; unset($_SESSION['success']);?>
        </div>
    <?php endif;?>

    <?=debug($_SESSION);?>

    <?=$content;?>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<?php
foreach ($scripts as $script) {
    echo $script;
}
?>
</body>
</html>