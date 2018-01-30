<?php

$username = "morgguilherme1";
$key = "5fe0e4c8673fe9c3eb02c44e2d86c3e3";
$token = "af9e04c47896d2dd334d02aaefbc8eb036a6dde68a4ee62b019c3096df128f8f";
$memberId = "5a19fcddcbe756c65ebfad3a";
$nomeList = "New Bugs";
$boardid = "5a6fe2bab807ebd4c180b119";

$curl = curl_init();

curl_setopt($curl, CURLOPT_URL, "https://api.trello.com/1/boards/".$boardid."/lists"."?key=".$key."&token=".$token);

//peço a curl que devolva os dados em um string, ao invés de mostrá-los na tela
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

$resposta = curl_exec($curl);

//echo $resposta;

$myArray = json_decode($resposta, true);

$count = count($myArray);
$ArrayList = [];

$verificar = 1;


for ($i=0; $i<$count; $i++) { 
     
     $j = (String)$i;

     $ArrayList['i'] = $myArray[$j]['id'];
     
     echo $ArrayList['i']."\n"."/";
    
    if($ArrayList['i'] == $nomeList ){
        $verificar = 2;
        
    }
}

// if, se 1, Board não encontrada, if, se 2, board encontrada

print $verificar;

curl_close($curl);

// resposta 5a6fea423c6cb472c207f8b4


?>