<?php
session_start();
if(!isset($_SESSION['isLogin']) && $_SESSION['isLogin'] == false){
    header('Location: ../login.php');
}
require_once('../../connection.php');

//Query category 
//Query statement
$query_authors= "SELECT * FROM authors WHERE ID > 0 ";

//Execute statement
$result_authors= $conn->query($query_authors);

//Create array to store data
$authors = array();

while($row = $result_authors->fetch_assoc()){
    $authors[] = $row;
}
?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Author List</title>
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
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Status</th>
          <th scope="col">#</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          foreach($authors as $author){
        ?>
        <tr>
          <th scope="row"><?php echo $author["id"]?></th>
          <td><?php echo $author["name"]?></td>
          <td><?php echo $author["email"]?></td>
          <td><?= ($author['status']==1)?'Active':'Inactive'?></td>
          <td>
            <a href="author_detail.php?id=<?=$author['id']?>" type="button" class="btn btn-default">Xem</a>
            <a href="author_edit.php?id=<?=$author['id']?>" type="button" class="btn btn-success" <?= ($_SESSION['author']['id'] == $author['id'])?'':'disabled'?> >Sửa</a>
            <!-- <a href="author_delete.php?id=" type="button" class="btn btn-warning">Xóa</a> -->
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
    </div>
</body>
</html>