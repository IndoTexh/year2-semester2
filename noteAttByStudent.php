<?php
include("conn.php");
session_start();
if (isset($_POST["lecturerQR"])) {
    $lecturerQR = $_POST["lecturerQR"];
    $studentStatusID = $_POST["studentStatusID"];
    $StudentID = $_POST["StudentID"];
    $student_number = $_POST["student_number"];


    date_default_timezone_set('Asia/Phnom_Penh');
    $localTime = date('Y-m-d');
    $timeIn = date('Y-m-d H:i:s');
    $currentDay = date('l');
    $status = "Present";

    $sql = mysqli_query($conn, "SELECT tbllecturer.LecturerID, tbllecturer.LecturerName, tbllecturer.lecturer_number, tblschedule.SubjectID, tblschedule.LecturerID, tblschedule.days FROM tbllecturer LEFT JOIN tblschedule on tbllecturer.LecturerName = tblschedule.LecturerID where tbllecturer.lecturer_number = '$lecturerQR' AND tblschedule.days = '$currentDay'");

    if ($row = mysqli_fetch_array($sql)) {

        $select = mysqli_query($conn, "SELECT * FROM tblattendance WHERE StudentStatusID = '$studentStatusID' AND SubjectID = '$row[SubjectID]' AND LecturerID = '$row[LecturerID]' AND dateOfAtt = '$localTime'");

        $validate = mysqli_query($conn, "SELECT * FROM tblschedule WHERE SubjectID = '$row[SubjectID]' AND LecturerID = '$row[LecturerID]' AND days = '$currentDay'");

        if (mysqli_num_rows($validate) < 1) {
            echo "<script>
                    alert('There is no $currenday class in schedule!');
                    window.location.href  = 'authorizeStudent.php';
                </script>";
            exit();
        }

        if (mysqli_num_rows($select) > 0) {
            echo "<script>
                    alert('Your attendance recorded already!');
                    window.location.href  = 'authorizeStudent.php';
                </script>";
            exit();
        }

        $insert = mysqli_query($conn, "INSERT INTO tblattendance (StudentStatusID, SubjectID, Attended,LecturerID, StudentID, studentQR, timeIn, dateOfAtt) VALUES ('$studentStatusID', '$row[SubjectID]', '$status', '$row[LecturerID]', '$StudentID', '$student_number', '$timeIn', '$localTime')");

        if ($insert) {
            echo "<script>
                alert('$StudentID, Your attendance has been recorded');
                window.location.href  = 'authorizeStudent.php';
            </script>";
        } else {
            $_SESSION["status"] = "Unable to record!";
            $_SESSION["status_code"] = "error";
            header('location: authorizeStudent.php');
        }
    } else {
        echo "
           <script>
              alert('No $currentDay class based on the schedule!')
              window.location.href  = 'authorizeStudent.php';
           </script>
         ";
    }
    /* 


    // Select the student information based on the student QR code (studentID)
    $select = mysqli_query($conn, "SELECT NameInLatin FROM tblstudent WHERE student_number = '$id'");

    if ($row = mysqli_fetch_assoc($select)) {
        $studentName = $row['NameInLatin'];

        // Insert attendance record
        $sql = "INSERT INTO tblattendance (SubjectID, Attended, Section, LecturerID, StudentID, studentQR, timeIn, dateOfAtt) 
                VALUES ('$subject', '$status', '$session', '$lecturer', '$studentName', '$id', '$localTime', '$dateOfAtt')";

        if (mysqli_query($conn, $sql)) {
            $_SESSION["stat"] = "Your attendance has been recorded";
            $_SESSION["stat_code"] = "success";
            header('location: authorizeStudent.php');
        } else {
            $_SESSION["stat"] = "Unable to record!";
            $_SESSION["stat_code"] = "error";
            header('location: authorizeStudent.php');
        }
    } else {
        echo "Student not found.";
    } */
    /* echo "Student ID: " . htmlspecialchars($id) . "<br>";
    echo "Subject: " . htmlspecialchars($subject) . "<br>";
    echo "Lecturer: " . htmlspecialchars($lecturer) . "<br>";
    echo "Session: " . htmlspecialchars($session); */
}
