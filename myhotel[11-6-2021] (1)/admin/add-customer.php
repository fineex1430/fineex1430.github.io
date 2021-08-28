<?php
    require_once('lib/functions.php');
	$db = new login_function();
	$flag = 0;
	$success_message = 0;
	$mobile_number_error = "";
	
	if(isset($_POST['submit']))
   {
       $full_name    			 =     $_POST['full_name'];
	   $mobile_number      		 =     $_POST['mobile_number'];
	   $password       			 =     $_POST['password'];
	   
	   if(strlen($mobile_number)!=10)
		{
			$mobile_number_error	=	"**Please enter 10 digit Mobile Number**";
			$flag = 1;
		}
	   
	    if ($flag ==0)
		{
		  $returned_id_by_db	=	$db->get_id_from_user_name($mobile_number);
			
			if($returned_id_by_db=="")
			{	
				//Save
				if($db->save_user_data($full_name,$mobile_number,$password))
				{  
					$success_message = 1;
				}
			}
			else
			{
				$success_message = 2;
			}	
				
		}
   }    
   ?>
	  	
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title><?php echo $project_title; ?></title>
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

@media only screen and (max-width: 600px) 
{
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
                            <form class="form-pink" method="post"  name="myForm"  onsubmit="return validateForm()" autocomplete="off">
							<?php
								if($success_message ==1)
								{
								?>
									<div class="alert alert-success">
									<span class="alert-link">Success!</span> saved.
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
                                    <div class="ibox-title"> <i class="sidebar-item-icon fas fa-user-cog"></i>Add Customer Form</div>
                                </div>
                                <div class="ibox-body ">
                                  <div class="form-group mb-4">
								  <label class="form-group mb-4 set-row"><b>Full Name:</b></label>

									<div class="input-group-icon input-group-icon-left">
										<span class="input-icon input-icon-left"><i class="fas fa-question-circle"></i></span>
										<input type="text"  class="form-control form-control-air" placeholder="Enter Full Name" name="full_name"/>
									</div>
								</div>
								<div class="form-group mb-4">
								  <label class="form-group mb-4 set-row"><b>Mobile Number:</b></label>

									<div class="input-group-icon input-group-icon-left">
										<span class="input-icon input-icon-left"><i class="fas fa-question-circle"></i></span>
										<input type="text"  class="form-control form-control-air" placeholder="Enter Mobile Number" name="mobile_number"/>
										<div><?php echo $mobile_number_error; ?></div>
										 
									</div>
								</div>
								<div class="form-group mb-4">
								  <label class="form-group mb-4 set-row"><b>Password:</b></label>

									<div class="input-group-icon input-group-icon-left">
										<span class="input-icon input-icon-left"><i class="fas fa-dot-circle"></i></span>
										<input type="password"  class="form-control form-control-air" placeholder="Enter password" value="" name="password"  />
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