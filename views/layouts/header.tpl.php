<?php

/*if (isset($_GET['do']) && $_GET['do'] == 'logout') {
    unset($_SESSION['user']);
    redirect('login.php');
}*/
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tasks :: <?= $title ?></title>
    <link rel="stylesheet" href="/../../libs/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="/../../css/styles.css?v=<?php echo filemtime('css/styles.css'); ?>">
    <link href="/../../libs/datatables/datatables.min.css" rel="stylesheet">
    <script src="/../../libs/jquery/jquery.js"></script>
    <script src="/../../libs/datatables/datatables.min.js"></script>
    <script src="/../../js/app.js?v=<?php echo filemtime('js/app.js'); ?>"></script>
</head>


<body>

    <nav class="navbar navbar-expand-sm bg-dark border-bottom border-bottom-dark" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Home</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                    <?php if (!isset($_SESSION['user'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="?do=register">Register</a>
                        </li>
                    <?php else:  ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Hello, <?= $_SESSION['user']['name'] ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="?do=logout">logout</a></li>
                            </ul>
                        </li>
                    <?php endif;  ?>

                </ul>
            </div>
        </div>
    </nav>