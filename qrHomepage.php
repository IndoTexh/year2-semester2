<?php
session_start();
if (!isset($_SESSION["authenticated"]) || $_SESSION["authenticated"] !== true) {
    $_SESSION["status"] = "You are not authorized to see that page unless you are not log in";
    $_SESSION["status_code"] = "warning";
    header("location:loginQrcode.php");
    exit();
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
                <li class="active">
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
                    <a href="logout.php">
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

    <?php
    if (isset($_SESSION["status"]) && $_SESSION["status"] != "") {
    ?>
        <script>
            swal({
                title: '<?php echo $_SESSION["status"] ?>',
                icon: '<?php echo $_SESSION["status_code"] ?>',
                button: 'okay!',
            })
        </script>
    <?php

        unset($_SESSION["status"]);
    }
    ?>


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

        <div class="card-container">
            <h3 class="main--title">University's Data</h3>
            <div class="card--wrapper">
                <div class="payment--card">
                    <div class="card--header">
                        <div class="amount">
                            <span class="title">
                                Faculties
                            </span>
                            <span class="amount-value">
                                <?php
                                include("conn.php");
                                $sql = "SELECT COUNT(*) AS count FROM tblfaculty";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    // Output the count
                                    $row = $result->fetch_assoc();
                                    echo $row['count'];
                                } else {
                                    echo "0 results";
                                }
                                ?>
                            </span>
                        </div>
                        <i class="fa-solid fa-school icon"></i>
                    </div>
                </div>

                <div class="payment--card light-purple">
                    <div class="card--header">
                        <div class="amount">
                            <span class="title">
                                Majors
                            </span>
                            <span class="amount-value">
                                <?php
                                include("conn.php");
                                $sql = "SELECT COUNT(*) AS count FROM tblmajor";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                                    echo $row["count"];
                                } else {
                                    echo "0";
                                }
                                ?>
                            </span>
                        </div>
                        <i class="fa-solid fa-book icon dark-purple"></i>
                    </div>
                </div>

                <div class="payment--card light-green">
                    <div class="card--header">
                        <div class="amount">
                            <span class="title">
                                Lecturers
                            </span>
                            <span class="amount-value">
                                <?php
                                include("conn.php");
                                $sql = "SELECT COUNT(*) AS count FROM tbllecturer";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                                    echo $row["count"];
                                } else {
                                    echo "0";
                                }
                                ?>
                            </span>
                        </div>
                        <i class="fa-solid fa-person-chalkboard icon dark-green"></i>
                    </div>
                </div>


                <div class="payment--card light-blue">
                    <div class="card--header">
                        <div class="amount">
                            <span class="title">
                                Students
                            </span>
                            <span class="amount-value">
                                <?php
                                include("conn.php");
                                $sql = "SELECT COUNT(*) AS count FROM tblstudent";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                                    echo $row["count"];
                                } else {
                                    echo "0";
                                }
                                ?>
                            </span>
                        </div>
                        <i class="fa-solid fa-graduation-cap icon dark-blue"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>

</html>