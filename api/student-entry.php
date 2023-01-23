<?php

require_once '../config.php';
    require_once '../classes/db_helper.php';
    $table_name = 'student_list';
    if (isset($_GET['type']) && $_GET['type'] == 'approval') {
        $dbhelper->query("UPDATE student_list SET approved = :value WHERE id=:id", array(":value" => $dbhelper->time_stamp(), ":id"=>$_GET['id']));
        echo json_encode(array('success'=>true));
        return;
    }
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
    if (!isset($_POST['id']) || is_null($_POST['id']) || $_POST['id'] == "") {
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
        $_POST['approved'] = $dbhelper->time_stamp();
        $pass = '';
        if (isset($_GET['page']) && $_GET['page'] == 'registration'):
            $_POST['approved'] = '';
        endif;
        if (isset($_POST['password'])) {
            $pass = $_POST['password'];
            unset($_POST['password']);
            unset($_POST['confirm-password']);
        }

        $id = $dbhelper->generate_insert_sql($table_name, $_POST);
        $dbhelper->cmd("INSERT INTO users (username, password, type)VALUES(:username, :password, 3)", array(":username" => $_POST['email'], ':password' => $pass));
        try {
            send_email((object) array("code" => $_POST['code'], 'email' => $_POST['email'], 'name' => $_POST['firstname'] . " " . $_POST['lastname'], 'token' => $dbhelper->encrypt($id)));
        } catch (\Throwable $th) {
        echo $th;
        }
        echo json_encode(array('success'=>true, 'id'=>$id));
    } else {
        $id = $_POST['id'];
        unset($_POST['id']);
        $dbhelper->generate_update_sql($table_name, $id, $_POST);
        echo json_encode(array('success'=>true, 'id'=>$id));
    }
?>