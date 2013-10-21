<?php
/**
 * Descricao da Usuario
 *
 * @Autor Valter Vasconcelos 11/07/2012
 * 
 */
class Usuario {
    private $usr_id;
    private $usrt_id;
    private $cli_id;
    private $usr_login;
    private $usr_senha;
    private $usr_dsc;
    private $usr_ende;
    private $usr_bair;
    private $usr_cida;
    private $esta_id;
    private $usr_cep;
    private $usr_tel;
    private $usr_cel;
    private $usr_email;
    private $usr_dtca;
    private $usr_dtre;
    private $usr_obs;
    
    //Construtor da Classe
    function Usuario() {
        
    }
    
    
    public function getUsr_id() {
        return $this->usr_id;
    }

    public function setUsr_id($usr_id) {
        $this->usr_id = $usr_id;
    }

    public function getUsrt_id() {
        return $this->usrt_id;
    }

    public function setUsrt_id($usrt_id) {
        $this->usrt_id = $usrt_id;
    }

    public function getCli_id() {
        return $this->cli_id;
    }

    public function setCli_id($cli_id) {
        $this->cli_id = $cli_id;
    }

    public function getUsr_login() {
        return $this->usr_login;
    }

    public function setUsr_login($usr_login) {
        $this->usr_login = $usr_login;
    }

    public function getUsr_senha() {
        return $this->usr_senha;
    }

    public function setUsr_senha($usr_senha) {
        $this->usr_senha = $usr_senha;
    }

    public function getUsr_dsc() {
        return $this->usr_dsc;
    }

    public function setUsr_dsc($usr_dsc) {
        $this->usr_dsc = $usr_dsc;
    }

    public function getUsr_ende() {
        return $this->usr_ende;
    }

    public function setUsr_ende($usr_ende) {
        $this->usr_ende = $usr_ende;
    }

    public function getUsr_bair() {
        return $this->usr_bair;
    }

    public function setUsr_bair($usr_bair) {
        $this->usr_bair = $usr_bair;
    }

    public function getUsr_cida() {
        return $this->usr_cida;
    }

    public function setUsr_cida($usr_cida) {
        $this->usr_cida = $usr_cida;
    }

    public function getEsta_id() {
        return $this->esta_id;
    }

    public function setEsta_id($esta_id) {
        $this->esta_id = $esta_id;
    }

    public function getUsr_cep() {
        return $this->usr_cep;
    }

    public function setUsr_cep($usr_cep) {
        $this->usr_cep = $usr_cep;
    }

    public function getUsr_tel() {
        return $this->usr_tel;
    }

    public function setUsr_tel($usr_tel) {
        $this->usr_tel = $usr_tel;
    }

    public function getUsr_cel() {
        return $this->usr_cel;
    }

    public function setUsr_cel($usr_cel) {
        $this->usr_cel = $usr_cel;
    }

    public function getUsr_email() {
        return $this->usr_email;
    }

    public function setUsr_email($usr_email) {
        $this->usr_email = $usr_email;
    }

    public function getUsr_dtca() {
        return $this->usr_dtca;
    }

    public function setUsr_dtca($usr_dtca) {
        $this->usr_dtca = $usr_dtca;
    }

    public function getUsr_dtre() {
        return $this->usr_dtre;
    }

    public function setUsr_dtre($usr_dtre) {
        $this->usr_dtre = $usr_dtre;
    }

    public function getUsr_obs() {
        return $this->usr_obs;
    }

    public function setUsr_obs($usr_obs) {
        $this->usr_obs = $usr_obs;
    }    

}

?>