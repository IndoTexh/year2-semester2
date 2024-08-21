<?php
include("conn.php");
session_name('admin_session');
session_start();
if (isset($_SESSION["authenticated"]) && $_SESSION["authenticated"] === true) {
    header("location:homepage.php");
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $response = [];
    $adminName = strtolower($_POST["adminName"]);
    $selectAs = $_POST["selectAs"];

    if ($selectAs === "Administrator") {
        $sql = mysqli_query($conn, "SELECT * FROM admin WHERE LOWER(adminName) = '$adminName'");
        if (mysqli_num_rows($sql) > 0) {
            $_SESSION["authenticated"] = true;
            $_SESSION["status"] = "Welcome, $replace";
            $_SESSION["status"] = "success";
            header("location:homepage.php");
        } else {
        }
    }
}
