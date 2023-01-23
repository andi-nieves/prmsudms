<?php require_once('../config.php') ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PRMSU Dormitory Management System</title>
    <link rel="stylesheet" type="text/css" href="../css/login.css">
</head>
<body>
    <div class="logo">
        <img src="../img/PRMSU logo.png">
    </div>
    <div class="title">
        <h2>PRMSU Dormitory Management System</h2>
    </div>
    <form action="/admin/login.php" method="post">
        <?php if(isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>
        <label>Username</label>
        <input type="text" name="username"><br>
        <label>Password</label>
        <input type="password" name="password"><br>

        <button type="submit">Login</button>
    </form>
</body>
</html>