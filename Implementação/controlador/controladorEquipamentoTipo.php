<?php
include_once 'modelo/repositorio/repositorioEquipamentoTipo.php';
include_once 'modelo/classes/equipamentoTipo.php';
/**
 * Descrição da controladorEquipamentoTipo
 *
 * @Autor Gilmario Pereira 12/07/2012
 */
class controladorEquipamentoTipo {
    private $oRepoEquipamentoTipo;
    
    //Construtor da Classe
    function  __construct($pdo){
        $this->oRepoEquipamentoTipo = new repositorioEquipamentoTipo($pdo);
    }
    
    public function inserirEquipamentoTipo($oEquipamentoTipo) {
        return $this->oRepoEquipamentoTipo->inserir($oEquipamentoTipo);
    }  
    
    public function  alterarEquipamentoTipo($oEquipamentoTipo) {
        return $this->oRepoEquipamentoTipo->alterar($oEquipamentoTipo);
    }
    
    public function removerEquipamentoTipo($id) {
        return $this->oRepoEquipamentoTipo->remover($id);
    }
    
    public function listarEquipamentoTipo(){
        return $this->oRepoEquipamentoTipo->listar();
    }
    
    public function listarEquipamentoTipoId($id) {
        return $this->oRepoEquipamentoTipo->listarPorId($id);
    }
    
    public function validarEquipamentoTipo($params){
        return $this->oRepoEquipamentoTipo->validar($params);
    }    
        
}


?>