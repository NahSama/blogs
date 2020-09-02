<?php
session_start();
//Thong so ket noi CSDL

$servername = "localhost";

$username = "root";

$password = "";

$dbname = "blogs";

//----Connect to database----
$conn = new mysqli($servername, $username, $password, $dbname);

//----Query 6 recent posts----
//Query statement
$query_six_posts= "SELECT p.*, c.title cate FROM posts p LEFT JOIN categories c ON p.category_id = c.id WHERE p.status = 1  ORDER BY p.created_at DESC LIMIT 6";

//Execute statement
$result_six_posts= $conn->query($query_six_posts);

//Create array to store data
$six_posts = array();

while($row = $result_six_posts->fetch_assoc()){
    $six_posts[] = $row;
}
//End taking 6 recent posts 

//----Query 7 posts----
//Query statement
$query_seven_posts= "SELECT p.*, c.title cate FROM posts p LEFT JOIN categories c ON p.category_id = c.id WHERE p.status = 1 AND p.id > 2 ORDER BY p.id ASC LIMIT 7";

//Execute statement
$result_seven_posts= $conn->query($query_seven_posts);

//Create array to store data
$seven_posts = array();

while($row = $result_seven_posts->fetch_assoc()){
    $seven_posts[] = $row;
}
//End taking 7 posts 

//----Take 2 first posts of home----
//Query statement
$query_two_posts = "SELECT p.*, c.title cate FROM posts p LEFT JOIN categories c ON p.category_id = c.id WHERE p.status = 1 ORDER BY p.created_at ASC LIMIT 2";

//Execute statement
$result_two_posts = $conn->query($query_two_posts);

//Create array to store data
$two_posts = array();

while($row = $result_two_posts->fetch_assoc()){
    $two_posts[] = $row;
}
//End taking 2 first posts of home

//----Query categories----
//Query statement
$query_categories= "SELECT * FROM categories ORDER BY ID ASC LIMIT 4";

//Execute statement
$result_categories= $conn->query($query_categories);

//Create array to store data
$categories = array();

while($row = $result_categories->fetch_assoc()){
    $categories[] = $row;
}
//End taking categories

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

//----Query Most Read----
$query_most_read = "SELECT p.*, c.title as cate FROM posts p LEFT JOIN categories c ON p.category_id = c.id ORDER BY visits DESC limit 3";
$result_most_read = $conn->query($query_most_read);
$most_read_posts = array();

