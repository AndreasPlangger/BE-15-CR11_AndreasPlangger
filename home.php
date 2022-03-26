<?php
session_start();

require_once 'components/db_connect.php';

// if adm will redirect to dashboard
if (isset($_SESSION['adm'])) {
    header("Location: dashboard.php");
    exit;
}
// if session is not set this will redirect to login page
if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

// select logged-in users details - procedural style
$res = mysqli_query($connect, "SELECT * FROM users WHERE userid=" . $_SESSION['user']);
$rowu = mysqli_fetch_array($res, MYSQLI_ASSOC);

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
    <?php require_once 'components/boot.php' ?>
    <style type="text/css">
        .userImage {
            width: auto;
            height: 100px;
        }

        .hero {
            width: 103%;
            height: 23vh;
            background: rgb(2, 0, 36);
            background: linear-gradient(90deg, rgba(2, 0, 36, 1) 0%, rgba(37, 201, 156, 1) 0%, rgba(0, 255, 181, 0.8337710084033614) 100%);

        }

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
            width: 60px;
        }
    </style>
</head>

<body>



    <div class="manageProduct w-75 mt-5">

        <div class="container m-0 p-0">
            <div class="hero d-flex flex-column align-items-center">
                <p class="h1 mt-5 text-center">Hi <?php echo $rowu['first_name']; ?> ! </p>
                <p class='h3 text-center' style='padding-top: 2vh; padding-bottom: 2vh;'>Meet your new best friend!</p>
            </div>
            <a href="logout.php?logout">Sign Out</a>
            <a href="update.php?id=<?php echo $_SESSION['user'] ?>">Update your profile</a>
        </div>




        <div class='mb-4 d-flex justify-content-end'>
            <a href="senior.php"><button class='btn btn-primary' type="button">Show senior animals only</button></a>
        </div>

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
    </div>

</body>

</html>