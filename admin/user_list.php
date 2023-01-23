<?php
require_once('../config.php');
$title = "User List";
$result = $dbhelper->query('SELECT u.*, group_concat(m.meta_key) as meta_keys, group_concat(m.meta_value) as meta_values FROM users as u LEFT JOIN user_meta as m ON m.user_id = u.id WHERE u.status = 1 AND u.delete_flag = 0 GROUP BY u.id ORDER BY u.date_created');
$users = array();
foreach ($result as $user):
	$keys = explode(',', $user->meta_keys);
	$values = explode(',', $user->meta_values); foreach ($keys as $index => $key):
		$user->$key = $values[$index];
	endforeach;
	array_push($users, $user);
endforeach;
?>
<!DOCTYPE html>
<html>
<?php include '../inc/html-head.php'; ?>

<body>
	<div class="wrapper">
		<div class="section">
			<?php include '../inc/header.php'; ?>
		</div>
		<?php include '../inc/sidebar.php'; ?>
		<div class="content-wrapper" style="min-height:628.038px">
			<section class="content">
				<div class="container">
					<style>
						.user-avatar {
							width: 3rem;
							height: 3rem;
							object-fit: scale-down;
							object-position: center center;
						}
					</style>
					<div class="card card-outline rounded-0 card-maroon">
						<div class="card-header">
							<h3 class="card-title">List of Users</h3>
							<div class="card-tools">
								<?php if(is_admin()): ?>
								<a href="/admin/users/entry.php" id="create_new" class="btn btn-flat btn-primary"><span
										class="fas fa-plus"></span> Create New</a>
								<?php endif; ?>
							</div>
						</div>
						<div class="card-body">
							<div class="container-fluid">
								<table class="table table-hover table-striped table-bordered" id="list">
									<thead>
										<tr>
											<th>#</th>
											<th style="width: 40px">Avatar</th>
											<th>Name</th>
											<th style="width: 60px">Username</th>
											<th>Type</th>
											<th>Date Updated</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($users as $index => $user): ?>
										<tr>
											<td><?=++$index ?></td>
											<td><?= profile_avatar($user) ?></td>
											<td><?= $user->last_name ?? "" ?>, <?= $user->first_name ?? "" ?></td>
											<td><?= $user->username ?? "-" ?></td>
											<td><?= $user_types[$user->type] ?? "-" ?></td>
											<td><?= $user->date_created ?? "-" ?></td>
											<td>
												<div class="dropdown">
													<button class="dropbtn">Action <iclass="fa fa-chevron-down"></i></button>
													<div class="dropdown-content">
														<a href="/admin/users/entry.php?view=<?= $dbhelper->encrypt($user->id) ?>">View</a>
														<?php if (is_admin()): ?>
															<a href="/admin/users/entry.php?edit=<?= $dbhelper->encrypt($user->id) ?>">Edit</a>
															<a href="#" class="delete"
																data-title="<?= "$user->last_name, $user->first_name" ?>"
																data-context="<?= $dbhelper->encrypt("users") ?>"
																data-id="<?= $dbhelper->encrypt($user->id) ?>">Delete</a>
														<?php endif; ?>
														
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
				</div>
			</section>
		</div>
		<?php include '../inc/footer.php'; ?>
	</div>
</body>

</html>