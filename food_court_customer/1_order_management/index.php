<?php
session_start();


// SESSION = (table_number) && (customer_id) ? OK = (ORDER_MGT)  || !OK MAIN_PAGE
if(isset($_SESSION["table_number"]) && isset($_SESSION["customer_id"])){
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- REQUIRED META TAGS -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- BOOTSTRAP CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />

    <!-- IMPORT LIBRARY OF BOOTSTRAP -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <!-- IMPORTING THE SCRIPT -->
    <script src="script/script.js"></script>

    <title>Welcome</title>
</head>

<body>
    <div class="container" style="margin-top: 0.1rem">
        <br>
        <a type="button" class="btn btn-danger" href="../../">Exit Page</a>
        <br><br>
        <!-- (VENDOR) SEARCH -->
        <div class="input-group">
            <input id="search" onkeyup="search_get_id()" type="text" class="form-control" aria-label="Search Vendor">
            <span class="input-group-text">Food Menu Search</span>
        </div>
        <!-- END OF (VENDOR) SEARCH -->
        <br>

        <!-- CUSTOMER ORDERS -->
        <p>
            <button class="btn btn-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample"
                aria-expanded="false" aria-controls="collapseExample">
                My Orders
            </button>
        </p>
        <div class="collapse" id="collapseExample">
            <div class="card card-body">
                <div id="display_orders"></div>
                <div id="display_orders_total_price"></div>
            </div>
        </div>
        <!-- END OF CUSTOMER ORDERS -->

        <br>
        <div id="btn"></div>
        <br>
        <!-- Display data / error -->
        <div id="display"></div>



        <!-- MODAL -->
        <div class="modal fade" id="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">
                            Food Order
                        </h5>
                        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            onclick="clear_data()"></button> -->
                    </div>
                    <!-- HIDDEN INPUT  -->

                    <!-- CUSTOMER ID -->
                    <input type="hidden" id="order_cust_id" value="<?php echo $_SESSION["customer_id"] ?>">
                    <!-- TABLE NUMBER -->
                    <input type="hidden" id="order_table_id" value="<?php echo $_SESSION["table_number"] ?>">
                    <!-- FOOD ID -->
                    <input type="hidden" id="order_food_id" value="">
                    <!-- FOOD CATEGORY ID -->
                    <input type="hidden" id="order_food_vendor_id" value="" placeholder="food_menu_vendor_id">
                    <!-- FOOD PRICE -->
                    <input type="hidden" id="order_food_price" placeholder="order_food_price">
                    <!-- FOOD QUANTITY -->
                    <input type="hidden" id="order_food_qty" value="" placeholder="order_food_qty">
                    <!-- FOOD TOTAL PRICE -->
                    <input type="hidden" id="order_total_price" value="" placeholder="order_total_price">

                    <!-- END OF HIDDEN INPUT -->
                    <div class="modal-body">
                        <div id="food_name"></div>
                        <div id="food_image"></div>
                        <table>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>-------------></th>
                                <th>
                                    <h1>Price RM</h1>
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    <div id="decr"><button class="btn btn-danger"
                                            onclick="modal_calculate_price(-1)">-</button></div>
                                </td>
                                <td>
                                    <h2>
                                        <div id="count"></div>
                                    </h2>
                                </td>
                                <td>
                                    <div id="incr"><button class="btn btn-danger"
                                            onclick="modal_calculate_price(1)">+</button></div>
                                </td>
                                <td></td>
                                <td>
                                    <h2>
                                        <div id="order_price"></div>
                                    </h2>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class=" modal-footer">
                        <button type="button" id="close" class="btn btn-danger" data-bs-dismiss="modal"
                            onclick="clear_modal_data()">
                            Cancel
                        </button>
                        <div id="btn_create">
                            <button type="button" class="btn btn-primary" onclick="insert_get_data()">Add To
                                Orders</button>
                        </div>
                        <!-- END OF MODAL -->
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>

</html>
<?php
}
else header("../../")


?>