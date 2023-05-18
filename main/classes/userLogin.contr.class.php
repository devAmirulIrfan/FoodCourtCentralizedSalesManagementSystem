<?php
class OPERATOR_CONTR extends OPERATOR_MODEL{

    private $username;
    private $password;

    // ACCESSING THE CONSTRUCTOR
    public function __construct($username,$password){
        $this->username = $username;
        $this->password = $password;     
    }

    // POINT TO OPERATOR LOGIN
    public function c_operator_acc(){
       $this->m_operator_acc($this->username,$this->password);
    }
}
class VENDOR_CONTR extends VENDOR_MODEL{

    private $username;
    private $password;

     // ACCESSING THE CONSTRUCTOR
    public function __construct($username,$password){
        $this->username = $username;
        $this->password = $password;     
    }
    
    // POINT TO FOOD COURT VENDOR LOGIN
    public function c_vendor_acc(){
       $this->m_vendor_acc($this->username,$this->password);
    }
}
?>