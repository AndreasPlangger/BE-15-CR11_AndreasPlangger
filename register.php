<?php

session_start();

// start a new session or continues the previous
if (isset($_SESSION['user']) != "") {
    header("Location: home.php"); // redirects to home.php
}
if (isset($_SESSION['adm']) != "") {
    header("Location: dashboard.php"); // redirects to dashboard.php
}
require_once 'components/db_connect.php';
require_once 'components/file_upload.php';
$error = false;
$fname = $lname = $address = $phone = $email = $pass = $picture = '';
$fnameError = $lnameError = $addressError = $phoneError = $emailError = $passError = $picError = '';
if (isset($_POST['btn-signup'])) {

    // sanitise user input to prevent sql injection
    // trim - strips whitespace (or other characters) from the beginning and end of a string
    $fname = trim($_POST['first_name']);


    // strip_tags -- strips HTML and PHP tags from a string
    $fname = strip_tags($fname);

    // htmlspecialchars converts special characters to HTML entities
    $fname = htmlspecialchars($fname);

    $lname = trim($_POST['last_name']);
    $lname = strip_tags($lname);
    $lname = htmlspecialchars($lname);

    $address = trim($_POST['address']);
    $address = strip_tags($address);
    $address = htmlspecialchars($address);

    $phone = trim($_POST['phone']);
    $phone = strip_tags($phone);
    $phone = htmlspecialchars($phone);

    $email = trim($_POST['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);

    $pass = trim($_POST['password']);
    $pass = strip_tags($pass);
    $pass = htmlspecialchars($pass);

    $uploadError = '';
    $picture = file_upload($_FILES['picture']);

    // basic name validation
    if (empty($fname) || empty($lname)) {
        $error = true;
        $fnameError = "Please enter your full name and surname";
    } else if (strlen($fname) < 3 || strlen($lname) < 3) {
        $error = true;
        $fnameError = "Name and surname must have at least 3 characters.";
    } else if (!preg_match("/^[a-zA-Z]+$/", $fname) || !preg_match("/^[a-zA-Z]+$/", $lname)) {
        $error = true;
        $fnameError = "Name and surname must contain only letters and no spaces.";
    }

    // basic address validation
    if (empty($address)) {
        $error = true;
        $addressError = "Please enter your full address";
    } else if (strlen($address) < 3) {
        $error = true;
        $addressError = "Address must have at least 3 characters.";
    } else if (!preg_match("/^[a-z A-Z0-9]+$/", $address)) {
        $error = true;
        $addressError = "Address must contain only letters and no spaces.";
    }

    // basic phone validation
    if (empty($phone)) {
        $error = true;
        $phoneError = "Please enter your phone number";
    } else if (strlen($address) < 8) {
        $error = true;
        $phoneError = "Phone number must have at least 8 digits.";
    } else if (!preg_match("/^[0-9]+$/", $phone)) {
        $error = true;
        $phoneError = "Phone number must contain only digits and no spaces.";
    }

    // basic email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $emailError = "Please enter valid email address.";
    } else {
        // checks whether the email exists or not
        $query = "SELECT email FROM users WHERE email='$email'";
        $result = mysqli_query($connect, $query);
        $count = mysqli_num_rows($result);
        if ($count != 0) {
            $error = true;
            $emailError = "Provided Email is already in use.";
        }
    }
    // password validation
    if (empty($pass)) {
        $error = true;
        $passError = "Please enter password.";
    } else if (strlen($pass) < 6) {
        $error = true;
        $passError = "Password must have at least 6 characters.";
    }

    // password hashing for security
    $password = hash('sha256', $pass);
    // if there's no error, continue to signup
    if (!$error) {

        $query = "INSERT INTO users(first_name, last_name, address, phone, password, email, picture)
                VALUES('$fname', '$lname', '$address', '$phone', '$password', '$email', '$picture->fileName')";
        $res = mysqli_query($connect, $query);

        if ($res) {
            $errTyp = "success";
            $errMSG = "Successfully registered, you may login now";
            $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : '';
        } else {
            $errTyp = "danger";
            $errMSG = "Something went wrong, try again later...";
            $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : '';
        }
    }
}

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Registration System</title>
    <?php require_once 'components/boot.php' ?>
</head>

<body>
    <div class="container">
        <form class="w-75 mt-3" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off" enctype="multipart/form-data">
            <h2>Sign Up.</h2>
            <hr />
            <?php
            if (isset($errMSG)) {
            ?>
                <div class="alert alert-<?php echo $errTyp ?>">
                    <p><?php echo $errMSG; ?></p>
                    <p><?php echo $uploadError; ?></p>
                </div>

            <?php
            }
            ?>

            <input type="text" name="first_name" class="form-control" placeholder="First name" maxlength="65" value="<?php echo $fname ?>" />
            <span class="text-danger"> <?php echo $fnameError; ?> </span>

            <input type="text" name="last_name" class="form-control" placeholder="Surname" maxlength="65" value="<?php echo $lname ?>" />
            <span class="text-danger"> <?php echo $fnameError; ?> </span>

            <input type="text" name="address" class="form-control" placeholder="Address" maxlength="65" value="<?php echo $address ?>" />
            <span class="text-danger"> <?php echo $addressError; ?> </span>

            <input type="text" name="phone" class="form-control" placeholder="Phone number" maxlength="25" value="<?php echo $phone ?>" />
            <span class="text-danger"> <?php echo $phoneError; ?> </span>

            <input type="email" name="email" class="form-control" placeholder="Enter Your Email" maxlength="35" value="<?php echo $email ?>" />
            <span class="text-danger"> <?php echo $emailError; ?> </span>
            <div class="d-flex">
                <input class='form-control w-100' type="file" name="picture">
                <span class="text-danger"> <?php echo $picError; ?> </span>
            </div>
            <input type="password" name="password" class="form-control" placeholder="Enter Password" maxlength="15" />
            <span class="text-danger"> <?php echo $passError; ?> </span>
            <hr />
            <button type="submit" class="btn btn-block btn-primary" name="btn-signup">Sign Up</button>
            <hr />
            <a href="login.php">Sign in Here...</a>
        </form>
    </div>
</body>

</html>