<?php 
require_once('../../config.php');
$title = "Student Entry";
?>
<!DOCTYPE html>
    <html>
    <?php include $ROOT_DIR.'/inc/html-head.php' ?>
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
                <?php include $ROOT_DIR.'/inc/header.php'; ?>
            </div>
            <?php include $ROOT_DIR.'/inc/sidebar.php'; ?>
            <div class="content-wrapper" style="min-height:628.038px">
                <section class="content">
                    <div class="container">
                        <form id="student-entry-form">
                            <?php include 'form.php' ?>
                        </form>
                        
                    </div>
                </section>
            </div>
            <?php include $ROOT_DIR.'/inc/footer.php'; ?>
        </div>

    </body>
    </html>