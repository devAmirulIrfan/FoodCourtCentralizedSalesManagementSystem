<?php
session_start();


// User only can have access when session is set to admin
if(isset($_SESSION["admin"])=="admin"){
    ?>
<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />

    <!-- Import library Of bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <!-- Importing the script -->
    <script src="script/script.js"></script>

    <title>Welcome</title>
</head>

<body class="bg-warning">
    <div class="container" style="margin-top: 0.4rem">
        <!-- navigation bar -->
        <nav class=" navbar navbar-expand-lg navbar-light bg-light" style="margin-top: 0.4rem">
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
                            <a class="nav-link active" href="../1_vendor_management">Vendor Management</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#" tabindex="-1">Vendor Fund
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

        <!-- DISPLAY TABLE -->
        <div style="margin-top: 0.4rem" id="display"></div>
        <!-- END OF DISPLAY TABLE -->

        <!-- MODAL -->
        <!-- Button trigger modal -->
        <button hidden id="modal" type="button" class="btn btn-primary" data-bs-toggle="modal"
            data-bs-target="#exampleModal">
            Launch demo modal
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalLabel">
                            <div id="title"></div>
                        </h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- fund_release_vendor_id -->
                        <input type="hidden" id="fund_release_vendor_id">
                        <!-- fund_release_vendor_collection -->
                        <input type="hidden" id="fund_release_vendor_collection">
                        <!--  fund_release_vendor_collection_cut -->
                        <input type="hidden" id="fund_release_vendor_collection_cut">
                        <!-- fund_release_operator_comision -->
                        <input type="hidden" id="fund_release_operator_comision">

                        <div id="modal_display"></div>


                        <!-- DROP DOWN PAYMENT OPTION -->
                        <select id="fund_release_method" class="form-select" aria-label="Default select example">
                            <option value="CASH">CASH</option>
                            <option value="QR BANK TRANSFER">QR BANK TRANSFER</option>
                            <option value="TNG E-WALLET">TNG E-WALLET</option>
                            <option value="GRAB PAY">GRAB PAY</option>
                            <option value="SHOPEE PAY">SHOPEE PAY</option>
                        </select>
                        <!-- END OF DROP DOWN PAYMENT OPTION -->
                        <br>

                        <!-- TEXT AREA FOR REMARKS -->
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Payment Remarks</label>
                            <textarea class="form-control" id="fund_release_notes" rows="3"></textarea>
                        </div>
                        <!-- END OF REMARKS -->

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button onclick="release_fund_get_data()" type="button" class="btn btn-success">Release
                            Fund</button>
                    </div>
                </div>
            </div>
        </div>
        <!--END OF MODAL -->


    </div>

</body>

</html>
<?php
}
else header("../")


?>