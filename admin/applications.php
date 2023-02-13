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
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
					                        $i = 1;
						                        $qry = $conn->query("SELECT *, concat(firstname, ' ', coalesce(concat(middlename,' '), ''), lastname) as `name` from `student_list` where delete_flag = 0 AND approved = '0000-00-00 00:00:00' order by `name` asc ");
						                        while($row = $qry->fetch_assoc()):
					                        ?>
                                        <tr>
                                            <td class="text-center"><?php echo $i++; ?></td>
                                            <td><?php echo $row['code'] ?></td>
                                            <td><?php echo $row['name'] ?></td>
                                            <td><?php echo $row['department'] ?></td>
                                            <td><?php echo $row['course'] ?></td>
                                            <td><?php echo date("Y-m-d H:i",strtotime($row['date_created'])) ?></td>
                                            <td style="width: 50px">
                                                <div class="dropdown">
                                                    <button class="dropbtn"><a href="/admin/students/entry.php?id=<?php echo $row['id'] ?>">View</a></button>
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