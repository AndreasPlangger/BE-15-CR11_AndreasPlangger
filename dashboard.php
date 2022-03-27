<?php
session_start();

require_once 'components/db_connect.php';

$sql = "SELECT * FROM animals";
$result = mysqli_query($connect, $sql);
$tbody = ''; //this variable will hold the body for the table
if (mysqli_num_rows($result)  > 0) {
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $tbody .=
            "<tr>
            <td><img class='img-thumbnail' src='pictures/" . $row['picture'] . "'</td>
            <td>" . $row['pet_name'] . "</td>
            <td>" . $row['breed'] . "</td>
            <td>" . $row['size'] . "</td>
            <td>" . $row['age'] . "</td>
            <td>" . $row['pet_description'] . "</td>
            <td>" . $row['hobbies'] . "</td>
            <td>" . $row['pet_address'] . "</td>
            <td><a href='animals/update.php?petID=" . $row['petID'] . "'><button class='btn btn-warning w-100 mb-2' type='button'><span class='text-nowrap'>Update</span></button></a>
            <a href='animals/delete.php?petID=" . $row['petID'] . "'><button class='btn btn-danger w-100 mb-2' type='button'><span class='text-nowrap'>Delete</span></button></a></td>
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
    <?php require_once 'components/boot.php' ?>
    <style type="text/css">
        .manageProduct {
            margin: auto;
        }

        .img-thumbnail {
            width: auto !important;
            height: 20vh !important;
        }

        td {
            text-align: center;
            vertical-align: middle;
        }

        tr {
            text-align: center;
        }

        .custom {
            width: 140px;
        }
    </style>
</head>

<body>

    <div class="manageProduct w-75 mt-3">
        <div class="container m-0 p-0">
            <div class="hero d-flex flex-column align-items-center">
                <p class="h1 mt-5 text-center"> <?php echo $rowu['first_name']; ?> </p>
                <p class='h3 text-center' style='padding-top: 2vh; padding-bottom: 2vh;'></p>
            </div>

        </div>

        <div class='mb-5 d-flex justify-content-end'>
            <a href="animals/create.php"><button class=' btn btn-success custom me-1' type="button">Add animal</button></a>
            <a href="logout.php?logout"><button class='btn btn-primary custom' type="button">Sign Out</button></a>
        </div>
        <table class='table table-border table-striped'>
            <thead class='table-success'>
                <tr>
                    <th style='padding-top: 2vh; padding-bottom: 2vh;'>Picture</th>
                    <th style='padding-top: 2vh; padding-bottom: 2vh;'>Name</th>
                    <th style='padding-top: 2vh; padding-bottom: 2vh;'>Breed</th>
                    <th style='padding-top: 2vh; padding-bottom: 2vh;'>Size</th>
                    <th style='padding-top: 2vh; padding-bottom: 2vh;'>Age</th>
                    <th style='padding-top: 2vh; padding-bottom: 2vh;'>Description</th>
                    <th style='padding-top: 2vh; padding-bottom: 2vh;'>Hobbies</th>
                    <th style='padding-top: 2vh; padding-bottom: 2vh;'>Address</th>
                    <th style='padding-top: 2vh; padding-bottom: 2vh;'>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?= $tbody; ?>
            </tbody>
        </table>
    </div>

</body>

</html>