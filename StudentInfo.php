<?php
include("conn.php");
session_name('admin_session');
session_start();
if (!isset($_SESSION["authenticated"]) || $_SESSION["authenticated"] !== true) {
    $_SESSION["status"] = "You are not authorized to see that page unless you are logged in.";
    $_SESSION["status_code"] = "warning";
    header("Location: index.php");
    exit();
}

$start = 0;
$rows_per_page = 10;
if (isset($_GET["page-nr"])) {
    $page = $_GET["page-nr"] - 1;
    $start = $page * $rows_per_page;
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
<?php
if (isset($_GET["page-nr"])) {
    $id = $_GET["page-nr"];
} else {
    $id = 1;
}
?>

<body id="<?php echo $id ?>">
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
                <li class="active">
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
        <a href="Studentform.php" class="btn btn added" style="background: rgb(113, 99, 186); color:#fff">Register Student</a>

        <div class="tabular--wrapper">
            <h3 class="main--title">Student's data</h3>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Adress</th>
                            <th>Phone Number</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $records = mysqli_query($conn, "SELECT * FROM tblstudent");
                        $nr_of_rows = $records->num_rows;
                        $pages = ceil($nr_of_rows / $rows_per_page);


                        $select = mysqli_query($conn, "SELECT * FROM `tblstudent` ORDER By StudentID desc LIMIT $start,$rows_per_page");
                        if (mysqli_num_rows($select) > 0) {
                            while ($row = mysqli_fetch_assoc($select)) {
                        ?>
                                <tr>
                                    <td><?php echo $row["StudentID"] ?></td>
                                    <td><?php echo $row["NameInKhmer"] ?></td>
                                    <td><?php echo $row["NameInLatin"] ?></td>
                                    <td><?php echo $row["CurrentAddress"] ?></td>
                                    <td><?php echo $row["PhoneNumber"] ?></td>
                                    <td>
                                        <img src="image/<?php echo $row["Photo"] ?>" alt="" width="50">
                                    </td>
                                    <td>

                                        <div class="dropdown">
                                            <a class="btn btn dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="background: rgb(113, 99, 186); color:#fff">

                                            </a>

                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item" href="InsertStudentForm.php?updateID=<?php echo $row["StudentID"] ?>">
                                                        <i class="fas fa-edit"></i> Edit

                                                    </a>
                                                </li>
                                                <li><a onclick="javascript:return confirm('Are you sure want to delete this record?');" class="dropdown-item" href="InsertStudentForm.php?deleteID=<?php echo $row["StudentID"] ?>"><i class="fas fa-trash"></i> Delete</a></li>
                                                <li><a class="dropdown-item" href="ViewStudent.php?viewID=<?php echo $row["StudentID"] ?>"><i class="fas fa-eye"></i> View Details</a></li>
                                                <li><a class="dropdown-item" href="getQr.php?getQr=<?php echo $row["StudentID"] ?>"><i class="fa-solid fa-qrcode"></i> Get QR</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                        <?php
                            }
                        }
                        ?>


                </table>

                <div class="page-amount mt-3">

                    <?php
                    if (!isset($_GET['page-nr"'])) {
                        $page = 1;
                    } else {
                        $page = $_GET["page-nr"];
                    }
                    ?>
                    <h6>Showing <?php echo $page ?> of <?php echo $pages ?> pages</h6>
                </div>
                <nav aria-label="Page navigation example">

                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="?page-nr=1">First</a></li>

                        <?php
                        if (isset($_GET["page-nr"]) && $_GET["page-nr"] > 1) {
                        ?>
                            <li class="page-item"><a class="page-link" href="?page-nr=<?php echo $_GET["page-nr"] - 1 ?>">Previous</a></li>
                        <?php
                        } else {
                        ?>
                            <li class="page-item"><a class="page-link">Previous</a></li>
                        <?php
                        }
                        ?>

                        <?php
                        for ($counter = 1; $counter <= $pages; $counter++) {
                        ?>
                            <li class="page-item">
                                <a class="page-link" href="?page-nr=<?php echo $counter ?>"><?php echo $counter ?></a>
                            </li>
                        <?php
                        }
                        ?>
                        <?php
                        if (!isset($_GET["page-nr"])) {
                        ?>
                            <li class="page-item"><a class="page-link" href="?page-nr=2">Next</a></li>
                            <?php
                        } else {
                            if ($_GET["page-nr"] >= $pages) {
                            ?>
                                <li class="page-item"><a class="page-link">Next</a></li>
                            <?php
                            } else {
                            ?>
                                <a href="?page-nr=<?php echo $_GET["page-nr"] + 1 ?>"></a>
                        <?php
                            }
                        }
                        ?>

                        <li class="page-item"><a class="page-link" href="?page-nr=<?php echo $pages ?>">Last</a></li>
                    </ul>
                </nav>

            </div>
        </div>
    </div>
    <script>
        let links = document.querySelectorAll('.page-item > a');
        let bodyid = parseInt(document.body.id) - 1;
        links[bodyid].classList.add("activate");
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>