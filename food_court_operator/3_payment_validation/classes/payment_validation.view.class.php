<?php
class PAYMENT_VALIDATION_VIEW extends PAYMENT_VALIDATION_MODEL{

    //CLASS (PAYMENT_VALIDATION_VIEW)-->(PAYMENT_VALIDATION_VIEW) FUNC DISPLAY (FC CUSTOMER INVOICE)

    public function v_display_fc_customer_invoice(){
        $this->m_display_fc_customer_invoice();
    }

    //CLASS (PAYMENT_VALIDATION_VIEW)-->(PAYMENT_VALIDATION_VIEW) FUNC SEARCH (FC CUSTOMER INVOICE)
    public function v_search_fc_customer_invoice($search_data){
        $this->m_search_fc_customer_invoice($search_data);
    } 

     //CLASS (PAYMENT_VALIDATION_VIEW)-->(PAYMENT_VALIDATION_VIEW) FUNC SEARCH TABLE (FC CUSTOMER INVOICE)
    public function v_search_table_fc_customer_invoice($search_table_data){
        $this->m_search_table_fc_customer_invoice($search_table_data);

    }

}
?>