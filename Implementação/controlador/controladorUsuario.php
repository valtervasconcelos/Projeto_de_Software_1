<?php
include_once 'modelo/repositorio/repositorioUsuario.php';
/**
 * Descricao da controladorUsuario
 *
 * @Autor Valter Vasconcelos 11/07/2012
 * 
 */
class controladorUsuario {
    private $oRepoUsuario;

    //Construtor da Classe
    function __construct($pdo){
        $this->oRepoUsuario = new repositorioUsuario($pdo);
    }
    
    public function inserirUsuario($oUsuario){
        return $this->oRepoUsuario->inserir($oUsuario);
    }
    
    public function alterarUsuario($oUsuario){
        return $this->oRepoUsuario->alterar($oUsuario);
    }

    public function alterarSenhaUsuario($oUsuario){
        return $this->oRepoUsuario->alterarSenha($oUsuario);
    }

    public function removerUsuario($id){
        return $this->oRepoUsuario->remover($id);
    }
    
    public function listarUsuario($iCliente){
        return $this->oRepoUsuario->listar($iCliente);
    }
    
    public function listarUsuarioId($id){
        return $this->oRepoUsuario->listarPorId($id);
    }
    
    public function listarUsuarioMonitor(){
        return $this->oRepoUsuario->listarMonitor();
    }
    
    public function validarUsuario($params){
        return $this->oRepoUsuario->validar($params);
    }

}

?>