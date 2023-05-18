<?php
class ORDER_MANAGEMENT_VIEW extends ORDER_MANAGEMENT_MODEL{

    //CLASS (ORDER_MANAGEMENT_MODEL)-->(ORDER_MANAGEMENT_VIEW) FUNC DISPLAY (FOOD MENU)
   public function v_display_customer_food_menu(){
       $this->m_display_customer_food_menu();
   }

    //CLASS (ORDER_MANAGEMENT_MODEL)-->(ORDER_MANAGEMENT_VIEW) FUNC DISPLAY (FOOD MENU)
   public function v_search_customer_food_menu($search){
       $this->m_search_customer_food_menu($search);
   }

   
    //CLASS (ORDER_MANAGEMENT_MODEL)-->(ORDER_MANAGEMENT_VIEW) FUNC BUTTON DISPLAY (BUTTON FOOD VENDOR)
    public function v_display_customer_food_menu_vendor(){
        $this->m_display_customer_food_menu_vendor();
    }

    //CLASS (ORDER_MANAGEMENT_MODEL)-->(ORDER_MANAGEMENT_VIEW) FUNC BUTTON SEARCH (FOOD MENU)
   public function v_fetch_btn_search_customer_food_menu($search){
    $this->m_fetch_btn_search_customer_food_menu($search);
}

 //CLASS (ORDER_MANAGEMENT_MODEL)-->(ORDER_MANAGEMENT_VIEW) FUNC FETCH MODAL (FOOD MENU)
 public function v_fetch_modal_customer_food_menu($fetch_modal_data){
    $this->m_fetch_modal_customer_food_menu($fetch_modal_data);
}

 //CLASS (ORDER_MANAGEMENT_MODEL)-->(ORDER_MANAGEMENT_VIEW) FUNC DISPLAY ORDER (FOOD MENU)
 public function v_display_customer_food_order(){
    $this->m_display_customer_food_order();
}
}
?>