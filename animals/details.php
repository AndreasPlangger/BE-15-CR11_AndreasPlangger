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
        $tcontent = "<tr>
            <td>" . $breed . "</td>
            <td>" . $size . "</td>
            <td>" . $age . "</td>
            <td>" . $description . "</td>
            <td>" . $hobbies . "</td>
            <td>" . $address . "</td>
            <td><a href='../adopt.php?petID=" . $_GET['petID'] . "'><button class='btn btn-success w-100' type='button'>Take me home</button></a>
            <a href='../home.php'><button class='btn btn-warning w-100 mt-1' type='button'>Back</button></a>
            </tr>";
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
    <title>Animal details</title>
    <?php require_once '../components/boot.php' ?>
    <style type="text/css">
        .manageProduct {
            margin: auto;
            width: 90%;
        }

        .img-thumbnail {
            width: 70px !important;
            height: 70px !important;
        }

        td {
            text-align: center;
            vertical-align: middle;
        }

        tr {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="manageProduct mt-3">
        <p class='h2 text-center mt-5 mb-5'> <?= $name ?> </p>
        <img src="../pictures/<?= $picture ?>" class="rounded mx-auto d-block mb-3 " alt="<?= $name ?>" width="250px">
        <table class='table table-striped'>
            <thead class='table-success text-nowrap'>
                <tr>
                    <th style='padding-top: 2vh; padding-bottom: 2vh; font-size: large'>Breed</th>
                    <th style='padding-top: 2vh; padding-bottom: 2vh; font-size: large'>Size</th>
                    <th style='padding-top: 2vh; padding-bottom: 2vh; font-size: large'>Age</th>
                    <th style='padding-top: 2vh; padding-bottom: 2vh; font-size: large'>Description</th>
                    <th style='padding-top: 2vh; padding-bottom: 2vh; font-size: large'>Hobbies</th>
                    <th style='padding-top: 2vh; padding-bottom: 2vh; font-size: large'>Address</th>
                    <th style='padding-top: 2vh; padding-bottom: 2vh; font-size: large'>Action</th>
                </tr>
            </thead>
            <tbody>
                <?= $tcontent; ?>
            </tbody>
        </table>
        <div class='mb-3 d-flex justify-content-end'>



        </div>
    </div>
</body>

</html>