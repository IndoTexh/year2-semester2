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

if (isset($_POST["submit"])) {
    $studentID = $_POST["studentID"];
    $programID = $_POST["programID"];
    $assign = $_POST["assigned"];
    $note = $_POST["note"];
    $assignedDate = $_POST["assignedDate"];

    if (empty($studentID) || empty($programID) || empty($assignedDate) || empty($assign)) {
        $_SESSION["status"] = "Please fill all the requirements";
        $_SESSION["status_code"] = "warning";
        header("location:statusForm.php");
        exit();
    }

    $insert_query = mysqli_query($conn, "INSERT INTO tblstudentstatus (StudentID,ProgramID,Assigned,Note,AssignDate) VALUES ('$studentID', '$programID', '$assign', '$note', '$assignedDate')");

    if ($insert_query) {
        $_SESSION["status"] = "Student status has been added";
        $_SESSION["status_code"] = "success";
        header("location:status.php");
    } else {
        $_SESSION["status"] = "Unable to add";
        $_SESSION["status_code"] = "error";
        header("location:statusForm.php");
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ProgramID = $_POST["programID"];
    $status = "Assign";
    $note = $_POST["note"];
    $date = $_POST["date"];
    $student = $_POST["student"];

    $success = 0;
    $failed = 0;

    mysqli_begin_transaction($conn);
    try {
        foreach ($student as $studentID) {
            $sql1 = "INSERT INTO tblstudentstatus (StudentID,ProgramID,Assigned,Note,AssignDate) VALUES (?,?,?,?,?)";
            $stm1 = mysqli_prepare($conn, $sql1);
            mysqli_stmt_bind_param($stm1, "sssss", $studentID, $ProgramID, $status, $note, $date);

            if (!mysqli_stmt_execute($stm1)) {
                throw new Exception('Error inserting into tblstudentstatus');
            }

            $sql2 = "INSERT INTO newstatus (StudentID,ProgramID,Assigned,Note,AssignDate) VALUES (?,?,?,?,?)";
            $stm2 = mysqli_prepare($conn, $sql2);
            mysqli_stmt_bind_param($stm2, "sssss", $studentID, $ProgramID, $status, $note, $date);
            $success++;
            if (!mysqli_stmt_execute($stm2)) {
                throw new Exception('Error inserting into tblstudentstatus');
            }
        }

        echo "$success students has been added to new program";
        mysqli_commit($conn);
    } catch (Exception $e) {
        mysqli_rollback($conn);

        echo "Error: " . $e->getMessage();

        $failed++;
    }

    if (isset($stm1)) {
        mysqli_stmt_close($stm1);
    }
    if (isset($stm2)) {
        mysqli_stmt_close($stm2);
    }
    mysqli_close($conn);
} else {
    echo "Form data not submitted.";
}

/* $id = $_GET["updateID"];
$select = mysqli_query($conn, "SELECT * FROM tblstudentstatus WHERE StudentStatusID = '$id'");
$rows = mysqli_fetch_assoc($select);

if (isset($_POST["update"])) {

    $id = $_POST["update_statusID"];
    $update_studentID = $_POST["update_studentID"];
    $update_programID = $_POST["update_programID"];
    $assign = $_POST["update_assigned"];
    $update_note = $_POST["update_note"];
    $update_assignedDate = $_POST["update_assignedDate"];

    $update_query = mysqli_query($conn, "UPDATE tblstudentstatus SET StudentID = '$update_studentID', ProgramID = '$update_programID', Assigned = '$assign', Note = '$update_note', AssignDate = '$update_assignedDate' WHERE StudentStatusID = '$id'");

    if ($update_query) {
        $_SESSION["status"] = "Student status has been updated";
        $_SESSION["status_code"] = "success";
        header("location:status.php");
    } else {
        $_SESSION["status"] = "Unable to update";
        $_SESSION["status_code"] = "error";
        header("location:status.php");
    }
} */

if (isset($_GET["deleteID"])) {
    $id = $_GET["deleteID"];
    $delete_query = mysqli_query($conn, "DELETE FROM tblstudentstatus WHERE StudentStatusID = '$id'");

    if ($delete_query) {
        $_SESSION["status"] = "Student status has been deleted";
        $_SESSION["status_code"] = "success";
        header("location:status.php");
    } else {
        $_SESSION["status"] = "Unable to delete";
        $_SESSION["status_code"] = "error";
        header("location:status.php");
    }
}
