<?php
session_name('admin_session');
session_start();
if (!isset($_SESSION["authenticated"]) || $_SESSION["authenticated"] !== true) {
    $_SESSION["status"] = "You are not authorized to see that page unless you are not log in";
    $_SESSION["status_code"] = "warning";
    header("location:index.php");
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

        <form action="attendanceInsert.php" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-lg-6">
                    <select name="statusID" class="form-select form-control mb-2 mt-4">
                        <option>Student stauts ID</option>

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
                    <input type="date" name="attenddateIssue" class="form-input form-control mb-2">

                    <select name="subjectID" class="form-select form-control mb-2">
                        <option>subject ID</option>

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

                    <select name="attend" class="form-select form-control mb-2">
                        <option>Status</option>
                        <option value="Presence">Attended</option>
                        <option value="Absent">Absent</option>
                        <option value="Permission">Permission</option>
                        <option value="Skipped">Skipped</option>
                    </select>
                </div>
                <div class="col-lg-6">
                    <input class="form-control form-control mt-4 mb-2" type="text" name="attenNote" placeholder="Attend note">

                    <select name="session" class="form-select form-control mb-2">
                        <option>Session</option>
                        <option value="1">1</option>
                        <option value="2">2</option>

                    </select>


                    <select name="lecturerID" class="form-select form-control mb-2">
                        <option>Lecturer ID</option>

                        <?php
                        include("conn.php");
                        $select = mysqli_query($conn, "SELECT * FROM tbllecturer");
                        if (mysqli_num_rows($select) > 0) {
                            while ($row = mysqli_fetch_assoc($select)) {
                        ?>
                                <option value="<?php echo $row["LecturerID"] ?>"><?php echo $row["LecturerID"] ?> <?php echo $row["LecturerName"] ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                    <label>&nbsp;Date issue</label>
                    <input class="form-control form-control  mb-2" type="date" name="dateIssue">

                </div>
            </div>
            <button type="submit" name="submit" class="btn btn" style="background: rgb(113, 99, 186); color:#fff">Submit</button>
            <a href="attendance.php" class="btn btn" style="background: rgb(225, 212, 95);  color:#fff;">Go Back</a>
        </form>

    </div>
</body>

</html>