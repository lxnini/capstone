<?php
session_start();
include 'config/database.php';

if(isset($_POST['login'])){

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email='$email'";
$result = mysqli_query($conn,$sql);
$user = mysqli_fetch_assoc($result);

if($user && password_verify($password,$user['password'])){

$_SESSION['user_id'] = $user['id'];
$_SESSION['name'] = $user['name'];

header("Location: index.php");

}else{

echo "Invalid Email or Password";

}

}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>
</head>

<body>

<h2>Church Staff Login</h2>

<form method="POST">

Email<br>
<input type="email" name="email" required><br><br>

Password<br>
<input type="password" name="password" required><br><br>

<button type="submit" name="login">Login</button>

</form>

<a href="signup.php">Create Account</a>

</body>
</html>