<?php
	
	require "db.php";



	if (isset($_POST['do_signup'])) 
	{
		$errors = array();

		$login = trim($_POST['login']);
		$email = trim($_POST['email']);
		$pass = $_POST['password'];
		$hashPass= password_hash($pass,PASSWORD_DEFAULT);
		$result = $mysqli->query("SELECT login FROM users4 ");
		echo "$hashPass";



		if(trim($_POST['login']) == "")
		{
			$errors[] = "Введите логин!";
		}
		if(trim($_POST['email']) == "")
		{
			$errors[] = "Введите Email!";
		}
		if(trim($_POST['password']) == "")
		{
			$errors[] = "Введите пароль!";
		}
		if(($_POST['password']) != ($_POST['password_2']))
		{
			$errors[] = "Пароли не совпадают!";
		}
		
		while($row = mysqli_fetch_array($result)){
			if($row['login'] == $login){
				$errors[] = "Аккаунт с таким логином уже существует";
				break;
			}
		}
		
		if(empty($errors)){
			//Все хорошо, регистрируем!


			$mysqli->query ("INSERT INTO `users4` (`id`, `login`, `email`, `password`) VALUES (NULL, '$login', '$email','$hashPass')");
		}else{
			echo '<div style="color:red;">' .array_shift($errors). '</div><hr>';
		}

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
	<form action="signup.php" method="POST">
	<p>
		<p><strong>Ваш логин:</strong></p>
		<input type="text" name="login" >
	</p>

	<p>
		<p><strong>Ваш Email:</strong></p>
		<input type="email" name="email" >
	</p>

	<p>
		<p><strong>Ваш пароль:</strong></p>
		<input type="password" name="password" >
	</p>

	<p>
		<p><strong>Повторите пароль:</strong></p>
		<input type="password" name="password_2">
	</p>

	<p>
		<input type="submit" name="do_signup" id="sub" value="Зарегистрироваться"><br><br>
		<a id="link" href="login.php">Вход</a>
	</p>
</form>
</body>
</html>

