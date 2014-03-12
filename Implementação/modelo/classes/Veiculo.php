<?php
/**
 * Descrição da Veiculo
 *
 * @Autor Valter Vasconcelos 26/07/2012
 */
class Veiculo {
    //Definir Contrutor da Classe
    
    private $veic_id;
    private $veic_placa;
    private $veic_chassi;
    private $veic_renavam;
   

    function veiculo(){
        
    }

    public function getVeic_id() {
        return $this->veic_id;
    }

    public function setVeic_id($veic_id) {
        $this->veic_id = $veic_id;
    }

    public function getVeic_placa() {
        return $this->veic_placa;
    }

    public function setVeic_placa($veic_placa) {
        $this->veic_placa = $veic_placa;
    }

    public function getVeic_chassi() {
        return $this->veic_chassi;
    }

    public function setVeic_chassi($veic_chassi) {
        $this->veic_chassi = $veic_chassi;
    }

    public function getVeic_renavam() {
        return $this->veic_renavam;
    }

    public function setVeic_renavam($veic_renavam) {
        $this->veic_renavam = $veic_renavam;
    }
    
 }

?>