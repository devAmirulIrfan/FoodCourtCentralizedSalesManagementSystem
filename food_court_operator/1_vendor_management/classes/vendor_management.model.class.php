<?php
class VENDOR_MANAGEMENT_MODEL extends Dbh{

    //CLASS (VENDOR_MANAGEMENT_MODEL) FUNC DISPLAY (VENDOR)
    public function m_display_vendor(){
        $sql = "SELECT * FROM fc_vendor_1_acc";
        $stmt = $this->connect()->query($sql);
        while($row = $stmt->fetch()){
            $json_array[] = $row;
        }
        echo json_encode($json_array); 
    }

    //CLASS (VENDOR_MANAGEMENT_MODEL) FUNC SEARCH (VENDOR)
    public function m_search_vendor($search){
        $search = "%$search%";
        $sql = "SELECT * FROM fc_vendor_1_acc WHERE vendor_username LIKE ? " ;
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$search]);
        while($row = $stmt->fetch()){
           $json_array[] = $row;
        }
        echo json_encode($json_array);
    }

    //CLASS (VENDOR_MANAGEMENT_MODEL) FUNC INSERT (VENDOR)
    public function m_insert_vendor($vendor_username,$vendor_password,$vendor_name,$vendor_desc){
        // echo($username.$password.$vendor_name.$vendor_desc);
        $sql = "INSERT INTO fc_vendor_1_acc(vendor_username,vendor_password,vendor_name , vendor_description) VALUES(?,?,?,?)" ;
        $stmt = $this->connect()->prepare($sql);
        if($stmt->execute([$vendor_username,$vendor_password,$vendor_name,$vendor_desc])){
            echo("ok");
        }  
    }

    //CLASS (VENDOR_MANAGEMENT_MODEL) FUNC FETCH EDIT (VENDOR)
    public function m_fetch_edit_vendor($fetch_edit_data){
        $sql = "SELECT * FROM fc_vendor_1_acc WHERE vendor_id = ? " ;
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$fetch_edit_data]);
        while($row = $stmt->fetch()){
           $json_array[] = $row;
        }
        echo json_encode($json_array);
    }

     //CLASS (VENDOR_MANAGEMENT_MODEL) FUNC EDIT (VENDOR)
    public function m_edit_vendor($vendor_id,$vendor_username,$vendor_password,$vendor_name,$vendor_desc){
        $sql = "UPDATE fc_vendor_1_acc SET vendor_username = ? , vendor_password = ? , vendor_name = ? , vendor_description = ? WHERE vendor_id = ? ";
        $stmt = $this->connect()->prepare($sql);
        if($stmt->execute([$vendor_username,$vendor_password,$vendor_name,$vendor_desc,$vendor_id])){
            echo("ok");
        }  
    }

}

?>