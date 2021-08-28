<?php
    require_once('../admin/lib/functions.php');
	$db = new login_function();
	
	$response = array();
	
	if(isset($_POST['user_mobile_number']))
	{
		$user_mobile_number       =     $_POST['user_mobile_number'];
		
		$cart_details	=	array();
		$cart_counter	=	0;
	   
		$restaurant_list_data	=	array();
		$restaurant_list_data	=	$db->get_cart_items_added_by_user($user_mobile_number);
		
		if(!empty($restaurant_list_data))
		{
			foreach($restaurant_list_data as $record)
			{
				//all varivle ithe kadhun ghya 
				$id						=	$record['id'];
				$user_mobile_number		=	$record['mobile_number'];	
				$restaurant_id			=	$record['restaurant_id'];
				$menu_item_id			=	$record['menu_item_id'];
				$quantity				=	$record['quantity'];
				$total_amount			=	$record['total_amount'];
				$total_discount			=	$record['total_discount'];
				$final_amount			=	$record['final_amount'];
				$date					=	$record['date'];
				$time					=	$record['time'];
				
				/*********************************************/
				$price 			= 	0;
				$discount		= 	0;
				$menu_item_name	=	"";
				$menu_details= array();
				$menu_details= $db->get_menu_item_details($menu_item_id);
				if(!empty($menu_details))
				{
					$price 			= 	$menu_details[0];
					$discount		=	$menu_details[1];
					$menu_item_name	=	$menu_details[2];
				}
				
				/*********************************************/
				$restaurant_name	=	"";
				$restauranrt_addr	=	"";
				$restaurant_details	=	array();
				$restaurant_details	=	$db->get_details_by_id($restaurant_id);
				
				if(!empty($restaurant_details))
				{
					$restaurant_name	=	$restaurant_details[1];
					$restauranrt_addr	=	$restaurant_details[2];
				}
				
				/*********************************************/
				
				$cart_details[$cart_counter]['cart_id']			=	$id;
				$cart_details[$cart_counter]['mobile_number']	=	$user_mobile_number;
				$cart_details[$cart_counter]['restaurant_id']	=	$restaurant_id;
				$cart_details[$cart_counter]['restaurant_name']	=	$restaurant_name;
				$cart_details[$cart_counter]['restauranrt_addr']=	$restauranrt_addr;
				$cart_details[$cart_counter]['menu_item_id']	=	$menu_item_id;
				$cart_details[$cart_counter]['menu_item_name']	=	$menu_item_name;
				$cart_details[$cart_counter]['price']			=	$price;
				$cart_details[$cart_counter]['discount']		=	$discount;
				$cart_details[$cart_counter]['quantity']		=	$quantity;
				$cart_details[$cart_counter]['total_amount']	=	$total_amount;
				$cart_details[$cart_counter]['total_discount']	=	$total_discount;
				$cart_details[$cart_counter]['final_amount']	=	$final_amount;
				$cart_details[$cart_counter]['date']			=	$date;
				$cart_details[$cart_counter]['time']			=	$time;
				
				$cart_counter++;
			}
			
			if(!empty($cart_details))
			{
				$response['status'] 	= 0;
				$response['message'] 	= $cart_details;
			}
			else{
				$response['status'] 	= 1;
				$response['message'] 	= "No any cart items availble";
			}
		}
		else
		{
			$response['status'] 	= 1;
			$response['message'] 	= "No any cart items availble";
		}
	}
	else{
			$response['status'] 	= 1;
			$response['message'] 	= "Key not matched";
	}
	
   echo json_encode($response);
?>
   
   