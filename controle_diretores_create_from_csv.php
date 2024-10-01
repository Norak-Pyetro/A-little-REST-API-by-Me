<?php
    require_once ("modelo/Diretores.php");

    $nomeArquivo = $_FILES["variavelArquivo"]["tmp_name"];

    $ponteiroArquivo = fopen($nomeArquivo, "r");

    $i = 0; 
    $Diretores = array();
    while(($linhaArquivo = fgetcsv($ponteiroArquivo, 1000, ";")) != false){
        $linhaArquivo = array_map("utf8_encode", $linhaArquivo);
        echo $linhaArquivo[0] . "<br>";
        if ($Diretores[$i]->create() == true) { $i++;}
    }
    $resposta = new stdClass();
    $resposta->status = true;
    $resposta->msg = "Diretores contratados com sucesso";
    $resposta->cadastrados = $Diretores;
    $resposta->totalDiretores = $i;
    echo json_encode($resposta);
?>