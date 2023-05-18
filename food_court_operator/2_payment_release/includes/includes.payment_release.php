<?php 

require '../../../dbh.class.php';
require '../classes/payment_release.model.class.php';
require "../classes/payment_release.contr.class.php";
require "../classes/payment_release.view.class.php";
$action = $_POST["action"]; 

// DISPLAY 
if($action =="display"){
    $display_fc_vendor_orders = new FUND_RELEASE_VIEW();
    $display_fc_vendor_orders->v_display_fc_vendor_orders();
}
//GET FUND DATA
if($action == "get_fund_modal"){
    $get_fund_modal_data = $_POST["get_fund_modal_data"];
    $display_fc_vendor_orders_indi_data = new FUND_RELEASE_VIEW();
    $display_fc_vendor_orders_indi_data->v_display_fc_vendor_orders_indi_data($get_fund_modal_data);
}
//FUND RELEASE
if($action == "release_fund"){
    $fund_release_vendor_id	 = $_POST["fund_release_vendor_id"];
    $fund_release_vendor_collection	 = $_POST["fund_release_vendor_collection"];
    $fund_release_vendor_collection_cut  = $_POST["fund_release_vendor_collection_cut"];	
    $fund_release_operator_comision  = $_POST["fund_release_operator_comision"];
    $fund_release_method = $_POST["fund_release_method"];
    $fund_release_notes = $_POST["fund_release_notes"];
    $n = 100;
    $key = bin2hex(random_bytes($n));
    $fund_release_fc_operator = new FUND_RELEASE_CONTR();
    $fund_release_fc_operator->c_fund_release_fc_operator($fund_release_vendor_id,$fund_release_vendor_collection,$fund_release_vendor_collection_cut,$fund_release_operator_comision,$key,$fund_release_method,$fund_release_notes);

    
}



?>