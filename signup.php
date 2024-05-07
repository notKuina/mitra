<?php
include 'connection.php';

// Start the session
session_start();

if (isset($_POST['submit'])) {
    // Retrieve form data
    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $terms = isset($_POST['terms']) ? 1 : 0;

    // Check if username or email already exists
    $check_sql = "SELECT * FROM `userinfo` WHERE name='$name' OR email='$email'";
    $check_result = mysqli_query($con, $check_sql);

    if (mysqli_num_rows($check_result) > 0) {
        // Username or email already exists, display error message
        echo '<script>alert("Username or email already exists.");</script>';
    } else {
        // Insert the new user into the database
        $sql = "INSERT INTO `userinfo` (name, dob, email, password, terms)
                VALUES ('$name', '$dob', '$email', '$password', '$terms')";
        $result = mysqli_query($con, $sql);

        if ($result) {
            // Sign up successful, set session variables
            $_SESSION['email'] = $email;
            $_SESSION['name'] = $name;

            // Redirect the user to the dashboard or any other page
            header('Location: index.html');
            exit();
        } else {
            echo '<script>alert("Failed to sign up. Please try again.");</script>';
        }
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sign Up</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #20324A;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    form {
        background-color: #fff;
        padding: 20px;
        border-radius: 50px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 500px;
        height: 600px;
        display: flex;
        flex-direction: column;
        color:#656363;
        
    }
    .error {
    color: red;
    font-size: 12px;
    display: inline-block;
    margin-left: 10px;
    float:right;
  }
    h2{
    text-align: center;
    margin-bottom: 20px;
    color: #f2961b;
    font-weight: 100;
    }

    input[type="text"],
    input[type="email"],
    input[type="tel"],
    input[type="password"],
    select {
        width: 100%;
        padding: 10px;
        margin: 8px 0;
        border: 1px solid #7a7979;
        border-radius: 10px;
        box-sizing: border-box;
    }

    input[type="checkbox"] {
        margin-right: 5px;
    }

    .form-group {
        margin-bottom: 10px;
    }

    .form-group:last-child {
        margin-bottom: 0;
    }

    .btn-container {
        width: 100%;
        display: flex;
        justify-content: center;
    }

    .btn {
        padding: 10px;
        border: none;
        border-radius: 30px;
        background-color: #f2961b;
        color:black;
        font-size: 16px;
        cursor: pointer;
        width: 150px;
    }

    .btn:hover {
        background-color: transparent;
        border:2px solid #f2961b;
    }
</style>
</head>
<body>
<form name="signup" method="post" onsubmit="return validateForm()">
    <h2>Sign Up</h2>

    <div class="form-group">
        <label for="name">Name:</label>
        <span id="nameError" class="error"></span>
        <input type="text" id="name" name="name">
        <br>
     <div class="form-group">
     <label for="dob">DOB (YYYY-MM-DD):</label><span id="dobError" class="error"></span><br>
    <input type="text" id="dob" name="dob">
    
    </div>
   
    <div class="form-group">
        <label for="email">Email:</label><span id="emailError" class="error"></span><br>
        <input type="email" id="email" name="email">
        
    </div><br>

    <div class="form-group">
        <label for="password">Password:</label><span id="passwordError" class="error"></span><br>
        <input type="password" id="password" name="password">
        
    </div><br>
    <div class="form-group">
        <label for="repassword">Confirm Password:</label> <span id="repasswordError" class="error"></span><br>
        <input type="password" id="repassword" name="repassword">
       
    </div> <br>
   
    <div class="form-group">
        <input type="checkbox" id="terms" name="terms">
        <label for="terms">I agree to the terms and conditions</label>
        <span id="termsError" class="error"></span><br>
    </div><br>
    <div class="btn-container">
        <button type="submit" name ="submit" class="btn">Sign Up</button>
    </div><span id="nameError" class="error"></span><br>
</form>
<script>
    function validateForm() {
        var name = document.getElementById("name").value;
        var dob = document.getElementById("dob").value;
        var email = document.getElementById("email").value;
        var password = document.getElementById("password").value;
        var repassword = document.getElementById("repassword").value;
        
        
       
        
    
        var isValid = true;
    
        // Validate Name
        if (name.trim() == '') {
            document.getElementById("nameError").textContent = 'Please enter your name';
            isValid = false;
        } else if (name.length < 8) {
            document.getElementById("nameError").textContent = 'Name should be at least 8 characters long';
            isValid = false;
        } else {
            document.getElementById("nameError").textContent = '';
        }
    
        
    
       // Validate DOB
        var dobPattern = /^\d{4}-\d{2}-\d{2}$/;
        if (!dob.match(dobPattern)) {
            document.getElementById("dobError").textContent = 'Please enter your date of birth in the format YYYY-MM-DD';
            isValid = false;
        } else {
            document.getElementById("dobError").textContent = '';
        }
    
    
        // Validate Email
        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!email.match(emailPattern)) {
            document.getElementById("emailError").textContent = 'Please enter a valid email address';
            isValid = false;
        } else {
            document.getElementById("emailError").textContent = '';
        }
    
        // Validate Password
        if (password.trim() == '') {
            document.getElementById("passwordError").textContent = 'Please enter your password';
            isValid = false;
        } else {
            document.getElementById("passwordError").textContent = '';
        }
    
        if (repassword.trim() == '') {
            document.getElementById("repasswordError").textContent = 'Please confirm your password';
            isValid = false;
        } else if (password != repassword) {
            document.getElementById("repasswordError").textContent = 'Passwords do not match';
            isValid = false;
        } else {
            document.getElementById("repasswordError").textContent = '';
        }
        
        // Validate Terms Checkbox
        var termsCheckbox = document.getElementById("terms");
        if (!termsCheckbox.checked) {
            document.getElementById("termsError").textContent = 'Please accept the terms and conditions';
            isValid = false;
        } else {
            document.getElementById("termsError").textContent = '';
        }
    
        return isValid;
    }

    
    document.addEventListener('DOMContentLoaded', function() {
        const signupForm = document.getElementById('signupForm');

        // Add event listener to the form for form submission
        signupForm.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission behavior

            // Call the validateForm function to validate the form inputs
            if (validateForm()) {
                // If the form is valid, submit the form
                signupForm.submit();
            }
        });
    });
</script>

</body>
</html>
