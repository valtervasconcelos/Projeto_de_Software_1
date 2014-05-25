<?php
include_once 'modelo/repositorio/repositorioMotorista.php';
/**
 * Descricao da controladorMotorista
 *
 * @Autor Fábio Sales 13/07/2012
 * Analista de Sistemas
 */
class controladorMotorista {
    private $oRepoMotorista;

    //Construtor da Classe
    function __construct($pdo){
        $this->oRepoMotorista = new repositorioMotorista($pdo);
    }
    
    public function inserirMotorista($oMotorista){
        return $this->oRepoMotorista->inserir($oMotorista);
    }
    
    public function alterarMotorista($oMotorista){
        return $this->oRepoMotorista->alterar($oMotorista);
    }
    
    public function removerMotorista($id){
        return $this->oRepoMotorista->remover($id);
    }
    
    public function listarMotorista($iCliente){
        return $this->oRepoMotorista->listar($iCliente);
    }
    
    public function listarMotoristaId($id){
        return $this->oRepoMotorista->listarPorId($id);
    }
    
    public function listarMotoristaPorCliente($cli_id){
        return $this->oRepoMotorista->listarPorCliente($cli_id);
    }

}

?>