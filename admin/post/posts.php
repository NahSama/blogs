<?php
require_once('../../connection.php');
session_start();
if(!isset($_SESSION['isLogin']) && $_SESSION['isLogin'] == false){
  header('Location: ../login.php');
}

//Query category 
//Query statement
$query_posts = "SELECT p.*, c.title cate, a.name, a.email FROM posts p LEFT JOIN categories c ON p.category_id = c.id LEFT JOIN authors a on p.author_id = a.id;";

//Execute statement
$result_posts= $conn->query($query_posts);

//Create array to store data
$posts = array();

while($row = $result_posts->fetch_assoc()){
    $posts[] = $row;
}
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

    <!-- Data table script -->
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    
</head>
<body>
    <div class="container">
    <h3 align="center">Góc Manga</h3>
    <h3 align="center">Post List</h3>
    <a href="post_add.php" type="button" class="btn btn-primary">Thêm mới</a>
    <a href="../index.php" type="button" class="btn btn-primary">Quay lại</a>
    <?php if(isset($_COOKIE['msg'])) { ?>
        <div class="alert alert-success">
        <strong><?= $_COOKIE['msg']?>!!!</strong>  
        </div>
    <?php } ?>
    <hr>
    <table id="table" class="table">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Title</th>
          <th scope="col">Description</th>
          <th scope="col">Thumbnail</th>
          <th scope="col">Author</th>
          <th scope="col">Category</th>
          <th scope="col">Time created</th>
          <th scope="col">Status</th>
          <th scope="col">#</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          foreach($posts as $post){
        ?>
        <tr>
          <th scope="row"><?php echo $post["id"]?></th>
          <td><?php echo $post["title"]?></td>
          <td><?php echo $post["description"]?></td>
          <td><img src="../../img/<?php echo $post["thumbnail"]?>" style="height: 100px" alt=""></td>
          <td><?php echo $post["name"]?></td>
          <td><?php echo $post["cate"]?></td>
          <td><?php echo $post["created_at"]?></td>
          <td><?= ($post['status']==1)?'Display':'Non-Display'?></td>
          <td>
            <a href="../../blog-post.php?id=<?=$post['id']?>" type="button" class="btn btn-default">Xem</a>
            <a href="post_edit.php?id=<?=$post['id']?>" type="button" class="btn btn-success">Sửa</a>
            <a href="post_delete.php?id=<?=$post['id']?>" type="button" class="btn btn-warning">Xóa</a>
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
    </div>
    <script>
      $(document).ready(function() {
        $('#table').DataTable();
      } );
    </script>
</body>
</html>