<?php
require_once 'components/db_connect.php';

if ($_GET['petID']) {
    $id = $_GET['petID'];
    $sql = "SELECT * FROM animals WHERE petID = {$id}";
    $result = mysqli_query($connect, $sql);
    if (mysqli_num_rows($result) == 1) {
        $data = mysqli_fetch_assoc($result);
        $name = $data['pet_name'];
        $breed = $data['breed'];
        $size = $data['size'];
        $age = $data['age'];
        $description = $data['pet_description'];
        $hobbies = $data['hobbies'];
        $address = $data['pet_address'];
        $picture = $data['picture'];
    } else {
        header("location: error.php");
    }
    mysqli_close($connect);
} else {
    header("location: error.php");
}
?>


<!DOCTYPE html>
<html>

<head>
    <title>Edit Product</title>
    <?php require_once 'components/boot.php' ?>
    <style type="text/css">
        fieldset {
            margin: auto;
            margin-top: 100px;
            width: 60%;
        }

        .img-thumbnail {
            width: 120px !important;
            height: 120px !important;
        }
    </style>
</head>

<body>
    <fieldset>
        <legend class='h2'>Update request <img class='img-thumbnail rounded-circle' src='pictures/<?php echo $picture ?>' alt="<?php echo $name ?>"></legend>
        <form action="actions/a_update.php" method="post" enctype="multipart/form-data">
            <table class="table">
                <tr>
                    <th>Name</th>
                    <td><input class='form-control' type="text" name="pet_name" placeholder="Animal Name" /></td>
                </tr>
                <tr>
                    <th>Breed</th>
                    <td><input class='form-control' type="text" name="breed" placeholder="Breed" step="any" /></td>
                </tr>
                <tr>
                    <th>Size</th>
                    <td><input class='form-control' type="text" name="size" placeholder="very small/small/medium/large/very large" step="any" /></td>
                </tr>
                <tr>
                    <th>Age</th>
                    <td><input class='form-control' type="number" name="age" placeholder="Age" step="any" /></td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td><input class='form-control' type="text" name="pet_description" placeholder="Description" step="any" /></td>
                </tr>
                <tr>
                    <th>Hobbies</th>
                    <td><input class='form-control' type="text" name="hobbies" placeholder="Hobbies" step="any" /></td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td><input class='form-control' type="text" name="pet_address" placeholder="Address" step="any" /></td>
                </tr>
                <tr>
                    <th>Picture</th>
                    <td><input class='form-control' type="file" name="picture" /></td>
                </tr>
                <tr>
                    <input type="hidden" name="id" value="<?php echo $data['id'] ?>" />

                    <input type="hidden" name="picture" value="<?php echo $data['picture'] ?>" />
                    <td><button class="btn btn-success" type="submit">Save Changes</button></td>
                    <td><a href="dashboard.php"><button class="btn btn-warning" type="button">Back</button></a></td>
                </tr>
            </table>
        </form>
    </fieldset>
</body>

</html>