<?php
include_once 'modelo/repositorio/repositorioUsuarioTipo.php';
/**
 * Descricao da controladorUsuarioTipo
 *
 * @Autor Valter Vasconcelos 11/07/2012
 * 
 */
class controladorUsuarioTipo {
    private $oRepoUsuarioTipo;

    //Construtor da Classe
    function __construct($pdo) {
        $this->oRepoUsuarioTipo = new repositorioUsuarioTipo($pdo);        
    }
    
    public function inserirUsuarioTipo($oUsuarioTipo){
        return $this->oRepoUsuarioTipo->inserir($oUsuarioTipo);
    }
    
    public function alterarUsuarioTipo($oUsuarioTipo){
        return $this->oRepoUsuarioTipo->alterar($oUsuarioTipo);
    }
    
    public function removerUsuarioTipo($id){
        return $this->oRepoUsuarioTipo->remover($id);
    }
    
    public function listarUsuarioTipo(){
        return $this->oRepoUsuarioTipo->listar();
    }
    
    public function listarUsuarioTipoId($id){
        return $this->oRepoUsuarioTipo->listarPorId($id);
    }
    
    public function validarUsuarioTipo($aParams){
        return $this->oRepoUsuarioTipo->validar($aParams);
    }

}

?>