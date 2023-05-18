<?php
session_start();


// SESSION = (table_number) && (customer_id) ? OK = (ORDER_MGT)  || !OK MAIN_PAGE
if(isset($_SESSION["table_number"]) && isset($_SESSION["customer_id"])){
    echo $_SESSION["customer_id"];
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


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.1/html2pdf.bundle.min.js"
        integrity="sha512-1qLXyA3x0VSWeM+8vOotn6+KIRGdcQ8QMzsNeDXmdJsUAnoDGjzlxzqAuUGJGrGkGrtOrq4buDoAHxR89D9PWA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>



    <!-- IMPORTING THE SCRIPT -->

    <title>Welcome</title>
</head>

<body>
    <div class="container" style="margin-top: 4rem ; width: 20rem ">

        <div id="card" class="card">
            <div class="card-body">
                <div id="alert"></div>
                <center>
                    <div id="qrcode"></div>
                </center>
                <div id="display"></div>
            </div>
        </div>

    </div>
    <script src="script/script.js"></script>
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
</body>

</html>
<?php
}
else header("../../")


?>