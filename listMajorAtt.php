<?php
require 'conn.php';
if (isset($_GET['majorId'])) {
    $majorID = $_GET["majorId"];

    $sql = mysqli_query($conn, "SELECT tblmajor.MajorKH, tblmajor.MajorEN, tblstudent.NameInKhmer, tblstudent.NameInLatin, SUM(CASE WHEN tblattendance.Attended = 'Present' THEN 1 ELSE 0 END) AS presentCount, SUM(CASE WHEN tblattendance.Attended = 'Absent' THEN 1 ELSE 0 END) AS absentCount FROM tblmajor INNER JOIN tblprogram ON tblmajor.MajorID = tblprogram.MajorID INNER JOIN tblstudentstatus ON tblprogram.ProgramID = tblstudentstatus.ProgramID INNER JOIN tblstudent ON tblstudentstatus.StudentID = tblstudent.StudentID INNER JOIN tblattendance ON tblstudentstatus.StudentStatusID = tblattendance.StudentStatusID WHERE tblmajor.MajorID = '$majorID' GROUP BY tblmajor.MajorKH, tblstudent.NameInKhmer, tblstudent.NameInLatin;");


    $output = "";

    if (mysqli_num_rows($sql) > 0) {
        while ($row = mysqli_fetch_assoc($sql)) {
            $output .= '
               <tr>
                  <td>' . $row['MajorEN'] . '</td>
                  <td>' . $row['NameInLatin'] . '</td>
                  <td>[P = ' . htmlspecialchars($row['presentCount']) . '] & [A = ' . htmlspecialchars($row['absentCount']) . ']</td>
               </tr>
            ';
        }

        echo $output;
    } else {
        echo "No attendance records were found within this Major";
    }
} else {
    echo "No attendance records were found within this Major";
}
