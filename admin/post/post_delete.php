<?php
    session_start();
    if(!isset($_SESSION['isLogin']) && $_SESSION['isLogin'] == false){
        header('Location: ../login.php');
    }
    
    require_once('../../connection.php');
    $id = $_GET['id'];
    $query = "DELETE FROM posts WHERE id=".$id;
    $status = $conn->query($query);    
    if($status == true){
        setcookie('msg', 'Xóa thành công', time() + 3);
    }
    else {
        setcookie('msg', 'Xóa không thành công', time() + 3);
    }
    header('Location: posts.php');
?>