<?php

/**
 * Descricao da Infracao
 *
 * @Autor Valter Vasconcelos 18/01/2013
 * 
 */

class Infracao {

    private $infr_id;   
    private $infr_dthr;
    private $cli_id;
    private $moto_id;
    private $inst_id;
    private $tab_id;
    private $infr_dsc;
    private $infr_lembrar;
    private $infr_dtre;
    private $infr_status;
    private $infr_valor;
    private $infr_dtpag;
    private $infr_vecimento;
    private $infr_ponto; 
    
    //contrutor da classe
    public function Infracao() {
        
    }
    
    public function getInfr_id() {
        return $this->infr_id;
    }

    public function setInfr_id($infr_id) {
        $this->infr_id = $infr_id;
    }

    public function getInfr_dthr() {
        return $this->infr_dthr;
    }

    public function setInfr_dthr($infr_dthr) {
        $this->infr_dthr = $infr_dthr;
    }

    public function getCli_id() {
        return $this->cli_id;
    }

    public function setCli_id($cli_id) {
        $this->cli_id = $cli_id;
    }

    public function getMoto_id() {
        return $this->moto_id;
    }

    public function setMoto_id($moto_id) {
        $this->moto_id = $moto_id;
    }

    public function getInst_id() {
        return $this->inst_id;
    }

    public function setInst_id($inst_id) {
        $this->inst_id = $inst_id;
    }
    
    public function getTab_id() {
        return $this->tab_id;
    }

    public function setTab_id($tab_id) {
        $this->tab_id = $tab_id;
    }

    
    public function getInfr_dsc() {
        return $this->infr_dsc;
    }

    public function setInfr_dsc($infr_dsc) {
        $this->infr_dsc = $infr_dsc;
    }

    public function getInfr_lembrar() {
        return $this->infr_lembrar;
    }

    public function setInfr_lembrar($infr_lembrar) {
        $this->infr_lembrar = $infr_lembrar;
    }

    public function getInfr_dtre() {
        return $this->infr_dtre;
    }

    public function setInfr_dtre($infr_dtre) {
        $this->infr_dtre = $infr_dtre;
    }

    public function getInfr_status() {
        return $this->infr_status;
    }

    public function setInfr_status($infr_status) {
        $this->infr_status = $infr_status;
    }

    public function getInfr_valor() {
        return $this->infr_valor;
    }

    public function setInfr_valor($infr_valor) {
        $this->infr_valor = $infr_valor;
    }

    public function getInfr_dtpag() {
        return $this->infr_dtpag;
    }

    public function setInfr_dtpag($infr_dtpag) {
        $this->infr_dtpag = $infr_dtpag;
    }

    public function getInfr_vecimento() {
        return $this->infr_vecimento;
    }

    public function setInfr_vecimento($infr_vecimento) {
        $this->infr_vecimento = $infr_vecimento;
    }

    public function getInfr_ponto() {
        return $this->infr_ponto;
    }

    public function setInfr_ponto($infr_ponto) {
        $this->infr_ponto = $infr_ponto;
    }
        
}

?>