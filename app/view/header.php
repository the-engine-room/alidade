<!-- Modal -->
<div class="modal fade" id="user-forms" tabindex="-1" role="dialog" aria-labelledby="UserLoginAndRegistration">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Login or Register</h4>
			</div>
			<div class="modal-body">
		
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12">
						<?php
						
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
								<a href="/user/create">or register here</a> 
							</div>
						</form>
						<?php
						} 
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="container-fluid">
	<header class="row">
		<div class="col-md-8 col-sm-6 col-xs-4"><h1>Alidade</h1></div>
		<div class="col-md-4 col-sm-6 col-xs-8">
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
			<?php } else { ?>
			<a href="#" data-toggle="modal" data-target="#user-forms" class="btn btn-alidade btn-lg pull-right">Register or Login to save progress</a>
		<?php } ?>
		</div>
	</header>
</div>