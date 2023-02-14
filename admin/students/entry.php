<?php 
    require_once('../../config.php');
    $title = "Student Entry";
    $page = $_GET['page'] ?? null;
    $student_data = null;
    $student_id = $_GET['id'] ?? null;
    $age = null;
    if (!is_null($student_id)) {
        require_once '../../classes/db_helper.php';
        $db = new db();
        $student_data = $db->query("SELECT * FROM `student_list` WHERE id=:id", array(":id"=>$student_id))[0] ?? null;
        $roomrate = $db->query("SELECT r.price as rate FROM account_list as a INNER JOIN room_list as r ON a.room_id = r.id WHERE a.student_id=:id", array(":id"=>$student_id))[0] ?? null;
        if(!is_null($student_data)) {
            $age = floor((time() - strtotime($student_data->birthdate)) / 31556926);
        }
    }
?>
<!DOCTYPE html>
<html>
<?php include $ROOT_DIR.'/inc/html-head.php' ?>

<body>
    <div class="wrapper">
        <div class="section">
            <?php include $ROOT_DIR.'/inc/header.php'; ?>
        </div>
        <?php include $ROOT_DIR.'/inc/sidebar.php'; ?>
        <div class="content-wrapper" style="min-height:628.038px">
            <section class="content">
                <div class="container">
                    <?php 
                            switch($page) {
                                case 'new': 
                                    include 'form.php';
                                    break;
                                case 'edit':
                                    if (!is_null($student_data)) {
                                        include 'form.php';
                                    }else {
                                        include '../../components/no-record.html';
                                    }
                                    break;
                                default:
                                    if (!is_null($student_data)) {
                                        include 'view.php';
                                    }else {
                                        include '../../components/no-record.html';
                                }
                                    break;
                            }
                        ?>
                    </form>

                </div>
            </section>
        </div>
        <?php include $ROOT_DIR.'/inc/footer.php'; ?>
    </div>

</body>

</html>