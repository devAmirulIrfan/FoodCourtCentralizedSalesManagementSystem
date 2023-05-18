<?php
session_start();


// SESSION = (ADMIN) ? OK = (VENDOR_MGT)  || !OK MAIN_PAGE
if(isset($_SESSION["admin"])=="admin"){
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

<body class="bg-warning">
    <div class="container" style="margin-top: 0.4rem">
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
                            <a class="nav-link active" href="#">Vendor Management</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="../2_payment_release" tabindex="-1">Vendor Fund
                                Release</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="../3_payment_validation/" tabindex="-1">Payment
                                Validation</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End of navigation bar  -->

        <br>
        <!-- (VENDOR) SEARCH -->
        <div class="input-group">
            <input id="search" onkeyup="search_get_id()" type="text" class="form-control" aria-label="Search Vendor">
            <span class="input-group-text">Vendor Search</span>
        </div>
        <!-- END OF (VENDOR) SEARCH -->
        <br>

        <button id="open" class=" btn btn-success" data-bs-toggle="modal" data-bs-target="#modal" type="button"
            onclick="show_create_modal_btn()">
            Create New Vendor
        </button>
        <br>
        <!-- MODAL FOR (CREATE N EDIT VENDOR) -->

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
                    <input type="hidden" id="vendor_id">
                    <!-- END OF HIDDEN ID -->
                    <div class="modal-body">
                        <!-- (NEW VENDOR) VENDOR USERNAME INPUT -->
                        <div class="mb-3">
                            <label for="vendor_username" class="form-label">Vendor username</label>
                            <input type="text" class="form-control" id="vendor_username" />
                            <div id="vendor_usernameText" class="form-text">
                                Food vendor username
                            </div>
                        </div>
                        <!-- END OF VENDOR USERNAME INPUT-->

                        <!-- (NEW VENDOR) vendor_password INPUT-->
                        <div class="mb-3">
                            <label for="vendor_password" class="form-label">Vendor Password</label>
                            <input type="text" id="vendor_password" class="form-control"
                                aria-describedby="vendor_passwordHelpBlock" />
                            <div id="vendorPasswordText" class="form-text">
                                Please make sure you turn off your caps lock
                            </div>
                        </div>
                        <!-- END OF  VENDOR PASSWORD INPUT -->

                        <!-- (NEW VENDOR) FOOD VENDOR NAME INPUT-->
                        <div class="mb-3">
                            <label for="vendor_desc" class="form-label">Vendor Full NAme</label>
                            <input type="text" class="form-control" id="vendor_name" />
                            <div id="vendorNameText" class="form-text">
                                Food vendor name
                            </div>
                        </div>
                        <!-- END OF FOOD VENDOR NAME INPUT -->

                        <!-- (NEW VENDOR) FOOD VENDOR DESC INPUT-->
                        <div class="mb-3">
                            <label for="vendor_name" class="form-label">Vendor Payment Account</label>
                            <input type="textarea" rows="10" cols="50" class="form-control" id="vendor_desc" />
                            <div id="vendorNameText" class="form-text">
                                Vendor Payment Account
                            </div>
                        </div>
                        <!-- END OF FOOD VENDOR DESC INPUT -->


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

        <!-- Display data / error -->
        <div id="display"></div>

    </div>

</body>

</html>
<?php
}
else header("../../")


?>