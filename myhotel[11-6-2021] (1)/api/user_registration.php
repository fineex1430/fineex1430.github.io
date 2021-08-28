<?php
    require_once('../admin/lib/functions.php');
	$db = new login_function();
	$flag = 0;
	$response = array();
	
	if(isset($_POST['full_name']))
   {
       $full_name    			 =     $_POST['full_name'];
	   $mobile_number      		 =     $_POST['mobile_number'];
	   $password       			 =     $_POST['password'];
	   
	   if(strlen($mobile_number)!=10)
		{
			$mobile_number_error	=	"Please enter 10 digit Mobile Number";
			$flag = 1;
			$response['status'] 	= 1;
			$response['message'] 	= "Please enter 10 digit Mobile Number";
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
					$response['status'] 	= 0;
					$response['message'] 	= "User account created successflly";
				}
			}
			else
			{
				$success_message = 2;
				$response['status'] 	= 1;
				$response['message'] 	= "This user is already exist";
			}	
				
		}
   }    
   
   echo json_encode($response);
   ?>