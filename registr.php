<html>
<head>
	<link rel ="stylesheet" href="style.css" media="all">
</head>
<body>
	<div class="header">
		<h1>
			Регистрация
		</h1>
			<div class="left">
				<a href="index.php">&larr; назад</a>
			</div>
	</div>
		<div class="mid">
			<div class="reg">
			<div class="sec1">
			<p>E_mail</p>
			<p>Пароль</p>
			<p>Повторите пароль</p>
			</div>
			<div class="sec1">
			<form method="post" action="registr.php">
				<p><input class="comment" type ="email" name="mail" id="mail" required /></p>
				<p><input class="comment" type ="password" name="parol" id="parol" required /></p>
				<p><input class="comment" type ="password" name="parol2" id="parol2" required/></p>
				<p><input class="knopka" type = "submit" name="registr" id="registr" value ="Зарегестрироваться"/></p>
			</div>
			</form>
			<?php
			require_once("db.php"); 
			if(isset($_POST['registr'])){
				$mail=$_POST['mail'];
				$parol=$_POST['parol'];
				$parol2=$_POST['parol2'];
				$proverka1=mysql_query("select * from registr where email='$mail'", $link) or die(mysql_error());
					$proverka=mysql_num_rows($proverka1);
					if($proverka<1){
				if($parol == $parol2){
					$parol=md5($parol);
					$verif=md5(uniqid(rand(),true));
					$query=mysql_query("INSERT INTO registr(email,password,status,verification) VALUES('$mail','$parol','0','$verif') ", $link) or die(mysql_error());			
					echo "<meta http-equiv='Refresh' content='0; URL=ver.php?ver=$verif'>";
				
				}
				else{ echo"<p>Пароли не совпадают!</p>";}	
			}
			else{echo"<p>Пользователь с такой почтой уже зарегистрирован!</p>";}
			}
			?>
		</div>
</body>
</html>