<?php
chiamate_ajax();

function chiamate_ajax(){
	include '../connessione.php';
	if(isset($_REQUEST["id_prod"])){
		$id_prod = $_REQUEST["id_prod"];
		$id_utente = $_REQUEST["id_utente"];
		$sql = "delete from carrello where fk_prodotto = '$id_prod' and fk_utente = $id_utente";
		mysqli_query($conn, $sql);
		$sql = "select quantita,idmagazzino_prod from magazzino_prod where fk_prodotto = '$id_prod'";
		$qry = mysqli_query($conn, $sql);
		$array_idmagazzino_prod = array();
		for($i = 0; $record = mysqli_fetch_assoc($qry); $i++) {
			$array_idmagazzino_prod[$i] = $record["idmagazzino_prod"];
		}
		$scegli_idmagazzino_prod_casualmente = random_int($array_idmagazzino_prod[0], $array_idmagazzino_prod[1]);
		$sql = "update magazzino_prod set quantita = quantita + 1 where idmagazzino_prod = '$scegli_idmagazzino_prod_casualmente'";
		mysqli_query($conn, $sql);
		$costo = $_REQUEST["costo_elim"];
		$prezzo_prod = $_REQUEST["prezzo_prod_elim"];
		$nuovo_prezzo = $costo-$prezzo_prod;
		echo $nuovo_prezzo;
		die();
	}
    
	if(isset($_REQUEST["id_prodotto"])){
		$esiste = 0;
		$id_utente = $_REQUEST["id_utente"];
		$id_prod = $_REQUEST["id_prodotto"];
		$sql = "select quantita,idmagazzino_prod from magazzino_prod where fk_prodotto = '$id_prod'";
		$qry = mysqli_query($conn, $sql);
		while ($record = mysqli_fetch_assoc($qry)) {
			if($record["quantita"] > 0){
				$esiste = 1;
				$prendi_da_questo = $record["idmagazzino_prod"];
			}
		}
		if($esiste !== 0){
			$sql = "update magazzino_prod set quantita = quantita - 1 where idmagazzino_prod = '$prendi_da_questo'";
			mysqli_query($conn, $sql);
			$sql = "select idcarrello from carrello where fk_prodotto = '$id_prod' and fk_utente = '$id_utente'";
			$qry = mysqli_query($conn, $sql);
			if(mysqli_num_rows($qry)){
				$true = 1;
				echo $true." ".$id_prod;
			}
			else{
				$sql = "insert into carrello (fk_utente, fk_prodotto, quantita) values ('$id_utente','$id_prod','1')";
				mysqli_query($conn, $sql);
				$false = 0;
				echo $false;
			}
		}
		else echo "gli articoli sono finiti";
		die();
	}
    
	if(isset($_REQUEST["id_prodotto_agg"])){
		$id_utente = $_REQUEST["id_utente"];
		$id_prod = $_REQUEST["id_prodotto_agg"];
		$sql = "update carrello set quantita = quantita + 1 where fk_prodotto = '$id_prod' and fk_utente = '$id_utente'";
		$qry = mysqli_query($conn, $sql);
		die();
	}
    
	if(isset($_REQUEST["id_acquirente"])){        
		$id_utente = $_REQUEST["id_acquirente"];
		$anno = $_REQUEST["anno"];
		$mese = $_REQUEST["mese"];
		$giorno_inlettere = $_REQUEST["giorno_inlettere"];
		$giorno_innumero = $_REQUEST["giorno_innumero"];
		$ora = $_REQUEST["ora"];
		$minuti = $_REQUEST["minuti"];
		$orario = $giorno_inlettere." ".$giorno_innumero." ".$mese." ".$anno." "."alle ".$ora.":".$minuti;
		$casella_indirizzo = $_REQUEST["casella_indirizzo"];
		$casella_fatturazione = $_REQUEST["casella_fatturazione"];
		$sql = "select fk_prodotto,quantita from carrello where fk_utente = '$id_utente'";
		$qry = mysqli_query($conn, $sql);
		while ($record = mysqli_fetch_assoc($qry)) {
			$sql = "insert into prodotti_ordinati (fk_prodotto, fk_utente, data_acquisto, quantita, indirizzo_scelto, indirizzo_di_fatturazione_scelto) values ('{$record["fk_prodotto"]}','$id_utente','$orario','{$record['quantita']}','$casella_indirizzo','$casella_fatturazione')";
			mysqli_query($conn, $sql);
		}
		$sql = "delete from carrello where fk_utente = '$id_utente'";
		mysqli_query($conn, $sql);
		die();
	}
    
	else{
		$costo = $_REQUEST["nuovo_costo"];
		echo "il nuovo costo totale e' ".$costo."€";
		die();
	}
}
?>