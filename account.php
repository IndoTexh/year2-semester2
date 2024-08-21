<?php
include("conn.php");
session_name('student_session');
session_start();
$id = $_SESSION["userID"];
$query = mysqli_query($conn, "SELECT * FROM tblstudent WHERE student_number = '$id'");
$row = mysqli_fetch_assoc($query);
if (!isset($_SESSION["authenticated"]) || $_SESSION["authenticated"] !== true) {
    $_SESSION["status"] = "You are not authorized to see that page unless you are logged in.";
    $_SESSION["status_code"] = "warning";
    header("Location: index.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Admin Dashboard | Korsat X Parmaga</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="Dashboard/style.css">
</head>
</head>

<style>
    * {
        font-family: "Ubuntu", sans-serif;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    :root {
        --blue: #2a2185;
        --white: #fff;
        --gray: #f5f5f5;
        --black1: #222;
        --black2: #999;
    }

    body {
        min-height: 100vh;
        overflow-x: hidden;
    }

    .container {
        position: relative;
        width: 100%;
    }


    .main {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 900px;
        margin-left: 100px;
        font-family: "Khmer OS Battambang";
    }

    .main h2 {
        margin-bottom: 20px;
        text-align: center;
        font-family: "Khmer OS Battambang";
    }


    form label {
        width: 18%;
        margin-bottom: 5px;
        font-weight: bold;
        font-family: "Khmer OS Battambang";
    }

    .group-contain {
        display: flex;
        align-items: center;


    }

    form input[type="text"],
    form input[type="email"],
    form input[type="password"],
    form input[type="date"],
    form select {
        width: 30%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
        font-family: "Khmer OS Battambang";

    }

    form input[type="text"] {
        margin-right: 20px;
    }


    /* form input[type="text"],
    form input[type="email"],
    form input[type="password"],
    form input[type="date"],
    form select {
        width: 45%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
        font-family: "Khmer OS Battambang";
    }

    form input[type="submit"] {
        width: 100%;
        background-color: #4CAF50;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    form input[type="submit"]:hover {
        background-color: #45a049;
    }

    img {
        margin-top: 10px;
        max-width: 200px;
        margin-bottom: 20px;

    }

    .contain {
        width: 100%;
        display: flex;
        align-items: center;
        margin-top: 20px;
        justify-content: flex-end;
        gap: 20px;
    }

    .contain a:first-child {
        background-color: red;
        font-size: 1rem;
        font-family: 'Khmer OS Battambang';
        color: white;
        text-decoration: none;
        padding: 5px 30px;
        border-radius: 5px;
    }

    .contain a:last-child {
        background-color: green;
        font-size: 1rem;
        font-family: 'Khmer OS Battambang';
        color: white;
        text-decoration: none;
        padding: 5px 30px;
        border-radius: 5px;
    }

    .mains {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 600px;
        margin-left: 100px;
        font-family: "Khmer OS Battambang";
        position: relative;
    }
 */
    /* .mains h2 {
        margin-bottom: 20px;
        text-align: center;
        font-family: "Khmer OS Battambang";
    }

    .mains img {
        margin-top: 10px;
        max-width: 300px;
        margin-left: 120px;
    } */



    /* form {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }

    form label {
        width: 45%;
        margin-bottom: 5px;
        font-weight: bold;
        font-family: "Khmer OS Battambang";
    } */



    /*  form input[type="text"],
    form input[type="email"],
    form input[type="password"],
    form input[type="date"],
    form select {
        width: 45%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
        font-family: "Khmer OS Battambang";
    }

    form input[type="submit"] {
        width: 100%;
        background-color: #4CAF50;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    } */
    /* 
    form input[type="submit"]:hover {
        background-color: #45a049;
    } */

    /* 

    .contain {
        width: 100%;
        display: flex;
        align-items: center;
        margin-top: 20px;
        gap: 20px;
        justify-content: flex-end;
    }

    .contain input:first-child {
        background-color: red;
        font-size: 1rem;
        font-family: 'Khmer OS Battambang';
        color: white;
        text-decoration: none;
        padding: 5px 30px;
        border-radius: 5px;
    }

    .contain input:last-child {
        background-color: green;
        font-size: 1rem;
        font-family: 'Khmer OS Battambang';
        color: white;
        text-decoration: none;
        padding: 5px 30px;
        border-radius: 5px;
        margin-right: 10px;
    }

    form .images {
        padding: 10px 300px 10px 10px;
        border: 1px solid gray;
        font-size: 1rem;
        font-family: 'Khmer OS Battambang';
        background-color: whitesmoke;
    } */
</style>

<body>
    <div class="sidebar">
        <div class="logo">
            <ul class="menu">
                <li>
                    <a href="authorizeStudent.php">
                        <i class="fas fa-home">
                        </i>
                        <span>Homepage</span>
                    </a>
                </li>

                <li class="active">
                    <a href="account.php">
                        <i class="fa-solid fa-gear"></i>
                        </i>
                        <span>Account</span>
                    </a>
                </li>
                <li>
                    <a href="logout.php?role=student">
                        <i class="fa-solid fa-right-to-bracket"></i>
                        </i>
                        <span>Logout</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>

    <div class="container">
        <div class="main">
            <h2>គណនេយ្យរបស់អ្នក</h2>
            <p><?php echo $row['student_number']; ?></p>
            <form action="" method="POST">

                <div class="group-contain">
                    <label for="name">ឈ្មោះ</label>
                    <input type="text" id="name" name="name" value="<?php echo $row['NameInKhmer']; ?>">

                    <label for="email">Name</label>
                    <input type="email" id="email" name="email" value="<?php echo $row['NameInLatin']; ?>">
                </div>

                <div class="group-contain">
                    <label for="name">Family</label>
                    <input type="text" id="name" name="name" value="<?php echo $row['FamilyName']; ?>">

                    <label for="email">Given</label>
                    <input type="email" id="email" name="email" value="<?php echo $row['GivenName']; ?>">
                </div>

                <div class="group-contain">

                    <label for="email">Sex</label>
                    <input type="text" id="email" name="email" value="<?php echo $row['SexID']; ?>">

                    <label for="email">Passport</label>
                    <input type="email" id="email" name="email" value="<?php echo $row['IDPassportNo']; ?>">
                </div>

                <div class="group-contain">
                    <label for="email">Nationality</label>
                    <input type="text" id="email" name="email" value="<?php echo $row['NationalityID']; ?>">

                    <label for="email">Country</label>
                    <input type="email" id="email" name="email" value="<?php echo $row['CountryID']; ?>">
                </div>

                <div class="group-contain">

                    <label for="email">Date of birth</label>
                    <input type="text" id="email" name="email" value="<?php echo $row['DOB']; ?>">
                    <label for="email">Place of birth</label>
                    <input type="email" id="email" name="email" value="<?php echo $row['POB']; ?>">
                </div>

                <div class="group-contain">
                    <label for="email">Phone Number</label>
                    <input type="text" id="email" name="email" value="<?php echo $row['PhoneNumber']; ?>">

                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?php echo $row['Email']; ?>">
                </div>

                <div class="group-contain">
                    <label for="email">Current Address</label>
                    <input type="text" id="email" name="email" value="<?php echo $row['CurrentAddress']; ?>">

                    <label for="email">Date of registration</label>
                    <input type="email" id="email" name="email" value="<?php echo $row['DateOfRegister']; ?>">
                </div>

                <div class="group-contain">
                    <img src="image/<?php echo $row['Photo']; ?>" width="200">
                    <img src="<?php echo $row['qrCode']; ?>" width="320">
                </div>
            </form>
        </div>

        <?php
        if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
        ?>
            <script>
                swal({
                    title: '<?php echo $_SESSION['status']; ?>',
                    icon: '<?php echo $_SESSION['status_code']; ?>',
                    button: "okay!",
                });
            </script>
        <?php
            unset($_SESSION['status']);
        }
        ?>


        <?php

        if (isset($_GET['update'])) {
            $edit_id = $_GET['update'];
            $edit_query = mysqli_query($conn, "SELECT * FROM `user` WHERE id = $edit_id");
            if (mysqli_num_rows($edit_query) > 0) {
                while ($row = mysqli_fetch_assoc($edit_query)) {
        ?>

                    <div class="main">
                        <h2>គណនេយ្យរបស់អ្នក</h2>
                        <?php if (isset($row['image'])) : ?>
                            <img src="images/<?php echo $row['image']; ?>" alt="Profile Picture"><br><br>
                        <?php endif; ?>
                        <form action="" method="POST" enctype="multipart/form-data">

                            <label for="id">អត្តលេខ</label>
                            <input type="text" id="id" name="update_id" value="<?php echo $row['id']; ?>">

                            <label for="name">ឈ្មោះ</label>
                            <input type="text" id="name" name="update_name" value="<?php echo $row['username']; ?>">

                            <label for="email">អ៊ីម៉ែល</label>
                            <input type="email" id="email" name="update_email" value="<?php echo $row['email']; ?>">

                            <label for="password">លេខសម្ងាត់</label>
                            <input type="password" id="password" name="update_password" value="<?php echo $row['password']; ?>">

                            <label for="password">អាយឌីរបស់អ្នក</label>
                            <input type="text" id="users_id" name="users_id" disabled value="<?php echo $row['userID']; ?>">

                            <label for="phone">លេខទូរស័ព្ទ</label>
                            <input type="text" id="phone" name="update_phone" value="<?php echo $row['phone']; ?>">

                            <label for="dob">ថ្ងែខែឆ្នាំកំណើត</label>
                            <input type="date" id="dob" name="update_dob" value="<?php echo $row['dob']; ?>">

                            <label for="gender">ភេទ:</label>
                            <select id="gender" name="update_gender">
                                <option value="Male" <?php if ($row['gender'] == 'Male') echo 'selected'; ?>>Male</option>
                                <option value="Female" <?php if ($row['gender'] == 'Female') echo 'selected'; ?>>Female</option>
                                <option value="Other" <?php if ($row['gender'] == 'Other') echo 'selected'; ?>>Other</option>
                            </select>

                            <label for="update_country">ប្រទេស:</label>
                            <input type="text" id="country" name="update_country" value="<?php echo $row['country']; ?>">

                            <label for="city">ទីក្រុង:</label>
                            <input type="text" id="city" name="update_city" value="<?php echo $row['city']; ?>">

                            <input type="file" name="update_image" accept="image/png, image/jpg, image/jpeg">


                            <div class="contain">
                                <input type="submit" name="cancel" value="មិនកែប្រែ">
                                <input type="submit" name="updates" value="កែប្រែ">
                            </div>

                        </form>
                    </div>

        <?php
                };
            };
            echo "<script>document.querySelector('.edit-form-container').style.display = 'flex';</script>";
        };
        ?>


    </div>

</body>


<!-- =========== Scripts =========  -->
<script src="assets/js/main.js"></script>


<script src="assets/js/main.js"></script>

<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</html>