<?php
require 'conn.php';
require 'vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

if (isset($_POST['submitCampus'])) {
    $campusID = $_POST["campus"];

    $sql = mysqli_query($conn, "SELECT tblcampus.CampusEN, tblstudent.NameInLatin,
      SUM(CASE WHEN tblattendance.Attended = 'Present' THEN 1 ELSE 0 END) AS pCount, 
     SUM(CASE WHEN tblattendance.Attended = 'Absent' THEN 1 ELSE 0 END) AS aCount 
        FROM tblcampus
        INNER JOIN tblprogram on tblcampus.CampusID = tblprogram.CampusID
        INNER JOIN tblstudentstatus on tblprogram.ProgramID = tblstudentstatus.ProgramID
        INNER JOIN tblstudent on tblstudentstatus.StudentID = tblstudent.StudentID
        INNER JOIN tblattendance on tblstudentstatus.StudentStatusID = tblattendance.StudentStatusID
        WHERE tblcampus.CampusID = '$campusID' GROUP BY tblcampus.CampusKH, tblattendance.StudentStatusID;");


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
                                 <th>Campus</th>
                                 <th>Name in English</th>
                                 <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>';
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
        $output .= '<tr><td colspan="5">No attendance records within the campus</td></tr>';
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

    $dompdf->stream('campus.pdf', ["Attachment" => 0]);
}
