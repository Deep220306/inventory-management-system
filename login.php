<?php
session_start();

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    if($username == "admin" && $password == "admin123"){

        $_SESSION['admin'] = $username;

        header("Location: products.php");

    }else{

        $error = "Invalid Username or Password";

    }
}
?>

<!DOCTYPE html>
<html>

<head>

    <title>Login</title>

    <link rel="stylesheet" href="css/style.css">

</head>

<body class="login-body">

<div class="login-container">

    <h1>Inventory Login</h1>

    <?php if(isset($error)){ ?>

        <p class="error"><?php echo $error; ?></p>

    <?php } ?>

    <form method="POST">

        <input type="text"
               name="username"
               placeholder="Username"
               required>

        <input type="password"
               name="password"
               placeholder="Password"
               required>

        <button type="submit" name="login">
            Login
        </button>

    </form>

</div>

</body>

</html>