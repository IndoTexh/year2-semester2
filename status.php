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
                <span>Student</span>
                <h2>Status</h2>
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
        <!-- <a href="statusForm.php" class="btn btn added mb-4" style="background: rgb(113, 99, 186); color:#fff;">Add Status</a> -->


        <form action="statusInsert.php" method="POST" enctype="multipart/form-data" style="margin-top:60px">
            <div class="row">
                <div class="col-lg-12">
                    <!-- <input class="form-control form-control mb-2 mt-4" type="hidden" placeholder="Student ID" name="studentID" autocomplete="off">
                   <input class="form-control form-control mb-2 mt-4" type="text" placeholder="Program ID" name="programID" autocomplete="off"> -->
                    <select name="programID" id="programID" class="form-control form-control mb-2">
                        <option>Select Program</option>
                        <?php
                        include("conn.php");
                        $select = mysqli_query($conn, "SELECT tblprogram.ProgramID,tblyear.YearID,tblyear.YearEN,tblsemester.SemesterID,tblsemester.SemesterEN,tblshift.ShiftID,tblshift.ShiftEN,tbldegree.DegreeID,tbldegree.DegreeEN,tblacademicyear.AcademicYearID,tblacademicyear.AcademicYear,tblmajor.MajorID,tblmajor.MajorEN,tblbatch.BatchID,tblbatch.BatchEN,tblcampus.CampusID,tblcampus.CampusEN,tblprogram.StartDate,tblprogram.EndDate,tblprogram.ProgramID, tblprogram.YearID,tblprogram.SemesterID,tblprogram.DateIssue FROM tblprogram LEFT JOIN tblyear on tblprogram.YearID = tblyear.YearID LEFT JOIN tblsemester on tblprogram.SemesterID = tblsemester.SemesterID LEFT JOIN tblshift on tblprogram.ShiftID = tblshift.ShiftID LEFT JOIN tbldegree on tblprogram.DegreeID = tbldegree.DegreeID LEFT JOIN tblacademicyear on tblprogram.AcademicYearID = tblacademicyear.AcademicYearID LEFT JOIN tblmajor on tblprogram.MajorID = tblmajor.MajorID LEFT JOIN tblbatch on tblprogram.BatchID = tblbatch.BatchID LEFT JOIN tblcampus on tblprogram.CampusID = tblcampus.CampusID order by ProgramID desc");
                        if (mysqli_num_rows($select) > 0) {
                            while ($rows = mysqli_fetch_assoc($select)) {
                        ?>
                                <option value="<?php echo $rows["ProgramID"] ?>" class="h-6">
                                    <?php echo $rows["MajorEN"] ?> <?php echo $rows["ProgramID"] ?>
                                    [<?php echo $rows["DegreeEN"] ?>]-[<?php echo $rows["BatchEN"] ?>]-[S<?php echo $rows["SemesterID"] ?>]-[Y<?php echo $rows["YearID"] ?>]-[Start: <?php echo $rows["StartDate"] ?>]-[End: <?php echo $rows["EndDate"] ?>]-[Created: <?php echo $rows["DateIssue"] ?>]
                                </option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="col-lg-6">
                    <label class="mt-2">&nbsp;Assign Date:</label>
                    <input class="form-control form-control mb-2" type="date" placeholder="Assigned Date" name="assignedDate" autocomplete="off">
                </div>

                <div class="col-lg-6">
                    <select name="reselect_programID" id="reselect_programID" class="form-control form-control mb-2 mt-4">
                        <option>Assign new academic program</option>
                        <?php
                        include("conn.php");
                        $select = mysqli_query($conn, "SELECT tblprogram.ProgramID,tblyear.YearID,tblyear.YearEN,tblsemester.SemesterID,tblsemester.SemesterEN,tblshift.ShiftID,tblshift.ShiftEN,tbldegree.DegreeID,tbldegree.DegreeEN,tblacademicyear.AcademicYearID,tblacademicyear.AcademicYear,tblmajor.MajorID,tblmajor.MajorEN,tblbatch.BatchID,tblbatch.BatchEN,tblcampus.CampusID,tblcampus.CampusEN,tblprogram.StartDate,tblprogram.EndDate,tblprogram.ProgramID, tblprogram.YearID,tblprogram.SemesterID,tblprogram.DateIssue FROM tblprogram LEFT JOIN tblyear on tblprogram.YearID = tblyear.YearID LEFT JOIN tblsemester on tblprogram.SemesterID = tblsemester.SemesterID LEFT JOIN tblshift on tblprogram.ShiftID = tblshift.ShiftID LEFT JOIN tbldegree on tblprogram.DegreeID = tbldegree.DegreeID LEFT JOIN tblacademicyear on tblprogram.AcademicYearID = tblacademicyear.AcademicYearID LEFT JOIN tblmajor on tblprogram.MajorID = tblmajor.MajorID LEFT JOIN tblbatch on tblprogram.BatchID = tblbatch.BatchID LEFT JOIN tblcampus on tblprogram.CampusID = tblcampus.CampusID order by ProgramID desc");
                        if (mysqli_num_rows($select) > 0) {
                            while ($row = mysqli_fetch_assoc($select)) {
                        ?>
                                <option value="<?php echo $row["ProgramID"] ?>" class="h-6">
                                    <?php echo $row["MajorEN"] ?> <?php echo $row["ProgramID"] ?>
                                    [<?php echo $row["DegreeEN"] ?>]-[<?php echo $row["BatchEN"] ?>]-[S<?php echo $row["SemesterID"] ?>]-[Y<?php echo $row["YearID"] ?>]-[Start: <?php echo $row["StartDate"] ?>]-[End: <?php echo $row["EndDate"] ?>]-[Created: <?php echo $row["DateIssue"] ?>]
                                </option>
                        <?php
                            }
                        }
                        ?>
                    </select>

                    <label class="mt-2">&nbsp;Note:</label>
                    <input type="text" class="form-control form-control mb-2" name="note" placeholder="Note">
                </div>
            </div>

            <div class="row bordered mb-4 mt-4">
                <div class="col-lg-6">
                    <table class="" style="display: none;" id="table-display">
                        <h6 id="no-record" style="display: none;">No studet found within this program!</h6>
                        <thead>
                            <th>Assign</th>
                            <th>ID</th>
                            <th>Name in Latin</th>
                            <th>Name in Khmer</th>
                            <th>Status</th>
                        </thead>
                        <tbody id="display">

                        </tbody>
                    </table>
                    <button type="submit" name="insert" class="btn btn btn-submit" style="background: rgb(113, 99, 186); display:none; color:#fff; margin-top:20px;margin-bottom:20px">Submit</button>
                    <a href="status.php" class="btn btn btn-cancel" style="background: rgb(225, 212, 95);  color:#fff; display:none">Cancel</a>
                </div>

                <div class="col-lg-6" id="current-program">
                    <p style="padding:5px; border-radius:5px; background: rgb(113, 99, 186); color:#fff">Student in new program</p>
                    <table id>
                        <thead>
                            <th>ID</th>
                            <th>Name in Latin</th>
                            <th>Program ID</th>
                            <th>Status</th>
                            <th>Note</th>
                            <th>Assign Date</th>
                        </thead>
                        <tbody>

                            <?php
                            include("conn.php");
                            $select = mysqli_query($conn, "SELECT newstatus.NewStatusID,newstatus.StudentID,newstatus.ProgramID,newstatus.Assigned,newstatus.Note,newstatus.AssignDate,tblstudent.StudentID,tblstudent.NameInLatin from newstatus left join tblstudent on newstatus.StudentID = tblstudent.StudentID");
                            if (mysqli_num_rows($select) > 0) {
                                while ($rows = mysqli_fetch_assoc($select)) {
                            ?>
                                    <tr>
                                        <td><?php echo $rows["NewStatusID"] ?></td>
                                        <td><?php echo $rows["NameInLatin"] ?></td>
                                        <td><?php echo $rows["ProgramID"] ?></td>
                                        <td><?php echo $rows["Assigned"] ?></td>
                                        <td><?php echo $rows["Note"] ?></td>
                                        <td><?php echo $rows["AssignDate"] ?></td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>

                        </tbody>
                    </table>
                    <div class="alert alert-primary" role="alert" style="display:none;">
                        <a href="#" class="alert-link"></a>
                    </div>
                </div>
            </div>
            <!-- <button type="submit" name="submit" class="btn btn" style="background: rgb(113, 99, 186); color:#fff">Submit</button>
            <a href="status.php" class="btn btn" style="background: rgb(225, 212, 95);  color:#fff;">Go Back</a> -->
        </form>


    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#programID').on('change', function() {
                var programID = $(this).val();
                $.ajax({
                    url: 'statusResponse.php',
                    type: 'POST',
                    data: {
                        program_data: programID
                    },
                    success: function(response) {
                        $('#display').html(response);
                        $('#table-display').show();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText); // Log any errors to the console
                    }
                });
            });

            var checkedStudents = [];

            $(document).on('change', 'input[type="checkbox"][name="assign"]', function() {
                var studentID = $(this).val();
                // var studentRow = $(this).closest('tr').clone(); // Clone the row of the checked student
                if ($(this).is(':checked')) {
                    checkedStudents.push(studentID);
                    $('#reselect_programID').show();
                    // $('#show').append(studentRow); // Append the cloned row to the check-display table
                    // $('#check-display').show(); // Show the check-display table
                    $('.btn-submit').show();
                    $('.btn-cancel').show();
                } else {
                    var index = checkedStudents.indexOf(studentID);
                    if (index > -1) {
                        checkedStudents.splice(index, 1);
                        $('#show').find('input[value="' + studentID + '"]').closest('tr').remove(); // Remove the row from the check-display table
                    }
                    if (checkedStudents.length == 0) {
                        $('#check-display').hide(); // Hide the check-display table if no students are checked
                    }
                }
                $('#checkedStudents').val(JSON.stringify(checkedStudents)); // Update the hidden input with checked students
            });


            $('#statusForm').on('submit', function(e) {
                if (checkedStudents.length == 0) {
                    e.preventDefault();
                    alert('Please select at least one student.');
                }
            });
        });

        $(document).ready(function() {
            function submitForm() {
                var programID = $('#reselect_programID').val();
                var date = $('input[name="assignedDate"]').val();
                var note = $('input[name="note"]').val();
                var assign = "Assign";
                var student = [];

                $('input[type="checkbox"][name="assign"]:checked').each(function() {
                    student.push($(this).val());
                });

                var formData = {
                    programID: programID,
                    date: date,
                    note: note,
                    assign: assign,
                    student: student
                };

                $.ajax({
                    url: 'statusInsert.php',
                    type: "POST",
                    data: formData,
                    success: function(response) {
                        $('.alert-primary').show();
                        $('.alert-link').text(response);
                        $('#table-display').hide();
                        setTimeout(() => {
                            $('.alert-primary').hide();
                            $('#reselect_programID').hide();
                            $('.btn-submit').hide();
                            $('.btn-cancel').hide();
                            window.location.reload();
                        }, 2000);

                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        console.error(xhr.responseText); // Log any errors to the console
                    }

                });

            }

            $('.btn-submit').on('click', function(e) {
                e.preventDefault();
                submitForm();
                $('#current-program').show();
            });
        });
    </script>

</body>

</html>