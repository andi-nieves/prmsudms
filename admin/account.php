<?php 
	require_once('../config.php');
	$accounts = $dbhelper->query("SELECT a.id, s.id as student_id, CONCAT(s.firstname, ' ', s.middlename, ' ', s.lastname) as name, s.code, a.date_created, CONCAT((SELECT d.name FROM dorm_list as d WHERE d.id = r.dorm_id), ' - ',r.name) as room_name, a.status  FROM `account_list` AS a INNER JOIN `student_list` AS s ON s.id = a.student_id INNER JOIN `room_list` AS r ON r.id = a.room_id  WHERE a.delete_flag = 0 ORDER BY a.date_created DESC");
	$title = "List of Accounts";
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
		                        <h3 class="card-title">List of Accounts</h3>
		                        <div class="card-tools">
			                        <a href="/admin/accounts/entry.php" id="create_new" class="btn btn-flat btn-primary">
										<span class="fas fa-plus"></span>  
										Create New
									</a>
		                        </div>
	                        </div>
	                        <div class="card-body">
								<div class="container-fluid">
									
			                    	<table class="table table-hover table-striped table-bordered" id="list">
				                    	<thead>
					                    	<tr>
						                    	<th>#</th>
						                    	<th>Student</th>
						                    	<th>Code</th>
						                    	<th>Dorm</th>
												<th>Date Created</th>
						                    	<th>Status</th>
						                    	<th>Action</th>
					                    	</tr>
				                    	</thead>
				                    	<tbody>
					                	   <?php foreach($accounts as $key=>$account): ?>
                                    
						                	    <tr>
							                	    <td class="text-center"><?php echo ++$key; ?></td>
													<td><?php echo $account->name ?></td>
							                	    <td><?php echo $account->code ?></td>
													<td><?php echo $account->room_name ?></td>
													<td><?php echo date("Y-m-d H:i",strtotime($account->date_created)) ?></td>
							                	    <td class="text-center">
														<div class="pill <?php echo $account->status === '1' ? 'active' : 'inactive' ?>"><?php echo $account->status === '1' ? 'Active' : 'Inactive' ?></div>
                                            	    </td>
							                	    <td>
														<div class="dropdown">
															<button class="dropbtn">Action <i class="fa fa-chevron-down"></i></button>
															<div class="dropdown-content">
																<a href="/admin/students/entry.php?id=<?php echo $account->student_id ?>">View</a>
																<a href="/admin/accounts/entry.php?id=<?php echo $account->id ?>&page=edit">Edit</a>
																<a href="#" class="delete" data-code="<?php echo $account->code ?>" data-id="<?php echo $account->id ?>" data-name="<?php echo $account->name ?>">Delete</a>
															</div>
														</div>
						                        	</td> 
						                    	   
					                        	</tr>
				                        	<?php endforeach; ?>
			                        	</tbody>
		                        	</table>
								</div>
	                        </div>
                        </div>
                        <script>
	                        /*$(document).ready(function(){
		                        $('.delete_data').click(function(){
			                        _conf("Are you sure to delete this account permanently?","delete_account",[$(this).attr('data-id')])
		                        })
		                        $('.table').dataTable({
			                        columnDefs: [
					                        { orderable: false, targets: [5] }
			                        ],
			                        order:[0,'asc']
		                        });
		                        $('.dataTable td,.dataTable th').addClass('py-1 px-2 align-middle')
	                        })*/
	                        function delete_account($id){
		                        start_loader();
		                        $.ajax({
			                        url:_base_url_+"classes/Master.php?f=delete_account",
			                        method:"POST",
			                        data:{id: $id},
			                        dataType:"json",
			                        error:err=>{
				                        console.log(err)
				                        alert_toast("An error occured.",'error');
				                        end_loader();
			                        },
			                        success:function(resp){
				                        if(typeof resp== 'object' && resp.status == 'success'){
					                        location.reload();
				                        }else{
					                        alert_toast("An error occured.",'error');
					                        end_loader();
				                        }
			                        }
		                        })
	                        }
                        </script>
                    </div>
                </section>
            </div>
            <?php include '../inc/footer.php'; ?>
        </div>
    </body>
    </html>
