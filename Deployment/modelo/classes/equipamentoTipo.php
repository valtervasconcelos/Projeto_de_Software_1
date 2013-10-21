<?php
/**
 * Descrição da equipamentoTipo
 *
 * @Autor Valter Vasconcelos 12/07/2012
 */
class equipamentoTipo {
    private $equipt_id;
    private $equipt_dsc;
    private $equipt_forn;
    private $equipt_dtca;
    private $equipt_dtre;
    private $equipt_obs;
     
    function equipamentoTipo() {
        
    }
    
    public function getEquipt_id() {
        return $this->equipt_id;
    }

    public function setEquipt_id($equipt_id) {
        $this->equipt_id = $equipt_id;
    }

    public function getEquipt_dsc() {
        return $this->equipt_dsc;
    }

    public function setEquipt_dsc($equipt_dsc) {
        $this->equipt_dsc = $equipt_dsc;
    }

    public function getEquipt_forn() {
        return $this->equipt_forn;
    }

    public function setEquipt_forn($equipt_forn) {
        $this->equipt_forn = $equipt_forn;
    }

    public function getEquipt_dtca() {
        return $this->equipt_dtca;
    }

    public function setEquipt_dtca($equipt_dtca) {
        $this->equipt_dtca = $equipt_dtca;
    }

    public function getEquipt_dtre() {
        return $this->equipt_dtre;
    }

    public function setEquipt_dtre($equipt_dtre) {
        $this->equipt_dtre = $equipt_dtre;
    }

    public function getEquipt_obs() {
        return $this->equipt_obs;
    }

    public function setEquipt_obs($equipt_obs) {
        $this->equipt_obs = $equipt_obs;
    }
    
}

?>