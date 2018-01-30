<?php


$key = "5fe0e4c8673fe9c3eb02c44e2d86c3e3";
$token = "af9e04c47896d2dd334d02aaefbc8eb036a6dde68a4ee62b019c3096df128f8f";
$tituloList = "Bugs encontrados";
// ID BOARD // Resposta == 5a6fe2bab807ebd4c180b119

$curl = curl_init();

curl_setopt($curl, CURLOPT_URL, "https://api.trello.com/1/lists"/*?name=".$titulo."&desc=".$desc."&key=".$key."&token=".$token*/);

//peço a curl que devolva os dados em um string, ao invés de mostrá-los na tela
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS,"name=Gamer_Trials Bugs&idBoard=5a6fe2bab807ebd4c180b119&token=".$token."&key=".$key);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$resposta = curl_exec($curl);

//echo $resposta;

$obj = json_decode($resposta);
print $obj->{'id'}; 


curl_close($curl);

// resposta da new list 5a6fea423c6cb472c207f8b4


?>