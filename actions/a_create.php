<?php
require_once '../components/db_connect.php';
require_once '../components/file_upload.php';

if ($_POST) {
    $name = $_POST['pet_name'];
    $breed = $_POST['breed'];
    $size = $_POST['size'];
    $age = $_POST['age'];
    $description = $_POST['pet_description'];
    $hobbies = $_POST['hobbies'];
    $address = $_POST['pet_address'];
    $picture = $_POST['picture'];

    $uploadError = '';
    //this function exists in the service file upload.
    $picture = file_upload($_FILES['picture']);

    $sql = "INSERT INTO animals (petID, pet_name, breed, size, age, pet_description, hobbies, pet_address, picture) VALUES (NULL, '$name', '$breed', '$size', $age,'$description', '$hobbies', '$address', '$picture->fileName')";

    if (mysqli_query($connect, $sql) === true) {
        $class = "success";
        $message = "The entry below was successfully created <br>
            <table class='table w-50'><tr>
            <td> $name </td>
            <td> $breed </td>
            <td> $size </td>
            <td> $age </td>
            <td> $description </td>
            <td> $hobbies </td>
            <td> $address </td>
            </tr></table><hr>";
        $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : '';
    } else {
        $class = "danger";
        $message = "Error while creating record. Try again: <br>" . $connect->error;
        $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : '';
    }
    mysqli_close($connect);
} else {
    header("location: ../error.php");
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update</title>
    <?php require_once '../components/boot.php' ?>
</head>

<body>
    <div class="container">
        <div class="mt-3 mb-3">
            <h1>Create request response</h1>
        </div>
        <div class="alert alert-<?= $class; ?>" role="alert">
            <p><?php echo ($message) ?? ''; ?></p>
            <p><?php echo ($uploadError) ?? ''; ?></p>
            <a href='../dashboard.php'><button class="btn btn-warning" type='button'>Return to Dashboard</button></a>
        </div>
    </div>
</body>

</html>