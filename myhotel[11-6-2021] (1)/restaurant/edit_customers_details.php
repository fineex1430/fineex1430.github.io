<?php 
	require_once('lib/functions.php');
	$db						=	new login_function();
	$mobile_no_error		=	"";
	$message				=	"";
	$flag					=	0;
	if(isset($_SESSION['current_login_admin']))
	{
		$current_login_admin	=	$_SESSION['current_login_admin'];
	}
	if(!isset($_SESSION['current_login_admin']))
	{	
		header("location:index.php");
	}
	
	if(isset($_GET['edit_id']))
	{
		$edit_id				=	$_GET['edit_id'];
		$_SESSION['edit_id']	= 	$edit_id;
	}
	else if(isset($_SESSION['edit_id']))
	{
		$edit_id				=	$_SESSION['edit_id'];
		
	}
	
	if(isset($_POST['update_record']))
	{
		$full_name			=	$_POST['full_name'];
		$address			=	$_POST['address'];
		$mobile_number		=	$_POST['mobile_number'];
		$password			=	$_POST['password'];
		
		if(strlen($mobile_number)!=10)
		{
			$mobile_no_error	=	"Please Enter 10 Digit mobile_number";
			$flag					=	1;
		}
		if($flag==0)
		{
			if($db->update_customer($full_name,$address,$mobile_number,$password,$edit_id))
			{
				$message	=	1;
			}
			else
			{
				$message	=	2;
			}
		}
	}
	$data	=	array();
	$data	=	$db->get_reports_by_id($edit_id);
	
	if(!empty($data))
	{
		$id					=	$data[0];
		$full_name			=	$data[1];
		$address			=	$data[2];
		$mobile_number		=	$data[3];
		$password			=	$data[4];
		$date				=	$data[5];
		$time				=	$data[6];
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Edit Customer</title>
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
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  
    <!-- PAGE LEVEL STYLES-->
</head>
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
<body class="fixed-navbar">
    <div class="page-wrapper">
        <!-- START HEADER-->
        <?php include('header.php'); ?>
        <!-- END HEADER-->
        <!-- START SIDEBAR-->
		<?php include('side-bar.php'); ?>
        <!-- END SIDEBAR-->
        <div class="content-wrapper">
            <!-- START PAGE CONTENT-->
             <div class="col-md-8">
                        <div class="ibox">
                            <form class="form-pink" method="post" action="edit_customers_details.php" name="myForm" onsubmit="return validateForm()" autocomplete="off">
								<?php
									if($message==1)
									{
								?>
										<div  class="alert alert-success">
											Record Updated Succesffully !!!
										</div>
								<?php
									}
								?>
								<?php
									if($message==2)
									{
								?>
										<div class="alert alert-danger">
											Faile To Add!!!
										</div>
								<?php
									}
								?>
                                <div class="ibox-head">
                                    <div class="ibox-title">Update Customer </div>
                                </div>
                                <div class="ibox-body">
                                  <div class="form-group mb-4">
									<input type="text" name="full_name" class="form-control form-control-air" placeholder=" Full Name" value="<?php echo $full_name;?>" required>
									<br />
									<textarea type="text" name="address" class="form-control form-control-air" placeholder=" Address(Optional)"><?php echo $address;?></textarea>
									<br />
									<input type="number" name="mobile_number" class="form-control form-control-air" placeholder="Mobile Number" value="<?php echo $mobile_number;?>" required>
									<?php echo $mobile_no_error;?>
									<br />
									<input type="password" name="password" class="form-control form-control-air" placeholder="Password" value="<?php echo $password;?>" required>
									<br />
								</div>
                                <div class="ibox-footer">
                                   <center> <button class="btn btn-pink btn-air mr-2" type="submit" name="update_record">Update</button> </center>
                                   
                                </div>
                            </form>
							
                        
                        </div>
                    </div>
                </div>
            
            <!-- END PAGE CONTENT-->
            <?php include('footer.php'); ?>
        </div>
    </div>
    <!-- START SEARCH PANEL-->
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
    <!-- END QUICK SIDEBAR-->
    <!-- CORE PLUGINS-->
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