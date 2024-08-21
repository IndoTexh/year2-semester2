<?php
require 'conn.php';

if (isset($_GET['date'])) {
    $date = $_GET['date'];
    $interval = '';

    switch ($date) {
        case 'day':
            $interval = '1 DAY';
            break;
        case 'week':
            $interval = '1 WEEK';
            break;
        case 'month':
            $interval = '1 MONTH';
            break;
        default:
            $interval = '1 YEAR';
            break;
    }

    $sql = mysqli_query($conn, "
        SELECT 
            tblstudent.NameInLatin, 
            tblattendance.DateIssue, 
            SUM(CASE WHEN tblattendance.Attended = 'Present' THEN 1 ELSE 0 END) AS pCount, 
            SUM(CASE WHEN tblattendance.Attended = 'Absent' THEN 1 ELSE 0 END) AS aCount 
        FROM 
            tblfaculty 
            INNER JOIN tblmajor ON tblfaculty.FacultyID = tblmajor.FacultyID 
            INNER JOIN tblprogram ON tblmajor.MajorID = tblprogram.MajorID 
            INNER JOIN tblstudentstatus ON tblprogram.ProgramID = tblstudentstatus.ProgramID 
            INNER JOIN tblstudent ON tblstudentstatus.StudentID = tblstudent.StudentID 
            INNER JOIN tblattendance ON tblstudentstatus.StudentStatusID = tblattendance.StudentStatusID 
        WHERE 
            tblattendance.DateIssue >= CURDATE() - INTERVAL $interval 
        GROUP BY 
            tblattendance.StudentStatusID;
    ");

    $output = "";
    if (mysqli_num_rows($sql) > 0) {
        while ($row = mysqli_fetch_assoc($sql)) {
            $output .= '
                <tr>
                    <td>' . htmlspecialchars($row['NameInLatin']) . '</td>
                    <td>' . htmlspecialchars($row['DateIssue']) . '</td>
                    <td>[P = ' . htmlspecialchars($row['pCount']) . '] & [A = ' . htmlspecialchars($row['aCount']) . ']</td>
                </tr>
            ';
        }
    } else {
        echo 'No attendance records';
    }

    echo $output;
}
