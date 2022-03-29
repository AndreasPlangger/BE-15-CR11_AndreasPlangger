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
            "<div class='col'>
                <div class='card h-100 shadow justify-content-center'>
                    <img src='pictures/" . $row['picture'] . "'' class='card-img-top' alt='" . $row['pet_name'] . "'>
                    <div class='card-body'>
                    <h4 class='card-title text-center'>" . $row['pet_name'] . "</h5>
                    <p class='card-text'>Breed: " . $row['breed'] . "   </p>
                    <p class='card-text'>Size: " . $row['size'] . "   </p>
                    <p class='card-text'>Age: " . $row['age'] . "   </p>
                    <p class='card-text'>Hobbies: " . $row['hobbies'] . "   </p>
                    <p class='card-text'>" . $row['pet_description'] . "   </p>
                    <span class='d-flex justify-content-center '>" . "<a href='animals/details.php?petID=" . $row['petID'] . "'><button class='btn btn-success' type='button'><span class='text-nowrap'>More Info</span></button></a></span>
                    </div>
                    </div>
                </div>";
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
        @media (min-width: 1400px) {

            .container,
            .container-lg,
            .container-md,
            .container-sm,
            .container-xl,
            .container-xxl {
                max-width: 1420px !important;
            }

            .img-thumbnail {
                width: 12rem !important;
                height: 12rem !important;
                position: absolute;
                margin-top: 4vh;
                margin-left: 1vw;
            }

            .container {
                width: 100% !important;

            }
        }

        .hero {
            width: 100% !important;
            height: 28vh;
            background: rgb(2, 0, 36);
            background: linear-gradient(90deg, rgba(2, 0, 36, 1) 0%, rgba(37, 201, 156, 1) 0%, rgba(0, 255, 181, 0.8337710084033614) 100%);

        }

        .manageProduct {
            margin: auto;
        }

        .card-img-top {
            width: auto !important;
            height: 45vh !important;
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



    <div class="manageProduct w-75 mt-3">
        <div class="container m-0 p-0">
            <img class='img-thumbnail rounded-circle' src='pictures/<?php echo $rowu['picture'] ?>' alt="<?php echo $rowu['first_name'] ?>">
            <div class="hero d-flex flex-column align-items-center">
                <p class='h1 mt-5 text-center' style='padding-top: 2vh; padding-bottom: 1vh;'>Hi <?php echo $rowu['first_name']; ?> ! </p>
                <p class='h3 text-center' style='padding-top: 1vh; padding-bottom: 2vh;'>Meet your new best friend!</p>
            </div>

        </div>
        <span class='d-flex'>
            <div class='w-50 mb-4 d-flex justify-content-beginning' style='margin-top: 4vh; margin-bottom: 2vh;'>
                <a href="logout.php?logout"><button class='btn btn-primary me-1 text-white' type="button">Sign Out</button></a>
                <a href="update.php?id=<?php echo $_SESSION['user'] ?>"><button class='btn btn-primary text-white' type="button">Update your profile</button></a>
            </div>
            <div class=' w-50 mb-4 d-flex justify-content-end' style='margin-top: 4vh; margin-bottom: 2vh;'>
                <a href="animals/senior.php"><button class='btn btn-success text-white' type="button">Show senior animals only</button></a>
            </div>
        </span>
        <div class='row row-cols-1 row-cols-md-3 row-cols-lg-4 g-5'>
            <tbody>
                <?= $tbody; ?>
            </tbody>
        </div>
    </div>

</body>

</html>