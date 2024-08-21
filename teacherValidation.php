<?php
include("conn.php");
session_name('teacher_session'); // Set session name for teachers
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $replace = $_POST["replace"];
    $teacherName = strtolower($_POST["teacherName"]);

    if ($replace === "Teacher") {
        $sql = mysqli_query($conn, "SELECT * FROM tbllecturer WHERE LOWER(LecturerName) = '$teacherName'");
        if (mysqli_num_rows($sql) > 0) {
            $_SESSION["authenticated"] = true;
            $_SESSION["name"] = $teacherName;
            header("location:teacherAuthorize.php");
            exit();
        } else {
            $_SESSION["status"] = "Invalid credentials!";
            $_SESSION["status_code"] = "error";
        }
    }
}
