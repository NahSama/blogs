<?php
session_start();
if(!isset($_SESSION['isLogin']) && $_SESSION['isLogin'] == false){
    header('Location: ../login.php');
}

require_once('../../connection.php');
$id = $_GET['id'];

//----Query post---- 
//Query statement
$query_post= "SELECT * FROM posts WHERE ID =".$id;

//Execute statement
$result_post= $conn->query($query_post);

//Create array to store data
$post = $result_post->fetch_assoc();

//----Query category---- 
//Query statement
$query_categories= "SELECT * FROM categories WHERE ID > 0 ";

//Execute statement
$result_categories= $conn->query($query_categories);

//Create array to store data
$categories = array();

while($row = $result_categories->fetch_assoc()){
    $categories[] = $row;
}

//----Query author----
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
    <title>Zent - Education And Technology Group</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <!-- include libraries(jQuery, bootstrap) -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>
</head>
<body>
    <div class="container">
    <h3 align="center">Góc Manga</h3>
    <h3 align="center">Update Post Information</h3>
    <a href="./posts.php" type="button" class="btn btn-primary">Quay lại</a>
    <hr>
        <?php if(isset($_COOKIE['msg'])) { ?>
            <div class="alert alert-warning">
            <strong></strong> <?= $_COOKIE['msg']?> !!!
            </div>
        <?php } ?>
        <form action="post_edit_action.php" method="POST" role="form" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $post['id']?>">
            <div class="form-group">
                <label for="">Title</label>
                <input type="text" class="form-control" id="" placeholder="" name="title" value="<?= $post['title'] ?>">
            </div>
            <div class="form-group">
                <label for="">Description</label>
                <input type="text" class="form-control" id="" placeholder="" name="description" value="<?= $post['description'] ?>">
            </div>
            <div class="form-group">
                <label for="">Contents</label>
                <textarea type="text" class="form-control" id="summernote" placeholder="Nội dung bài viết" name="contents"><?= $post['contents']?>
                </textarea>
            </div>
            <div class="form-group">
                <label for="category">Choose a category:</label>
                <select name ="category_id" class="form-control" id="">
                <?php foreach($categories as $cate) {
                ?>
                    <option <?= ($post['category_id'] == $cate['id']?'selected':'')?> value="<?= $cate['id']?>"><?= $cate['title']?></option>
                <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="">Thumbnail</label>
                <img src="../../img/<?= $post['thumbnail'] ?>" alt="">
                <input type="file" class="form-control" id="" placeholder="" name="thumbnail" >
            </div>
            <div class="form-group">
                <label for="">Hiển thị bài viết</label>
                <input <?= ($post['status'] == 1?'checked':'')?> type="checkbox" id="" placeholder="" value="1" name="status"> <em>(Check để hiện thị bài viết)</em>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
    <script>
      $('#summernote').summernote({
        tabsize: 2,
        height: 100
      });
    </script>
</body>
</html>