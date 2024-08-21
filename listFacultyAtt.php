<?php
require 'conn.php';
if (isset($_GET["facultyID"])) {
    $facultyID = $_GET["facultyID"];

    $sql = mysqli_query($conn, "SELECT 
    tblfaculty.FacultyEN, 
    tblstudent.NameInLatin, 
    SUM(CASE WHEN tblattendance.Attended = 'Present' THEN 1 ELSE 0 END) AS pCount, 
    SUM(CASE WHEN tblattendance.Attended = 'Absent' THEN 1 ELSE 0 END) AS aCount 
    FROM tblfaculty 
    INNER JOIN tblmajor on tblfaculty.FacultyID = tblmajor.FacultyID 
    INNER JOIN tblprogram on tblmajor.MajorID = tblprogram.MajorID 
    INNER JOIN tblstudentstatus on tblprogram.ProgramID = tblstudentstatus.ProgramID 
    INNER JOIN tblstudent on tblstudentstatus.StudentID = tblstudent.StudentID 
    INNER JOIN tblattendance on tblstudentstatus.StudentStatusID = tblattendance.StudentStatusID 
    WHERE tblfaculty.FacultyID = '$facultyID' 
    GROUP BY tblattendance.StudentStatusID");

    $output = "";

    if (mysqli_num_rows($sql) > 0) {
        while ($row = mysqli_fetch_assoc($sql)) {
            $output .= '
                 <tr>
                  <td>' . $row['FacultyEN'] . '</td>
                  <td>' . $row['NameInLatin'] . '</td>
                  <td>[P = ' . htmlspecialchars($row['pCount']) . '] & [A = ' . htmlspecialchars($row['aCount']) . ']</td>
               </tr>
            ';
        }
    } else {
        echo "No attendance records were found within this Faculty";
    }
}
echo $output;
