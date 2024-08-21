<?php
if (isset($_GET['role'])) {
    if ($_GET['role'] == 'admin') {
        session_name('admin_session');
    } else if ($_GET['role'] == 'teacher') {
        session_name('teacher_session');
    } else if ($_GET['role'] == 'student') {
        session_name('student_session');
    }
}
session_start();
session_destroy();
header('Location:index.php?role=' . $_GET['role']);
exit();
