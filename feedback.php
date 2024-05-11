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
    border:2px solid orange;
  }
  

  form{
 
        height: 200px;
        width: 500px;
        position: absolute;
        margin-top: 70px; 
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



.rating:not(:checked) > input {
  position: absolute;
  appearance: none;
  border:0;
}

.rating:not(:checked) > label {
float: right;
 position: relative;
 top: 25px;
 right:190px;
  cursor: pointer;
  font-size: 25px;
  color: #666;
}

.rating:not(:checked) > label:before {
  content: '★';
}

.rating > input:checked + label:hover,
.rating > input:checked + label:hover ~ label,
.rating > input:checked ~ label:hover,
.rating > input:checked ~ label:hover ~ label,
.rating > label:hover ~ input:checked ~ label {
  color: #e58e09;
}

.rating:not(:checked) > label:hover,
.rating:not(:checked) > label:hover ~ label {
  color: #ff9e0b;
}

.rating > input:checked ~ label {
  color: #ffa723;
}





</style>
</head>
<body>
    <div class="feedback">
    <div class="logo" style="padding:5px;">
           <a href="accountAfterLogin.php"> <img src="images/logo.png" ></a>
           <p style="color:orange; font-size:26px; font-family:tohoma; margin-left:150px;  ">Feedback for MITRA</p>
           <p style="color:black; font-size:14px; margin-left:130px;">Thank you for giving us feedback!</p><br>

                        <div class="rating">
                <input value="5" name="rate" id="star5" type="radio">
                <label title="text" for="star5"></label>
                <input value="4" name="rate" id="star4" type="radio">
                <label title="text" for="star4"></label>
                <input value="3" name="rate" id="star3" type="radio" checked="">
                <label title="text" for="star3"></label>
                <input value="2" name="rate" id="star2" type="radio">
                <label title="text" for="star2"></label>
                <input value="1" name="rate" id="star1" type="radio">
                <label title="text" for="star1"></label>
                </div>


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







