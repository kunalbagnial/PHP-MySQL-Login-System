 <?php
   session_start();
   $userProfileName = $_SESSION['username'];
   //check
   if(isset($userProfileName)){

   }else{
       //back to login page
       header("location:login.php");
   }
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" 
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style>
       .container{
           margin-top:8vh;
       }
    </style>
 </head>
 <body>
   <div class="container text-white text-center bg-dark py-5 ">
       <h2><?php echo "&#9786; Hello " .$userProfileName; ?></h2>
       <a class="btn btn-secondary mt-2" href="logout.php">logout</a> 
   </div>
 </body>
</html>   