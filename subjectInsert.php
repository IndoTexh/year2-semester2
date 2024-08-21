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
    $subjectKH = $_POST["subjectKH"];
    $subjectEN = $_POST["subjectEN"];
    $credit = $_POST["credit"];
    $hour = $_POST["hour"];
    $faculty = $_POST["faculty"];
    $major = $_POST["major"];
    $year = $_POST["year"];
    $semester = $_POST["semester"];

    if (empty($subjectKH) || empty($subjectEN) || empty($credit) || empty($hour) || empty($faculty) || empty($major) || empty($year) || empty($semester)) {
        $_SESSION["status"] = "Please fill all the requirements";
        $_SESSION["status_code"] = "warning";
        header("location:subjectForm.php");
        exit();
    }

    $insert_query = mysqli_query($conn, "INSERT INTO tblsubject (SubjectKH,SubjectEN,Credit,Hour,FacultyID,MajorID,Semester,Year) VALUES ('$subjectKH', '$subjectEN', '$credit', '$hour', '$faculty', '$major', '$semester', '$year')");
    if ($insert_query) {
        $_SESSION["status"] = "Subject has been added";
        $_SESSION["status_code"] = "success";
        header("location:subject.php");
    } else {
        $_SESSION["status"] = "Unable to add!";
        $_SESSION["status_code"] = "error";
        header("location:subjectForm.php");
    }
}

$id = $_GET["updateID"];
$select = mysqli_query($conn, "SELECT tblsubject.SubjectID,tblsubject.SubjectKH,tblsubject.SubjectEN,tblsubject.Credit,tblsubject.Hour,tblfaculty.FacultyID,tblfaculty.FacultyEN,tblmajor.MajorID,tblmajor.MajorEN,tblsubject.Semester,tblsubject.Year From tblsubject LEFT join tblfaculty on tblsubject.FacultyID = tblfaculty.FacultyID LEFT join tblmajor on tblsubject.MajorID = tblmajor.MajorID WHERE SubjectID = '$id'");
$rows = mysqli_fetch_assoc($select);

if (isset($_POST["update"])) {
    $subjectID = $_POST["update_subjectID"];
    $subjectKH = $_POST["update_subjectKH"];
    $subjectEN = $_POST["update_subjectEN"];
    $credit = $_POST["update_credit"];
    $hour = $_POST["update_hour"];
    $faculty = $_POST["update_faculty"];
    $major = $_POST["update_major"];
    $year = $_POST["update_year"];
    $semester = $_POST["update_semester"];

    $update_query = mysqli_query($conn, "UPDATE tblsubject SET SubjectKH = '$subjectKH', SubjectEN = '$subjectEN', Credit = '$credit', Hour = '$hour', FacultyID = '$faculty', MajorID = '$major',Semester = '$semester', Year = '$year' WHERE SubjectID = '$subjectID'");

    if ($update_query) {
        $_SESSION["status"] = "Subject has been updated";
        $_SESSION["status_code"] = "success";
        header("location:subject.php");
    } else {
        $_SESSION["status"] = "Unable to update!";
        $_SESSION["status_code"] = "error";
        header("location:subjectForm.php");
    }
}

if (isset($_GET["deleteID"])) {
    $id = $_GET["deleteID"];
    $delete_query = mysqli_query($conn, "DELETE FROM tblsubject WHERE SubjectID = '$id'");
    if ($delete_query) {
        $_SESSION["status"] = "Subject has been deleted";
        $_SESSION["status_code"] = "success";
        header("location:subject.php");
    } else {
        $_SESSION["status"] = "Unable to delete!";
        $_SESSION["status_code"] = "error";
        header("location:subject.php");
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

                <li class="active">
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

        <form action="" method="POST" class="form-copy">
            <div class="row">
                <div class="col-lg-6">

                    <input type="hidden" placeholder="ឈ្មោះមុខវិជ្ជា" name="update_subjectID" class="form-control form-control mb-2 mt-4" autocomplete="off" value="<?php echo $rows["SubjectID"] ?>" />

                    <input type="text" placeholder="ឈ្មោះមុខវិជ្ជា" name="update_subjectKH" class="form-control form-control mb-2 mt-4" autocomplete="off" value="<?php echo $rows["SubjectKH"] ?>" />

                    <input type="text" placeholder="Subject's name" name="update_subjectEN" class="form-control form-control mb-2 mt-4" autocomplete="off" value="<?php echo $rows["SubjectEN"] ?>" />

                    <input type="text" placeholder="Credit" name="update_credit" class="form-control form-control mb-2 mt-4" autocomplete="off" value="<?php echo $rows["Credit"] ?>" />

                    <input type="text" placeholder="Amount of hours" name="update_hour" class="form-control form-control mb-2 mt-4" autocomplete="off" value="<?php echo $rows["Hour"] ?>" />
                </div>

                <div class="col-lg-6">
                    <select class="form-control form-control mb-2 mt-4" id="faculty" name="update_faculty">
                        <option value="<?php echo $rows["FacultyID"] ?>"><?php echo $rows["FacultyEN"] ?></option>
                        <?php
                        include("conn.php");

                        $faculties = "SELECT * FROM tblfaculty";
                        $faculties_query = mysqli_query($conn, $faculties);

                        while ($row = mysqli_fetch_assoc($faculties_query)) : ?>

                            <option value="<?php echo $row['FacultyID'] ?>"><?php echo $row['FacultyID'] ?> &nbsp; <?php echo $row['FacultyEN']; ?></option>
                        <?php endwhile; ?>
                    </select>

                    <select class="form-control form-control mb-2 mt-4" id="major" name="update_major">
                        <option value="<?php echo $rows["MajorID"] ?>"><?php echo $rows["MajorEN"] ?></option>
                    </select>

                    <select class="form-control form-control mb-2 mt-4" id="year" name="update_year">
                        <option value="<?php echo $rows["Year"] ?>"><?php echo $rows["Year"] ?></option>
                        <?php
                        include("conn.php");

                        $faculties = "SELECT * FROM tblyear";
                        $faculties_query = mysqli_query($conn, $faculties);

                        while ($row = mysqli_fetch_assoc($faculties_query)) : ?>

                            <option value="<?php echo $row['YearEN'] ?>"> <?php echo $row['YearEN']; ?></option>

                        <?php endwhile; ?>
                    </select>


                    <select class="form-control form-control mb-2 mt-4" id="semester" name="update_semester">
                        <option value="<?php echo $rows["Semester"] ?>"><?php echo $rows["Semester"] ?></option>

                        <?php
                        include("conn.php");

                        $faculties = "SELECT * FROM tblsemester";
                        $faculties_query = mysqli_query($conn, $faculties);

                        while ($row = mysqli_fetch_assoc($faculties_query)) : ?>

                            <option value="<?php echo $row['SemesterID'] ?>"> <?php echo $row['SemesterEN']; ?></option>

                        <?php endwhile; ?>
                    </select>
                </div>
            </div>
            <button type="submit" name="update" class="btn btn" style="background: rgb(113, 99, 186); color:#fff">Update</button>
            <a href="subject.php" class="btn btn" style="background: rgb(225, 212, 95);  color:#fff;">Go Back</a>
        </form>
    </div>
</body>

</html>