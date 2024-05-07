<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add post</title>
    <link href="mitra.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" >
    <style>
#wrapper{
width: 40%;
margin-left:350px;
border: 1px solid #dad7d7;
}

form{
 margin-top: 450px;
width: 40%;
margin: 10px auto;
}

form div{
margin-top: 100px;
}

img{
float: left;
margin: 5px;
width: 280px;
height: 120px;
}

#img_div{
width: 70%;
padding: 5px;
margin: 15px auto;
border: 1px solid #dad7d7;
}

#img_div:after{
content: "";
display: block;
clear: both;
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

</style>
</head>
<body>
<nav style="margin-left:150px;">
        <div class="logo">
            <img src="images/logo.png">
        </div>
     <ul >
        <li><a href="" ><i class="fa fa-fw fa-home"></i>&nbsp;&nbsp;Home</a></li>
    
        <li><a href="addPost.php"><i class="fa fa-fw fa-plus"></i>&nbsp;&nbsp;Add post<br></a></li>
      
        <li><a href="profile1.php"><i class="fa fa-fw fa-user"></i>&nbsp;&nbsp;Profile </a></li>
           <li> <a href=""><i class="fa fa-fw fa-info"></i>&nbsp;&nbsp;About Us<br></a></li>
            <li><a href=""><i class="fa fa-fw fa-phone"></i>&nbsp;&nbsp;Contact Us<br></a></li>
            <li><a href=""><i class="fa fa-fw fa-file-text"></i>&nbsp;&nbsp;Privacy Policy<br></a></li>
           <li><a href=""><i class="fa fa-fw fa-handshake"></i>&nbsp;&nbsp;Terms and Conditions</a></li>
    </nav>


    <div id="wrapper">
        <form method="POST" action="" enctype="multipart/form-data">        
            <input type="file" name="choosefile" value="" />
            <div class="upload">
                <button type="submit" name="uploadfile">
                upload
                </button>
            </div>
        </form>
    </div>
</body>
</html>


<?php
// Database connection settings
$servername = "localhost";
$name = "name";
$password = "password";
$database = "mitra";

// Create connection
$conn = new mysqli('localhost','root', '', 'mitra');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to sanitize input data
function sanitize_input($data) {
    global $conn;
    return mysqli_real_escape_string($conn, $data);
}

// Function to validate fields
function validate_fields($id, $name, $status) {
    return !empty($id) && !empty($name) && !empty($status);
}

// Function to add a record
function add_record( $image) {
    global $conn;

    $image = sanitize_input($image);
  
    $sql = "INSERT INTO your_table ( image) VALUES ( '$image')";
    if ($conn->query($sql) === TRUE) {
        echo "Record added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Function to list records
function list_records() {
    global $conn;
    $sql = "SELECT  id,  name, image FROM posts";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<table><tr><th>ID</th><th>Name</th><th>Image</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row["image"]."</td></tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }
}

// Function to update a record
function update_record( $image) {
    global $con;
   
    $image = sanitize_input($image);

    $sql = "UPDATE posts SET status='$image' WHERE id='id'";
    if ($con->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $con->error;
    }
}

// Function to delete a record
function delete_record($id) {
    global $con;
    $id = sanitize_input($id);
    $sql = "DELETE FROM your_table WHERE id='$id'";
    if ($con->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $con->error;
    }
}

// Example usage:
// Add a record
// add_record("John Doe", "Captain", "Active", "image.jpg", "admin");

// List records
// list_records();

// Update a record
// update_record(1, "Jane Doe", "Lieutenant", "Inactive", "admin");

// Delete a record
// delete_record(1);

// Close connection
$conn->close();
?>

