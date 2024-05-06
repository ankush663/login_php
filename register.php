<?php
include('db.php');
?>




<?php
$errors = array();

if (isset($_POST['submit'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_pass = $_POST['confirm_password'];
    $gender = $_POST['gender'];
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];
    // mail
    $check_mail = "SELECT * FROM `register` WHERE email = '$email' ";
    $result_mail = mysqli_query($connect, $check_mail);
    //mobile
    $check_mobile = "SELECT * FROM `register` WHERE mobile = '$mobile'";
    $result_mobile = mysqli_query($connect, $check_mobile);

if (mysqli_num_rows($result_mail) > 0) {
    $errors['email'] = "Email already exists";
} elseif (empty($email)) {
    $errors['email'] = "Email cannot be empty";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = "Invalid email format";
}

    if (mysqli_num_rows($result_mobile) > 0) {
        $errors['mobile'] = "Mobile number already exists";
    } elseif (empty($mobile)) {
        $errors['mobile'] = "Mobile number cannot be empty";
    } elseif (strlen($mobile) != 10) {
        $errors['mobile'] = "Mobile number must be 10 digits";
    }

    if (empty($firstname)) {
        $errors['firstname'] = "Firstname is required";
} elseif (preg_match('/[0-9]/', $firstname)) {
        $errors['firstname'] = "Firstname should not contain numbers";
    }

    if (empty($lastname)) {
        $errors['lastname'] = "Lastname is required";
    } elseif (preg_match('/[0-9]/', $lastname)) {
        $errors['lastname'] = "Lastname should not contain numbers";
    }

    if (empty($gender)) {
        $errors['gender'] = "Please select gender";
    }

    if (empty($address)) {
        $errors['address'] = "Please enter the address";
    }

    if (empty($password)) {
        $errors['password'] = "Password cannot be empty";
    } elseif (empty($confirm_pass)) {
        $errors['confirm_password'] = "It cannot be blank";
    }
elseif ($password != $confirm_pass) {
        $errors['password'] = "Password is not match....enter again";
    }

    if (empty($errors)) {
        // insert query 
        $insert = "INSERT INTO `register` (firstname, lastname, gender, email, password, mobile, address) 
                            values ('$firstname', '$lastname', '$gender', '$email', '$password', '$mobile', '$address')";

        $check = mysqli_query($connect, $insert);
        if ($check) {
            echo "<script> alert('Data Inserted Successfully') </script>";
        } else {
            echo "<script> alert('Something went wrong') </script>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .container {
            text-align: center;
            margin: 10px;
        }

        h3 {
            text-align: center;
        }

        .error {
            color: red;
        }
    </style>
</head>

<body>
    <h3>New User Registration</h3>

    <form action="" method="post">

        <div class="container">
            <label for="firstname">Firstname:-</label>
            <input type="text" placeholder="Firstname" name="firstname">
            <span class="error"><?php echo isset($errors['firstname']) ? $errors['firstname'] : ''; ?></span>
        </div>

        <div class="container">
            <label for="lastname">Lastname:-</label>
            <input type="text" placeholder="Lastname" name="lastname">
            <span class="error"><?php echo isset($errors['lastname']) ? $errors['lastname'] : ''; ?></span>
        </div>

        <div class="container">
            <label for="email">Email:-</label>
            <input type="text" placeholder="Email" name="email" autocomplete="off">
            <span class="error"><?php echo isset($errors['email']) ? $errors['email'] : ''; ?></span>
        </div>

        <div class="container">
            <label for="password">Password:-</label>
            <input type="password" placeholder="password" name="password">
            <span class="error"><?php echo isset($errors['password']) ? $errors['password'] : ''; ?></span>
        </div>

        <div class="container">
            <label for="confirm_password">Confirm Password:-</label>
            <input type="password" placeholder="confirm_password" name="confirm_password">
            <span class="error"><?php echo isset($errors['confirm_password']) ? $errors['confirm_password'] : ''; ?></span>
        </div>

        <div class="container">
            <label for="gender">Gender:-</label>
            <select name="gender" id="">
                <option value="">Select</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>
            <span class="error"><?php echo isset($errors['gender']) ? $errors['gender'] : ''; ?></span>
        </div>

        <div class="container">
            <label for="mobile">Mobile:-</label>
            <input type="text" placeholder="Mobile" name="mobile">
            <span class="error"><?php echo isset($errors['mobile']) ? $errors['mobile'] : ''; ?></span>
        </div>

        <div class="container">
            <label for="address">Address:-</label>
            <input type="text" placeholder="Address" name="address">
            <span class="error"><?php echo isset($errors['address']) ? $errors['address'] : ''; ?></span>
        </div>
        <div class="container">
            <button type="submit" name="submit">Submit</button>
        </div>

        <div class="container">
            <h4>Already Register ? <a href="login.php">Login now</a></h4>
        </div>
    </form>
</body>

</html>