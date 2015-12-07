
    
    <div class="jumbotron">
        <div class="container">
            <div class="row">
                <?php if( !isset($_SESSION[APPNAME][SESSIONKEY]) || empty($_SESSION[APPNAME][SESSIONKEY])) { ?>
                <div class="col-xs-12 col-sm-6 col-md-4" id="login-panel">
                    <h3>Login</h3>
                    <form action="/user/login" method="post">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email">
                        </div>
                        
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password">
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="form-control btn btn-alt" name="submit" id="submit"><i class="fa fa-sign-in"></i> Login</button>
                            <a href="/user/create" class="alt">or register here</a>
                        </div>
                        
                        
                    </form>
                    
                </div>
                <?php } ?>
                <div class="col-xs-12 col-sm-6 col-md-8">
                    <h1>The Tool Selection Assistant</h1>
                    <p>As more and more voice and accountability organisations rely on technology in their work, choosing the right technology tool has become critical. </p>
                </div>
                
            </div>
        </div>
    </div>
    <div class="container">
        <section class="row">
            <div class="col-md-12">            
                <?php echo $page; ?>
                <p class="text-center">
                <a class="btn btn-alt btn-lg" href="/project/start"><i class="fa fa-hand-o-right"></i> Start planning now!</a>
                <br /><br />
                If you don’t have time to go through the full framework, read <a href="/home/choosing_the_right_technology_tool">this</a> instead.
                </p>
            </div>
        </section>
    </div>
    