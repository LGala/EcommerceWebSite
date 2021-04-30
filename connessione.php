<?php
    $hostname = "localhost";
    $username = "emarket";
    $pswDB = ...; // SECRET
    $namedb = "my_emarket";
    
    @$conn = mysqli_connect($hostname,$username,$pswDB,$namedb) or die("Errore: ".mysqli_connect_error());
    mysqli_query($conn,"SET CHARACTER SET 'utf8'");
	mysqli_query($conn,"SET SESSION collation_connection ='utf8_unicode_ci'");
?>
