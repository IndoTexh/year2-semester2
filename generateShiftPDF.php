<?php
require 'conn.php';
require 'vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

if (isset($_POST["submitShift"])) {
    $shiftID = $_POST["shift"];


    $sql = mysqli_query($conn, "SELECT tblshift.ShiftEN, tblstudent.NameInLatin, SUM(CASE WHEN tblattendance.Attended = 'Present' THEN 1 ELSE 0 END) AS presentCount, SUM(CASE WHEN tblattendance.Attended = 'Absent' THEN 1 ELSE 0 END) AS absentCount FROM tblshift INNER JOIN tblprogram on tblshift.ShiftID = tblprogram.ShiftID INNER JOIN tblstudentstatus on tblprogram.ProgramID = tblstudentstatus.ProgramID INNER JOIN tblattendance on tblstudentstatus.StudentStatusID = tblattendance.StudentStatusID INNER JOIN tblstudent on tblstudentstatus.StudentID = tblstudent.StudentID WHERE tblshift.ShiftID = '$shiftID' GROUP BY tblattendance.StudentStatusID;");

    $output = '<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>';
    $output .= '<style>
                    table {
                        width: 100%;
                        border-collapse: collapse;
                    }
                    th, td {
                        border: 1px solid black;
                        padding: 10px;
                        font-size: 14px;
                    }
                    th {
                        background-color: #f2f2f2;
                    }
                </style>';

    $output .= '<table>';
    $output .= '
                    <thead>
                        <tr>
                         <th>Shift</th>
                         <th>Name in English</th>
                          <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>';
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
        $output .= '<tr><td colspan="5">No students within that program</td></tr>';
    }
    $output .= '</tbody></table>';

    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isRemoteEnabled', true);
    $options->set('defaultFont', 'DejaVu Sans');

    $dompdf = new Dompdf($options);
    $dompdf->loadHtml($output);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    $dompdf->stream('shift.pdf', ["Attachment" => 0]);
}
