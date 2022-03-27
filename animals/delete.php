<?php
require_once '../components/db_connect.php';

if ($_GET['petID']) {
    $id = $_GET['petID'];
    $sql = "SELECT * FROM animals WHERE petID = {$id}";
    $result = mysqli_query($connect, $sql);
    $data = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) == 1) {
        $name = $data['pet_name'];
        $breed = $data['breed'];
        $size = $data['size'];
        $age = $data['age'];
        $description = $data['pet_description'];
        $hobbies = $data['hobbies'];
        $address = $data['pet_address'];
        $picture = $data['picture'];
    } else {
        header("location: ../error.php");
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Animal</title>
    <?php require_once '../components/boot.php' ?>
    <style type="text/css">
        fieldset {
            margin: auto;
            margin-top: 100px;
            width: 70%;
        }

        .img-thumbnail {
            width: 120px !important;
            height: 120px !important;
        }
    </style>
</head>

<body>
    <fieldset>
        <legend class='h2 mb-3'>Delete request <img class='img-thumbnail rounded-circle' src='../pictures/<?php echo $picture ?>' alt="<?php echo $name ?>"></legend>
        <h5>You have selected the animal below:</h5>
        <table class="table w-75 mt-3">
            <tr>
                <td><?php echo $name ?></td>
            </tr>
        </table>

        <h3 class="mb-4">Do you really want to delete?</h3>
        <form action="actions/a_delete.php" method="post">
            <input type="hidden" name="petID" value="<?php echo $id ?>" />
            <input type="hidden" name="picture" value="<?php echo $picture ?>" />
            <button class="btn btn-danger" type="submit">Yes, delete.</button>
            <a href="../dashboard.php"><button class="btn btn-warning" type="button">No, go back!</button></a>
        </form>
    </fieldset>
</body>

</html>