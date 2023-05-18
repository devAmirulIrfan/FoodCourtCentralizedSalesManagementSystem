<?php 

require '../../../dbh.class.php';
require '../classes/payment_management.model.class.php';
require "../classes/payment_management.contr.class.php";
require "../classes/payment_management.view.class.php";
$action = $_POST["action"];


// DISPLAY 
if($action =="display_invoice"){
    $display_payment_func = new PAYMENT_MANAGEMENT_VIEW();
    $display_payment_func->v_display_invoice();
}
?>