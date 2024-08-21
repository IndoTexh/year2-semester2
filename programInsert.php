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
    $year = $_POST["year"];
    $semester = $_POST["semester"];
    $shift = $_POST["shift"];
    $degree = $_POST["degree"];
    $academic = $_POST["academic"];
    $major = $_POST["major"];
    $batch = $_POST["batch"];
    $campus = $_POST["campus"];
    $startDate = $_POST["startDate"];
    $endDate = $_POST["endDate"];
    $Dateissue = $_POST["Dateissue"];

    if (empty($year) || empty($semester) || empty($shift) || empty($degree) || empty($academic) || empty($major) || empty($batch) || empty($campus) || empty($startDate) || empty($endDate) || empty($Dateissue)) {
        $_SESSION["status"] = "Please fill all the requirements";
        $_SESSION["status_code"] = "warning";
        header("location:programForm.php");
        exit();
    }

    $insert_query = mysqli_query($conn, "INSERT INTO tblprogram (YearID, SemesterID, ShiftID, DegreeID, AcademicYearID, MajorID, BatchID, CampusID, StartDate, EndDate, DateIssue) VALUES ('$year', '$semester', '$shift', '$degree', '$academic', '$major', '$batch', '$campus', '$startDate', '$endDate', '$Dateissue')");

    if ($insert_query) {
        $_SESSION["status"] = "Program has been added";
        $_SESSION["status_code"] = "success";
        header("location:program.php");
    } else {
        $_SESSION["status"] = "Program has been added";
        $_SESSION["status_code"] = "success";
        header("location:programForm.php");
    }
}

$id = $_GET["updateID"];
$select = mysqli_query($conn, "SELECT tblprogram.ProgramID,tblyear.YearEN, tblyear.YearID, tblsemester.SemesterEN, tblsemester.SemesterID,tblshift.ShiftEN, tblshift.ShiftID,tbldegree.DegreeEN,tbldegree.DegreeID,tblacademicyear.AcademicYear, tblacademicyear.AcademicYearID,tblmajor.MajorEN, tblmajor.MajorID,tblbatch.BatchEN,tblbatch.BatchID,tblcampus.CampusEN,tblcampus.CampusID,tblprogram.StartDate,tblprogram.EndDate,tblprogram.DateIssue FROM tblprogram inner join tblyear on tblprogram.YearID = tblyear.YearID inner join tblsemester on tblprogram.SemesterID = tblsemester.SemesterID inner join tblshift on tblprogram.ShiftID = tblshift.ShiftID inner join tbldegree on tblprogram.DegreeID = tbldegree.DegreeID inner join tblacademicyear on tblprogram.AcademicYearID = tblacademicyear.AcademicYearID inner join tblmajor on tblprogram.MajorID = tblmajor.MajorID inner join tblbatch on tblprogram.BatchID = tblbatch.BatchID inner join tblcampus on tblprogram.CampusID = tblcampus.CampusID where tblprogram.ProgramID = '$id'");
$rows = mysqli_fetch_assoc($select);

if (isset($_POST["update"])) {
    $id = $_POST["update_programID"];
    $year = $_POST["update_year"];
    $semester = $_POST["update_semester"];
    $shift = $_POST["update_shift"];
    $degree = $_POST["update_degree"];
    $academic = $_POST["update_academic"];
    $major = $_POST["update_major"];
    $batch = $_POST["update_batch"];
    $campus = $_POST["update_campus"];
    $startDate = $_POST["update_startDate"];
    $endDate = $_POST["update_endDate"];
    $Dateissue = $_POST["update_Dateissue"];

    $update_query = mysqli_query($conn, "UPDATE tblprogram SET YearID = '$year', SemesterID = '$semester', ShiftID = '$shift', DegreeID = '$degree', AcademicYearID = '$academic', MajorID = '$major', BatchID = '$batch', CampusID = '$campus', StartDate = '$startDate', EndDate = '$endDate', DateIssue = '$Dateissue' WHERE ProgramID = '$id'");

    if ($update_query) {
        $_SESSION["status"] = "Program has been updated";
        $_SESSION["status_code"] = "success";
        header("location:program.php");
    } else {
        $_SESSION["status"] = "Unable to update";
        $_SESSION["status_code"] = "error";
        header("location:program.php");
    }
}

