
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profile1 page</title>
    <link href="mitra.css" rel="stylesheet">
 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


       <style media="screen">
           body{
            margin-left: 200px;
            margin-right: 200px;

           }
           .upload{
                width: 40px;
                position:relative;
                margin:auto;
                text-align: center;
                margin-left: 500px;
                
            }

            .upload img{
                border-radius:50%;
                border:3px solid #DCDCDC;
                width:125px;
                height: 125px;

            }
            .upload .rightRound{
                position: absolute;
                bottom: o;
                right: 0;
                background: #00B4FF;
                width: 32px;
                height: 32px;
                line-height: 33px;
                text-align: center;
                border-radius: 50%;
                overflow:hidden;
                cursor: pointer;
            }
            .upload .fa{
                color:white;
            }

            .upload input{
                position: absolute;
                transform: scale(2);
                opacity: 0;
            }
            .upload input::-webkit-file-upload-button,.upload input[type=submit]{
                cursor:pointer;
            }
                            #search_box{
                height: 20px;
                width: 400px;
                background-color: gainsboro;
                padding: 4px;
                font-size: 14px;
                border-radius: 5px;
                border: none;
                margin-left: 50px;
                margin-bottom: 50px;
                }
                            .posts{
                display: -webkit-box;
                display: -webkit-flex;
                display: -ms-flexbox;
                display: flex;
                flex-wrap: wrap;
            }

            .like-comment{
                font-size: 10px;
                color:#333;
                padding-bottom: 40px;
                font-weight: bold;
            }
        </style>
</head>
<body>

<nav>
        <div class="logo">
           <a href="accountAfterLogin.php"> <img src="images/logo.png" style="margin-left: 180px;"></a>
           <div class="search" style="width50%; margin:auto;  placeholder::color:black; font-size:30px;">
           <input type="text" id="search_box" placeholder="Search for people">

           
        </div>
        </div>
    

 
        


</nav>
      
     <form  action="" enctype="multipart/form-data" method="post">
        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
        <div class="upload">
            <img src="img/<?php echo $user['image']; ?>" id="image">

        <div class="rightRound" id="upload">
            <input type="file" name="fileImg" id="fileImg" accept=".jpg, .jpeg, .png" >
            <i class="fa fa-camera"></i>
        </div>
        <div class="leftRound" id="cancel"  style="display:none">
            <i class="fa fa-times"></i>
        </div>
        <div class="rightRound" id="confirm"  style="display:none">
            <input type="submit" name="" value="">
            <i class="fa fa-check"></i>
        </div>
        </div>

     </form>
   <script type="text/javascript">
document.getElementById("fileImg").onchange = function(){
    document.getElementById("image").src =URL.createObjectURL(fileImg.files[0]);
    document.getElementById("cancel").style.display= "block";
    document.getElementById("confirm").style.display="block";
    document.getElementById("upload").style.display="none";
    
}
var Image=document.getElementById('image').src;
document.getElementById("cancel").onclick=function(){
    document.getElementById("image").src =userImage;
    document.getElementById("cancel").style.display= "none";
    document.getElementById("confirm").style.display="none";
    document.getElementById("upload").style.display="block";
    
}
   </script>

<?php
if(isset($_FILES["fileImg"]["name"])){
    $id= $_POST["id"];
    $src= $_FILES["fileImg"]["fileImg"]["name"];
    $target= "img/" .$imageName;
    move_uploaded_file($src, $target);
    $query= "UPDATE userinfo SET image= '$imageName' WHERE id=$id";
    mysqli_query($conn, $query);
    header("location:accountAfterLogin.php");
}
?>







<div class="container" style="margin-top:20px;margin-bottom:20px;padding:50px;background-color:#ddd;">
  <div class="row">
    <div class="col-md-3">
      <img src="" class="profile-pic" style="border-radius:50%;">
    </div>
    <div class="col-md-9">
      <h2 class="username"></h2>
      <div class="row">
        <div class="col-md-4">
          <span class="number-of-posts"></span> posts
        </div>
        <div class="col-md-4">
          <span class="followers"></span> followers
        </div>
        <div class="col-md-4">
          <span class="following"></span> following
        </div>
      </div>
      <div class="row" style="margin-top:60px;">
        <h4 class="name"></h4>
      </div>
      <div class="row">
        <h4 class="biography"></h4>
      </div>
      <br><hr><br>
      <div class="row">
        <p>POSTS</p>
      </div>
      <div class="row posts"></div>
    </div>
  </div>
</div>

<script>
  function nFormatter(num){
    if(num >= 1000000000){
      return (num/1000000000).toFixed(1).replace(/\.0$/,'') + 'G';
    }
    if(num >= 1000000){
      return (num/1000000).toFixed(1).replace(/\.0$/,'') + 'M';
    }
    if(num >= 1000){
      return (num/1000).toFixed(1).replace(/\.0$/,'') + 'K';
    }
    return num;
  }


  $.ajax({
    url:"https://www.mitra.com/<?php echo $_GET['user'];?>?__a=1",
    type:'get',
    success:function(response){
      $(".profile-pic").attr('src',response.graphql.user.profile_pic_url);
      $(".name").html(response.graphql.user.full_name);
      $(".biography").html(response.graphql.user.biography);
      $(".username").html(response.graphql.user.username);
      $(".number-of-posts").html(response.graphql.user.edge_owner_to_timeline_media.count);
      $(".followers").html(nFormatter(response.graphql.user.edge_followed_by.count));
      $(".following").html(nFormatter(response.graphql.user.edge_follow.count));
      posts = response.graphql.user.edge_owner_to_timeline_media.edges;
      posts_html = '';
      for(var i=0;i<posts.length;i++){
        url = posts[i].node.display_url;
        likes = posts[i].node.edge_liked_by.count;
        comments = posts[i].node.edge_media_to_comment.count;
        posts_html += '<div class="col-md-4 equal-height"><img style="min-height:50px;background-color:#fff;width:100%" src="'+url+'"><div class="row like-comment"><div class="col-md-6">'+nFormatter(likes)+' LIKES</div><div class="col-md-6">'+nFormatter(comments)+' COMMENTS</div></div></div>';
      }
      $(".posts").html(posts_html);
    }
  });
</script>

</body>
</html>