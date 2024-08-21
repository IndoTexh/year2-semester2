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

        <form action="programInsert.php" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-lg-6">

                    <select class="form-control form-control mt-3" name="year">
                        <option>Select year</option>
                        <?php
                        include("../conn.php");
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

                    <select class="form-control form-control mt-3" name="semester">
                        <option>Select semester</option>
                        <?php
                        include("../conn.php");
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

                    <select class="form-control form-control mt-3" name="shift">
                        <option>Select shift</option>
                        <?php
                        include("../conn.php");
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

                    <select class="form-control form-control mb-2 mt-3" name="degree">
                        <option>Select degree</option>
                        <?php
                        include("../conn.php");
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

                    <select class="form-control form-control mb-2 mt-3" name="academic">
                        <option>Select academic year</option>
                        <?php
                        include("../conn.php");
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

                    <select class="form-control form-control mb-2 mt-3" name="major">
                        <option>Select major</option>
                        <?php
                        include("../conn.php");
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
                    <select class="form-control form-control mb-2 mt-3" name="batch">
                        <option>Select batch</option>
                        <?php
                        include("../conn.php");
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

                    <select class="form-control form-control mb-2 mt-3" name="campus">
                        <option>Select campus</option>
                        <?php
                        include("../conn.php");
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
                    <input type="date" name="startDate" class="form-control form-control mb-2">
                    <label>End date</label>
                    <input type="date" name="endDate" class="form-control form-control mb-2">
                    <label class="mb-1">Date issued</label>
                    <input type="date" name="Dateissue" class="form-control form-control mb-2">
                </div>
            </div>
            <button type="submit" name="submit" class="btn btn" style="background: rgb(113, 99, 186); color:#fff">Submit</button>
            <a href="program.php" class="btn btn" style="background: rgb(225, 212, 95);  color:#fff;">Go Back</a>
        </form>

    </div>
</body>

</html>