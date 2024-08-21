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
    $statusID = $_POST["statusID"];
    $attendanceIssue = $_POST["attenddateIssue"];
    $subjectID = $_POST["subjectID"];
    $attend = $_POST["attend"];
    $attenNote = $_POST["attenNote"];
    $session = $_POST["session"];
    $lecturerID = $_POST["lecturerID"];
    $dateIssue = $_POST["dateIssue"];


    if (empty($statusID) || empty($attendanceIssue) || empty($subjectID) || empty($attend) || empty($session) || empty($lecturerID) || empty($dateIssue)) {
        $_SESSION["status"] = "Please fill all the requirements";
        $_SESSION["status_code"] = "warning";
        header("location:attendanceForm.php");
        exit();
    }

    $insert_query = mysqli_query($conn, "INSERT INTO tblattendance (StudentStatusID,AttendanceDateIssue,SubjectID,Attended,AttendNote,Section,LecturerID,DateIssue) VALUES ('$statusID', '$attendanceIssue', '$subjectID', '$attend', '$attenNote', '$session', '$lecturerID', '$dateIssue')");

    if ($insert_query) {
        $_SESSION["status"] = "Attendance has been recorded";
        $_SESSION["status_code"] = "success";
        header("location:attendance.php");
    } else {
        $_SESSION["status"] = "Unable to keep the record!";
        $_SESSION["status_code"] = "error";
        header("location:attendanceForm.php");
    }
}

