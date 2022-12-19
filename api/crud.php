<?php
    require_once '../config.php';
    $table = $dbhelper->decrypt($_GET['id']);
    if (isset($_GET['check'])) {
        $result = [];
        $id = $_POST['id'] ?? null;
        $data = null;
        if (!is_null($id)) {
            $data = $dbhelper->query("SELECT * FROM `$table` WHERE id=:id", array(":id" => $dbhelper->decrypt($id)))[0] ?? null;
        }
        foreach($_POST['keys'] as $element => $key) {
            $name = $key['key'];
            $value = $key['value']; 
            $query = $dbhelper->query("SELECT id, `$name` FROM `$table` WHERE `$name`=:$name", array(":$name" => $value))[0] ?? null;
            if (!is_null($id)) {
                if (!is_null($data) && $data->$name !== $value && !is_null($query)) {
                    array_push($result, $name);
                    break;
                }
            } else {
                if (!is_null($query)) {
                    array_push($result, $name);
                }
            }  
        }
        echo json_encode($result);
        return;
    }
    if (isset($_GET['type']) && $_GET['type'] === 'delete') {
        $dbhelper->cmd("DELETE FROM $table WHERE id=:id", array(":id" => $dbhelper->decrypt($_POST['id'])));
        echo json_encode(array('success' => true));
        return;
    }
    if (!isset($_POST['id'])) {
        $id = $dbhelper->generate_insert_sql($table, $_POST);
        echo json_encode(array('success'=>true, 'id' => $id, 'type'=>'new'));
    } else {
        if (!is_null($_POST['id'])) {
            $id = (is_numeric($_POST['id']) === 1) ? $_POST['id'] : $dbhelper->decrypt($_POST['id']);
            unset($_POST['id']);
            $dbhelper->generate_update_sql($table, $id, $_POST);
            echo json_encode(array('success'=>true, 'id'=>$id, 'type'=>'updated'));
        }
    }
    
?>