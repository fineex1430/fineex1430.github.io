<?php
    require_once('../admin/lib/functions.php');
	$db = new login_function();
	
	$response = array();
	
	$restaurant_name	=	"";
	if(isset($_POST['restaurant_name']))
	{
		$restaurant_name       =     $_POST['restaurant_name'];
	}
	   
	$restaurant_data	=	array();
	$restaurant_data	=	$db->get_restaurant_list($restaurant_name);
	if(!empty($restaurant_data))
	{
		$response['status'] 	= 0;
		$response['message'] 	= $restaurant_data;
	}
	else
	{
		$response['status'] 	= 1;
		$response['message'] 	= "The Profile Of This Restaurant Name Does Not Exist";
	}
	
   echo json_encode($response);
   ?>
   
   