<?php
    require_once('../admin/lib/functions.php');
	$db = new login_function();
	
	if(isset($_SESSION['current_login_restaurant']))
	{
		$current_login_admin	=	$_SESSION['current_login_restaurant'];
	}
	if(!isset($_SESSION['current_login_restaurant']))
	{	
		header("location:index.php");
	}
	
	$service_error_1 = "";
	$flag = 0;
	$menu_name_error	=	"";
	$success_message	=	0;
   
   if(isset($_POST['submit']))
   {
	   
	   $restaurant_id        =     $current_login_admin;
	   $menu_item_name       =     $_POST['menu_item_name'];
	   $item_description     =     $_POST['item_description'];
	   $price                =     $_POST['price'];
	   $discount             =     $_POST['discount'];
	   	
		if ($flag ==0)
		{
			$returned_id_by_db	=	$db->get_id_from_menu_item_name($restaurant_id,$menu_item_name);
			
			
			if($returned_id_by_db=="")
			{
				//Allowed extensions to upload file
				$valid_formats = array("jpg","png","gif","bmp","jpeg","pdf","JPEG","JPG","BMP","PNG","GIF","PDF");
	
		//Check Post method
		if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
		{	
			//Get name of choosen file
			$name 				= 	$_FILES['attachment1']['name'];
			//Get Size of choosen file
			$size 				= 	$_FILES['attachment1']['size'];
			
			//If file name is greater than 0 then execute if loop
			if(strlen($name))
				{		
                    echo 44;			
					//Separate the extension and text name of file in separate variables
					list($txt, $ext) = explode(".", $name);
					
					//Check, if the extension is allowed in formats
					if(in_array($ext,$valid_formats))
					{
          
					//Generate random name function for file
					function generateRandomString($length = 15) {
					$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
					$charactersLength = strlen($characters);
					$randomString = '';
					for ($i = 0; $i < $length; $i++) 
					{
						$randomString .= $characters[rand(0, $charactersLength - 1)];
					}
					return $randomString;
				}
						
						//Call random name function and store in variable
						$current_random_string = generateRandomString();
						
						//Join the Variables to Make Complete name of file
						$attachment1 = $current_random_string.".".strtolower($ext);					
						
						//Catch the temporary location of choosen file or path
						$tmp = $_FILES['attachment1']['tmp_name'];
						
						//Specify folder where to upload the posted image file
						$img_Dir = "attachment/";
						
						//Check if folder exist or not
						if(!file_exists($img_Dir))
						{
							//If foldwer not exist, make the folder
							mkdir($img_Dir);
						}
						
						//Copy the file from temp location or from path to your specified path
						if(move_uploaded_file($tmp,$img_Dir.$attachment1))
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
			
				//Save
				if($db->save_application($restaurant_id,$menu_item_name,$item_description,$price,$discount,$attachment1))
				{
					$success_message	=	1;
				}
			}
			else
			{
				$success_message	=	2;
					$menu_name_error	=	"This menu is already exist in Menu List";
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
}

</style>

<script>
function validateForm() {
  var current_password = document.forms["myForm"]["current_password"].value;
  var new_password = document.forms["myForm"]["new_password"].value;
  var confirm_password = document.forms["myForm"]["confirm_password"].value;
  if (current_password == "") {
    alert("Enter Current Password ");
    return false;
  }
  if (new_password == "") {
    alert("Enter New Password");
    return false;
  }
   if (confirm_password == "") {
    alert("Enter Confirm Password");
    return false;
  }
}
</script>
</head>

<body class="fixed-navbar">
    <div class="page-wrapper">
        <?php include('header.php'); ?>
        <?php include('side-bar.php'); ?>
			<div class="content-wrapper">
               <div class="row">
				 <div class="col-md-8">
                        <div class="ibox">
                            <form class="form-pink" method="post" action="<?php echo $_SERVER['PHP_SELF']?>" name="myForm" onsubmit="return validateForm()" autocomplete="off" enctype="multipart/form-data">
							
							<?php
								if($success_message ==1)
								{
								?>
									<div class="alert alert-success">
									<span class="alert-link">Success!</span>Your Menu Item Has Been Saved.
									</div>
								<?php
								}
								?>	
								<?php
								if($success_message ==2)
								{
								?>
									<div class="alert alert-danger">
									<span class="alert-link">Sorry!</span> This Menu Item Is Already Exist.
									</div>
								<?php
								}
								?>	
								
								<div class="ibox-head">
                                    <div class="ibox-title"> <i class="sidebar-item-icon fas fa-user-cog"></i>  Menu Item </div>
                                </div>
                                <div class="ibox-body">
                                  <div class="form-group mb-4">
								  <label class="form-group mb-4 set-row"><b>Enter Menu Item Name:</b></label>

									<div class="input-group-icon input-group-icon-left">
										<span class="input-icon input-icon-left"><i class=""></i></span>
										<input type="text" name="menu_item_name" class="form-control form-control-air" placeholder="Enter menu item name" value=""  required />
									</div>
								</div>
								<div class="form-group mb-4">
								<label class="form-group mb-4 set-row"><b>Enter Item Description:</b></label>
									<div class="input-group-icon input-group-icon-left">
										<span class="input-icon input-icon-left"><i class=""></i></span>
										<textarea name ="item_description" class="form-control form-control-air"  placeholder="Enter item description" value=""></textarea>

									</div>
								</div>
								<div class="form-group mb-4">
								<label class="form-group mb-4 set-row"><b>Enter Price:</b></label>
									<div class="input-group-icon input-group-icon-left">
										<span class="input-icon input-icon-left"><i class=""></i></span>
										<input type="number" name="price" class="form-control form-control-air" placeholder="Enter price" value=""  required />

									</div>
								</div>
								<div class="form-group mb-4">
								<label class="form-group mb-4 set-row"><b>Enter Discount:</b></label>
									<div class="input-group-icon input-group-icon-left">
										<span class="input-icon input-icon-left"><i class=""></i></span>
										<input type="number" name="discount" class="form-control form-control-air" placeholder="Enter discount(%)" value=""  required />

									</div>
								</div>
								
								<div class="form-group mb-4">
								<label class="form-group mb-4 set-row"><b>Menu Image:</b></label>
									<div class="input-group-icon input-group-icon-left">
										<span class="input-icon input-icon-left"><i class=""></i></span>
										<input type="file" name="attachment1" class="form-control form-control-air" placeholder="Select Image" value=""  required />
									</div>
								</div>
								
								
								<div class="ibox-footer">
                                   <center> <button class="btn btn-pink btn-air mr-2" type="submit"name="submit">Submit</button> </center>
                                   
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