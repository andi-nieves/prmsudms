<?php
require_once '../initialize.php';
require_once '../classes/db_helper.php';

$dbhelper->query("UPDATE users SET password = :password WHERE id=:id", array(":password" => $_POST['password'], ":id" => $dbhelper->decrypt($_GET['token'])));
echo json_encode(array('success' => true));
return;

?>