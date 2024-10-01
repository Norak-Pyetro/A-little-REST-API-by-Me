<?php
    //use Firebase\JWT\MeuTokenJWT;

    require_once ("modelo/Diretores.php");
    //require_once ("modelo/MeuTokenJWT.php");

    //$headers = getallheaders();

    //$authorization = $headers ["Authorization"];

    //$meuToken = new MeuTokenJWT();

    //if($meuToken->validarToken($authorization) == true){
        //$payloadRecuperado = $meuToken->getPayload();
        $obj = new stdClass();
        $objDiretores = new Diretores();
        $objDiretores->setIdDiretores($idDiretores);
        if ($objDiretores->delete() == true){
            header ("HTTP/1.1 2O4");
            //$obj->token = $meuToken->gerarToken($payloadRecuperado);
        }else{
            header ("HTTP/1.1 200");
            header ("Content-Type: application/json");
            $obj->status = false;
            $obj->cod = 1;
            $obj->msg = "Erro ao excluir diretor";
            echo json_encode($obj);
            //$obj->token = $meuToken->gerarToken($payloadRecuperado);
        }
    //}else{
        //header ("HTTP/1.1 401");
        //$obj->cod = 2;
        //$obj->status = false;
        //$obj->msg = "Token Inválido";
    //}
    
    //return;
?>