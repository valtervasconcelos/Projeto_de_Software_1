<?php
/**
 * Descrição da Operadora
 *
 * @Autor Gilmario Pereira 23/07/2012
 */
class Operadora {
    
    private $oper_id;
    private $oper_dsc;
    private $oper_codigo;
    private $oper_cont;
    private $oper_conttel;
    private $oper_dtca;
    private $oper_dthr;
    
    //construtor da classe
    public function Operadora() {
        
    }
    
    public function getOper_id() {
        return $this->oper_id;
    }

    public function setOper_id($oper_id) {
        $this->oper_id = $oper_id;
    }

    public function getOper_dsc() {
        return $this->oper_dsc;
    }

    public function setOper_dsc($oper_dsc) {
        $this->oper_dsc = $oper_dsc;
    }
    
    public function getOper_cont() {
        return $this->oper_cont;
    }

    public function setOper_cont($oper_cont) {
        $this->oper_cont = $oper_cont;
    }

    public function getOper_codigo() {
        return $this->oper_codigo;
    }

    public function setOper_codigo($oper_codigo) {
        $this->oper_codigo = $oper_codigo;
    }

    public function getOper_conttel() {
        return $this->oper_conttel;
    }

    public function setOper_conttel($oper_conttel) {
        $this->oper_conttel = $oper_conttel;
    }

    public function getOper_dtca() {
        return $this->oper_dtca;
    }

    public function setOper_dtca($oper_dtca) {
        $this->oper_dtca = $oper_dtca;
    }

    public function getOper_dthr() {
        return $this->oper_dthr;
    }

    public function setOper_dthr($oper_dthr) {
        $this->oper_dthr = $oper_dthr;
    }
    
    
}

?>