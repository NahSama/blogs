<?php
    require_once('../connection.php');
    // date_default_timezone_set('Asia/Ho_Chi_Minh');

    //upload file
    // $target_dir = "../../img/"; 
    // $thumbnail="";

    // $target_file = $target_dir . basename($_FILES["thumbnail"]["name"]); //upload file link

    // if (move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $target_file )) {
    //     //if uploading file occurs no error
    //     $thumbnail = basename($_FILES["thumbnail"]["name"]);
    // }

    $name = $_POST['name'];
    
    $email = $_POST['email'];
    
    $password = $_POST['password'];
    
    //Check email existance
    $check = "SELECT COUNT(ID) as count FROM authors WHERE email = '".$email."';";
    $status_check = $conn->query($check);
    $result_check = $status_check->fetch_assoc();
    if ($result_check['count'] > 0) {
        setcookie('msg', 'Email đã tồn tại', time() + 3);
        header('Location: signup.php');
    }
    else{
        //Add email to database
        $query = "INSERT INTO authors(name, email, password, status)
        VALUES ('".$name."', '".$email."','".md5($password)."', 1);";
        $status_query = $conn->query($query);
        if($status_query == true){
            setcookie('msg', 'Đăng kí thành công', time() + 3);
            header('Location: login.php');
        }
        else {
            setcookie('msg', 'Đăng kí không thành công', time() + 3);
            header('Location: signup.php');
        }
    }
?>