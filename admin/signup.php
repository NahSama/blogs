<!DOCTYPE html>
<html>
<head>
    <title>Góc Manga Sign Up</title>
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
                        <h4 class="card-title mb-4 mt-1">Sign up</h4>
                        <hr>
                        <?php if(isset($_COOKIE['msg'])) { ?>
                            <div class="alert alert-warning">
                            <strong><?= $_COOKIE['msg']?>!!!</strong>  
                            </div>
                        <?php } ?>
                        <form action="signup_action.php" method="POST" role="form" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="">Name</label>
                                <input name="name" class="form-control" placeholder="Name" type="name">
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input name="email" class="form-control" placeholder="Email" type="email">
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input name ="password" id="password" class="form-control" placeholder="****" type="password" onkeyup="check()">
                            </div>
                            <div class="form-group" >
                                <label for="">Confirm your password &emsp;</label><emsp><span id='message'></span>
                                <input name ="password2" id="password2" class="form-control" placeholder="****" type="password" onkeyup="check()">
                            </div>                                 
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block"> Sign Up </button>
                                    </div> 
                                </div>
                                <div class="col-md-6 text-right">
                                    <a href="login.php" class="small">Sign in</a>
                                </div>                                            
                            </div>
                        </form>
                    </article>
                </div>
            </aside>
        </div>
    </div> 
    <script>
        let btnShow = document.querySelector('button');
        function check() {
                if (document.getElementById('password').value ==
                    document.getElementById('password2').value) {
                    document.getElementById('message').style.color = 'green';
                    document.getElementById('message').innerHTML = 'matching';
                    btnShow.disabled = false;

                } else {
                    document.getElementById('message').style.color = 'red';
                    document.getElementById('message').innerHTML = 'not matching';
                    btnShow.disabled = true;
                }
        }
    </script>
</body>
</html>