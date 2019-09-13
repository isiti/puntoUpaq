<div class="show-content hidden" data-section="home">   
	
	<div class="logo-login">
		<img src="img/login_logo.gif">	
	</div>	

	<div class="new-acc-message" id="new-acc-message"><span><?php if (isset($_GET['error'])) { if ($_GET['error']=='bar-rec') echo 'Ha ocurrido un error al intentar recuperar la contraseña.'; else if ($_GET['error']=='no-error') echo 'La contraseña se ha modificado exitosamente!'; } ?></span></div>
	<div class="login">
		<form action="" method="POST" role="form" id="form_login">
			<input class="login-input" type="text" id="user_login" name="user" placeholder="USUARIO" required="required"/>
			<input class="login-input" type="password" id="pass_login" name="password" placeholder="CONTRASEÑA" required="required"/>
			<a class="sec-ident" id="forgot" data-section="forgot">*Olvidé la contraseña</a>
			<button type="submit" id="login-btn-submit" name="submit" value="submit" class="login-btn">INICIAR SESIÓN</button>
			<p id="login-message"></p>
		</form>
	</div>
</div>
