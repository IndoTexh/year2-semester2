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

if (isset($_POST["submit"])) {
    $lecturerName = $_POST["lecturerName"];

    if (empty($lecturerName)) {
        $_SESSION["status"] = "Please fill all the requirements";
        $_SESSION["status_code"] = "warning";
        header("location:Lecturer.php");
        exit();
    }

    if (isset($_FILES["Image"])) {
        $file_name = $_FILES["Image"]["name"];
        $file_tmp = $_FILES["Image"]["tmp_name"];
        move_uploaded_file($file_tmp, 'lecturer_image/' . $file_name);

        // Prepare an SQL statement for execution
        $stmt = $conn->prepare("INSERT INTO tbllecturer (LecturerName, Photo) VALUES (?, ?)");

        // Bind variables to the parameter markers of the prepared statement
        $stmt->bind_param("ss", $lecturerName, $file_name);

        // Execute the statement
        if ($stmt->execute()) {
            $_SESSION["status"] = "Lecturer has been added";
            $_SESSION["status_code"] = "success";
            header("location:LecturerInfo.php");
        } else {
            $_SESSION['status'] = "Unable to add lecturer";
            $_SESSION['status_code'] = "error";
            header("location:Lecturer.php");
        }

        // Close the statement
        $stmt->close();
    }
    $conn->close();
}
$id = $_GET["updateID"];
$select = mysqli_query($conn, "SELECT * FROM tbllecturer WHERE LecturerID = '$id'");
$row = mysqli_fetch_assoc($select);


function generateNumber($conn)
{
    do {
        $studentNumber = str_pad(mt_rand(0, 99999999), 8, '0', STR_PAD_LEFT);
        $sql = "SELECT * FROM tblstudent WHERE student_number = '$studentNumber'";
        $result = mysqli_query($conn, $sql);
    } while (mysqli_num_rows($result) > 0);
    return $studentNumber;
}

if (isset($_POST["update"])) {
    $id = $_POST["update_lecturerID"];
    $name = $_POST["update_lecturerName"];

    $image = $_FILES["update_image"]["name"];
    $img_tmp_name = $_FILES["update_image"]["tmp_name"];
    $image_folder = "lecturer_image/" . $image;

    $lecturer_number = generateNumber($conn);

    if (!empty($image)) {
        $update_query = mysqli_query($conn, "UPDATE tbllecturer SET LecturerName = '$name', lecturer_number = '$lecturer_number',  Photo = '$image' WHERE LecturerID = '$id'");
    } else {
        $update_query = mysqli_query($conn, "UPDATE tbllecturer SET LecturerName = '$name', lecturer_number = '$lecturer_number' WHERE LecturerID = '$id'");
    }

    if ($update_query) {
        if (!empty($image)) {
            move_uploaded_file($img_tmp_name, $image_folder);
        }
        $_SESSION["status"] = "Lecturer has been updated";
        $_SESSION["status_code"] = "success";
        header("location: LecturerInfo.php");
    } else {
        $_SESSION["status"] = "Unable to update";
        $_SESSION["status_code"] = "error";
        header("location: Lecturer.php");
    }
}
if (isset($_GET["deleteID"])) {
    $id = $_GET["deleteID"];
    $delete_query = mysqli_query($conn, "DELETE FROM tbllecturer WHERE LecturerID = '$id'");

    if ($delete_query) {
        $_SESSION["status"] = "Lecturer has been deleted";
        $_SESSION["status_code"] = "success";
        header("location: LecturerInfo.php");
    } else {
        $_SESSION["status"] = "Unable to delete";
        $_SESSION["status_code"] = "error";
        header("location: Lecturer.php");
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
                <li class="active">
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

                <li>
                    <a href="status.php">
                        <i class="fa-solid fa-book"></i>
                        <span>Status</span>
                    </a>
                </li>

                <li>
                    <a href="program.php">
                        <i class="fa-solid fa-computer"></i>
                        <span>Program</span>
                    </a>
                </li>
                <li>
                    <a href="test.php">
                        <i class="fa-solid fa-calendar-days"></i>
                        <span>Schedule</span>
                    </a>
                </li>

                <li>
                    <a href="attendance.php">
                        <i class="fa-solid fa-clipboard-user"></i>
                        <span>Attendance</span>
                    </a>
                </li>

                <li>
                    <a href="subject.php">
                        <i class="fa-solid fa-table"></i>
                        <span>Subject</span>
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
                    <a href="Shift/Shift.php">
                        <i class="fa-solid fa-clock"></i>
                        </i>
                        <span>Shift</span>
                    </a>
                </li>
                <li>
                    <a href="campus/campus.php">
                        <i class="fa-solid fa-school"></i>
                        </i>
                        <span>Campus</span>
                    </a>
                </li> -->

                <li>
                    <a href="batch.php">
                        <i class="fa-solid fa-list"></i>
                        </i>
                        <span>Batch</span>
                    </a>
                </li>

                <!-- <li>
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
                <img src="Dashboard/images/admin.jpg" alt="">
            </div>
        </div>
        <img src="lecturer_image/<?php echo $row["Photo"] ?>" name="old_image" width="100" alt="">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-lg-6">
                    <input class="form-control form-control mb-2 mt-4" type="hidden" name="update_lecturerID" value="<?php echo $row["LecturerID"] ?>">

                    <input class="form-control form-control mb-2 mt-4" type="text" name="update_lecturerName" value="<?php echo $row["LecturerName"] ?>">

                </div>
                <div class="col-lg-6">
                    <input type="file" class="form-control form-control mb-2 mt-4" name="update_image">
                </div>
            </div>
            <button type="submit" name="update" class="btn btn" style="background: rgb(113, 99, 186); color:#fff">Update</button>
            <a href="LecturerInfo.php" class="btn btn" style="background: rgb(225, 212, 95);  color:#fff;">Go Back</a>
        </form>

    </div>
</body>

</html>