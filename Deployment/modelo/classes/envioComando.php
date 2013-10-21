<?php
/**
 * Descricao da envioComando
 *
 * @Autor Valter Vasconcelos 02/08/2012
 * 
 */
class envioComando {
    private $envcom_id;
    private $inst_id;
    private $envcom_dsc;
    private $envcom_comando;
    private $envcom_obs;
    private $usr_id_cad;
    private $envcom_dthrca;
    private $envcom_dthren;
    private $envcom_dthrco;
    private $usr_id_rem;
    private $envcom_dthrre;

    //Construtor da Classe
    function envioComando() {
        
    }
    
    public function getEnvcom_id() {
        return $this->envcom_id;
    }

    public function setEnvcom_id($envcom_id) {
        $this->envcom_id = $envcom_id;
    }

    public function getInst_id() {
        return $this->inst_id;
    }

    public function setInst_id($inst_id) {
        $this->inst_id = $inst_id;
    }

    public function getEnvcom_dsc() {
        return $this->envcom_dsc;
    }

    public function setEnvcom_dsc($envcom_dsc) {
        $this->envcom_dsc = $envcom_dsc;
    }

    public function getEnvcom_comando() {
        return $this->envcom_comando;
    }

    public function setEnvcom_comando($envcom_comando) {
        $this->envcom_comando = $envcom_comando;
    }

    public function getEnvcom_obs() {
        return $this->envcom_obs;
    }

    public function setEnvcom_obs($envcom_obs) {
        $this->envcom_obs = $envcom_obs;
    }

    public function getUsr_id_cad() {
        return $this->usr_id_cad;
    }

    public function setUsr_id_cad($usr_id_cad) {
        $this->usr_id_cad = $usr_id_cad;
    }

    public function getEnvcom_dthrca() {
        return $this->envcom_dthrca;
    }

    public function setEnvcom_dthrca($envcom_dthrca) {
        $this->envcom_dthrca = $envcom_dthrca;
    }

    public function getEnvcom_dthren() {
        return $this->envcom_dthren;
    }

    public function setEnvcom_dthren($envcom_dthren) {
        $this->envcom_dthren = $envcom_dthren;
    }

    public function getEnvcom_dthrco() {
        return $this->envcom_dthrco;
    }

    public function setEnvcom_dthrco($envcom_dthrco) {
        $this->envcom_dthrco = $envcom_dthrco;
    }

    public function getUsr_id_rem() {
        return $this->usr_id_rem;
    }

    public function setUsr_id_rem($usr_id_rem) {
        $this->usr_id_rem = $usr_id_rem;
    }

    public function getEnvcom_dthrre() {
        return $this->envcom_dthrre;
    }

    public function setEnvcom_dthrre($envcom_dthrre) {
        $this->envcom_dthrre = $envcom_dthrre;
    }



}

?>