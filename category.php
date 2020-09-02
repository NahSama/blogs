<?php
session_start();
require_once('connection.php');

//----Load Category----
$query_category = "SELECT * FROM categories";
$result_category = $conn->query($query_category);
$categories = array();
while($row = $result_category->fetch_assoc()){
	$categories[] = $row;
}
//End load category

//----Get id of chosen category----
$id = $_GET['id'];

//Query posts
//Query statement
$query_posts= "SELECT p.*, c.title cate FROM posts p LEFT JOIN categories c ON p.category_id = c.id WHERE p.status = 1 and p.category_id = ".$id." ORDER BY p.created_at DESC";

//Execute statement
$result_posts= $conn->query($query_posts);

//Create array to store data
$posts_3 = array();
$posts_other = array();

for($i = 0; $i<3; $i++){
	$row = $result_posts->fetch_assoc();
    $posts_3[] = $row;
}
//End taking 3 posts 

while($row = $result_posts->fetch_assoc()){
    $posts_other[] = $row;
}
//End taking others

//----Query Most Read----
$query_most_read = "SELECT * FROM posts ORDER BY visits DESC limit 3";
$result_most_read = $conn->query($query_most_read);
$most_read_posts = array();

while($row = $result_most_read ->fetch_assoc()){
    $most_read_posts[] = $row;
}

//----Query category posts----
//Query statement
$query_category_posts= "SELECT p.category_id as id, c.title as category, COUNT(p.id) as posts FROM posts p LEFT JOIN categories c ON p.category_id = c.id GROUP BY c.id;";

//Execute statement
$result_category_posts= $conn->query($query_category_posts);

//Create array to store data
$category_posts = array();

