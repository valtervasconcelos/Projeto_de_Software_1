<?php
/**
 * Descricao da Motorista
 *
 * @Autor Valter Vasconcelos 13/07/2012
 * 
 */
class Motorista {
    private $moto_id;
    private $cli_id;
    private $moto_dsc;
    private $moto_ende;
    private $moto_bair;
    private $moto_cida;
    private $esta_id;
    private $moto_cep;
    private $moto_iden;
    private $moto_cmot;
    private $moto_cmotvc;
    private $moto_cpf;
    private $moto_dtadm;
    private $moto_tel;
    private $moto_cel;
    private $moto_foto;
    private $moto_dtca;
    private $moto_dtre;
    private $moto_obs;

    //Construtor da Classe
    function Motorista() {
        
    }
    
    public function getMoto_id() {
        return $this->moto_id;
    }

    public function setMoto_id($moto_id) {
        $this->moto_id = $moto_id;
    }

    public function getCli_id() {
        return $this->cli_id;
    }

    public function setCli_id($cli_id) {
        $this->cli_id = $cli_id;
    }

    public function getMoto_dsc() {
        return $this->moto_dsc;
    }

    public function setMoto_dsc($moto_dsc) {
        $this->moto_dsc = $moto_dsc;
    }

    public function getMoto_ende() {
        return $this->moto_ende;
    }

    public function setMoto_ende($moto_ende) {
        $this->moto_ende = $moto_ende;
    }

    public function getMoto_bair() {
        return $this->moto_bair;
    }

    public function setMoto_bair($moto_bair) {
        $this->moto_bair = $moto_bair;
    }

    public function getMoto_cida() {
        return $this->moto_cida;
    }

    public function setMoto_cida($moto_cida) {
        $this->moto_cida = $moto_cida;
    }

    public function getEsta_id() {
        return $this->esta_id;
    }

    public function setEsta_id($esta_id) {
        $this->esta_id = $esta_id;
    }

    public function getMoto_cep() {
        return $this->moto_cep;
    }

    public function setMoto_cep($moto_cep) {
        $this->moto_cep = $moto_cep;
    }

    public function getMoto_iden() {
        return $this->moto_iden;
    }

    public function setMoto_iden($moto_iden) {
        $this->moto_iden = $moto_iden;
    }

    public function getMoto_cmot() {
        return $this->moto_cmot;
    }

    public function setMoto_cmot($moto_cmot) {
        $this->moto_cmot = $moto_cmot;
    }

    public function getMoto_cmotvc() {
        return $this->moto_cmotvc;
    }

    public function setMoto_cmotvc($moto_cmotvc) {
        $this->moto_cmotvc = ($moto_cmotvc != "")? "'".$moto_cmotvc."'" : 'NULL';
    }

    public function getMoto_cpf() {
        return $this->moto_cpf;
    }

    public function setMoto_cpf($moto_cpf) {
        $this->moto_cpf = $moto_cpf;
    }

    public function getMoto_dtadm() {
        return $this->moto_dtadm;
    }

    public function setMoto_dtadm($moto_dtadm) {
        $this->moto_dtadm = ($moto_dtadm != "")? "'".$moto_dtadm."'" : 'NULL';
    }

    public function getMoto_tel() {
        return $this->moto_tel;
    }

    public function setMoto_tel($moto_tel) {
        $this->moto_tel = $moto_tel;
    }

    public function getMoto_cel() {
        return $this->moto_cel;
    }

    public function setMoto_cel($moto_cel) {
        $this->moto_cel = $moto_cel;
    }

    public function getMoto_foto() {
        return $this->moto_foto;
    }

    public function setMoto_foto($moto_foto) {
        $this->moto_foto = $moto_foto;
    }

    public function getMoto_dtca() {
        return $this->moto_dtca;
    }

    public function setMoto_dtca($moto_dtca) {
        $this->moto_dtca = $moto_dtca;
    }

    public function getMoto_dtre() {
        return $this->moto_dtre;
    }

    public function setMoto_dtre($moto_dtre) {
        $this->moto_dtre = $moto_dtre;
    }

    public function getMoto_obs() {
        return $this->moto_obs;
    }

    public function setMoto_obs($moto_obs) {
        $this->moto_obs = $moto_obs;
    }


}

?>