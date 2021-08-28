<?php 
	require_once('lib/functions.php');
	$db						=	new login_function();
	$mobile_no_error		=	"";
	$success_message		=	"";
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
	
	if(isset($_POST['submit']))
	{
		$full_name			=	$_POST['full_name'];
		$mobile_number		=	$_POST['mobile_number'];
		$password			=	$_POST['password'];
		
		if(strlen($mobile_number)!=10)
		{
			$mobile_no_error	=	"Please Enter 10 Digit mobile_number";
			$flag					=	1;
		}
		if($flag==0)
		{
			if($db->update_customer($full_name,$mobile_number,$password,$edit_id))
			{
				$success_message	=	1;
			}
			else
			{
				$success_message	=	2;
			}
		}
	}
	$data	=	array();
	$data	=	$db->get_reports_by_id($edit_id);
	
	if(!empty($data))
	{
		$id					=	$data[0];
		$full_name			=	$data[1];
		$mobile_number		=	$data[2];
		$password			=	$data[3];
		$date				=	$data[4];
		$time				=	$data[5];
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
                            <form class="form-pink" method="post"  name="myForm"  onsubmit="return validateForm()" autocomplete="off">
							<?php
								if($success_message ==1)
								{
								?>
									<div class="alert alert-success">
									<span class="alert-link">Success!</span> Updated.
									</div>
								<?php
								}
								?>	
								<?php
								if($success_message ==2)
								{
								?>
									<div class="alert alert-danger">
									<span class="alert-link">Sorry!</span> This Mobile Number Already Exist.
									</div>
								<?php
								}
								?>	
															
								<div class="ibox-head">
                                    <div class="ibox-title"> <i class="sidebar-item-icon fas fa-user-cog"></i>Edit Customer</div>
                                </div>
                                <div class="ibox-body ">
                                  <div class="form-group mb-4">
								  <label class="form-group mb-4 set-row"><b>Full Name:</b></label>

									<div class="input-group-icon input-group-icon-left">
										<span class="input-icon input-icon-left"><i class="fas fa-question-circle"></i></span>
										<input type="text"  class="form-control form-control-air" placeholder="Enter Full Name" value="<?php echo $full_name;?>" name="full_name"/>
									</div>
								</div>
								<div class="form-group mb-4">
								  <label class="form-group mb-4 set-row"><b>Mobile Number:</b></label>

									<div class="input-group-icon input-group-icon-left">
										<span class="input-icon input-icon-left"><i class="fas fa-question-circle"></i></span>
										<input type="text"  class="form-control form-control-air" placeholder="Enter Mobile Number" value="<?php echo $mobile_number;?>" name="mobile_number"/>
										
										 
									</div>
								</div>
								<div class="form-group mb-4">
								  <label class="form-group mb-4 set-row"><b>Password:</b></label>

									<div class="input-group-icon input-group-icon-left">
										<span class="input-icon input-icon-left"><i class="fas fa-dot-circle"></i></span>
										<input type="password"  class="form-control form-control-air" placeholder="Enter password" value="<?php echo $password;?>"  name="password"  />
									</div>
								</div>
								<div class="ibox-footer">
                                   <center> <button class="btn btn-pink btn-air mr-2" type="submit" name="submit"> Submit</button> </center>
                                   
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