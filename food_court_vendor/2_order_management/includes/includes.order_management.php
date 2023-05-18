<?php 

require '../../../dbh.class.php';
require '../classes/order_management.model.class.php';
require "../classes/order_management.contr.class.php";
require "../classes/order_management.view.class.php";
$action = $_POST["action"]; 

// DISPLAY 
if($action =="display_orders"){
    $display_orders_func = new ORDER_MANAGEMENT_VIEW();
    $display_orders_func->v_display_orders();
}
if($action =="complete_order"){
    $data = $_POST["complete_order_data"];
    $complete_order = new ORDER_MANAGEMENT_CONTR();
    $complete_order->c_complete_order($data);
}


?>