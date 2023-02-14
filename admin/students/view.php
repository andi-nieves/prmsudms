<script src="<?php echo "$SITE_NAME/script/form.js" ?>"></script>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Student details</h3>
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
                <div class="row">
                    <div class="col">
                        <div class="input-wrapper">
                            <div><span>Course</span></div>
                            <div class="view">
                                <?php echo $student_data->course ?>
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
                            <div><span>Sex</span></div>
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
                            <div><span>Relationship</span></div>
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
                <?php if(isValidTimeStamp($student_data->approved)): ?>
                <button id="btn-payment-history" class="btn btn-default m-r" data-id="<?php echo $student_id ?>">Payment
                    History</button>
                <button id="btn-add-payment" class="btn btn-default m-r" data-id="<?php echo $student_id ?>">Add
                    Payment</button>
                <?php else: ?>
                <button id="btn-approve" class="btn btn-default m-r" data-id="<?php echo $student_id ?>">Approve</button>
                <?php endif; ?>
                <a class="btn btn-default m-r"
                    href="/admin/students/entry.php?id=<?php echo $student_id ?>&page=edit">Edit</a>
                <button id="delete" data-id="<?php echo $student_id ?>" data-code="<?php echo $student_data->code ?>"
                    data-name="<?php echo "$student_data->firstname $student_data->lastname" ?>"
                    class="btn btn-danger m-r">Delete</button>
                <a class="btn btn-secondary" href="<?php echo $SITE_NAME ?>/admin/student.php">Back</a>
            </div>
        </div>
    </div>

    <div class="modal" id="payment-modal" style="display: none">
        <div class="modal-content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">New Payment</h3>
                </div>
                <div class="card-body">
                    <form class="auto" data-id="<?php echo $dbhelper->encrypt("payment_list") ?>">
                        <div class="content">
                            <div>
                                <div class="input-wrapper">
                                    <div><span>Month of</span></div>
                                    <input name="month_of" type="month" />
                                </div>
                                <div class="input-wrapper">
                                    <div><span>Amount</span></div>
                                    <input name="amount" type="text" value="<?= $roomrate->rate ?>" />
                                </div>
                                <input type="hidden" name="account_id" value="<?php echo $student_data->id ?>" />
                            </div>
                        </div>
                        <div class="action-button justify-content-end">
                            <button data-id="<?php echo $student_id ?>" class="btn btn-default m-r"
                                type="submit">Save</button>
                            <button type="button" class="btn btn-flat">Close</button>
                        </div>
                    </form>
                </div>
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
        $("#btn-add-payment").on('click', function () {
            $('#payment-modal').show();
        })
        $('#payment-modal .btn-default').on('click', function () {
            $('#payment-modal').show();
            $("form").on('success', function() {
                $('#payment-modal').hide();
                getpayments()
            })
        })
        $("#btn-payment-history").on('click', function () {
            getpayments()
        })
        $("#btn-approve").on('click', function () {
            const { id } = $(this).data();
            console.log('id', id)
            $.ajax({
            url: `/api/student-entry.php?type=approval&id=${id}`,
            type: "get",
            dataType: "json",
            }).done((data) => {
                if (data.success) {
                    modal({
                        title: ' ',
                        body: 'Application succesfully approved',
                        onDismiss: () => { window.location.reload() }
                    })
                }
            })
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
                $('table').find('.dropdown').find('.delete').on('done', function() {
                    getpayments()
                })
                window.rebindDelete();
            })
        }
    </script>