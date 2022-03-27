<?php
session_start();

require_once '../components/db_connect.php';

$sql = "SELECT * FROM `animals` WHERE age > 8";
$result = mysqli_query($connect, $sql);

$tbody = ''; //this variable will hold the body for the table
if (mysqli_num_rows($result)  > 0) {
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $tbody .=
            "<tr>
            <td><img class='img-thumbnail' src='../pictures/" . $row['picture'] . "'</td>
            <td>" . $row['pet_name'] . "</td>
            <td>" . $row['breed'] . "</td>
            <td>" . $row['size'] . "</td>
            <td>" . $row['age'] . "</td>
            <td>" . $row['pet_description'] . "</td>
            <td>" . $row['hobbies'] . "</td>
            <td>" . "<a href='details.php?petID=" . $row['petID'] . "'><button class='btn btn-success' type='button'><span class='text-nowrap'>More Info</span></button></a></td>
            </tr>";
    };
} else {
    $tbody =  "<tr><td colspan='5'><center>No Data Available </center></td></tr>";
}

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adopt a PET!</title>
    <?php require_once '../components/boot.php' ?>
    <style type="text/css">
        .manageProduct {
            margin: auto;
        }

        .img-thumbnail {
            width: auto !important;
            height: 18vh !important;
        }

        td {
            text-align: center;
            vertical-align: middle;
        }

        tr {
            text-align: center;
        }

        .custom {
            width: 95px;
        }
    </style>
</head>

<body>

    <div class="manageProduct w-75 mt-3">
        <p class='h1 mb-3 mt-3 text-center' style='padding-top: 6vh; padding-bottom: 4vh;'>Our seniors</p>
        <table class='table table-border table-striped'>
            <thead class='table-success'>
                <tr>
                    <th style='padding-top: 2vh; padding-bottom: 2vh; font-size: large'>Picture</th>
                    <th style='padding-top: 2vh; padding-bottom: 2vh; font-size: large'>Name</th>
                    <th style='padding-top: 2vh; padding-bottom: 2vh; font-size: large'>Breed</th>
                    <th style='padding-top: 2vh; padding-bottom: 2vh; font-size: large'>Size</th>
                    <th style='padding-top: 2vh; padding-bottom: 2vh; font-size: large'>Age</th>
                    <th style='padding-top: 2vh; padding-bottom: 2vh; font-size: large'>Description</th>
                    <th style='padding-top: 2vh; padding-bottom: 2vh; font-size: large'>Hobbies</th>
                    <th style='padding-top: 2vh; padding-bottom: 2vh; font-size: large'>Details</th>


                </tr>
            </thead>
            <tbody>
                <?= $tbody; ?>
            </tbody>
        </table>

        <div class='mb-3 d-flex justify-content-end'>
            <a href="../home.php"><button class='btn btn-warning custom me-1' type="button">Back</button></a>
        </div>

    </div>
</body>

</html>