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
                            <input name="code" />
                            <span class="error">This field is required.</span>
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-wrapper">
                            <div><span>Course</span></div>
                            <select name="course">
                                <option>Bachelor of Elementary Education</option>
                                <option>Bachelor of Physical Education</option>
                                <option>Bachelor of Secondary Education</option>
                                <option>BS in Banking and Finance</option>
                                <option>BS in Accountancy</option>
                                <option>BS in Accountancy Technology</option>
                                <option>BS in Business Administration</option>
                                <option>BS in Computer Engineering</option>
                                <option>BS in Computer Science</option>
                                <option>BS in Information Technology</option>
                                <option>BS in Civil Engineering</option>
                                <option>BS in Computer Engineering</option>
                                <option>BS in Electrical Engineering</option>
                                <option>BS in Mechanical Engineering</option>
                                <option>BS in Nursing</option>
                                <option>BS in Biology</option>
                                <option>BS in Industrial Technology</option>
                                <option>BS in Psychology</option>
                                <option>BS in Hotel and Restaurant Management</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="input-wrapper">
                            <div><span>Department</span></div>
                            <input name="department" />
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
                            <input name="firstname" />
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-wrapper">
                            <div><span>Middle Name</span></div>
                            <input name="middlename" />
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-wrapper">
                            <div><span>Last Name</span></div>
                            <input name="lastname" />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="input-wrapper">
                            <div><span>Birthday</span></div>
                            <input name="birthdate" type="date" />
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-wrapper">
                            <div><span>Age</span></div>
                            <div class="static"></div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-wrapper">
                            <div><span>Gender</span></div>
                            <select name="gender">
                                <option>Male</option>
                                <option>Female</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="input-wrapper">
                            <div><span>Religion</span></div>
                            <input name="religion" />
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-wrapper">
                            <div><span>Contact Number</span></div>
                            <input name="contact" />
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-wrapper">
                            <div><span>Email</span></div>
                            <input name="email" />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="input-wrapper">
                            <div><span>Address</span></div>
                            <textarea name="address"></textarea>
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
                            <input name="emergency_name" />
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-wrapper">
                            <div><span>Contact Number</span></div>
                            <input name="emergency_contact" />
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-wrapper">
                            <div><span>Relation</span></div>
                            <input name="emergency_relation" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="input-wrapper">
                            <div><span>Address</span></div>
                            <textarea name="emergency_address"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="input-wrapper">
                <div><span>Status</span></div>
                <select name="status">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>
            <input type="hidden" name="id" value="4" />
            <div class="justify-content m-t">
                <button class="btn btn-default" type="submit">Save</button>
                <a class="btn btn-flat" href="<?php echo $SITE_NAME ?>/admin/student.php">Cancel</a>
            </div>
        </div>
    </div>