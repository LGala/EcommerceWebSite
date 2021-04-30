<!DOCTYPE html>
<title>e-market</title>
	<head>
		<?php
		session_start();
		?>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="reset.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="compra.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="animated.css" media="screen" />
		<?php
		function genera_contenuti(){
			include "../connessione.php";
			if (isset($_REQUEST["idmacrocategoria"])) { //genera tutti i prodotti di una categoria
				$idmacrocategoria = $_REQUEST["idmacrocategoria"];
				$sql = "select macrocategoria from macrocategoria where idmacrocategoria = '$idmacrocategoria'";
				$qry = mysqli_query($conn, $sql);
				$record = mysqli_fetch_assoc($qry);
				echo "<div class='titolo'><h1>{$record['macrocategoria']}<h1></div>";
				$sql = "select path_fotoprod,nomeprodotto,idprodotto,descrizione_prod from prodotto join tipo_prodotto on fk_tipo_prodotto = idtipo_prodotto join categoria on idcategoria = fk_categoria join macrocategoria on idmacrocategoria = fk_macrocategoria where idmacrocategoria='$idmacrocategoria' ";
				$qry = mysqli_query($conn, $sql); 
				echo "<div>";
				for($i = 0; $i<4; $i++){
					echo "<br>";
				}				
				echo "</div>";
				while ($record = mysqli_fetch_assoc($qry)) {
					echo "<div class = 'container_prod'>";
					echo "<div class='nome_prod_idmacrocategoria'>";
					echo "</div>";
					echo "<a href='compra.php?prodotto={$record['idprodotto']}'><img class='foto_prod' src = '{$record['path_fotoprod']}'></a>";
					echo "<div class = 'descrizione_div'>";
					echo "<a class='nome_prod' href='compra.php?prodotto={$record['idprodotto']}'>{$record['nomeprodotto']}</a>";
					echo "<br>";
					echo "<p class='descrizione'>{$record["descrizione_prod"]}</p>";
					echo "</div>";
					echo "</div>";
					for($i = 0; $i<5; $i++){//GENERA SPAZIO TRA UN ARTICOLO E UN ALTRO
						echo "<br>";
					}
					echo "<hr />";
					for($i = 0; $i<5; $i++){//GENERA SPAZIO TRA UN ARTICOLO E UN ALTRO
						echo "<br>";
					}
				}			
			}
			else if(isset($_REQUEST["idcategoria"])){//genera tutti i prodotti di una sottocategoria
				$idcategoria = $_REQUEST["idcategoria"];
				$sql = "select categoria from categoria where idcategoria = '$idcategoria'";
				$qry = mysqli_query($conn, $sql);
				$record = mysqli_fetch_assoc($qry);				
				echo "<div class='titolo'><h1>{$record['categoria']}<h1></div>";
				$sql = "select path_fotoprod,nomeprodotto,idprodotto,descrizione_prod from prodotto join tipo_prodotto on fk_tipo_prodotto = idtipo_prodotto join categoria on idcategoria=fk_categoria where idcategoria = '$idcategoria'";
				$qry = mysqli_query($conn, $sql); 
				echo "<div>";
				for($i = 0; $i<4; $i++){//GENERA SPAZIO TRA IL TITOLO E IL PRIMO ARTICOLO
						echo "<br>";
					}
				while ($record = mysqli_fetch_assoc($qry)) {
					echo "<div class = 'container_prod'>";
					echo "<div class='nome_prod_idmacrocategoria'>";
					echo "</div>";
					echo "<a href='compra.php?prodotto={$record['idprodotto']}'><img class='foto_prod' src = '{$record['path_fotoprod']}'></a>";
					echo "<div class = 'descrizione_div'>";
					echo "<a class='nome_prod' href='compra.php?prodotto={$record['idprodotto']}'>{$record['nomeprodotto']}</a>";
					echo "<br>";
					echo "<p class='descrizione'>{$record["descrizione_prod"]}</p>";
					echo "</div>";
					echo "</div>";
					for($i = 0; $i<5; $i++){//GENERA SPAZIO TRA UN ARTICOLO E UN ALTRO
						echo "<br>";
					}
					echo "<hr />";
					for($i = 0; $i<5; $i++){//GENERA SPAZIO TRA UN ARTICOLO E UN ALTRO
						echo "<br>";
					}
				}
			}
			else if(isset($_REQUEST["prodotto"])){//apre la pagina di un prodotto
				$idprodotto = $_REQUEST["prodotto"];
				$sql = "select nomeprodotto,path_fotoprod,path_caratteristiche,descrizione_prod,prezzo,nomefornitore from prodotto join fornitori_prod on idprodotto = fk_prodotto join fornitore on idfornitore = fk_fornitore where idprodotto='$idprodotto'";
				$qry = mysqli_query($conn, $sql);
				$record = mysqli_fetch_assoc($qry);
				echo "<div class='titolo'>";
				echo "<br>";
				echo $record["nomeprodotto"];
				echo "</div>";
				echo "<div class='prezzo_forn'>";
				echo "<a><button id ='$idprodotto' class='btn_aggiungi'>aggiungi al carrello</button></a>";
				echo "<br>";
				echo "<br>";
				echo "<p class='prezzo_prod_prod'>prezzo: {$record["prezzo"]} €</p>";
				echo "<br>";
				echo "<p class='prezzo_prod_prod'>fornitore: {$record["nomefornitore"]} </p>";
				echo "</div>";
				echo "<img class='foto_prod2' src='{$record['path_fotoprod']}'>";
				echo "<br>";
				echo "<br>";
				echo "<br>";
				echo "<img class='caratteristiche' src='{$record['path_caratteristiche']}'>";
				$sql = "select nomemagazzino,quantita from magazzino join magazzino_prod on idmagazzino = fk_magazzino where fk_prodotto='$idprodotto'";
				$qry = mysqli_query($conn, $sql);
				echo "<div class='nomemagazzino_quantita'>";
				echo "<p class='prezzo_prod_prod'>IN STOCK:</p>";
				while ($record = mysqli_fetch_assoc($qry)) {
					echo "<p class='prezzo_prod_prod'>{$record["nomemagazzino"]} quantità: {$record["quantita"]}</p>";
				}
				echo "</div>";
				if(isset($_SESSION["id"])){
					$id = $_SESSION["id"];
					echo "<input type = 'hidden' id = 'true' class='presente'>";
					echo "<input type = 'hidden' id = '$id' class='id_utente'>";					
				}
				else{
					echo "<input type = 'hidden' id = 'false' class='presente'>";
					echo "<input type = 'hidden' class='id_prodotto_nienteaccesso'>";
				}
			}
			else if(isset($_REQUEST["carrello"])) {//apre la pagina contenente i prodotti nel carrello
				echo "<div class='cattura_click_sulla_pag'>";
				echo "<div id='tendina' class='bounceInDown'>";
				echo "<p class='inserisci_credenziali'>COMPLETA L'ACQUISTO</p>";
				echo '<input type="text" class="caselle_conferma_acquisto_txt_1" placeholder="inserisci l indirizzo di spedizione"><br><br>';
				echo '<input type="text" class="caselle_conferma_acquisto_txt_2" placeholder="inserisci l indirizzo di fatturazione"><br><br>';
				$id = $_SESSION["id"];
				echo "<button id='$id' class='conferma_acquisto'>conferma acquisto</button>";
				echo '</div>';
				$vet_id = array();
				$vet_quantita = array();
				$sql = "select fk_prodotto,quantita from carrello where fk_utente = '$id'";
				$qry = mysqli_query($conn,$sql);
				if(mysqli_num_rows($qry)){
					echo "<div id = 'carr' class='titolo'><h1>carrello<h1></div>";
					for($i = 0;$record = mysqli_fetch_assoc($qry);$i++){
						$vet_id[$i] = $record["fk_prodotto"];
						$vet_quantita[$i] = $record["quantita"];
					}
					for($i=0,$costo=0;$i < count($vet_id);$i++){
						$sql = "select prezzo from prodotto where idprodotto = '{$vet_id[$i]}'";
						$qry = mysqli_query($conn, $sql);
						$record = mysqli_fetch_assoc($qry);
						$prezzo = $record["prezzo"] * $vet_quantita[$i];
						$costo = $costo + $prezzo;					
					}
					echo "<div class='ultimo_articolo_eliminato'>";
					echo "<h1><p id = '$costo' class='costo_carr'>il costo totale della spesa e': $costo €</p></h1>";
					echo "<br>";
					echo "<br>";
					echo "<a href='#'><button id = '$id' class='acquista'>procedi con l'acquisto</button></a>";
					echo "</div>";
					for($i = 0,$costo = 0;$i < count($vet_id);$i++){
						$sql = "select idprodotto,path_fotoprod,nomeprodotto,prezzo,quantita from prodotto join carrello on idprodotto = fk_prodotto where idprodotto = '{$vet_id[$i]}'";
						$qry = mysqli_query($conn, $sql);
						$record = mysqli_fetch_assoc($qry);
						echo "<div class='container_art'>";
						echo "<div class = '{$record['idprodotto']}'>";
						echo "<img class='foto_prod_carr' src='{$record['path_fotoprod']}'>";
						echo "   ";
						$id_prezzo = $record["idprodotto"]." ".$record["prezzo"]." ".$record["quantita"];
						echo "<button id='$id_prezzo' class='btn_prod_carrello'>elimina dal carrello</button>";
						$prezzo_prod = $record["prezzo"];
						echo "<div class = 'prod_prezzo'>";
						echo "nome del prodotto: ".$record["nomeprodotto"];
						echo "<p id = '$prezzo_prod' class='prezzo'>prezzo: $prezzo_prod €</p>";
						echo "numero di articoli: ".$vet_quantita[$i];
						echo "<br>";
						echo "</div>";
						echo "</div>";
						echo "</div>";
					}
					echo "<div>";
					echo "<input type='hidden' class='stato_carrello_hidden' id='pieno'>";
					echo "<div class='nessun_articolo_div_nella_pag'>";
					echo "<div class='titolo'><h1>il tuo carrello e' vuoto!<h1></div>";
					echo "<a href='compra.php'><button class='nessun_articolo_acquista'>acquista</button></a>";	
					echo "</div>";
					echo "</div>";
				}
				else{
					echo "<div class='nessun_articolo_div'>";
					echo "<div class='titolo'><h1>il tuo carrello e' vuoto!<h1></div>";
					echo "<a href='compra.php'><button class='nessun_articolo_acquista'>acquista</button></a>";	
					echo "</div>";
					echo "<input type='hidden' class='stato_carrello_hidden' id='vuoto'>";
				}
				echo "</div>";
			}
			else if(isset($_REQUEST["ordini"])) {//apre la pagina contenente i prodotti ordinati
				$id = $_SESSION["id"];
				$sql = "select nomeprodotto,prezzo,data_acquisto,quantita from prodotto join prodotti_ordinati on idprodotto = fk_prodotto where fk_utente = $id order by data_acquisto";
				$qry = mysqli_query($conn, $sql);
				if(mysqli_num_rows($qry)){
					echo "<div class='titolo'><h1>i tuoi ordini<h1></div>";
					for($i = 0; $i<3; $i++){
						echo "<br>";
					}					
					echo "<table class='tabella_ordini'>";
					echo "<tr>";
					echo "<td class='nome_prod_grass'>nome prodotto</td>";
					echo "<td class='prezzo_grass'>prezzo</td>";
					echo "<td class='data_acquisto_grass'>data di acquisto</td>";
					echo "<td class='quantita_grass'>numero articoli</td>";
					echo "</tr>";
					while ($record = mysqli_fetch_assoc($qry)) {
						echo "<tr>";
						echo "<td>{$record["nomeprodotto"]}</td>";
						echo "<td>{$record["prezzo"]} €</td>";
						echo "<td>{$record["data_acquisto"]}</td>";
						echo "<td>{$record['quantita']}</td>";
						echo "</tr>";
					}
					echo "</table>";					
				}
				else {
					echo "<div class='titolo'><h1>non hai ancora fatto acquisti!<h1></div>";
					echo "<a href='compra.php'><button class='nessun_articolo_acquista'>acquista</button></a>";
				}
			}
			else if(isset($_REQUEST["cerca"])){//genera la pagina con i risultati
				$ricerca = $_REQUEST["cerca"];
				$sql = "select idprodotto, nomeprodotto, path_fotoprod, descrizione_prod from prodotto where nomeprodotto like '%$ricerca%'
				UNION select idprodotto, nomeprodotto, path_fotoprod, descrizione_prod from prodotto join tipo_prodotto on idtipo_prodotto = fk_tipo_prodotto where tipo_prodotto like '%$ricerca%' UNION select idprodotto, nomeprodotto, path_fotoprod, descrizione_prod from prodotto join tipo_prodotto on idtipo_prodotto = fk_tipo_prodotto join categoria on idcategoria = fk_categoria where categoria like '%$ricerca%' UNION select idprodotto, nomeprodotto, path_fotoprod, descrizione_prod from prodotto join tipo_prodotto on idtipo_prodotto = fk_tipo_prodotto join categoria on idcategoria = fk_categoria join macrocategoria on idmacrocategoria = fk_macrocategoria where macrocategoria like '%$ricerca%'";
				$qry = mysqli_query($conn, $sql);
				if(mysqli_num_rows($qry)){
					echo "<div class='titolo'><h1>risultati per: $ricerca<h1></div>"; 
					echo "<div>";
					for($i = 0; $i<4; $i++){//GENERA SPAZIO TRA IL TITOLO E IL PRIMO ARTICOLO
						echo "<br>";
					}
					echo "</div>";
					while ($record = mysqli_fetch_assoc($qry)) {
						echo "<div class = 'container_prod'>";
						echo "<div class='nome_prod_idmacrocategoria'>";
						echo "</div>";
						echo "<a href='compra.php?prodotto={$record['idprodotto']}'><img class='foto_prod' src = '{$record['path_fotoprod']}'></a>";
						echo "<div class = 'descrizione_div'>";
						echo "<a class='nome_prod' href='compra.php?prodotto={$record['idprodotto']}'>{$record['nomeprodotto']}</a>";
						echo "<br>";
						echo "<p class='descrizione'>{$record["descrizione_prod"]}</p>";
						echo "</div>";
						echo "</div>";
					for($i = 0; $i<5; $i++){//GENERA SPAZIO TRA UN ARTICOLO E UN ALTRO
						echo "<br>";
					}
					echo "<hr />";
					for($i = 0; $i<5; $i++){//GENERA SPAZIO TRA UN ARTICOLO E UN ALTRO
						echo "<br>";
					}
					}					
				}	
				else{
					echo "<div class='titolo'><h1>non abbiamo trovato nessun risultato :(<h1></div>";
				}
			}
			else if(isset($_REQUEST["ordine_effettuato"])){
				echo "<div class='nessun_articolo_div'>";
				echo "<div class='titolo'><h1>ordine effettuato!<h1></div>";
				echo "<a href='compra.php?ordini'><button class='nessun_articolo_acquista'>i tuoi ordini</button></a>";	
				echo "</div>";
			}
			/*else if(isset($_REQUEST["vet_da_passare"])){//GENERA GLI ELEMENTI COME ERANO IN PRECEDENZA
				if(isset($_SESSION["user"])){
					echo "<div class='titolo'><h1>benvenuto {$_SESSION["user"]}<h1></div>";
				}
				else echo "<div class='titolo'><h1>benvenuto <h1></div>";
				$vet_id_da_caricare = array();
				$vet_id_da_caricare = $_REQUEST["vet_da_passare"];
				for($i = 0; $i<count($vet_id_da_caricare); $i++){
					$sql = "select idprodotto, nomeprodotto, path_fotoprod, descrizione_prod from prodotto where nomeprodotto = '$vet_id_da_caricare[$i]'";
				$qry = mysqli_query($conn, $sql);
				for($i = 0; $i<4; $i++){//GENERA SPAZIO TRA IL TITOLO E IL PRIMO ARTICOLO
					echo "<br>";
				}
				$record = mysqli_fetch_assoc($qry));
				echo "<div>";
				echo "<div class='prodotto'>";
				echo "<a class='nome_prod' href='compra.php?prodotto={$record['idprodotto']}'>{$record['nomeprodotto']}</a>";
				echo "<br>";
				echo "</div>";
				echo "<a href='compra.php?prodotto={$record['idprodotto']}'><img class='foto_prod' src='{$record['path_fotoprod']}'></a>";
				echo "<div class = 'descrizione'>{$record["descrizione_prod"]}</div>";
				echo "</div>";
				for($i = 0; $i<13; $i++){
					echo "<br>";
				}
				}
				*/
			else{//GENERA IN MODO CASUALE GLI ELEMENTI DELLA PAGINA AL PRIMO ACCESSO
				if(isset($_SESSION["user"])){
					echo "<div class='titolo'><h1>benvenuto {$_SESSION["user"]}<h1></div>";
				}
				else echo "<div class='titolo'><h1>benvenuto <h1></div>";
				$num_usciti = array();
				$sql = "select count(idprodotto) as num_prod from prodotto";
				$qry = mysqli_query($conn, $sql);
				$record = mysqli_fetch_assoc($qry);
				for ($j=1; $j < $record["num_prod"];) {
					for($non_valido = 0; $non_valido === 0;){
						$sql = "select count(idprodotto) as num_prod from prodotto";
						$qry = mysqli_query($conn, $sql);
						$record = mysqli_fetch_assoc($qry);
						$id = random_int(1, $record["num_prod"]);
						$num_elem = count($num_usciti);
						for($i = 0; $i < $num_elem; $i++){
						if($id === $num_usciti[$i]){
							$non_valido = 1;
						}
					}
					if($non_valido === 0){
						$sql = "select path_fotoprod,nomeprodotto,idprodotto,descrizione_prod from prodotto where idprodotto = '$id' ";
					$qry = mysqli_query($conn, $sql); 
					echo "<div>";
					for($i = 0; $i<4; $i++){//GENERA SPAZIO TRA IL TITOLO E IL PRIMO ARTICOLO
						echo "<br>";
					}
				echo "</div>";
				$record = mysqli_fetch_assoc($qry);
				echo "<div class = 'container_prod'>";
				echo "<div class='nome_prod_idmacrocategoria'>";
				echo "</div>";
				echo "<a href='compra.php?prodotto={$record['idprodotto']}'><img class='foto_prod' src = '{$record['path_fotoprod']}'></a>";
				echo "<div class = 'descrizione_div'>";
				echo "<a class='nome_prod' href='compra.php?prodotto={$record['idprodotto']}'>{$record['nomeprodotto']}</a>";
				echo "<br>";
				echo "<p class='descrizione'>{$record["descrizione_prod"]}</p>";
				echo "</div>";
				echo "</div>";
					for($i = 0; $i<5; $i++){//GENERA SPAZIO TRA UN ARTICOLO E UN ALTRO
						echo "<br>";
					}
					echo "<hr />";
					for($i = 0; $i<5; $i++){//GENERA SPAZIO TRA UN ARTICOLO E UN ALTRO
						echo "<br>";
					}
				$num_usciti[$num_elem] = $id;
				echo "<input id = $num_usciti[$num_elem] class='$j' type='hidden'>";
				$num_elem++;
				$j++;
				}
			}
			$num_elem = count($num_elem);
			/*echo "<input id = '$num_elem' class='num_elem' type='hidden'>";
			echo "<input id = '1' class='random' type='hidden'>";*/
		}
		}
	}

		function gestisci_accesso(){//gestisce login-logout --> session
			include "../connessione.php";
			if(!isset($_SESSION["user"])){
				echo "<div class='accedi'>";
				echo "<li><a href='../login/login.php'>accedi</a>";
				echo "</div";
			}
			else{
				echo "<div class='user'>";
				echo "<li class='nome_utente'><a class='utente' href='#'>{$_SESSION['user']}</a>";
				echo "<ul>";
				echo "<li><a class='tendina_utente' href='compra.php?carrello'>carrello</a></li>";
				echo "<li><a class='tendina_utente' href='compra.php?ordini'>i miei ordini</a></li>";
				echo "<li><a class='tendina_utente' href='../login/logout.php'>esci dal profilo</a></li>";
				echo "</ul>";
				echo "</li>";
				echo "</div";
			}
		}

		function carica_categorie($num){ //carica la tendina delle categorie nella nav bar
			include "../connessione.php";
			$sql = "select idcategoria,categoria from categoria where fk_macrocategoria = '$num'";
			$qry = mysqli_query($conn, $sql);
			while ($record = mysqli_fetch_assoc($qry)) {
				echo "<li><a class='tendina_sottocategorie' href='compra.php?idcategoria={$record['idcategoria']}'>{$record['categoria']}</a></li>";
			}
		}
		function genera_pagina(){ 	
			echo "<div id='drop-menu'>";
			echo '<ul id="menu">';
				echo '<div class="maiuscolo">';
				echo '<li><a class="categorie" href="../index.php">Home</a>';
				echo '<li><a class="categorie" href="#">Categorie</a>';
					echo '<ul>';
						echo '<li>';
							echo '<a class="tendina_categorie" href="compra.php?idmacrocategoria=1">ELETTRONICA</a>';
							echo '<ul>';
								carica_categorie(1);
							echo '</ul>';
						echo '</li>';
						echo '<li>';
							echo '<a class="tendina_categorie" href="compra.php?idmacrocategoria=3">TELEFONIA</a>';
							echo '<ul>';
								carica_categorie(3);
							echo '</ul>';
						echo '</li>';
						echo '<li>';
							echo '<a class="tendina_categorie" href="compra.php?idmacrocategoria=2">GAMING</a>';
							echo '<ul>';
								carica_categorie(2);
							echo '</ul>';
						echo '</li>';
					echo '</ul>';
				echo '</li>';
			    echo '</div>';
			    echo '<div class="barra_ric">';
			    	echo '<form name="cerca" method="post" action="compra.php">';
			    		echo '<input autocomplete = "off" type="text" placeholder="cerca un prodotto, marca o categoria" name="cerca" class="cerca">';
						echo '<input type="submit" class="cerca_btn" value="cerca">';
					echo '</form>';
			    echo '</div>';
			    gestisci_accesso();
			echo '</ul>';
		echo '</div>';
		genera_contenuti();
		}
		?>
	</head>
	<body>
		<?php
		genera_pagina();
		?>
	</body>
	<script src="../../libjq.js"></script>
    <script>
    	$(".nessun_articolo_div_nella_pag").hide();
    	$("#tendina").hide();
    	$(document).ready(prepara_pagina);

    	function prepara_pagina(){
    		gestisci_eventi();
    	}

    	function gestisci_eventi(){
    		$(".acquista").click(vedi_tendina);
    		//$(".cattura_click_sulla_pag").click(nascondi_tendina);
    		$(".btn_prod_carrello").click(elimina);
    		$(".btn_aggiungi").click(controlla_presente);
    		$(".conferma_acquisto").click(acquista);
    		$(".cerca_btn").click(controlla);
    		//$("quando premo indietro").click(mantieni_ordine);
    	}

    	function controlla(){
    		if($(".cerca").val() === ""){
    			alert("compilare il campo");
    			return false;
    		}
    	}

		function vedi_tendina(){
			$("#tendina").show();
		}

		/*function nascondi_tendina(){
			$("#tendina").hide();
		}*/

    	function elimina(){
    		if(confirm("vuoi eliminare veramente l'articolo?")){
    			id_costo = $(this).attr("id");
    			idprod_costo_quantita_arr = id_costo.split(" ");
    			id_prod = idprod_costo_quantita_arr[0];
    			prezzo_prod_elim = idprod_costo_quantita_arr[1]; 
    			quantita = idprod_costo_quantita_arr[2];
    			prezzo_prod_elim = prezzo_prod_elim * quantita;
    	    	$("."+id_prod).hide();
    	    	costo_elim = $(".costo_carr").attr("id");
    	    	id_utente = $(".acquista").attr("id");
    	    	$.get("comprajax.php",{id_prod:id_prod,id_utente:id_utente,costo_elim:costo_elim,prezzo_prod_elim:prezzo_prod_elim},reimposta_prezzo_cback);
    		}
    	}

    	function reimposta_prezzo_cback(nuovo_costo){
    		if(nuovo_costo !== '0'){
    			$(".costo_carr").attr("id",nuovo_costo);
				$(".costo_carr").load("comprajax.php",{nuovo_costo:nuovo_costo});
			}
			else{
				$(".ultimo_articolo_eliminato").hide();
				$(".nessun_articolo_div_nella_pag").show();
				//$(".titolo").css("position","absolute").css("z-index",1).css("margin-left",530).css("margin-top",0);
				$("#carr").hide();
			}
    	}

    	function controlla_presente(){
    		id_prod = $(this).attr("id");
    		presente = $(".presente").attr("id");
    		if(presente === 'true'){
    			id_utente = $(".id_utente").attr("id");
    			id_prodotto = $(this).attr("id");
    			$.get("comprajax.php",{id_prodotto:id_prodotto,id_utente:id_utente},presente_cback);
    		}
    		else {
    			window.location.replace("../login/login.php?bisogna_accedere=1&id_prod="+id_prod);
    		}
    	}

    	function presente_cback(presente){
    		risposta = presente.split(" ");
    		presente = risposta[0];
    		id_prodotto_agg = risposta[1];
    		if(presente === '1'){
    			id_utente = $(".id_utente").attr("id");
    			if(confirm("questo articolo è già presente nel carrello, aggiungere comunque?")){
    				$.get("comprajax.php",{id_prodotto_agg:id_prodotto_agg,id_utente:id_utente})
    			}
    		}
    		else if(presente === '0'){
    			alert("articolo aggiunto nel carrello");
    		}
    		else alert("gli articoli sono finiti!");
		}

    	function acquista(){
        if($(".caselle_conferma_acquisto_txt_1").val() !== "" && $(".caselle_conferma_acquisto_txt_2").val() !== ""){
    		trasforma_orario();
    		id_acquirente = $(this).attr("id");
    		casella_indirizzo = $(".caselle_conferma_acquisto_txt_1").val();
    		casella_fatturazione = $(".caselle_conferma_acquisto_txt_2").val();
    		$.get("comprajax.php",{id_acquirente:id_acquirente,anno:anno,mese:mese,giorno_inlettere:giorno_inlettere,giorno_innumero:giorno_innumero,ora:ora,minuti:minuti,casella_indirizzo:casella_indirizzo,casella_fatturazione:casella_fatturazione},acquista_cback);
        }
        else 
        	alert("inserisci tutti i campi");
        	return false;
    	}
        
        function acquista_cback() {
        	$("#tendina").hide();
            window.location.replace("compra.php?ordine_effettuato");	
        }

    	function mantieni_ordine(){
    		if($(".random").attr("id") === '1'){
    			vet_da_passare = [];
				num_elem = $(".num_elem").attr("id");
				for(i = 0; i<num_elem; i++){
					vet = $("."+i).attr("id");
					vet_da_passare[i] = vet;
				}
				window.location.replace("prova3.php?vet="+vet_da_passare);
    		}
    	}

    	function trasforma_orario(){
    		data = new Date();
			ora = data.getHours();
			minuti= data.getMinutes();
			secondi= data.getSeconds();
			giorno_inlettere = data.getDay();
			giorno_innumero = data.getDate();
			mese = data.getMonth();
			anno= data.getFullYear();

			if(minuti < 10) minuti="0"+minuti;
			if(secondi < 10) secondi="0"+secondi;
			if(ora <10) ora="0"+ora;
			
			if(giorno_inlettere == 0) giorno_inlettere = "Domenica";
			if(giorno_inlettere == 1) giorno_inlettere = "Lunedi";
			if(giorno_inlettere == 2) giorno_inlettere = "Martedi";
			if(giorno_inlettere == 3) giorno_inlettere = "Mercoledi";
			if(giorno_inlettere == 4) giorno_inlettere = "Giovedi";
			if(giorno_inlettere == 5) giorno_inlettere = "Venerdi";
			if(giorno_inlettere == 6) giorno_inlettere = "Sabato";

			if(mese == 0) mese = "Gennaio";
			if(mese == 1) mese = "Febbraio";
			if(mese == 2) mese = "Marzo";
			if(mese == 3) mese = "Aprile";
			if(mese == 4) mese = "Maggio";
			if(mese == 5) mese = "Giugno";
			if(mese == 6) mese = "Luglio";
			if(mese == 7) mese = "Agosto";
			if(mese == 8) mese = "Settembre";
			if(mese == 9) mese = "Ottobre";
			if(mese == 10) mese = "Novembre";
			if(mese == 11) mese = "Dicembre";
    	}
    </script>
</html>