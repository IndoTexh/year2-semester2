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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
                <span>Program</span>
                <h2>Table</h2>
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
        <a href="programForm.php" class="btn btn added" style="background: rgb(113, 99, 186); color:#fff">Add Program</a>

        <div class="tabular--wrapper">
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Year</th>
                            <th>Semester</th>
                            <th>Shift</th>
                            <th>Degree</th>
                            <th>Academic Year</th>
                            <th>Major</th>
                            <th>Batch</th>
                            <th>Campus</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Date IssuedS</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $select = mysqli_query($conn, "SELECT tblprogram.ProgramID,tblyear.YearEN,tblsemester.SemesterEN,tblshift.ShiftEN,tbldegree.DegreeEN,tblacademicyear.AcademicYear,tblmajor.MajorEN,tblbatch.BatchEN,tblcampus.CampusEN,tblprogram.StartDate,tblprogram.EndDate,tblprogram.DateIssue FROM tblprogram inner join tblyear on tblprogram.YearID = tblyear.YearID inner join tblsemester on tblprogram.SemesterID = tblsemester.SemesterID inner join tblshift on tblprogram.ShiftID = tblshift.ShiftID inner join tbldegree on tblprogram.DegreeID = tbldegree.DegreeID inner join tblacademicyear on tblprogram.AcademicYearID = tblacademicyear.AcademicYearID inner join tblmajor on tblprogram.MajorID = tblmajor.MajorID inner join tblbatch on tblprogram.BatchID = tblbatch.BatchID inner join tblcampus on tblprogram.CampusID = tblcampus.CampusID order by tblprogram.ProgramID ASC;");
                        if (mysqli_num_rows($select) > 0) {
                            while ($row = mysqli_fetch_assoc($select)) {
                        ?>
                                <tr>
                                    <td><?php echo $row["ProgramID"] ?></td>
                                    <td><?php echo $row["YearEN"] ?></td>
                                    <td><?php echo $row["SemesterEN"] ?></td>
                                    <td><?php echo $row["ShiftEN"] ?></td>
                                    <td><?php echo $row["DegreeEN"] ?></td>
                                    <td><?php echo $row["AcademicYear"] ?></td>
                                    <td><?php echo $row["MajorEN"] ?></td>
                                    <td><?php echo $row["BatchEN"] ?></td>
                                    <td><?php echo $row["CampusEN"] ?></td>
                                    <td><?php echo $row["StartDate"] ?></td>
                                    <td><?php echo $row["EndDate"] ?></td>
                                    <td><?php echo $row["DateIssue"] ?></td>
                                    <td>

                                        <div class="dropdown">
                                            <a class="btn btn dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="background: rgb(113, 99, 186); color:#fff">

                                            </a>

                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item" href="programInsert.php?updateID=<?php echo $row["ProgramID"] ?>">
                                                        <i class="fas fa-edit"></i> Edit

                                                    </a>
                                                </li>
                                                <li><a onclick="javascript:return confirm('Are you sure want to delete this record?');" class="dropdown-item" href="programInsert.php?deleteID=<?php echo $row["ProgramID"] ?>"><i class="fas fa-trash"></i> Delete</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                        <?php
                            }
                        }
                        ?>


                </table>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>