<?php
require 'conn.php';

$id = $_POST["dataID"];
$lecturer = $_POST["lecturer"]; // Add lecturer parameter
$subject = $_POST["subject"];   // Add subject parameter

// SQL query to fetch student data with attendance counts, filtering by lecturer and subject
$sql = "
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

// Initialize the prepared statement
$stmt = $conn->prepare($sql);

// Bind parameters
$stmt->bind_param("sssss", $lecturer, $subject, $lecturer, $subject, $id);

// Execute the statement
$stmt->execute();

// Get the result
$result = $stmt->get_result();

$output = "";

// Check if any rows are returned
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $output .= '
            <tr>
                <td>' . htmlspecialchars($row["StudentStatusID"]) . '</td>
                <td>' . htmlspecialchars($row["student_number"]) . '</td>
                <td>' . htmlspecialchars($row["NameInLatin"]) . '</td>
                <td>' . htmlspecialchars($row["NameInKhmer"]) . '</td>
                <td>[A = ' . htmlspecialchars($row['presentCount']) . '] & [P = ' . htmlspecialchars($row['absentCount']) . ']</td>
                <td><i class="fa-solid fa-pen-to-square"></i></td>
                <td style="background:red;">
                    <input type="hidden" class="studentstatusID" value="' . htmlspecialchars($row["StudentStatusID"]) . '">
                    <input type="hidden" class="studentQr" value="' . htmlspecialchars($row["student_number"]) . '">
                    <input type="checkbox" name="status_' . htmlspecialchars($row["NameInLatin"]) . '" value="Absent" data-student-id="' . htmlspecialchars($row["NameInLatin"]) . '">
                </td>
                <td style="background:green;">
                    <input type="hidden" class="studentstatusID" value="' . htmlspecialchars($row["StudentStatusID"]) . '">
                    <input type="hidden" class="studentQr" value="' . htmlspecialchars($row["student_number"]) . '">
                    <input type="checkbox" name="status_' . htmlspecialchars($row["NameInLatin"]) . '" value="Present" data-student-id="' . htmlspecialchars($row["NameInLatin"]) . '" id="present">
                </td>
                <td>
                    <input type="hidden" class="studentstatusID" value="' . htmlspecialchars($row["StudentStatusID"]) . '">
                    <input type="hidden" class="studentQr" value="' . htmlspecialchars($row["student_number"]) . '">
                    <input type="checkbox" name="status_' . htmlspecialchars($row["NameInLatin"]) . '" value="Stop" data-student-id="' . htmlspecialchars($row["NameInLatin"]) . '">
                </td>
            </tr>';
    }
} else {
    $output = "No students within that program";
}

echo $output;

// Close the statement and connection
$stmt->close();
$conn->close();


/*
old code
<?php
require 'conn.php';

$id = $_POST["dataID"];

// Prepare the SQL statement
$sql = "SELECT tblstudentstatus.StudentStatusID, tblstudentstatus.StudentID, tblstudentstatus.ProgramID, tblstudentstatus.Assigned, tblstudentstatus.Note, tblstudentstatus.AssignDate, tblstudent.StudentID, tblstudent.NameInLatin, tblstudent.NameInKhmer, tblstudent.student_number 
        FROM tblstudentstatus 
        LEFT JOIN tblprogram ON tblstudentstatus.ProgramID = tblprogram.ProgramID 
        LEFT JOIN tblstudent ON tblstudentstatus.StudentID = tblstudent.StudentID 
        WHERE tblstudentstatus.ProgramID = ?";

// Initialize the prepared statement
$stmt = mysqli_prepare($conn, $sql);

// Bind parameters
mysqli_stmt_bind_param($stmt, "s", $id);

// Execute the statement
mysqli_stmt_execute($stmt);

// Get the result
$result = mysqli_stmt_get_result($stmt);

$output = "";

// Check if any rows are returned
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $output .= '
            <tr>
                <td>' . htmlspecialchars($row["StudentStatusID"]) . '</td>
                <td>' . htmlspecialchars($row["student_number"]) . '</td>
                <td>' . htmlspecialchars($row["NameInLatin"]) . '</td>
                <td>' . htmlspecialchars($row["NameInKhmer"]) . '</td>
                <td>[A = 0] & [P = 0]</td>
                <td><i class="fa-solid fa-pen-to-square"></i></td>
                <td style="background:red;">
                    <input type="hidden" class="studentstatusID" value="' . htmlspecialchars($row["StudentStatusID"]) . '">
                    <input type="hidden" class="studentQr" value="' . htmlspecialchars($row["student_number"]) . '">
                    <input type="checkbox" name="status_' . htmlspecialchars($row["NameInLatin"]) . '" value="Absent" data-student-id="' . htmlspecialchars($row["NameInLatin"]) . '">
                </td>
                <td style="background:green;">
                    <input type="hidden" class="studentstatusID" value="' . htmlspecialchars($row["StudentStatusID"]) . '">
                    <input type="hidden" class="studentQr" value="' . htmlspecialchars($row["student_number"]) . '">
                    <input type="checkbox" name="status_' . htmlspecialchars($row["NameInLatin"]) . '" value="Present" data-student-id="' . htmlspecialchars($row["NameInLatin"]) . '" id="present">
                </td>
                <td>
                    <input type="hidden" class="studentstatusID" value="' . htmlspecialchars($row["StudentStatusID"]) . '">
                    <input type="hidden" class="studentQr" value="' . htmlspecialchars($row["student_number"]) . '">
                    <input type="checkbox" name="status_' . htmlspecialchars($row["NameInLatin"]) . '" value="Stop" data-student-id="' . htmlspecialchars($row["NameInLatin"]) . '">
                </td>
            </tr>';
    }
} else {
    $output = "No students within that program";
}

echo $output;

// Close the statement and connection
mysqli_stmt_close($stmt);
mysqli_close($conn);

*/