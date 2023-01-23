<?php
$isprod = $_SERVER['HTTP_HOST'] == 'prmsu-dorm.online';

if($isprod) {
    require 'initialize-prod.php';
} else {
    require 'initialize-dev.php';
}
?>