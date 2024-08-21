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

$id = $_GET["viewID"];
$select = mysqli_query($conn, "SELECT 
tblschedule.ScheduleID,
tblsubject.SubjectID,
tblsubject.SubjectEN,
tbllecturer.LecturerID,
tbllecturer.Photo,
tbllecturer.LecturerName,
tbldayweek.DayWeekID,
tbldayweek.DayWeekName,
tbltime.TimeID,
tbltime.TimeName,
tblroom.RoomID,
tblroom.RoomName,
tblacademicyear.AcademicYearID,
tblacademicyear.AcademicYear,
tblschedule.DateStart,
tblschedule.DateEnd,
tblschedule.ScheduleDate,
tblschedule.days,
tbldays.DayID,
tbldays.DayName,
tblschedule.TimeID
FROM tblschedule 
left JOIN tblsubject ON tblschedule.SubjectID = tblsubject.SubjectEN 
left JOIN tbllecturer ON tblschedule.LecturerID = tbllecturer.LecturerName
left JOIN tbldayweek ON tblschedule.DayWeekID = tbldayweek.DayWeekID 
left JOIN tbltime ON tblschedule.TimeID = tbltime.TimeID 
left JOIN tblroom ON tblschedule.RoomID = tblroom.RoomID 
left JOIN tblacademicyear ON tblschedule.AcademicProgramID = tblacademicyear.AcademicYearID 
left JOIN tbldays ON tblschedule.days = tbldays.DayID WHERE ScheduleID = '$id'");

$row = mysqli_fetch_assoc($select);
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
    <link rel="stylesheet" href="schedule.css">
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
                <li class="active">
                    <a href="schedule.php">
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
            <div class="user--info">
                <div class="search--box">
                    <i class="fas solid fa-search"></i>
                    <input type="text" placeholder="Search">
                </div>
                <img src="Dashboard/images/admin.jpg" alt="">
            </div>
        </div>

        <div class="idance">
            <div class="schedule content-block">
                <div class="container">

                    <div class="timetable">

                        <nav class="nav nav-tabs">
                            <a class="nav-link <?php echo $row["days"] ?>"><?php echo $row["days"] ?></a>
                        </nav>

                        <div class="tab-content">
                            <div class="tab-pane show active">
                                <div class="row">

                                    <!-- Schedule Item 1 -->
                                    <div class="col-md-6">
                                        <div class="timetable-item">
                                            <div class="timetable-item-img">
                                                <img src="lecturer_image/<?php echo $row["Photo"] ?>">
                                            </div>
                                            <div class="timetable-item-main">

                                                <div class="timetable-item-time">Schedule ID: <?php echo $row["ScheduleID"] ?></div>

                                                <div class="timetable-item-time">Teach by: <?php echo $row["LecturerName"] ?></div>
                                                <div class="timetable-item-time">Subject: <?php echo $row["SubjectEN"] ?></div>
                                                <div class="timetable-item-time">Class start: <?php echo $row["TimeID"] ?></div>

                                                <div class="timetable-item-time">Schedule Period: <?php echo $row["DayWeekName"] ?></div>

                                                <div class="timetable-item-time">Room: <?php echo $row["RoomName"] ?></div>

                                                <div class="timetable-item-time">Academic Year: <?php echo $row["AcademicYear"] ?></div>

                                                <div class="timetable-item-time">Date Start: <?php echo $row["DateStart"] ?></div>

                                                <div class="timetable-item-time">Date End: <?php echo $row["DateEnd"] ?></div>

                                                <div class="timetable-item-time">Schedule Date: <?php echo $row["ScheduleDate"] ?></div>
                                                <a href="test.php" class="btn btn-primary btn-book">Go Back</a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>

</html>