<?php
    require_once('../admin/lib/functions.php');
	$db = new login_function();
	
	$response = array();
	
	if(isset($_POST['restaurant_id']))
	{
		$restaurant_id       =     $_POST['restaurant_id'];
	   
		$menu_item_data	=	array();
		$menu_item_data	=	$db->get_restaurant_menu_item($restaurant_id);
		if(!empty($menu_item_data))
		{
			$response['status'] 	= 0;
			$response['message'] 	= $menu_item_data;
		}
		else
		{
			$response['status'] 	= 1;
			$response['message'] 	= "Please Enter Correct Restaurant ID";
		}
	}
	
   echo json_encode($response);
   ?>
   
   