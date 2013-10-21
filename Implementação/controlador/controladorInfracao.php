<?php
include_once 'modelo/repositorio/repositorioInfracao.php';

/**
 * Description of controladorInfracao
 *
 * @author Valter Vasconcelos
 */
class controladorInfracao {
    private $oRepoInfracao;
        
    //Contrutor
    function __construct($pdo){
        $this->oRepoInfracao = new repositorioInfracao($pdo);
    }
    
    public function inserirInfracao($oInfracao) {
        return $this->oRepoInfracao->inserir($oInfracao);
    }
    
    public function alterarInfracao($oInfracao){
        return $this->oRepoInfracao->alterarInfracao($oInfracao);
    }
    
    public function removerInfracao($id) {
        return $this->oRepoInfracao->remover($id);
    }
    
    public function listarInfracao() {
        return $this->oRepoInfracao->listar();
    }
    
    public function listarInfracaoPorId($id){
        return $this->oRepoInfracao->listarPorId($id);
    }
    
    public function listarTabelaInfracao() {
        return $this->oRepoInfracao->listarTabelaInfracao();
    }
    
    public function listarTabelaInfracaoPorId($cod) {
        return $this->oRepoInfracao->listarTabelaInfracaoPorId($cod);
    }
    
    public function listarInfracaoPorCli($cli) {
        return $this->oRepoInfracao->listarInfracaoPorCli($cli);
    }
    
}

?>