<?php
require 'conn.php';
$subject = $_POST["subject"];

$sql = mysqli_query($conn, "SELECT tblprogram.ProgramID, tbllecturer.LecturerName FROM tblstudentstatus INNER JOIN tblprogram on tblstudentstatus.ProgramID = tblprogram.ProgramID INNER JOIN tblschedule on tblprogram.ProgramID = tblschedule.AcademicProgramID INNER JOIN tbllecturer on tblschedule.LecturerID = tbllecturer.LecturerName WHERE tblschedule.SubjectID = '$subject'");

$lecturerData = mysqli_fetch_assoc($sql);

if ($lecturerData) {
  $select = "
        SELECT 
            tblstudentstatus.StudentStatusID, 
            tblstudentstatus.StudentID, 
            tblstudentstatus.ProgramID, 
            tblstudentstatus.Assigned, 
            tblstudentstatus.Note, 
            tblstudentstatus.AssignDate, 
            tblstudent.StudentID, 
            tblstudent.NameInLatin, 
            tblstudent.NameInKhmer, 
            tblstudent.student_number,
            SUM(CASE WHEN tblattendance.Attended = 'Present' AND tblattendance.LecturerID = ? AND tblattendance.SubjectID = ? THEN 1 ELSE 0 END) AS presentCount,
            SUM(CASE WHEN tblattendance.Attended = 'Absent' AND tblattendance.LecturerID = ? AND tblattendance.SubjectID = ? THEN 1 ELSE 0 END) AS absentCount
        FROM tblstudentstatus
        LEFT JOIN tblprogram ON tblstudentstatus.ProgramID = tblprogram.ProgramID 
        LEFT JOIN tblstudent ON tblstudentstatus.StudentID = tblstudent.StudentID 
        LEFT JOIN tblattendance ON tblstudentstatus.StudentStatusID = tblattendance.StudentStatusID
        WHERE tblstudentstatus.ProgramID = ?
        GROUP BY 
            tblstudentstatus.StudentStatusID, 
            tblstudent.StudentID, 
            tblstudent.NameInLatin, 
            tblstudent.NameInKhmer, 
            tblstudent.student_number
    ";

  $stmt = $conn->prepare($select);

  // Bind parameters
  $stmt->bind_param("sssss", $lecturerData['LecturerName'], $subject, $lecturerData['LecturerName'], $subject, $lecturerData['ProgramID']);

  $stmt->execute();

  $result = $stmt->get_result();

  $output = "";

  if ($result->num_rows > 0) {
    while ($studentData = $result->fetch_assoc()) {
      $output .= '
                <tr>

                    <td>' . htmlspecialchars($lecturerData["LecturerName"]) . '</td>
                    <td>' . $subject . '</td>
                    <td>' . htmlspecialchars($studentData["NameInLatin"]) . '</td>
                    <td>' . htmlspecialchars($studentData["NameInKhmer"]) . '</td>
                    <td>[P = ' . htmlspecialchars($studentData['presentCount']) . '] & [A = ' . htmlspecialchars($studentData['absentCount']) . ']</td>
                </tr>';
    }
  } else {
    $output = "No students within that program";
  }
} else {
  $output = "Lecturer not found or no matching subject.";
}

echo $output;


/*$select = mysqli_query($conn, "SELECT * FROM tblattendance WHERE DateIssue = '$date' OR SubjectID = '$subject'");
$output = "";

while ($row = mysqli_fetch_assoc($select)) {
  $output .= '
      <tr>
        <td>' . $row['AttendanceID'] . '</td>
        <td>' . $row['Attended'] . '</td>
        <td>' . $row['Section'] . '</td>
        <td>' . $row['SubjectID'] . '</td>
        <td>' . $row['LecturerID'] . '</td>
        <td>' . $row['StudentID'] . '</td>
        <td>' . $row['DateIssue'] . '</td>
        <td>' . $row['AttendanceDateIssue'] . '</td>
        <td>' . $row['timeIn'] . '</td>
      </tr>
    ';
}

echo $output;
*/
