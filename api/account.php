<?php
    require_once '../classes/db_helper.php';
    if (isset($_GET['rate'])) {
        $result = $dbhelper->query("SELECT price FROM `room_list` WHERE id=:id AND status=1 AND delete_flag=0", array(":id" => $_GET['rate']));
        echo json_encode($result[0]);
        return;
    }
?>