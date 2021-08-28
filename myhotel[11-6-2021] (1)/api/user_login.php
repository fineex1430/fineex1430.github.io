<?php
    require_once('../admin/lib/functions.php');
	$db = new login_function();
	$flag = 0;
	$response = array();
	
	if(isset($_POST['mobile_number']))
   {
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
		  $result_password	=	$db->get_password_from_user($mobile_number);
			
			if($result_password=="")
			{	
				$success_message = 1;
				$response['status'] 	= 1;
				$response['message'] 	= "This User Is Not Exist";
			
			}
			else
			{
				if($result_password==$password)
				{
					$success_message = 2;
					$response['status'] 	= 0;
					$response['message'] 	= "Log-In Successful";
				}
				else
				{
					$response['status'] 	= 1;
					$response['message'] 	= "Incorrect Password";
				}
					
			}	
				
		}
   }    
   
   echo json_encode($response);
   ?>