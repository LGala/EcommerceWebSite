<?php
include '../connessione.php';
if(!isset($_REQUEST["invia"])){
	header("Location:login.php");
    die();
}
$nome = $_REQUEST["nome"];
$cognome = $_REQUEST["cognome"];
$data = $_REQUEST["data"];
$email = $_REQUEST["email"];
$password = $_REQUEST["pass"];
$username = $nome.$cognome;
$sql = "select count(user) as contauser from utente where user like '%$username%'";
$result = mysqli_query($conn, $sql);
$record = mysqli_fetch_assoc($result);
if($record["contauser"] > 0){
	$username = $username.$record["contauser"];
}
$sql = "insert into utente (nomeutente, cognomeutente, datanascita, user, password, email) values ('$nome','$cognome','$data','$username','$password','$email')";
mysqli_query($conn, $sql);
header("Location:../login/login.php?user=$username");
mysqli_close($conn);
?>