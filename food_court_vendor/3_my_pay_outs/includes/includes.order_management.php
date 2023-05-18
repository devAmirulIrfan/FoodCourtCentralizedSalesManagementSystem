<?php 

require '../../../dbh.class.php';
require '../classes/order_management.model.class.php';
require "../classes/order_management.contr.class.php";
require "../classes/order_management.view.class.php";
$action = $_POST["action"]; 

// DISPLAY 
if($action =="display_my_pay_outs"){
    $display_my_pay_outs_func = new MY_PAY_OUTS_VIEW();
    $display_my_pay_outs_func -> v_display_my_pay_outs();
}
if($action =="fetch_get_pay_out"){
   $fetch_get_pay_out_data = $_POST["fetch_get_pay_out_data"];
   $fetch_get_pay_out_func = new MY_PAY_OUTS_CONTR();
   $fetch_get_pay_out_func -> c_fetch_get_pay_out($fetch_get_pay_out_data);
}


?>