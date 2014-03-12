<?php
/**
 * Descricao da googlePosicao
 *
 * @Autor Valter Vasconcelos 14/12/2012
 * 
 */
class googlePosicao {
    private $goop_id;
    private $goop_lat;
    private $goop_lon;
   
    //Construtor da Classe
    function googlePosicao() {
        
    }
    
    public function getGoop_id() {
        return $this->goop_id;
    }

    public function setGoop_id($goop_id) {
        $this->goop_id = $goop_id;
    }

    public function getGoop_lat() {
        return $this->goop_lat;
    }

    public function setGoop_lat($goop_lat) {
        $this->goop_lat = $goop_lat;
    }

    public function getGoop_lon() {
        return $this->goop_lon;
    }

    public function setGoop_lon($goop_lon) {
        $this->goop_lon = $goop_lon;
    }

 }

?>