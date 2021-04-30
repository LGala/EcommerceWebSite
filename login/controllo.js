	$(document).ready(genera_pag);

	function genera_pag(){
		$("#invia").click(controlla_val);
	}

	function controlla_val(){
		user = $("#user").val();
		pass = $("#pass").val();

		if(user === "" || pass === ""){
			alert("inserisci tutti i campi");
			return false;
		}
	}