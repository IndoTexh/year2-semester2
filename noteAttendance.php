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

    <form id="attendanceForm">
        <input type="hidden" id="subject" value="<?php echo htmlspecialchars($subject); ?>">
        <input type="hidden" id="lecturer" value="<?php echo htmlspecialchars($lecturer); ?>">
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
                <tbody>
                    <?php
                    $select = mysqli_query($conn, "SELECT tblstudentstatus.StudentStatusID, tblstudentstatus.StudentID, tblstudent.NameInKhmer,tblstudent.NameInLatin,tblstudent.student_number from tblstudentstatus LEFT JOIN tblstudent on tblstudentstatus.StudentID = tblstudent.StudentID;");
                    if (mysqli_num_rows($select) > 0) {
                        while ($row = mysqli_fetch_assoc($select)) {
                    ?>
                            <tr>
                                <td><?php echo $row["StudentStatusID"] ?></td>
                                <td><?php echo $row["student_number"] ?></td>
                                <td><?php echo $row["NameInLatin"] ?></td>
                                <td><?php echo $row["NameInKhmer"] ?></td>
                                <td>[A = 0] & [P = 0]</td>
                                <td><i class="fa-solid fa-pen-to-square"></i></td>
                                <td style="background:red;">
                                    <input type="checkbox" name="status_<?php echo $row["StudentID"] ?>" value="Absent" data-student-id="<?php echo $row["StudentID"] ?>">
                                </td>
                                <td style="background:green;">
                                    <input type="checkbox" name="status_<?php echo $row["StudentID"] ?>" value="Present" data-student-id="<?php echo $row["StudentID"] ?>" id="present">
                                </td>
                                <td>
                                    <input type="checkbox" name="status_<?php echo $row["StudentID"] ?>" value="Stop" data-student-id="<?php echo $row["StudentID"] ?>">
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
            </table>

        </div>
        <button type="submit" class="btn btn-primary" style="margin-bottom: 20px;">Submit Attendance</button>
        <button type="button" class="btn btn-primary" id="all-presence">All presence</button>
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
    </form>

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script>
        /*  $(document).ready(function() {
            $('#all-presence').on('click', function() {

                document.getElementById('Present').each()
            })
        }) */

        $(document).ready(function() {
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
                var DateIssue = $('#DateIssue').val();
                var session = $('#session').val();
                alert(attDateIssue + ' ' + DateIssue);

                $.ajax({
                    type: 'POST',
                    url: 'submit_attendance.php',
                    data: {
                        attendance: attendanceData,
                        attDateIssue: attDateIssue,
                        subject: subject,
                        lecturer: lecturer,
                        DateIssue: DateIssue,
                        session: session
                    },
                    success: function(response) {
                        $('#return').show();
                        $('#return').html(response);

                        setTimeout(() => {
                            $('#return').hide();
                            window.location.reload();
                        }, 2000)
                    }
                })

            });

        })
    </script>
</body>

</html>