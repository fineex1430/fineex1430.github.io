<?php
	require_once('lib/functions.php');
	$db			=	new login_function();
	
	if(isset($_SESSION['current_login_admin']))
	{
		$current_login_admin	=	$_SESSION['current_login_admin'];
	}
	if(!isset($_SESSION['current_login_admin']))
	{	
		header("location:index.php");
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title></title>
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
    <!-- PAGE LEVEL STYLES-->
<style>
.col-md-8
{
	width:100%;
	margin:auto;
	margin-top:20px;
}

@media only screen and (max-width: 600px) {
	.col-md-8
	{
		margin:30px;
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
	.form-control form-control-air
	{
		margin-top:10px;
	}
}

</style>
</head>

<body class="fixed-navbar">
    <div class="page-wrapper">
        <?php include('header.php'); ?>
        <?php include('side-bar.php'); ?>
			<div class="content-wrapper">
               <div class="row">
				 <div class="col-md-8">
                        <div class="ibox">
                            <form class="form-pink" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" name="myForm" onsubmit="return validateForm()" autocomplete="off" enctype="multipart/form-data">
									
									<div class="ibox-head">
										<div class="ibox-title">Send Notification To Customers</div>
									</div>
                                <div class="ibox-body">
                                  <div class="form-group mb-4">
									
									<textarea type="text" name="notification_message" class="form-control form-control-air" placeholder="Enter Notification / Message" required style="height:200px;"></textarea>
									
									<br />
									
									<center> <button class="btn btn-pink btn-air mr-2" type="submit" name="update_hotel">Send Notification</button> </center>
																	   
								</div>
                            </form>
							
                        
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
    <script src="js/app.min.js"></script>
    <!-- PAGE LEVEL SCRIPTS-->
</body>

</html>