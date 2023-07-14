	<aside>
	<h3>Login</h3>
	<form method='post' action='#'>
		<label>Usuario</label>
		<input type='text' name='usuario' value='<?=$nif ?? null?>'>
		<br>
		<label>Password</label>
		<input type='password' name='password'>
		<br><br>
		<input type='submit' name='login' value='login'>
	</form>
	<br>
	<?=$mensajes ?? null;?>
	</aside>