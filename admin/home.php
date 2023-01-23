<?php
require_once('../config.php');
$title = "Home";
?>
    <!DOCTYPE html>
    <html>
    <?php include '../inc/html-head.php' ?>
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