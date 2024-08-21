<?php
session_name('student_session');
session_start();
if (isset($_SESSION["authenticated"]) && $_SESSION["authenticated"] === true) {
    header("location: homepage.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="Dashboard/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="js/instascan.min.js"></script>
    <script src="js/adapter.min.js"></script>
    <script src="js/vue.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body style=" background-color: rgb(113, 99, 186)">
    <div class="wrapper fadeInDown">
        <div id="formContent">

            <div class="fadeIn first">
                <img src="image/profile.png" id="icon" />
            </div>

            <div class="col-md-12">
                <video id="preview" width="100%"></video>
            </div>

            <form action="qrCodevalidate.php" method="POST">
                <input type="text" id="idNumber" class="fadeIn second" readonly="" name="idNumber" placeholder="Student's 8 digits Id number">
            </form>

            <!-- Remind Passowrd -->
            <div id="formFooter">
                <a class="underlineHover" href="#">Forgot Password?</a>&nbsp; &nbsp;<a class="underlineHover" href="logout.php?role=student">Login through form</a>
            </div>

        </div>
    </div>

    <?php
    if (isset($_SESSION["status"]) && $_SESSION["status"] != "") {
    ?>
        <script>
            swal({
                title: '<?php echo $_SESSION["status"] ?>',
                icon: '<?php echo $_SESSION["status_code"] ?>',
                button: 'okay!',
            })
        </script>
    <?php

        unset($_SESSION["status"]);
    }
    ?>

    <script>
        let scanner = new Instascan.Scanner({
            video: document.getElementById('preview')
        });
        Instascan.Camera.getCameras().then(function(cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
            } else {
                alert("No camera found!");
            }
        }).catch(function(e) {
            console.log(e);
        });
        scanner.addListener('scan', function(c) {
            document.getElementById('idNumber').value = c;
            document.forms[0].submit();
        });
    </script>
</body>

</html>