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

        <form action="subjectInsert.php" method="POST" class="form-copy">
            <div class="row">
                <div class="col-lg-6">
                    <input type="text" placeholder="ឈ្មោះមុខវិជ្ជា" name="subjectKH" class="form-control form-control mb-2 mt-4" autocomplete="off" />

                    <input type="text" placeholder="Subject's name" name="subjectEN" class="form-control form-control mb-2 mt-4" autocomplete="off" />

                    <input type="text" placeholder="Credit" name="credit" class="form-control form-control mb-2 mt-4" autocomplete="off" />

                    <input type="text" placeholder="Amount of hours" name="hour" class="form-control form-control mb-2 mt-4" autocomplete="off" />
                </div>

                <div class="col-lg-6">
                    <select class="form-control form-control mb-2 mt-4" id="faculty" name="faculty">
                        <option selected disabled>Select faculty</option>
                        <?php
                        include("conn.php");

                        $faculties = "SELECT * FROM tblfaculty";
                        $faculties_query = mysqli_query($conn, $faculties);

                        while ($row = mysqli_fetch_assoc($faculties_query)) : ?>

                            <option value="<?php echo $row['FacultyID'] ?>"><?php echo $row['FacultyID'] ?> &nbsp; <?php echo $row['FacultyEN']; ?></option>
                        <?php endwhile; ?>
                    </select>

                    <select class="form-control form-control mb-2 mt-4" id="major" name="major">
                        <option selected disabled>Select major</option>
                    </select>

                    <select class="form-control form-control mb-2 mt-4" id="year" name="year">
                        <option selected disabled>Select academic year</option>
                        <?php
                        include("conn.php");

                        $faculties = "SELECT * FROM tblyear";
                        $faculties_query = mysqli_query($conn, $faculties);

                        while ($row = mysqli_fetch_assoc($faculties_query)) : ?>

                            <option value="<?php echo $row['YearEN'] ?>"> <?php echo $row['YearEN']; ?></option>

                        <?php endwhile; ?>
                    </select>


                    <select class="form-control form-control mb-2 mt-4" id="semester" name="semester">
                        <option selected disabled>Select semester</option>

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
            <button type="submit" name="submit" class="btn btn" style="background: rgb(113, 99, 186); color:#fff">Submit</button>
            <a href="subject.php" class="btn btn" style="background: rgb(225, 212, 95);  color:#fff;">Go Back</a>
        </form>
    </div>


    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#faculty').on('change', function() {
                var faculty_id = $(this).val();
                $.ajax({
                    url: 'subjectResponse.php',
                    type: 'POST',
                    data: {
                        faculty_data: faculty_id
                    },
                    success: function(result) {
                        $('#major').html(result);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText); // Log any errors to the console
                    }
                });
            });
        });
    </script>
</body>

</html>