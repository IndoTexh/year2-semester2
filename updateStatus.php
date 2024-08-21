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
        <!--    <form action="" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-lg-6">
                    <input type="hidden" name="update_statusID" value="<?php echo $rows["StudentStatusID"] ?>">

                    <label>Student ID</label>
                    <input class="form-control form-control mb-2" type="text" name="update_studentID" value="<?php echo $rows["StudentID"] ?>">

                    <input class="form-control form-control mb-2 mt-4" type="text" placeholder="Program ID" name="programID" autocomplete="off">
        <label class="mt-2">Program ID</label>
        <select name="update_programID" class="form-control form-control mb-2">
            <option value="<?php echo $rows["ProgramID"] ?>"><?php echo $rows["ProgramID"] ?></option>

            <?php
            include("conn.php");
            $select = mysqli_query($conn, "SELECT * FROM tblprogram");
            if (mysqli_num_rows($select) > 0) {
                while ($row = mysqli_fetch_assoc($select)) {
            ?>
                    <option value="<?php echo $row["ProgramID"] ?>"><?php echo $row["ProgramID"] ?></option>
            <?php
                }
            }
            ?>
        </select>

        <select name="update_assigned" class="form-select form-control mb-2 mt-4">
            <option value="Assign">Assign</option>
            <option value="Unassign">Unassign</option>
        </select>

    </div>
    <div class="col-lg-6">
        <label>Note</label>
        <input type="text" class="form-control form-control" name="update_note" value="<?php echo $rows["Note"] ?>">

        <label class="mt-2 mb-2">Assigned Date</label>
        <input class="form-control form-control mb-2" type="date" name="update_assignedDate" value="<?php echo $rows["AssignDate"] ?>">
    </div>
    </div>
    <button type="submit" name="update" class="btn btn" style="background: rgb(113, 99, 186); color:#fff">update</button>
    <a href="status.php" class="btn btn" style="background: rgb(225, 212, 95);  color:#fff;">Go Back</a>
    </form> -->

    </div>
</body>

</html>