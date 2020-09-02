<?php
session_start();
if(!isset($_SESSION['isLogin']) && $_SESSION['isLogin'] == false){
    header('Location: ../login.php');
}
require_once('../../connection.php');
$id = $_GET['id'];

//Query category 
//Query statement
$query_posts= "SELECT * FROM posts WHERE ID =".$id;

//Execute statement
$result_posts= $conn->query($query_posts);

//Create array to store data
$post= $result_posts->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Góc Manga</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <h3 align="center">Góc Manga</h3>
        <h3 align="center">Category Detail</h3>
        <a href="./posts.php" type="button" class="btn btn-primary">Quay lại</a>
        <hr>
        <h2>Title: <?= $post['title'] ?></h2>
        <h3>Description: <?= $post['description'] ?></h3>
        <h4>Thumbnail: <img src="../../img/<?= $post['thumbnail'] ?>" alt=""> </h4>
        <h5>Time created: <?= $post['created_at'] ?></h5>
        <p>Contents: <?= $post['contents'] ?></p>
    </div>
</body>