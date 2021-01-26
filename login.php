<?php
	require"db.php";

	if (isset($_POST['do_login'])) {
		$login = $_POST['login'];
		$pass = $_POST['password'];
		$user = $mysqli->query("SELECT * FROM users4 WHERE login ='$_POST[login]'");
		$repass = $mysqli->query("SELECT password FROM users4 WHERE login ='$_POST[login]");
		$count = mysqli_num_rows($user);
		$errors = array();
		$row = $user->fetch_assoc();
			if ($count ==1) 
			{
				if( password_verify($_POST['password'],$row['password']))
				{echo '<p style="color:green">Вход выполнен успешно</p>';}
				else{$errors[] = "Неправильный логин или пароль";}
			}else{$errors[] = "Пользователь не найден";}
			if(! empty($errors))
			{echo '<div style="color:red;">' .array_shift($errors). '</div><hr>';}
			}
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<style type="text/css">
		#sub{
			background: #e2e2e2;
			border: none;
			padding: 2px 8px 2px 8px;
			text-decoration: none;
			color: #000;
			border: 1px solid #a5a5a5;
			font: 400 13.3333px Arial;
		}
		#link{
			display: inline-block;
			background: #e2e2e2;
			padding: 2px 8px 2px 8px;
			text-decoration: none;
			color: #000;
			border: 1px solid #a5a5a5;
			font: 400 13.3333px Arial;
		}
	</style>
</head>
<body>
	<form action="login.php" method="POST">
		<p>
			<p><strong>Ваш логин:</strong></p>
			<input type="text" name="login" >
		</p>

		<p>
			<p><strong>Ваш пароль:</strong></p>
			<input type="password" name="password" >
		</p>
		<p>
			<input type="submit" id="sub" name="do_login" value="Войти"> &nbsp;
			<a id="link" href="signup.php">Регистрация</a>
		</p>
	</form>
</body>
</html>