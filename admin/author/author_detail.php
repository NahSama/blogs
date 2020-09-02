<?php
session_start();
if(!isset($_SESSION['isLogin']) && $_SESSION['isLogin'] == false){
    header('Location: ../login.php');
}
require_once('../../connection.php');
$id = $_GET['id'];

//Query category 
//Query statement
$query_author= "SELECT * FROM authors WHERE ID =".$id;

//Execute statement
$result_author= $conn->query($query_author);

//Create array to store data
$author = $result_author->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Góc Manga Tác giả</title>
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
        <h3 align="center">Author detail</h3>
        <a href="./authors.php" type="button" class="btn btn-primary">Quay lại</a>
        <hr>
        <h2>Name: <?= $author['name'] ?></h2>
        <h2>Email: <?= $author['email'] ?></h2>
        <h3>Status: <?= ($author['status']==1)?'Active':'Inactive'?></h3>
    </div>
</body>