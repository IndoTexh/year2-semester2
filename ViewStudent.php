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

$view_id = $_GET["viewID"];
$select = mysqli_query($conn, "SELECT * FROM `tblstudent` WHERE StudentID = '$view_id'");
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
                <img src="Dashboard/images/admin.jpg" alt="">
            </div>
        </div>

        <a href="StudentInfo.php" class="btn btn add" style="background: rgb(113, 99, 186); color:#fff">Go Back</a>

        <section class="bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 mb-4 mb-sm-5">
                        <div class="card card-style1 border-0">
                            <div class="card-body p-1-9 p-sm-2-3 p-md-6 p-lg-7">
                                <div class="row align-items-center">
                                    <div class="col-lg-6 mb-4 mb-lg-0">
                                        <img src="image/<?php echo $row["Photo"] ?>" width="400" alt="...">
                                    </div>
                                    <div class="col-lg-6 px-xl-10">
                                        <div class="bg-secondary d-lg-inline-block py-1-9 px-1-9 px-sm-6 mb-1-9 rounded">
                                            <h3 class="h2 text-white mb-0">Student Information</h3>
                                        </div>
                                        <ul class="list-unstyled mb-1-9">
                                            <li class="mb-2  display-28 h5"><span class="display-26 text-secondary me-2 font-weight-600">Name in Khmer:</span> <?php echo $row["NameInKhmer"] ?></li>
                                            <li class="mb-2  display-28 h5"><span class="display-26 text-secondary me-2 font-weight-600">Name in Latin:</span> <?php echo $row["NameInLatin"] ?></li>
                                            <li class="mb-2  display-28 h5"><span class="display-26 text-secondary me-2 font-weight-600">Family Name:</span><?php echo $row["FamilyName"] ?></li>
                                            <li class="mb-2  display-28 h5"><span class="display-26 text-secondary me-2 font-weight-600">Given Name:</span> <?php echo $row["GivenName"] ?></li>
                                            <li class="mb-2  display-28 h5"><span class="display-26 text-secondary me-2 font-weight-600">Gender:</span><?php echo $row["SexID"] ?></li>
                                            <li class="mb-2 display-28 h5"><span class="display-26 text-secondary me-2 font-weight-600">Passport:</span> <?php echo $row["IDPassportNo"] ?></li>
                                            <li class="mb-2 display-28 h5"><span class="display-26 text-secondary me-2 font-weight-600">Nationality:</span> <?php echo $row["NationalityID"] ?></li>
                                            <li class="mb-2 display-28 h5"><span class="display-26 text-secondary me-2 font-weight-600">Country:</span> <?php echo $row["CountryID"] ?></li>
                                            <li class="mb-2 display-28 h5"><span class="display-26 text-secondary me-2 font-weight-600">Date of Birth:</span> <?php echo $row["DOB"] ?></li>
                                            <li class="mb-2 display-28 h5"><span class="display-26 text-secondary me-2 font-weight-600">Place of Birth:</span> <?php echo $row["POB"] ?></li>
                                            <li class="mb-2 display-28 h5"><span class="display-26 text-secondary me-2 font-weight-600">Contact:</span> <?php echo $row["PhoneNumber"] ?></li>
                                            <li class="mb-2 display-28 h5"><span class="display-26 text-secondary me-2 font-weight-600">Email:</span> <?php echo $row["Email"] ?></li>
                                            <li class="mb-2 display-28 h5"><span class="display-26 text-secondary me-2 font-weight-600">Current Address:</span> <?php echo $row["CurrentAddress"] ?></li>
                                            <li class="mb-2 display-28 h5"><span class="display-26 text-secondary me-2 font-weight-600">Date of Register:</span> <?php echo $row["DateOfRegister"] ?></li>
                                            <img src=" <?php echo $row["qrCode"] ?>" alt="">
                                        </ul>
                                        <ul class="social-icon-style1 list-unstyled mb-0 ps-0">
                                            <li><a href="#!"><i class="ti-twitter-alt"></i></a></li>
                                            <li><a href="#!"><i class="ti-facebook"></i></a></li>
                                            <li><a href="#!"><i class="ti-pinterest"></i></a></li>
                                            <li><a href="#!"><i class="ti-instagram"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-lg-12 mb-4 mb-sm-5">
                        <div>
                            <span class="section-title text-primary mb-3 mb-sm-4">About Me</span>
                            <p>Edith is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                            <p class="mb-0">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed.</p>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-12 mb-4 mb-sm-5">
                                <div class="mb-4 mb-sm-5">
                                    <span class="section-title text-primary mb-3 mb-sm-4">Skill</span>
                                    <div class="progress-text">
                                        <div class="row">
                                            <div class="col-6">Driving range</div>
                                            <div class="col-6 text-end">80%</div>
                                        </div>
                                    </div>
                                    <div class="custom-progress progress progress-medium mb-3" style="height: 4px;">
                                        <div class="animated custom-bar progress-bar slideInLeft bg-secondary" style="width:80%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="10" role="progressbar"></div>
                                    </div>
                                    <div class="progress-text">
                                        <div class="row">
                                            <div class="col-6">Short Game</div>
                                            <div class="col-6 text-end">90%</div>
                                        </div>
                                    </div>
                                    <div class="custom-progress progress progress-medium mb-3" style="height: 4px;">
                                        <div class="animated custom-bar progress-bar slideInLeft bg-secondary" style="width:90%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="70" role="progressbar"></div>
                                    </div>
                                    <div class="progress-text">
                                        <div class="row">
                                            <div class="col-6">Side Bets</div>
                                            <div class="col-6 text-end">50%</div>
                                        </div>
                                    </div>
                                    <div class="custom-progress progress progress-medium mb-3" style="height: 4px;">
                                        <div class="animated custom-bar progress-bar slideInLeft bg-secondary" style="width:50%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="70" role="progressbar"></div>
                                    </div>
                                    <div class="progress-text">
                                        <div class="row">
                                            <div class="col-6">Putting</div>
                                            <div class="col-6 text-end">60%</div>
                                        </div>
                                    </div>
                                    <div class="custom-progress progress progress-medium" style="height: 4px;">
                                        <div class="animated custom-bar progress-bar slideInLeft bg-secondary" style="width:60%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="70" role="progressbar"></div>
                                    </div>
                                </div>
                                <div>
                                    <span class="section-title text-primary mb-3 mb-sm-4">Education</span>
                                    <p>Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy.</p>
                                    <p class="mb-1-9">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour.</p>

                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </section>


    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>