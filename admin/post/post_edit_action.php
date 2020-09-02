<?php
    session_start();
    if(!isset($_SESSION['isLogin']) && $_SESSION['isLogin'] == false){
        header('Location: ../login.php');
    }
    
    require_once('../../connection.php');
    date_default_timezone_set('Asia/Ho_Chi_Minh');

    //upload file
    $target_dir = "../../img/"; 
    $thumbnail="";

    $target_file = $target_dir . basename($_FILES["thumbnail"]["name"]); //upload file link

    if (move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $target_file )) {
        //if uploading file occurs no error
        $thumbnail = ",thumbnail = '".basename($_FILES["thumbnail"]["name"])."'";
    }
    else {

    }

    $id = $_POST['id'];
    
    $title = $_POST['title'];
    
    $description = $_POST['description'];
    
    $contents = $_POST['contents'];
    
    $category_id = $_POST['category_id'];
    
    $author_id = 1;
    
    $status = 0;
    if(isset($_POST['status'])) {
        $status = $_POST['status'];
    }

    $created_at = date("Y-m-d H:i:s");

    $query = "UPDATE posts SET title = '".$title."', description = '".$description."', contents = '".$contents."'".$thumbnail.", author_id = ".$author_id.", category_id = ".$category_id.", status = ".$status." WHERE id = ".$id;

    $status_query = $conn->query($query);
    if($status_query == true){
        setcookie('msg', 'Cập nhật thành công', time() + 3);
        header('Location: posts.php');
    }
    else {
        setcookie('msg', 'Cập nhật không thành công', time() + 3);
        header('Location: posts.php');
    }
?>