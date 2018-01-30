<?php

$username = "morgguilherme1";
$key = "5fe0e4c8673fe9c3eb02c44e2d86c3e3";
$token = "af9e04c47896d2dd334d02aaefbc8eb036a6dde68a4ee62b019c3096df128f8f";
$memberId = "5a19fcddcbe756c65ebfad3a";
$nomeBoard = "Gamer Trials Bugs";
$descBoard = "Bugs do seu jogo na plataforma Gamer Trials";
$nomeList = "New Bugs";
$nomeJogo = "Jogo teste";
$desc = "Teste da descrição do BUG";

$idNewBoard = "";
$idNewList = "";
$idBoardExistente = "";
$idListExistente = "";





/* ----------------------------------- MEMBER ID------------------------------------------------------ */


$curl = curl_init();

curl_setopt($curl, CURLOPT_URL, "https://api.trello.com/1/tokens/".$token."?key=".$key."&token=".$token);

//peço a curl que devolva os dados em um string, ao invés de mostrá-los na tela
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

$resposta = curl_exec($curl);

//echo $resposta;

$obj = json_decode($resposta);
$idmember = $obj->{'idMember'}; 

//print $idmember;

// Resposta 5a19fcddcbe756c65ebfad3a ; 


/* -----------------------------Verificando se a Board já existe ------------------------------------------------------------ */

curl_setopt($curl, CURLOPT_URL, "https://api.trello.com/1/members/".$memberId."/boards"."?key=".$key."&token=".$token);

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

     $ArrayList['i'] = $myArray[$j]['name'];
     
    // echo $ArrayList['i']."\n"."/";
    
    if($ArrayList['i'] == $nomeBoard ){
        $verificar = 2;
        $idBoardExistente = $myArray[$j]['id'];
        
    }
}

// if, se 1, Board não encontrada, if, se 2, board encontrada


/* ------------------------------Se BOARD não existir, criar uma nova----------------------------------------------------------- */



if ($verificar == 1){

    curl_setopt($curl, CURLOPT_URL, "https://api.trello.com/1/boards/"/*?name=".$titulo."&desc=".$desc."&key=".$key."&token=".$token*/);

    //peço a curl que devolva os dados em um string, ao invés de mostrá-los na tela
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS,"name=".$nomeBoard."&desc=".$descBoard."&token=".$token."&key=".$key);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $resposta = curl_exec($curl);

    //echo $resposta;

    $obj = json_decode($resposta);
    $idNewBoard = $obj->{'id'}; 

    /* -----------------------------------------------------------------------Nova Lista ----------------------------------------- */

    curl_setopt($curl, CURLOPT_URL, "https://api.trello.com/1/lists"/*?name=".$titulo."&desc=".$desc."&key=".$key."&token=".$token*/);

    //peço a curl que devolva os dados em um string, ao invés de mostrá-los na tela
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS,"name=".$nomeList."&idBoard=".$idNewBoard."&token=".$token."&key=".$key);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $resposta = curl_exec($curl);

    //echo $resposta;

    $obj = json_decode($resposta);
    $idNewList =  $obj->{'id'}; 

     /* -----------------------------------------------------------------Novo Card ------------------------------------------ */

     curl_setopt($curl, CURLOPT_URL, "https://api.trello.com/1/cards");

     curl_setopt($curl, CURLOPT_POST, 1);
     curl_setopt($curl, CURLOPT_POSTFIELDS,"name=".$nomeJogo."&desc=".$desc."&idList=".$idNewList."&token=".$token."&key=".$key);
     curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
     
     $resposta = curl_exec($curl);
     
     //echo $resposta;
     
     $obj = json_decode($resposta);
     print $obj->{'name'}; 

     /* ------------------------------------------------------------ Terminou Nova Board / Nova Lista / Novo Card --------------------- */
     
}else{
    if ($verificar == 2) {

        /* ------------------------------------------------ Verificando se a List já existe ------------------------- */

        curl_setopt($curl, CURLOPT_URL, "https://api.trello.com/1/boards/".$idBoardExistente."/lists"."?key=".$key."&token=".$token);

        //peço a curl que devolva os dados em um string, ao invés de mostrá-los na tela
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $resposta = curl_exec($curl);

        //echo $resposta;

        $myArray = json_decode($resposta, true);

        $count = count($myArray);
        $ArrayList = [];

        $verificarList = 1;


        for ($i=0; $i<$count; $i++) { 
     
            $j = (String)$i;

            $ArrayList['i'] = $myArray[$j]['name'];
     
            //echo $ArrayList['i']."\n"."/";
    
            if($ArrayList['i'] == $nomeList ){
                $verificarList = 2;
                $idListExistente = $myArray[$j]['id'];
                
            }
        }

        if ($verificarList == 1) {
            
            /* ------------------------------------------------ Criando nova lista ---------------------------------------- */
            curl_setopt($curl, CURLOPT_URL, "https://api.trello.com/1/lists"/*?name=".$titulo."&desc=".$desc."&key=".$key."&token=".$token*/);

            //peço a curl que devolva os dados em um string, ao invés de mostrá-los na tela
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS,"name=".$nomeList."&idBoard=".$idBoardExistente."&token=".$token."&key=".$key);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    
            $resposta = curl_exec($curl);
    
            //echo $resposta;
    
            $obj = json_decode($resposta);
            $idNewList =  $obj->{'id'};  

            /* --------------------------------------------------- Criando novo Card com ID Nova Lista ---------------------------------- */

            curl_setopt($curl, CURLOPT_URL, "https://api.trello.com/1/cards");

            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS,"name=".$nomeJogo."&desc=".$desc."&idList=".$idNewList."&token=".$token."&key=".$key);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
     
            $resposta = curl_exec($curl);
     
            //echo $resposta;
     
            $obj = json_decode($resposta);
            print $obj->{'name'}; 


        }else{

        /* --------------------------------------------------- Criando novo Card com ID Da lista Existente ---------------------------------- */
            curl_setopt($curl, CURLOPT_URL, "https://api.trello.com/1/cards");

            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS,"name=".$nomeJogo."&desc=".$desc."&idList=".$idListExistente."&token=".$token."&key=".$key);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
     
            $resposta = curl_exec($curl);
     
            //echo $resposta;
     
            $obj = json_decode($resposta);
            print $obj->{'name'}; 

        }


    }
}





curl_close($curl);



?>
