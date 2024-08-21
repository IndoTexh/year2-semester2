<?php
require 'conn.php';
if (isset($_GET['campusID'])) {
    $campusID = $_GET["campusID"];

    $sql = mysqli_query($conn, "SELECT tblcampus.CampusEN, tblstudent.NameInLatin,
      SUM(CASE WHEN tblattendance.Attended = 'Present' THEN 1 ELSE 0 END) AS pCount, 
     SUM(CASE WHEN tblattendance.Attended = 'Absent' THEN 1 ELSE 0 END) AS aCount 
        FROM tblcampus
        INNER JOIN tblprogram on tblcampus.CampusID = tblprogram.CampusID
        INNER JOIN tblstudentstatus on tblprogram.ProgramID = tblstudentstatus.ProgramID
        INNER JOIN tblstudent on tblstudentstatus.StudentID = tblstudent.StudentID
        INNER JOIN tblattendance on tblstudentstatus.StudentStatusID = tblattendance.StudentStatusID
        WHERE tblcampus.CampusID = '$campusID' GROUP BY tblcampus.CampusKH, tblattendance.StudentStatusID;");

    $output = "";
    if (mysqli_num_rows($sql) > 0) {
        while ($row = mysqli_fetch_assoc($sql)) {
            $output .= '
            <tr>
              <td>' . $row['CampusEN'] . '</td>
              <td>' . $row['NameInLatin'] . '</td>
              <td>[P = ' . htmlspecialchars($row['pCount']) . '] & [A = ' . htmlspecialchars($row['aCount']) . ']</td>
            </tr>
        ';
        }
    } else {
        echo "No attendance records were found within campus $campusID";
    }
}
echo $output;
