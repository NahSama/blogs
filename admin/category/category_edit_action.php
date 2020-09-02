<?php
    session_start();
    if(!isset($_SESSION['isLogin']) && $_SESSION['isLogin'] == false){
        header('Location: ../login.php');
    }
    require_once('../../connection.php');
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $query = "UPDATE categories SET title ='".$title."', description='".$description."' WHERE id=".$id;
    $status = $conn->query($query);
    if($status == true){
        setcookie('msg', 'Cập nhật thành công', time() + 3);
        header('Location: categories.php');
    }
    else {
        setcookie('msg', 'Cập nhật không thành công', time() + 3);
        header('Location: category_edit.php?id='.$id);
    }
?>