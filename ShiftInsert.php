<?php
include("conn.php");
session_name('admin_session');
session_start();
if (!isset($_SESSION["authenticated"]) || $_SESSION["authenticated"] !== true) {
    $_SESSION["status"] = "You are not authorized to see that page unless you are logged in.";
    $_SESSION["status_code"] = "warning";
    header("Location:index.php");
    exit();
}
if (isset($_POST["submit"])) {
    $shiftKH = $_POST["shiftKH"];
    $shiftEN = $_POST["shiftEN"];

    if (empty($shiftKH) || empty($shiftEN)) {
        $_SESSION["status"] = "Please fill all the requirements";
        $_SESSION["status_code"] = "warning";
        header("location:ShiftForm.php");
        exit();
    }

    $insert_query = mysqli_query($conn, "INSERT INTO tblshift (ShiftKH, ShiftEN) VALUES ('$shiftKH','$shiftEN')") or die("Query failed");

    if ($insert_query) {
        $_SESSION["status"] = "New shift has been added!";
        $_SESSION["status_code"] = "success";
        header("location:Shift.php");
    } else {
        $_SESSION["status"] = "Unable to inserted!";
        $_SESSION["status_code"] = "error";
        header("location:ShiftForm.php");
    }
}

$id = $_GET["updateID"];
$select = mysqli_query($conn, "SELECT * FROM tblshift WHERE ShiftID = '$id'");
$row = mysqli_fetch_assoc($select);

if (isset($_POST["update"])) {
    $shiftID = $_POST["update_shiftID"];
    $shiftKH = $_POST["update_shiftKH"];
    $shiftEN = $_POST["update_shiftEN"];

    $update_query = mysqli_query($conn, "UPDATE tblshift SET ShiftKH = '$shiftKH', ShiftEN = '$shiftEN' WHERE ShiftID = '$shiftID'");

    if ($update_query) {
        $_SESSION["status"] = "Shift has been updated";
        $_SESSION["status_code"] = "success";
        header("location:Shift.php");
    } else {
        $_SESSION["status"] = "Unable to updated";
        $_SESSION["status_code"] = "error";
        header("location:ShiftForm.php");
    }
}

if (isset($_GET["deleteID"])) {
    $id = $_GET["deleteID"];
    $delete_query = mysqli_query($conn, "DELETE FROM tblshift WHERE ShiftID = '$id'");

    if ($delete_query) {
        $_SESSION["status"] = "Shift has been deleted";
        $_SESSION["status_code"] = "success";
        header("location:Shift.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="Dashboard/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
    <div class="sidebar">
        <div class="logo">
            <ul class="menu">
                <li>
                    <a href="homepage.php">
                        <i class="fas fa-home">
                        </i>
                        <span>Homepage</span>
                    </a>
                </li>
                <li>
                    <a href="LecturerInfo.php">
                        <i class="fa-solid fa-chalkboard-user"></i>
                        <span>Lecturer</span>
                    </a>
                </li>
                <li>
                    <a href="StudentInfo.php">
                        <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                        <span>Student</span>
                    </a>
                </li>
                <li class="active">
                    <a href="Shift.php">
                        <i class="fa-solid fa-clock"></i>
                        </i>
                        <span>Shift</span>
                    </a>
                </li>

                <li>
                    <a href="campus.php">
                        <i class="fa-solid fa-school"></i>
                        </i>
                        <span>Campus</span>
                    </a>
                </li>

                <li>
                    <a href="batch.php">
                        <i class="fa-solid fa-list"></i>
                        </i>
                        <span>Batch</span>
                    </a>
                </li>

                <li>
                    <a href="logout.php?role=admin">
                        <i class="fa-solid fa-right-to-bracket"></i>
                        </i>
                        <span>Logout</span>
                    </a>
                </li>

                <!--  <li>
                    <a href="#">
                        <i class="fas fa-user">
                        </i>
                        <span>Users</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-cog">
                        </i>
                        <span>Settings</span>
                    </a>
                </li>
                <li class="logout">
                    <a href="#">
                        <i class="fas fa-sign-out-alt">
                        </i>
                        <span>Logout</span>
                    </a>
                </li> -->
            </ul>
        </div>
    </div>
    <div class="main-content">
        <div class="header--wrapper">
            <div class="header--title">
                <span>Attendance</span>
                <h2>System</h2>
            </div>
            <div class="user--info">
                <div class="search--box">
                    <i class="fas solid fa-search"></i>
                    <input type="text" placeholder="Search">
                </div>
                <img src="../Dashboard/images/admin.jpg" alt="">
            </div>
        </div>

        <form action="" method="POST">
            <div class="row">
                <div class="col-lg-6">

                    <input class="form-control form-control mb-2 mt-4" type="hidden" name="update_shiftID" value="<?php echo $row["ShiftID"] ?>" autocomplete="off">
                    <input class="form-control form-control mb-2 mt-4" type="text" name="update_shiftKH" value="<?php echo $row["ShiftKH"] ?>" autocomplete="off">
                </div>
                <div class="col-lg-6">
                    <input class="form-control form-control mb-2 mt-4" type="text" name="update_shiftEN" value="<?php echo $row["ShiftEN"] ?>" autocomplete="off">
                </div>
            </div>
            <button type="submit" name="update" class="btn btn" style="background: rgb(113, 99, 186); color:#fff">Update</button>
            <a href="Shift.php" class="btn btn" style="background: rgb(225, 212, 95);  color:#fff;">Cancel</a>
        </form>

    </div>
</body>

</html>