<?php 

require '../../../dbh.class.php';
require '../classes/food_menu_management.model.class.php';
require "../classes/food_menu_management.contr.class.php";
require "../classes/food_menu_management.view.class.php";
$action = $_POST["action"];


// DISPLAY 
if($action =="display"){
    $display_food_menu_func = new FOOD_MENU_MANAGEMENT_VIEW();
    $display_food_menu_func->v_display_food_menu();
}

// SEARCH
if($action =="search"){
    $search = $_POST["search_data"];
    $search_food_menu = new FOOD_MENU_MANAGEMENT_VIEW();
    $search_food_menu->v_search_food_menu($search);
}

// INSERT
if($action =="insert"){
    $food_menu_name = $_POST["food_menu_name"];
    $food_menu_image_name = $_POST["food_menu_image_name"];
    $food_menu_image = $_POST["food_menu_image"];
    $food_menu_price = $_POST["food_menu_price"];
    $select_food_menu_status = $_POST["select_food_menu_status"];
    $insert_vendor_func = new FOOD_MENU_MANAGEMENT_CONTR();
    $insert_vendor_func->c_insert_food_menu($food_menu_name,$food_menu_image_name,$food_menu_image,$food_menu_price,$select_food_menu_status);
}

// FETCH_EDIT
if($action =="fetch_edit"){
    $fetch_edit_data = $_POST["fetch_edit_data"];
    $fetch_edit_vendor_func = new FOOD_MENU_MANAGEMENT_CONTR();
    $fetch_edit_vendor_func->c_fetch_edit_food_menu($fetch_edit_data);
}


// EDIT
if($action =="edit"){
    $food_menu_id = $_POST["food_menu_id"];
    $food_menu_name = $_POST["food_menu_name"];
    $food_menu_image_name = $_POST["food_menu_image_name"];
    $food_menu_image = $_POST["food_menu_image"];
    $food_menu_price = $_POST["food_menu_price"];
    $select_food_menu_status = $_POST["select_food_menu_status"];
    $edit_vendor_func = new FOOD_MENU_MANAGEMENT_CONTR();
    $edit_vendor_func->c_edit_food_menu($food_menu_name,$food_menu_image_name,$food_menu_image,$food_menu_price,$select_food_menu_status,$food_menu_id);
}
?>