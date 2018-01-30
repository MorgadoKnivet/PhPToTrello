<?php

$username = "morgguilherme1";
$key = "5fe0e4c8673fe9c3eb02c44e2d86c3e3";
$token = "af9e04c47896d2dd334d02aaefbc8eb036a6dde68a4ee62b019c3096df128f8f";

$curl = curl_init();

curl_setopt($curl, CURLOPT_URL, "https://api.trello.com/1/tokens/".$token."?key=".$key."&token=".$token);

//peço a curl que devolva os dados em um string, ao invés de mostrá-los na tela
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

$resposta = curl_exec($curl);

//echo $resposta;

$obj = json_decode($resposta);
print $obj->{'idMember'}; 


curl_close($curl);

// Resposta 5a19fcddcbe756c65ebfad3a ; 

?>