$id = $_GET["updateID"];
$select = mysqli_query($conn, "SELECT tblattendance.AttendanceID,tblattendance.StudentStatusID,tblattendance.AttendanceDateIssue,tblsubject.SubjectEN,tblsubject.SubjectID,tblattendance.Attended,
tblattendance.AttendNote,tblattendance.Section,tbllecturer.LecturerID,tbllecturer.LecturerName,tblattendance.DateIssue FROM tblattendance left join tblsubject on tblattendance.SubjectID = tblsubject.SubjectID LEFT join tbllecturer on tblattendance.LecturerID = tbllecturer.LecturerID WHERE AttendanceID = '$id'");
$rows = mysqli_fetch_assoc($select);

if (isset($_POST["update"])) {
    $attendanceID = $_POST["update_attendancaID"];
    $statusID = $_POST["update_statusID"];
    $attendanceIssue = $_POST["update_attenddateIssue"];
    $subjectID = $_POST["update_subjectID"];
    $attend = $_POST["update_attend"];
    $note = $_POST["update_attenNote"];
    $session = $_POST["update_session"];
    $lecturerID = $_POST["update_lecturerID"];
    $dateIssue = $_POST["update_dateIssue"];

    $update_query = mysqli_query($conn, "UPDATE tblattendance SET StudentStatusID = '$statusID', AttendanceDateIssue = '$attendanceIssue', SubjectID = '$subjectID', Attended = '$attend', AttendNote = '$note', Section = '$session', LecturerID = '$lecturerID', DateIssue = '$dateIssue' WHERE AttendanceID = '$attendanceID'");

    if ($update_query) {
        $_SESSION["status"] = "Attendance has been updated";
        $_SESSION["status_code"] = "success";
        header("location:attendance.php");
    } else {
        $_SESSION["status"] = "Unable to update!";
        $_SESSION["status_code"] = "error";
        header("location:attendanceForm.php");
    }
}

if (isset($_GET["deleteID"])) {
    $id = $_GET["deleteID"];
    $delete_query = mysqli_query($conn, "DELETE FROM tblattendance WHERE AttendanceID = '$id'");

    if ($delete_query) {
        $_SESSION["status"] = "Attendance has been deleted";
        $_SESSION["status_code"] = "success";
        header("location:attendance.php");
    } else {
        $_SESSION["status"] = "Unable to delete!";
        $_SESSION["status_code"] = "error";
        header("location:attendance.php");
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
                    <a href="index.php">
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

                <li class="active">
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

                <li>
                    <a href="logout.php?role=admin">
                        <i class="fa-solid fa-right-to-bracket"></i>
                        </i>
                        <span>Logout</span>
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
            <div class="user--info">
                <div class="search--box">
                    <i class="fas solid fa-search"></i>
                    <input type="text" placeholder="Search">
                </div>
                <img src="Dashboard/images/admin.jpg" alt="">
            </div>
        </div>

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-lg-6">
                    <input type="hidden" name="update_attendancaID" value="<?php echo $rows["AttendanceID"] ?>" class="form-input form-control mb-2 mt-4">

                    <select name="update_statusID" class="form-select form-control mb-2 mt-4">
                        <option value="<?php echo $rows["StudentStatusID"] ?>"><?php echo $rows["StudentStatusID"] ?></option>

                        <?php
                        include("conn.php");
                        $select = mysqli_query($conn, "SELECT * FROM tblstudentstatus");
                        if (mysqli_num_rows($select) > 0) {
                            while ($row = mysqli_fetch_assoc($select)) {
                        ?>
                                <option value="<?php echo $row["StudentStatusID"] ?>"><?php echo $row["StudentStatusID"] ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>

                    <label>&nbsp;Attendance date issue</label>
                    <input type="date" name="update_attenddateIssue" class="form-input form-control mb-2" value="<?php echo $rows["AttendanceDateIssue"] ?>">

                    <select name="update_subjectID" class="form-select form-control mb-2">
                        <option value="<?php echo $rows["SubjectID"] ?>"><?php echo $rows["SubjectEN"] ?></option>

                        <?php
                        include("conn.php");
                        $select = mysqli_query($conn, "SELECT * FROM tblsubject");
                        if (mysqli_num_rows($select) > 0) {
                            while ($row = mysqli_fetch_assoc($select)) {
                        ?>
                                <option value="<?php echo $row["SubjectID"] ?>"><?php echo $row["SubjectID"] ?> <?php echo $row["SubjectEN"] ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>

                    <select name="update_attend" class="form-select form-control mb-2">
                        <option value="<?php echo $rows["Attended"] ?>"><?php echo $rows["Attended"] ?></option>
                        <option value="Presence">Attended</option>
                        <option value="Absent">Absent</option>
                        <option value="Permission">Permission</option>
                        <option value="Skipped">Skipped</option>
                    </select>
                </div>
                <div class="col-lg-6">
                    <input class="form-control form-control mt-4 mb-2" type="text" name="update_attenNote" value="<?php if ($rows["AttendNote"] != null) {
                                                                                                                        echo $rows["AttendNote"];
                                                                                                                    } else {
                                                                                                                        echo 'Unavailable';
                                                                                                                    } ?>">


                    <select name="update_session" class="form-select form-control mb-2">
                        <option value="<?php echo $rows["Section"] ?>"><?php echo $rows["Section"] ?></option>
                        <option value="1">1</option>
                        <option value="2">2</option>

                    </select>


                    <select name="update_lecturerID" class="form-select form-control mb-2">
                        <option value="<?php echo $rows["LecturerID"] ?>"><?php echo $rows["LecturerName"] ?></option>

                        <?php
                        include("conn.php");
                        $select = mysqli_query($conn, "SELECT * FROM tbllecturer");
                        if (mysqli_num_rows($select) > 0) {
                            while ($row = mysqli_fetch_assoc($select)) {
                        ?>
                                <option value=" <?php echo $row["LecturerID"] ?>"><?php echo $row["LecturerID"] ?> <?php echo $row["LecturerName"] ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                    <label>&nbsp;Date issue</label>
                    <input class="form-control form-control  mb-2" type="date" name="update_dateIssue" value="<?php echo $rows["DateIssue"] ?>">

                </div>
            </div>
            <button type="submit" name="update" class="btn btn" style="background: rgb(113, 99, 186); color:#fff">Update</button>
            <a href="attendance.php" class="btn btn" style="background: rgb(225, 212, 95);  color:#fff;">Go Back</a>
        </form>

    </div>
</body>

</html>