<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PRMSU Dormitory Management System</title>
    <link rel="stylesheet" type="text/css" href="../css/login.css">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
</head>
<body>
    <div class="logo">
        <img src="../img/PRMSU logo.png">
    </div>
    <div class="title">
        <h2>PRMSU Dormitory Management System</h2>
    </div>
    <form method="post">
        <?php if(isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>
        <label>Username</label>
        <input type="text" name="username"><br>
        <label>Password</label>
        <input type="password" name="password"><br>
        <button type="submit">Login</button>
    </form>
    <script>
        $("form").on('submit', function(event) {
            event.preventDefault();
            const form = $(this);
            form.find('.error').remove();
            $.ajax({
                url: `/api/login.php`,
                type: "post",
                dataType: "json",
                data: form.serialize(),
                }).done((data) => {
                    if (data.error) {
                        form.prepend(`<p class="error">${data.error}</p>`);
                    }
                    if (data.success) {
                        window.location = `/admin/home.php`;
                    }
                });
        })
    </script>
</body>
</html>