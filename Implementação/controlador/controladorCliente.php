<?php
include_once 'modelo/repositorio/repositorioCliente.php';
/**
 * Descricao da controladorCliente
 *
 * @Autor Valter Vasconcelos 06/07/2012
 * 
 */
class controladorCliente {
    private $oRepoCliente;

    //Construtor da Classe
    function __construct($pdo){
        $this->oRepoCliente = new repositorioCliente($pdo);
    }
    
    public function inserirCliente($oCliente){
        return $this->oRepoCliente->inserir($oCliente);
    }
    
    public function alterarCliente($oCliente){
        return $this->oRepoCliente->alterar($oCliente);
    }
    
    public function removerCliente($id){
        return $this->oRepoCliente->remover($id);
    }
    
    public function listarCliente(){
        return $this->oRepoCliente->listar();
    }
    
    public function listarClienteId($id){
        return $this->oRepoCliente->listarPorId($id);
    }
    
    public function listarClienteSelect(){
        return $this->oRepoCliente->listarSelect();
    }
    
    public function listarClienteNivel(){
        return $this->oRepoCliente->listarPorNivel();
    }
    
    public function listarClienteJSON($s_cli_id){
        return $this->oRepoCliente->listarJSON($s_cli_id);
    }
    
    public function validarCliente($params){
        return $this->oRepoCliente->validar($params);
    }

}

?>