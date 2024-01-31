<?php
session_start();

$server = "localhost";
$username = "root";
$password = "";


$con = mysqli_connect($server, $username, $password, $database);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST['login'])) {
    $Email = $_POST['email']; 
    $Password = $_POST['password'];

    $stmt = $con->prepare("SELECT * FROM `user.user` WHERE Email=? AND Password=?");
   $stmt = $con->prepare("SELECT * FROM `user.user` WHERE Email=? AND Password=?");
if ($stmt === false) {
    die("Prepare failed: (" . $con->errno . ") " . $con->error);
}
$stmt->bind_param("ss", $email, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $_SESSION['Email'] = $email;
    echo "LogIn Successful";
    
} else {
    echo "Invalid Email or Password";
}

$stmt->close();

}

$con->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link rel="stylesheet" href="logo.css">

</head>
<body>
    <h2>User Login</h2>
    <form action="" method="post">
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit" name="login">Login</button>
    </form>
    <form action="register.php" method="post">
        <h3>New User</h3>
        <button type="submit">Register</button>
    </form>
</body>
</html>
