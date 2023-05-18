<?php
class CUSTOMER_MODEL extends Dbh{
    
}
class VENDOR_MODEL extends Dbh{

    // FOOD COURT VENDOR LOGIN
    public function m_vendor_acc($username,$password){
        $sql = "SELECT * FROM fc_vendor_1_acc WHERE vendor_username = ? AND vendor_password = ?" ;
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$username,$password]);
        $user = $stmt->fetchAll();
        if($stmt->rowCount()==1){
            session_start();
            $_SESSION["vendor"] = "vendor";
            $_SESSION["vendor_id"] = $user[0]["vendor_id"];
            $_SESSION["vendor_username"] = $user[0]["vendor_username"];
            echo "1";
        }        
    }
    
}
class OPERATOR_MODEL extends Dbh{

    //FOOD COURT OPERATOR LOGIN 
    public function m_operator_acc($username,$password){
        $sql = "SELECT * FROM fc_operator_1_acc WHERE operator_username = ? AND operator_password = ?" ;
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$username,$password]);
        $user = $stmt->fetchAll();
        if($stmt->rowCount()==1){    
            session_start();
            $_SESSION["admin"] = $user[0]["operator_username"];;
            echo "1";}      
    }
}

?>