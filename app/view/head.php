<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        
        <title><?php echo SITE_TITLE; ?></title>
    
        <!-- Fonts -->
        <link href='http://fonts.googleapis.com/css?family=Lato:300,700|Roboto+Slab:300' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <!-- Local Styles, if Any -->
        <?php if(isset($css) && !empty($css)){ print_styles($css); } ?>
        
        <link rel="stylesheet" href="/dist/css/main.css">
        
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>
    <body>
        <div class="wrap">
            
            <div class="container-fluid" id="top">
                <div class="row">
                    <div class="steps">
                        <div class="step step-1"></div>
                        <div class="step step-2"></div>
                        <div class="step step-3"></div>
                        <div class="step step-4"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="logo pull-left">TSA</div>
                    <?php if(isset($_SESSION[APPNAME][SESSIONKEY]) && !empty($_SESSION[APPNAME][SESSIONKEY])) { ?>
                        <div class="pull-right user-panel">
                            <span class="user-name">Hello, <strong><?php echo $_SESSION[APPNAME]['USR']; ?></strong>.</span>
                            <ul class="user-actions">
                                <li><a href="/" title="Homepage" class="mininav"><i class="fa fa-home fa-fw"></i><span class="sr-only">Homepage</span></a></li><!--
                                <?php if(isset($userRole) && $userRole == 'root') { ?>
                                --><li><a href="/manage/index" title="Manage Contents" class="mininav"><i class="fa fa-wrench fa-fw"></i><span class="hidden-xs">Manage</span></a></li><!--
                                <?php } ?>
                                --><li><a href="/user/projects" title="All your Projects" class="mininav"><i class="fa fa-tasks fa-fw"></i><span class="hidden-xs">My Projects</span></a></li><!--
                                --><li><a href="/user/logout" title="Logout" class="mininav"><i class="fa fa-sign-out fa-fw"></i><span class="sr-only">Logout</span></a></li><!-- --> 
                            </ul>
                        </div>
                    
                    <?php    
                    }
                    ?>
                </div>
            </div>