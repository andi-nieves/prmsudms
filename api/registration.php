<?php
session_start();
require_once '../classes/db_helper.php';
$table_name = 'student_list';

$unique = array('code', 'email');
$exist = array();
foreach ($unique as $u) {
    if (!is_null($dbhelper->query("SELECT id FROM student_list WHERE $u = :value", array(":value" => $_POST[$u]))[0] ?? null)) {
        array_push($exist, $u);
    }
}
if (count($exist) > 0) {
    echo json_encode((object) array('duplicate' => $exist));
    return;
}
$_POST['approved'] = $dbhelper->time_stamp();
$pass = '';
$_POST['approved'] = '';
if (isset($_POST['password'])) {
    $pass = $_POST['password'];
    unset($_POST['password']);
    unset($_POST['confirm-password']);
}

$id = $dbhelper->generate_insert_sql($table_name, $_POST);
$dbhelper->cmd("INSERT INTO users (username, password, type)VALUES(:username, :password, 3)", array(":username" => $_POST['email'], ':password' => $pass));
$_SESSION['username'] = $_POST['email'];
$_SESSION['type'] = 3;
$_SESSION['id'] = $id;
echo json_encode(array('success' => true, 'id' => $id));

?>