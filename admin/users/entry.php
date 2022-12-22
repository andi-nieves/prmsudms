<?php
require_once('../../config.php');
$user = null;
$selected = isset($_GET['view']) || isset($_GET['edit']);
$readonly = isset($_GET['view']);
$id = null;
if ($selected) {
    $id = $dbhelper->decrypt($_GET['view'] ?? $_GET['edit']);
    $user = $dbhelper->query('SELECT * FROM users WHERE id=:id AND delete_flag = 0 AND `status`=1', array(':id' => $id))[0] ?? null;
}
$title = "Create New Account";
if (isset($_GET['view'])) {
    $fn = $dbhelper->get_user_meta($id, 'first_name');
    $ln = $dbhelper->get_user_meta($id, 'last_name');
    $title = "$ln, $fn - View Account";
}
?>
<!DOCTYPE html>
<html>
<?php include $ROOT_DIR . '/inc/html-head.php' ?>

<link rel="stylesheet" href="/css/cropper.css">
<script src="/script/cropper.js"></script>
<body>
    <div class="wrapper">
        <div class="section">
            <?php include $ROOT_DIR . '/inc/header.php'; ?>
        </div>
        <?php include $ROOT_DIR . '/inc/sidebar.php'; ?>
        <div class="content-wrapper" style="min-height:628.038px">
            <section class="content">
                <div class="container">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Create New Account</h3>
                        </div>
                        <div class="card-body">
                            <?php if (!isset($_GET['page'])): ?>
                                <?php include 'form.php' ?>
                            <?php else: ?>
                                <?php include 'form.php' ?>
                            <?php endif ?>
                        </div>
                    </div>

                </div>
            </section>
        </div>
        <?php include $ROOT_DIR . '/inc/footer.php'; ?>
    </div>
</body>

</html>