<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="login.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
	<?php
	function genera_avviso(){
		include "../connessione.php";
		if(isset($_REQUEST["user"])){
				echo "il tuo username è"." ".$_REQUEST["user"];
		}	
		else if(isset($_REQUEST["messaggio"])){
				echo $_REQUEST["messaggio"];
		}
		else if(isset($_REQUEST["avviso_pass"])){
				echo "la tua nuova password è"." ".$_REQUEST["avviso_pass"];
		}
		else if(isset($_REQUEST["bisogna_accedere"])){
			$id_prod = $_REQUEST["id_prod"];
			session_start();
			$_SESSION["id_prod"] = $id_prod;
			echo "per acquistare devi prima accedere con il tuo account";
		}
		mysqli_close($conn);
	}
	?>
</head>
<body>
	<div class="button">
		<a href="../index.php" class="btn1">HOME</a> 
		<a href="../compra/compra.php" class="btn2">COMPRA</a>
		<a href="../registrazione/registrazione.php" class="btn3">REGISTRATI</a>
	</div>
	<div class="container">
		<img src="../immagini/logo_persona.png">
		<form name="inputform" method="post" action="e_login.php">
		<div class="avviso">
			<p>
				<?php
				genera_avviso();
				?>
			</p>
		</div>
		<div class="person_in">
			<input type="text" name="user" id="user" placeholder="inserisci il tuo username">
		</div>
		<div class="pass_in">
			<input type="password" name="pass" id="pass" placeholder="inserisci la password">
		</div>
			<input type="submit" id="invia" name="invia" value="accedi"><br>
			<a href="../recupera_pass/recupera_pass.php">hai perso la password?</a>
			<font color="white">/</font>
			<a href="../cambia_pass/cambia_pass.php">vuoi cambiare la password?</a>
		</form>
	</div>
</body>
<script src="../../libjq.js"></script>
<script src="controllo.js"></script>
</html>