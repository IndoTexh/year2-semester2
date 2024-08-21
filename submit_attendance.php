<?php
require "conn.php";

// Retrieve the data from the AJAX request
$attendance = $_POST['attendance'];
$attDateIssue = $_POST['attDateIssue'];
$subject = $_POST['subject'];
$lecturer = $_POST['lecturer'];
$DateIssue = $_POST['dateIssue'];
$session = $_POST["session"];

date_default_timezone_set('Asia/Phnom_Penh');
$localDate = date('Y-m-d'); // Current date
$timeIN = date('Y-m-d H:i:s'); // Current time

$yes = "";

foreach ($attendance as $record) {
    $studentStatusID = $record['studentStatusID'];
    $status = $record["status"];
    $studentID = $record["studentId"];
    $studentQr = $record["studentQr"];

    // Check if the attendance has already been recorded for today
    $select = mysqli_query($conn, "SELECT * FROM tblattendance WHERE StudentStatusID = '$studentStatusID' AND SubjectID = '$subject' AND LecturerID = '$lecturer' AND dateOfAtt = '$localDate'");

    if (mysqli_num_rows($select) > 0) {
        $yes = "The attendance for today has already been recorded!";
    } else {
        $yes = "Yet";

        // Insert attendance record if not recorded yet
        $insert = mysqli_query($conn, "INSERT INTO tblattendance (StudentStatusID, SubjectID, Attended, Section, LecturerID, DateIssue, AttendanceDateIssue, StudentID, studentQR, timeIn, dateOfAtt) VALUES ('$studentStatusID', '$subject', '$status', '$session', '$lecturer', '$DateIssue', '$attDateIssue', '$studentID', '$studentQr', '$timeIN', '$localDate')");

        if ($insert) {
            $yes = "Attendance recorded successfully!";
        } else {
            $yes = "Failed to record attendance: " . mysqli_error($conn);
        }
    }
}
echo $yes;


/*


old code
<?php
require "conn.php";

// Retrieve the data from the AJAX request
$attendance = $_POST['attendance'];
$attDateIssue = $_POST['attDateIssue'];
$subject = $_POST['subject'];
$lecturer = $_POST['lecturer'];
$DateIssue = $_POST['dateIssue'];
$session = $_POST["session"];

date_default_timezone_set('Asia/Phnom_Penh');
$timeIN = date('Y-m-d H:i:s');
$localTime = date('Y-m-d');
$success = 0;

$sql = "INSERT INTO tblattendance (StudentStatusID, SubjectID, Attended, Section, LecturerID, DateIssue, AttendanceDateIssue, StudentID, studentQR, timeIn, dateOfAtt) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

if ($stmt = $conn->prepare($sql)) {
    foreach ($attendance as $record) {
        $stmt->bind_param("sssssssssss", $record["studentStatusID"], $subject, $record['status'], $session, $lecturer, $DateIssue, $attDateIssue, $record['studentId'], $record["studentQr"], $timeIN, $localTime);

        $success++;

        if (!$stmt->execute()) {
            echo "Error: " . $stmt->error;
        }
    }

    echo "Attendance has been recorded!";
    $stmt->close();
} else {
    echo "Error preparing statement: " . $conn->error;
}

$conn->close();

*/