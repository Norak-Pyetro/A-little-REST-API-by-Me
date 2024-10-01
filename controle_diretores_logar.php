<?php
    use Firebase\JWT\MeuTokenJWT;

    require_once ("modelo/Diretores.php");
    require_once ("modelo/MeuTokenJWT.php");

    $jsonRecebido = file_get_contents('php://input');
    $objJson = json_decode($jsonRecebido) or die('{"msg":"formato incorreto"}');
    $objJson = json_decode($jsonRecebido);
    $objDiretores = new Diretores();
    $obj = new stdClass();

    $objDiretores->setEmail($objJson->diretor->Email);
    $objDiretores->setSenha($objJson->diretor->Senha);

    if ($objDiretores->verificarUsuarioSenha() == true){
        $tokenJWT = new MeuTokenJWT();
        $objClaimsToken = new stdClass();

        $objClaimsToken->Email = $objDiretores->getEmail();
        $objClaimsToken->Nome = $objDiretores->getNomeDiretores();
        $objClaimsToken->idDiretores = $objDiretores->getIdDiretores();

        $novoToken = $tokenJWT->gerarToken($objClaimsToken);
        $obj->status = true;
        $obj->msg = "Login efetuado com sucesso | Login successful";
        $obj->token = $novoToken;
    }else{
        $obj->status = false;
        $obj->msg = "Login inválido";
    }

    header("Content-Type: application/json");

    if($obj->status == true){
        header("HTTP/1.1 201");
    }else{
        header("HTTP/1.1 200");
    }
    echo json_encode($obj);
?>