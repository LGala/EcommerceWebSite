<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="cambia_pass.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
</head>
<body>
	<div class="button">
		<a href="../index.php" class="btn1">HOME</a> 
		<a href="../compra/compra.php" class="btn2">COMPRA</a>
		<a href="../registrazione/registrazione.php" class="btn3">REGISTRATI</a>
	</div>
	<div class="container">
		<img src="../immagini/logo_persona.png">
		<form name="inputform" method="post" action="e_cambia_pass.php">
			<div class="avviso">
				<p>
					<?php
					include '../connessione.php';
					if(isset($_REQUEST["messaggio"])){
					echo $_REQUEST["messaggio"];
				    }
				    mysqli_close($conn);
				    ?>
				</p>
			</div>
		<div class="person_in">
			<input type="text" name="user" id="user" placeholder="inserisci il tuo username">
		</div>
		<div class="pass_in">
			<input type="password" name="pass" id="pass" placeholder="inserisci la password">
		</div>
		<div class="pass_in">
			<input type="password" name="nuova_pass" id="nuova_pass" placeholder="inserisci la nuova password">
		</div>
		<div class="controlla_pass_in">
			<input type="password" name="contr_pass" id="contr_pass" placeholder="reinserisci la nuova password">
		</div>
			<input type="submit" id="invia" name="invia" value="cambia password"><br>
		</form>
	</div>
</body>
<script src="../../libjq.js"></script>
<script src="controllo.js"></script>
</html>