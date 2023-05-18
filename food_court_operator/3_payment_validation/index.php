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
    <script src="script/qr.js"></script>
    <script src="script/script.js"></script>

    <title>Welcome</title>
</head>

<body>
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
                            <a class="nav-link active" href="../2_payment_release" tabindex="-1">Vendor Fund
                                Release</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#" tabindex="-1">Payment
                                Validation</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End of navigation bar  -->


        <!-- IMPORTING THE AUDIO -->
        <audio id="audio" src="beep.wav"></audio>
        <!-- END OF IMPORTING THE AUDIO -->

        <!-- QR CODE SCANNER -->
        <div class=" collapse" id="collapseExample">
            <div class="card card-body">
                <center><video id="preview" style="width:300px;height100px;"></video></center>
            </div><br>

            <button type="button" class="btn btn-warning" onclick="camera_display(0)">Front Cam</button>
            <button type="button" class="btn btn-warning" onclick="camera_display(1)">Rear Cam</button>
            <br>

        </div><br>
        <!-- END OF QR CODE -->

        <!-- QR BUTTON -->
        <div>
            <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample"
                aria-expanded="false" aria-controls="collapseExample">
                QR Search
            </button>
        </div>

        <br>
        <!-- END OF QR BUTTON -->

        <!-- DROP DOWN TABLE NO SEARCH -->
        <div class="dropdown">
            <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton1"
                data-bs-toggle="dropdown" aria-expanded="false">
                Table Search
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li><a onclick="search_table_get_id(1)" class="dropdown-item">1</a></li>
                <li><a onclick="search_table_get_id(2)" class="dropdown-item">2</a></li>
                <li><a onclick="search_table_get_id(3)" class="dropdown-item">3</a></li>
                <li><a onclick="search_table_get_id(4)" class="dropdown-item">4</a></li>
                <li><a onclick="search_table_get_id(5)" class="dropdown-item">5</a></li>
                <li><a onclick="search_table_get_id(6)" class="dropdown-item">6</a></li>
                <li><a onclick="search_table_get_id(7)" class="dropdown-item">7</a></li>
                <li><a onclick="search_table_get_id(8)" class="dropdown-item">8</a></li>
                <li><a onclick="search_table_get_id(9)" class="dropdown-item">9</a></li>
                <li><a onclick="search_table_get_id(10)" class="dropdown-item">10</a></li>
            </ul>
        </div>

        <!-- END OF DROP DOWN TABLE NO SEARCH -->

        <br>
        <div id="display"></div>

        <!-- Button trigger modal -->
        <button hidden type="button" id="show_invoice" class="btn btn-primary" data-bs-toggle="modal"
            data-bs-target="#exampleModal">
            Launch demo modal
        </button>


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Payment Validation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="payment_id" value="">

                        <div id="display_modal_data"></div>

                        <select id="payment_method" class="form-select" aria-label="Default select example">
                            <option value="CASH">CASH</option>
                            <option value="QR BANK TRANSFER">QR BANK TRANSFER</option>
                            <option value="TNG E-WALLET">TNG E-WALLET</option>
                            <option value="GRAB PAY">GRAB PAY</option>
                            <option value="SHOPEE PAY">SHOPEE PAY</option>
                        </select>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="update_get_data()">Mark As Paid</button>
                    </div>
                </div>
            </div>
        </div>

    </div>


</body>
<script type="text/javascript">
let scanner = new Instascan.Scanner({
    video: document.getElementById('preview'),
    mirror: true
});



const camera_display = function(data) {
    Instascan.Camera.getCameras().then(function(cameras) {
        if (cameras.length > 0) {
            scanner.start(cameras[data]);
        } else {
            console.error('No cameras found.');
        }
    }).catch(function(e) {
        console.error(e);
    });
};

camera_display(0);

scanner.addListener('scan', function(content) {
    if (content != '') {
        audio.play();
        console.log(content);
        send(content);
    }
    // document.getElementById("outer").value = content;
});



function send(value) {
    search_get_id(value);
}
</script>

</html>
<?php
}
else header("../")


?>