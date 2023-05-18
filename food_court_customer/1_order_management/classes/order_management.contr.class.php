<?php
class ORDER_MANAGEMENT_CONTR extends ORDER_MANAGEMENT_MODEL{

    //CLASS (ORDER_MANAGEMENT_MODEL)-->(FOOD_ORDER_MANAGEMENT_CONTR) FUNC INSERT (FOOD_MENU)
  public function c_insert_customer_food_order($order_cust_id,$order_table_id,
  $order_food_id,$order_food_vendor_id,$order_food_price,$order_food_qty,$order_total_price){
   $this->m_insert_customer_food_order($order_cust_id,$order_table_id,
   $order_food_id,$order_food_vendor_id,$order_food_price,$order_food_qty,$order_total_price);  
  }

  //CLASS (ORDER_MANAGEMENT_MODEL)-->(FOOD_ORDER_MANAGEMENT_CONTR) FUNC DELETE (FOOD_MENU)
  public function c_delete_customer_food_order($delete_data){
    $this->m_delete_customer_food_order($delete_data);  
  }

  //CLASS (ORDER_MANAGEMENT_MODEL)-->(FOOD_ORDER_MANAGEMENT_CONTR) CONFIRM ORDER (CUSTOMER ORDER)
  public function c_customer_confirm_order_func($order_total_price,$current_time){
    $this->m_customer_confirm_order_func($order_total_price,$current_time);
  }

}


?>