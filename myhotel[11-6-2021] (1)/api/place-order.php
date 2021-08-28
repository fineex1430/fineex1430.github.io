<?php
    require_once('../admin/lib/functions.php');
	$db = new login_function();
	$flag = 0;
	$response = array();
	
	function generateRandomString($length = 15) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
	
	if(isset($_POST['mobile_number']))
   {
	    $mobile_number      =     $_POST['mobile_number'];
	    $order_id       	=     generateRandomString();
		$item_id       		=     $_POST['item_id'];
		$item_name       	=     $_POST['item_name'];
		$item_price       	=     $_POST['item_price'];
		$item_max_price     =     $_POST['item_max_price'];
		$item_discount      =     $_POST['item_discount'];
		$item_quantity      =     $_POST['item_quantity'];
		$final_bill_amount  =     $_POST['final_bill_amount'];
		$restaurant_id 		=     $_POST['restaurant_id'];
		
		
		
		//Save
		if($inserted_id= $db->save_user_order_data($mobile_number,$order_id,$restaurant_id))
		{  	//Save
			if($db->save_user_order_item($inserted_id,$item_id,$item_name,$item_price,$item_max_price,$item_discount,$item_quantity,$final_bill_amount))
			{  
				$response['status'] 	= 0;
				$response['message'] 	= "Order Placed successflly";
			}	
			else
			{
				$response['status'] 	= 1;
				$response['message'] 	= "Order Item Not saved";
			}	
		}
		else
		{
			$response['status'] 	= 1;
			$response['message'] 	= "Order Not Placed!!!";
		}	
   }    
   
   echo json_encode($response);
   ?>