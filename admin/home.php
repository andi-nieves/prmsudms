<?php require_once('../config.php') ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Home</title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    <body>
        <!--
            <ul>
                <li class="user-icon">
                <img src="img/user.jpg" class="uicon">
                </li>
            </ul>
            <!-->
        <div class="wrapper">
            <div class="section">
                <?php include '../inc/header.php'; ?>
            </div>
            <?php include '../inc/sidebar.php'; ?>
            <div class="content-wrapper" style="min-height:628.038px">
                <section class="content">
                    <div class="container">
                        <h1>Welcome, admin!</h1>
                        <hr>
                    </div>
                    <div class="dorm">
                        <img src="../img/dorm.jpg">
                    </div>
                </section>
            </div>
            <?php include '../inc/footer.php'; ?>
        </div>

    </body>
    </html>