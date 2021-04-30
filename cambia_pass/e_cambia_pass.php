<?php
include '../connessione.php';
if(!isset($_REQUEST["invia"])){
	header("Location:login.php");
    die();
}
$user = $_REQUEST["user"];
$pass = $_REQUEST["pass"];
$nuova_pass = $_REQUEST["nuova_pass"];
$sql = "select idutente from utente where user = '$user' and password = '$pass'";
$result = mysqli_query($conn,$sql);
$record = mysqli_fetch_assoc($result);
echo $record;
if(mysqli_num_rows($result)){
	$sql = "update utente set password = '$nuova_pass' where user = '$user'";
	mysqli_query($conn,$sql);
	header("Location:../login/login.php?messaggio=password aggiornata");
}
else header("Location:cambia_pass.php?messaggio=utente e password non corrispondenti");
mysqli_close($conn);
?>