<?php
    require_once '../config.php';
    $table = $dbhelper->decrypt($_GET['id']);
    if (!isset($_POST['id'])) {
        $id = $dbhelper->generate_insert_sql($table, $_POST);
        echo json_encode(array('success'=>true));
    } else {
        if (!is_null($_POST['id'])) {
            $dbhelper->generate_update_sql($table, $_POST['id'], $_POST);
            echo json_encode(array('success'=>true, 'id'=>$_POST['id']));
        }
    }
    
?>