if (isset($_GET["ProgramID"])) {
    $id = $_GET["ProgramID"];
    $delete_query = mysqli_query($conn, "DELETE FROM tblprogram WHERE ProgramID = '$id'");

    if ($delete_query) {
        $_SESSION["status"] = "Program has been deleted";
        $_SESSION["status_code"] = "success";
        header("location:program.php");
    } else {
        $_SESSION["status"] = "Unable to delete";
        $_SESSION["status_code"] = "error";
        header("location:program.php");
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

                <li>
                    <a href="status.php">
                        <i class="fa-solid fa-book"></i>
                        <span>Status</span>
                    </a>
                </li>

                <li class="active">
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
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-lg-6">

                    <input type="hidden" class="form-control form-control mt-3" value="<?php echo $rows["ProgramID"] ?>" name="update_programID">
                    <select class="form-control form-control mt-3" name="update_year">
                        <option value="<?php echo $rows["YearID"] ?>"><?php echo $rows["YearEN"] ?></option>
                        <?php
                        include("conn.php");
                        $select = mysqli_query($conn, "SELECT * FROM tblyear");
                        if (mysqli_num_rows($select) > 0) {
                            while ($row = mysqli_fetch_assoc($select)) {
                        ?>
                                <option value="<?php echo $row["YearID"] ?>"><?php echo $row["YearEN"] ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>

                    <select class="form-control form-control mt-3" name="update_semester">
                        <option value="<?php echo $rows["SemesterID"] ?>"><?php echo $rows["SemesterEN"] ?></option>
                        <?php
                        include("conn.php");
                        $select = mysqli_query($conn, "SELECT * FROM tblsemester");
                        if (mysqli_num_rows($select) > 0) {
                            while ($row = mysqli_fetch_assoc($select)) {
                        ?>
                                <option value="<?php echo $row["SemesterID"] ?>"><?php echo $row["SemesterEN"] ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>

                    <select class="form-control form-control mt-3" name="update_shift">
                        <option value="<?php echo $rows["ShiftID"] ?>"><?php echo $rows["ShiftEN"] ?></option>
                        <?php
                        include("conn.php");
                        $select = mysqli_query($conn, "SELECT * FROM tblshift");
                        if (mysqli_num_rows($select) > 0) {
                            while ($row = mysqli_fetch_assoc($select)) {
                        ?>
                                <option value="<?php echo $row["ShiftID"] ?>"><?php echo $row["ShiftEN"] ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>

                    <select class="form-control form-control mb-2 mt-3" name="update_degree">
                        <option value="<?php echo $rows["DegreeID"] ?>"><?php echo $rows["DegreeEN"] ?></option>
                        <?php
                        include("conn.php");
                        $select = mysqli_query($conn, "SELECT * FROM tbldegree");
                        if (mysqli_num_rows($select) > 0) {
                            while ($row = mysqli_fetch_assoc($select)) {
                        ?>
                                <option value="<?php echo $row["DegreeID"] ?>"><?php echo $row["DegreeEN"] ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>

                    <select class="form-control form-control mb-2 mt-3" name="update_academic">
                        <option value="<?php echo $rows["AcademicYearID"] ?>"><?php echo $rows["AcademicYear"] ?></option>
                        <?php
                        include("conn.php");
                        $select = mysqli_query($conn, "SELECT * FROM tblacademicyear");
                        if (mysqli_num_rows($select) > 0) {
                            while ($row = mysqli_fetch_assoc($select)) {
                        ?>
                                <option value="<?php echo $row["AcademicYearID"] ?>"><?php echo $row["AcademicYear"] ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>

                    <select class="form-control form-control mb-2 mt-3" name="update_major">
                        <option value="<?php echo $rows["MajorID"] ?>"><?php echo $rows["MajorEN"] ?></option>
                        <?php
                        include("conn.php");
                        $select = mysqli_query($conn, "SELECT * FROM tblmajor");
                        if (mysqli_num_rows($select) > 0) {
                            while ($row = mysqli_fetch_assoc($select)) {
                        ?>
                                <option value="<?php echo $row["MajorID"] ?>"><?php echo $row["MajorEN"] ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>

                </div>
                <div class="col-lg-6">
                    <select class="form-control form-control mb-2 mt-3" name="update_batch">
                        <option value="<?php echo $rows["BatchID"] ?>"><?php echo $rows["BatchEN"] ?></option>
                        <?php
                        include("conn.php");
                        $select = mysqli_query($conn, "SELECT * FROM tblbatch");
                        if (mysqli_num_rows($select) > 0) {
                            while ($row = mysqli_fetch_assoc($select)) {
                        ?>
                                <option value="<?php echo $row["BatchID"] ?>"><?php echo $row["BatchEN"] ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>

                    <select class="form-control form-control mb-2 mt-3" name="update_campus">
                        <option value="<?php echo $rows["CampusID"] ?>"><?php echo $rows["CampusEN"] ?></option>
                        <?php
                        include("conn.php");
                        $select = mysqli_query($conn, "SELECT * FROM tblcampus");
                        if (mysqli_num_rows($select) > 0) {
                            while ($row = mysqli_fetch_assoc($select)) {
                        ?>
                                <option value="<?php echo $row["CampusID"] ?>"><?php echo $row["CampusEN"] ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                    <label>Start date</label>
                    <input type="date" name="update_startDate" class="form-control form-control mb-2" value="<?php echo $rows["StartDate"] ?>">
                    <label>End date</label>
                    <input type="date" name="update_endDate" class="form-control form-control mb-2" value="<?php echo $rows["EndDate"] ?>">
                    <label class="mb-1">Date issued</label>
                    <input type="date" name="update_Dateissue" class="form-control form-control mb-2" value="<?php echo $rows["DateIssue"] ?>">
                </div>
            </div>
            <button type="submit" name="update" class="btn btn" style="background: rgb(113, 99, 186); color:#fff">Update</button>
            <a href="program.php" class="btn btn" style="background: rgb(225, 212, 95);  color:#fff;">Go Back</a>
        </form>

    </div>
</body>

</html>