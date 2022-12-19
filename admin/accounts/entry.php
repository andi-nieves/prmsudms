<?php
require_once('../../config.php');
$students = $dbhelper->query("SELECT `student_list`.id, CONCAT(`student_list`.`code`, ' - ', `student_list`.`lastname`,', ', `student_list`.`firstname`,' ', LEFT(middlename,1) ,'.') as name FROM `student_list` WHERE `student_list`.delete_flag=0 AND (SELECT COUNT(`account_list`.id) FROM `account_list` WHERE `account_list`.`student_id` = `student_list`.id) = 0");
$rooms = $dbhelper->query("SELECT `room_list`.id, CONCAT((SELECT `dorm_list`.name FROM `dorm_list` WHERE `dorm_list`.id = `room_list`.dorm_id), ' - ', `room_list`.name) as name, `room_list`.slots - (SELECT COUNT(`account_list`.id) FROM `account_list` WHERE `account_list`.room_id = `room_list`.id) as slots, `room_list`.price FROM `room_list` WHERE delete_flag=0 and status=1;");
$title = "Create New Account";
$account = null;
if (isset($_GET['page']) && $_GET['page'] === 'edit') {
    $account = $dbhelper->query("SELECT a.id, s.id as student_id, CONCAT(s.firstname, ' ', s.middlename, ' ', s.lastname) as name, s.code, a.date_created, CONCAT((SELECT d.name FROM dorm_list as d WHERE d.id = r.dorm_id), ' - ',r.name) as room_name, a.status, r.price, r.id as room_id  FROM `account_list` AS a INNER JOIN `student_list` AS s ON s.id = a.student_id INNER JOIN `room_list` AS r ON r.id = a.room_id  WHERE a.delete_flag = 0 AND a.id=:id", array(':id' => $_GET['id']))[0] ?? null;
}
?>
<!DOCTYPE html>
<html>
<?php include $ROOT_DIR . '/inc/html-head.php' ?>

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
                                <?php if (count($students) > 0): ?>
                                <?php include 'form.php' ?>
                                <?php else: ?>
                                <p>No record(s) available. <br /><a href="/admin/account.php">Back</a></p>
                                <?php endif ?>
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