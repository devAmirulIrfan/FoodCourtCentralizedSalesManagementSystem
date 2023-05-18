<?php

include '../../dbh.class.php';
include '../classes/userLogin.model.class.php';
include '../classes/userLogin.contr.class.php';

if(isset($_POST["role"])){

    // (FC_CUST/FC_VENDOR/FC_OPERATOR)
    $role = $_POST["role"];
   
    if($role == "operator"){
            
        // (FC_VENDOR/FC_OPERATOR) ONLY
        $username = $_POST["username"];
        $password = $_POST["password"]; 
        $operator = new OPERATOR_CONTR($username,$password);
        $operator->c_operator_acc();
    }
    if($role == "vendor"){
        
        // (FC_VENDOR/FC_OPERATOR) ONLY
        $username = $_POST["username"];
        $password = $_POST["password"]; 
        $vendor = new VENDOR_CONTR($username,$password);
        $vendor->c_vendor_acc();
    }
    else if ($role == "customer"){

        // CUSTOMER ONLY
        $table_number = $_POST["tableNumber"];
        $customer_id= rand(1,999999999);

        session_start();
        $_SESSION["table_number"] = $table_number; 
        $_SESSION["customer_id"] = $customer_id;

        if($_SESSION["table_number"] && $_SESSION["customer_id"]){
        echo "1";
        }
    }


}

    
   

    
    
    

  
  
?>