<?php
class FUND_RELEASE_MODEL extends Dbh{

    //DISPLAY FOOD VENDOR COLLECTION
    public function m_display_fc_vendor_orders(){
        $sql = "SELECT 
        fc_customer_1_food_order_management.order_cust_id,
        fc_customer_1_food_order_management.order_food_vendor_id,
        fc_customer_1_food_order_management.order_total_price,
        fc_vendor_1_acc.vendor_id,
        fc_vendor_1_acc.vendor_name,
        fc_customer_2_payment.payment_customer_id,
        fc_customer_2_payment.payment_status,
        SUM(fc_customer_1_food_order_management.order_total_price) AS total_collection,
        SUM(fc_customer_1_food_order_management.order_total_price)*0.9 AS total_collection_cut,
        SUM(fc_customer_1_food_order_management.order_total_price)*0.1 AS operator_commision
        FROM 
        fc_customer_1_food_order_management
        JOIN
        fc_vendor_1_acc
        ON
        fc_customer_1_food_order_management.order_food_vendor_id = fc_vendor_1_acc.vendor_id
        JOIN 
        fc_customer_2_payment
        ON
        fc_customer_1_food_order_management.order_cust_id = fc_customer_2_payment.payment_customer_id
        WHERE
        fc_customer_1_food_order_management.order_status = ?
        AND
        fc_customer_2_payment.payment_status = ?
        GROUP BY
        fc_vendor_1_acc.vendor_name
        "
        ;
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute(["completed","PAID"]);
        while($row = $stmt->fetch()){
            $json_array[] = $row;
        }
        echo json_encode($json_array); 

}


 //DISPLAY FOOD VENDOR INDIV COLLECTION
 public function m_display_fc_vendor_orders_indi_data($get_fund_modal_data){
    $sql = "SELECT 
    fc_customer_1_food_order_management.order_cust_id,
    fc_customer_1_food_order_management.order_food_vendor_id,
    fc_customer_1_food_order_management.order_total_price,
    fc_vendor_1_acc.vendor_id,
    fc_vendor_1_acc.vendor_name,
    fc_customer_2_payment.payment_customer_id,
    fc_customer_2_payment.payment_status,
    SUM(fc_customer_1_food_order_management.order_total_price) AS total_collection,
    SUM(fc_customer_1_food_order_management.order_total_price)*0.9 AS total_collection_cut,
    SUM(fc_customer_1_food_order_management.order_total_price)*0.1 AS operator_commision
    FROM 
    fc_customer_1_food_order_management
    JOIN
    fc_vendor_1_acc
    ON
    fc_customer_1_food_order_management.order_food_vendor_id = fc_vendor_1_acc.vendor_id
    JOIN 
    fc_customer_2_payment
    ON
    fc_customer_1_food_order_management.order_cust_id = fc_customer_2_payment.payment_customer_id
    WHERE
    fc_customer_1_food_order_management.order_status = ? 
    AND
    fc_customer_1_food_order_management.order_food_vendor_id = ? 
    AND
    fc_customer_2_payment.payment_status = ?
    




    GROUP BY
    fc_vendor_1_acc.vendor_name
    "
    ;
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute(["completed",$get_fund_modal_data,"PAID"]);
    while($row = $stmt->fetch()){
        $json_array[] = $row;
    }
    echo json_encode($json_array); 

}

     //RELEASE FOOD COURT OPERATOR FUND
     public function m_fund_release_fc_operator($fund_release_vendor_id,$fund_release_vendor_collection,$fund_release_vendor_collection_cut,$fund_release_operator_comision,$key,$fund_release_method,$fund_release_notes){

        $sql_fund_release_in_process = 
        "UPDATE
        fc_customer_1_food_order_management
        JOIN
        fc_customer_2_payment
        ON
        fc_customer_1_food_order_management.order_cust_id = fc_customer_2_payment.payment_customer_id
        SET 
        fc_customer_1_food_order_management.order_status = ?
        WHERE
        fc_customer_1_food_order_management.order_food_vendor_id = ?
        AND 
        fc_customer_1_food_order_management.order_status = ?
        AND
        fc_customer_2_payment.payment_status = ?

        

        
        ";

        $stmt = $this->connect()->prepare($sql_fund_release_in_process);


        if($stmt->execute(["fund_release_in_process",$fund_release_vendor_id,"completed","PAID"]))
        {
            $insert_fund_records = "INSERT INTO fc_operator_2_fund_release(fund_release_vendor_id,fund_release_vendor_collection,	fund_release_vendor_collection_cut,fund_release_operator_comision,	fund_release_key,fund_release_notes,fund_release_method) VALUES(?,?,?,?,?,?,?)";

            $stmt = $this->connect()->prepare($insert_fund_records);

            if($stmt->execute([$fund_release_vendor_id,$fund_release_vendor_collection,$fund_release_vendor_collection_cut,$fund_release_operator_comision,$key,$fund_release_notes,$fund_release_method]))
            {
                $sql_fund_release_completed = "UPDATE fc_customer_1_food_order_management SET order_status = ? , order_fund_release_ref_key = ? WHERE order_food_vendor_id = ? AND order_status = ? ";

                $stmt = $this->connect()->prepare($sql_fund_release_completed);

                if($stmt->execute(["fund_release_completed",$key,$fund_release_vendor_id,"fund_release_in_process"])){
                    echo "ok";
                }
            }
        }
        

    }
}
?>