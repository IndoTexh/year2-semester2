<?php
session_name('teacher_session');
session_start();
if (isset($_SESSION["authenticated"]) && $_SESSION["authenticated"] === true) {
    header("location:teacherAuthorize.php");
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


            <form action="" method="POST" id="teacherForm">
                <input type="hidden" name="replace" value="Teacher">
                <input type="password" id="teacherName" class="fadeIn second" name="teacherName" placeholder="name" autocomplete="off" required>
                <button type="submit" class="fadeIn fifth" id="button">Login</button>
            </form>

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
            $('#teacherForm').on('submit', function(e) {
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
                        }, 2000);
                    },
                    error: function(xhr, status, error) {
                        // Handle error
                        alert('Form submission failed!');
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>
</body>

</html>