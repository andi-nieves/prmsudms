<?php
    function profile_avatar($user) {
        global $ROOT_DIR;
        $initials = isset($user->first_name) ? substr(($user->first_name ?? ""), 0, 1).substr(($user->last_name ?? ""), 0, 1) : '?';
        if (!isset($user->profile_avatar)) return "<div class='no-image'>$initials</div>";
        $is_exist = file_exists("$ROOT_DIR/img/avatars/$user->profile_avatar");
        return  $is_exist ? "<img class='profile-avatar-thumb' src='/img/avatars/$user->profile_avatar' />" : "<div class='no-image'>$initials</div>";
    }

    $user_types = array(1 => 'Administrator', 2 => "User", 3 => "Student");
?>