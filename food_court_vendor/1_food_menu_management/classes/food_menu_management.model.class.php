<?php
session_start();
class FOOD_MENU_MANAGEMENT_MODEL extends Dbh{


    //CLASS (FOOD_MENU_MANAGEMENT_MODEL) FUNC DISPLAY (FOOD MENU)
    public function m_display_food_menu(){
        $sql = "SELECT 
        food_menu_id,
        food_menu_vendor_id,
        food_menu_name,
        TRUNCATE(food_menu_price,2) AS food_menu_price,
        food_menu_status
        FROM
        fc_vendor_2_food_menu_management
        WHERE 
        food_menu_vendor_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$_SESSION["vendor_id"]]);
        while($row = $stmt->fetch()){
            $json_array[] = $row;
        }
        echo json_encode($json_array); 
    }

    //CLASS (FOOD_MENU_MANAGEMENT_MODEL) FUNC SEARCH (FOOD MENU)
    public function m_search_food_menu($search){
        $search = "%$search%";
        $sql = "SELECT
        food_menu_id,
        food_menu_vendor_id,
        food_menu_name,
        TRUNCATE(food_menu_price,2) AS food_menu_price,
        food_menu_status
        FROM 
        fc_vendor_2_food_menu_management 
        WHERE 
        food_menu_vendor_id = ? AND food_menu_name LIKE ? " ;
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$_SESSION["vendor_id"],$search]);
        while($row = $stmt->fetch()){
           $json_array[] = $row;
        }
        echo json_encode($json_array);
    }

    //CLASS (FOOD_MENU_MANAGEMENT_MODEL) FUNC INSERT (FOOD MENU)
    public function m_insert_food_menu($food_menu_name,$food_menu_image_name,$food_menu_image,$food_menu_price,$select_food_menu_status){
        $sql = "INSERT INTO fc_vendor_2_food_menu_management(food_menu_vendor_id,food_menu_name,food_menu_image_name,food_menu_image,food_menu_price,food_menu_status) VALUES(?,?,?,?,?,?)" ;
        $stmt = $this->connect()->prepare($sql);
        if($stmt->execute([$_SESSION["vendor_id"],$food_menu_name,$food_menu_image_name,$food_menu_image,$food_menu_price,$select_food_menu_status])){
            echo("ok");
        }  
    }

     //CLASS (FOOD_MENU_MANAGEMENT_MODEL) FETCH EDIT (FOOD MENU)
     public function m_fetch_edit_food_menu($fetch_edit_data){
        $sql = "SELECT 
        food_menu_id ,
        food_menu_image_name ,
        food_menu_image ,
        food_menu_vendor_id ,
        food_menu_name ,
        TRUNCATE(food_menu_price,2) AS food_menu_price ,
        food_menu_status
         FROM fc_vendor_2_food_menu_management WHERE food_menu_id = ? " ;
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$fetch_edit_data]);
        while($row = $stmt->fetch()){
           $json_array[] = $row;
        }
        echo json_encode($json_array);
    }

   //CLASS (FOOD_MENU_MANAGEMENT_MODEL) FUNC EDIT (FOOD MENU)
    public function m_edit_food_menu($food_menu_name,$food_menu_image_name,$food_menu_image,$food_menu_price,$select_food_menu_status,$food_menu_id){
        $sql = "UPDATE fc_vendor_2_food_menu_management SET food_menu_name = ?,food_menu_image_name = ? ,food_menu_image = ? ,food_menu_price = ? ,food_menu_status = ? WHERE food_menu_id = ? ";
        $stmt = $this->connect()->prepare($sql);
        if($stmt->execute([$food_menu_name,$food_menu_image_name,$food_menu_image,$food_menu_price,$select_food_menu_status,$food_menu_id])){
            echo("ok");
        }  
    }
}  

     
?>