<?php
session_start();
require_once '../../components/db_connect.php';
require_once '../../components/file_upload.php';

if (isset($_SESSION['user']) != "") {
    header("Location: ../../home.php");
    exit;
}

if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: ../../dashboard.php");
    exit;
}

if ($_POST) {
    $name = $_POST['pet_name'];
    $breed = $_POST['breed'];
    $size = $_POST['size'];
    $age = $_POST['age'];
    $description = $_POST['pet_description'];
    $hobbies = $_POST['hobbies'];
    $address = $_POST['pet_address'];
    $picture = $_POST['picture'];
    $id = $_POST['petID'];
    //variable for upload pictures errors is initialised
    $uploadError = '';

    $picture = file_upload($_FILES['picture'], "animal"); //file_upload() called  
    if ($picture->error == 0) {
        ($_POST["picture"] == "avatar.png") ?: unlink("../../pictures/$_POST[picture]");
        $sql = "UPDATE animals SET pet_name = '$name', breed = '$breed', size = '$size', age = $age, pet_description ='$description', hobbies = '$hobbies', pet_address = '$address', picture = '$picture->fileName' WHERE petID = {$id}";
    } else {
        $sql = "UPDATE animals SET pet_name = '$name', breed = '$breed', size ='$size', age = $age, pet_description ='$description', hobbies ='$hobbies', pet_address= '$address' WHERE petID = {$id}";
    }

    if (mysqli_query($connect, $sql) === TRUE) {
        $class = "success";
        $message = "The record was successfully updated";
        $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : '';
    } else {
        $class = "danger";
        $message = "Error while updating record : <br>" . mysqli_connect_error();
        $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : '';
    }
    mysqli_close($connect);
} else {
    header("location: ../../error.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update</title>
    <?php require_once '../../components/boot.php' ?>
</head>

<body>
    <div class="container">
        <div class="mt-3 mb-3">
            <h1>Update request response</h1>
        </div>
        <div class="alert alert-<?php echo $class; ?>" role="alert">
            <p><?php echo ($message) ?? ''; ?></p>
            <p><?php echo ($uploadError) ?? ''; ?></p>
            <a href='../update.php?id=<?= $id; ?>'><button class="btn btn-warning" type='button'>Back</button></a>
            <a href='../../dashboard.php'><button class="btn btn-success" type='button'>Home</button></a>
        </div>
    </div>
</body>

</html>