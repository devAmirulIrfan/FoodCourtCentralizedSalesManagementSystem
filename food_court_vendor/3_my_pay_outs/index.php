<?php
session_start();


// User only can have access when session is set to admin
if(isset($_SESSION["vendor"])=="vendor"){
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.1/html2pdf.bundle.min.js"
        integrity="sha512-1qLXyA3x0VSWeM+8vOotn6+KIRGdcQ8QMzsNeDXmdJsUAnoDGjzlxzqAuUGJGrGkGrtOrq4buDoAHxR89D9PWA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
                            <a class="nav-link active" href="../1_food_menu_management">Food Menu</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="../2_order_management">Order Management</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="" tabindex="-1">My Pay Outs</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End of navigation bar  -->
        <div id="display_orders"></div>

        <!-- Button trigger modal -->
        <button id="modal" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"
            hidden>
            Launch demo modal
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">My Pay Outs</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="display_modal"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="generatePDF()">Print To
                            PDF</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>

</html>
<?php
}
else header("../")


?>