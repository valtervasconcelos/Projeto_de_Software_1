<?php
/**
 * Descricao da usuarioTipo
 *
 * @Autor Valter Vasconcelos 11/07/2012
 * 
 */
class usuarioTipo {
    private $usrt_id;
    private $usrt_dsc;
    private $usrt_obs;

    //Construtor da Classe
    function usuarioTipo() {
        
    }
    
    public function getUsrt_id() {
        return $this->usrt_id;
    }

    public function setUsrt_id($usrt_id) {
        $this->usrt_id = $usrt_id;
    }

    public function getUsrt_dsc() {
        return $this->usrt_dsc;
    }

    public function setUsrt_dsc($usrt_dsc) {
        $this->usrt_dsc = $usrt_dsc;
    }

    public function getUsrt_obs() {
        return $this->usrt_obs;
    }

    public function setUsrt_obs($usrt_obs) {
        $this->usrt_obs = $usrt_obs;
    }



}

?>