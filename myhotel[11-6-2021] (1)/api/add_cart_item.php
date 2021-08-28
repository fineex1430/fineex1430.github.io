<?php
    require_once('../admin/lib/functions.php');
	$db = new login_function();
	$flag = 0;
	$response = array();
	
	if(isset($_POST['user_mobile_number']))
   {
       
	   $user_mobile_number      =     $_POST['user_mobile_number'];
	   $restaurant_id      		=     $_POST['restaurant_id'];
	  $menu_item_id      		=     $_POST['menu_item_id'];
	  $quantity    			 	=     $_POST['quantity'];
	  
	   
		$another_restaurant_id 	=	 $db->check_another_restaurant_cart_exist_for_same_user($restaurant_id,$user_mobile_number);
		
		if($another_restaurant_id=="")
		{
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
			
			$total_amount = $price * $quantity  ;
			$total_discount = $quantity*$discount;
			$final_amount = $total_amount-$total_discount;
			
			/********************************************************/
			
			$exist_menu_id	=	$db->get_user_cart_exist_menu_id($menu_item_id,$user_mobile_number);
			
			if($exist_menu_id=="")
			{
				//Save New Menu Item
				if($db->save_cart_items($user_mobile_number,$restaurant_id,$menu_item_id,$quantity,$total_amount,$total_discount,$final_amount))
				{
					$response['status'] 	= 0;
					$response['message'] 	= "Added To The Cart";
				}
				else
				{
					$response['status'] 	= 1;
					$response['message'] 	= "Unable To Add ";
				}
			}
			else
			{
				//Update existing Item Quantity
				if($db->update_cart_menu_item_details($user_mobile_number,$restaurant_id,$menu_item_id,$quantity,$total_amount,$total_discount,$final_amount,$exist_menu_id))
				{
					$response['status'] 	= 0;
					$response['message'] 	= "Cart Items Updated Successfully";
				}
				else
				{
					$response['status'] 	= 1;
					$response['message'] 	= "Unable To Add ";
				}
				
			}
		}
		else
		{
			$response['status'] 	= 1;
			$response['message'] 	= "You Are Trying To Place Menu Item of Another Restaurant, Previous All Menus Will Be Discarded.. Do You Want To Proceed?";
		}
   }    
   
   echo json_encode($response);
   ?>