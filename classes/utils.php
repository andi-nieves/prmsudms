<?php
    function profile_avatar($user) {
        global $ROOT_DIR;
        $initials = isset($user->first_name) ? substr(($user->first_name ?? ""), 0, 1).substr(($user->last_name ?? ""), 0, 1) : '?';
        if (!isset($user->profile_avatar) || empty($user->profile_avatar)) return "<div class='no-image'>$initials</div>";
        $is_exist = file_exists("$ROOT_DIR/img/avatars/$user->profile_avatar");
        return  $is_exist == 1 ? "<img class='profile-avatar-thumb' src='/img/avatars/$user->profile_avatar' />" : "<div class='no-image'>$initials</div>";
    }
    $user_types = array(1 => 'Administrator', 2 => "User", 3 => "Student");

    function send_email($data) {
        global $ROOT_DIR;
        $contents = file_get_contents($ROOT_DIR.DIRECTORY_SEPARATOR.'email-template.html');
        foreach($data as $key=>$value):
            $contents = str_replace("{{$key}}", $value, $contents);
        endforeach;
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        echo mail($data->email,'PRMSUDMS Account',$contents,$headers) ? 'SENT1' : 'FAILED';
    }
?>