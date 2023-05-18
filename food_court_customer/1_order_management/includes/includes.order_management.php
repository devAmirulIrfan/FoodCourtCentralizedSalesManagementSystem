<?php 

require '../../../dbh.class.php';
require '../classes/order_management.model.class.php';
require "../classes/order_management.contr.class.php";
require "../classes/order_management.view.class.php";
$action = $_POST["action"]; 

// DISPLAY 
if($action =="display"){
    // echo "hello";
    $display_customer_food_menu_func = new ORDER_MANAGEMENT_VIEW();
    $display_customer_food_menu_func->v_display_customer_food_menu();
}

// SEARCH
if($action =="search"){
    $search = $_POST["search_data"];
    $search_customer_food_menu_func = new ORDER_MANAGEMENT_VIEW();
    $search_customer_food_menu_func->v_search_customer_food_menu($search);
}

// BUTTON DISPLAY 
if($action =="btn_display"){
    $display_customer_food_menu_vendor_func = new ORDER_MANAGEMENT_VIEW();
    $display_customer_food_menu_vendor_func->v_display_customer_food_menu_vendor();
}

// BUTTON SEARCH 
if($action =="btn_search"){
    
    $display_customer_food_menu_vendor_func = new ORDER_MANAGEMENT_VIEW();
    $display_customer_food_menu_vendor_func->v_display_customer_food_menu_vendor();
}


// FETCH_BUTTON_SEARCH
if($action =="fetch_btn_search"){
    $fetch_btn_search_data = $_POST["fetch_btn_search_data"];
    if($fetch_btn_search_data == 0){
      
       $fetch_btn_search_data = "";
    }
    $fetch_btn_search_customer_food_menu = new ORDER_MANAGEMENT_VIEW();
    $fetch_btn_search_customer_food_menu->v_fetch_btn_search_customer_food_menu($fetch_btn_search_data);
}

// FETCH_MODAL
if($action =="fetch_modal"){
    $fetch_modal_data = $_POST["fetch_modal_data"];
    $fetch_modal_customer_food_menu = new ORDER_MANAGEMENT_VIEW();
    $fetch_modal_customer_food_menu->v_fetch_modal_customer_food_menu($fetch_modal_data);
}


// INSERT
if($action =="insert"){
    $order_cust_id = $_POST["order_cust_id"];
    $order_table_id = $_POST["order_table_id"];
    $order_food_id = $_POST["order_food_id"];
    $order_food_vendor_id = $_POST["order_food_vendor_id"];
    $order_food_price = $_POST["order_food_price"];
    $order_food_qty = $_POST["order_food_qty"];
    $order_total_price = $_POST["order_total_price"];

    $insert_customer_food_menu = new ORDER_MANAGEMENT_CONTR();
    $insert_customer_food_menu->c_insert_customer_food_order($order_cust_id,$order_table_id,
    $order_food_id,$order_food_vendor_id,$order_food_price,$order_food_qty,$order_total_price);
}

// DISPLAY ORDER
if($action =="display_order"){
    $display_customer_food_order_func = new ORDER_MANAGEMENT_VIEW();
    $display_customer_food_order_func->v_display_customer_food_order();
}
// DELETE CART
if($action =="delete"){
    $delete_data = $_POST["delete_data"];
    $delete_customer_food_order_func = new ORDER_MANAGEMENT_CONTR();
    $delete_customer_food_order_func->c_delete_customer_food_order($delete_data);
}
//CONFIRM ORDER
if($action == "confirm_order"){
    $order_total_price = $_POST["order_total_price"];
    $current_time = $_POST["current_time"];
    $customer_confirm_order_func = new ORDER_MANAGEMENT_CONTR();
    $customer_confirm_order_func->c_customer_confirm_order_func($order_total_price,$current_time);
}
?>