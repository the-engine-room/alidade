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
                            <a href="/user/create" class="alt">or register here</a> | <a class="alt" href="/user/recover">lost your password?</a>
                        </div>
                    </form>
                </div>
                <?php } ?>
                <div class="col-xs-12 col-sm-6 col-md-8">
                    <h1>The Tool Selection Assistant</h1>
                    <p>A guide to help you choose the right technology tool for your project.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container" id="text-snaps">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-3 text-snap-title"><h3>What is it</h3></div>
            <div class="col-xs-12 col-sm-6 col-md-3"><p><strong>A 4-step guided process</strong> that will help you choose your best option.</p></div>
            <div class="col-xs-12 col-sm-6 col-md-3 text-snap-title"><h3>What I'll get</h3></div>
            <div class="col-xs-12 col-sm-6 col-md-3">
                <ul>
                    <li>Real life <strong>examples</strong></li>
                    <li>Tips</li>
                    <li>Links to <strong>external resources</strong> for help</li>
                    <li>A <strong>structured report</strong> of all your decisions.</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container-fluid" id="walkthrough">
        <div class="row">
            <div class="col-xs-12 col-sm-3 col-md-3 step step-1">
                <div class="step-inner-wrap">
                    <span class="step-indicator"></span>
                    <span class="step-description">Understand your needs</span>
                </div>
            </div>
            <div class="col-xs-12 col-sm-3 col-md-3 step step-2">
                <div class="step-inner-wrap">
                    <span class="step-indicator"></span><span class="step-indicator"></span>
                    <span class="step-description">Understand the tech</span>
                </div>
            </div>
            <div class="col-xs-12 col-sm-3 col-md-3 step step-3">
                <div class="step-inner-wrap">
                    <span class="step-indicator"></span><span class="step-indicator"></span><span class="step-indicator"></span>
                    <span class="step-description">Try it out!</span>
                </div>
            </div>
            <div class="col-xs-12 col-sm-3 col-md-3 step step-4">
                <div class="step-inner-wrap">
                    <span class="step-indicator"></span><span class="step-indicator"></span><span class="step-indicator"></span><span class="step-indicator"></span>
                    <span class="step-description">Find help or learn</span>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid text-center" id="quick-tips">
        <p>Don’t have time to read the guide? Try our <a href="/page/quick-tips">quick tips</a> first.</p>
    </div>
    
    <?php if (!empty($page)) { ?> 
    <div class="container">
        <section class="row">
            <div class="col-md-12">            
                <?php echo $page; ?>
            </div>
        </section>
    </div>
    <?php } ?>