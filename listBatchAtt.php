<?php
require 'conn.php';
if (isset($_GET['batchID'])) {
    $batchID = $_GET['batchID'];

    $sql = mysqli_query($conn, "SELECT 
    tblbatch.BatchEN, 
    tblbatch.BatchKH,
     tblstudent.NameInLatin, 
     tblstudentstatus.StudentStatusID, 
     SUM(CASE WHEN tblattendance.Attended = 'PreSent' THEN 1 ELSE 0 END) AS pCount, 
     SUM(CASE WHEN tblattendance.Attended = 'AbSent' THEN 1 ELSE 0 END) AS aCount 
     FROM tblbatch 
     INNER JOIN tblprogram on tblbatch.BatchID = tblprogram.BatchID 
     INNER JOIN tblstudentstatus on tblprogram.ProgramID = tblstudentstatus.ProgramID 
     INNER JOIN tblstudent on tblstudentstatus.StudentID = tblstudent.StudentID 
     INNER JOIN tblattendance on tblstudentstatus.StudentStatusID = tblattendance.StudentStatusID 
     WHERE tblbatch.BatchID = '$batchID' 
     GROUP BY tblbatch.BatchKH, tblstudentstatus.StudentStatusID");

    $output = "";
    if (mysqli_num_rows($sql) > 0) {
        while ($row = mysqli_fetch_assoc($sql)) {
            $output .= '
                <tr>
                  <td>' . $row['BatchEN'] . '</td>
                  <td>' . $row['NameInLatin'] . '</td>
                  <td>[P = ' . htmlspecialchars($row['pCount']) . '] & [A = ' . htmlspecialchars($row['aCount']) . ']</td>
                </tr>
            ';
        }
    } else {
        echo "No attendance records were found within batch $batchID";
    }
}

echo $output;
