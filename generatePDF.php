<?php

require 'conn.php';
require 'vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

if (isset($_POST["submit"])) {
    $subject = $_POST["subject"];

    $sql = mysqli_query($conn, "SELECT tblprogram.ProgramID, tbllecturer.LecturerName, tblschedule.LecturerID 
                                FROM tblstudentstatus 
                                INNER JOIN tblprogram ON tblstudentstatus.ProgramID = tblprogram.ProgramID 
                                INNER JOIN tblschedule ON tblprogram.ProgramID = tblschedule.AcademicProgramID 
                                INNER JOIN tbllecturer ON tblschedule.LecturerID = tbllecturer.LecturerName 
                                WHERE tblschedule.SubjectID = '$subject' LIMIT 1;");

    $lecturerData = mysqli_fetch_assoc($sql);

    if ($lecturerData) {
        $select = "
            SELECT 
                tblstudentstatus.StudentStatusID, 
                tblstudentstatus.StudentID, 
                tblstudentstatus.ProgramID, 
                tblstudentstatus.Assigned, 
                tblstudentstatus.Note, 
                tblstudentstatus.AssignDate, 
                tblstudent.StudentID, 
                tblstudent.NameInLatin, 
                tblstudent.NameInKhmer, 
                tblstudent.student_number,
                SUM(CASE WHEN tblattendance.Attended = 'Present' AND tblattendance.LecturerID = ? AND tblattendance.SubjectID = ? THEN 1 ELSE 0 END) AS presentCount,
                SUM(CASE WHEN tblattendance.Attended = 'Absent' AND tblattendance.LecturerID = ? AND tblattendance.SubjectID = ? THEN 1 ELSE 0 END) AS absentCount
            FROM tblstudentstatus
            LEFT JOIN tblprogram ON tblstudentstatus.ProgramID = tblprogram.ProgramID 
            LEFT JOIN tblstudent ON tblstudentstatus.StudentID = tblstudent.StudentID 
            LEFT JOIN tblattendance ON tblstudentstatus.StudentStatusID = tblattendance.StudentStatusID
            WHERE tblstudentstatus.ProgramID = ?
            GROUP BY 
                tblstudentstatus.StudentStatusID, 
                tblstudent.StudentID, 
                tblstudent.NameInLatin, 
                tblstudent.NameInKhmer, 
                tblstudent.student_number
        ";

        $stmt = $conn->prepare($select);

        // Bind parameters
        $stmt->bind_param("sssss", $lecturerData['LecturerName'], $subject, $lecturerData['LecturerName'], $subject, $lecturerData['ProgramID']);

        $stmt->execute();

        $result = $stmt->get_result();

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
                    <th>Lecturer Name</th>
                    <th>Subject</th>
                    <th>Name In Latin</th>
                    <th>Name In Khmer</th>
                    <th>Attendance</th>
                </tr>
            </thead>
            <tbody>';

        if ($result->num_rows > 0) {
            while ($studentData = $result->fetch_assoc()) {
                $output .= '
                    <tr>
                        <td>' . htmlspecialchars($lecturerData["LecturerName"]) . '</td>
                        <td>' . htmlspecialchars($subject) . '</td>
                        <td>' . htmlspecialchars($studentData["NameInLatin"]) . '</td>
                        <td>[P = ' . htmlspecialchars($studentData['presentCount']) . '] & [A = ' . htmlspecialchars($studentData['absentCount']) . ']</td>
                    </tr>';
            }
        } else {
            $output .= '<tr><td colspan="5">No students within that program</td></tr>';
        }

        $output .= '</tbody></table>';
    } else {
        $output = '<p>Lecturer not found or no matching subject.</p>';
    }

    // Initialize Dompdf and render the PDF
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isRemoteEnabled', true);
    $options->set('defaultFont', 'DejaVu Sans'); // Use a font that supports Khmer characters

    $dompdf = new Dompdf($options);
    $dompdf->loadHtml($output);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    // Stream the PDF to the browser
    $dompdf->stream("attendance_report.pdf", ["Attachment" => 0]);
}
