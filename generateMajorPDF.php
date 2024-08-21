<?php
require 'conn.php';
require 'vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

if (isset($_POST['submitMajor'])) {
    $majorID = $_POST["major"];

    $sql = mysqli_query($conn, "SELECT 
        tblmajor.MajorKH,
        tblmajor.MajorEN,
        tblstudent.NameInKhmer, 
        tblstudent.NameInLatin,
        SUM(CASE WHEN tblattendance.Attended = 'Present' THEN 1 ELSE 0 END) AS presentCount,
        SUM(CASE WHEN tblattendance.Attended = 'Absent' THEN 1 ELSE 0 END) AS absentCount
    FROM 
        tblmajor 
    INNER JOIN 
        tblprogram ON tblmajor.MajorID = tblprogram.MajorID 
    INNER JOIN 
        tblstudentstatus ON tblprogram.ProgramID = tblstudentstatus.ProgramID 
    INNER JOIN 
        tblstudent ON tblstudentstatus.StudentID = tblstudent.StudentID 
    INNER JOIN 
        tblattendance ON tblstudent.NameInLatin = tblattendance.StudentID 
    WHERE 
        tblmajor.MajorID = '$majorID'
    GROUP BY 
        tblmajor.MajorKH, 
        tblmajor.MajorEN,
        tblstudent.NameInKhmer, 
        tblstudent.NameInLatin;");

    $output = '<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>';
    $output .= '<style>
                    table {
                        width: 100%;
                        border-collapse: collapse;
                    }
                    th, td {
                        border: 1px solid black;
                        padding: 10px;
                        font-size: 12px;
                    }
                    th {
                        background-color: #f2f2f2;
                    }
                </style>';

    $output .= '<table>';
    $output .= '
                    <thead>
                        <tr>
                            <th>Major</th>
                            <th>Name in Latin</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>';

    if (mysqli_num_rows($sql) > 0) {
        while ($row = mysqli_fetch_assoc($sql)) {
            $output .= '
                                <tr>
                                  <td>' . htmlspecialchars($row['MajorEN']) . '</td>
                                  <td>' . htmlspecialchars($row['NameInLatin']) . '</td>
                                   <td>[P = ' . htmlspecialchars($row['presentCount']) . '] & [A = ' . htmlspecialchars($row['absentCount']) . ']</td>
                                </tr>
                            ';
        }
    } else {
        $output .= '<tr><td colspan="4">No students within that Major</td></tr>';
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

    $dompdf->stream('major.pdf', ["Attachment" => 0]);
}
