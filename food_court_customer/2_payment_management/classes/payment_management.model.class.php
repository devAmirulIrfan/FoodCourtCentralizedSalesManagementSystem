<?php
session_start();

class PAYMENT_MANAGEMENT_MODEL extends Dbh{

    //CLASS (PAYMENT_MANAGEMENT_MODEL) FUNC DISPLAY (INVOICE)
    public function m_display_invoice(){
        $sql = "SELECT
         fc_customer_2_payment.* ,
         fc_customer_1_food_order_management.*,
         fc_vendor_2_food_menu_management.food_menu_id,
         fc_vendor_2_food_menu_management.food_menu_name,
         fc_vendor_2_food_menu_management.food_menu_price 

         FROM

         fc_customer_2_payment

         JOIN

         fc_customer_1_food_order_management

         ON

         fc_customer_2_payment.payment_customer_id = fc_customer_1_food_order_management.order_cust_id

         JOIN

         fc_vendor_2_food_menu_management

         ON
         fc_customer_1_food_order_management.order_food_id = fc_vendor_2_food_menu_management.food_menu_id

        WHERE 
        
        fc_customer_2_payment.payment_customer_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$_SESSION["customer_id"]]);
        while($row = $stmt->fetch()){
        $json_array[] = $row;
        }
        echo json_encode($json_array);
    }
}
?>