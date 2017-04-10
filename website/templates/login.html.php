<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>
	<h1>Login</h1>
	<form method="POST">
		<label>
			Email:
			<input type="email" name="email" value="<?= htmlentities((isset($email)) ? $email : "") ?>"/>
		</label>
		<label>
			Password:
			<input type="password" name="password" />
		</label>
		<input type="submit" value="Login" />
	</form>
</body>
</html>
