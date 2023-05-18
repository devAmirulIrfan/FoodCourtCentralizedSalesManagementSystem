<?php 

require '../../../dbh.class.php';
require '../classes/payment_validation.model.class.php';
require "../classes/payment_validation.contr.class.php";
require "../classes/payment_validation.view.class.php";
$action = $_POST["action"]; 

// DISPLAY 
if($action == "display"){

    $display_fc_customer_invoice = new PAYMENT_VALIDATION_VIEW();
    $display_fc_customer_invoice->v_display_fc_customer_invoice();
    

}
if($action =="search"){
    $search_data = $_POST["search_data"];
    $search_fc_customer_invoice = new PAYMENT_VALIDATION_VIEW();
    $search_fc_customer_invoice->v_search_fc_customer_invoice($search_data);
}
if($action =="search_table"){
    $search_table_data = $_POST["search_table_data"];
    $search_table_fc_customer_invoice = new PAYMENT_VALIDATION_VIEW();
    $search_table_fc_customer_invoice->v_search_table_fc_customer_invoice($search_table_data);
}
// UPDATE 
if($action =="update"){
    $payment_id = $_POST["payment_id"];
    $payment_method = $_POST["payment_method"];
    $payment_time = $_POST["payment_time"];

    $update_fc_customer_payment = new PAYMENT_VALIDATION_CONTR();
    $update_fc_customer_payment->c_update_fc_customer_payment($payment_id,$payment_method,$payment_time);
}
//FUND RELEASE
// if($action == "release_fund"){
//     $fund_release_vendor_id	 = $_POST["fund_release_vendor_id"];
//     $fund_release_vendor_collection	 = $_POST["fund_release_vendor_collection"];
//     $fund_release_vendor_collection_cut  = $_POST["fund_release_vendor_collection_cut"];	
//     $fund_release_operator_comision  = $_POST["fund_release_operator_comision"];
//     $fund_release_method = $_POST["fund_release_method"];
//     $n = 100;
//     $key = bin2hex(random_bytes($n));
//     $fund_release_fc_operator = new FUND_RELEASE_CONTR();
//     $fund_release_fc_operator->c_fund_release_fc_operator($fund_release_vendor_id,$fund_release_vendor_collection,$fund_release_vendor_collection_cut,$fund_release_operator_comision,$key,$fund_release_method);

    
// }


?>