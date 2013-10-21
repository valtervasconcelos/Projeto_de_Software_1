<?php
include_once 'visao/Tela.php';
/**
 * Descrição da Autenticar
 *
 * @Autor Valter Vasconcelos 04/07/2012
 * 
 */
class Autenticar extends Tela{    
    //Construtor da Classe
    function Autenticar(){
        if ($_SESSION[SESSAOEMPRESA]['usr_id'] == ""){
            $this->fachadaControl = $this->getInstanciaControle();
            $login = htmlspecialchars($_POST['entered_login']);
            $senha = htmlspecialchars($_POST['entered_password']);
            $login = stripslashes($login);
            //$login = mysql_escape_string($login);
            $senha = stripslashes($senha);
            //$senha = mysql_escape_string($senha);
            echo $this->fachadaControl->autenticarUsuario($login, $senha, $_SERVER['REMOTE_ADDR']);
        }
        
    }
}

?>