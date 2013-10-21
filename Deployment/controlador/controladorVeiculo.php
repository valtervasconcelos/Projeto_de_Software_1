<?php
include_once 'modelo/repositorio/repositorioVeiculo.php';
/**
 * Descrição da controladorVeiculo
 *
 * @Autor Valter Vasconcelos 26/07/2012
 */
class controladorVeiculo {private $oRepoVeiculo;

    //Construtor da Classe
    function __construct($pdo) {
        $this->oRepoVeiculo = new repositorioVeiculo($pdo);
    }
    
    public function inserirVeiculo($oVeiculo){
        return $this->oRepoVeiculo->inserir($oVeiculo);
    }
    
    public function alterarVeiculo($oVeiculo){
        return $this->oRepoVeiculo->alterar($oVeiculo);
    }
    
    public function removerVeiculo($id){
        return $this->oRepoVeiculo->remover($id);
    }
    
    public function listarVeiculo($iCliente){
        return $this->oRepoVeiculo->listar($iCliente);
    }
    
    public function listarVeiculoPorId($id){
        return $this->oRepoVeiculo->listarPorId($id);
    }
    
    public function listarVeiculoPorInstalacao($cli_id, $inst_id, $acao) {
        return $this->oRepoVeiculo->listarVeiculoInstalacao($cli_id, $inst_id, $acao);
    }

}

?>