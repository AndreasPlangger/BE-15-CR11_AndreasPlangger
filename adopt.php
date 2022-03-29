<?php
session_start();
require_once 'components/boot.php';
require_once 'components/db_connect.php';
require_once 'components/file_upload.php';

// if session is not set this will redirect to login page
if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: dashboard.php");
    exit;
}

$backBtn = '';
//if user create a back button to home.php
if (isset($_SESSION["user"])) {
    $backBtn = "home.php";
}
//if adm create a back button to dashboard.php
if (isset($_SESSION["adm"])) {
    $backBtn = "dashboard.php";
}

$sql1 = "SELECT * FROM pet_adoption WHERE fk_userID = {$_SESSION['user']} AND fk_petID = {$_GET['petID']}";


$res1 = mysqli_query($connect, $sql1);

if (mysqli_num_rows($res1) > 0) {
    header("location: error.php");
}


$sql = "INSERT INTO pet_adoption (fk_userID, fk_petID, adoption_date) VALUES ({$_SESSION['user']}, {$_GET['petID']}, CURDATE())";



$res = mysqli_query($connect, $sql);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once 'components/boot.php' ?>
    <title>Adopt this animal</title>
</head>

<body>
    <div class="container">
        <div class="card shadow p-5 w-50 mt-5" style="margin: 0 auto;">
            <?php
            if ($res) {
                echo "Congratulations! You have made a new friend!";
            } else {
                echo "Ooops! Something went wrong, please try again!";
            }
            ?>
            <a class="btn btn-warning mt-3" style='width: 11vw;' href="home.php" role="button">Great! Take me back</a>
        </div>
    </div>
</body>

</html>