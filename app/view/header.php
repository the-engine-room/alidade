
<!-- Login -->
<div class="modal fade" id="user-forms" tabindex="-1" role="dialog" aria-labelledby="UserLoginAndRegistration">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times fa-times-2x"></i></span></button>
                <h2 class="modal-title" id="myModalLabel">To save your progress, please register or login:</h2>
                <p>You will be able to finish at your own pace.</p>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <?php if((!isset($_SESSION[APPNAME][SESSIONKEY]) || empty($_SESSION[APPNAME][SESSIONKEY])) || $_SESSION[APPNAME]['DISP']){ ?>
                        <h3>Login</h3>
                        <form action="/user/login" method="post" id="loginForm">

														<?php if($_SESSION[APPNAME]['DISP']){ ?>
														<input type="hidden" name="prj" value="<?php echo $_SESSION['project']; ?>">
														<?php } ?>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" id="password">
                            </div>
                            <div class="form-group">
                              <a href="/user/recover" title="start password recovery procedure">Password forgotten?</a>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-alidade btn-block" name="submit" id="login">Login</button>
                            </div>
                        </form>
                        <?php } ?>
                    </div>


                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <h3>Register</h3>
                        <?php if($_SESSION[APPNAME]['DISP']){ ?>
                        <form action="/user/edit" method="post" id="editProfileForm">
                          <input type="hidden" value="<?php echo $user->id; ?>" name="user">
                        <?php } else { ?>
                        <form action="/user/create" method="post">
                        <?php }?>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" id="password">
                            </div>
                            <div class="form-group">
                                <label for="c_password">Confirm Password:</label>
                                <input type="password" name="c_password" id="c_password" class="form-control">
                            </div>
                            <div class="form-group">
															<button type="submit"
																class="form-control btn btn-alidade btn-block"
																name="submit"
																<?php if($_SESSION[APPNAME]['DISP']){ ?>id="editProfile"<?php } ?>>
																Register
															</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <p><small>We will never share your email address with anyone, or for any reason. We will only contact you if we need to tell you something important about the status of Alidade.</small></p>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="container-fluid">
	<header class="row" id="app-header">
		<div class="col-md-8 col-sm-6 col-xs-4">
      <a href="/">
        <img src="/assets/images/Alidade_logo_logo_circle.svg" class="alidade-header-logo" alt="Alidade Logo">
        <h1>Alidade</h1>
      </a>
    </div>
		<div class="col-md-4 col-sm-6 col-xs-8">
			<?php if(isset($_SESSION[APPNAME][SESSIONKEY]) && !empty($_SESSION[APPNAME][SESSIONKEY]) && !isset($_SESSION[APPNAME]['DISP'])) { ?>
			<div class="pull-right user-panel">
				<span class="user-name">Hello, <strong><?php echo $_SESSION[APPNAME]['USR']; ?></strong>.</span>
				<ul class="user-actions">

					<?php if(isset($userRole) && $userRole == 'root') { ?>
					<li><a href="/manage/index" title="Manage Contents" class="mininav btn btn-alidade"><i class="fa fa-wrench fa-fw"></i><span class="hidden-xs">Manage</span></a></li>
					<?php } ?>
          <li><a href="/user/projects" title="All your Projects" class="mininav btn btn-alidade" id="projects-page"><i class="fa fa-tasks fa-fw"></i><span class="hidden-xs">My Projects</span></a></li>
				  <li><a href="/user/logout" title="Logout" class="mininav btn btn-blank">Logout</a></li>
				</ul>
			</div>
			<?php } else { ?>
			<a href="#" data-toggle="modal" data-target="#user-forms" class="btn btn-alidade btn-lg pull-right"><?php t("Register or Login to save progress"); ?></a>
		<?php } ?>
    <?php if(MULTILANG) { languageSelector(); } ?>
		</div>
	</header>
</div>
