<?php
    require_once '../classes/db_helper.php';
    $table_name = 'student_list';
    if (is_null($_POST['id'])) {
        $db->generate_insert_sql($table_name, $_POST);
    } else {
        $id = $_POST['id'];
        unset($_POST['id']);
        $db->generate_update_sql($table_name, $id, $_POST);
    }
?>