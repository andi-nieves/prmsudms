<?php
    include 'initialize.php';
    include 'classes/db_helper.php';
    $title = "PRMSUDMS";
    $token = $_GET['token'] ?? null;
    if (is_null($token)) header('Location: /');
    $id = $dbhelper->decrypt($_GET['token']);
    $user = $dbhelper->query("SELECT username, date_updated FROM users WHERE id=:id", array(':id' => $id));
?>
<!DOCTYPE html>
<html>
<?php include 'inc/html-head.php' ?>

<body>
    <div class="wrapper">
        <div class="section">
            <?php include 'inc/header.php'; ?>
        </div>
        <div class="content-wrapper" style="min-height:628.038px; margin-left: unset !important">
            <section class="content">
                <div class="container">
                    <script src="<?php echo "$SITE_NAME/script/form.js" ?>"></script>
                    <div class="card" style="max-width: 500px; margin: auto">
                        <div class="card-header">
                            <h3 class="card-title">Set password</h3>
                        </div>

                        <div class="card-body">
                            <?= $id ?>
                            <?= print_r($user) ?>
                        </div>
                    </div>
            </section>
        </div>
        <?php $footer_class = 'justify-content'; include 'inc/footer.php'; ?>
    </div>
</body>

</html>