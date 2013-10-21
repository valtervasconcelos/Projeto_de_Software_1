<?php
include_once 'modelo/repositorio/repositorioEquipamento.php';
/**
 * Descrição da controladorEquipamento
 *
 * @Autor Valter Vasconcelos 02/08/2012
 */
class controladorEquipamento {
    private $oRepoEquipamento;
    
    function __construct($pdo){
        $this->oRepoEquipamento = new repositorioEquipamento($pdo);
    }
    
    public function inserirEquipamento($oEquipamento) {
        $this->oRepoEquipamento->inserir($oEquipamento);
    }
    
    public function removerEquipamento($id) {
        $this->oRepoEquipamento->remover($id);
    }
   
    public function alterarEquipamento($oEquipamento) {
        $this->oRepoEquipamento->alterar($oEquipamento);
    }
    
    public function listarEquipamento() {
        return $this->oRepoEquipamento->listar();
    }
    
    public function listarEquipamentoPorId($id) {
        return $this->oRepoEquipamento->listarPorId($id);
    }
    
    public function listarEquipamentoPorInstalacao($inst_id, $acao) {
        return $this->oRepoEquipamento->listarEquipamentoInstalacao($inst_id, $acao);
    }
    
    public function validarEquipamento($params) {
        return $this->oRepoEquipamento->validar($params);
    }
    
}

?>