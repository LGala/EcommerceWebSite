<?php
include '../connessione.php';
if(!isset($_REQUEST["invia"])){
	header("Location:login.php");
    die();
}
$mail = $_REQUEST["mail"];
$user = $_REQUEST["user"];

$sql = "select password from utente where email = '$mail' and user = '$user'";
$qry = mysqli_query($conn, $sql);
if(mysqli_num_rows($qry)){
	$record = mysqli_fetch_assoc($qry);
	if(mail($mail, "email perdita password", "la tua password e': ".$record["password"])){
		header("Location:../login/login.php?messaggio=la mail è stata inviata,può impiegare un pò di tempo...");
	}
}
else header("Location:../login/login.php?messaggio=nome utente/email non corretta");
?>