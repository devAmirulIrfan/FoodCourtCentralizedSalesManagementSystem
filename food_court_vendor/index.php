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
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="../logout.php">Logout</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="1_food_menu_management">Food Menu</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="2_order_management">Order Management</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="3_my_pay_outs" tabindex="-1">My Pay Outs</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <center style="margin-top: 0.9rem">
            <?php
           $id =  $_SESSION["vendor_id"];

           if($id==1){
            echo '<iframe title="1_MALAY_COUSINE" width="1140" height="541.25" src="https://app.powerbi.com/reportEmbed?reportId=021159e2-4226-49ca-ade9-6c6b69560216&autoAuth=true&ctid=cdcbb0e2-9fea-4f54-8670-672707797ada" frameborder="0" allowFullScreen="true"></iframe>';
           }
           if($id==2){
            echo '<iframe title="2_CHINESE_DELIGHTS" width="1140" height="541.25" src="https://app.powerbi.com/reportEmbed?reportId=7047afee-10b9-4885-81a5-94f7172f1aba&autoAuth=true&ctid=cdcbb0e2-9fea-4f54-8670-672707797ada" frameborder="0" allowFullScreen="true"></iframe>';
           }
           if($id==3){
            echo '<iframe title="3_MAMAK" width="1140" height="541.25" src="https://app.powerbi.com/reportEmbed?reportId=58bb430e-1272-4556-bd04-7de7f0e6b3b7&autoAuth=true&ctid=cdcbb0e2-9fea-4f54-8670-672707797ada" frameborder="0" allowFullScreen="true"></iframe>';
           }
           if($id==4){

            echo '<iframe title="4_SYEIKH_ARABIC_HAMZAH_FOOD" width="1140" height="541.25" src="https://app.powerbi.com/reportEmbed?reportId=3dab831f-9eda-413e-b795-a19db40c1bdd&autoAuth=true&ctid=cdcbb0e2-9fea-4f54-8670-672707797ada" frameborder="0" allowFullScreen="true"></iframe>';
           }
           if($id==5){

            echo '<iframe title="5_NAUFAL_SOFT_DRINKS" width="1140" height="541.25" src="https://app.powerbi.com/reportEmbed?reportId=670e9525-2f41-41ab-86cb-997c12e281cb&autoAuth=true&ctid=cdcbb0e2-9fea-4f54-8670-672707797ada" frameborder="0" allowFullScreen="true"></iframe>';
           }
           if($id==6){

            echo '<<iframe title="6_ITALIAN_FOOD" width="1140" height="541.25" src="https://app.powerbi.com/reportEmbed?reportId=ec962f75-0977-4dc1-a7f0-8a5e38b7335c&autoAuth=true&ctid=cdcbb0e2-9fea-4f54-8670-672707797ada" frameborder="0" allowFullScreen="true"></iframe>';
           }
           if($id==7){

            echo '<iframe title="7_ITALIAN_DESERT" width="1140" height="541.25" src="https://app.powerbi.com/reportEmbed?reportId=6b305bd6-78a4-4be3-83b1-575c62157a65&autoAuth=true&ctid=cdcbb0e2-9fea-4f54-8670-672707797ada" frameborder="0" allowFullScreen="true"></iframe>';
           }
            ?>
        </center>

    </div>
</body>

</html>
<?php
}
else header("../")


?>