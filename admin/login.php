<!DOCTYPE html>
<html>
<head>
    <title>Góc Manga Login</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
</head>
<body>  
    <br><br>
    <div class="container">
        <div class="row">
            <aside class="col-sm-3"></aside>
            <aside class="col-sm-6">    
                <div class="card">
                    <article class="card-body">
                        <h4 class="card-title mb-4 mt-1">Sign in</h4>
                        <hr>
                        <?php if(isset($_COOKIE['msg'])) { ?>
                            <div class="alert alert-warning">
                            <strong><?= $_COOKIE['msg']?>!!!</strong>  
                            </div>
                        <?php } ?>
                        <form action="login_action.php" method="POST" role="form" enctype="multipart/form-data">
                            <div class="form-group">
                                <input name="email" class="form-control" placeholder="Email" type="email">
                            </div>
                            <div class="form-group">
                                <input name ="password"class="form-control" placeholder="****" type="password">
                            </div>                                     
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block"> Login  </button>
                                    </div> 
                                </div>
                                <div class="col-md-6 text-right">
                                    <a class="small" href="signup.php">Sign Up?</a>
                                    <br>
                                    <a class="small" href="../index.php">Về trang chủ</a>
                                </div>                                      
                            </div>
                        </form>
                    </article>
                </div>
            </aside>
        </div>
    </div> 
</body>
</html>