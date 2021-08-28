<?php
	session_start();
	date_default_timezone_set('Asia/Kolkata');
		$project_title  =   "PATHFINDERS";
		class login_function
		{
			private $con;
			
			function __construct()
			{
				$this->con = new mysqli("localhost","root","","coshield");
			}
			
			function get_password_from_user_name($email)
			{
				if($stmt_select = $this->con->prepare("Select `password` from `admin` where `admin_name` = ? "))
				{	
					$stmt_select->bind_param("s",$email);
				
					$stmt_select->bind_result($result_password);
				
					if($stmt_select->execute())
					{
						if($stmt_select->fetch())
						{
							return $result_password;
						}
					}
							return false;
				}
			}
			
			function check_user_name_already_exist($email)
			{
				if($stmt_select = $this->con->prepare("Select `id` from `restaurant` where `username` = ? "))
				{	
					$stmt_select->bind_param("s",$email);
				
					$stmt_select->bind_result($result_password);
				
					if($stmt_select->execute())
					{
						if($stmt_select->fetch())
						{
							return $result_password;
						}
					}
							return false;
				}
			}
			
			function get_password_restaurant($email)
			{
				if($stmt_select = $this->con->prepare("Select `password` from `restaurant` where `username` = ? "))
				{	
					$stmt_select->bind_param("s",$email);
				
					$stmt_select->bind_result($result_password);
				
					if($stmt_select->execute())
					{
						if($stmt_select->fetch())
						{
							return $result_password;
						}
					}
					return false;
				}
			}
			
			function change_user_password($email,$password)
			{ 
				$date = date("Y-m-d");
				$time = date("H:i:s A");
			
				if($stmt_select = $this->con->prepare("update `admin` set `password`='".$password."' where `admin_name` = ?"))
				{
					$stmt_select->bind_param("s",$email);				
				
					if($stmt_select->execute())
					{					
						return true;
					}
						return false;
				}
			}
			function save_customer($name,$address,$mobile_number,$password)
			{
				$date	=	date("Y-m-d");
				$time	=	date("H:i:s");
				if($stmt=$this->con->prepare("INSERT INTO `customer`(`full_name`,`address`,`mobile_number`,`password`,`date`,`time`) VALUES(?,?,?,?,?,?)"))
				{
					$stmt->bind_param("ssisss",$name,$address,$mobile_number,$password,$date,$time);
					if($stmt->execute())
					{
						return true;
					}
					return false;
				}
			}
			
			function get_customers_details()
		{
			if($stmt=$this->con->prepare("SELECT `id`, `full_name`,`mobile_number`,`password`,`date`,`time` FROM `user`"))
			{
			$stmt->bind_result($id,$full_name,$mobile_number,$password,$date,$time);
			if($stmt->execute())
			{
				$data		=	array();
				$counter	=	0;
				while($stmt->fetch())
				{
					$data[$counter][0]		=	$id;
					$data[$counter][1]		=	$full_name;
					$data[$counter][2]		=	$mobile_number;
					$data[$counter][3]		=	$password;
					$data[$counter][4]		=	$date;
					$data[$counter][5]		=	$time;
	
					$counter++;
				}
				if(!empty($data))
				{
					return $data;
				}
				else
				{
					return false;
				}
			}
			}
		}
			function update_customer($full_name,$mobile_no,$password,$edit_id)
			{
				$date	=	date("Y-m-d");
				$time	=	date("H:i:s");
				$stmt	=	$this->con->prepare("UPDATE `user` SET `full_name`=?,`mobile_number`=?,`password`=?,`date`=?,`time`=? WHERE `id`=?");
				$stmt->bind_param("sssssi",$full_name,$mobile_no,$password,$date,$time,$edit_id);
				if($stmt->execute())
				{
					return true;
				}
				else
				{
					return false;
				}
			}
			
			function get_reports_by_id($edit_id)
			{
				
				if($stmt =	$this->con->prepare("SELECT `id`, `full_name`, `mobile_number`, `password`, `date`, `time` FROM `user` WHERE `id`=?"))
				{
					
					$stmt->bind_param("i",$edit_id);
					$stmt->bind_result($id,$full_name,$mobile_no,$password,$date,$time);
					if($stmt->execute())
					{
					
						$data	=	array();
						if($stmt->fetch())
						{
					
							$data[0]	=	$id;
							$data[1]	=	$full_name;
							$data[2]	=	$mobile_no;
							$data[3]	=	$password;
							$data[4]	=	$date;
							$data[5]	=	$time;
							return $data;
						}
					}
					else
					{
						return false;
					}
				}
			}

		function del_detail($del_id)
		{
			if($stmt=$this->con->prepare("DELETE FROM `user` WHERE `id`=?"))
			$stmt->bind_param("i",$del_id);
			if($stmt->execute())
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		
		
		function save_hotel($restaurant_name,$address,$image,$contact_no_1,$contact_no_2,$owner_name)		
			{
				$date	=	date("Y-m-d");
				$time	=	date("H:i:s");
				if($stmt	=	$this->con->prepare("INSERT INTO `restaurant`(`restaurant_name`, `address`, `image`, `contact_no_1`, `contact_no_2`, `owner_name`, `date`, `time`) VALUES(?,?,?,?,?,?,?,?)"))
				{
					$stmt->bind_param("sssiisss",$restaurant_name,$address,$image,$contact_no_1,$contact_no_2,$owner_name,$date,$time);
					if($stmt->execute())
					{
						return true;
					}
					else
					{
						return false;
					}
				}
			}
		function get_hotel_details()
		{
			if($stmt=$this->con->prepare("SELECT `id`, `restaurant_name`, `address`, `image`, `contact_no_1`, `contact_no_2`, `owner_name`, `date`, `time`,`username`,`password` FROM `restaurant`"))
			{
				$stmt->bind_result($id,$restaurant_name,$address,$image,$contact_no_1,$contact_no_2,$owner_name,$date,$time,$userid,$password);
				if($stmt->execute())
				{
					$data		=	array();
					$counter	=	0;
					while($stmt->fetch())
					{
						$data[$counter][0]		=	$id;
						$data[$counter][1]		=	$restaurant_name;
						$data[$counter][2]		=	$address;
						$data[$counter][3]		=	$image;
						$data[$counter][4]		=	$contact_no_1;
						$data[$counter][5]		=	$contact_no_2;
						$data[$counter][6]		=	$owner_name;
						$data[$counter][7]		=	$date;
						$data[$counter][8]		=	$time;
						$data[$counter][9]		=	$userid;
						$data[$counter][10]		=	$password;
						
						$counter++;
					}
					if(!empty($data))
					{
						return $data;
					}
					else
					{
						return false;
					}
				}
			}
		}
		
		function update_hotel($restaurant_name,$address,$image,$contact_no_1,$contact_no_2,$owner_name,$userid,$password,$edit_id)
		{
			$date	=	date("Y-m-d");
			$time	=	date("H:i:s");
			
			$stmt	=	$this->con->prepare("UPDATE `restaurant` SET `restaurant_name`=?,`address`=?,`image`=?,`contact_no_1`=?,`contact_no_2`=?,`owner_name`=?,`date`=?,`time`=?,`username`=?,`password`=? WHERE `id`=?");
			
			$stmt->bind_param("ssssssssssi",$restaurant_name,$address,$image,$contact_no_1,$contact_no_2,$owner_name,$date,$time,$userid,$password,$edit_id);
			
			if($stmt->execute())
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		
		function add_new_hotel($restaurant_name,$address,$image,$contact_no_1,$contact_no_2,$owner_name,$userid,$password)
		{
			$date	=	date("Y-m-d");
			$time	=	date("H:i:s");
			
			$stmt	=	$this->con->prepare("INSERT INTO `restaurant`(`restaurant_name`, `address`, `image`, `contact_no_1`, `contact_no_2`, `owner_name`, `username`, `password`, `date`, `time`) VALUES (?,?,?,?,?,?,?,?,?,?)");
			
			$stmt->bind_param("ssssssssss",$restaurant_name,$address,$image,$contact_no_1,$contact_no_2,$owner_name,$userid,$password,$date,$time);
			
			if($stmt->execute())
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		
			function get_details_by_id($edit_id)
			{
				if($stmt	=	$this->con->prepare("SELECT `id`, `restaurant_name`, `address`, `image`, `contact_no_1`, `contact_no_2`, `owner_name`, `date`, `time`,`username`,`password` FROM `restaurant` WHERE `id`=?"))
				{
					$stmt->bind_param("i",$edit_id);
					$stmt->bind_result($id,$restaurant_name,$address,$image,$contact_no_1,$contact_no_2,$owner_name,$date,$time,$userid,$password);
					if($stmt->execute())
					{
						$data	=	array();
						if($stmt->fetch())
						{
							$data[0]	=	$id;
							$data[1]	=	$restaurant_name;
							$data[2]	=	$address;
							$data[3]	=	$image;
							$data[4]	=	$contact_no_1;
							$data[5]	=	$contact_no_2;
							$data[6]	=	$owner_name;
							$data[7]	=	$date;
							$data[8]	=	$time;
							$data[9]	=	$userid;
							$data[10]	=	$password;
							
							return $data;
						}
					}
					else
					{
						return false;
					}
				}
			}
		function dele_detail($dele_id)
		{
			if($stmt=$this->con->prepare("DELETE FROM `restaurant` WHERE `id`=?"))
			$stmt->bind_param("i",$dele_id);
			if($stmt->execute())
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		
		/***************************************************/
		
		function  save_application($restaurant_id,$menu_item_name,$item_description,$price,$discount,$thumbnail_item_image)
		{
			
			$date = date("Y-m-d");
			$time = date("H:i:s t");
			
			if($stmt = $this->con->prepare("INSERT INTO `menu_items`( `restaurant_id`, `menu_item_name`, `item_description`, 
			                              `price`, `discount`, `thumbnail_item_image`, `date`, `time`)  VALUES (?,?,?,?,?,?,?,?)"))
			{
				
				$stmt->bind_param("ssssssss", $restaurant_id,$menu_item_name,$item_description,$price,
				                              $discount,$thumbnail_item_image,$date,$time);
				 
				if($stmt->execute())
				{
					return true;
				}
				else
				{
					echo $stmt->error;
				}
			}
		}
		
		function get_id_from_menu_item_name($restaurant_id,$menu_item_name)

		{
			//echo $stmt->error;
			if($stmt = $this->con->prepare("SELECT `id` FROM `menu_items` WHERE `menu_item_name`=? AND `restaurant_id`=?"))
			{
				
				$stmt->bind_param("ss",$menu_item_name,$restaurant_id);
				
				
				$stmt->bind_result($output_id);
				
				
				if($stmt->execute())
				{
					
					if($stmt->fetch())
					{
						
						return $output_id;
					}
				}
				return false;
			}
		}
   
       function get_multiple_rows_of_enquiries($restaurant_user_id)
		{
			if($stmt = $this->con->prepare("SELECT  `id`,`menu_item_name`, `item_description`, `price`, 
                             `discount`, `thumbnail_item_image`, `date`, `time` FROM `menu_items` where `restaurant_id`=?"))
			{
				
				$stmt->bind_param("s",$restaurant_user_id);
				
                $stmt->bind_result($id,$menu_item_name,$item_description, $price,
                                             $discount,$thumbnail_item_image,$date,$time);
				
				if($stmt->execute())
				{
					$data	=	array();
					$row	=	0;
					//while loop for fetching multiple records
					while($stmt->fetch())
					{
                        $data[$row][0]	=	$id;
						$data[$row][1]	=	$menu_item_name;
						$data[$row][2]	=	$item_description;
						$data[$row][3]	=	$price;
						$data[$row][4]	=	$discount;
						$data[$row][5]	=	$thumbnail_item_image;
						$data[$row][6]	=	$date;
						$data[$row][7]	=	$time;
						
						$row++;
					}
					return $data;
				}
				return false;
			}
		}
		function delete_menu_record($delete_id)
			{
				if($stmt= $this->con->prepare("DELETE FROM `menu_items` WHERE `id`=?"))
				 {
					$stmt->bind_param("i",$delete_id);
					if($stmt->execute())
					{
						return true;
					}
				}
				else
				{
				return false;
				}
			}
			
			function get_enquiry_record_from_id($var_edit_id)
		{
			if($stmt = $this->con->prepare("SELECT  `restaurant_id`, `menu_item_name`, `item_description`,
			                                `price`, `discount`, `thumbnail_item_image`, `date`, `time` FROM `menu_items` WHERE  `id`=? "))
			{
				$stmt->bind_param("i",$var_edit_id);
				
				$stmt->bind_result($id,$menu_item_name,$item_description, $price,
                                   $discount,$thumbnail_item_image,$date,$time);
				
				
				if($stmt->execute())
				{
					if($stmt->fetch())
					{
						$data = array();
						
						$data[0]	=	$id;
						$data[1]	=	$menu_item_name;
						$data[2]	=	$item_description;
						$data[3]	=	$price;
						$data[4]	=	$discount;
						$data[5]	=	$thumbnail_item_image;
						$data[6]	=	$date;
						$data[7]	=	$time;
						
						return $data;
					}
				}
				return false;
			}
		}
		
			
		function  update_enquiry_record($txt_id,$menu_item_name,$item_description, $price,
                                   $discount)
		{
			$date = date("Y-m-d");
			$time = date("H:i:s t");
			echo $txt_id;
			if($stmt = $this->con->prepare("UPDATE `menu_items` SET `menu_item_name`=?,
			                               `item_description`=?,`price`=?,`discount`=?,`date`=?,`time`=? WHERE `id`=?"))
			{
				
				$stmt->bind_param("ssssssi",$menu_item_name,$item_description, $price,
                                   $discount,$date,$time,$txt_id);
				
				if($stmt->execute())
				{
					
					return true;
				}
				return false;
			}
		}
		/*********************************************************api*********************************************************************************************/
		
		function get_id_from_user_name($mobile_number)
		{ 
			if($stmt= $this->con->prepare("SELECT `id` FROM `user` WHERE `mobile_number`=?" ))
			{ 
				$stmt->bind_param("s",$mobile_number);
				
				$stmt->bind_result($output_id);
				
				if($stmt->execute())
				{  
					if($stmt->fetch())
					{
						return $output_id;
					}
				}
				return false;
			}
		}
		function  save_user_data($full_name,$mobile_number,$password)
		{ 
			$date 			= date("Y-m-d");
			$time		    = date("H:i:s t");
			
			if($stmt = $this->con->prepare("INSERT INTO `user`(`full_name`, `mobile_number`, `password`, `date`, `time`)  VALUES (?,?,?,?,?)"))
			{
				$stmt->bind_param("sssss", $full_name,$mobile_number,$password,$date,$time);
			 if($stmt->execute())
				{ 
					return true;
				}
			else
				{
					echo $stmt->error;
				}
			}
		}
		
		function get_password_from_user($mobile_number)
		{
			if($stmt_select = $this->con->prepare("Select `password` from `user` where `mobile_number` = ? "))
			{	
				$stmt_select->bind_param("s",$mobile_number);
				
				$stmt_select->bind_result($result_password);
				
				if($stmt_select->execute())
				{
					if($stmt_select->fetch())
					{
							return $result_password;
					}
				}
					return false;
			}
		}
		function get_user_profile($mobile_number)
		{
			if($stmt = $this->con->prepare("SELECT `id`, `full_name`, `mobile_number`, `password`, `date`, `time`,`account_status` FROM `user` WHERE `mobile_number` = ?"))
			{ 
					$stmt->bind_param("s",$mobile_number);
                    $stmt->bind_result($id, $full_name ,$mobile_number , $password ,$date,$time,$account_status);
				
				if($stmt->execute())
				{
					$data	=	array();
					//while loop for fetching multiple records
					if($stmt->fetch())
					{
                        $data[0]	=	$id;
						$data[1]	=	$full_name;
						$data[2]	=	$mobile_number;
						$data[3]	=	$password;
						$data[4]	=	$date;
						$data[5]	=	$time;
						$data[6]	=	$account_status;
						return $data;
					}
					
				}
				return false;
			}
		}
		function get_password_from_user_mobile_number($mobile_number)
			{
				if($stmt = $this->con->prepare("Select `password` from `user` where `mobile_number` = ? "))
				{	
					$stmt->bind_param("s",$mobile_number);
				
					$stmt->bind_result($result_password);
				
					if($stmt->execute())
					{
						if($stmt->fetch())
						{
							return $result_password;
						}
					}
							return false;
				}
			}
			function change_password($mobile_number,$new_password)
			{ 
				$date = date("Y-m-d");
				$time = date("H:i:s A");
			
				if($stmt_select = $this->con->prepare("update `user` set `password`='".$new_password."' where `mobile_number` = ?"))
				{
					$stmt_select->bind_param("s",$mobile_number);				
				
					if($stmt_select->execute())
					{					
						return true;
					}
						return false;
				}
			}
		/******************************************************RESTAURANT API****************************************************************************/
		function get_restaurant_list($restaurant_name)
		{
			if($stmt = $this->con->prepare("SELECT `id`, `restaurant_name`, `address`, `image`, `contact_no_1`, `contact_no_2`, `owner_name`, `username`, `password`, `date`, `time` FROM `restaurant` where `restaurant_name` LIKE '%".$restaurant_name."%'"))
			{ 
                    $stmt->bind_result($id, $restaurant_name ,$address , $image ,$contact_no_1 ,$contact_no_2 ,$owner_name ,$username ,$password ,$date,$time);
				
				if($stmt->execute())
				{
					$data	=	array();
					$row	=	0;
					//while loop for fetching multiple records
					while($stmt->fetch())
					{
                        $data[$row]['id']				=	$id;
						$data[$row]['restaurant name']	=	$restaurant_name;
						$data[$row]['address']			=	$address;
						$data[$row]['image']			=	$image;
						$data[$row]['contact no1']		=	$contact_no_1;
						$data[$row]['contact no2']		=	$contact_no_2;
						$data[$row]['owner name']		=	$owner_name;
						$data[$row]['user name']		=	$username;
						$data[$row]['password']			=	$password;
						$data[$row]['date']				=	$date;
						$data[$row]['time']				=	$time;
						$row++;
					}
					return $data;
					
				}
				return false;
			}
		}
		
			function get_restaurant_menu_item($restaurant_id)
		{
			if($stmt = $this->con->prepare("SELECT `id`, `restaurant_id`, `menu_item_name`, `item_description`, `price`, `discount`, `thumbnail_item_image`, `date`, `time` FROM `menu_items` WHERE `restaurant_id`=?"))
			{ 
				$stmt->bind_param("s",$restaurant_id);	
                $stmt->bind_result($id, $restaurant_id ,$menu_item_name , $item_description ,$price ,$discount ,$thumbnail_item_image ,$date,$time);
				
				if($stmt->execute())
				{
					$data	=	array();
					$row=0;
					//while loop for fetching multiple records
					while($stmt->fetch())
					{
                        $data[$row]['id']					=	$id;
						$data[$row]['restaurant_id']		=	$restaurant_id;
						$data[$row]['menu_item_name']		=	$menu_item_name;
						$data[$row]['item_description']		=	$item_description;
						$data[$row]['price']				=	$price;
						$data[$row]['discount']				=	$discount;
						$data[$row]['image']				=	$thumbnail_item_image;
						$data[$row]['date']					=	$date;
						$data[$row]['time']					=	$time;
						$row++;
					}
					return $data;
				}
				return false;
			}
		}
		function get_menu_item_details($menu_item_id)
		{
			if($stmt = $this->con->prepare("SELECT `price`,`discount`,`menu_item_name` FROM `menu_items` WHERE `id`=?" ))
			{ 
				$stmt->bind_param("i",$menu_item_id);
				
				$stmt->bind_result($price,$discount,$menu_item_name);
				
				if($stmt->execute())
				{  
					$data	=	array();
					if($stmt->fetch())
					{
						$data[0]				=	$price;
						$data[1]				=	$discount;
						$data[2]				=	$menu_item_name;
						
						return $data;
					}
				}
				return false;
			}
		}
		function  save_cart_items($user_mobile_number,$restaurant_id,$menu_item_id,$quantity,$total_amount,$total_discount,$final_amount)
		{
			$date 			= date("Y-m-d");
			$time		    = date("H:i:s t");
		if($stmt = $this->con->prepare("INSERT INTO `cart_items`( `user_mobile_number`, `restaurant_id`, `menu_item_id`, `quantity`,`total_amount`, `total_discount`, `final_amount`,`date`, `time`) VALUES (?,?,?,?,?,?,?,?,?)"))
			{
				$stmt->bind_param("sssssssss", $user_mobile_number,$restaurant_id,$menu_item_id,$quantity,$total_amount,$total_discount,$final_amount,$date,$time);
				if($stmt->execute())
					{ 
						return true;
					}
				else
					{
						return false;
					}
			}
		}
		function get_cart_items_added_by_user($user_mobile_number)
		{
			if($stmt = $this->con->prepare("SELECT `id`, `user_mobile_number`, `restaurant_id`, `menu_item_id`, `quantity`, `total_amount`, `total_discount`, `final_amount`, `date`, `time` FROM `cart_items` where `user_mobile_number`=?"))
			{ 
				$stmt->bind_param("s",$user_mobile_number);
				
                $stmt->bind_result($id, $user_mobile_number ,$restaurant_id , $menu_item_id ,$quantity ,$total_amount ,$total_discount ,$final_amount ,$date,$time);
				
				if($stmt->execute())
				{
					$data	=	array();
					$row	=	0;
					//while loop for fetching multiple records
					//its bad programming... u not follows to rules
					
					while($stmt->fetch())
					{
                        $data[$row]['id']						=	$id;
						$data[$row]['mobile_number']			=	$user_mobile_number;
						$data[$row]['restaurant_id']			=	$restaurant_id;
						$data[$row]['menu_item_id']				=	$menu_item_id;
						$data[$row]['quantity']					=	$quantity;
						$data[$row]['total_amount']				=	$total_amount;
						$data[$row]['total_discount']			=	$total_discount;
						$data[$row]['final_amount']				=	$final_amount;
						$data[$row]['date']						=	$date;
						$data[$row]['time']						=	$time;
						$row++;
					}
					return $data;
					
				}
				return false;
			}
		}
		
		
		function get_user_cart_exist_menu_id($menu_item_id,$user_mobile_number)
		{
			if($stmt = $this->con->prepare("SELECT `id` FROM `cart_items` WHERE `menu_item_id`=? AND `user_mobile_number`=?"))
			{ 
				$stmt->bind_param("ss",$menu_item_id,$user_mobile_number);
				
				$stmt->bind_result($res_id);
				
				if($stmt->execute())
				{  
					
					if($stmt->fetch())
					{
						return $res_id;
					}
				}
				return false;
			}
		}
		
		function update_cart_menu_item_details($user_mobile_number,$restaurant_id,$menu_item_id,$quantity,$total_amount,$total_discount,$final_amount,$exist_menu_id)
		{
			$date	=	date("Y-m-d");
			$time	=	date("H:i:s");
			if($stmt	=	$this->con->prepare("UPDATE `cart_items` SET `quantity`=`quantity`+?,`total_amount`=`total_amount`+?,`total_discount`=`total_discount`+?,`final_amount`=`final_amount`+?,`date`=?,`time`=? WHERE `id`=?"))
			{
				$stmt->bind_param("ssssssi",$quantity,$total_amount,$total_discount,$final_amount,$date,$time,$exist_menu_id);
				
				if($stmt->execute())
				{
					return true;
				}
				else
				{
					return false;
				}
			}
		}
		
		function check_another_restaurant_cart_exist_for_same_user($restaurant_id,$user_mobile_number)
		{
			if($stmt = $this->con->prepare("SELECT `id` FROM `cart_items` WHERE `restaurant_id`!=? AND `user_mobile_number`=?"))
			{ 
				$stmt->bind_param("ss",$restaurant_id,$user_mobile_number);
				
				$stmt->bind_result($res_id);
				
				if($stmt->execute())
				{  
					
					if($stmt->fetch())
					{
						return $res_id;
					}
				}
				return false;
			}
		}
		
		function delete_all_carts_items($user_mobile_number)
		{
			if($stmt=$this->con->prepare("DELETE FROM `cart_items` WHERE `user_mobile_number`= ?"))
			{
				$stmt->bind_param("s",$user_mobile_number);
				
				if($stmt->execute())
				{
					return true;
				}
				else
				{
					return false;
				}
			}
		}
		
		function delete_menu_item($menu_item_id)
		{
			if($stmt=$this->con->prepare("DELETE FROM `menu_items` WHERE `id`=?"))
			{ 
				$stmt->bind_param("i",$menu_item_id);
				
				if($stmt->execute())
				{ 
		
					return true;
				}
				else
				{
					return false;
				}
			}
		}
		
		/****************** MY HOTEL API [7-6-21]******************************************************************/
		
		function get_id_from_user_order($mobile_number)
		{ 
			if($stmt= $this->con->prepare("SELECT `id` FROM `user_orders` WHERE `mobile_number`=?" ))
			{ 
				$stmt->bind_param("s",$mobile_number);
				
				$stmt->bind_result($output_id);
				
				if($stmt->execute())
				{  
					if($stmt->fetch())
					{
						return $output_id;
					}
				}
				return false;
			}
		}
		
		function  save_user_order_data($mobile_number,$order_id,$restaurant_id)
		{ 
			$date 			= date("Y-m-d");
			$time		    = date("H:i:s t");
			$order_status	=	"pending";
			if($stmt = $this->con->prepare("INSERT INTO `user_orders`(`user_contact_no`, `order_id`, `date`, `time`, `order_status`, `restaurant_id`) VALUES(?,?,?,?,?,?)"))
			{
				$stmt->bind_param("ssssss",$mobile_number,$order_id,$date,$time,$order_status,$restaurant_id);
			 if($stmt->execute())
				{ 
					return $stmt->insert_id;
				}
			else
				{
					echo $stmt->error;
				}
			}
		}
		
		function get_id_from_order_item($inserted_id)
		{ 
			if($stmt= $this->con->prepare("SELECT `id` FROM `order_items` WHERE `order_id`=?" ))
			{ 
				$stmt->bind_param("s",$inserted_id	);
				
				$stmt->bind_result($output_id);
				
				if($stmt->execute())
				{  
					if($stmt->fetch())
					{
						return true;
					}
				}
				return false;
			}
		}
		
		function  save_user_order_item($order_id,$item_id,$item_name,$item_price,$item_max_price,$item_discount,$item_quantity,$final_bill_amount)
		{ 
			$date 			= date("Y-m-d");
			$time		    = date("H:i:s t");
			$account_status	=	"active";
			if($stmt = $this->con->prepare("INSERT INTO `order_items`(`order_id`, `item_id`, `item_name`, `item_price`, `item_max_price`, `item_discount`, `item_quantity`, `now_final_bill_amount`, `date`, `time`) VALUES(?,?,?,?,?,?,?,?,?,?)"))
			{ 
				$stmt->bind_param("ssssssssss",$order_id,$item_id,$item_name,$item_price,$item_max_price,$item_discount,$item_quantity,$final_bill_amount,$date,$time);
			 if($stmt->execute())
				{ 
					return true;
				}
			else
				{
					echo $stmt->error;
				}
			}
		}
		
		function get_user_data_history($mobile_number)
		{
			if($stmt = $this->con->prepare("SELECT `id`, `user_contact_no`, `order_id`, `date`, `time`, `order_status`, `restaurant_id` FROM `user_orders` WHERE `user_contact_no` = ?"))
			{
					$stmt->bind_param("s",$mobile_number);
                    $stmt->bind_result($id, $mobile_number ,$order_id,$date,$time,$order_status,$restaurant_id);
				
				if($stmt->execute())
				{
					$data	=	array();
					$row	=	0;
					//while loop for fetching multiple records
					while($stmt->fetch())
					{
                        $data[$row]['id']				=	$id;
						$data[$row]['mobile_number']	=	$mobile_number;
						$data[$row]['order_id']			=	$order_id;
						$data[$row]['date']				=	$date;
						$data[$row]['time']				=	$time;
						$data[$row]['order_status']		=	$order_status;
						$data[$row]['restaurant_id']	=	$restaurant_id;
						$row++;
					}
					return $data;
					return $order_id;
				}
				return false;
			}
		}
		
		function get_user_order_history($order_id)
		{
			if($stmt = $this->con->prepare("SELECT `id`, `order_id`, `item_id`, `item_name`, `item_price`, `item_max_price`, `item_discount`, `item_quantity`, `now_final_bill_amount`, `date`, `time` FROM `order_items` WHERE `order_id` = ?"))
			{ 
				$stmt->bind_param("s",$order_id);
				
				$stmt->bind_result($id, $res_order_id ,$item_id,$item_name,$item_price,$item_max_price,$item_discount,$item_quantity,$now_final_bill_amount,$date,$time);
				
				if($stmt->execute())
				{ 
					$data	=	array();
					$row	=	0;
					//while loop for fetching multiple records
					while($stmt->fetch())
					{ 
                        $data[$row]['id']						=	$id;
						$data[$row]['order_id']					=	$res_order_id;
						$data[$row]['item_id']					=	$item_id;
						$data[$row]['item_name']				=	$item_name;
						$data[$row]['item_price']				=	$item_price;
						$data[$row]['item_max_price']			=	$item_max_price;
						$data[$row]['item_discount']			=	$item_discount;
						$data[$row]['item_quantity']			=	$item_quantity;
						$data[$row]['now_final_bill_amount']	=	$now_final_bill_amount;
						$data[$row]['date']						=	$date;
						$data[$row]['time']						=	$time;
						$row++;
					}
					return $data;
					
				}
				return false;
			}
		}
	}//END
?>