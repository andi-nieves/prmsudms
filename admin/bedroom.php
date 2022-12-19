<?php
require_once('../config.php');
$title = 'List of Bedrooms';
?>
    <!DOCTYPE html>
    <html>
    <?php include '../inc/html-head.php' ?>
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
	                        alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
                        </script>
                        <?php endif;?>
                        <div class="card">
	                        <div class="card-header">
		                        <h3 class="card-title">List of Rooms</h3>
		                        <?php if($_settings->userdata('type') == 1): ?>
		                        <div class="card-tools">
			                        <a href="javascript:void(0)" id="create_new" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span>  Create New</a>
		                        </div>
		                        <?php endif; ?>
	                        </div>
	                        <div class="card-body">
                                <div class="container-fluid">
			                        <table class="table table-hover table-striped table-bordered" id="list">
				                        <colgroup>
					                        <col width="5%">
					                        <col width="15%">
					                        <col width="15%">
					                        <col width="20%">
					                        <col width="5%">
					                        <col width="5%">
					                        <col width="15%">
					                        <col width="10%">
					                        <col width="10%">
				                        </colgroup>
				                        <thead>
					                        <tr>
						                        <th>#</th>
						                        <th>Date Created</th>
						                        <th>Dorm</th>
						                        <th>Name</th>
						                        <th>Slot</th>
						                        <th>Available</th>
						                        <th>Price</th>
						                        <th>Status</th>
						                        <th>Action</th>
					                        </tr>
				                        </thead>
				                        <tbody>
					                    <?php 
					                        $i = 1;
						                        $qry = $conn->query("SELECT r.* , d.name as `dorm`,(r.slots - coalesce((SELECT COUNT(id) FROM account_list where room_id = r.id), 0)) as `available`  from `room_list` r inner join dorm_list d on r.dorm_id = d.id where r.delete_flag = 0 and d.delete_flag = 0 and d.status = 1 order by d.`name` asc ");
						                        while($row = $qry->fetch_assoc()):
					                        ?>
						                        <tr>
							                        <td class="text-center"><?php echo $i++; ?></td>
							                        <td><?php echo date("Y-m-d H:i",strtotime($row['date_created'])) ?></td>
							                        <td><?php echo $row['dorm'] ?></td>
							                        <td><?php echo $row['name'] ?></td>
							                        <td class="text-right"><?php echo format_num($row['slots']) ?></td>
							                        <td class="text-right"><?php echo format_num($row['available']) ?></td>
							                        <td class="text-right"><?php echo format_num($row['price'], 2) ?></td>
							                        <td class="text-center">
								                        <?php if($row['status'] == 1): ?>
                                                            <span class="badge badge-maroon bg-gradient-maroon px-3 rounded-pill">Active</span>
                                                        <?php else: ?>
                                                            <span class="badge badge-light bg-gradient-light border text-dark px-3 rounded-pill">Inactive</span>
                                                        <?php endif; ?>
                                                    </td>
							                        <td align="center">
								                        <button type="button" class="btn btn-flat p-1 btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
				                  		                        Action
				                                            <span class="sr-only">Toggle Dropdown</span>
				                                        </button>
				                                        <div class="dropdown-menu" role="menu">
				                                            <a class="dropdown-item view_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-eye text-dark"></span> View</a>
									                        <?php if($_settings->userdata('type') == 1): ?>
									                        <div class="dropdown-divider"></div>
				                                            <a class="dropdown-item edit_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
				                                            <div class="dropdown-divider"></div>
				                                            <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
									                        <?php endif; ?>
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
    </body>
    </html>