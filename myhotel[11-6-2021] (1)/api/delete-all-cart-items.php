<?php
    require_once('../admin/lib/functions.php');
	$db = new login_function();
	$flag = 0;
	$response = array();
	
	if(isset($_POST['user_mobile_number']))
   {
		$user_mobile_number      =     $_POST['user_mobile_number'];
		
		
		if($db->delete_all_carts_items($user_mobile_number))
		{
			$response['status'] 	= 0;
			$response['message'] 	= "All Cart Items Deleted Successfully";
		}
		else
		{
			$response['status'] 	= 1;
			$response['message'] 	= "Failed To Delete Cart Items";
		}
   }    
  
   echo json_encode($response);
   ?>