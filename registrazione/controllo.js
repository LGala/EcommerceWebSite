	$(document).ready(pagina);

	function pagina(){
		$("#invia").click(controlla_carat);
	}

	function controlla_carat(){
		lung = $("#password").val().length;
		nome = $("#nome").val();
		cognome = $("#cognome").val();
		pass = $("#password").val();
		contr_password = $("#controlla_pass").val();
		email = $("#email").val();
		data = $("#data").val();

        if(nome===""||cognome===""||data===""||email===""||password===""||contr_password==="")
        {
                alert("inserisci tutti i campi"); return false;
        }
        else if(pass!==contr_password) {
            alert("password non corrispondenti"); return false;
        }
        else if(lung<8){
            alert("la password deve essere composta da almeno 8 caratteri"); return false;
        }
	}