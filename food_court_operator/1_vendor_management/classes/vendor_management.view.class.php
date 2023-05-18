<?php
class VENDOR_MANAGEMENT_VIEW extends VENDOR_MANAGEMENT_MODEL{

     //CLASS (VENDOR_MANAGEMENT_MODEL)-->(VENDOR_MANAGEMENT_VIEW) FUNC DISPLAY (VENDOR)
    public function c_display_vendor(){
        $this->m_display_vendor();
    }

    //CLASS (VENDOR_MANAGEMENT_MODEL)-->(VENDOR_MANAGEMENT_VIEW) FUNC SEARCH (VENDOR)
    public function c_search_vendor($search){
        $this->m_search_vendor($search);
    }

}
?>