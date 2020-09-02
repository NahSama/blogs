<?php
    session_start();
    if(!isset($_SESSION['isLogin']) && $_SESSION['isLogin'] == false){
        header('Location: ../login.php');
    }
    require_once('../../connection.php');
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $query = "UPDATE authors SET name ='".$name."', email='".$email."' WHERE id=".$id;
    $query_author= "SELECT * FROM authors WHERE ID =".$id;

    $status = $conn->query($query);
    if($status == true){
        setcookie('msg', 'Cập nhật thành công', time() + 3);
        $_SESSION['author'] = $conn->query($query_author)->fetch_assoc();
        header('Location: authors.php');
    }
    else {
        setcookie('msg', 'Cập nhật không thành công', time() + 3);
        header('Location: author_edit.php?id='.$id);
    }
?>