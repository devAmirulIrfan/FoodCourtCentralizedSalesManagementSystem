<?php
class FOOD_MENU_MANAGEMENT_VIEW extends FOOD_MENU_MANAGEMENT_MODEL{

    //CLASS (FOOD_MENU_MANAGEMENT_MODEL)-->(FOOD_MENU_MANAGEMENT_VIEW) FUNC DISPLAY (FOOD MENU)
   public function v_display_food_menu(){
       $this->m_display_food_menu();
   }

     //CLASS (FOOD_MENU_MANAGEMENT_MODEL)-->(FOOD_MENU_MANAGEMENT_VIEW) FUNC SEARCH (FOOD MENU)
   public function v_search_food_menu($search){
       $this->m_search_food_menu($search);
   }

}
?>