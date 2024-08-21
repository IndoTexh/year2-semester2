<?php
include("conn.php");
session_name('teacher_session'); // Set session name for teachers
session_start();
if (!isset($_SESSION["authenticated"]) || $_SESSION["authenticated"] !== true) {
    $_SESSION["status"] = "You are not authorized to see that page unless you are logged in.";
    $_SESSION["status_code"] = "warning";
    header("Location:formAuthorizeTeacher.php");
    exit();
}

$name = strtoupper($_SESSION["name"]);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="Dashboard/teacherAuthorize.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
    <div class="sidebar">
        <div class="logo">
            <ul class="menu">
                <li class="active">
                    <a href="teacherAuthorize.php">
                        <i class="fas fa-home"></i>
                        <span>Homepage</span>
                    </a>
                </li>
                <!-- <li>
                    <a href="attendance.php">
                        <i class="fa-solid fa-clipboard-user"></i>
                        <span>Attendance</span>
                    </a>
                </li> -->
            </ul>
        </div>
    </div>

    <p class="loginAs">Login as: <?php echo $name ?></p>
    <a href="logout.php?role=teacher" class="logout-btn">Logout</a> <!-- Updated logout link -->

    <div class="myTask">
        My Tasks
    </div>
    <div class="scheduless">
        <p>Schedule Availables</p>
    </div>

    <div class="schedule-container">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="background-color: lightgray;">No.</th>
                    <th style="background-color: lightgray;">Subject</th>
                    <th style="background-color: lightgray;">Lecturer</th>
                    <th style="background-color: lightgray;">Day</th>
                    <th style="background-color: lightgray;">Attendance</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include("conn.php");
                $select = mysqli_query($conn, "SELECT * FROM tblschedule WHERE UPPER(LecturerID) = '$name'");
                if (mysqli_num_rows($select) > 0) {
                    while ($row = mysqli_fetch_assoc($select)) {
                ?>
                        <tr>
                            <td><?php echo $row['ScheduleID'] ?></td>
                            <td><?php echo $row['SubjectID'] ?></td>
                            <td><?php echo $row["LecturerID"] ?></td>
                            <td><?php echo $row["days"] ?></td>
                            <td>
                                <a href="prevent.php?subject=<?php echo urlencode($row['SubjectID']); ?>&lecturer=<?php echo urlencode($row['LecturerID']); ?>">Note attendance</a>
                            </td>

                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
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
</body>

</html>