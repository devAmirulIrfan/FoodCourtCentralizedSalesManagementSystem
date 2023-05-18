<?php
class VENDOR_MANAGEMENT_CONTR extends VENDOR_MANAGEMENT_MODEL{ 

   //CLASS (VENDOR_MANAGEMENT_MODEL)-->(VENDOR_MANAGEMENT_CONTR) FUNC INSERT (VENDOR)
    public function c_insert_vendor($vendor_username,$vendor_password,$vendor_name,$vendor_desc){
        $this->m_insert_vendor($vendor_username,$vendor_password,$vendor_name,$vendor_desc);  
    }

    //CLASS (VENDOR_MANAGEMENT_MODEL)-->(VENDOR_MANAGEMENT_CONTR) FUNC FETCH_EDIT (VENDOR)
    public function c_fetch_edit_vendor($fetch_edit_data){
        $this->m_fetch_edit_vendor($fetch_edit_data);   
    }
    
     //CLASS (VENDOR_MANAGEMENT_MODEL)-->(VENDOR_MANAGEMENT_CONTR) FUNC FETCH_EDIT (VENDOR)
    public function c_edit_vendor($vendor_id,$vendor_username,$vendor_password,$vendor_name,$vendor_desc){
        $this->m_edit_vendor($vendor_id,$vendor_username,$vendor_password,$vendor_name,$vendor_desc);  
    }
}
?>