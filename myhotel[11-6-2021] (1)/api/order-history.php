<?php
    require_once('../admin/lib/functions.php');
	$db = new login_function();
	
	$response = array();
	
	if(isset($_POST['mobile_number']))
	{
		$mobile_number       =     $_POST['mobile_number'];
		 
		$info_data	=	array();
		$info_counter = 0;
	   
		$user_data	=	array();
		$user_data	=	$db->get_user_data_history($mobile_number);
		if(!empty($user_data))
		{
			foreach($user_data as $record)
			{
			
				$id     				=    $record['id'];
			   $mobile_number     		=    $record['mobile_number'];
			   $order_id      		 	=    $record['order_id'];
			   $date				    =	 $record['date'];
			   $time				    =	 $record['time'];
			   $order_status			=	 $record['order_status'];
			   $restaurant_id			=	 $record['restaurant_id'];
				
				$info_data[$info_counter]['id']					=	$id;
				$info_data[$info_counter]['mobile_number']		=	$mobile_number;
				$info_data[$info_counter]['order_id']			=	$order_id;
				$info_data[$info_counter]['date']				=	$date;
				$info_data[$info_counter]['time']				=	$time;
				$info_data[$info_counter]['order_status']		=	$order_status;
				$info_data[$info_counter]['restaurant_id']		=	$restaurant_id;
				
			
				$order_data	=	array();
				$order_data	=	$db->get_user_order_history($id);
				if(!empty($order_data))
				{
					$info_data[$info_counter]['order_menu_info']	=	$order_data;
				}
				$info_counter++;
			}
		}
		
		$response['status'] 	= 0;
		$response['message'] 	= $info_data;
		
	}
	
   echo json_encode($response);
   ?>
   
   