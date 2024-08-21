<?php
include("conn.php");
session_name('admin_session');
session_start();
if (!isset($_SESSION["authenticated"]) || $_SESSION["authenticated"] !== true) {
    $_SESSION["status"] = "You are not authorized to see that page unless you are not log in";
    $_SESSION["status_code"] = "warning";
    header("location:index.php");
    exit();
}

$program_id = $_POST["program_data"];
$reult = mysqli_query($conn, "SELECT tblstudentstatus.StudentStatusID,tblstudentstatus.Assigned,tblstudentstatus.Note,tblstudentstatus.AssignDate,tblstudent.StudentID,tblstudent.NameInKhmer,tblstudent.NameInLatin FROM tblstudentstatus
LEFT JOIN tblstudent on tblstudentstatus.StudentID = tblstudent.StudentID WHERE ProgramID = '$program_id'");
$output = "";

$select = mysqli_query($conn, "SELECT * FROM tblstudentstatus");
$rows = mysqli_fetch_assoc($select);
/* if ($program_id !== $rows["ProgramID"]) {
    $output .= "<td>No student found within this program</td>";
} else {
    while ($row = mysqli_fetch_assoc($reult)) {

        $output .= '<tr>
            <td> <input type="checkbox" name="assign" id="assign" value="' . $row["StudentID"] . '"/></td>
            <td>' . $row['StudentID'] . '</td>
            <td>' . $row['NameInKhmer'] . '</td>
            <td>' . $row['NameInLatin'] . '</td>
            <td>' . $row['Assigned'] . '</td>
    </tr>';
    }
} */
while ($row = mysqli_fetch_assoc($reult)) {
    $output .= '<tr>
        <td> <input type="checkbox" name="assign" id="assign" value="' . $row["StudentID"] . '"/></td>
        <td>' . $row['StudentID'] . '</td>
        <td>' . $row['NameInKhmer'] . '</td>
        <td>' . $row['NameInLatin'] . '</td>
        <td>' . $row['Assigned'] . '</td>
</tr>';
}
echo $output;
