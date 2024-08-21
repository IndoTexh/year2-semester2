<?php
include("conn.php");
session_name('admin_session');
session_start();
if (!isset($_SESSION["authenticated"]) || $_SESSION["authenticated"] !== true) {
    $_SESSION["status"] = "You are not authorized to see that page unless you are not log in";
    $_SESSION["status_code"] = "warning";
    header("location:index.php");
    exit();
}
$faculty_id = $_POST["faculty_data"];
$major = mysqli_query($conn, "SELECT * FROM tblmajor WHERE FacultyID = '$faculty_id'");
$output = "";
while ($row = mysqli_fetch_assoc($major)) {
    $output .= '<option value="' . $row['MajorID'] . '">' . $row['MajorEN'] . '</option>';
}
echo $output;
