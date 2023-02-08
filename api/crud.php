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
        $dbhelper->cmd("UPDATE $table SET `delete_flag`=1 WHERE id=:id", array(":id" => $dbhelper->decrypt($_POST['id'])));
        echo json_encode(array('success' => true));
        return;
    }
    function save_metas($id) {
        global $dbhelper;
        global $ROOT_DIR;
        $meta = $_POST['meta'] ?? null;
        $profile_avatar = $_POST['profile_avatar'] ?? null;

        unset($_POST['meta']);
        unset($_POST['profile_avatar']);
        if(isset($meta) && isset($id)) {
            foreach($meta as $key=>$value) {
                $dbhelper->user_meta($id, $key, $value);
            }
        }
        if (isset($profile_avatar) && $profile_avatar !== "") {
            $data = $profile_avatar;
            if (IMAGETYPE_JPEG  === exif_imagetype($data) ){
                $data = imagecreatefromjpeg($data);
            }
            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $data = base64_decode($data);
            $imgname = "profile-avatar-$id.png";
            file_put_contents("$ROOT_DIR/img/avatars/$imgname", $data );
            $dbhelper->user_meta($id, 'profile_avatar', $imgname);
        }
    }
    $table_fields = array_diff_key($_POST,array_flip(array('meta', 'profile_avatar', 'id')));
    if (!isset($_POST['id'])) {
        $id = $dbhelper->generate_insert_sql($table, $table_fields);
        save_metas($id);
        echo json_encode(array('success'=>true, 'id' => $id, 'type'=>'new'));
    } else {
        if (!is_null($_POST['id'])) {
            if (isset($_POST['password']) && $_POST['password'] == '') {
                unset($table_fields['password']);
            }
            $id = (is_numeric($_POST['id']) == 1) ? $_POST['id'] : $dbhelper->decrypt($_POST['id']);
            $dbhelper->generate_update_sql($table, $id, $table_fields);
            save_metas($id);
            echo json_encode(array('success'=>true, 'id'=>$id, 'type'=>'updated'));
        }
    }
    
?>