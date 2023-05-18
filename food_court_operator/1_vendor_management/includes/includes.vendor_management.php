<?php 

require '../../../dbh.class.php';
require '../classes/vendor_management.model.class.php';
require "../classes/vendor_management.contr.class.php";
require "../classes/vendor_management.view.class.php";
$action = $_POST["action"]; 

// DISPLAY 
if($action =="display"){
    $display_vendor_func = new VENDOR_MANAGEMENT_VIEW();
    $display_vendor_func->c_display_vendor();
}

// SEARCH
if($action =="search"){
    $search = $_POST["search_data"];
    $search_vendor_func = new VENDOR_MANAGEMENT_VIEW();
    $search_vendor_func->c_search_vendor($search);
}

// INSERT
if($action =="insert"){
    $vendor_username = $_POST["vendor_username"];
    $vendor_password = $_POST["vendor_password"];
    $vendor_name = $_POST["vendor_name"];
    $vendor_desc = $_POST["vendor_desc"];
    $insert_vendor_func = new VENDOR_MANAGEMENT_CONTR();
    $insert_vendor_func->c_insert_vendor($vendor_username,$vendor_password,$vendor_name,$vendor_desc);
    // echo $vendor_username.$vendor_password.$vendor_name.$vendor_desc;
}

// FETCH_EDIT
if($action =="fetch_edit"){
    $fetch_edit_data = $_POST["fetch_edit_data"];
    $fetch_edit_vendor_func = new VENDOR_MANAGEMENT_CONTR();
    $fetch_edit_vendor_func->c_fetch_edit_vendor($fetch_edit_data);

}

// EDIT
if($action =="edit"){
    $vendor_id = $_POST["vendor_id"];
    $vendor_username = $_POST["vendor_username"];
    $vendor_password = $_POST["vendor_password"];
    $vendor_name = $_POST["vendor_name"];
    $vendor_desc = $_POST["vendor_desc"];
    // echo $vendor_id.$vendor_username.$vendor_password.$vendor_name.$vendor_desc;
    $edit_vendor_func = new VENDOR_MANAGEMENT_CONTR();
    $edit_vendor_func->c_edit_vendor($vendor_id,$vendor_username,$vendor_password,$vendor_name,$vendor_desc);
}
?>