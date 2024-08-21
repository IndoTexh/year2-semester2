<?php
require 'conn.php';
session_name('student_session');
session_start();
if (!isset($_SESSION["authenticated"]) || $_SESSION["authenticated"] !== true) {
    header("Location: index.php");
    exit();
}

$id = isset($_SESSION["userID"]) ? $_SESSION["userID"] : null;
$sql = mysqli_query($conn, "SELECT tblstudent.StudentID, tblstudent.NameInKhmer, tblstudent.NameInLatin, tblstudent.student_number, tblstudentstatus.StudentStatusID, tblprogram.ProgramID FROM tblstudent LEFT JOIN tblstudentstatus ON tblstudent.StudentID = tblstudentstatus.StudentID LEFT JOIN tblprogram ON tblstudentstatus.ProgramID = tblprogram.ProgramID WHERE tblstudent.student_number = '$id'");
$row = mysqli_fetch_assoc($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="Dashboard/style.css">
    <link rel="stylesheet" href="Dashboard/attendance.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="js/instascan.min.js"></script>
    <script src="js/adapter.min.js"></script>
    <script src="js/vue.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
    <div class="sidebar">
        <div class="logo">
            <ul class="menu">
                <li class="active">
                    <a href="authorizeStudent.php">
                        <i class="fas fa-home"></i>
                        <span>Homepage</span>
                    </a>
                </li>

                <li>
                    <a href="account.php">
                        <i class="fa-solid fa-gear"></i>
                        <span>Account</span>
                    </a>
                </li>
                <li>
                    <a href="logout.php?role=student">
                        <i class="fa-solid fa-right-to-bracket"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <?php
    if (isset($_SESSION["status"]) && $_SESSION["status"] != "") {
    ?>
        <script>
            swal({
                title: '<?php echo $_SESSION["status"]; ?>',
                icon: '<?php echo $_SESSION["status_code"]; ?>',
                button: 'okay!',
            });
        </script>
    <?php
        unset($_SESSION["status"]);
        unset($_SESSION["status_code"]);
    }
    ?>

    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-6">
                <form action="noteAttByStudent.php" method="POST" id="attendanceForm">
                    <input type="hidden" name="studentStatusID" id="studentStatusID" value="<?php echo $row["StudentStatusID"] ?>">
                    <input type="hidden" name="StudentID" id="StudentID" value="<?php echo $row["NameInLatin"] ?>">
                    <input type="hidden" name="student_number" id="student_number" value="<?php echo $row["student_number"] ?>">
                    <input type="text" id="lecturerQR" name="lecturerQR" required>
                </form>
            </div>

            <div class="col-lg-6">
                <video id="preview" width="100%"></video>
            </div>
        </div>
    </div>


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
        scanner.addListener('scan', function(content) {
            document.getElementById('lecturerQR').value = content;
            document.getElementById('attendanceForm').submit();
        });
    </script>
</body>

</html>