<?php
include_once 'modelo/repositorio/repositorioInstalacao.php';
/**
 * Descricao da controladorInstalacao
 *
 * @Autor Valter Vasconcelos 19/07/2012
 * 
 */
class controladorInstalacao {
    private $oRepoInstalacao;

    //Construtor da Classe
    function __construct($pdo){
        $this->oRepoInstalacao = new repositorioInstalacao($pdo);
    }
    
    public function inserirInstalacao($oInstalacao){
        return $this->oRepoInstalacao->inserir($oInstalacao);
    }
    
    public function alterarInstalacao($oInstalacao, $tipo){
        return $this->oRepoInstalacao->alterar($oInstalacao, $tipo);
    }
    
    public function removerInstalacao($id){
        return $this->oRepoInstalacao->remover($id);
    }
    
    public function listarInstalacao($cli_id){
        return $this->oRepoInstalacao->listar($cli_id);
    }
    
    public function listarInstalacaoId($id){
        return $this->oRepoInstalacao->listarPorId($id);
    }
    
    public function listarInstalacaoJsonEvento(){
        return $this->oRepoInstalacao->listarJsonEvento();
    }
    
    public function listarInstalacaoJsonGridInferior($aParams){
        return $this->oRepoInstalacao->listarJsonGridInferior($aParams);
    }
    
    public function listarInstalacaoJsonGridMapa($aParams){
        return $this->oRepoInstalacao->listarJsonGridMapa($aParams);
    }
    
    public function listarInstalacaoTotalJsonEvento(){
        return $this->oRepoInstalacao->listarTotalJsonEvento();
    }
    
    public function listarInstalacaoFrameSOS($inst_id){
        return $this->oRepoInstalacao->listarFrameSOS($inst_id);
    }
    
    public function listarInstalacaoFrameCARCAIN($inst_id){
        return $this->oRepoInstalacao->listarFrameCERCAINOUT($inst_id);
    }
    
    public function listarInstalacaoFrameCARCAOUT($inst_id){
        return $this->oRepoInstalacao->listarFrameCERCAINOUT($inst_id);
    }
    
    public function listarInstalacaoFrameGridMapa($inst_id){
        return $this->oRepoInstalacao->listarFrameGridMapa($inst_id);
    }
    
    public function listarInstalacaoFrameGridComando($inst_id){
        return $this->oRepoInstalacao->listarFrameGridComando($inst_id);
    }
    
    public function listarInstalacaoEnviarComando($inst_id, $tipo){
        return $this->oRepoInstalacao->listarEnviarComando($inst_id, $tipo);
    }
    
    public function listarInstalacaoSalvaProcedimento($inst_id, $tipo){
        return $this->oRepoInstalacao->listarSalvaProcedimento($inst_id, $tipo);
    }
    
    public function listarInstalacaoPorCliente($cli_id){
        return $this->oRepoInstalacao->listarInstalacaoPorCliente($cli_id);
    }
    
    public function listarInstalacaoPorClienteCerca($cli_id, $cerca_id){
        return $this->oRepoInstalacao->listarInstalacaoPorClienteCerca($cli_id, $cerca_id);
    }
    
    public function listarInstalacaoPorClienteRota($cli_id, $rota_id){
        return $this->oRepoInstalacao->listarInstalacaoPorClienteRota($cli_id, $rota_id);
    }
    
    public function listarInstalacaoRelVeiculo($aParams){
        return $this->oRepoInstalacao->listarInstalacaoRelatorioVeiculo($aParams);
    }
    
    public function listarInstalacaoRelVeiculoPosicao($aParams){
        return $this->oRepoInstalacao->listarInstalacaoRelatorioVeiculoPosicao($aParams);
    }
    
    public function listarInstalacaoRelCliVeiculo(){
        return $this->oRepoInstalacao->listarInstalacaoRelatorioClienteVeiculo();
    }
    
    public function listarInstalacaoRelOperacao($aParams){
        return $this->oRepoInstalacao->listarInstalacaoRelatorioOperacao($aParams);
    }
    
    public function listarInstalacaoRelHistoricoInst($aParams){
        return $this->oRepoInstalacao->listarInstalacaoRelatorioHistoricoInst($aParams);
    }
    
    public function validarInstalacao($aParams){
        return $this->oRepoInstalacao->validar($aParams);
    }

}

?>