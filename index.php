<?php
				session_start();
?>
<html>
<head>
		<link rel ="stylesheet" href="style.css" media="all">
</head>
<body>
	<?php
				require_once("db.php"); 
				$ver=$_GET["ver"];
				if(isset($_GET["ver"]))
				{
					$query=mysql_query("Update registr set status='1' where verification='$ver' ", $link) or die(mysql_error());
				}
	?>
	<div class="header">
		<h1>
			ВСтоловой.жру
		</h1>
	</div>
	<div class="avtor">
		<h1>Авторизация</h1>
		<form method="post" action="index.php">
		<?php
			if(isset($_SESSION['name']))
			{
				$mailp=$_SESSION['name'];
				echo"Вы авторизованны :<p>$mailp.</p>
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
						echo "<meta http-equiv='Refresh' content='0; URL=index.php'>";
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
				echo "<meta http-equiv='Refresh' content='0; URL=index.php'>";	 	
		    }
		?>
	</div>
		<div class ="mid" >
			<?php
				require_once("db.php"); 
				$query=mysql_query("SELECT zagolovok FROM zogolovki WHERE id_z=1", $link) or die(mysql_error());
				$zag1=mysql_fetch_row($query);
				$zag=$zag1[0];
				$query=mysql_query("SELECT text FROM zogolovki WHERE id_z=1", $link) or die(mysql_error());
				$tex1=mysql_fetch_row($query);
				$tex=$tex1[0];
			?>
			<div class="sec">
				<h1>
					<a href="recept.php?id=1"><?php echo"$zag"?></a>
				</h1>
				<p><?php echo"$tex"?><a href="recept.php?id=1"> ДАЛЕЕ..</a></p>	
				<?php 
					require_once("db.php"); 
					$query=mysql_query("SELECT * from comm where id_z= 1", $link) or die(mysql_error());
					$lol=mysql_num_rows($query);
					echo "Количество комментариев: $lol"; 
				?>
			</div>
			<div class = "sec">
				<img src="images/1.jpg" alt="Новость-1" title="Новость-1">
			</div>
			<?php
				$query=mysql_query("SELECT zagolovok FROM zogolovki WHERE id_z=2", $link) or die(mysql_error());
				$zag1=mysql_fetch_row($query);
				$zag=$zag1[0];
				$query=mysql_query("SELECT text FROM zogolovki WHERE id_z=2", $link) or die(mysql_error());
				$tex1=mysql_fetch_row($query);
				$tex=$tex1[0];
			?>
			<div class="sec">
				<img src="images/2.jpg" alt="Новость-2" title="Новость-2">	
			</div>
			<div class = "sec">
				<h1>
					<a href="recept.php?id=2"><?php echo "$zag" ?></a>	
				</h1>
				<p><?php echo"$tex"?><a href="recept.php?id=2"> ДАЛЕЕ..</a></p>
				<?php 
					require_once("db.php"); 
					$query=mysql_query("SELECT * from comm where id_z= 2", $link) or die(mysql_error());
					$lol=mysql_num_rows($query);
					echo "Количество комментариев: $lol"; 
					?>
			</div>	
			<?php
				$query=mysql_query("SELECT zagolovok FROM zogolovki WHERE id_z=3", $link) or die(mysql_error());
				$zag1=mysql_fetch_row($query);
				$zag=$zag1[0];
				$query=mysql_query("SELECT text FROM zogolovki WHERE id_z=3", $link) or die(mysql_error());
				$tex1=mysql_fetch_row($query);
				$tex=$tex1[0];
			?>
			<div class = "sec">
				<h1>
					<a href="recept.php?id=3"><?php echo "$zag" ?></a>	
				</h1>
				<p><?php echo"$tex"?><a href="recept.php?id=3"> ДАЛЕЕ..</a></p>
				<?php 
					require_once("db.php"); 
					$query=mysql_query("SELECT * from comm where id_z= 3", $link) or die(mysql_error());
					$lol=mysql_num_rows($query);
					echo "Количество комментариев: $lol"; 
				?>
			</div>	
			<div class="sec">
				<img src="images/3.jpg" alt="Новость-3" title="Новость-3">	
			</div>
		</div>
			<footer>
		lol
		</footer>
</body>
</html>