while($row = $result_category_posts->fetch_assoc()){
    $category_posts[] = $row;
}
//End taking categories

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title>Góc Manga</title>

		<link rel="icon" href="./img/favicon.png" type="image/gif" sizes="16x16">

		<!-- Google font -->
		<link href="https://fonts.googleapis.com/css?family=Nunito+Sans:700%7CNunito:300,600" rel="stylesheet"> 

		<!-- Bootstrap -->
		<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/>

		<!-- Font Awesome Icon -->
		<link rel="stylesheet" href="css/font-awesome.min.css">

		<!-- Custom stlylesheet -->
		<link type="text/css" rel="stylesheet" href="css/style.css"/>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

    </head>
	<body>
		<i class="fa fa-angle-up btn--to-top" aria-hidden="true" id="myBtn" title="Go to top"></i>
		<!-- Header -->
		<header id="header">
			<!-- Nav -->
			<div id="nav">
				<!-- Main Nav -->
				<div id="nav-fixed">
					<div class="container">
						<!-- logo -->
						<div class="nav-logo">
							<a href="category.php?id=<?= $id ?>" class="logo"><img style="width: 70px; height: 60px" src="./img/logo-<?= $id ?>.png" alt=""></a>
						</div>
						<!-- /logo -->

						<!-- nav -->
						<ul class="nav-menu nav navbar-nav">
							<li><a href="index.php">Trang chủ</a></li>
							<?php if(!isset($_SESSION['isLogin'])){?>
								<li><a href="./admin/login.php">Đăng nhập</a></li>
							<?php }else { ?>
								<li><a href="./admin/index.php"><?= $_SESSION['author']['name']?></a></li>
							<?php } ?>
							<?php 
								$index = 1;
								foreach($categories as $cate){
							?>
								<li class="cat-<?= $index?>"><a href="category.php?id=<?php echo $cate["id"]?>"><?php echo $cate["title"]?></a></li>
							<?php 
								$index++;
							} 
							?>
						</ul>
						<!-- /nav -->

						<!-- search & aside toggle -->
						<div class="nav-btns">
							<button disabled >
								<div id="clock"></div>
							</button>
							<button class="aside-btn"><i class="fa fa-bars"></i></button>
							<button class="search-btn"><i class="fa fa-search"></i></button>
							<div class="search-form">
								<input class="search-input" type="text" name="search" placeholder="Enter Your Search ...">
								<button class="search-close"><i class="fa fa-times"></i></button>
							</div>
						</div>
						<!-- /search & aside toggle -->
					</div>
				</div>
				<!-- /Main Nav -->

				<!-- Aside Nav -->
				<div id="nav-aside">
					<!-- nav -->
					<div class="section-row">
						<ul class="nav-aside-menu">
							<li><a href="index.php">Home</a></li>
							<li><a href="./admin/signup.php">Join Us</a></li>
						</ul>
					</div>
					<!-- /nav -->

					<!-- widget posts -->
					<!-- <div class="section-row">
						<h3>Recent Posts</h3>
						<div class="post post-widget">
							<a class="post-img" href="blog-post.html"><img src="./img/widget-2.jpg" alt=""></a>
							<div class="post-body">
								<h3 class="post-title"><a href="blog-post.html">Pagedraw UI Builder Turns Your Website Design Mockup Into Code Automatically</a></h3>
							</div>
						</div>

						<div class="post post-widget">
							<a class="post-img" href="blog-post.html"><img src="./img/widget-3.jpg" alt=""></a>
							<div class="post-body">
								<h3 class="post-title"><a href="blog-post.html">Why Node.js Is The Coolest Kid On The Backend Development Block!</a></h3>
							</div>
						</div>

						<div class="post post-widget">
							<a class="post-img" href="blog-post.html"><img src="./img/widget-4.jpg" alt=""></a>
							<div class="post-body">
								<h3 class="post-title"><a href="blog-post.html">Tell-A-Tool: Guide To Web Design And Development Tools</a></h3>
							</div>
						</div>
					</div> -->
					<!-- /widget posts -->

					<!-- social links -->
					<div class="section-row">
						<h3>Follow us</h3>
						<ul class="nav-aside-social">
							<li><a href="https://facebook.com"><i class="fa fa-facebook"></i></a></li>
							<li><a href="https://twitter.com"><i class="fa fa-twitter"></i></a></li>
							<li><a href="https://google.com"><i class="fa fa-google-plus"></i></a></li>
							<li><a href="https://pinterest.com"><i class="fa fa-pinterest"></i></a></li>
						</ul>
					</div>
					<!-- /social links -->

					<!-- aside nav close -->
					<button class="nav-aside-close"><i class="fa fa-times"></i></button>
					<!-- /aside nav close -->
				</div>
				<!-- Aside Nav -->
			</div>
			<!-- /Nav -->
			
			<!-- Page Header -->
			<div class="page-header" style="background: url('./img/cate-background-<?= $id?>.jpg') 0 -50px">
				<div class="container" >
					<div class="row">
						<div class="col-md-10">
							<ul class="page-header-breadcrumb">
								<li><a href="index.php">Home</a></li>
								<li></li>
							</ul>
							<h1 style="color: white"><?php echo $posts_3[0]["cate"] ?></h1>
						</div>
					</div>
				</div>
			</div>
			<!-- /Page Header -->
		</header>
		<!-- /Header -->
		
		<!-- section -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-8">
						<div class="row">
							<!-- post -->
							<?php
								foreach($posts_3 as $post){
							?>
							<div class="col-md-12">
								<div class="post post-thumb">
									<a class="post-img" href="blog-post.php?id=<?php echo $post["id"] ?>"><img src="./img/<?php echo $post["thumbnail"]?>" alt=""></a>
									<div class="post-body">
										<div class="post-meta">
											<a class="post-category cat-<?php echo $post["category_id"] ?>" href="category.php?id=<?php echo $post["category_id"]?>"><?php echo $post["cate"]?></a>
											<span class="post-date"><?php echo $post["created_at"]?></span>
										</div>
										<h3 class="post-title"><a href="blog-post.php?id=<?php echo $post["id"] ?>"><?php echo $post["title"]?></a></h3>
									</div>
								</div>
							</div>
							<?php }
							?>
							<!-- /post -->
							
							<div class="clearfix visible-md visible-lg"></div>
							
							<!-- ad -->
							<div class="col-md-12">
								<div class="section-row">
									<a href="#">
										<img class="img-responsive center-block" src="./img/ad.gif" alt="">
									</a>
								</div>
							</div>
							<!-- ad -->
							
							<!-- post -->
							<?php foreach($posts_other as $post){?>
							<div class="col-md-12">
								<div class="post post-row">
									<a class="post-img" href="blog-post.php?id=<?= $post['id']?>"><img src="./img/<?= $post['thumbnail']?>" alt=""></a>
									<div class="post-body">
										<div class="post-meta">
											<a class="post-category cat-<?= $post['category_id']?>" href="category.php?id=<?= $post['category_id']?>"><?= $post['cate']?></a>
											<span class="post-date"><?= $post['created_at']?></span>
										</div>
										<h3 class="post-title"><a href="blog-post.php?id=<?= $post['id']?>"><?= $post['title']?></a></h3>
										<p><?= $post['description']?></p>
									</div>
								</div>
							</div>
							<?php } ?>
							<!-- /post -->
							
							<!-- <div class="col-md-12">
								<div class="section-row">
									<button class="primary-button center-block">Load More</button>
								</div>
							</div> -->
						</div>
					</div>
					
					<div class="col-md-4">
						<!-- ad -->
						<div class="aside-widget text-center">
							<a href="#" style="display: inline-block;margin: auto;">
								<img class="img-responsive" src="./img/ad1.jpeg" alt="">
							</a>
						</div>
						<!-- /ad -->
						
						<!-- post widget -->
						<div class="aside-widget">
							<div class="section-title">
								<h2>Most Read</h2>
							</div>
							<?php foreach($most_read_posts as $most_read){?>
							<div class="post post-widget">
								<a class="post-img" href="blog-post.php?id=<?= $most_read['id']?>"><img src="./img/<?= $most_read['thumbnail']?>" alt=""></a>
								<div class="post-body">
									<h3 class="post-title"><a href="blog-post.php?id=<?= $most_read['id']?>"><?= $most_read['title']?></a></h3>
								</div>
							</div>
							<?php } ?>
						</div>
						<!-- /post widget -->
						
						<!-- catagories -->
						<div class="aside-widget">
							<div class="section-title">
							    <iframe width="100%" height="166" scrolling="no" frameborder="no" allow="autoplay" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/750169363&color=%23ff5500&auto_play=true&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true"></iframe><div style="font-size: 10px; color: #cccccc;line-break: anywhere;word-break: normal;overflow: hidden;white-space: nowrap;text-overflow: ellipsis; font-family: Interstate,Lucida Grande,Lucida Sans Unicode,Lucida Sans,Garuda,Verdana,Tahoma,sans-serif;font-weight: 100;"><a href="https://soundcloud.com/the-shaunz" title="Shaun" target="_blank" style="color: #cccccc; text-decoration: none;">Shaun</a> · <a href="https://soundcloud.com/the-shaunz/mascara-102" title="Mascara - Chillies." target="_blank" style="color: #cccccc; text-decoration: none;">Mascara - Chillies.</a></div>
								<h2>Categories</h2>
							</div>
							<div class="category-widget">
								<ul>
									<?php 
										foreach($category_posts as $cate){ 
									?>
									<li><a href="category.php?id=<?= $cate["id"]?>" class="cat-<?php echo $cate["id"] ?>"><?php echo $cate["category"] ?><span><?php echo $cate["posts"] ?></span></a></li>
									<?php } ?>
								</ul>
							</div>
						</div>
						<!-- /catagories -->
						
						<!-- tags -->
						<div class="aside-widget">
							<div class="tags-widget">
								<ul>
									<?php 
											foreach($category_posts as $cate){ 
									?>
										<li><a href="category.php?id=<?= $cate['id']?>" class="cat-<?php echo $cate["id"] ?>"><?php echo $cate["category"] ?></a></li>
									<?php } ?>
								</ul>
							</div>
						</div>
						<!-- /tags -->
						
						<!-- archive -->
						<!-- <div class="aside-widget">
							<div class="section-title">
								<h2>Archive</h2>
							</div>
							<div class="archive-widget">
								<ul>
									<li><a href="#">Jan 2018</a></li>
									<li><a href="#">Feb 2018</a></li>
									<li><a href="#">Mar 2018</a></li>
								</ul>
							</div>
						</div> -->
						<!-- /archive -->
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /section -->

		<!-- Footer -->
		<footer id="footer">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-5">
						<div class="footer-widget">
							<div class="footer-logo">
								<a href="index.php" class="logo"><img style="width: 200px; height: 100px" src="./img/logo2.png" alt=""></a>
							</div>
							<ul class="footer-nav">
								<li><a href="#">Privacy Policy</a></li>
								<li><a href="#">Advertisement</a></li>
							</ul>
							<div class="footer-copyright">
								<span>&copy; <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></span>
							</div>
						</div>
					</div>

					<div class="col-md-4">
						<div class="row">
							<div class="col-md-6">
								<div class="footer-widget">
									<h3 class="footer-title">About Us</h3>
									<ul class="footer-links">
										<li><a href="about.html">About Us</a></li>
										<li><a href="#">Join Us</a></li>
										<li><a href="contact.html">Contacts</a></li>
									</ul>
								</div>
							</div>
							<div class="col-md-6">
								<div class="footer-widget">
									<h3 class="footer-title">Categories</h3>
									<ul class="footer-links">
										<?php 
											foreach($category_posts as $cate){ 
										?>
										<li><a href="category.php?id=<?= $cate['id']?>" class="cat-<?php echo $cate["id"] ?>"><?php echo $cate["category"] ?></a></li>
										<?php } ?>
									</ul>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-3">
						<div class="footer-widget">
							<h3 class="footer-title">Join our Newsletter</h3>
							<div class="footer-newsletter">
								<form>
									<input class="input" type="email" name="newsletter" placeholder="Enter your email">
									<button class="newsletter-btn"><i class="fa fa-paper-plane"></i></button>
								</form>
							</div>
							<ul class="footer-social">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
								<li><a href="#"><i class="fa fa-pinterest"></i></a></li>
							</ul>
						</div>
					</div>

				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</footer>
		<!-- /Footer -->

		<!-- jQuery Plugins -->
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/main.js"></script>

	</body>
</html>
