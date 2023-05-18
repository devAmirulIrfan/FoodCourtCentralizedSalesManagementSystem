<?php
class FOOD_MENU_MANAGEMENT_CONTR extends FOOD_MENU_MANAGEMENT_MODEL{

     //CLASS (FOOD_MENU_MANAGEMENT_MODEL)-->(FOOD_MENU_MANAGEMENT_CONTR) FUNC INSERT (FOOD_MENU)
   public function c_insert_food_menu($food_menu_name,$food_menu_image_name,$food_menu_image,$food_menu_price,$select_food_menu_status){
    $this->m_insert_food_menu($food_menu_name,$food_menu_image_name,$food_menu_image,$food_menu_price,$select_food_menu_status);  
   }

    //CLASS (FOOD_MENU_MANAGEMENT_MODEL)-->(FOOD_MENU_MANAGEMENT_CONTR) FUNC FETCH EDIT (FOOD_MENU)
    public function c_fetch_edit_food_menu($fetch_edit_data){
    $this->m_fetch_edit_food_menu($fetch_edit_data);   
    }

    //CLASS (FOOD_MENU_MANAGEMENT_MODEL)-->(FOOD_MENU_MANAGEMENT_CONTR) FUNC EDIT (FOOD_MENU)
    public function c_edit_food_menu($food_menu_name,$food_menu_image_name,$food_menu_image,$food_menu_price,$select_food_menu_status,$food_menu_id){
        $this->m_edit_food_menu($food_menu_name,$food_menu_image_name,$food_menu_image,$food_menu_price,$select_food_menu_status,$food_menu_id);  
    }

}

?>