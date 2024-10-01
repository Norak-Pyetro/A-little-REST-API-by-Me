<?php
    require_once ("modelo/Banco.php");

    class Diretores implements JsonSerializable{
        private $idDiretores;
        private $NomeDiretores;
        private $Projetos;
        private $Email;
        private $Senha;
        public function jsonSerialize()
        {
            $objResposta = new stdClass();
            $objResposta->idDiretores = $this->idDiretores;
            $objResposta->NomeDiretores = $this->NomeDiretores;
            $objResposta->Projetos = $this->Projetos;
            $objResposta->Email = $this->Email;
            $objResposta->Senha = $this->Senha;
            return ($objResposta);
        }
        public function create()
        {
            $conexao = Banco::getConexao();
            $SQL = "INSERT INTO Diretores (idDiretores, NomeDiretores, Projetos, Email, Senha) VALUES (?, ? , ?, ?, md5(?));";
            $prepareSQL = $conexao->prepare($SQL);
            $prepareSQL->bind_param("issss", $this->idDiretores, $this->NomeDiretores, $this->Projetos, $this->Email, $this->Senha);
            $executou = $prepareSQL->execute();
            $idCadastrado = $conexao->insert_id;
            $this->setIdDiretores($idCadastrado);
            return $executou;
        }
        public function delete()
        {
            $conexao = Banco::getConexao();
            $SQL = "DELETE FROM Diretores WHERE idDiretores=?;";
            $prepareSQL = $conexao->prepare($SQL);
            $prepareSQL->bind_param("i", $this->idDiretores);
            return $prepareSQL->execute();
        }
        public function update()
        {
            $conexao = Banco::getConexao();
            $SQL = "UPDATE Diretores set NomeDiretores = ?, Projetos = ?, Email = ?, Senha = MD5(?) where idDiretores=?;";
            $prepareSQL = $conexao->prepare($SQL);
            $prepareSQL->bind_param("ssssi", $this->NomeDiretores, $this->Projetos, $this->Email, $this->Senha, $this->idDiretores);
            $executou = $prepareSQL->execute();
            return $executou;
        }
        public function isDiretores()
        {
            $conexao = Banco::getConexao();
            $SQL = "SELECT COUNT(*) AS qtd  FROM Diretores WHERE NomeDiretores = ?;";
            $prepareSQL = $conexao->prepare($SQL);
            $prepareSQL->bind_param("s", $this->NomeDiretores);
            $executou = $prepareSQL->execute();
            $matrizTuplas = $prepareSQL->get_result();
            $objTupla = $matrizTuplas->fetch_object();
            return $objTupla->qtd > 0;
        }
        public function readALL()
        {
            $conexao = Banco::getConexao();
            $SQL = "SELECT * FROM Diretores ORDER BY NomeDiretores;";
            $prepareSQL = $conexao->prepare($SQL);
            $executou = $prepareSQL->execute();
            $matrizTuplas = $prepareSQL->get_result();
            $vetorDiretores = array();
            $i = 0;
            while ($tupla = $matrizTuplas->fetch_object()){
                $vetorDiretores[$i] = new Diretores;
                $vetorDiretores[$i]->setIdDiretores($tupla->idDiretores);
                $vetorDiretores[$i]->setNomeDiretores($tupla->NomeDiretores);
                $vetorDiretores[$i]->setProjetos($tupla->Projetos);
                $vetorDiretores[$i]->setEmail($tupla->Email);
                $vetorDiretores[$i]->setSenha($tupla->Senha);
                $i++;
            }
            return $vetorDiretores;
        }
        public function readById(){
            $conexao = Banco::getConexao();
            $SQL = "SELECT * FROM Diretores WHERE idDiretores = ?;";
            $prepareSQL = $conexao->prepare($SQL);
            $prepareSQL->bind_param("i", $this->idDiretores);
            $executou = $prepareSQL->execute();
            $matrizTuplas = $prepareSQL->get_result();
            $vetorDiretores = array();
            $i = 0;
            while ($tupla = $matrizTuplas->fetch_object()){
                $vetorDiretores[$i] = new Diretores;
                $vetorDiretores[$i]->setIdDiretores($tupla->idDiretores);
                $vetorDiretores[$i]->setNomeDiretores($tupla->NomeDiretores);
                $vetorDiretores[$i]->setProjetos($tupla->Projetos);
                $vetorDiretores[$i]->setEmail($tupla->Email);
                $vetorDiretores[$i]->setSenha($tupla->Senha);
                $i++;
            }
            return $vetorDiretores;
        }
        public function verificarUsuarioSenha(){
            $conexao = Banco::getConexao();
            $SQL = "SELECT COUNT(*) AS qtd, idDiretores, NomeDiretores, Email FROM Diretores WHERE Email = ? AND Senha = MD5(?);";
            $prepareSQL = $conexao->prepare($SQL);
            $prepareSQL->bind_param("ss", $this->Email, $this->Senha);
            $prepareSQL->execute();
            $matrizTuplas = $prepareSQL->get_result();
            while ($tupla = $matrizTuplas->fetch_object()){
                if($tupla->qtd == 1){
                    $this->setIdDiretores($tupla->idDiretores);
                    $this->setNomeDiretores($tupla ->NomeDiretores);
                    $this->setEmail($tupla->Email);
                    return true;
                }
            }
            return false;
        }
        public function getIdDiretores()
        {
            return $this->idDiretores;
        }
        public function setIdDiretores($idDiretores)
        {
            $this->idDiretores = $idDiretores;
            return $this;
        }
        public function getNomeDiretores()
        {
            return $this->NomeDiretores;
        }
        public function setNomeDiretores($NomeDiretores)
        {
            $this->NomeDiretores = $NomeDiretores;
            return $this;
        }
        public function getEmail()
        {
            return $this->Email;
        }
        public function setEmail($Email)
        {
            $this->Email = $Email;
            return $this;
        }
        public function getSenha()
        {
            return $this->Senha;
        }
        public function setSenha($Senha)
        {
            $this->Senha = $Senha;
            return $this;
        }
        public function getProjetos()
        {
            return $this->Projetos;
        }
        public function setProjetos($Projetos)
        {
            $this->Projetos = $Projetos;
            return $this;
        }
    }
   
?>