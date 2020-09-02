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
$result_category= $conn->query($query_author);

//Create array to store data
$author = $result_category->fetch_assoc();
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
    <h3 align="center">Update Author Information</h3>
    <a href="./authors.php" type="button" class="btn btn-primary">Quay lại</a>
    <hr>
        <?php if(isset($_COOKIE['msg'])) { ?>
            <div class="alert alert-warning">
            <strong>Thất bại</strong> <?= $_COOKIE['msg']?> !!!
            </div>
        <?php } ?>
        <form action="author_edit_action.php" method="POST" role="form" enctype="multipart/form-data">
            <input type="hidden" name ="id" value="<?= $author['id'] ?>">
            <div class="form-group">
                <label for="">Name</label>
                <input type="text" class="form-control" id="" placeholder="" name="name" value="<?= $author['name'] ?>">
            </div>
            <div class="form-group">
                <label for="">Email</label>
                <input type="text" class="form-control" id="" placeholder="" name="email" value= "<?= $author['email'] ?>">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>
</html>