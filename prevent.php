<?php
require "conn.php";
session_name('teacher_session');
session_start();
if (!isset($_SESSION["authenticated"]) || $_SESSION["authenticated"] !== true) {
    $_SESSION["status"] = "You are not authorized to see that page unless you are logged in.";
    $_SESSION["status_code"] = "warning";
    header("Location:index.php");
    exit();
}
$subject = isset($_GET['subject']) ? $_GET['subject'] : null;
$lecturer = isset($_GET['lecturer']) ? $_GET['lecturer'] : null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance</title>
    <link rel="stylesheet" href="Dashboard/teacherAuthorize.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="Dashboard/attendance.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>

    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-lg-12">
                <select name="programID" id="programID" class="form-select form-control mb-2">
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

                <a href="teacherAuthorize.php" class="btn btn-primary" id="goBack-1">Go back</a>
            </div>
        </div>
        <div>
            <div class="row">
                <div class="col-lg-8">
                    <form id="attendanceForm" style="display: none">
                        <input type="hidden" id="subject" name="subject" value="<?php echo htmlspecialchars($subject); ?>">
                        <input type="hidden" id="lecturer" name="lecturer" value="<?php echo htmlspecialchars($lecturer); ?>">
                        <div class="table-container">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="background: lightgray;">No.</th>
                                        <th style="background: lightgray;">ID</th>
                                        <th style="background: lightgray;">StudentName</th>
                                        <th style="background: lightgray;">KhmerName</th>
                                        <th style="background: lightgray;">Attended</th>
                                        <th style="background: lightgray;"></th>
                                        <th style="background: lightgray;">[A]</th>
                                        <th style="background: lightgray;">[P]</th>
                                        <th style="background: lightgray;">[S]</th>
                                    </tr>
                                </thead>
                                <tbody id="response">


                            </table>

                        </div>
                        <button type="submit" class="btn btn-primary" style="margin-bottom: 20px;">Submit Attendance</button>
                        <button type="button" class="btn btn-primary" id="all-presence">All presence</button>
                        <button type="button" class="btn btn-primary" id="reload">Reload</button>

                        <a href="teacherAuthorize.php" class="btn btn-primary" id="goBack">Go back</a>

                        <div class="AttendanceDateIssue">
                            Attendance date issue :<input type="date" class="form-input" name="AttendanceDateIssues" id="AttendanceDateIssues">
                        </div>

                        <div class="DateIssue">
                            Date issue :<input type="date" class="form-input" name="DateIssue" id="DateIssue">
                        </div>

                        <div class="Session">
                            <select name="session" id="session" class="form-select">
                                <option>Choose session</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                        </div>

                        <button class="btn btn-primary primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                            List of students which have record their attendance
                        </button>

                        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                            <div class="offcanvas-header">
                                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <?php
                                $date = new DateTime();
                                $current = $date->format('Y-m-d');

                                $select = mysqli_query($conn, "SELECT * FROM tblattendance WHERE SubjectID = '$subject' AND LecturerID = '$lecturer' AND dateOfAtt = '$current'");


                                // Fetch and process the results
                                if (mysqli_num_rows($select) > 0) {
                                    while ($row = mysqli_fetch_assoc($select)) {
                                        // Process each row of the result set
                                        echo '<li>' . $row['StudentID'] . '</li>';
                                    }
                                } else {
                                    echo '<li>No students have recorded their attendance by themselves yet.</li>';
                                }
                                ?>
                            </div>
                        </div>


                        <div class="alert alert-primary alert-dismissible fade show" role="alert" id="return" style="display: none;">
                            <strong>Success!</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script>
        /*  $(document).ready(function() {
            $('#all-presence').on('click', function() {

                document.getElementById('Present').each()
            })
        }) */

        $(document).ready(function() {
            $("#reload").on('click', function() {
                window.location.reload();
            })
        })

        $(document).ready(function() {
            $('#programID').on('change', function() {
                var id = $(this).val();
                var lecturer = $('#lecturer').val();
                var subject = $('#subject').val();
                $.ajax({
                    url: "programResponse.php",
                    type: "POST",
                    data: {
                        dataID: id,
                        lecturer: lecturer,
                        subject: subject
                    },
                    success: function(response) {
                        $("#response").html(response);
                        $('#attendanceForm').show();
                        $("#goBack-1").hide();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                })
            })
        })


        $(document).ready(function() {
            function updateCheckboxValues() {
                var attendanceData = [];
                $('input[type="checkbox"][name^="status_"]:checked').each(function() {
                    var studentId = $(this).data('student-id');
                    var status = $(this).val();
                    var studentStatusID = $(this).closest('td').find('.studentstatusID').val(); // Get the hidden input value in the same row
                    var studentQr = $(this).closest('td').find('.studentQr').val();
                    attendanceData.push({
                        studentId: studentId,
                        status: status,
                        studentStatusID: studentStatusID,
                        studentQr: studentQr
                    });
                });
                return attendanceData;
            }

            $('#all-presence').click(function() {
                $('input[type="checkbox"][name^="status_"]').prop('checked', false);
                // Check only checkboxes with the value "Present"
                $('input[type="checkbox"][name^="status_"][value="Present"]').prop('checked', true);
            });

            updateCheckboxValues();

            $('input[type="checkbox"][name^="status_"]').change(function() {
                var rowName = $(this).attr('name');
                if ($(this).is(':checked')) {
                    $('input[type="checkbox"][name="' + rowName + '"]').not(this).prop('checked', false);
                }
            });

            $('#attendanceForm').submit(function(e) {
                e.preventDefault();
                var attendanceData = updateCheckboxValues();
                var subject = $('#subject').val();
                var lecturer = $('#lecturer').val();
                var attDateIssue = $('#AttendanceDateIssues').val();
                var dateIssue = $('#DateIssue').val();
                var session = $('#session').val();

                // Optional: Validate form fields before submitting
                if (!subject || !lecturer || !attDateIssue || !dateIssue || !session) {
                    alert('Please fill in all required fields.');
                    return;
                }

                $.ajax({
                    type: 'POST',
                    url: 'submit_attendance.php',
                    data: {
                        attendance: attendanceData,
                        attDateIssue: attDateIssue,
                        subject: subject,
                        lecturer: lecturer,
                        dateIssue: dateIssue,
                        session: session
                    },
                    success: function(response) {
                        $('#return').show();
                        $('#return').html(response);

                        setTimeout(() => {
                            $('#return').hide();
                            window.location.reload();
                        }, 2000);
                    }
                });
            });
        });




        /*
       from chatgpt

         $(document).ready(function() {
    // Function to update checkbox values
    function updateCheckboxValues() {
        var attendanceData = [];
        $('input[type="checkbox"][name^="status_"]:checked').each(function() {
            var studentId = $(this).data('student-id');
            var status = $(this).val();
            attendanceData.push({
                studentId: studentId,
                status: status
            });
        });
        return attendanceData;
    }

    // Function to handle 'All Presence' button click
    $('#all-presence').click(function() {
        $('input[type="checkbox"][name^="status_"]').prop('checked', false);
        $('input[type="checkbox"][name^="status_"][value="Present"]').prop('checked', true);
    });

    // Update checkbox values initially
    updateCheckboxValues();

    // Function to ensure only one checkbox is checked per student
    $('input[type="checkbox"][name^="status_"]').change(function() {
        var rowName = $(this).attr('name');
        if ($(this).is(':checked')) {
            $('input[type="checkbox"][name="' + rowName + '"]').not(this).prop('checked', false);
        }
    });

    // Function to handle form submission
    $('#attendanceForm').submit(function(e) {
        e.preventDefault();

        var attendanceData = updateCheckboxValues();
        var subject = $('#subject').val();
        var lecturer = $('#lecturer').val();
        var attDateIssue = $('#AttendanceDateIssues').val();
        var dateIssue = $('#DateIssue').val();
        var session = $('#session').val();

        // Simple form validation (add your own validation logic here)
        if (!subject || !lecturer || !attDateIssue || !dateIssue || !session) {
            alert('Please fill in all the required fields.');
            return;
        }

        $.ajax({
            type: 'POST',
            url: 'submit_attendance.php',
            data: {
                attendance: attendanceData,
                attDateIssue: attDateIssue,
                subject: subject,
                lecturer: lecturer,
                dateIssue: dateIssue,
                session: session
            },
            success: function(response) {
                $('#return').show();
                $('#return').html(response);

                setTimeout(() => {
                    $('#return').hide();
                    window.location.reload();
                }, 2000);
            }
        });
    });
});
*/
    </script>
</body>

</html>