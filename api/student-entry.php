<?php
    require_once '../classes/db_helper.php';
    $table_name = 'student_list';
    if (isset($_GET['type']) && $_GET['type'] == 'delete') {
        $db->_cmd("DELETE FROM $table_name WHERE id=:id", array(":id" => $_POST['id']));
        echo json_encode(array('success'=>true));
        return;
    }
    if (isset($_GET['type']) && $_GET['type'] == 'payment') {
        $id = $db->generate_insert_sql('payment_list', $_POST);
        echo json_encode(array('success'=>true));
        return;
    }
    if (is_null($_POST['id']) || $_POST['id'] == "") {
        $id = $db->generate_insert_sql($table_name, $_POST);
        echo json_encode(array('success'=>true, 'id'=>$id));
    } else {
        $id = $_POST['id'];
        unset($_POST['id']);
        $db->generate_update_sql($table_name, $id, $_POST);
        echo json_encode(array('success'=>true, 'id'=>$id));
    }
?>