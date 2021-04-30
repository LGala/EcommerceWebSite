	$(document).ready(genera_pag);

	function genera_pag(){
		$("#invia").click(controllo);
	}

	function controllo(){
		lung = $("#pass").val().length;
		user = $("#user").val();
		password = $("#pass").val();
		contr_pass = $("#contr_pass").val();
		nuova_pass = $("#nuova_pass").val();

    	if(user=== "" || password=== "" || contr_pass=== "" || nuova_pass=== ""){
    		alert("inserisci tutti i campi"); return false;
    	}
    	else if(contr_pass !== nuova_pass){
    		alert("password non corrispondenti"); return false;
    	}
    	else if(lung < 8){
        	alert("la password deve essere composta da almeno 8 campi"); return false;
    	}
	}