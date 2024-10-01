<?php
    class Banco{
        private static $HOST = '127.0.0.1';
        private static $USER = 'root';
        private static $PWD = '';
        private static $DB = 'Riot_Games';
        private static $PORT = 3306;
        private static $CONEXAO = null;
        private static function Conectar(){
            error_reporting(E_ERROR | E_PARSE);
            if(Banco::$CONEXAO == null){
                Banco::$CONEXAO = new mysqli(Banco::$HOST, Banco::$USER, Banco::$PWD, Banco::$DB, Banco::$PORT);
                if (Banco::$CONEXAO->connect_error){
                    $obj = new stdClass();
                    $obj->cod = 1;
                    $obj->msg = "Erro ao conectar ao banco de dados";
                    $obj->erro = Banco::$CONEXAO->connect_error;
                    die(json_encode($obj));
                }
            }
        }
        public static function getConexao(){
            if (Banco::$CONEXAO == null){
                Banco::Conectar();
            }
            return Banco::$CONEXAO;
        }
    }
?>