<?php 
	require_once('lib/functions.php');

	$db			=	new login_function();
	$message	=	"";
		
	if(isset($_SESSION['current_login_admin']))
	{
		$current_login_admin	=	$_SESSION['current_login_admin'];
	}
	if(!isset($_SESSION['current_login_admin']))
	{	
		header("location:index.php");
	}
	if(isset($_GET['del_id']))
	{
		$del_id=$_GET['del_id'];
		if($db->del_detail($del_id))
		{
			$message=	1;
		}
		else
		{
			$message=	2;
		}
	}
	
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Customers Reports</title>
    <!-- GLOBAL MAINLY STYLES-->
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/font-awesome.min.css" rel="stylesheet" />
    <link href="css/line-awesome.min.css" rel="stylesheet" />
    <link href="css/themify-icons.css" rel="stylesheet" />
    <link href="css/animate.min.css" rel="stylesheet" />
    <link href="css/toastr.min.css" rel="stylesheet" />
    <link href="css/bootstrap-select.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  
    <!-- PLUGINS STYLES-->
    <!-- THEME STYLES-->
    <link href="css/main.min.css" rel="stylesheet" />
	 <link href="datatable/datatables.min.css" rel="stylesheet" />
    <!-- PAGE LEVEL STYLES-->
<style>
.col-md-12
{
	width:100%;
	margin:auto;
	margin-top:20px;
}
table,th,td
{
	text-align:center;
}
@media only screen and (max-width: 600px) {
	.col-md-12
	{
		width:100%;
	}
	.alert
	{
		width:100%;
	}
	.side-row
	{
		width:49%;
		display:inline-table;
	}
}

</style>

<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="js/wow.min.js"></script>

</head>

<body class="fixed-navbar">
<div class="page-wrapper">
<?php include('header.php'); ?>
<?php include('side-bar.php'); ?>
<div class="content-wrapper">
<div class="row">
<div class="col-md-12">
<div class="page-content fade-in-up">
<div class="ibox">
<div class="ibox-body">
							<?php
									if($message==1)
									{
								?>
										<div  class="alert alert-success">
											Deleted Succesffully !!!
										</div>
								<?php
									}
								?>
								<?php
									if($message==2)
									{
								?>
										<div class="alert alert-danger">
											Faile To Delete!!!
										</div>
								<?php
									}
								?>
<h5 class="font-strong mb-4">Customers Report</h5>
<h5 class="font-strong mb-4"><a href="" style="float:right; color:green;"> PRINT </a> </h5>
<div class="flexbox mb-4">
<div class="input-group-icon input-group-icon-left mr-3">
<span class="input-icon input-icon-right font-16"><i class="fas fa-search"></i></span>
<input class="form-control form-control-rounded form-control-solid" id="key-search" type="text" placeholder="Search ...">
</div>
</div>
<div class="table-responsive row">
<table class="table table-bordered table-hover" id="example" style="overflow-x:auto;overflow-y:auto;">
<thead class="thead-default thead-lg">
			<tr>
				<th>id</th>	
				<th>Full Name</th>
				<th>Mobile Number</th>
				<th>Password</th>
				<th>Date</th>
				<th>Time</th>
				<th>EDIT</th>
				<th>Delete</th>
	
			</tr>
</thead>
<tbody>
<?php
				$customers_details	=	array();
				$customers_details	=	$db->get_customers_details();
				if(!empty($customers_details))
				{
					foreach($customers_details as $record)
					{
						$id				=	$record[0];
						$full_name		=	$record[1];
						$mobile_number	=	$record[2];
						$password		=	$record[3];
						$date			=	$record[4];
						$time			=	$record[5];
						
			?>	
					<tr>
						<td><?php echo $id?></td>
						<td><?php echo $full_name?></td>
						<td><?php echo $mobile_number?></td>
						<td><?php echo $password?></td>
						<td><?php echo $date?></td>
						<td><?php echo $time?></td>
						<td><a href="edit_customers_details.php?edit_id=<?php echo $id;?>">Edit</a></td>
						<td><a href="customers_report.php?del_id=<?php echo $id;?>" onclick="return confirm('Are you sure to remove?');">Remove</a></td>
					</tr>
					<?php
					}
				}
					?>
</tbody> 
</table> 
</div>
</div>
</div>
</div>
</div>
</div>
                <?php include('footer.php'); ?>
	</div>
    </div>
   
    <?php include('search.php'); ?>
    <!-- END SEARCH PANEL-->
    <!-- BEGIN THEME CONFIG PANEL-->
    
    <!-- END THEME CONFIG PANEL-->
    <!-- BEGIN PAGA BACKDROPS-->
    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>
    <!-- END PAGA BACKDROPS-->
    <!-- New question dialog-->
    
    <!-- End New question dialog-->
    <!-- QUICK SIDEBAR-->
    <?php include('right-side-bar.php'); ?>
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/metisMenu.min.js"></script>
    <script src="js/jquery.slimscroll.min.js"></script>
    <script src="js/idle-timer.min.js"></script>
    <script src="js/toastr.min.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/bootstrap-select.min.js"></script>
    <!-- PAGE LEVEL PLUGINS-->
    <!-- CORE SCRIPTS-->
	<script src="datatable/datatables.min.js"></script>
    <script src="js/app.min.js"></script>
	<script>
  $(function() {
            $('#example').DataTable({
                pageLength: 25,
                fixedHeader: true,
                responsive: true,
                "sDom": 'rtip',
                columnDefs: [{
                    targets: 'no-sort',
                    orderable: false
                }]
            });

            var table = $('#example').DataTable();
            $('#key-search').on('keyup', function() {
                table.search(this.value).draw();
            });
          
        });
</script>
	
    <!-- PAGE LEVEL SCRIPTS-->
</body>

</html>