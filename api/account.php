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
    if (isset($_GET['monthly_collection'])) {
    $collections = $dbhelper->query("SELECT 
        p.*, 
        s.code,
        CONCAT(s.lastname, ', ', s.firstname, ' ', SUBSTR(s.middlename, 1,1), '.' ) as name,
        CONCAT(d.name, ' - ', r.name) as dorm
        FROM payment_list as p 
            INNER JOIN student_list as s ON p.account_id = s.id 
            INNER JOIN account_list as a ON s.id = a.student_id 
            INNER JOIN room_list as r ON r.id = a.room_id 
            INNER JOIN dorm_list as d ON r.dorm_id = d.id
            WHERE p.month_of =:date", array(':date' => $_GET['monthly_collection']));
        echo json_encode($collections);
        return;
    }
?>