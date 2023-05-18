<?php
session_start();
class ORDER_MANAGEMENT_MODEL extends Dbh{

    //CLASS (ORDER_MANAGEMENT_MODEL) FUNC DISPLAY (PAY OUTS)
    public function m_display_my_pay_outs(){
        $sql = "SELECT fc_operator_2_fund_release.* FROM fc_operator_2_fund_release WHERE fund_release_vendor_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$_SESSION["vendor_id"]]);
        while($row = $stmt->fetch()){
            $json_array[] = $row;
        }
        echo json_encode($json_array); 
    }

     //CLASS (ORDER_MANAGEMENT_MODEL) FUNC DISPLAY (PAY OUTS)
     public function m_fetch_get_pay_out($fetch_get_pay_out_data){

        $sql = "SELECT 
        
        -- THE FUND RELEASE TABLE
        fc_operator_2_fund_release.fund_release_id,

        fc_operator_2_fund_release.fund_release_date,
        
        fc_operator_2_fund_release.fund_release_vendor_id,
        
        fc_operator_2_fund_release.fund_release_vendor_collection,
        
        fc_operator_2_fund_release.fund_release_vendor_collection_cut,
        
        fc_operator_2_fund_release.fund_release_operator_comision,
        
        fc_operator_2_fund_release.fund_release_key,

        fc_operator_2_fund_release.fund_release_notes,
        
        fc_operator_2_fund_release.fund_release_method ,

        -- THE ORDER TABLE

        fc_customer_1_food_order_management.order_id,

        fc_customer_1_food_order_management.order_date,

        fc_customer_1_food_order_management.order_time,

        fc_customer_1_food_order_management.order_cust_id,

        fc_customer_1_food_order_management.order_table_id,

        fc_customer_1_food_order_management.order_food_id,

        fc_customer_1_food_order_management.order_food_vendor_id,

        fc_customer_1_food_order_management.order_food_price,

        fc_customer_1_food_order_management.order_food_qty,

        fc_customer_1_food_order_management.order_total_price,

        fc_customer_1_food_order_management.order_status,

        fc_customer_1_food_order_management.order_fund_release_ref_key,

        -- FOOD MENU TABLE
	
        fc_vendor_2_food_menu_management.food_menu_id,

        fc_vendor_2_food_menu_management.food_menu_name,

        -- FOOD VENDOR TABLE --
        fc_vendor_1_acc.vendor_id,
        fc_vendor_1_acc.vendor_name

        
        FROM 

        fc_customer_1_food_order_management

        JOIN

        fc_operator_2_fund_release

        ON

        fc_customer_1_food_order_management.order_fund_release_ref_key = fc_operator_2_fund_release.fund_release_key

        JOIN

        fc_vendor_2_food_menu_management

        ON

        fc_customer_1_food_order_management.order_food_id = fc_vendor_2_food_menu_management.food_menu_id

        JOIN

        fc_vendor_1_acc

        ON
        
        fc_customer_1_food_order_management.order_food_vendor_id = fc_vendor_1_acc.vendor_id

        WHERE 
        
        fc_operator_2_fund_release.fund_release_id = ?";
        
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$fetch_get_pay_out_data]);
        while($row = $stmt->fetch()){
            $json_array[] = $row;
        }
        echo json_encode($json_array); 
    }

    

}




?>