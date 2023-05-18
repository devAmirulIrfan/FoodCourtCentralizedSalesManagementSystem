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
    <script src="1_order_management/script/script.js"></script>

    <title>Welcome</title>
</head>

<body class="bg-warning">
    <div class="container col-4" style="margin-top: 0.1rem">
        <!-- Display data / error -->
        <div id="display"></div>

    </div>
</body>

</html>
<?php
}
else header("../../")


?>