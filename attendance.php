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
    <link rel="stylesheet" href="Dashboard/attendance.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
    <div class="sidebar">
        <div class="logo">
            <ul class="menu">
                <li>
                    <a href="index.php">
                        <i class="fas fa-home"></i>
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
                <li>
                    <a href="batch.php">
                        <i class="fa-solid fa-list"></i>
                        <span>Batch</span>
                    </a>
                </li>
                <li>
                    <a href="logout.php?role=admin">
                        <i class="fa-solid fa-right-to-bracket"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="main-content">
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



        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <form action="generatePDF.php" method="POST" class="mb-5">
                        <select name="subject" id="subject" class="form-select mt-3">
                            <option>Report via subjects</option>

                            <?php
                            require 'conn.php';

                            $select = mysqli_query($conn, "SELECT tblsubject.SubjectEN, tblsubject.SubjectID from tblsubject
                                                   INNER JOIN tblschedule on tblsubject.SubjectEN = tblschedule.SubjectID ");
                            if (mysqli_num_rows($select) > 0) {
                                while ($row = mysqli_fetch_assoc($select)) {
                            ?>
                                    <option value="<?php echo $row["SubjectEN"] ?>"><?php echo $row["SubjectID"] ?> <?php echo $row["SubjectEN"] ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                        <button type="button" class="btn btn-primary addedd mt-2">List attendance </button>

                        <button class="btn btn-primary mt-1" type="submit" name="submit" style="display:none">Print pdf</button>
                    </form>
                </div>

                <div class="col-lg-3">
                    <form action="generateBatchPDF.php" method="POST" class="mb-5">
                        <select name="batch" id="batch" class="form-select mt-3">
                            <option>Report via batch</option>

                            <?php
                            require 'conn.php';

                            $select = mysqli_query($conn, "SELECT * FROM tblbatch");
                            if (mysqli_num_rows($select) > 0) {
                                while ($row = mysqli_fetch_assoc($select)) {
                            ?>
                                    <option value="<?php echo $row["BatchID"] ?>"> <?php echo $row["BatchEN"] ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>

                        <button type="button" class="btn btn-primary mt-2" id="btn-batch">List attendance</button>

                        <button class="btn btn-primary mt-1" id="btn-batch-primary" type="submit" name="submitBatch" style="display:none">Print pdf</button>
                    </form>
                </div>

                <div class="col-lg-3">
                    <form action="generateMajorPDF.php" method="POST" class="mb-5">
                        <select name="major" id="major" class="form-select mt-3">
                            <option>Report via major</option>

                            <?php
                            require 'conn.php';

                            $select = mysqli_query($conn, "SELECT * FROM tblmajor");
                            if (mysqli_num_rows($select) > 0) {
                                while ($row = mysqli_fetch_assoc($select)) {
                            ?>
                                    <option value="<?php echo $row["MajorID"] ?>"><?php echo $row["MajorID"] ?> <?php echo $row["MajorEN"] ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>

                        <button type="button" class="btn btn-primary mt-2" id="btn-major">List attendance</button>

                        <button class="btn btn-primary mt-1" id="MajorBtn" type="submit" name="submitMajor" style="display:none">Print pdf</button>
                    </form>
                </div>

                <div class="col-lg-3">
                    <form action="generateCampusPDF.php" method="POST" class="mb-5">
                        <select name="campus" id="campus" class="form-select mt-3">
                            <option>Report via campus</option>

                            <?php
                            require 'conn.php';

                            $select = mysqli_query($conn, "SELECT * FROM tblcampus");
                            if (mysqli_num_rows($select) > 0) {
                                while ($row = mysqli_fetch_assoc($select)) {
                            ?>
                                    <option value="<?php echo $row["CampusID"] ?>"><?php echo $row["CampusID"] ?> <?php echo $row["CampusEN"] ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>

                        <button type="button" class="btn btn-primary mt-2" id="btn-campus">List attendance</button>

                        <button class="btn btn-primary mt-1" id="CampusBtn" type="submit" name="submitCampus" style="display:none">Print pdf</button>
                    </form>
                </div>

                <div class="col-lg-3">
                    <form action="generateFacultyPDF.php" method="POST" class="mb-5">
                        <select name="faculty" id="faculty" class="form-select mt-3">
                            <option>Report via faculty</option>

                            <?php
                            require 'conn.php';

                            $select = mysqli_query($conn, "SELECT * FROM tblfaculty");
                            if (mysqli_num_rows($select) > 0) {
                                while ($row = mysqli_fetch_assoc($select)) {
                            ?>
                                    <option value="<?php echo $row["FacultyID"] ?>"><?php echo $row["FacultyID"] ?> <?php echo $row["FacultyEN"] ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>

                        <button type="button" class="btn btn-primary mt-2" id="btn-faculty">List attendance</button>

                        <button class="btn btn-primary mt-1" id="facultyBtn" type="submit" name="submitFaculty" style="display:none">Print pdf</button>
                    </form>
                </div>

                <div class="col-lg-3">
                    <form action="generateShiftPDF.php" method="POST" class="mb-5">
                        <select name="shift" id="shift" class="form-select mt-3">
                            <option>Report via shift</option>

                            <?php
                            require 'conn.php';

                            $select = mysqli_query($conn, "SELECT * FROM tblshift");
                            if (mysqli_num_rows($select) > 0) {
                                while ($row = mysqli_fetch_assoc($select)) {
                            ?>
                                    <option value="<?php echo $row["ShiftID"] ?>"><?php echo $row["ShiftID"] ?> <?php echo $row["ShiftEN"] ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>

                        <button type="button" class="btn btn-primary mt-2" id="btn-shift">List attendance</button>

                        <button class="btn btn-primary mt-1" id="shiftBtn" type="submit" name="submitShift" style="display:none">Print pdf</button>
                    </form>
                </div>

                <div class="col-lg-3">
                    <form action="generateDatePDF.php" method="POST" class="mb-5">
                        <select name="date" id="date" class="form-select mt-3">
                            <option>Report via date</option>
                            <option value="day">Report per day</option>
                            <option value="week">Report per week</option>
                            <option value="month">Report per month</option>
                            <option value="year">Report per year</option>
                        </select>

                        <button type="button" class="btn btn-primary mt-2" id="btn-date">List attendance</button>

                        <button class="btn btn-primary mt-1" id="dateBtn" type="submit" name="submitDate" style="display:none">Print pdf</button>
                    </form>
                </div>
            </div>
        </div>


        <table class="table table-bordered" id="date-display" style="display: none">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Name in English</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody id="dateData">

            </tbody>
        </table>

        <table class="table table-bordered" id="shift-display" style="display: none">
            <thead>
                <tr>
                    <th>Shift</th>
                    <th>Name in English</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody id="shiftData">

            </tbody>
        </table>
        <table class="table table-bordered" id="faculty-display" style="display: none">
            <thead>
                <tr>
                    <th>Faculty</th>
                    <th>Name in English</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody id="facultyData">

            </tbody>
        </table>

        <table class="table table-bordered" id="campus-display" style="display: none">
            <thead>
                <tr>
                    <th>Campus</th>
                    <th>Name in English</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody id="campusData">

            </tbody>
        </table>

        <table class="table table-bordered" id="major-display" style="display: none">
            <thead>
                <tr>
                    <th>Major</th>
                    <th>Name in English</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody id="majorData">

            </tbody>
        </table>

        <table class="table table-bordered" id="form-display" style="display: none">
            <thead>
                <tr>
                    <th>Teach by</th>
                    <th>Subject</th>
                    <th>Name in Latin</th>
                    <th>Name in English</th>
                    <th>Attended</th>
                    <!-- <th>timein</th>
                    <th>Attendance date issue</th> -->
                </tr>
            </thead>

            <tbody id="bodyData">

            </tbody>
        </table>

        <table class="table table-bordered" id="batch-display" style="display: none">
            <thead>
                <tr>
                    <th>Batch</th>
                    <th>Name in Latin</th>
                    <th>Status</th>
                    <!-- <th>timein</th>
                    <th>Attendance date issue</th> -->
                </tr>
            </thead>

            <tbody id="batchData">

            </tbody>
        </table>



        <!-- <select name="lecturer" id="lecturer" class="form-select">
            <option value="">Choose lecturer</option>

            <?php
            include("conn.php");

            $sql = mysqli_query($conn, "SELECT * FROM tblschedule");
            if (mysqli_num_rows($sql) > 0) {
                while ($row = mysqli_fetch_assoc($sql)) {
            ?>
                    <option value="<?php echo $row["LecturerID"] ?>"> <?php echo $row["LecturerID"] ?></option>
            <?php
                }
            }
            ?>
        </select> -->


    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#btn-date').click(function() {
                var date = $('#date').val();

                $.ajax({
                    url: 'listDateAtt.php',
                    type: 'get',
                    data: {
                        date: date
                    },
                    success: function(response) {
                        $('#date-display').show();
                        $('#dateData').html(response);
                        $('#dateBtn').show();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                })
            })
        });

        $(document).ready(function() {
            $('#btn-shift').click(function() {
                var shiftID = $('#shift').val();

                $.ajax({
                    url: 'listShiftAtt.php',
                    type: 'get',
                    data: {
                        shiftID: shiftID
                    },
                    success: function(response) {
                        $('#shift-display').show();
                        $('#shiftData').html(response);
                        $('#shiftBtn').show();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                })

            })
        })
        $(document).ready(function() {
            $('#btn-faculty').click(function() {
                var facultyID = $('#faculty').val();


                $.ajax({
                    url: 'listFacultyAtt.php',
                    type: 'get',
                    data: {
                        facultyID: facultyID
                    },
                    success: function(response) {
                        $('#faculty-display').show();
                        $('#facultyData').html(response);
                        $('#facultyBtn').show();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                })
            })
        });
        $(document).ready(function() {
            $('#btn-campus').click(function() {
                var campusID = $('#campus').val();

                $.ajax({
                    url: 'listCampusAtt.php',
                    type: 'get',
                    data: {
                        campusID: campusID
                    },
                    success: function(response) {
                        $('#campus-display').show();
                        $('#campusData').html(response);
                        $('#CampusBtn').show();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                })
            })
        })

        $(document).ready(function() {
            $('#btn-major').click(function() {
                var majorId = $('#major').val();

                $.ajax({
                    url: 'listMajorAtt.php',
                    type: 'get',
                    data: {
                        majorId: majorId
                    },
                    success: function(response) {
                        $('#major-display').show();
                        $('#majorData').html(response);
                        $('#MajorBtn').show();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                })
            })
        })

        $(document).ready(function() {
            $('.addedd').click(function() {
                //var attDate = $('#dateAtt').val();
                var subject = $('#subject').val();
                alert(subject);

                $.ajax({
                    url: "listAttendance.php",
                    type: "POST",
                    data: {
                        subject: subject
                    },
                    success: function(result) {
                        $('#form-display').show();
                        $('#bodyData').html(result);
                        $('.btn-primary').show();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                })

            })
        });

        $(document).ready(function() {
            $('#btn-batch').click(function(e) {
                var batchID = $('#batch').val();
                e.preventDefault();
                $.ajax({
                    url: "listBatchAtt.php",
                    type: "get",
                    data: {
                        batchID: batchID
                    },
                    success: function(result) {
                        $('#batch-display').show();
                        $('#batchData').html(result);
                        $('#btn-batch-primary').show();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                })
            })
        })
    </script>
</body>

</html>