<?php
require_once('config.php');
$title = "PRMSUDMS";
$page = $_GET['page'] ?? null;
$student_data = null;
$student_id = $_SESSION['username'] ?? null;
$age = null;
if (!is_null($student_id)) {
    require_once 'classes/db_helper.php';
    $db = new db();
    $student_data = $db->query("SELECT * FROM `student_list` WHERE email=:username", array(":username" => $student_id))[0] ?? null;
    if (!is_null($student_data)) {
        $age = floor((time() - strtotime($student_data->birthdate)) / 31556926);
    }
}
?>
<!DOCTYPE html>
<html>
<?php include $ROOT_DIR . '/inc/html-head.php' ?>

<body>
    <div class="wrapper">
        <div class="section">
            <?php include $ROOT_DIR . '/inc/header.php'; ?>
        </div>
        <div class="content-wrapper" style="min-height:628.038px; margin-left: unset !important">
            <section class="content">
                <div class="container">
                    <script src="<?php echo "$SITE_NAME/script/form.js" ?>"></script>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Update student details</h3>
                        </div>
                        <div class="card-body">
                            <div class="details">
                                <div class="section">
                                    <h3 class="m-b">School Details</h3>
                                    <div class="row">
                                        <div class="col">
                                            <div class="input-wrapper">
                                                <div><span>Student Number</span></div>
                                                <div class="view">
                                                    <?php echo $student_data->code ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="input-wrapper">
                                                <div><span>Course</span></div>
                                                <div class="view">
                                                    <?php echo $student_data->course ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="input-wrapper">
                                                <div><span>Department</span></div>
                                                <div class="view">
                                                    <?php echo $student_data->department ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="section">
                                    <h3 class="m-b">Personal Information</h3>
                                    <div class="row">
                                        <div class="col">
                                            <div class="input-wrapper">
                                                <div><span>First Name</span></div>
                                                <div class="view">
                                                    <?php echo $student_data->firstname ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="input-wrapper">
                                                <div><span>Middle Name</span></div>
                                                <div class="view">
                                                    <?php echo $student_data->middlename ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="input-wrapper">
                                                <div><span>Last Name</span></div>
                                                <div class="view">
                                                    <?php echo $student_data->lastname ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="input-wrapper">
                                                <div><span>Birthday</span></div>
                                                <div class="view">
                                                    <?php echo $student_data->birthdate ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="input-wrapper">
                                                <div><span>Age</span></div>
                                                <div class="view">
                                                    <?php echo $age ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="input-wrapper">
                                                <div><span>Gender</span></div>
                                                <div class="view">
                                                    <?php echo $student_data->gender ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="input-wrapper">
                                                <div><span>Religion</span></div>
                                                <div class="view">
                                                    <?php echo $student_data->religion ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="input-wrapper">
                                                <div><span>Contact Number</span></div>
                                                <div class="view">
                                                    <?php echo $student_data->contact ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="input-wrapper">
                                                <div><span>Email</span></div>
                                                <div class="view">
                                                    <?php echo $student_data->email ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="input-wrapper">
                                                <div><span>Address</span></div>
                                                <div class="view">
                                                    <?php echo $student_data->address ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="section">
                                    <h3 class="m-b">Emergency Details</h3>
                                    <div class="row">
                                        <div class="col">
                                            <div class="input-wrapper">
                                                <div><span>Name</span></div>
                                                <div class="view">
                                                    <?php echo $student_data->emergency_name ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="input-wrapper">
                                                <div><span>Contact Number</span></div>
                                                <div class="view">
                                                    <?php echo $student_data->emergency_contact ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="input-wrapper">
                                                <div><span>Relation</span></div>
                                                <div class="view">
                                                    <?php echo $student_data->emergency_relation ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="input-wrapper">
                                                <div><span>Address</span></div>
                                                <div class="view">
                                                    <?php echo $student_data->emergency_address ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="input-wrapper">
                                    <div><span>Status</span></div>
                                    <div class="view">
                                        <?php echo $student_data->status === "1" ? 'Active' : 'Inactive' ?>
                                    </div>
                                </div>
                                <input type="hidden" name="id" value="4" />
                                <div class="justify-content m-t">
                                    <button id="btn-payment-history" class="btn btn-default m-r"
                                        data-id="<?php echo $student_id ?>">Payment
                                        History</button>
                                        <a id="btn-logout"  href="/logout.php" class="btn btn-default m-r">Logout</a>
                                </div>

                                <div class="justify-content m-t">
                                    
                                </div>
                            </div>
                        </div>

                        <div class="modal" id="payment-history-modal" style="display: none; z-index: 99;">
                            <div class="modal-content" style="width: 1000px;">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Payment History</h3>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-hover table-striped table-bordered" id="list"
                                            data-context="/api/account.php?payment=<?php echo $dbhelper->encrypt($student_data->id) ?>">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Month of</th>
                                                    <th>Date Created</th>
                                                    <th>Amount</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                        </table>
                                        <div class="action-button justify-content-end">

                                            <button class="btn btn-flat">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script>
                            $("#btn-payment-history").on('click', function () {
                                getpayments()
                            })
                            function getpayments() {
                                const data = $('table').data()
                                $.ajax({
                                    url: data.context,
                                    dataType: "json",
                                }).done(data => {
                                    $('#payment-history-modal').hide()
                                    const table = $('table')
                                    table.DataTable().clear().destroy();
                                    // table.dataTable().fnClearTable();
                                    $('table tbody').html('')
                                    const template = `
                    <tr>
                        <td>{{index}}</td>
                        <td>{{month_of_str}}</td>
                        <td>{{date_created}}</td>
                        <td>{{amount}}</td>
                        <td>
                            <div class="dropdown">
                                <button class="dropbtn">Action <i
                                        class="fa fa-chevron-down"></i></button>
                                <div class="dropdown-content">
                                    <a href="#" class="edit" data-month_of="{{month_of}}" data-amount="{{amount}}" data-id="{{id}}">Edit</a>
                                    <a href="#" 
                                        class="delete stay" 
                                        data-id="{{id}}" 
                                        data-title="{{month_of_str}} - {{amount}}"
										data-context="<?php echo $dbhelper->encrypt("payment_list") ?>">Delete</a>
                                </div>
                            </div></td>
                    </tr>
            `
                                    data.forEach((value, index) => {
                                        $('table tbody').append(template.compose({ ...value, month_of_str: moment(value.month_of).format('MMMM YYYY'), index: ++index }))
                                    })

                                    $('#payment-history-modal').show()
                                    table.DataTable()
                                    $('table').find('.dropdown').find('.edit').unbind('click').on('click', function () {
                                        const data = $(this).data();
                                        $('#payment-modal form').find(`[name="id"]`).remove()
                                        $('#payment-modal form').append($('<input type="hidden" name="id" />').val(data.id))
                                        Object.keys(data).map(key => $('#payment-modal form').find(`[name="${key}"]`).val(data[key]))
                                        $('#payment-modal').show();
                                    })
                                    $('table').find('.dropdown').find('.delete').on('done', function () {
                                        getpayments()
                                    })
                                    window.rebindDelete();
                                })
                            }
                        </script>
                    </div>
            </section>
        </div>
        <?php $footer_class = 'justify-content'; include $ROOT_DIR . '/inc/footer.php'; ?>
    </div>
</body>

</html>