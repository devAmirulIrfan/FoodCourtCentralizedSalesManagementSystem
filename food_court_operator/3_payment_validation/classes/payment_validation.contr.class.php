<?php
class PAYMENT_VALIDATION_CONTR extends PAYMENT_VALIDATION_MODEL{
    public function c_update_fc_customer_payment($payment_id,$payment_method,$payment_time){
        $this->m_update_fc_customer_payment($payment_id,$payment_method,$payment_time);
        
    }
}
?>