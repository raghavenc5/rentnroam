<?php echo $this->load->view('header_view'); ?>

			<div class="row-fluid">
				<div class="span12 center login-header">
					<img alt="Rnr Admin section" src="<?php echo base_url()?>public/images/logo-houses.png" /><span>Welcome to Rnr Admin</span>
				</div><!--/span-->
			</div><!--/row-->
			
			<div class="row-fluid">
				<div class="well span5 center login-box">
					<div class="alert alert-info">
						Please login with your Username and Password.
					</div>
					<form class="form-horizontal" action="<?php echo base_url()?>admin/login/process_login" method="post">
						<fieldset>
							<?php
							if(validation_errors() || $error != '')
							{?>
							<div class="alert alert-error">
								<button type="button" class="close" data-dismiss="alert">X</button>
								<strong>Login Failed</strong><br>
								<?php echo validation_errors();?>
								<?php echo $error;?>
							</div>
							<?php
							}?>
							<div class="input-prepend" title="Username" data-rel="tooltip">
								<span class="add-on"><i class="icon-user"></i></span><input autofocus class="input-large span10" name="user_name" id="user_name" type="text" value="<?php echo $user_name;?>" />
							</div>
							<div class="clearfix"></div>

							<div class="input-prepend" title="Password" data-rel="tooltip">
								<span class="add-on"><i class="icon-lock"></i></span><input class="input-large span10" name="password" id="password" type="password" value="<?php echo $password;?>" />
							</div>
							<div class="clearfix"></div>

							<p class="center span5">
							<button type="submit" class="btn btn-primary">Login</button>
							</p>
						</fieldset>
					</form>
				</div><!--/span-->
			</div><!--/row-->
<?php echo $this->load->view('footer_view');  ?>
