<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


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
        
        try {
            $mail = new PHPMailer;
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host = 'smtp.hostinger.com';                    //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'admin@prmsu-dorm.online';                     //SMTP username
            $mail->Password   = 'P@ssw0rd123!';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
            //Recipients
            $mail->setFrom('admin@prmsu-dorm.online', 'Mailer');
            $mail->addAddress($data->email);               //Name is optional
            $mail->addCC('andinieves151720@gmail.com');
        
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'PRMSU Dorm Updates';
            $mail->Body    = $contents;
        
            $mail->send();
        
        } catch (Exception $e) {
        
        }
    }

    function is_admin() {
        return $_SESSION['type'] == 1;
    }
    function isValidTimeStamp($timestamp) {
        return $timestamp != '0000-00-00 00:00:00';
    }
?>