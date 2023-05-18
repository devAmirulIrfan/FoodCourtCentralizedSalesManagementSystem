<?php
session_start();
class ORDER_MANAGEMENT_MODEL extends Dbh{

    //CLASS (ORDER_MANAGEMENT_MODEL) FUNC DISPLAY (COMPLETED ORDER)
    public function m_display_orders(){
        $sql = "SELECT
         fc_customer_1_food_order_management.* ,
         fc_vendor_2_food_menu_management.food_menu_id,
         fc_vendor_2_food_menu_management.food_menu_name
          FROM 
          fc_customer_1_food_order_management
          JOIN
          fc_vendor_2_food_menu_management
          ON
          fc_customer_1_food_order_management.order_food_id = fc_vendor_2_food_menu_management.food_menu_id
           WHERE fc_customer_1_food_order_management.order_food_vendor_id = ? AND order_status = ? 
           ORDER BY order_id";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$_SESSION["vendor_id"],"confirmed"]);
        while($row = $stmt->fetch()){
            $json_array[] = $row;
        }
        echo json_encode($json_array); 
    }

    public function m_complete_order($data){
        $sql = "UPDATE fc_customer_1_food_order_management SET order_status = ? WHERE order_id = ? ";
        $stmt = $this->connect()->prepare($sql);
       if($stmt->execute(["completed",$data])){
        echo "ok";
       }


    }

}




?>