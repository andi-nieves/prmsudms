<?php require_once('../config.php') ?>
<!DOCTYPE html>
<html>
<?php
$title = "List of Dorms";
include '../inc/html-head.php';
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
					<?php if ($_settings->chk_flashdata('success')): ?>
					<script>
						alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
					</script>
					<?php endif; ?>
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">List of Dorms</h3>
							<div class="card-tools">
								<a href="#" id="create_new" class="btn btn-flat btn-primary"><span
										class="fas fa-plus"></span> Create New</a>
							</div>
						</div>
						<div class="card-body">
							<div class="container-fluid">
								<table class="table table-hover table-striped table-bordered" id="list">
									<thead>
										<tr>
											<th>#</th>
											<th>Name</th>
											<th>Date Created</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
                                        $i = 1;
                                        $qry = $conn->query("SELECT * from `dorm_list` where delete_flag = 0 order by `date_created` desc ");
                                        while ($row = $qry->fetch_assoc()):
                                        ?>
										<tr>
											<td class="text-center">
												<?php echo $i++; ?>
											</td>
											<td>
												<?php echo $row['name'] ?>
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
														<a class="view" data-id="<?php echo $dbhelper->encrypt($row['id']) ?>"
															data-name="<?php echo $row['name'] ?>"
															data-status="<?php echo $row['status'] ?>">View</a>
														<a href="#" class="edit" data-id="<?php echo $dbhelper->encrypt($row['id']) ?>"
															data-name="<?php echo $row['name'] ?>">Edit</a>
														<a href="#" class="delete"
															data-title="<?php echo $row['name'] ?>"
															data-context="<?php echo $dbhelper->encrypt("dorm_list") ?>"
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
					<div class="modal" id="dorm-modal-view" style="display: none">
						<div class="modal-content">
							<div class="card">
								<div class="card-header">
									<h3 class="card-title">Dorm Details</h3>
								</div>
								<div class="card-body">
									<div class="content">
										<div class="input-wrapper">
											<div><span>Name</span></div>
											<span class="text-normal">Test</span>
										</div>
										<div class="input-wrapper" style="width: 100px">
											<div><span>Status</span></div>
											<div class="pill active text-center">
												Active
											</div>
										</div>
										<div class="action-button justify-content-end">
											<button class="btn btn-secondary close">Close</button>
										</div>
										
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal" id="dorm-modal" style="display: none">
						<div class="modal-content">
							<div class="card">
								<div class="card-header">
									<h3 class="card-title">Create New Dorm</h3>
								</div>
								<div class="card-body">
									<div class="content">
										<form class="auto" data-id="<?php echo $dbhelper->encrypt("dorm_list") ?>"
											data-unique='<?php echo json_encode(array('name')) ?>'>
											<div class="input-wrapper">
												<div><span>Name</span></div>
												<input name="name" type="text" />
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
					<script>
						$("#create_new").on('click', function (event) {
							event.preventDefault();
							$("form.auto").find('[name="id"]').remove()
							$("#dorm-modal").show();
						})
						$("#list").find('.dropdown .edit').on('click', function () {
							const { id, name } = $(this).data();
							$("form.auto").find('[name="id"]').remove();
							$("form.auto").find('[name="name"]').val(name);
							$("form.auto").append(`<input type="hidden" name="id" value=${id} />`)
							$("#dorm-modal").show();
						})
						$("#list").find('.dropdown .view').on('click', function (event) {
							event.preventDefault();
							const { id, name, status } = $(this).data();
							const stat = status == 1 ? "Active" : "Inactive";
							$("#dorm-modal-view .input-wrapper .text-normal").html(name)
							$("#dorm-modal-view .input-wrapper .pill").removeClass('active inative').addClass(stat.toLowerCase()).html(stat)
							$("#dorm-modal-view").show()
						})
						$("form.auto").on("success", function (data) {
							window.location.reload()
						})

					</script>
				</div>
			</section>
		</div>
		<?php include '../inc/footer.php'; ?>
	</div>
</body>

</html>