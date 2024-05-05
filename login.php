<?php
include ('db.php');
// session_start();
?>

<?php

$errors = [];

if (isset($_POST['login'])){
    $firstname = $_POST['firstname'];
    $password = $_POST['password'];

    // select query 
    $select = "SELECT * FROM `register` WHERE firstname = '$firstname' AND password = '$password' ";
    $result_select = mysqli_query($connect, $select);

    if (mysqli_num_rows($result_select) == 1){
        $_SESSION['firstname'] = $firstname;
        header('Location: profile.php');
        exit();
    }
    else{
        $errors['login'] = "Invalid inputs try again";
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
        .container{
            text-align: center;
            margin: 20px auto;
        }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Login</h2>

    <form action="" method="post">
        <div class="container">
            <label for="firstname">Firstname</label>
            <input type="text" placeholder="firstname" name="firstname">
            <span> <?php echo isset($errors['login']) ? $errors['login'] : ''; ?> </span>
        </div>
        
        <div class="container">
            <label for="password">Password</label>
            <input type="password" placeholder="password" name="password">
        </div>

        <div class="container">
            <button type="submit" value="submit" name="login">Login</button>
        </div>
    </form>

    <div class="container">
        <h4>New User? <a href="register.php">Register Here</a></h4>
    </div>
</body>
</html>