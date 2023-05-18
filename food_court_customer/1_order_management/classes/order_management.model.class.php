<?php
session_start();
class ORDER_MANAGEMENT_MODEL extends Dbh{


    //CLASS (ORDER_MANAGEMENT_MODEL) FUNC DISPLAY (FOOD MENU)
    public function m_display_customer_food_menu(){
        $sql = "SELECT fc_vendor_2_food_menu_management.food_menu_id,
        fc_vendor_2_food_menu_management.food_menu_vendor_id,fc_vendor_2_food_menu_management.food_menu_name,TRUNCATE(fc_vendor_2_food_menu_management.food_menu_price , 2) AS food_menu_price, fc_vendor_1_acc.* FROM fc_vendor_2_food_menu_management INNER JOIN fc_vendor_1_acc ON fc_vendor_2_food_menu_management.food_menu_vendor_id = fc_vendor_1_acc.vendor_id WHERE fc_vendor_2_food_menu_management.food_menu_status = ? ";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute(["active"]);
        while($row = $stmt->fetch()){
            $json_array[] = $row;
        }
        echo json_encode($json_array); 
    }

        //CLASS (ORDER_MANAGEMENT_MODEL) FUNC SEARCH (FOOD MENU)
     public function m_search_customer_food_menu($search){
        $search = "%$search%";
        $sql = "SELECT fc_vendor_2_food_menu_management.food_menu_id,
        fc_vendor_2_food_menu_management.food_menu_vendor_id,fc_vendor_2_food_menu_management.food_menu_name,TRUNCATE(fc_vendor_2_food_menu_management.food_menu_price , 2) AS food_menu_price, fc_vendor_1_acc.* FROM fc_vendor_2_food_menu_management INNER JOIN fc_vendor_1_acc ON fc_vendor_2_food_menu_management.food_menu_vendor_id = fc_vendor_1_acc.vendor_id WHERE fc_vendor_2_food_menu_management.food_menu_name LIKE ? AND fc_vendor_2_food_menu_management.food_menu_status = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$search, "active"]);
        while($row = $stmt->fetch()){
           $json_array[] = $row;
        }
        echo json_encode($json_array);
    }

    //CLASS (ORDER_MANAGEMENT_MODEL) FUNC BUTTON DISPLAY (BUTTON FOOD VENDOR)
    public function m_display_customer_food_menu_vendor(){
        $sql = "SELECT * FROM fc_vendor_1_acc";
        $stmt = $this->connect()->query($sql);
        while($row = $stmt->fetch()){
            $json_array[] = $row;
        }
        echo json_encode($json_array); 
    }

    
    //CLASS (ORDER_MANAGEMENT_MODEL) FUNC BTN SEARCH (FOOD MENU)
    public function m_fetch_btn_search_customer_food_menu($search){
        $search = "%$search%";
        $sql = "SELECT  fc_vendor_2_food_menu_management.food_menu_id,
        fc_vendor_2_food_menu_management.food_menu_vendor_id,fc_vendor_2_food_menu_management.food_menu_name,TRUNCATE(fc_vendor_2_food_menu_management.food_menu_price , 2) AS food_menu_price , fc_vendor_1_acc.* FROM fc_vendor_2_food_menu_management INNER JOIN fc_vendor_1_acc ON fc_vendor_2_food_menu_management.food_menu_vendor_id = fc_vendor_1_acc.vendor_id WHERE fc_vendor_2_food_menu_management.food_menu_vendor_id LIKE ? AND fc_vendor_2_food_menu_management.food_menu_status = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$search , "active"]);
        while($row = $stmt->fetch()){
           $json_array[] = $row;
        }
        echo json_encode($json_array);
    }

    
    //CLASS (ORDER_MANAGEMENT_MODEL) FUNC FETCH c (FOOD MENU)
    public function m_fetch_modal_customer_food_menu($fetch_modal_data){
        $sql = "SELECT 
        food_menu_id,
        food_menu_image_name,
        food_menu_image,
        food_menu_vendor_id,
        food_menu_name,
        TRUNCATE(food_menu_price,2) AS food_menu_price,
        food_menu_status
         FROM fc_vendor_2_food_menu_management WHERE food_menu_id = ? ";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$fetch_modal_data]);
        while($row = $stmt->fetch()){
            $json_array[] = $row;
        }
        echo json_encode($json_array); 
    }

   //CLASS (ORDER_MANAGEMENT_MODEL) FUNC INSERT (FOOD MENU)
     public function m_insert_customer_food_order($order_cust_id,$order_table_id,
     $order_food_id,$order_food_vendor_id,$order_food_price,$order_food_qty,$order_total_price){

        $check_validity = "SELECT * FROM fc_customer_1_food_order_management WHERE order_cust_id = ? AND order_food_id = ?" ;
        $stmt = $this->connect()->prepare($check_validity);
        $user = $stmt->fetchAll();
        $stmt->execute([$order_cust_id,$order_food_id]);
        $user = $stmt->fetchAll();
        if(($stmt->rowCount()) == 0){ 
            $sql = "INSERT INTO fc_customer_1_food_order_management(order_cust_id,order_table_id,
            order_food_id,order_food_vendor_id,order_food_price,order_food_qty,order_total_price) VALUES(?,?,?,?,?,?,?)" ;
            $stmt = $this->connect()->prepare($sql);
            if($stmt->execute([$order_cust_id,$order_table_id,
            $order_food_id,$order_food_vendor_id,$order_food_price,$order_food_qty,$order_total_price])){
                echo("ok");
            }   
        }  
    }
    
    //CLASS (ORDER_MANAGEMENT_MODEL) FUNC INSERT ORDER (FOOD MENU)
    public function m_display_customer_food_order(){
        $sql = 
        "SELECT
        fc_customer_1_food_order_management.order_id ,
        fc_customer_1_food_order_management.order_food_id ,
        fc_customer_1_food_order_management.order_cust_id ,
        fc_customer_1_food_order_management.order_food_qty ,
        TRUNCATE(fc_customer_1_food_order_management.order_total_price ,2) AS order_total_price ,
        fc_vendor_2_food_menu_management.food_menu_vendor_id,
        fc_vendor_2_food_menu_management.food_menu_name,
        TRUNCATE(fc_vendor_2_food_menu_management.food_menu_price , 2) AS food_menu_price
         FROM 
         fc_customer_1_food_order_management 
         INNER JOIN 
         fc_vendor_2_food_menu_management 
         ON 
         fc_customer_1_food_order_management.order_food_id = fc_vendor_2_food_menu_management.food_menu_id
         WHERE 
         fc_customer_1_food_order_management.order_cust_id = ?" ;
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$_SESSION["customer_id"]]);
        while($row = $stmt->fetch()){
            $json_array[] = $row;
        }
        echo json_encode($json_array); 
    }

     //CLASS (ORDER_MANAGEMENT_MODEL) FUNC DELETE ORDER (FOOD MENU)
     public function m_delete_customer_food_order($delete_data){
        $sql = "DELETE FROM fc_customer_1_food_order_management WHERE order_id = ?" ;
            $stmt = $this->connect()->prepare($sql);
            if($stmt->execute([$delete_data])){
                echo("ok");
            }    
     }

    //CLASS (ORDER_MANAGEMENT_MODEL) FUNC CONFIRM ORDER (FOOD MENU)
    public function m_customer_confirm_order_func($order_total_price,$current_time){
        $update = "UPDATE fc_customer_1_food_order_management SET order_status = ? , order_time = ? WHERE order_cust_id = ? ";
        $update_stmt = $this->connect()->prepare($update);
        if($update_stmt->execute(["confirmed",$current_time,$_SESSION["customer_id"]])){

            $insert = "INSERT INTO fc_customer_2_payment(payment_customer_id,payment_table_id,payment_amount) VALUES (?,?,?)";
            $insert_stmt = $this->connect()->prepare($insert);
            if($insert_stmt->execute([$_SESSION["customer_id"],$_SESSION["table_number"],$order_total_price])){
                echo "okay";
            }

        }
        
    }


     

}




?>