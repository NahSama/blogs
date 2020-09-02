<?php
    session_start();
    require_once("../connection.php");
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT id, name FROM authors WHERE email ='".$email."' AND password ='".md5($password)."' AND status = 1";
    $author = $conn->query($query)->fetch_assoc();
    
    if ($author !== NULL) {
        $_SESSION['isLogin'] = true;
        $_SESSION['author'] = $author;
        header("Location: index.php");
    }else{
        setcookie('msg', 'Đăng nhập thất bại', time() +3);
        header("Location: login.php");
    }