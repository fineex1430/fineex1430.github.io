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
	
	$restaurant_name	=	"";
	$address			=	"";
	$contact_no_1		=	"";
	$contact_no_2		=	"";
	$owner_name			=	"";
	$mobile_number_error=	"";
	$msg				=	"";
	$image				=	"";
	$flag				=	0;
	$userid				=	"";
	$password			=	"";
	
	if(isset($_POST['update_hotel']))
	{
		$restaurant_name	=	$_POST['restaurant_name'];
		$address			=	$_POST['address'];
		$contact_no_1		=	$_POST['contact_no_1'];
		$contact_no_2		=	$_POST['contact_no_2'];
		$owner_name			=	$_POST['owner_name'];
		$userid				=	$_POST['userid'];	
		$password			=	$_POST['password'];
		
		if(strlen($contact_no_1)!=10)
		{
			$mobile_number_error	=	"Please Enter 10 Digit mobile_number";
			$flag					=	1;
		}
		
		if($flag==0)
		{
			$rest_exist	=	$db->check_user_name_already_exist($userid);
			
			if($rest_exist=="")
			{
			$valid_formats = array("jpg","png","gif","bmp","jpeg","pdf","JPEG","JPG","BMP","PNG","GIF","PDF");
			if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
			{	
				$name 				= 	$_FILES['image']['name'];
				$size 				= 	$_FILES['image']['size'];

				if(strlen($name))
				{
					list($txt, $ext) = explode(".", $name);
					
					if(in_array($ext,$valid_formats))
					{
						$files	=	array();

						function generateRandomString($length = 10) {
							$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
							$charactersLength = strlen($characters);
							$randomString = '';
							for ($i = 0; $i < $length; $i++) 
							{
								$randomString .= $characters[rand(0, $charactersLength - 1)];
							}
							return $randomString;
						}
						
						$current_random_string = generateRandomString();
						
						$image = $current_random_string.".".strtolower($ext);						

						$tmp = $_FILES['image']['tmp_name'];
						
						$img_Dir = "hotel_gallery/";
						
						if(!file_exists($img_Dir))
						{
							mkdir($img_Dir);
						}
						
						if(move_uploaded_file($tmp,$img_Dir.$image))
						{
							
						}
						else
						{
							$image_error	=	"failed" ;
							$flag				=	1;
						}	
					}
					else
					{
						$image_error	= "Invalid file format";
						$flag				=	1;	
					}	
				}
			}
			
			if($db->add_new_hotel($restaurant_name,$address,$image,$contact_no_1,$contact_no_2,$owner_name,$userid,$password))
			{
				$msg	=	1;
			}
			else
			{
				$msg	=	2;
			}
		}
		else
		{
			$msg	=	3;
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
                            <form class="form-pink" method="post" action="add-restaurant.php" name="myForm" onsubmit="return validateForm()" autocomplete="off" enctype="multipart/form-data">
									<?php
										if($msg==1)
										{
									?>
											<div  class="alert alert-success">
												Success...! New Restaurant Added.
											</div>
									<?php
										}
									?>
									<?php
									if($msg==2)
									{
									?>
										<div class="alert alert-danger">
											Faile To Update...!
										</div>
								<?php
									}
									
									if($msg==3)
									{
									?>
										<div class="alert alert-danger">
											This username is already exist
										</div>
								<?php
									}
								?>
									<div class="ibox-head">
										<div class="ibox-title">Add New Restaurant</div>
									</div>
                                <div class="ibox-body">
                                  <div class="form-group mb-4">
									<input type="text" name="restaurant_name" class="form-control form-control-air" placeholder="Restaurant Name" value="<?php echo $restaurant_name; ?>" required>
									<br />
									<textarea type="text" name="address" class="form-control form-control-air" placeholder="Address" required><?php echo $address; ?></textarea>
									<br />
									
								
									<input type="number" name="contact_no_1" class="form-control form-control-air" placeholder="Contact No.1" value="<?php echo $contact_no_1; ?>" required>
									<?php echo $mobile_number_error; ?>
									<br />
									<input type="number" name="contact_no_2" class="form-control form-control-air" placeholder="Contact No.2(Optional)" value="<?php echo $contact_no_2;?>" />
									<br />
									<input type="text" name="owner_name" class="form-control form-control-air" placeholder="Owner Name" value="<?php echo $owner_name;?>" required>
									
									<br />
									<input type="text" name="userid" class="form-control form-control-air" placeholder="Enter User Id" value="<?php echo $userid;?>" required>
									
									<br />
									<input type="text" name="password" class="form-control form-control-air" placeholder="Enter Password" value="<?php echo $password;?>" required>
									
									<br />
									<input type="file" name="image" class="form-control form-control-air" value="<?php echo $image;?>" required >
								</div>
                                <div class="ibox-footer">
                                   <center> <button class="btn btn-pink btn-air mr-2" type="submit" name="update_hotel">Update</button> </center>
                                   
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