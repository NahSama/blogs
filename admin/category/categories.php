<?php
session_start();
if(!isset($_SESSION['isLogin']) && $_SESSION['isLogin'] == false){
    header('Location: ../login.php');
}
require_once('../../connection.php');

//Query category 
//Query statement
$query_categories= "SELECT * FROM categories WHERE ID > 0 ";

//Execute statement
$result_categories= $conn->query($query_categories);

//Create array to store data
$categories = array();

while($row = $result_categories->fetch_assoc()){
    $categories[] = $row;
}
?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Category List</title>
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
    <h3 align="center">Category List</h3>
    <a href="category_add.php" type="button" class="btn btn-primary">Thêm mới</a>
    <a href="../index.php" type="button" class="btn btn-primary">Quay lại</a>
    <?php if(isset($_COOKIE['msg'])) { ?>
        <div class="alert alert-success">
        <strong>Thành công</strong> <?= $_COOKIE['msg']?> !!!
        </div>
    <?php } ?>
    <hr>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Title</th>
          <th scope="col">Description</th>
          <th scope="col">#</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          foreach($categories as $cate){
        ?>
        <tr>
          <th scope="row"><?php echo $cate["id"]?></th>
          <td><?php echo $cate["title"]?></td>
          <td><?php echo $cate["description"]?></td>
          <td>
            <a href="category_detail.php?id=<?=$cate['id']?>" type="button" class="btn btn-default">Xem</a>
            <a href="category_edit.php?id=<?=$cate['id']?>" type="button" class="btn btn-success">Sửa</a>
            <a href="category_delete.php?id=<?=$cate['id']?>" type="button" class="btn btn-warning">Xóa</a>
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
    </div>
</body>
</html>