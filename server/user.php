<?php
session_start();
error_reporting(0);
// initializing variables
$username = "";
$email    = "";
$errors = array(); 

// connect to the database
  $db = mysqli_connect('3.27.67.148', 'bip_root', 'Eric137456', 'bip_BIP');
  // Check connection
  if (!$db) {
      $db = mysqli_connect('localhost', 'root', '', 'BIP');
  }
// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO users (username, email, password) 
  			  VALUES('$username', '$email', '$password')";
    
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	// header('location: dashboard.php');
    echo "<script>console.log('{$query}')</script>";
    array_push($errors, "Registration Successful");
  }
}

// LOGIN USER
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	$password = md5($password);
  	$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
  	$results = mysqli_query($db, $query);

  	if (mysqli_num_rows($results) == 1) {
      $user_check_query = "SELECT * FROM users WHERE username='$username'";
      $result = mysqli_query($db, $user_check_query);
      $user = mysqli_fetch_assoc($result);

      $_SESSION['id'] = $user['id'];
      $_SESSION['role'] = $user['role'];
  	  $_SESSION['username'] = $username;
  	  $_SESSION['success'] = "You are now logged in";  
  	  header('location: home.php');
  	}else {
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}

if (isset($_POST['changepassword'])) {

  $username = $_SESSION['username'];
  
  $newPassword = mysqli_real_escape_string($db, $_POST['newPassword']);
  $confirmPassword = mysqli_real_escape_string($db, $_POST['confirmPassword']);  

  if ($newPassword == $confirmPassword){
    $password = md5($newPassword);
    mysqli_query($db,"UPDATE users set password='" . $password . "' WHERE username='" . $username . "'");
    echo '<script>alert("Password Changed Sucessfully!");
                  window.location.href="home.php";</script>';
  }else{
    array_push($errors, "Your confirmation password does not match the new password.");
  }
  
}
?>