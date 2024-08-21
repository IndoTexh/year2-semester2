<?php
require 'conn.php';
require 'vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

if (isset($_POST['submitDate'])) {
    $date = $_POST["date"];

    $output = "";
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
                                 <th>Date</th>
                                <th>Name in English</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>';
    if (mysqli_num_rows($sql) > 0) {
        while ($row = mysqli_fetch_assoc($sql)) {
            $output .= '
                    <tr>
                                 <th>' . $row['DateIssue'] . '</th>
                                <th>' . $row['NameInLatin'] . '</th>
                                <td>[P = ' . htmlspecialchars($row['pCount']) . '] & [A = ' . htmlspecialchars($row['aCount']) . ']</td>
                    </tr>
            ';
        }
    } else {
        $output .= '<tr><td colspan="5">No records</td></tr>';
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

    $dompdf->stream('date.pdf', ["Attachment" => 0]);
}
