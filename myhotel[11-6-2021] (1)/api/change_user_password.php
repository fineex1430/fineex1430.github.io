<?php 
	require_once('../admin/lib/functions.php');
	$db		=	new login_function();
	$flag						=	0;
	$new_password				=	"";
	$current_password			=	"";
	$confirm_password			=	"";
	$response = array();
	
	if(isset($_POST['mobile_number']))
	{
		$mobile_number	    =	$_POST['mobile_number'];
		$current_password	=	$_POST['current_password'];
		$new_password		=	$_POST['new_password'];
		$confirm_password	=	$_POST['confirm_password'];
		
		if(strlen($mobile_number)!=10)
		{
			$flag = 1;
			$response['status'] 	= 1;
			$response['message'] 	= "Please enter 10 digit Mobile Number";
		}
			if ($flag ==0)
			{
			 $result_password	=	$db->get_password_from_user_mobile_number($mobile_number);
			 if($result_password==$current_password)
			 {
		
				if($new_password==$confirm_password)
				{
					if($db->change_password($mobile_number,$new_password))
					{
					
						$response['status'] 	= 0;
						$response['message'] 	= "	Password Changed Successfully to ".$new_password;
					}
					else
					{
						$response['status'] 	= 1;
						$response['message'] 	= "Failed To Update New Password";
					}	
				}
				else
				{	
					$response['status'] 	= 1;
					$response['message'] 	= "New password not matched with confirm password";
				}
			  }			
				else
				{	
					$response['status'] 	= 1;
					$response['message'] 	= "Incorrect Password";
				}
			}
    }
 echo json_encode($response);
?>
