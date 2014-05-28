<?php
include_once 'modelo/repositorio/repositorioChipGsm.php';
/**
 * Descrição da controladorChipGsm
 *
 * @Autor Gilmario Pereira 25/07/2012
 */
class controladorChipGsm {
    private $oRepoChipGsm;
   
    function __construct($pdo){
        return $this->oRepoChipGsm = new repositorioChipGsm($pdo);
    }
   
    public function inserirChipGsm($oChipGsm) {
        return $this->oRepoChipGsm->inserir($oChipGsm);
    }
   
    public function alterarChipGsm($oChipGsm) {
       return $this->oRepoChipGsm->alterar($oChipGsm);
    }

    public function listarChipGsm() {
       return $this->oRepoChipGsm->listar();
    }
   
    public function removerChipGsm($id) {
       return $this->oRepoChipGsm->remover($id);
    }
   
    public function listarChipGsmPorId($id) {
       return $this->oRepoChipGsm->listarPorId($id);
    }
    
    public function listarChipNaoCad($tipo) {
        return $this->oRepoChipGsm->listarChipNCad($tipo);
    }
       
}

?>