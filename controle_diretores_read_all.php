<?php
    //use Firebase\JWT\MeuTokenJWT;

    require_once ("modelo/Banco.php");
    require_once ("modelo/Diretores.php");
    //require_once ("modelo/MeuTokenJWT.php");
    
    //$headers = getallheaders();

    //$authorization = $headers ["Authorization"];

    //$meuToken = new MeuTokenJWT();

    //if($meuToken->validarToken($authorization) == true){
        //$payloadRecuperado = $meuToken->getPayload();
        $obj = new stdClass();
        $objDiretores = new Diretores();
        $vetor = $objDiretores->readALL();
        $obj->cod = 1;
        $obj->status = true;
        $obj->msg = "executado com sucesso";
        $obj->Diretores = $vetor;
        //$obj->token = $meuToken->gerarToken($payloadRecuperado);
        header ("HTTP/1.1 200");
        header ("Content-Type: application/json");
        echo json_encode($obj);
    //}else{
        //header ("HTTP/1.1 401");
        //$obj->cod = 2;
        //$obj->status = false;
        //$obj->msg = "Token Inválido";
    //}

    //return;

?>