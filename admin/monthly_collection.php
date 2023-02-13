<?php
require_once('../config.php');
$title = 'Collection reports';
$month = $_GET['month'] ?? date("Y-m");
$collections = $dbhelper->query("SELECT 
p.*, 
s.code,
CONCAT(s.lastname, ', ', s.firstname, ' ', SUBSTR(s.middlename, 1,1), '.' ) as name,
CONCAT(d.name, ' - ', r.name) as dorm
FROM payment_list as p 
    INNER JOIN student_list as s ON p.account_id = s.id 
    INNER JOIN account_list as a ON s.id = a.student_id 
    INNER JOIN room_list as r ON r.id = a.room_id 
    INNER JOIN dorm_list as d ON r.dorm_id = d.id
    WHERE p.month_of =:month", array(':month' => $month));
$total = array_sum(array_column($collections, 'amount'));
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
		                        <h3 class="card-title">Monthly Report</h3>
	                        </div>
	                        <div class="card-body">
		                        <div class="container-fluid mb-3">
                                    <fieldset class="px-2 py-1 border m-b">
                                        <legend class="w-auto px-3">Filter</legend>
                                        <div class="container-fluid">
                                            <form action="" id="filter-form">
                                                <div class="wrapper">
                                                    <div class="input-wrapper">
                                                            <div><span>Choose Date</span></div>
                                                            <input type="month" class="form-control form-control-sm rounded-0" name="month" id="month" value="<?= $month ?>" required="required">
                                                    </div>
                                                    <div class="action-buttons">
                                                        <button type="submit" class="btn btn-default"><i class="fas fa-redo-alt"></i> Refresh</button>
                                                        <a href="/admin/print_monthly_collection.php?month=<?= $month ?>" class="btn btn-default" target="_new"><i class="fa fa-print"></i> Print</a>
                                                    </div>

                                                </div>
                                            </form>
                                        </div>
                                    </fieldset>
		                        </div>
                                <div class="container-fluid" id="printout">
			                        <table class="table table-hover table-striped table-bordered no-pagination">
				                        <thead>
					                        <tr>
						                        <th>#</th>
						                        <th>Student</th>
						                        <th>Account Code</th>
						                        <th>Dorm</th>
                                                <th>Date Created</th>
						                        <th>Amount</th>
					                        </tr>
				                        </thead>
				                        <tbody>
					                        <?php foreach($collections as $key=>$collection): ?>
                                                <tr>
                                                    <td><?= ++$key ?></td>
                                                    <td><?= $collection->name ?></td>
                                                    <td><?= $collection->code ?></td>
                                                    <td><?= $collection->dorm ?></td>
                                                    <td><?= $collection->date_created ?></td>
                                                    <td><?= $collection->amount ?></td>
                                                </tr>
                                            <?php endforeach; ?>
				                        </tbody>
                                        <tfoot>
                                            <th class="py-1 text-center" style="padding: 10px !important;" colspan="5">Total Collections</th>
                                            <th class="py-1 text-right"><?= number_format($total, 2) ?></th>
                                        </tfoot>
			                        </table>
		                        </div>
	                        </div>
                        </div>
                        <noscript id="print-header">
                            <div>
                            <div class="d-flex w-100">
                                <div class="col-2 text-center">
                                    <img style="height:.8in;width:.8in!important;object-fit:cover;object-position:center center" src="<?= validate_image($_settings->info('logo')) ?>" alt="" class="w-100 img-thumbnail rounded-circle">
                                </div>
                                <div class="col-8 text-center">
                                    <div style="line-height:1em">
                                        <h4 class="text-center mb-0"><?= $_settings->info('name') ?></h4>
                                        <h3 class="text-center mb-0"><b>Monthly Collection Report</b></h3>
                                        <div class="text-center">as of</div>
                                        <h4 class="text-center mb-0"><b><?= date("F, Y", strtotime($month."-01")) ?></b></h4>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            </div>
                        </noscript>
                        <script>
	                        $(document).ready(function(){
		                        $('#filter-form').submit(function(e){
                                    e.preventDefault()
                                    location.href = "/admin/monthly_collection.php?"+$(this).serialize()
                                })
                                $('.dataTables_filter').remove()
	                        })
	
                        </script>
                    </div>
                </section>
            </div>
            <?php include '../inc/footer.php'; ?>
        </div>
    </body>
    </html>