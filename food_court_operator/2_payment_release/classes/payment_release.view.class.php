<?php
class FUND_RELEASE_VIEW extends FUND_RELEASE_MODEL{

    //CLASS (PAYMENT_RELEASE_VIEW)-->(PAYMENT_RELEASE_MODEL) FUNC DISPLAY (FC VENDOR COLLECTION)
    public function v_display_fc_vendor_orders(){
        $this->m_display_fc_vendor_orders();
    } 

     //CLASS (PAYMENT_RELEASE_VIEW)-->(PAYMENT_RELEASE_MODEL) FUNC DISPLAY INDIV VENDOR (FC VENDOR COLLECTION)
    public function v_display_fc_vendor_orders_indi_data($get_fund_modal_data){
        $this->m_display_fc_vendor_orders_indi_data($get_fund_modal_data);
    }
}
?>