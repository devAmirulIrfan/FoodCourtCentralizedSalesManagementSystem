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
    <script src="main/script/script.js"></script>

    <title>Welcome</title>
</head>

<body class="bg-warning">
    <div class="container" style="margin-top: 0.4rem">
        <!-- Navigation bar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Malakat Food Street</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="../logout.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="../logout.php">Logout</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="1_vendor_management">Vendor Management</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="2_payment_release" tabindex="-1">Vendor Fund
                                Release</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="3_payment_validation/" tabindex="-1">Payment
                                Validation</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End of navigation bar  -->
        <!-- Overall Dashboard -->
        <center style="margin-top: 0.9rem">
            <iframe title="0-FOOD COURT OPERATOR" width="1140" height="541.25"
                src="https://app.powerbi.com/reportEmbed?reportId=8a3bbb78-923f-4643-8954-e666515f8848&autoAuth=true&ctid=cdcbb0e2-9fea-4f54-8670-672707797ada"
                frameborder="0" allowFullScreen="true"></iframe>
        </center>

        <div id="display"></div>
    </div>

</body>

</html>
<?php
}
else header("../")


?>