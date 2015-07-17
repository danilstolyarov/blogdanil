<?php
				session_start();
				$id=$_GET["id"];
?>
<html>
<head>
		<link rel ="stylesheet" href="style.css" media="all">
</head>
<body>
	<div class="header">
		<h1>
			Рецепт
		</h1>
		<div class="left">
				<a href="index.php">&larr; назад</a>
			</div>
	</div>
	<div class="avtor">
		<h1>Авторизация</h1>
		<form method="post" action="recept.php?id=<?php echo "$id"; ?>">
		<?php
			if(isset($_SESSION['name']))
			{
				$mailp=$_SESSION['name'];
				echo"Вы авторизванны :<p>$mailp.</p>
				<p><input class=\"knopka\" type = \"submit\" name=\"vihod\" id=\"vihod\" value =\"Выйти\"/></p>";
				require_once("db.php"); 
			$query=mysql_query("select status from registr where email='$mailp' ", $link) or die(mysql_error());
			$verification=mysql_query("select verification from registr where email='$mailp' ", $link) or die(mysql_error());
			$verif=mysql_fetch_row($verification);
			$verif=$verif[0];
			$proverka=mysql_fetch_row($query);
			$proverka=$proverka[0];
			if($proverka<1)
				{
					echo"<p>Регистрация не завершена</p>
						<p>перейдите по ссылке :</p>
						<p><a href=\"ver.php?ver=$verif\">ССЫЛКА</a></p>
					";
				}
			}
			
			else
			{
				echo'
				E-mail:&nbsp;<input class="comment" type ="email" name="mail" id="mail" required />
				<p>Пароль:<input class="comment" type ="password" name="parol" id="parol" required /></p>
				<div class="menu">
					<input class="knopka" type = "submit" name="vhod" id="vhod" value ="Вход"/>
					&nbsp;
					<a href="registr.php">Регистрация</a>
				</div>';
			}
			?>
		</form>
		<?php
			if(isset($_POST['vhod']))
			{
				$mail=$_POST['mail'];
				$parol=md5($_POST['parol']);
				require_once("db.php"); 
				$query=mysql_query("SELECT password FROM registr WHERE email='$mail'", $link) or die(mysql_error());
				$usersdata=mysql_fetch_array($query);
				if($usersdata['password']==$parol)
					{
						$_SESSION['name']=$mail;
						echo "<meta http-equiv='Refresh' content='0; URL=recept.php?id=$id'>";
					}
				else
					{
						echo"Неверный пароль или логин!";
					}
			}
			if(isset($_POST['vihod']))
			{
				unset($_SESSION['name']);
				session_destroy();
				echo "<meta http-equiv='Refresh' content='0; URL=recept.php?id=$id'>";	 	
		    }
		?>
	</div>
		<div class ="mid" >
			<div class="recept">
	
				<?php 
					require_once("db.php"); 
					$query=mysql_query("SELECT recept FROM recept WHERE id_z=$id", $link) or die(mysql_error());
					$zag1=mysql_fetch_row($query);
					$zag=$zag1[0];
				?>
				<p><img src="images/<?php echo "$id" ?>.jpg" alt = "рецепт"><?php echo "$zag"?></p>
				<div class="comment">
				<?php
					if(isset($_SESSION['name']))
					{
						require_once("db.php"); 
						$query=mysql_query("select status from registr where email='$mailp' ", $link) or die(mysql_error());
						$proverka=mysql_fetch_row($query);
						$proverka=$proverka[0];
						if($proverka<1)
							{
								echo
									"<div class=\"uvedomlenie\">
										<h2>Регистрация не завершена перейдите по ссылке : <a href=\"ver.php?ver=$verif\">ССЫЛКА</a></h2>
									</div>";							
							}
							else{
						
						require_once("db.php"); 
						$query = mysql_query("SELECT comment,datak,mail FROM `comm` WHERE `id_z`=$id", $link);	
						echo"<p>Комментарии:</p>";
						while($row = mysql_fetch_array($query))
																{
																echo "
																		<p>&#9658;$row[mail] $row[datak]</p>
																		<p>$row[comment]</p>
																	";
																}
						echo"
						</div>
						<p>Оставить комментарий:</p>
						<form name=\"comment\" action=\"recept.php?id=$id\" method=\"post\">
						<br/>
						<textarea class=\"pole\" name=\"text_comment\" cols=\"100\" rows=\"10\" required ></textarea>
						<p>
							<input class=\"knopka\" type=\"submit\"  name=\"submit\" value=\"Оставить комментарий\" />
						</p>
						</form>";
					}}
					else
					{
						echo"
						<div class=\"uvedomlenie\">
							<h2>Для того чтобы просматривать и добавлять комментарии авторизируйтесь или <a href=\"registr.php\">ЗАРЕГИСТРИРУЙТЕСЬ!!!</a></h2>
						</div>";
					}
							$dt=date('Y-m-d [H:i:s]');
						  if(isset($_POST['submit'])){
						  $mail=$_SESSION['name'];
						  $text_comment = $_POST["text_comment"];
						  $text_comment = htmlspecialchars($text_comment);
						  require_once("db.php"); 
						  $query=mysql_query("INSERT INTO comm (id_z,comment,datak,mail) VALUES ('$id','$text_comment','$dt','$mail')",$link) or die(mysql_error());
						echo "<meta http-equiv='Refresh' content='0; URL=recept.php?id=$id'>";
						 }
						?>
			</div>
		</div>
</body>
</html>