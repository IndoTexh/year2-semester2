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
    $subjectID = $_POST["subjectID"];
    $lecturerID = $_POST["lecturerID"];
    $dayweekID = $_POST["dayweekID"];
    $timeID = $_POST["timeID"];
    $roomID = $_POST["roomID"];
    $academicprogramID = $_POST["programID"];
    $startDate = $_POST["startDate"];
    $endDate = $_POST["endDate"];
    $scheduleDate = $_POST["scheduleDate"];
    $days = $_POST["days"];

    if (empty($subjectID) || empty($lecturerID) || empty($dayweekID) || empty($timeID) || empty($roomID) || empty($academicprogramID) || empty($days) || empty($startDate) || empty($endDate) || empty($scheduleDate)) {
        $_SESSION["status"] = "Please fill all the requirements";
        $_SESSION["status_code"] = "warning";
        header("location:test.php");
        exit();
    }

    $insert_query = mysqli_query($conn, "INSERT INTO tblschedule (SubjectID,LecturerID,DayWeekID,TimeID,RoomID,AcademicProgramID,DateStart,DateEnd,ScheduleDate,days) VALUES ('$subjectID','$lecturerID','$dayweekID','$timeID','$roomID','$academicprogramID','$startDate','$endDate','$scheduleDate','$days')");

    if ($insert_query) {
        $_SESSION["status"] = "Schedule has been added";
        $_SESSION["status_code"] = "success";
        header("location:test.php");
    } else {
        $_SESSION["status"] = "Unable to add";
        $_SESSION["status_code"] = "error";
        header("location:scheduleForm.php");
    }
}

if (isset($_POST["insert"])) {
    $time = strtoupper($_POST["time"]);

    $check = mysqli_query($conn, "SELECT * FROM tblschedule WHERE UPPER(TimeID) = '$time'");
    if (mysqli_num_rows($check) > 0) {
        $_SESSION["status"] = "This time has already created within the schedule!";
        $_SESSION["status_code"] = "warning";
        header("location:test.php");
        exit();
    }

    if (empty($time)) {
        $_SESSION["status"] = "Please fill all the requirements";
        $_SESSION["status_code"] = "warning";
        header("location:test.php");
        exit();
    }

    $insert_query = mysqli_query($conn, "INSERT INTO tblschedule (TimeID) VALUES ('$time')");

    if ($insert_query) {
        $_SESSION["status"] = "New time has been added";
        $_SESSION["status_code"] = "success";
        header("location:test.php");
    } else {
        $_SESSION["status"] = "Unable to add";
        $_SESSION["status_code"] = "error";
        header("location:scheduleForm.php");
    }
}

