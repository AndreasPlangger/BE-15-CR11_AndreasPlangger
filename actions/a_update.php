<?php
require_once '../components/db_connect.php';
require_once '../components/file_upload.php';

if ($_POST) {
    $name = $_POST['pet_name'];
    $breed = $data['breed'];
    $size = $data['size'];
    $age = $data['age'];
    $description = $data['pet_description'];
    $hobbies = $data['hobbies'];
    $address = $data['pet_address'];
    $picture = $data['picture'];
    $id = $_POST['petID'];
    //variable for upload pictures errors is initialised
    $uploadError = '';

    $picture = file_upload($_FILES['picture']); //file_upload() called  
    if ($picture->error === 0) {
        ($_POST["picture"] == "product.png") ?: unlink("../pictures/$_POST[picture]");
        $sql = "UPDATE animals SET name = '$name', '$breed', '$size', age = $age, '$description', '$hobbies', '$address', picture = '$picture->fileName' WHERE petID = {$id}";
    } else {
        $sql = "UPDATE animals SET name = '$name', '$breed', '$size', age = $age, '$description', '$hobbies', '$address' WHERE petID = {$id}";
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
            <h1>Update request response</h1>
        </div>
        <div class="alert alert-<?php echo $class; ?>" role="alert">
            <p><?php echo ($message) ?? ''; ?></p>
            <p><?php echo ($uploadError) ?? ''; ?></p>
            <a href='../update.php?id=<?= $id; ?>'><button class="btn btn-warning" type='button'>Back</button></a>
            <a href='../dashboard.php'><button class="btn btn-success" type='button'>Home</button></a>
        </div>
    </div>
</body>

</html>