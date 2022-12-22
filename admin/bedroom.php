<?php
require_once('../config.php');
$title = 'List of Bedrooms';
$dorms = $dbhelper->query("SELECT id, name FROM dorm_list WHERE status = 1 ORDER BY date_created DESC")
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
					<?php if ($_settings->chk_flashdata('success')): ?>
					<script>
						alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
					</script>
					<?php endif; ?>
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">List of Rooms</h3>
							<div class="card-tools">
								<a href="#" id="create_new" class="btn btn-flat btn-primary"><span
										class="fas fa-plus"></span> Create New</a>
							</div>
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
											<th>Dorm</th>
											<th>Name / Room no.</th>
											<th>Slot</th>
											<th>Available</th>
											<th>Price</th>
											<th>Date Created</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
                                        $i = 1;
                                        $qry = $conn->query("SELECT r.* , d.name as `dorm`,(r.slots - coalesce((SELECT COUNT(id) FROM account_list where room_id = r.id), 0)) as `available`  from `room_list` r inner join dorm_list d on r.dorm_id = d.id where r.delete_flag = 0 and d.delete_flag = 0 and d.status = 1 order by d.`name` asc ");
                                        while ($row = $qry->fetch_assoc()):
                                        ?>
										<tr>
											<td class="text-center">
												<?php echo $i++; ?>
											</td>
											
											<td>
												<?php echo $row['dorm'] ?>
											</td>
											<td>
												<?php echo $row['name'] ?>
											</td>
											<td class="text-right">
												<?php echo format_num($row['slots']) ?>
											</td>
											<td class="text-right">
												<?php echo format_num($row['available']) ?>
											</td>
											<td class="text-right">
												<?php echo format_num($row['price'], 2) ?>
											</td>
											<td>
												<?php echo date("Y-m-d H:i", strtotime($row['date_created'])) ?>
											</td>
											<td class="text-center">
												<div
													class="pill <?php echo $row['status'] === '1' ? 'active' : 'inactive' ?>">
													<?php echo $row['status'] === '1' ? 'Active' : 'Inactive' ?>
												</div>
											</td>
											<td align="center">
											<div class="dropdown">
													<button class="dropbtn">Action <i
															class="fa fa-chevron-down"></i></button>
													<div class="dropdown-content">
														<a class="view" 
															data-name="<?php echo $row['name'] ?>"
															data-slots="<?php echo $row['slots'] ?>"
															data-price="<?php echo $row['price'] ?>"
															data-status="<?php echo $row['status'] ?>"
															>View</a>
														<a href="#" class="edit" 
															data-id="<?php echo $dbhelper->encrypt($row['id']) ?>"
															data-name="<?php echo $row['name'] ?>"
															data-slots="<?php echo $row['slots'] ?>"
															data-price="<?php echo $row['price'] ?>"
															data-status="<?php echo $row['status'] ?>">Edit</a>
														<a href="#" class="delete"
															data-title="<?php echo $row['name'] ?>"
															data-context="<?php echo $dbhelper->encrypt("room_list") ?>"
															data-id="<?php echo $dbhelper->encrypt($row['id']) ?>">Delete</a>
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
		<div class="modal" id="bedroom-modal" style="display: none;">
			<div class="modal-content">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Add New Room</h3>
					</div>
					<div class="card-body">
						<div class="content">
							<form class="auto" data-id="<?php echo $dbhelper->encrypt("room_list") ?>"
								data-unique='<?php echo json_encode(array('name')) ?>'>
								<div class="input-wrapper">
									<div><span>Dorm</span></div>
									<select name="dorm_id">
										<?php foreach ($dorms as $dorm): ?>
										<option value="<?php echo $dorm->id ?>">
											<?php echo $dorm->name ?>
										</option>
										<?php endforeach; ?>
									</select>
								</div>
								<div class="input-wrapper">
									<div><span>Name</span></div>
									<input name="name" />
								</div>
								<div class="input-wrapper">
									<div><span>Bed/s</span></div>
									<input name="slots" type="number" />
								</div>
								<div class="input-wrapper">
									<div><span>Price per Month</span></div>
									<input name="price" />
								</div>
								<div class="input-wrapper">
									<div><span>Status</span></div>
									<select name="status">
										<option value="1">Active</option>
										<option value="0">Inactive</option>
									</select>
								</div>
								<div class="action-button justify-content-end">
									<button class="btn btn-default m-r" type="submit">Save</button>
									<button class="btn btn-secondary close">Close</button>
								</div>
							</form>
						</div>

					</div>
				</div>
			</div>
		</div>

		<div class="modal" id="view-bedroom-modal" style="display: none;">
			<div class="modal-content">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Room Details</h3>
					</div>
					<div class="card-body">
						<div class="content">
								<div class="input-wrapper">
									<div><span>Dorm</span></div>
									<div class="view dorm">123</div>
								</div>
								<div class="input-wrapper">
									<div><span>Name</span></div>
									<div class="view name">123</div>
								</div>
								<div class="input-wrapper">
									<div><span>Bed/s</span></div>
									<div class="view slots">123</div>
								</div>
								<div class="input-wrapper">
									<div><span>Price per Month</span></div>
									<div class="view price">123</div>
								</div>
								<div class="input-wrapper" style="width: 100px;">
									<div><span>Status</span></div>
									<div class="pill active text-center status">Active</div>
								</div>
								<div class="action-button justify-content-end">
									<button class="btn btn-secondary close">Close</button>
								</div>
						</div>

					</div>
				</div>
			</div>
		</div>
		<script>
			$("#create_new").on('click', function (event) {
				event.preventDefault();
				$("#bedroom-modal").show();
				
			})
			$("#list .dropdown .view").on('click', function(event) {
				event.preventDefault()
				const data = $(this).data()
				Object.keys(data).forEach(key => {
					if (key === 'status' ) {
						const status = data['status'] == 1 ? 'Active' : 'Inactive';
						$("#view-bedroom-modal .status").removeClass('active Inactive').addClass(status.toLowerCase()).html(status)
						return
					}
					$("#view-bedroom-modal").find(`.${key}`).html(data[key])
				})
				$("#view-bedroom-modal").show();
			})
			$("#list .dropdown .edit").on('click', function(event) {
				event.preventDefault()
				const data = $(this).data()
				Object.keys(data).forEach(key => {
					if (key !== 'id') {
						$("#bedroom-modal form").find(`[name=${key}]`).val(data[key])
					}
				})
				$("#bedroom-modal form").append($('<input type="hidden" name="id"/>').val(data['id']))
				$("#bedroom-modal").show();
			})
			$("form.auto").on('success', function (event, response) {
				$("#bedroom-modal form").remove('[name="id"]')
				console.log('res', response)
				window.location.reload();
			})
		</script>
		<?php include '../inc/footer.php'; ?>
	</div>
</body>

</html>