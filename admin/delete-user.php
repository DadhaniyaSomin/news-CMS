<?php


//cheak connection

   $conn = mysqli_connect('localhost', 'root', '' , 'news-site');
   
   //get user id from here
   $userid= $_GET['id'];

   //get input data which has enter by the user 
   $sql = "DELETE FROM user WHERE user_id='{$userid}'"  or die("quary failed");

   if(mysqli_query($conn,$sql))
         {
            header("Location:http://localhost/news-template/admin/users.php");
         }



?>
