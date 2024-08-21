<?php
include("conn.php");
session_name('student_session');
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = strtolower(trim($_POST["name"]));
    $id = trim($_POST["idNumber"]);

    if (empty($name) || empty($id)) {
        $_SESSION["status"] = "Name or ID number cannot be empty!";
        $_SESSION["status_code"] = "error";
        header("location:index.php");
        exit();
    }

    $stmt = $conn->prepare("SELECT * FROM tblstudent WHERE LOWER(NameInLatin) = ? AND student_number = ?");
    $stmt->bind_param("ss", $name, $id);

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION["userID"] = $id;
        $_SESSION["authenticated"] = true;
        header("location:authorizeStudent.php");
    } else {
        $_SESSION["status"] = "Name or ID not found in database.";
        $_SESSION["status_code"] = "warning";
        header("location:logout.php?role=student");
    }

    $stmt->close();
    $conn->close();
}
?>

/* if (isset($_POST["insert"])) {
$name = strtolower($_POST["name"]);
$id = $_POST["idNumber"];

$select = "SELECT * FROM tblstudent WHERE LOWER(NameInLatin) = '$name' AND student_number = '$id'";
$result = $conn->query($select);
if (mysqli_num_rows($result) > 0) {

}


if (empty($name) || empty($id)) {
$_SESSION["status"] = "Please fill all the requirements";
$_SESSION["status_code"] = "warning";
header("location:index.php");
exit();
}
} */