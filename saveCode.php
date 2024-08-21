<!-- <div class="tabular--wrapper">
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Student Status ID</th>
                            <th>Attendance date issue</th>
                            <th>Subject ID</th>
                            <th>Status</th>
                            <th>Note</th>
                            <th>Session</th>
                            <th>Lecturer ID</th>
                            <th>Date Issue</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $select = mysqli_query($conn, "SELECT tblattendance.AttendanceID,tblattendance.StudentStatusID,tblattendance.AttendanceDateIssue,tblsubject.SubjectEN,tblsubject.SubjectID,tblattendance.Attended,
                        tblattendance.AttendNote,tblattendance.Section,tbllecturer.LecturerID,tbllecturer.LecturerName,tblattendance.DateIssue
                        
                        FROM tblattendance left join tblsubject on tblattendance.SubjectID = tblsubject.SubjectID LEFT join tbllecturer on tblattendance.LecturerID = tbllecturer.LecturerID");
                        if (mysqli_num_rows($select) > 0) {
                            while ($row = mysqli_fetch_assoc($select)) {
                        ?>
                                <tr>
                                    <td><?php echo $row["AttendanceID"] ?></td>
                                    <td><?php echo $row["StudentStatusID"] ?></td>
                                    <td>
                                        <?php echo $row["AttendanceDateIssue"] ?>
                                    </td>
                                    <td><?php echo $row["SubjectEN"] ?></td>
                                    <td><span class="<?php echo $row["Attended"] ?>"><?php echo $row["Attended"] ?></span></td>

                                    <td>
                                        <?php

                                        if ($row["AttendNote"] == null) {
                                            echo "<span class='unavailable'>Unavailable</span>";
                                        } else {
                                            echo "<span class='available'>{$row["AttendNote"]}</sapn>";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php echo $row["Section"] ?>
                                    </td>
                                    <td>
                                        <?php echo $row["LecturerName"] ?>
                                    </td>
                                    <td>
                                        <?php echo $row["DateIssue"] ?>
                                    </td>

                                    <td>

                                        <div class="dropdown">
                                            <a class="btn btn dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="background: rgb(113, 99, 186); color:#fff">

                                            </a>

                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item" href="attendanceInsert.php?updateID=<?php echo $row["AttendanceID"] ?>">
                                                        <i class="fas fa-edit"></i> Edit

                                                    </a>
                                                </li>
                                                <li><a onclick="javascript:return confirm('Are you sure want to delete this record?');" class="dropdown-item" href="attendanceInsert.php?deleteID=<?php echo $row["AttendanceID"] ?>"><i class="fas fa-trash"></i> Delete</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                        <?php
                            }
                        }
                        ?>


                </table>

            </div>
        </div> -->