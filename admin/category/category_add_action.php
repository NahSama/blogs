<?php
    session_start();
    if(!isset($_SESSION['isLogin']) && $_SESSION['isLogin'] == false){
        header('Location: ../login.php');
    }
    require_once('../../connection.php');
    $title = $_POST['title'];
    $description = $_POST['description'];
    $query = "INSERT INTO categories(title,description) VALUES ('".$title."', '".$description."');";
    $status = $conn->query($query);
    var_dump($status);
    if($status == true){
        setcookie('msg', 'Thêm mới thành công', time() + 3);
        header('Location: categories.php');
    }
    else {
        setcookie('msg', 'Thêm mới không thành công', time() + 3);
        header('Location: category_add.php');
    }
?>