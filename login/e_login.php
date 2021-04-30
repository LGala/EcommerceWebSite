<?php
session_start();
include '../connessione.php';
if(!isset($_REQUEST["invia"])){
	header("Location:login.php");
    die();
}
$user = $_REQUEST["user"];
$pass = $_REQUEST["pass"];

$_SESSION["user"] = $user;
$_SESSION["pass"] = $pass;

$sql = "select idutente from utente where user = '$user' and password = '$pass'";
$result = mysqli_query($conn, $sql);
$record = mysqli_fetch_assoc($result);
$id = $record["idutente"];
$_SESSION["id"] = $id;

if(isset($_SESSION["id_prod"])){
	$id_prod = $_SESSION["id_prod"];
	header("Location:../compra/compra.php?prodotto=$id_prod"); 
	die(); // L'HEADER INDIRIZZA IN UN'ALTRA PAGINA MA CONTINUA L'ELABORAZIONE PER QUESTO IL DIE
}

if(!mysqli_num_rows($result)){
	header("Location:login.php?messaggio=username e password non corrispondenti");
}
else header("Location:../compra/compra.php");

?>