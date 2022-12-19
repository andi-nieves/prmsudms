<?php require_once('../config.php'); ?>
<!DOCTYPE html>
<html>

<?php 
$title = "Students";
include $ROOT_DIR.'/inc/html-head.php';
?>

<body>
    <div class="wrapper">
        <div class="section">
            <?php include '../inc/header.php'; ?>
        </div>
        <?php include '../inc/sidebar.php'; ?>
        <div class="content-wrapper" style="min-height:628.038px">
            <section class="content">
                <div class="container">
                    <?php if($_settings->chk_flashdata('success')): ?>
                    <script>
                    alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
                    </script>
                    <?php endif;?>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">List of Students</h3>
                            <div class="card-tools">
                                <a href="<?php echo $SITE_NAME ?>/admin/students/entry.php?page=new" id="create_new"
                                    class="btn btn-flat btn-primary"><span class="fas fa-plus"></span> Create New</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="container-fluid">
                                <table class="table table-hover table-striped table-bordered" id="list">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Student ID/Code</th>
                                            <th>Name</th>
                                            <th>Department</th>
                                            <th>Course</th>
                                            <th>Date Created</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
					                        $i = 1;
						                        $qry = $conn->query("SELECT *, concat(firstname, ' ', coalesce(concat(middlename,' '), ''), lastname) as `name` from `student_list` where delete_flag = 0 order by `name` asc ");
						                        while($row = $qry->fetch_assoc()):
					                        ?>
                                        <tr>
                                            <td class="text-center"><?php echo $i++; ?></td>
                                            <td><?php echo $row['code'] ?></td>
                                            <td><?php echo $row['name'] ?></td>
                                            <td><?php echo $row['department'] ?></td>
                                            <td><?php echo $row['course'] ?></td>
                                            <td><?php echo date("Y-m-d H:i",strtotime($row['date_created'])) ?></td>
                                            <td class="text-center">
                                                <div class="pill <?php echo $row['status'] === '1' ? 'active' : 'inactive' ?>"><?php echo $row['status'] === '1' ? 'Active' : 'Inactive' ?></div>
                                            </td>
                                            <td style="width: 50px">
                                                <div class="dropdown">
                                                    <button class="dropbtn">Action <i class="fa fa-chevron-down"></i></button>
                                                    <div class="dropdown-content">
                                                        <a href="/admin/students/entry.php?id=<?php echo $row['id'] ?>">View</a>
                                                        <a href="/admin/students/entry.php?id=<?php echo $row['id'] ?>&page=edit">Edit</a>
                                                        <a href="#" class="delete" data-code="<?php echo $row['code'] ?>" data-id="<?php echo $row['id'] ?>" data-name="<?php echo $row['name'] ?>">Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </section>
        </div>
        <?php include '../inc/footer.php'; ?>
    </div>
    <script>
        $(document).ready(function() {
            $("#list a.delete").on('click', function() {
                event.preventDefault();
                const parent = $(this).closest('tr')
                const data = $(this).data();
                window.modal({ title: 'Are you sure want to delete this record?' , body: `Student Number: ${data.code}<br/>Name: ${data.name}`, buttons:[
                    {
                        label: 'Delete',
                        class: 'btn-default',
                        action: () => {
                            $.ajax({
                                url: `/api/student-entry.php?type=delete`,
                                type: 'post',
                                dataType: 'json',
                                data
                            }).done(data => {
                                parent.remove();
                            });
                        }
                    }
                ]})
            });
        })
    </script>
</body>

</html>