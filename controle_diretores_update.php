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
        $textoRecebido = file_get_contents("php://input");
        $objJson = json_decode($textoRecebido) or die('{"msg":"formato incorreto"}');

        $obj = new stdClass();
        $objDiretores = new Diretores();
        $objDiretores->setIdDiretores($idDiretores);
        $objDiretores->setNomeDiretores($objJson->diretor->NomeDiretores);
        $objDiretores->setProjetos($objJson->diretor->Projetos);
        $objDiretores->setEmail($objJson->diretor->Email);
        $objDiretores->setSenha($objJson->diretor->Senha);
        if ($objDiretores->getNomeDiretores() == ""){
            $obj->cod = 1;
            $obj->status = false;
            $obj->msg = "O campo não pode estar vazio";
            //$obj->token = $meuToken->gerarToken($payloadRecuperado);
        }else if (strlen($objDiretores->getNomeDiretores()) < 3){
            $obj->cod = 2;
            $obj->status = false;
            $obj->msg = "O que foi digitado não poder ser menor que três caracteres";
            //$obj->token = $meuToken->gerarToken($payloadRecuperado);
        }else if ($objDiretores->isDiretores() == true){
            $obj->cod = 3;
            $obj->status = false;
            $obj->msg = "O que foi digitado já existe";
            //$obj->token = $meuToken->gerarToken($payloadRecuperado);
        }else{
            if ($objDiretores->update() == true){
                $obj->cod = 4;
                $obj->status = true;
                $obj->msg = "Atualizado com sucesso";
                //$obj->token = $meuToken->gerarToken($payloadRecuperado);
            }else{
                $obj->cod = 5;
                $obj->status = false;
                $obj->msg = "Erro ao atualizar nome do Diretor";
                //$obj->token = $meuToken->gerarToken($payloadRecuperado);
            }
        }
        echo json_encode($obj);
    //}else{
        //header ("HTTP/1.1 401");
        //$obj->cod = 2;
        //$obj->status = false;
        //$obj->msg = "Token Inválido";
    //}

    //return;
?>