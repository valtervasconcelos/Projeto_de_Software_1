<?php
/**
 * Descrição da Veiculo
 *
 * @Autor Valter Vasconcelos 26/07/2012
 */
class Veiculo {
    //Definir Contrutor da Classe
    
    private $veic_id;
    private $cli_id;
    private $veicic_id;
    private $veicma_id;
    private $veicmo_id;
    private $veicor_id;
    private $veic_placa;
    private $veic_chassi;
    private $veic_renavam;
    private $veic_consumo;
    private $veic_ano;
    private $esta_id;
    private $veic_dtca;
    private $veic_dtre;
    private $veic_obs;

    function veiculo(){
        
    }

    public function getVeic_id() {
        return $this->veic_id;
    }

    public function setVeic_id($veic_id) {
        $this->veic_id = $veic_id;
    }

    public function getCli_id() {
        return $this->cli_id;
    }

    public function setCli_id($cli_id) {
        $this->cli_id = $cli_id;
    }

    public function getVeicic_id() {
        return $this->veicic_id;
    }

    public function setVeicic_id($veicic_id) {
        $this->veicic_id = $veicic_id;
    }

    public function getVeicma_id() {
        return $this->veicma_id;
    }

    public function setVeicma_id($veicma_id) {
        $this->veicma_id = $veicma_id;
    }

    public function getVeicmo_id() {
        return $this->veicmo_id;
    }

    public function setVeicmo_id($veicmo_id) {
        $this->veicmo_id = $veicmo_id;
    }

    public function getVeicor_id() {
        return $this->veicor_id;
    }

    public function setVeicor_id($veicor_id) {
        $this->veicor_id = $veicor_id;
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
    
    public function getVeic_consumo() {
        return $this->veic_consumo;
    }

    public function setVeic_consumo($veic_consumo) {
        $this->veic_consumo = $veic_consumo;
    }
    
    public function getVeic_ano() {
        return $this->veic_ano;
    }

    public function setVeic_ano($veic_ano) {
        $this->veic_ano = $veic_ano;
    }

    public function getEsta_id() {
        return $this->esta_id;
    }

    public function setEsta_id($esta_id) {
        $this->esta_id = $esta_id;
    }

    public function getVeic_dtca() {
        return $this->veic_dtca;
    }

    public function setVeic_dtca($veic_dtca) {
        $this->veic_dtca = $veic_dtca;
    }

    public function getVeic_dtre() {
        return $this->veic_dtre;
    }

    public function setVeic_dtre($veic_dtre) {
        $this->veic_dtre = $veic_dtre;
    }

    public function getVeic_obs() {
        return $this->veic_obs;
    }

    public function setVeic_obs($veic_obs) {
        $this->veic_obs = $veic_obs;
    }

}

?>