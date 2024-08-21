 <!-- 
    <form id="attendanceForm">
        <input type="hidden" id="subject" value="<?php echo htmlspecialchars($subject); ?>">
        <input type="hidden" id="lecturer" value="<?php echo htmlspecialchars($lecturer); ?>">
        <div class="table-container">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="background: lightgray;">No.</th>
                        <th style="background: lightgray;">ID</th>
                        <th style="background: lightgray;">StudentName</th>
                        <th style="background: lightgray;">KhmerName</th>
                        <th style="background: lightgray;">Attended</th>
                        <th style="background: lightgray;"></th>
                        <th style="background: lightgray;">[A]</th>
                        <th style="background: lightgray;">[P]</th>
                        <th style="background: lightgray;">[S]</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $select = mysqli_query($conn, "SELECT tblstudentstatus.StudentStatusID, tblstudentstatus.StudentID, tblstudent.NameInKhmer,tblstudent.NameInLatin,tblstudent.student_number from tblstudentstatus LEFT JOIN tblstudent on tblstudentstatus.StudentID = tblstudent.StudentID;");
                    if (mysqli_num_rows($select) > 0) {
                        while ($row = mysqli_fetch_assoc($select)) {
                    ?>
                            <tr>
                                <td><?php echo $row["StudentStatusID"] ?></td>
                                <td><?php echo $row["student_number"] ?></td>
                                <td><?php echo $row["NameInLatin"] ?></td>
                                <td><?php echo $row["NameInKhmer"] ?></td>
                                <td>[A = 0] & [P = 0]</td>
                                <td><i class="fa-solid fa-pen-to-square"></i></td>
                                <td style="background:red;">
                                    <input type="checkbox" name="status_<?php echo $row["StudentID"] ?>" value="Absent" data-student-id="<?php echo $row["StudentID"] ?>">
                                </td>
                                <td style="background:green;">
                                    <input type="checkbox" name="status_<?php echo $row["StudentID"] ?>" value="Present" data-student-id="<?php echo $row["StudentID"] ?>" id="present">
                                </td>
                                <td>
                                    <input type="checkbox" name="status_<?php echo $row["StudentID"] ?>" value="Stop" data-student-id="<?php echo $row["StudentID"] ?>">
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
            </table>

        </div>
        <button type="submit" class="btn btn-primary" style="margin-bottom: 20px;">Submit Attendance</button>
        <button type="button" class="btn btn-primary" id="all-presence">All presence</button>
        <a href="teacherAuthorize.php" class="btn btn-primary" id="goBack">Go back</a>

        <div class="AttendanceDateIssue">
            Attendance date issue :<input type="date" class="form-input" name="AttendanceDateIssues" id="AttendanceDateIssues">
        </div>

        <div class="DateIssue">
            Date issue :<input type="date" class="form-input" name="DateIssue" id="DateIssue">
        </div>

        <div class="Session">
            <select name="session" id="session" class="form-select">
                <option>Choose session</option>
                <option value="1">1</option>
                <option value="2">2</option>
            </select>
        </div>
    </form>
 -->