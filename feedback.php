
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
    padding: 10px;
    border: none;
    border-radius: 30px;
    background-color: #f2961b;
    color:black;
    font-size: 16px;
    cursor: pointer;
  }
  
  .upload button:hover {
    background-color: transparent;
    border:2px solid #f2961b;
  }

  form{
 
        height: 200px;
        width: 500px;
        position: absolute;
        margin-top: 150px;
        
         margin-left: 100px;
  }
  button{
       
        position: absolute;
        margin-top: 80px;
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
  }

  .input:active {
  box-shadow: 2px 2px 15px orange inset;
}


</style>
</head>
<body>
    <div class="feedback">
    <div class="logo" style="padding:5px;">
           <a href="accountAfterLogin.php"> <img src="images/logo.png" ></a>
           <p style="color:orange; font-size:26px; font-family:tohoma; margin-left:150px;  ">Feedback for MITRA</p>
           <p style="color:black; font-size:14px; margin-left:130px;">Thank you for giving us feedback!</p>


                <form action="feedback.php" method="post" enctype="multipart/form-data">
                   
                    <input id="message" placeholder="Give your feedback here..." style="color:black"></input>
                 
                 

                    <div class="upload">
                <button type="submit"onclick="sendMessage()" name="uploadfile">
                        submit
                </button>
             </form>
                    </div>





<script>
    // JavaScript function to handle form submission
    function sendMessage() {
        var message = document.getElementById('message').value;
        // You can perform further actions with the message, like sending it to a server or displaying it
        console.log("Message:", message);
        // Optionally, clear the textarea after sending
        document.getElementById('message').value = '';
    }
</script>

</body>
</html>






<?php
require 'connection.php';
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
   
    $rating = $_POST["feedback"];

    $sql = "INSERT INTO feedback (email,rate) VALUES ('$email,$rating')";
    if (mysqli_query($conn, $sql))
    {
        echo "New feedback added successfully";
    }
    else
    {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>
