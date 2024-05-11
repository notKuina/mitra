<?php
require 'connection.php';


if(isset($_POST['email']) && isset($_POST['message'])) {
    // Both 'email' and 'message' keys are set in the $_POST array
    $email = $_POST['email'];
    $message = $_POST['message'];
    $sql = "INSERT INTO feedback (email,message) VALUES ('$email','$message')";

    if ($con->query($sql) === TRUE)
    {
        echo "New feedback added successfully";
    }
    else
    {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
    mysqli_close($con);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>feedback</title>
    <link href="mitra.css" rel="stylesheet">
    <link rel="sttylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"  integrity="sha384-SI27wrMjH3ZZ89r4o+fGIJtnzkAnFs3E4qz9DIYioCQ5l9Rd/7UAa8DHcaL8jkWt" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<style>
    .feedback{
        background-color: white;
        height: 500px;
        width: 500px;
        position: absolute;
        margin-left: 350px;
        border-radius: 5px;
        margin-top: 30px;
    }


.upload button {
    width: 100px;
    height: 40px;
    border: none;
    border-radius: 30px;
    background-color: #f2961b;
    color:black;
    font-size: 16px;
    cursor: pointer;
  }
  

  
  .upload button:hover {
    background-color: transparent;
    border:1px solid orange;
  }
  

  form{
 
        height: 200px;
        width: 500px;
        position: absolute;
        margin-top: 100px; 
         margin-left: 100px;
  }
  button{
       
        position: absolute;
        margin-top: 30px;
         padding: auto;
         margin-left: 100px;
  }

input{
   
    height: 30px;
    width: 300px;
    background-color: white;
    border:  2px solid orange;
    border-radius: 5px;
    padding:5px;
    margin-bottom: 30px;
  }

  .input:active {
  box-shadow: 2px 2px 15px orange ;
}


</style>
</head>
<body>
    <div class="feedback">
    <div class="logo" style="padding:5px;">
           <a href="accountAfterLogin.php"> <img src="images/logo.png" ></a>
           <p style="color:orange; font-size:26px; font-family:tohoma; margin-left:150px;  ">Feedback for MITRA</p>
           <p style="color:black; font-size:14px; margin-left:130px;">Thank you for giving us feedback!</p>


                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
                    <input type="text" id="email" placeholder="Enter your email here..." style="color:black">
                   
                    <input id="message" placeholder="Give your feedback here..." style="color:black">
                 
                 

                    <div class="upload">
                <button type="submit" name="submit">
                        submit
                </button>
             </form>
                    </div>
</body>
</html>







