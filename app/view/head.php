<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        
        <title><?php echo SITE_TITLE; ?></title>
    
        <!-- Fonts -->
        <link href='http://fonts.googleapis.com/css?family=Lato:300,700|Francois+One' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="/dist/css/main.css">
        
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>
    <body>
        
        <div class="container-fluid">
            <div class="row">
                
                <div class="col-md-6">
                    <?php
                    if(isset($inProcess) && $inProcess == true){
                    ?>
                     <div class="">
                        <?php if(!is_null($prevSlide) && !empty($prevSlide)) { ?>
                        <a href="/project/slide/<?php echo $prevSlide; ?>?p=<?php echo $projecthash; ?>&back" class="btn btn-default btn-sm pull-left"><i class="fa fa-chevron-left"></i> Back</a>
                        <?php } ?>
                        <h5 id="pos">Tool Selection Assistant / <small><?php echo $currentSlide; ?></small></h5>
                    </div>
                    
                    <?php    
                    }
                    else {
                    ?>
                    <a href="/home" class="brand">TSA</a>
                    <?php } ?>
                </div>
                <div class="col-md-6">
                <?php if(isset($_SESSION[APPNAME][SESSIONKEY]) && !empty($_SESSION[APPNAME][SESSIONKEY])) { ?>
                    <div class="pull-right">
                        Hello, <strong><?php echo $_SESSION[APPNAME]['USR']; ?></strong>!
                        <div class="btn-group" role="group" aria-label="User Options and Actions">
                            <a href="/" title="All your Projects" class="btn btn-primary btn-sm"><i class="fa fa-home"></i><span class="sr-only">Homepage</span></a>
                            <a href="/user/projects" title="All your Projects" class="btn btn-primary btn-sm"><i class="fa fa-user"></i><span class="sr-only">Your Profile</span></a>
                            <a href="/user/logout" title="Logout" class="btn btn-primary btn-sm"><i class="fa fa-sign-out"></i><span class="sr-only">Logout</span></a>
                        </div>
                    </div>
                
                <?php    
                }
                else {
                ?>
                <form class="form-inline pull-right" action="/user/login" method="post">
                    
                    <div class="form-group">
                        <label for="email" class="sr-only">Email</label>
                        <input type="email" class="form-control input-sm" name="email" id="email" placeholder="Your email is...">
                    </div>
                    
                    <div class="form-group">
                        <label for="password" class="sr-only">>Password</label>
                        <input type="password" class="form-control input-sm" name="password" id="password" placeholder="And your password is...">
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-sm" name="submit" id="submit"><i class="fa fa-sign-in"></i> Login</button>
                        or
                        <a href="/user/create" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Register</a>
                    </div>
                    
                </form>
                <?php
                }
                ?>
                </div>
            </div>
        </div>