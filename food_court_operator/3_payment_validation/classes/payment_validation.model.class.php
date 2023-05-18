<?php
class PAYMENT_VALIDATION_MODEL extends Dbh{


      //CLASS (PAYMENT_VALIDATION_MODEL) FUNC DISPLAY (CUSTOMER ONVOICE)
      public function m_display_fc_customer_invoice(){
        $sql = "SELECT * FROM fc_customer_2_payment WHERE payment_status != ? " ;
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute(["PAID"]);
        while($row = $stmt->fetch()){
          $json_array[] = $row;
        }
        echo json_encode($json_array);
    }

      //CLASS (PAYMENT_VALIDATION_MODEL) FUNC DISPLAY (CUSTOMER INVOICE)
      public function m_search_fc_customer_invoice($search_data){
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
        
        fc_customer_2_payment.payment_id = ?
        
        ";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$search_data]);
        while($row = $stmt->fetch()){
        $json_array[] = $row;
        }
        echo json_encode($json_array);
    }

    public function m_update_fc_customer_payment($payment_id,$payment_method,$payment_time){

      $sql = "UPDATE fc_customer_2_payment SET payment_method = ? , payment_status = ? , payment_time = ?  WHERE payment_id= ? ";
      $stmt = $this->connect()->prepare($sql);
        if($stmt->execute([$payment_method,"PAID",$payment_time,$payment_id])){
            echo("ok");
        } 
      
      
    }

    public function m_search_table_fc_customer_invoice($search_table_data){

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
     
     fc_customer_2_payment.payment_table_id = ?
     
     ";
     $stmt = $this->connect()->prepare($sql);
     $stmt->execute([$search_table_data]);
     while($row = $stmt->fetch()){
     $json_array[] = $row;
     }
     echo json_encode($json_array);

      
    }

    
}
?>