<?php
    require_once '../classes/db_helper.php';
    $table_name = 'student_list';
    if (isset($_GET['type']) && $_GET['type'] == 'delete') {
        $dbhelper->_cmd("DELETE FROM $table_name WHERE id=:id", array(":id" => $_POST['id']));
        echo json_encode(array('success'=>true));
        return;
    }
    if (isset($_GET['type']) && $_GET['type'] == 'payment') {
        $id = $dbhelper->generate_insert_sql('payment_list', $_POST);
        echo json_encode(array('success'=>true));
        return;
    }
    if (is_null($_POST['id']) || $_POST['id'] == "") {
        $unique = array('code', 'email');
        $exist = array();
        foreach($unique as $u) {
            if (!is_null($dbhelper->query("SELECT id FROM student_list WHERE $u = :value", array(":value" => $_POST[$u]))[0] ?? null)) {
                array_push($exist, $u);
            }
        }
        if (count($exist) > 0) {
            echo json_encode((object)array('duplicate' => $exist));
            return;
        }
        $id = $dbhelper->generate_insert_sql($table_name, $_POST);
        $dbhelper->cmd("INSERT INTO users (username, password, type)VALUES(:username, '', 3)", array(":username" => $_POST['email']));
        try {
            send_email((object) array("code" => $_POST['code'], 'email' => $_POST['email'], 'name' => $_POST['first_name'] . " " . $_POST['last_name'],, 'token' => $dbhelper->encrypt($id)));
        } catch (\Throwable $th) {
        }
        echo json_encode(array('success'=>true, 'id'=>$id));
    } else {
        $id = $_POST['id'];
        unset($_POST['id']);
        $dbhelper->generate_update_sql($table_name, $id, $_POST);
        echo json_encode(array('success'=>true, 'id'=>$id));
    }
?>