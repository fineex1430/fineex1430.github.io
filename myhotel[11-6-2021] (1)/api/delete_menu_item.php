<?php
    require_once('../admin/lib/functions.php');
	$db = new login_function();
	$response = array();
	
	if(isset($_POST['menu_item_id']))
   {
		$menu_item_id			  =     $_POST['menu_item_id'];
		$user_mobile_number		  =     $_POST['user_mobile_number'];
		
		if($db->delete_menu_item($menu_item_id))
		{
			$response['status'] 	= 0;
			$response['message'] 	= "Menu Items Deleted Successfully";
		}
		else
		{
			$response['status'] 	= 1;
			$response['message'] 	= "Failed To Delete Menu Items";
		}
   }    
   
   echo json_encode($response);
   ?>