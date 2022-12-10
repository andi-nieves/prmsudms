<?php
$courses = array(
    "Bachelor of Elementary Education",
    "Bachelor of Physical Education",
    "Bachelor of Secondary Education",
    "BS in Banking and Finance",
    "BS in Accountancy",
    "BS in Accountancy Technology",
    "BS in Business Administration",
    "BS in Computer Engineering",
    "BS in Computer Science",
    "BS in Information Technology",
    "BS in Civil Engineering",
    "BS in Computer Engineering",
    "BS in Electrical Engineering",
    "BS in Mechanical Engineering",
    "BS in Nursing",
    "BS in Biology",
    "BS in Industrial Technology",
    "BS in Psychology",
    "BS in Hotel and Restaurant Management"
);
?>
<script src="<?php echo "$SITE_NAME/script/form.js" ?>"></script>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Update student details</h3>
    </div>

    <div class="card-body">
        <form id="student-entry-form">
            <div class="details">
                <div class="section">
                    <h3 class="m-b">School Details</h3>
                    <div class="row">
                        <div class="col">
                            <div class="input-wrapper">
                                <div><span>Student Number</span></div>
                                <input name="code" value="<?php echo $student_data->code ?? "" ?>" />
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-wrapper">
                                <div><span>Course</span></div>
                                <select name="course" value="<?php echo $student_data->course ?>">
                                    <?php
                                        foreach($courses as $course) {
                                            $selected = ($student_data->course ?? "") == $course ? 'selected' : '';
                                            echo "<option $selected>$course</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="input-wrapper">
                                <div><span>Department</span></div>
                                <input name="department" value="<?php echo $student_data->department ?? "" ?>" />
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
                                <input name="firstname" value="<?php echo $student_data->firstname ?? "" ?>" />
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-wrapper">
                                <div><span>Middle Name</span></div>
                                <input name="middlename" value="<?php echo $student_data->middlename ?? "" ?>" />
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-wrapper">
                                <div><span>Last Name</span></div>
                                <input name="lastname" value="<?php echo $student_data->lastname ?? "" ?>" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="input-wrapper">
                                <div><span>Birthday</span></div>
                                <input name="birthdate" value="<?php echo $student_data->birthdate ?? "" ?>" type="date" />
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-wrapper">
                                <div><span>Age</span></div>
                                <div class="static"><?php echo $age ?? "" ?></div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-wrapper">
                                <div><span>Gender</span></div>
                                <select name="gender">
                                    <option <?php echo ($student_data->gender ?? "") == "Male" ? "selected" : "" ?>>Male
                                    </option>
                                    <option <?php echo ($student_data->gender ?? "") == "Female" ? "selected" : "" ?>>Female
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="input-wrapper">
                                <div><span>Religion</span></div>
                                <input name="religion" value="<?php echo $student_data->religion ?? "" ?>" />
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-wrapper">
                                <div><span>Contact Number</span></div>
                                <input name="contact" value="<?php echo $student_data->contact ?? "" ?>" />
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-wrapper">
                                <div><span>Email</span></div>
                                <input name="email" value="<?php echo $student_data->email ?? "" ?>" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="input-wrapper">
                                <div><span>Address</span></div>
                                <textarea name="address"><?php echo $student_data->address ?? "" ?></textarea>
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
                                <input name="emergency_name" value="<?php echo $student_data->emergency_name ?? "" ?>" />
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-wrapper">
                                <div><span>Contact Number</span></div>
                                <input name="emergency_contact"
                                    value="<?php echo $student_data->emergency_contact ?? "" ?>" />
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-wrapper">
                                <div><span>Relation</span></div>
                                <input name="emergency_relation"
                                    value="<?php echo $student_data->emergency_relation ?? "" ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="input-wrapper">
                                <div><span>Address</span></div>
                                <textarea
                                    name="emergency_address"><?php echo $student_data->emergency_address ?? "" ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="input-wrapper">
                    <div><span>Status</span></div>
                    <select name="status">
                        <option value="1" <?php echo $student_data->status ?? "" == "1" ? "selected" : "" ?>>Active</option>
                        <option value="0" <?php echo $student_data->status ?? "" == "0" ? "selected" : ""  ?>>Inactive
                        </option>
                    </select>
                </div>
                <input type="hidden" name="id" value="<?php echo $student_id ?>" />
                <div class="justify-content m-t">
                    <button class="btn btn-default m-r" type="submit">Save</button>
                    <a class="btn btn-flat" href="<?php echo $SITE_NAME ?>/admin/student.php">Cancel</a>
                </div>
            </div>
        </form>
    </div>