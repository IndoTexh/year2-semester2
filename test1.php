<?php
include("conn.php");
session_name('admin_session');
session_start();
if (!isset($_SESSION["authenticated"]) || $_SESSION["authenticated"] !== true) {
    $_SESSION["status"] = "You are not authorized to see that page unless you are not log in";
    $_SESSION["status_code"] = "warning";
    header("location:formAuthorizeTeacher.php");
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
    <link rel="stylesheet" href="test.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="schedule.css">
</head>

<body>
    <div class="sidebar">
        <div class="logo">
            <ul class="menu">
                <li>
                    <a href="teacherAuthorize.php">
                        <i class="fas fa-home">
                        </i>
                        <span>Homepage</span>
                    </a>
                </li>

                <!--    <li class="active">
                    <a href="test1.php">
                        <i class="fa-solid fa-calendar-days"></i>
                        <span>Schedule</span>
                    </a>
                </li> -->

                <li>
                    <a href="attendance.php">
                        <i class="fa-solid fa-clipboard-user"></i>
                        <span>Attendance</span>
                    </a>
                </li>




                <li>
                    <a href="logout.php?role=admin">
                        <i class="fa-solid fa-right-to-bracket"></i>
                        </i>
                        <span>Logout</span>
                    </a>
                </li>
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
                });
            </script>
        <?php
            unset($_SESSION["status"]);
        }
        ?>
        <!-- <a href="#" class="btn btn added" style="background: rgb(113, 99, 186); color:#fff">Add schedule</a>
 -->
        <button type="button" class="btn btn added" data-bs-toggle="modal" data-bs-target="#exampleModal" style="background: rgb(113, 99, 186); color:#fff">
            Add new time
        </button>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Example of time format: 5:30PM--8:45PM</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <form action="insertSchedule.php" method="POST">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">New time:</label>
                                <input type="text" class="form-input" name="time">
                            </div>

                            <button type="submit" name="insert" class="btn btn-primary">Submit</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <form action="insertSchedule.php" method="POST" enctype="multipart/form-data" class="mt-4" style="display:none" id="form">
            <div class="row">
                <div class="col-lg-6">
                    <select name="dayss" id="dayss" class="form-select form-control mb-2 mt-4">
                        <option>Select day</option>

                        <?php
                        include("conn.php");
                        $select = mysqli_query($conn, "SELECT * FROM tbldays limit 5");
                        if (mysqli_num_rows($select) > 0) {
                            while ($row = mysqli_fetch_assoc($select)) {
                        ?>
                                <option value="<?php echo $row["DayName"] ?>"><?php echo $row["DayID"] ?> <?php echo $row["DayName"] ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>

                    <select name="timeIDD" id="timeIDD" class="form-select form-control mb-2">
                        <option>Select time</option>

                        <?php
                        include("conn.php");
                        $select = mysqli_query($conn, "SELECT * FROM tbltime");
                        if (mysqli_num_rows($select) > 0) {
                            while ($row = mysqli_fetch_assoc($select)) {
                        ?>
                                <option value="<?php echo $row["TimeName"] ?>"><?php echo $row["TimeName"] ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>

                    <input type="text" name="days" class="form-input form-control mb-2 days">
                    <input type="text" name="timeID" class="form-input form-control mb-2 timeID">
                    <select name="subjectID" class="form-select form-control mb-2 ">
                        <option>Subject ID</option>

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

                    <select name="dayweekID" class="form-select form-control mb-2">
                        <option>From</option>
                        <?php
                        include("conn.php");
                        $select = mysqli_query($conn, "SELECT * FROM tbldayweek");
                        if (mysqli_num_rows($select) > 0) {
                            while ($row = mysqli_fetch_assoc($select)) {
                        ?>
                                <option value="<?php echo $row["DayWeekID"] ?>"><?php echo $row["DayWeekID"] ?> <?php echo $row["DayWeekName"] ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>

                    <select name="roomID" class="form-select form-control mb-2">
                        <option>Room ID</option>
                        <?php
                        include("conn.php");
                        $select = mysqli_query($conn, "SELECT * FROM tblroom");
                        if (mysqli_num_rows($select) > 0) {
                            while ($row = mysqli_fetch_assoc($select)) {
                        ?>
                                <option value="<?php echo $row["RoomID"] ?>"><?php echo $row["RoomID"] ?> <?php echo $row["RoomName"] ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="col-lg-6">

                    <select name="academicprogramID" class="form-select form-control mb-2 mt-4">
                        <option>Academic program</option>
                        <?php
                        include("conn.php");
                        $select = mysqli_query($conn, "SELECT * FROM tblacademicyear");
                        if (mysqli_num_rows($select) > 0) {
                            while ($row = mysqli_fetch_assoc($select)) {
                        ?>
                                <option value="<?php echo $row["AcademicYearID"] ?>"><?php echo $row["AcademicYearID"] ?> <?php echo $row["AcademicYear"] ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                    <label>Start Date</label>
                    <input class="form-control form-control  mb-2" type="date" name="startDate">
                    <label>End Date</label>
                    <input class="form-control form-control  mb-2" type="date" name="endDate">
                    <label>Schedule Date</label>
                    <input class="form-control form-control  mb-2" type="date" name="scheduleDate">

                </div>
            </div>
            <button type="submit" name="submit" class="btn btn" style="background: rgb(113, 99, 186); color:#fff">Submit</button>
            <a href="test.php" class="btn btn" style="background: rgb(225, 212, 95);  color:#fff;">Go Back</a>
        </form>

        <div class="idance">
            <div class="schedule content-block">
                <div class="container">
                    <?php
                    include("conn.php");

                    $query = "
                SELECT 
                    tblschedule.ScheduleID,
                    tblsubject.SubjectID,
                    tblsubject.SubjectEN,
                    tbllecturer.LecturerID,
                    tbllecturer.Photo,
                    tbllecturer.LecturerName,
                    tbldayweek.DayWeekID,
                    tbldayweek.DayWeekName,
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
                LEFT JOIN tblsubject ON tblschedule.SubjectID = tblsubject.SubjectID 
                LEFT JOIN tbllecturer ON tblschedule.LecturerID = tbllecturer.LecturerID 
                LEFT JOIN tbldayweek ON tblschedule.DayWeekID = tbldayweek.DayWeekID 
                LEFT JOIN tblroom ON tblschedule.RoomID = tblroom.RoomID 
                LEFT JOIN tblacademicyear ON tblschedule.AcademicProgramID = tblacademicyear.AcademicYearID 
                LEFT JOIN tbldays ON tblschedule.days = tbldays.DayID";
                    $select = mysqli_query($conn, $query);

                    $schedule = [];

                    if (mysqli_num_rows($select) > 0) {
                        while ($row = mysqli_fetch_assoc($select)) {
                            $time = $row['TimeID'];
                            $day = $row['days'];
                            $schedule[$time][$day] = $row;
                        }
                    }
                    ?>

                    <table class="table bordered">
                        <thead>
                            <tr>
                                <th>Time</th>
                                <th>Monday</th>
                                <th>Tuesday</th>
                                <th>Wednesday</th>
                                <th>Thursday</th>
                                <th>Friday</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $times = array_keys($schedule);
                            foreach ($times as $time) {
                                echo "<tr>";
                                echo "<td>$time</td>";

                                foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'] as $day) {
                                    echo "<td>";
                                    if (isset($schedule[$time][$day])) {
                                        $row = $schedule[$time][$day];
                                        echo "{$row['SubjectEN']}<br><span class='name'>{$row['LecturerName']}</span>
                                        <br>{$row['RoomName']}
                                        <br>
                                        <a href='insertSchedule.php?selectID={$row['ScheduleID']}'>Select</a>
                                        <a href='Schedule.php?viewID={$row['ScheduleID']}'>Details</a>
                                        <a onclick='return confirm(\"Are you sure want to delete this record?\");' href='insertSchedule.php?deleteID={$row['ScheduleID']}'>Delete</a>";
                                    } else {
                                        // If the cell is empty, show links to add a new schedule
                                        echo "<a href='#'  class='add-schedule' id='addschedule' data-time='$time' data-day='$day' data-value=''>Select</a>";
                                    }
                                }
                                echo "</tr>";
                            }
                            ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {


            $('.add-schedule').click(function(e) {
                e.preventDefault();;
                var time = $(this).data('time');
                var day = $(this).data('day');
                var value = $(this).data('value');
                var id = $(this).data('schedule');
                $('#dayss').hide();
                $('#timeIDD').hide();
                $('#form').show();
                $('.days').val(day);
                $('.timeID').val(time);

                // Show the form
            });
        });
    </script>

</body>

</html>