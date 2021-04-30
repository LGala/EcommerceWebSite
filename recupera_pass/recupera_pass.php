<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="recupera_pass.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
	<script type="text/javascript" src="controllavuotirec_pass.js"></script>
</head>
<body>
	<div class="button">
		<a href="../index.php" class="btn1">HOME</a> 
		<a href="../compra/compra.php" class="btn2">COMPRA</a>
		<a href="../registrazione/registrazione.php" class="btn3">REGISTRATI</a>
	</div>
	<div class="container">
		<img src="../immagini/logo_persona.png">
		<p>
			ti sarà inviata una mail con la password da te smarrita 
		</p>
		<form name="inputform" method="post" onsubmit="return controllo();" action="e_recupera_pass.php">
			<div class="email_in">
				<input type="text" name="mail" id="email" placeholder="inserisci la tua mail">
			</div>
        	<div class="person_in">
				<input type="text" name="user" id="user" placeholder="inserisci il tuo username">
			</div>
			<input type="submit" id="invia" name="invia" value="invia mail"><br>
		</form>
	</div>
</body>
</html>