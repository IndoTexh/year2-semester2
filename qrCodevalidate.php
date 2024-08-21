<?php
include("conn.php");
session_name('student_session');
session_start();
if (isset($_POST["idNumber"])) {
    $id = $_POST["idNumber"];

    $check = "SELECT * FROM tblstudent WHERE student_number = '$id'";
    $result = $conn->query($check);
    if (mysqli_num_rows($result) > 0) {
        $_SESSION["userID"] = $id;
        $_SESSION["authenticated"] = true;
        $_SESSION["status"] = "Welcome";
        $_SESSION["status_code"] = "success";
        header("location:authorizeStudent.php");
    } else {
        $_SESSION["status"] = "The student is not found within the database";
        $_SESSION["status_code"] = "warning";
        header("location:loginQrcode.php");
    }
}
