<!-- <?php
include("conn.php");

$lecturer = strtoupper($_POST["lecturerName"]);

$sql = mysqli_query($conn, "SELECT * FROM tblschedule WHERE UPPER(LecturerID) = '$lecturer'");

$select = mysqli_query($conn, "SELECT tblstudentstatus.StudentStatusID, tblstudentstatus.StudentID, tblstudent.NameInKhmer, tblstudent.NameInLatin, tblstudent.student_number 
                               FROM tblstudentstatus 
                               LEFT JOIN tblstudent ON tblstudentstatus.StudentID = tblstudent.StudentID");

$output = "";

// Check if there are schedules for the lecturer
if (mysqli_num_rows($sql) > 0) {
    // Fetch all student rows
    $students = [];
    while ($row = mysqli_fetch_assoc($select)) {
        $students[$row['StudentID']] = $row;
    }

    // Iterate over the schedule
    while ($scheduleRow = mysqli_fetch_assoc($sql)) {
        foreach ($students as $student) {
            $output .= ' <tr>
                            <td>' . $student["StudentStatusID"] . '</td>
                            <td>' . $student["student_number"] . '</td>
                            <td>' . $student["NameInLatin"] . '</td>
                            <td>' . $student["NameInKhmer"] . '</td>
                            <td>[A = 0] & [P = 0]</td>
                            <td><i class="fa-solid fa-pen-to-square"></i></td>
                            <td style="background:red;">
                                <input type="checkbox" name="status_' . $student["StudentID"] . '" value="Absent" data-student-id="' . $student["StudentID"] . '">
                            </td>
                            <td style="background:green;">
                                <input type="checkbox" name="status_' . $student["StudentID"] . '" value="Present" data-student-id="' . $student["StudentID"] . '">
                            </td>
                            <td>
                                <input type="checkbox" name="status_' . $student["StudentID"] . '" value="Session" data-student-id="' . $student["StudentID"] . '">
                            </td>
                        </tr>';
        }
    }
}


// Output the result
echo $output;
 -->