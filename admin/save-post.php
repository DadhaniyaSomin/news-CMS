<?php
 
 include 'config.php';

if(isset($_FILES['fileToUpload'])){
    $error = array();
    $file_name = $_FILES['fileToUpload']['name'];
    $file_size = $_FILES['fileToUpload']['size'];
    $file_tmp = $_FILES['fileToUpload']['tmp_name'];
    $file_type = $_FILES['fileToUpload']['type'];
    $file_ext = end(explode('.',$file_name));
    $extension = array('jpeg','jpg','png');
    
    if(in_array($file_ext,$extension )=== false)
    {
        $error[] ="this is not ana valid extension , plese use PNG or jpeg";
    }

    if($file_size > 20911502)
    {
        $error[] ="file size is more then 2 MB ,file size shold be less than or equal to 2 MB";
    }
        

    if(empty($error)==true)
    {
        move_uploaded_file($file_tmp,"upload/".$file_name);
    }else
    {
        print_r($error);
        die();
    }
 session_start();
 $title= mysqli_real_escape_string($conn, $_POST['post_title']);
 $description= mysqli_real_escape_string($conn, $_POST['postdesc']);
 $category = mysqli_real_escape_string($conn, $_POST['category']);
 $date =date('d M Y');
 $author = $_SESSION['user_id'];


 $sql = "INSERT INTO post(title,description,category,post_date,author,post_img) VALUES ('{$title}','{$description}','{$category}','{$date}','{$author}','{$file_name}');";
 $sql .="UPDATE category SET post = post +1 WHERE category_id= '{$category}'" or die("quary failed") or die("QUARY2 FAILED");
 
 if(mysqli_multi_query($conn ,$sql))
 {
    header("Location:http://localhost/news-template/admin/post.php");
 }
 else
 {
    echo "<div class='alert alert-danger'></div>";
 }
}

?> 