


<?php

$idList = "5a6fea423c6cb472c207f8b4";
$key = "5fe0e4c8673fe9c3eb02c44e2d86c3e3";
$token = "af9e04c47896d2dd334d02aaefbc8eb036a6dde68a4ee62b019c3096df128f8f";
$nomeJogo = "Jogo teste";
$desc = "Teste da descrição do BUG";
$curl = curl_init();
$idList = "5a6fea423c6cb472c207f8b4";

curl_setopt($curl, CURLOPT_URL, "https://api.trello.com/1/cards");

curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS,"name=".$nomeJogo."&desc=".$desc."&idList=".$idList."&token=".$token."&key=".$key);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$resposta = curl_exec($curl);

//echo $resposta;

$obj = json_decode($resposta);
print $obj->{'name'}; 


curl_close($curl);


/*

$curl = curl_init();

curl_setopt($curl, CURLOPT_URL, "https://api.trello.com/1/members/".$username."?key=".$key."&token=".$token);

//peço a curl que devolva os dados em um string, ao invés de mostrá-los na tela
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

$resposta = curl_exec($curl);

//echo $resposta;

$obj = json_decode($resposta);
print $obj->{'id'}; 


curl_close($curl);


*/



/*
    // create curl resource 
        $ch = curl_init(); 

        // set url 
        curl_setopt($ch, CURLOPT_URL, "example.com"); 

        //return the transfer as a string 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

        // $output contains the output string 
        $output = curl_exec($ch); 

        // close curl resource to free up system resources 
        curl_close($ch);  


*/

?>

