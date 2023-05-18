<?php
session_start();


// SESSION = (ADMIN) ? OK = (VENDOR_MGT)  || !OK MAIN_PAGE
if(isset($_SESSION["vendor"])=="vendor"){
    // header('Location: ../../dbh.class.php');
?>
<html>

<head>
    <!-- REQUIRED META TAGS -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
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
    <div class="container">


        <!-- Navigation bar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light" style="margin-top: 0.4rem">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Malakat Food Street</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="../">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="../../logout.php">Logout</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Food Menu</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="../2_order_management">Order Management</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="../3_my_pay_outs" tabindex="-1">My Pay Outs</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End of navigation bar  -->

        <br>
        <button id="open" class=" btn btn-success" data-bs-toggle="modal" data-bs-target="#modal" type="button"
            onclick="show_create_modal_btn()">
            Create New Food Menu
        </button>
        <br>
        <!-- (VENDOR) SEARCH -->
        <div class="input-group">
            <input id="search" onkeyup="search_get_id()" type="text" class="form-control" aria-label="Search Vendor">
            <span class="input-group-text">Food Menu Search</span>
        </div>
        <!-- END OF (VENDOR) SEARCH -->
        <br>

        <!-- Display data / error -->
        <div id="display"></div>

        <!-- MODAL -->
        <div class="modal fade" id="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">
                            <div id="title"></div>
                        </h5>
                        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            onclick="clear_data()"></button> -->
                    </div>
                    <!-- HIDDEN ID  -->
                    <input type="hidden" id="food_menu_id">
                    <!-- END OF HIDDEN ID -->
                    <div class="modal-body">

                        <!-- (NEW FOOD MENU) FOOD_MENU_NAME INPUT -->
                        <div class="mb-3">
                            <label for="food_menu_name" class="form-label">Food Menu Name</label>
                            <input type="text" class="form-control" id="food_menu_name" />
                            <div id="food_menu_nameText" class="form-text">
                                Food menu name
                            </div>
                        </div>
                        <!-- END OF FOOD_MENU_NAME INPUT-->

                        <!-- (NEW FOOD MENU) IMAGE INPUT -->
                        <div class="mb-3">
                            <label for="food_menu_image" class="form-label">Food Menu Image Name</label>
                            <input type="file" class="form-control" id="food_menu_image"
                                onchange="change_to_base_64()" />
                            <div id="food_menu_image" class="form-text">
                                Food Menu Image
                            </div>
                            <!-- IMAGE VIEW -->
                            <div id="image_view"></div>
                            <!-- END OF IMAGE VIEW -->

                            <!-- IMAGE NAME -->
                            <input type="hidden" id="food_menu_image_name">
                            <!-- ENDO OF IMAGE NAME -->

                            <!-- ENCODE INPUT -->
                            <input type="hidden" id="base_64" value="">
                            <!-- END OF ENCODE INPUT  -->

                        </div>
                        <!-- END OF FOOD_MENU_NAME INPUT-->

                        <!-- (NEW FOOD MENU) FOOD_MENU_PRICE INPUT -->
                        <div class="mb-3">
                            <label for="food_menu_price" class="form-label">Food Menu Price</label>
                            <input type="number" class="form-control" id="food_menu_price" />
                            <div id="food_menu_priceText" class="form-text">
                                Food menu price
                            </div>
                        </div>
                        <!-- END OF FOOD_MENU_PRICE INPUT-->

                        <!--  (ACTIVE/DISABLED) SELECT INPUT -->
                        <div class="mb-3">
                            <label for="select_food_menu_status" class="form-label">Select Food Menu Status</label>
                            <select id="select_food_menu_status" class="form-select">
                                <option value="active">Active</option>
                                <option value="disabled">Disabled</option>
                            </select>
                        </div>
                        <!-- END OF SELECT INPUT -->

                    </div>
                    <div class="modal-footer">
                        <button type="button" id="close" class="btn btn-danger" data-bs-dismiss="modal"
                            onclick="clear_modal_data()">
                            Cancel
                        </button>
                        <div id="btn_create">
                            <button type="button" class="btn btn-primary" onclick="insert_get_data()">Create</button>
                        </div>
                        <div id="btn_edit">
                            <button id="save_vendor" type="button" class="btn btn-success"
                                onclick="edit_get_data()">Save
                                edits</button>
                        </div>
                        <!-- END OF MODAL -->
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>
<?php
}
else header("../../")


?>