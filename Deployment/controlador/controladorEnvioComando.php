<?php
include_once 'modelo/repositorio/repositorioEnvioComando.php';
/**
 * Descricao da controladorEnvioComando
 *
 * @Autor Valter Vasconcelos 02/08/2012
 * 
 */
class controladorEnvioComando {
    private $oRepoEnvioComando;
    
    //Construtor da Classe
    function __construct($pdo){
        $this->oRepoEnvioComando = new repositorioEnvioComando($pdo);
    }
    
    public function inserirEnvioComando($oEnvioComando) {
        return $this->oRepoEnvioComando->inserir($oEnvioComando);
    }  
    
    public function  alterarEnvioComando($oEnvioComando) {
        return $this->oRepoEnvioComando->alterar($oEnvioComando);
    }
    
    public function removerEnvioComando($id) {
        return $this->oRepoEnvioComando->remover($id);
    }
    
    public function listarEnvioComando(){
        return $this->oRepoEnvioComando->listar();
    }
    
    public function listarEnvioComandoId($id) {
        return $this->oRepoEnvioComando->listarPorId($id);
    }

}

?>