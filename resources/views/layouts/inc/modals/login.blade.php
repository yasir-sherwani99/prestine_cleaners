<div class="modal fade" id="sign-in-dialog" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  	<div class="modal-dialog">
    	<div class="modal-content">
      		<div class="modal-header">
        		<h5 class="modal-title" id="staticBackdropLabel">Sign In</h5>
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          			<span aria-hidden="true">&times;</span>
        		</button>
      		</div>
      		<div class="modal-body">
        		<!--Tabs -->
				<div class="sign-in-form style-1">
					<ul class="tabs-nav">
						<li class=""><a href="#tab1">Log In</a></li>
						<li><a href="#tab2">Register</a></li>
					</ul>
					<div class="tabs-container alt">
						<!-- Login -->
						<div class="tab-content" id="tab1" style="display: none;">
							<form method="post" class="login">

								<p class="form-row form-row-wide">
									<label for="username">Username:
										<i class="im im-icon-Male"></i>
										<input type="text" class="input-text" name="username" id="username" value="" />
									</label>
								</p>

								<p class="form-row form-row-wide">
									<label for="password">Password:
										<i class="im im-icon-Lock-2"></i>
										<input class="input-text" type="password" name="password" id="password"/>
									</label>
									<span class="lost_password">
										<a href="#" >Lost Your Password?</a>
									</span>
								</p>

								<div class="form-row">
									<input type="submit" class="button border margin-top-5" name="login" value="Login" />
									<div class="checkboxes margin-top-10">
										<input id="remember-me" type="checkbox" name="check">
										<label for="remember-me">Remember Me</label>
									</div>
								</div>
							</form>
						</div>

						<!-- Register -->
						<div class="tab-content" id="tab2" style="display: none;">

							<form method="post" class="register">
								
								<p class="form-row form-row-wide">
									<label for="username2">Username:
										<i class="im im-icon-Male"></i>
										<input type="text" class="input-text" name="username" id="username2" value="" />
									</label>
								</p>	
								<p class="form-row form-row-wide">
									<label for="email2">Email Address:
										<i class="im im-icon-Mail"></i>
										<input type="text" class="input-text" name="email" id="email2" value="" />
									</label>
								</p>
								<p class="form-row form-row-wide">
									<label for="password1">Password:
										<i class="im im-icon-Lock-2"></i>
										<input class="input-text" type="password" name="password1" id="password1"/>
									</label>
								</p>
								<p class="form-row form-row-wide">
									<label for="password2">Repeat Password:
										<i class="im im-icon-Lock-2"></i>
										<input class="input-text" type="password" name="password2" id="password2"/>
									</label>
								</p>

								<input type="submit" class="button border fw margin-top-10" name="register" value="Register" />

							</form>
						</div>

					</div>
				</div>
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      		</div>
    	</div>
  	</div>
</div>
