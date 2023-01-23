<?php
include 'initialize.php';
include 'classes/db_helper.php';
$title = "PRMSUDMS";
$token = $_GET['token'] ?? null;
if (is_null($token)) {
    header('Location: /');
    die();
}
$user = $dbhelper->query("SELECT `password` FROM users WHERE id=:id", array(':id' => $dbhelper->decrypt($token)));
?>
<!DOCTYPE html>
<html>
<?php include 'inc/html-head.php' ?>

<body>
    <div class="wrapper">
        <div class="section">
            <?php include 'inc/header.php'; ?>
        </div>
        <div class="content-wrapper" style="min-height:628.038px; margin-left: unset !important">
            <section class="content">
                <div class="container">
                    <div class="card" style="max-width: 500px; margin: auto">
                        <div class="card-header">
                            <h3 class="card-title">Set password</h3>
                        </div>

                        <div class="card-body">
                        
                            <form id="form-password">
                                <?= $dbhelper->decrypt($token) ?>
                                <div class="row">
                                    <div class="col">
                                        <div class="input-wrapper">
                                            <div><span>Password</span></div>
                                            <input name="password" type="password" value=""
                                                autocomplete="new-password" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="input-wrapper">
                                            <div><span>Confirm Password</span></div>
                                            <input name="confirm-password" type="password" value=""
                                                autocomplete="new-password" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <button class="btn btn-default m-r" type="submit">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
            </section>
        </div>
        <?php $footer_class = 'justify-content';
        include 'inc/footer.php'; ?>

        <script>
            $("#form-password").on('submit', function (e) {
                e.preventDefault();
                let inputs = $(this).find('input')
                $(this).find(".error").remove()
                inputs.each((index, elem) => {
                    if (!elem.value) {
                        $(elem).closest('.input-wrapper').append('<span class="error">This field is required</span>')
                    }
                })
                if ($(this).find('.error').length > 0) return
                if (inputs[0].value.length < 6) {
                    $(inputs[0]).closest('.input-wrapper').append('<span class="error">Minimum password is not less than 6 characters</span>')
                    return
                }
                if ($(this).find('.error').length > 0) return
                if (inputs[0].value !== inputs[1].value) {
                    inputs.each((index, elem) => {
                        $(elem).closest('.input-wrapper').append('<span class="error">Password not match</span>')
                    })
                }
                if ($(this).find('.error').length > 0) return

                $.ajax({
                    url: `/api/set-password.php?token=<?= $token ?>`,
                    type: "post",
                    dataType: "json",
                    data: { password: inputs[0].value },
                }).done((data) => {
                    if (data.success) {
                        modal({
                            title: 'Horray!',
                            body: 'Password successfully changed! You can now login to your account',
                            onDismiss: () => {window.location = '/login.php'}
                        })
                    }
                })
            })
        </script>
    </div>
</body>

</html>