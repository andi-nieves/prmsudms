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
                            <div class="view"><?php echo $student_data->code ?></div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-wrapper">
                            <div><span>Course</span></div>
                            <div class="view"><?php echo $student_data->course ?></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="input-wrapper">
                            <div><span>Department</span></div>
                            <div class="view"><?php echo $student_data->department ?></div>
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
                            <div class="view"><?php echo $student_data->firstname ?></div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-wrapper">
                            <div><span>Middle Name</span></div>
                            <div class="view"><?php echo $student_data->middlename ?></div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-wrapper">
                            <div><span>Last Name</span></div>
                            <div class="view"><?php echo $student_data->lastname ?></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="input-wrapper">
                            <div><span>Birthday</span></div>
                            <div class="view"><?php echo $student_data->birthdate ?></div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-wrapper">
                            <div><span>Age</span></div>
                            <div class="view"><?php echo $age ?></div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-wrapper">
                            <div><span>Gender</span></div>
                            <div class="view"><?php echo $student_data->gender ?></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="input-wrapper">
                            <div><span>Religion</span></div>
                            <div class="view"><?php echo $student_data->religion ?></div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-wrapper">
                            <div><span>Contact Number</span></div>
                            <div class="view"><?php echo $student_data->contact ?></div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-wrapper">
                            <div><span>Email</span></div>
                            <div class="view"><?php echo $student_data->email ?></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="input-wrapper">
                            <div><span>Address</span></div>
                            <div class="view"><?php echo $student_data->address ?></div>
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
                            <div class="view"><?php echo $student_data->emergency_name ?></div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-wrapper">
                            <div><span>Contact Number</span></div>
                            <div class="view"><?php echo $student_data->emergency_contact ?></div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-wrapper">
                            <div><span>Relation</span></div>
                            <div class="view"><?php echo $student_data->emergency_relation ?></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="input-wrapper">
                            <div><span>Address</span></div>
                            <div class="view"><?php echo $student_data->emergency_address ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="input-wrapper">
                <div><span>Status</span></div>
                <div class="view"><?php echo $student_data->status === "1" ? 'Active' : 'Inactive' ?></div>
            </div>
            <input type="hidden" name="id" value="4" />
            <div class="justify-content m-t">
                <a class="btn btn-default m-r" href="/admin/students/entry.php?id=<?php echo $student_id ?>&page=edit">Edit</a>
                <button id="delete" data-id="<?php echo $student_id ?>" class="btn btn-danger m-r">Delete</button>
                <a class="btn btn-flat" href="<?php echo $SITE_NAME ?>/admin/student.php">Cancel</a>
            </div>
        </div>
    </div>