<?php
/**
 * Descricao da Instalacao
 *
 * @Autor Valter Vasconcelos 19/07/2012
 * 
 */
class Instalacao {
    private $inst_id;
    private $inst_dsc;
    private $cli_id;
    private $equip_id;
    private $veic_id;
    private $carr_id;
    private $moto_id;
    private $maxpor_id;
    private $gr_id;
    private $inst_valor;
    private $inst_teclado;
    private $inst_senhavoz;
    private $inst_pergunta;
    private $inst_resposta;
    private $inst_coasao;
    private $inst_dtin;
    private $inst_dtca;
    private $inst_dtre;
    private $inst_obs;
    private $inst_qacc;
    private $inst_qsn;
    private $inst_qpid;
    private $inst_valinst;  
    private $inst_valmen;
    private $inst_qenv;
    private $inst_manut;
    private $inst_odom;
    private $inst_offset;

    //Construtor da Classe
    function Instalacao() {
        
    }
    
    public function getInst_id() {
        return $this->inst_id;
    }

    public function setInst_id($inst_id) {
        $this->inst_id = $inst_id;
    }

    public function getInst_dsc() {
        return $this->inst_dsc;
    }

    public function setInst_dsc($inst_dsc) {
        $this->inst_dsc = $inst_dsc;
    }

    public function getCli_id() {
        return $this->cli_id;
    }

    public function setCli_id($cli_id) {
        $this->cli_id = $cli_id;
    }

    public function getEquip_id() {
        return $this->equip_id;
    }

    public function setEquip_id($equip_id) {
        $this->equip_id = $equip_id;
    }

    public function getVeic_id() {
        return $this->veic_id;
    }

    public function setVeic_id($veic_id) {
        $this->veic_id = $veic_id;
    }

    public function getCarr_id() {
        return $this->carr_id;
    }

    public function setCarr_id($carr_id) {
        $this->carr_id = $carr_id;
    }

    public function getMoto_id() {
        return $this->moto_id;
    }

    public function setMoto_id($moto_id) {
        $this->moto_id = $moto_id;
    }

    public function getMaxpor_id() {
        return $this->maxpor_id;
    }

    public function setMaxpor_id($maxpor_id) {
        $this->maxpor_id = $maxpor_id;
    }

    public function getGr_id() {
        return $this->gr_id;
    }

    public function setGr_id($gr_id) {
        $this->gr_id = $gr_id;
    }

    public function getInst_valor() {
        return $this->inst_valor;
    }

    public function setInst_valor($inst_valor) {
        $this->inst_valor = $inst_valor;
    }

    public function getInst_teclado() {
        return $this->inst_teclado;
    }

    public function setInst_teclado($inst_teclado) {
        $this->inst_teclado = $inst_teclado;
    }

    public function getInst_senhavoz() {
        return $this->inst_senhavoz;
    }

    public function setInst_senhavoz($inst_senhavoz) {
        $this->inst_senhavoz = $inst_senhavoz;
    }

    public function getInst_pergunta() {
        return $this->inst_pergunta;
    }

    public function setInst_pergunta($inst_pergunta) {
        $this->inst_pergunta = $inst_pergunta;
    }

    public function getInst_resposta() {
        return $this->inst_resposta;
    }

    public function setInst_resposta($inst_resposta) {
        $this->inst_resposta = $inst_resposta;
    }

    public function getInst_coasao() {
        return $this->inst_coasao;
    }

    public function setInst_coasao($inst_coasao) {
        $this->inst_coasao = $inst_coasao;
    }

    public function getInst_dtin() {
        return $this->inst_dtin;
    }

    public function setInst_dtin($inst_dtin) {
        $this->inst_dtin = $inst_dtin;
    }

    public function getInst_dtca() {
        return $this->inst_dtca;
    }

    public function setInst_dtca($inst_dtca) {
        $this->inst_dtca = $inst_dtca;
    }

    public function getInst_dtre() {
        return $this->inst_dtre;
    }

    public function setInst_dtre($inst_dtre) {
        $this->inst_dtre = $inst_dtre;
    }

    public function getInst_obs() {
        return $this->inst_obs;
    }

    public function setInst_obs($inst_obs) {
        $this->inst_obs = $inst_obs;
    }

    public function getInst_qacc() {
        return $this->inst_qacc;
    }

    public function setInst_qacc($inst_qacc) {
        $this->inst_qacc = $inst_qacc;
    }

    public function getInst_qsn() {
        return $this->inst_qsn;
    }

    public function setInst_qsn($inst_qsn) {
        $this->inst_qsn = $inst_qsn;
    }

    public function getInst_qpid() {
        return $this->inst_qpid;
    }

    public function setInst_qpid($inst_qpid) {
        $this->inst_qpid = $inst_qpid;
    }

    public function getInst_valinst() {
        return $this->inst_valinst;
    }

    public function setInst_valinst($inst_valinst) {
        $this->inst_valinst = $inst_valinst;
    }

    public function getInst_valmen() {
        return $this->inst_valmen;
    }

    public function setInst_valmen($inst_valmen) {
        $this->inst_valmen = $inst_valmen;
    }

    public function getInst_qenv() {
        return $this->inst_qenv;
    }

    public function setInst_qenv($inst_qenv) {
        $this->inst_qenv = $inst_qenv;
    }

    public function getInst_manut() {
        return $this->inst_manut;
    }

    public function setInst_manut($inst_manut) {
        $this->inst_manut = $inst_manut;
    }

    public function getInst_odom() {
        return $this->inst_odom;
    }

    public function setInst_odom($inst_odom) {
        $this->inst_odom = $inst_odom;
    }

    public function getInst_offset() {
        return $this->inst_offset;
    }

    public function setInst_offset($inst_offset) {
        $this->inst_offset = $inst_offset;
    }

}

?>