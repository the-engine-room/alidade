    <div class="jumbotron">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-7" id="login-panel">
                    <h1>Tool Selection Assistant</h1>
                    <h3>Help to choose the right technology for success in your project</h3>
                    
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            In 2015, we researched how 38 Kenyan and South African organisations choose digital technology tools to use in transparency and accountability initiatives.
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            Despite putting in significant effort, <strong>less than a quarter of initiatives were happy</strong> with the tools they chose. 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <h4>Use our guide to avoid common mistakes and borrow from what’s worked.</h4>
                            <span class="big-divider"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <button class="btn btn-alt btn-lg btn-block"><strong>LOGIN</strong> or <strong>REGISTER</strong></button>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <a class="btn btn-alt btn-lg btn-block">New user? <strong>TAKE A TOUR</strong></a>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <h4>The research behind the guide</h4>
                            <span class="big-divider"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <a class="btn btn-main btn-lg btn-block"><strong>Research Summary</strong></a>
                            <a class="btn btn-main btn-lg btn-block"><strong>Read the full report</strong></a>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <a class="btn btn-main btn-lg btn-block btn-left-text "><span class=""><strong>Six rules of thumb</strong><br /><span class="subtext">for choosing the right tool <br />based on our report</span></span></a>
                        </div>
                    </div>
                    <?php
                    /*
                    if( !isset($_SESSION[APPNAME][SESSIONKEY]) || empty($_SESSION[APPNAME][SESSIONKEY])) { ?>
                    
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
                    <?php
                    } */
                    ?>
                </div>
                
                <div class="col-xs-12 col-sm-6 col-md-5">
                    
                </div>
            </div>
        </div>
    </div>
    <div class="container" id="text-snaps">
        <div class="row">
            
            
            
            <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="text-snap">
                    <div class="text-snap-title"><h3>What it is</h3></div>
                    <div class="text-snap-text"><p><strong>A 4-step guided process</strong> that will help you choose your best option.</p></div>
                </div>
            
                <div class="text-snap">
                    <div class="text-snap-title"><h3>Why</h3></div>
                    <div class="text-snap-text"><p>Our research suggests that <strong>choosing the right tool is key</strong> in making your project successful. <a href="/page/research-report">Read More <i class="fa fa-angle-double-right"></i></a></p></div>
                </div>
            </div>
            
            <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="text-snap">
                    <div class="text-snap-title"><h3>What I'll get</h3></div>
                    <div class="text-snap-text">
                        <ul>
                            <li>Real life <strong>examples</strong></li>
                            <li>Tips</li>
                            <li>Links to <strong>external resources</strong> for help</li>
                            <li>A <strong>structured report</strong> of all your decisions.</li>
                        </ul>
                    </div>
                </div>
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
                    <span class="step-description">Get help, if you need it</span>
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