$scheduleID = $_POST["scheduleID"];
$select = mysqli_query($conn, "SELECT 
tblschedule.ScheduleID,
tblsubject.SubjectID,
tblsubject.SubjectEN,
tbllecturer.Photo,
tbllecturer.LecturerName,
tbldayweek.DayWeekID,
tbldayweek.DayWeekName,
tblroom.RoomID,
tblroom.RoomName,
tblacademicyear.AcademicYearID,
tblacademicyear.AcademicYear,
tblschedule.DateStart,
tblschedule.DateEnd,
tblschedule.ScheduleDate,
tblschedule.days,
tblschedule.TimeID,
tbltime.timeID,
tbltime.TimeName,
tblschedule.LecturerID,
tblschedule.SubjectID,
tblprogram.ProgramID
FROM tblschedule 
LEFT JOIN tbltime ON tblschedule.TimeID = tbltime.TimeID
LEFT JOIN tblsubject ON tblschedule.SubjectID = tblsubject.SubjectID 
LEFT JOIN tbllecturer ON tblschedule.LecturerID = tbllecturer.LecturerID 
LEFT JOIN tbldayweek ON tblschedule.DayWeekID = tbldayweek.DayWeekID 
LEFT JOIN tblroom ON tblschedule.RoomID = tblroom.RoomID 
LEFT JOIN tblacademicyear ON tblschedule.AcademicProgramID = tblacademicyear.AcademicYearID 
LEFT JOIN tblprogram on tblschedule.AcademicProgramID = tblprogram.ProgramID
WHERE tblschedule.ScheduleID = '$scheduleID'");

$output = "";
while ($rows = mysqli_fetch_assoc($select)) {
    ob_start();
?>

    <img src="lecturer_image/<?php echo $rows["Photo"]; ?>" width="100" alt="" class="lecturer_img">
    <div class="row">
        <div class="col-lg-6">
            <input type="hidden" class="form-select form-control mb-2" name="update_scheduleID" value="<?php echo $rows["ScheduleID"]; ?>">

            <label>Subject</label>
            <select name="update_subjectID" class="form-select form-control mb-2">
                <option value="<?php echo $rows["SubjectID"]; ?>"> <?php echo $rows["SubjectID"]; ?></option>
                <?php
                $subject_select = mysqli_query($conn, "SELECT * FROM tblsubject");
                if (mysqli_num_rows($subject_select) > 0) {
                    while ($subject_row = mysqli_fetch_assoc($subject_select)) {
                        echo '<option value="' . $subject_row["SubjectEN"] . '">' . $subject_row["SubjectID"] . ' ' . $subject_row["SubjectEN"] . '</option>';
                    }
                }
                ?>
            </select>

            <label>Day of the subject</label>
            <select name="update_days" class="form-select form-control mb-2">
                <option value="<?php echo $rows["days"]; ?>"><?php echo $rows["days"]; ?></option>
                <?php
                $days_select = mysqli_query($conn, "SELECT * FROM tbldays");
                if (mysqli_num_rows($days_select) > 0) {
                    while ($days_row = mysqli_fetch_assoc($days_select)) {
                        echo '<option value="' . $days_row["DayID"] . '">' . $days_row["DayID"] . ' ' . $days_row["DayName"] . '</option>';
                    }
                }
                ?>
            </select>

            <label>Lecturer</label>
            <select name="update_lecturerID" class="form-select form-control mb-2">
                <option value="<?php echo $rows["LecturerID"]; ?>"><?php echo $rows["LecturerID"]; ?></option>
                <?php
                $lecturer_select = mysqli_query($conn, "SELECT * FROM tbllecturer");
                if (mysqli_num_rows($lecturer_select) > 0) {
                    while ($lecturer_row = mysqli_fetch_assoc($lecturer_select)) {
                        echo '<option value="' . $lecturer_row["LecturerName"] . '">' . $lecturer_row["LecturerID"] . ' ' . $lecturer_row["LecturerName"] . '</option>';
                    }
                }
                ?>
            </select>

            <label>Schedule start from:</label>
            <select name="update_dayweekID" class="form-select form-control mb-2">
                <option value="<?php echo $rows["DayWeekID"]; ?>"><?php echo $rows["DayWeekName"]; ?></option>
                <?php
                $dayweek_select = mysqli_query($conn, "SELECT * FROM tbldayweek");
                if (mysqli_num_rows($dayweek_select) > 0) {
                    while ($dayweek_row = mysqli_fetch_assoc($dayweek_select)) {
                        echo '<option value="' . $dayweek_row["DayWeekID"] . '">' . $dayweek_row["DayWeekID"] . ' ' . $dayweek_row["DayWeekName"] . '</option>';
                    }
                }
                ?>
            </select>

            <label>Time:</label>
            <select name="update_timeID" class="form-select form-control mb-2">
                <option value="<?php echo $rows["TimeID"]; ?>"><?php echo $rows["TimeID"]; ?></option>
                <?php
                $time_select = mysqli_query($conn, "SELECT * FROM tbltime");
                if (mysqli_num_rows($time_select) > 0) {
                    while ($time_row = mysqli_fetch_assoc($time_select)) {
                        echo '<option value="' . $time_row["TimeID"] . '">' . $time_row["TimeID"] . ' ' . $time_row["TimeID"] . '</option>';
                    }
                }
                ?>
            </select>

            <label>Room:</label>
            <select name="update_roomID" class="form-select form-control mb-2">
                <option value="<?php echo $rows["RoomID"]; ?>"><?php echo $rows["RoomName"]; ?></option>
                <?php
                $room_select = mysqli_query($conn, "SELECT * FROM tblroom");
                if (mysqli_num_rows($room_select) > 0) {
                    while ($room_row = mysqli_fetch_assoc($room_select)) {
                        echo '<option value="' . $room_row["RoomID"] . '">' . $room_row["RoomID"] . ' ' . $room_row["RoomName"] . '</option>';
                    }
                }
                ?>
            </select>
        </div>
        <div class="col-lg-6">
            <label>Program</label>
            <select name="update_academicprogramID" class="form-select form-control mb-2">
                <option value="<?php echo $rows["ProgramID"]; ?>"><?php echo $rows["ProgramID"]; ?></option>
                <?php
                include("conn.php");
                $select = mysqli_query($conn, "SELECT 
                tblprogram.ProgramID,
                tblyear.YearID,tblyear.YearEN,
                tblsemester.SemesterID,
                tblsemester.SemesterEN,
                tblshift.ShiftID,
                tblshift.ShiftEN,
                tbldegree.DegreeID,
                tbldegree.DegreeEN,
                tblacademicyear.AcademicYearID,
                tblacademicyear.AcademicYear,
                tblmajor.MajorID,
                tblmajor.MajorEN,
                tblbatch.BatchID,
                tblbatch.BatchEN,
                tblcampus.CampusID,
                tblcampus.CampusEN,
                tblprogram.StartDate,
                tblprogram.EndDate,
                tblprogram.ProgramID, 
                tblprogram.YearID,
                tblprogram.SemesterID,
                tblprogram.DateIssue 
                FROM tblprogram 
                LEFT JOIN tblyear on tblprogram.YearID = tblyear.YearID 
                LEFT JOIN tblsemester on tblprogram.SemesterID = tblsemester.SemesterID 
                LEFT JOIN tblshift on tblprogram.ShiftID = tblshift.ShiftID 
                LEFT JOIN tbldegree on tblprogram.DegreeID = tbldegree.DegreeID
                LEFT JOIN tblacademicyear on tblprogram.AcademicYearID = tblacademicyear.AcademicYearID LEFT JOIN tblmajor on tblprogram.MajorID = tblmajor.MajorID
                LEFT JOIN tblbatch on tblprogram.BatchID = tblbatch.BatchID 
                LEFT JOIN tblcampus on tblprogram.CampusID = tblcampus.CampusID order by ProgramID desc");
                if (mysqli_num_rows($select) > 0) {
                    while ($rowss = mysqli_fetch_assoc($select)) {
                ?>
                        <option value="<?php echo $rowss["ProgramID"] ?>" class="h-6">
                            <?php echo $rowss["MajorEN"] ?> <?php echo $rowss["ProgramID"] ?>
                            [<?php echo $rowss["DegreeEN"] ?>]-[<?php echo $rowss["BatchEN"] ?>]-[S<?php echo $rowss["SemesterID"] ?>]-[Y<?php echo $rowss["YearID"] ?>]-[Start: <?php echo $rowss["StartDate"] ?>]-[End: <?php echo $rowss["EndDate"] ?>]-[Created: <?php echo $rowss["DateIssue"] ?>]
                        </option>
                <?php
                    }
                }
                ?>
            </select>

            <label>Start Date</label>
            <input class="form-control form-control mb-2" type="date" name="update_startDate" value="<?php echo $rows["DateStart"]; ?>">

            <label>End Date</label>
            <input class="form-control form-control mb-2" type="date" name="update_endDate" value="<?php echo $rows["DateEnd"]; ?>">

            <label>Schedule Date</label>
            <input class="form-control form-control mb-2" type="date" name="update_scheduleDate" value="<?php echo $rows["ScheduleDate"]; ?>">
        </div>
    </div>
    <button type="submit" name="update" class="btn btn" style="background: rgb(113, 99, 186); color:#fff">Update</button>
    <a href="test.php" class="btn btn" style="background: rgb(225, 212, 95); color:#fff;">Go Back</a>
<?php
    $output .= ob_get_clean();
}
echo $output;

/* $id = $_GET["selectID"];
$select = mysqli_query($conn, "SELECT 
tblschedule.ScheduleID,
tblsubject.SubjectID,
tblsubject.SubjectEN,
tbllecturer.LecturerID,
tbllecturer.Photo,
tbllecturer.LecturerName,
tbldayweek.DayWeekID,
tbldayweek.DayWeekName,
tblroom.RoomID,
tblroom.RoomName,
tblacademicyear.AcademicYearID,
tblacademicyear.AcademicYear,
tblschedule.DateStart,
tblschedule.DateEnd,
tblschedule.ScheduleDate,
tblschedule.days,
tblschedule.TimeID,
tbltime.timeID,
tbltime.TimeName
FROM tblschedule 

left join tbltime on tblschedule.TimeID = tbltime.TimeName
left JOIN tblsubject ON tblschedule.SubjectID = tblsubject.SubjectID 
left JOIN tbllecturer ON tblschedule.LecturerID = tbllecturer.LecturerID 
left JOIN tbldayweek ON tblschedule.DayWeekID = tbldayweek.DayWeekID 
left JOIN tblroom ON tblschedule.RoomID = tblroom.RoomID 
left JOIN tblacademicyear ON tblschedule.AcademicProgramID = tblacademicyear.AcademicYearID WHERE ScheduleID = '$id'");
$rows = mysqli_fetch_assoc($select); */



if (isset($_POST["update"])) {
    $scheduleID = $_POST["update_scheduleID"];
    $subjectID = $_POST["update_subjectID"];
    $lecturerID = $_POST["update_lecturerID"];
    $dayweekID = $_POST["update_dayweekID"];
    $timeID = $_POST["update_timeID"];
    $roomID = $_POST["update_roomID"];
    $academicprogramID = $_POST["update_academicprogramID"];
    $startDate = $_POST["update_startDate"];
    $endDate = $_POST["update_endDate"];
    $scheduleDate = $_POST["update_scheduleDate"];
    $dayID = $_POST["update_days"];

    $update_query = mysqli_query($conn, "UPDATE tblschedule SET SubjectID = '$subjectID', LecturerID = '$lecturerID', DayWeekID = '$dayweekID', TimeID = '$timeID', RoomID = '$roomID', AcademicProgramID = '$academicprogramID', DateStart = '$startDate', DateEnd = '$endDate', ScheduleDate = '$scheduleDate', days = '$dayID' WHERE ScheduleID = '$scheduleID'") or die();

    if ($update_query) {
        $_SESSION["status"] = "Schedule has been updated";
        $_SESSION["status_code"] = "success";
        header("location:test.php");
    } else {
        $_SESSION["status"] = "Unable to update";
        $_SESSION["status_code"] = "error";
        header("location:insertSchedule.php");
    }
}

if (isset($_GET["deleteID"])) {
    $id = $_GET["deleteID"];
    $delete_query = mysqli_query($conn, "DELETE FROM tblschedule WHERE ScheduleID = '$id'");

    if ($delete_query) {
        $_SESSION["status"] = "Schedule has been deleted";
        $_SESSION["status_code"] = "success";
        header("location:test.php");
    } else {
        $_SESSION["status"] = "Unable to delete";
        $_SESSION["status_code"] = "error";
        header("location:test.php");
    }
}
