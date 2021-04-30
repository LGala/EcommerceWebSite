<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="registrazione.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
</head>
<body>
	<div class="button">
		<a href="../index.php" class="btn1">HOME</a>
		<a href="../compra/compra.php" class="btn2">COMPRA</a>
		<a href="../login/login.php" class="btn3">ACCEDI</a>
	</div>
	<div class="container">
		<img src="../immagini/logo_persona.png">
			<form name="inputform" method="post" onsubmit="return controllo();" action="e_registrazione.php">
				<div class="person_in">
					<input type="text" name="nome" id="nome" placeholder="inserisci il nome">
				</div>
				<div class="person_in">
					<input type="text" name="cognome" id="cognome" placeholder ="inserisci il cognome" >
				</div>
				<div class="data_in">
					<input type="DATE" name="data" id="data">
				</div>
				<div class="email_in">
					<input type="text" name="email" id="email" placeholder="inserisci il tuo indirizzo email">
				</div>
				<div class="pass_in">
					<input type="password" name="pass" id="password" placeholder="inserisci la password(min 8 caratteri)">
				</div>
				<div class="controlla_pass_in">
					<input type="password" name="controlla_pass" id="controlla_pass" placeholder="reinserisci la password">
				</div>
					<input type="submit" id="invia" name="invia" value="registrati"><br>
			</form>
	</div>
</body>
<script src="../../libjq.js"></script>
<script src="controllo.js"></script>
</html>