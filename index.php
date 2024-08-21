<?php
if (isset($_GET['role']) && $_GET['role'] == 'teacher') {
    session_name('teacher_session');
} else if (isset($_GET['role']) && $_GET['role'] == 'student') {
    session_name('student_session');
} else {
    session_name('admin_session');
}
session_start();

if (isset($_SESSION["authenticated"]) && $_SESSION["authenticated"] === true) {
    header("location:homepage.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="Dashboard/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body style=" background-color: rgb(113, 99, 186)">
    <div class="wrapper fadeInDown">
        <div id="formContent">

            <div class="fadeIn first">
                <img src="image/profile.png" id="icon" />
            </div>

            <select name="loginAs" id="loginAs" class="fadeIn fifth">
                <option>Choose your right</option>
                <?php
                include("conn.php");

                $select = mysqli_query($conn, "SELECT * FROM login");
                if (mysqli_num_rows($select) > 0) {
                    while ($row = mysqli_fetch_assoc($select)) {
                ?>
                        <option value="<?php echo $row["loginAs"] ?>"><?php echo $row["loginAs"] ?></option>
                <?php
                    }
                }
                ?>
            </select>
            <form onsubmit="return validateForm()" action="validation.php" method="POST" style="display:none;" id="studentForm">
                <input type="text" id="name" class="fadeIn second" name="name" placeholder="Student's name" autocomplete="off" required>

                <input type="text" id="idNumber" class="fadeIn third" name="idNumber" placeholder="Student's 8 digits Id number" autocomplete="off" required>
                <button type="submit" class="fadeIn fourth" id="button">Login</button>
            </form>


            <form action="" method="POST" style="display:none;" id="adminForm">
                <input type="hidden" name="selectAs" id="selectAs">
                <input type="password" id="adminName" class="fadeIn second" name="adminName" placeholder="name" autocomplete="off" required>
                <button type="submit" class="fadeIn fourth" id="button">Login</button>
            </form>


            <form action="" method="POST" style="display:none;" id="teacherForm">
                <input type="hidden" name="replace" id="replace">
                <input type="text" id="teacherName" class="fadeIn second" name="teacherName" placeholder="name" autocomplete="off" required>
                <button type="submit" class="fadeIn fifth" id="button">Login</button>
            </form>


            <!-- Remind Passowrd -->
            <div id="formFooter" style="display:none;">
                <a class="underlineHover" href="#">Forgot Password?</a>&nbsp; &nbsp;<a class="underlineHover" href="loginQrcode.php">Login through QR code <i class="fa-solid fa-qrcode"></i></a>
            </div>

        </div>

        <img src="image/loading-gif.gif" width="200" alt="" class="gif-loading" id="gif-loading" style="display:none;">
    </div>

    <?php
    if (isset($_SESSION["status"]) && $_SESSION["status"] != "") {
    ?>
        <script>
            swal({
                title: '<?php echo $_SESSION["status"] ?>',
                icon: '<?php echo $_SESSION["status_code"] ?>',
                button: 'okay!',
            })
        </script>
    <?php

        unset($_SESSION["status"]);
    }
    ?>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            $('#loginAs').change(function() {
                var value = $(this).val();
                console.log(value);
                if (value === 'Student') {
                    $('#studentForm').show();
                    $('#formFooter').show();
                } else {
                    $('#studentForm').hide();
                }

                if (value === 'Administrator') {
                    $('#adminForm').show();
                    $('#selectAs').val(value);
                } else {
                    $('#adminForm').hide();
                }

                if (value === 'Teacher') {
                    /*  $('#teacherForm').show();
                     $('#replace').val(value); */
                    window.location.href = "formAuthorizeTeacher.php";
                } else {
                    $('#teacherForm').hide();
                }
            });

            $('#adminForm').on('submit', function(e) {
                e.preventDefault();
                var formData = $(this).serialize();
                $('#gif-loading').show();
                $.ajax({
                    url: 'adminValidation.php',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        setTimeout(() => {
                            $('#gif-loading').hide();
                            window.location.reload();
                        }, 2000)

                    },
                    error: function(xhr, status, error) {
                        // Handle error
                        alert('Form submission failed!');
                        console.log(xhr.responseText); // Log the error response for debugging
                    }
                })

                $('form').on('submit', function() {
                    $('#loginAs').val('Choose your right'); // Reset the select field to its default value
                });

            })

            /*  $('#teacherForm').on('submit', function(e) {
                 e.preventDefault();
                 var formData = $(this).serialize();
                 $('#gif-loading').show();
                 $.ajax({
                     url: 'teacherValidation.php',
                     type: 'POST',
                     data: formData,
                     success: function(response) {

                         setTimeout(() => {
                             $('#gif-loading').hide();
                             window.location.reload();
                         }, 2000)

                     },
                     error: function(xhr, status, error) {
                         // Handle error
                         alert('Form submission failed!');
                         console.log(xhr.responseText); // Log the error response for debugging
                     }
                 });
             });

             $('form').on('submit', function() {
                 $('#loginAs').val('Choose your right'); // Reset the select field to its default value
             });*/
        });
    </script>

    <script>
        function validateForm() {
            const username = document.getElementById('name').value;
            const id = document.getElementById('idNumber').value;
            const check = username.trim().split(" ");
            if (check.length < 2) {
                alert("Please enter both first and last name seperated by a space!")
                return false;
            }
            if (id.trim() === "") {
                alert("Please enter your ID number!");
                return false;
            }
            return true;
        }
    </script>
</body>

</html>