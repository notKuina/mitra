<?php
include 'connection.php';

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
  

    // Prepare the SQL statement with a placeholder for email
    $sql = "SELECT * FROM `userinfo` WHERE email='$email'";

    // Get the result
    $result = mysqli_query($con,$sql);

    if ($result && mysqli_num_rows($result) == 1) {
        // Fetch the user data
        $row = mysqli_fetch_assoc($result);

        // Verify the password
        if ($password==$row['password']) {
            // Login successful
            session_start();
            $_SESSION['email'] = $email;
            header('location:accountAfterLogin.php'); // Redirect to dashboard or any other page
            exit();
        } else {
            // Invalid password
            echo '<script>alert("Failed to login. Invalid password.");</script>';
        }
    } else {
        // Invalid email address
        echo '<script>alert("Failed to login. Invalid email address.");</script>';
    }

   
    mysqli_close($con);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Page</title>

<link rel="stylesheet" href="login.css">
</head>
<body>
<!-- <header>
  <nav>
    <div class="logo">
      <img src="logo.png" alt="Logo">
    </div>
    <ul class="nav-links">
      <li><a href="#">Home</a></li>
      <li><a href="#">Contact</a></li>
     
    </ul>
  </nav>
</header> -->
<div class="container">

  <div class="signup-container">
    <img src="images/mitralogo.png" alt="error" >
    <h2>Don't have an account?</h2>
    <button id="signup-btn"><a href="signup2.html">Sign Up<a></button>
  </div>
  <div class="login-container">
    <h2>Login</h2><br><br>
    <form method="post">
    <div class="form-group">
       <img src="images/manh.png" alt="error" >
      </div><br><br>
      <div class="form-group">
        <input type="email" id="email" name="email" placeholder="Email" style="background-image: url('images/email.png'); background-repeat: no-repeat; background-size: 20px 20px; padding-left: 40px; background-position: 10px center;">
        <span id="emailError" class="error"></span>
      </div>
      <div class="form-group">
        <label for="password"></label>
        <input type="password" id="password" name="password" placeholder="Password" style="background-image: url('images/key.png'); background-repeat: no-repeat; background-size: 20px 20px; padding-left: 40px; background-position: 10px center;" >
        <span id="passwordError" class="error"></span>
      </div>
      <div class="form-group">
        <a href="#" class="forgetpassword.html">Forgot Password?</a>
      </div>
      <button type="submit" name="login" class="login-button">Login</button>
    </form>
  </div>
</div>

</body>
</html>
