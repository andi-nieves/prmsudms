<?php 
require_once('./config.php');
if (isset($_SESSION['type'])):
    switch($_SESSION['type']) {
        case 1:
        case 2:
            header('Location: /admin/home.php');
            break;
        case 3:
            header('Location: /my-account.php');
            break;
    }
else:
    header('Location: /login.php');
endif;
?>

