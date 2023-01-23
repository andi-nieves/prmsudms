<?php
$user = null;
if (isset($_SESSION['id'])) {
    $user = (object) array_merge($_SESSION, array(
        'profile_avatar' => $dbhelper->get_user_meta($_SESSION['id'], 'profile_avatar'),
        'first_name' => $dbhelper->get_user_meta($_SESSION['id'], 'first_name'),
        'last_name' => $dbhelper->get_user_meta($_SESSION['id'], 'last_name')
        ));
}
    $student_view = $_SERVER['REQUEST_URI'] === '/my-account.php';
    
?>
<link rel="stylesheet" type="text/css" href="/css/header-footer.css">
<div class="header">

    <div class="left">
        <span>PRMSU DORMITORY MANAGEMENT SYSTEM</span>
        
    </div>
    <?php if (!$student_view): ?>
    <?php if(!is_null($user)): ?>
    <div class="right">
        <div class="user">
            <span><?= $_SESSION['username']; ?></span>
            <span><?= $user_types[$_SESSION['id']] ?></span>
        </div>
        
        <div class="dropdown">
            <button class="dropbtn"><?= profile_avatar($user) ?> <i class="fa fa-chevron-down"></i></button>
            <div class="dropdown-content">
                <a href="/admin/users/entry.php?view=<?= $dbhelper->encrypt($_SESSION['id']) ?>">My Account</a>
                <a href="/logout.php">Logout</a>
            </div>
        </div>
        
    </div>
    <?php endif ?>
    <?php endif ?>
</div>
