<?php
include_once 'modelo/repositorio/repositorioOperadora.php';
/**
 * Descrição da controladorOperadora
 *
 * @Autor Gilmario Pereira 23/07/2012
 */
class controladorOperadora {
    private $oRepoOperadora;
    
    function __construct($pdo){
        return $this->oRepoOperadora = new repositorioOperadora($pdo);
    }
    
    public function inserirOperadora($oOperadora) {
        return $this->oRepoOperadora->inserir($oOperadora);
    }
    
    public function alterarOperadora($oOperadora) {
        return $this->oRepoOperadora->alterar($oOperadora);
    }
    
    public function removerOperadora($id) {
        return $this->oRepoOperadora->remover($id);
    }
    
    public function listarOperadora() {
        return $this->oRepoOperadora->listar();
    }
    
    public function listarOperadoraPorId($id) {
        return $this->oRepoOperadora->listarPorId($id);
    }
}

?>