<?php
/**
 * Descricao da Usuario
 *
 * @Autor Valter Vasconcelos 11/07/2012
 * 
 */
class Usuario {

    private $usr_id;
    private $usr_login;
    private $usr_senha;
    
    
    //Construtor da Classe
    function Usuario() {
        
    }
        
    public function getUsr_id() {
        return $this->usr_id;
    }

    public function setUsr_id($usr_id) {
        $this->usr_id = $usr_id;
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
    
 }

?>