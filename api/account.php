<?php
    require_once '../config.php';
    function encrypt($value) {
        global $dbhelper;
        return $dbhelper->encrypt($value);
    }
    if (isset($_GET['rate'])) {
        $result = $dbhelper->query("SELECT price FROM `room_list` WHERE id=:id AND status=1 AND delete_flag=0", array(":id" => $_GET['rate']));
        echo json_encode($result[0]);
        return;
    }
    if (isset($_GET['payment'])) {
        $result = $dbhelper->query("SELECT * FROM `payment_list` WHERE account_id=:id ORDER BY date_created DESC", array(":id" => $dbhelper->decrypt($_GET['payment'])));
        echo json_encode(array_map(function($data) {
            return (object) array_merge((array) $data, (array) array("id" => encrypt($data->id), 'id_raw' => $data->id));
        }, $result));
        return;
    }
?>