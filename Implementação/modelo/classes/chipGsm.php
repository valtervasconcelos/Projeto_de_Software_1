<?php
/**
 * Descrição da chipGsm
 *
 * @Autor Gilmario Pereira 25/07/2012
 */
class chipGsm {

    private $chip_id;
    private $oper_id;   
    private $chipp_id;
    private $chip_serial;
    private $chip_tel;
    private $esta_id;
    private $chip_dtcp;
    private $chip_dtat;
    private $chip_dtca;
    private $chip_obs;
        
    //construtor da classe chipGsm
    public function chipGsm() {
        
    }

    public function getChip_id() {
        return $this->chip_id;
    }

    public function setChip_id($chip_id) {
        $this->chip_id = $chip_id;
    }

    public function getOper_id() {
        return $this->oper_id;
    }

    public function setOper_id($oper_id) {
        $this->oper_id = $oper_id;
    }

    public function getChipp_id() {
        return $this->chipp_id;
    }

    public function setChipp_id($chipp_id) {
        $this->chipp_id = $chipp_id;
    }

    public function getChip_serial() {
        return $this->chip_serial;
    }

    public function setEsta_id($esta_id) {
        $this->esta_id = $esta_id;
    }

    public function setChip_serial($chip_serial) {
        $this->chip_serial = $chip_serial;
    }

    public function getChip_tel() {
        return $this->chip_tel;
    }

    public function setChip_tel($chip_tel) {
        $this->chip_tel = $chip_tel;
    }

    public function getEsta_id() {
        return $this->esta_id;
    }

    public function getChip_dtcp() {
        return $this->chip_dtcp;
    }

    public function setChip_dtcp($chip_dtcp) {
        $this->chip_dtcp = $chip_dtcp;
    }

    public function getChip_dtat() {
        return $this->chip_dtat;
    }

    public function setChip_dtat($chip_dtat) {
        $this->chip_dtat = $chip_dtat;
    }

    public function getChip_dtca() {
        return $this->chip_dtca;
    }

    public function setChip_dtca($chip_dtca) {
        $this->chip_dtca = $chip_dtca;
    }

    public function getChip_obs() {
        return $this->chip_obs;
    }

    public function setChip_obs($chip_obs) {
        $this->chip_obs = $chip_obs;
    }    
    
}

?>