while($row = $result_most_read ->fetch_assoc()){
    $most_read_posts[] = $row;
}
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
		<link type="text/css" rel="stylesheet" href="./css/style.css"/>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

    </head>
	<body >
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
							<a href="index.php" class="logo"><img style="width: 70px; height: 60px" src="./img/logo2.png" alt=""></a>
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
		</header>
		<!-- /Header -->

		<!-- section -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<?php
						foreach($two_posts as $post){
					?>	
					<!-- post -->
					<div class="col-md-6">
						<div class="post post-thumb">
							<a class="post-img" href="blog-post.php?id=<?php echo $post['id']?>"><img src="./img/<?php echo $post['thumbnail'] ?>" alt=""></a>
							<div class="post-body">
								<div class="post-meta">
									<a class="post-category cat-<?php echo $post['category_id'] ?>" href="category.php?id=<?php echo $post['category_id'] ?>"><?php echo $post['cate'] ?></a>
									<span class="post-date"><?php echo $post['created_at'] ?></span>
								</div>
								<h3 class="post-title"><a href="blog-post.php?id=<?php echo $post["id"] ?>"><?php echo $post['title'] ?></a></h3>
							</div>
						</div>
					</div>
					<?php 
						}
					?>
					<!-- /post -->
				</div>
				<!-- /row -->

				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="section-title">
							<h2>Recent Posts</h2>
						</div>
					</div>

					<?php
						$index = 0;
						foreach($six_posts as $post){
					?>
					<!-- post -->
					<div class="col-md-4">
						<div class="post">
							<a class="post-img" href="blog-post.php?id=<?php echo $post["id"] ?>"><img src="./img/<?php echo $post["thumbnail"] ?>" alt=""></a>
							<div class="post-body">
								<div class="post-meta">
									<a class="post-category cat-<?php echo $post["category_id"] ?>" href="category.php?id=<?php echo $post["category_id"] ?>"><?php echo $post["cate"] ?></a>
									<span class="post-date"><?php echo $post["created_at"] ?></span>
								</div>
								<h3 class="post-title"><a href="blog-post.php?id=<?php echo $post["id"] ?>"><?php echo $post["title"] ?></a></h3>
							</div>
						</div>
					</div>
					<!-- /post -->
						<?php if($index == 2){ ?>
						<div class="clearfix visible-md visible-lg"></div>
						<?php } ?>
					<?php
						$index++; } 
					?>
				</div>
				<!-- /row -->

				<!-- row -->
				<div class="row">
					<div class="col-md-8">
						<div class="row">
							<!-- post -->
							<div class="col-md-12">
								<div class="post post-thumb">
									<a class="post-img" href="blog-post.php?id=<?php echo $seven_posts[0]['id']?>"><img src="./img/<?php echo $seven_posts[0]["thumbnail"] ?>" alt=""></a>
									<div class="post-body">
										<div class="post-meta">
											<a class="post-category cat-<?php echo $seven_posts[0]["category_id"] ?>" href="category.php?id="<?= $seven_posts[0]["category_id"]?>><?php echo $seven_posts[0]["cate"] ?></a>
											<span class="post-date"><?php echo $seven_posts[0]["created_at"] ?></span>
										</div>
										<h3 class="post-title"><a href="blog-post.php?id=<?php echo $seven_posts[0]['id']?>"><?php echo $seven_posts[0]["title"]?></a></h3>
									</div>
								</div>
							</div>
							<!-- /post -->

							<!-- post -->
							<?php
								for($i=1; $i < count($seven_posts); $i++){
							?>
							<div class="col-md-6">
								<div class="post">
									<a class="post-img" href="blog-post.php?id=<?php echo $seven_posts[$i]["id"] ?>"><img src="./img/<?php echo $seven_posts[$i]["thumbnail"] ?>" alt=""></a>
									<div class="post-body">
										<div class="post-meta">
											<a class="post-category cat-<?php echo $seven_posts[$i]["category_id"] ?>" href="category.php?id=<?php echo $seven_posts[$i]["category_id"] ?>"><?php echo $seven_posts[$i]["cate"] ?></a>
											<span class="post-date"><?php echo $seven_posts[$i]["created_at"] ?></span>
										</div>
										<h3 class="post-title"><a href="blog-post.php?id=<?php echo $seven_posts[$i]["id"] ?>"><?php echo $seven_posts[$i]["title"] ?></a></h3>
									</div>
								</div>
							</div>
							<?php if($i%2 == 0) {?>
								 <div class="clearfix visible-md visible-lg"></div> 
							<?php } ?>
							<?php } ?>
							<!-- /post -->							
						</div>
					</div>

					<div class="col-md-4">
						<!-- post widget -->
						<!-- <div class="aside-widget">
							<div class="section-title">
								<h2>Most Read</h2>
							</div>

							<div class="post post-widget">
								<a class="post-img" href="blog-post.html"><img src="./img/widget-1.jpg" alt=""></a>
								<div class="post-body">
									<h3 class="post-title"><a href="blog-post.html">Tell-A-Tool: Guide To Web Design And Development Tools</a></h3>
								</div>
							</div>

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
							</div> -->
						<!-- </div> -->
						<!-- /post widget -->

						<!-- post widget -->
						<!-- <div class="aside-widget">
							<div class="section-title">
								<h2>Featured Posts</h2>
							</div>
							<div class="post post-thumb">
								<a class="post-img" href="blog-post.html"><img src="./img/post-2.jpg" alt=""></a>
								<div class="post-body">
									<div class="post-meta">
										<a class="post-category cat-3" href="category.html">Jquery</a>
										<span class="post-date">March 27, 2018</span>
									</div>
									<h3 class="post-title"><a href="blog-post.html">Ask HN: Does Anybody Still Use JQuery?</a></h3>
								</div>
							</div>

							<div class="post post-thumb">
								<a class="post-img" href="blog-post.html"><img src="./img/post-1.jpg" alt=""></a>
								<div class="post-body">
									<div class="post-meta">
										<a class="post-category cat-2" href="category.html">JavaScript</a>
										<span class="post-date">March 27, 2018</span>
									</div>
									<h3 class="post-title"><a href="blog-post.html">Chrome Extension Protects Against JavaScript-Based CPU Side-Channel Attacks</a></h3>
								</div>
							</div>
						</div> -->
						<!-- /post widget -->
					
						<!-- ad -->
						<div class="aside-widget text-center">
							<iframe width="100%" height="166" scrolling="no" frameborder="no" allow="autoplay" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/750169363&color=%23ff5500&auto_play=true&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true"></iframe><div style="font-size: 10px; color: #cccccc;line-break: anywhere;word-break: normal;overflow: hidden;white-space: nowrap;text-overflow: ellipsis; font-family: Interstate,Lucida Grande,Lucida Sans Unicode,Lucida Sans,Garuda,Verdana,Tahoma,sans-serif;font-weight: 100;"><a href="https://soundcloud.com/the-shaunz" title="Shaun" target="_blank" style="color: #cccccc; text-decoration: none;">Shaun</a> · <a href="https://soundcloud.com/the-shaunz/mascara-102" title="Mascara - Chillies." target="_blank" style="color: #cccccc; text-decoration: none;">Mascara - Chillies.</a></div>
							<a href="#" style="display: inline-block;margin: auto;">
								<img class="img-responsive" src="./img/ad1.jpeg" alt="">
							</a>
						</div>
						<!-- /ad -->
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /section -->
		
		<!-- section -->
		<!-- <div class="section section-grey"> -->
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="section-title text-center">
							<!-- <h2>Featured Posts</h2> -->
						</div>
					</div>

					<!-- post -->
					<!-- <div class="col-md-4">
						<div class="post">
							<a class="post-img" href="blog-post.html"><img src="./img/post-4.jpg" alt=""></a>
							<div class="post-body">
								<div class="post-meta">
									<a class="post-category cat-2" href="category.html">JavaScript</a>
									<span class="post-date">March 27, 2018</span>
								</div>
								<h3 class="post-title"><a href="blog-post.html">Chrome Extension Protects Against JavaScript-Based CPU Side-Channel Attacks</a></h3>
							</div>
						</div>
					</div> -->
					<!-- /post -->

					<!-- post -->
					<!-- <div class="col-md-4">
						<div class="post">
							<a class="post-img" href="blog-post.html"><img src="./img/post-5.jpg" alt=""></a>
							<div class="post-body">
								<div class="post-meta">
									<a class="post-category cat-3" href="category.html">Jquery</a>
									<span class="post-date">March 27, 2018</span>
								</div>
								<h3 class="post-title"><a href="blog-post.html">Ask HN: Does Anybody Still Use JQuery?</a></h3>
							</div>
						</div>
					</div> -->
					<!-- /post -->

					<!-- post -->
					<!-- <div class="col-md-4">
						<div class="post">
							<a class="post-img" href="blog-post.html"><img src="./img/post-3.jpg" alt=""></a>
							<div class="post-body">
								<div class="post-meta">
									<a class="post-category cat-1" href="category.html">Web Design</a>
									<span class="post-date">March 27, 2018</span>
								</div>
								<h3 class="post-title"><a href="blog-post.html">Pagedraw UI Builder Turns Your Website Design Mockup Into Code Automatically</a></h3>
							</div>
						</div>
					</div> -->
					<!-- /post -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /section -->

		<!-- section -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-8">
						<div class="row">
							<div class="col-md-12">

								<!-- ad -->
								<div class="section-row text-center">
									<a href="#" style="display: inline-block;margin: auto;">
										<img class="img-responsive" src="./img/ad.gif" alt="">
									</a>
								</div>
								<!-- ad -->

								<div class="section-title">
									<h2>Most Read</h2>
								</div>
							</div>
							<!-- post -->
							<?php foreach($most_read_posts as $most_read){?>
							<div class="col-md-12">
								<div class="post post-row">
									<a class="post-img" href="blog-post.php?id=<?= $most_read['id']?>"><img src="./img/<?= $most_read['thumbnail']?>" alt=""></a>
									<div class="post-body">
										<div class="post-meta">
											<a class="post-category cat-<?= $most_read['category_id']?>" href="category.php?id=<?= $most_read['category_id']?>"><?= $most_read['cate']?></a>
											<span class="post-date"><?= $most_read['created_at']?></span>
										</div>
										<h3 class="post-title"><a href="blog-post.php?id=<?= $most_read['id']?>"><?= $most_read['title']?></a></h3>
										<p><?= $most_read['description']?></p>
									</div>
								</div>
							</div>
							<?php }?>
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
						
						<!-- categories -->
						<div class="aside-widget">
							<div class="section-title">
								<h2>Categories</h2>
							</div>
							<div class="category-widget">
								<ul>
									<?php 
										foreach($category_posts as $cate){ 
									?>
									<li><a href="category.php?id=<?= $cate['id']?>" class="cat-<?php echo $cate["id"] ?>"><?php echo $cate["category"] ?><span><?php echo $cate["posts"] ?></span></a></li>
									<!-- <li><a href="#" class="cat-2">JavaScript<span>74</span></a></li>
									<li><a href="#" class="cat-4">JQuery<span>41</span></a></li>
									<li><a href="#" class="cat-3">CSS<span>35</span></a></li> -->
									<?php } ?>
								</ul>
							</div>
						</div>
						<!-- /categories -->
						
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
										<li><a href="#">Join Us</a></li>
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
								<li><a href="https://facebook.com"><i class="fa fa-facebook"></i></a></li>
								<li><a href="https://twitter.com"><i class="fa fa-twitter"></i></a></li>
								<li><a href="https://google.com"><i class="fa fa-google-plus"></i></a></li>
								<li><a href="https://pinterest.com"><i class="fa fa-pinterest"></i></a></li>
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
