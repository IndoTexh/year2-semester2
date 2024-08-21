<?php
require 'conn.php';

if (isset($_GET['shiftID'])) {
    $shiftID = $_GET["shiftID"];

    $sql = mysqli_query($conn, "SELECT tblshift.ShiftEN, tblstudent.NameInLatin, SUM(CASE WHEN tblattendance.Attended = 'Present' THEN 1 ELSE 0 END) AS presentCount, SUM(CASE WHEN tblattendance.Attended = 'Absent' THEN 1 ELSE 0 END) AS absentCount FROM tblshift INNER JOIN tblprogram on tblshift.ShiftID = tblprogram.ShiftID INNER JOIN tblstudentstatus on tblprogram.ProgramID = tblstudentstatus.ProgramID INNER JOIN tblattendance on tblstudentstatus.StudentStatusID = tblattendance.StudentStatusID INNER JOIN tblstudent on tblstudentstatus.StudentID = tblstudent.StudentID WHERE tblshift.ShiftID = '$shiftID' GROUP BY tblattendance.StudentStatusID;");

    $output = "";

    if (mysqli_num_rows($sql) > 0) {
        while ($row = mysqli_fetch_assoc($sql)) {
            $output .= '
              <tr>
                 <td>' . $row['ShiftEN'] . '</td>
                 <td>' . $row['NameInLatin'] . '</td>
                 <td>[P = ' . htmlspecialchars($row['presentCount']) . '] & [A = ' . htmlspecialchars($row['absentCount']) . ']</td>
              </tr>
            ';
        }
    } else {
        echo "No students were found within this Shift!";
    }
}
echo $output;
