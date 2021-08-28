<?php
    require_once('../admin/lib/functions.php');
	$db = new login_function();
	
	$response = array();
	
	if(isset($_POST['mobile_number']))
	{
		$mobile_number       =     $_POST['mobile_number'];
	   
		$profile_data	=	array();
		$profile_data	=	$db->get_user_profile($mobile_number);
		if(!empty($profile_data))
		{
			$response['status'] 	= 0;
			$response['message'] 	= $profile_data;
		}
		else
		{
			$response['status'] 	= 1;
			$response['message'] 	= "The Profile Of This Mobile Number Does Not Exist";
		}
	}
	
   echo json_encode($response);
   ?>
   
   