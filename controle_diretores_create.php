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
        $objJson = json_decode($textoRecebido) or die('{"msg": "formato incorreto"}');
        $obj = new stdClass();
        $objDiretor = new Diretores();
        $objDiretor->setIdDiretores($objJson->diretor->idDiretores);
        $objDiretor->setNomeDiretores($objJson->diretor->NomeDiretores);
        $objDiretor->setSenha($objJson->diretor->Senha);
        $objDiretor->setEmail($objJson->diretor->Email);
        $objDiretor->setProjetos($objJson->diretor->Projetos);
        if ($objDiretor->getNomeDiretores() == ""){
            $obj->cod = 1;
            $obj->status = false;
            $obj->msg = "o Diretor não pode ser vazio";
        }else if(strlen($objDiretor->getNomeDiretores()) < 3){
            $obj->cod = 2;
            $obj->status = false;
            $obj->msg = "o Diretor não pode ter menos que três caracteres";
        }else if ($objDiretor->isDiretores() == true){
            $obj->cod = 3;
            $obj->status = false;
            $obj->msg = "esse Diretor já existe";
        }else{
            if ($objDiretor->create() == true){
                $obj->cod = 4;
                $obj->status = true;
                $obj->msg = "Diretor cadastrado com sucesso";
                $obj->novoDiretor = $objDiretor;
            }else{
                $obj->cod = 5;
                $obj->status = false;
                $obj->msg = "Erro ao cadastrar novo Diretor";
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