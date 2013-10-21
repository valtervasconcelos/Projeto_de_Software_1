<?php
/**
 * Descricao da Cliente
 *
 * @Autor Valter Vasconcelos 06/07/2012
 * 
 */
class Cliente {
    private $cli_id;
    private $cli_mae;
    private $cli_dsc;
    private $cli_sigla;
    private $cli_logo;
    private $pess_id;
    private $cli_ende;
    private $cli_bair;
    private $cli_cida;
    private $esta_id;
    private $cli_cep;
    private $cli_cpfcnpj;
    private $cli_inse;
    private $cli_insm;
    private $cli_tel;
    private $cli_tel2;
    private $cli_cel;
    private $cli_cel2;
    private $cli_fax;
    private $cli_email;
    private $cli_homepage;
    private $cli_fuso;
    private $cli_senhavoz;
    private $cli_pergunta;
    private $cli_resposta;
    private $cli_coasao;
    private $cli_dtca;
    private $cli_dtre;
    private $cli_obs;
    private $cli_cont1;
    private $cli_titu1;
    private $cli_tel01;
    private $cli_cpf1;
    private $cli_dtnasc1;
    private $cli_cont2;
    private $cli_titu2;
    private $cli_tel02;
    private $cli_cpf2;
    private $cli_dtnasc2;
    private $cli_cont3;
    private $cli_titu3;
    private $cli_tel03;
    private $cli_cpf3;
    private $cli_dtnasc3;

    //Construtor da Classe
    function Cliente() {
        
    }
    
    public function setCli_id($cli_id){
        $this->cli_id = $cli_id;
    }

    public function getCli_id(){
        return $this->cli_id;
    }


    public function setCli_mae($cli_mae){
        $this->cli_mae = $cli_mae;
    }

    public function getCli_mae(){
        return $this->cli_mae;
    }


    public function setCli_dsc($cli_dsc){
        $this->cli_dsc = $cli_dsc;
    }

    public function getCli_dsc(){
        return $this->cli_dsc;
    }

    public function setCli_sigla($cli_sigla){
        $this->cli_sigla = $cli_sigla;
    }

    public function getCli_sigla(){
        return $this->cli_sigla;
    }

    public function setCli_logo($cli_logo){
        $this->cli_logo = $cli_logo;
    }

    public function getCli_logo(){
        return $this->cli_logo;
    }

    public function setPess_id($pess_id){
        $this->pess_id = $pess_id;
    }

    public function getPess_id(){
        return $this->pess_id;
    }

    public function setCli_ende($cli_ende){
        $this->cli_ende = $cli_ende;
    }

    public function getCli_ende(){
        return $this->cli_ende;
    }

    public function setCli_bair($cli_bair){
        $this->cli_bair = $cli_bair;
    }

    public function getCli_bair(){
        return $this->cli_bair;
    }

    public function setCli_cida($cli_cida){
        $this->cli_cida = $cli_cida;
    }

    public function getCli_cida(){
        return $this->cli_cida;
    }

    public function setEsta_id($esta_id){
        $this->esta_id = $esta_id;
    }

    public function getEsta_id(){
        return $this->esta_id;
    }

    public function setCli_cep($cli_cep){
        $this->cli_cep = $cli_cep;
    }

    public function getCli_cep(){
        return $this->cli_cep;
    }

    public function setCli_cpfcnpj($cli_cpfcnpj){
        $this->cli_cpfcnpj = $cli_cpfcnpj;
    }

    public function getCli_cpfcnpj(){
        return $this->cli_cpfcnpj;
    }

    public function setCli_inse($cli_inse){
        $this->cli_inse = $cli_inse;
    }

    public function getCli_inse(){
        return $this->cli_inse;
    }

    public function setCli_insm($cli_insm){
        $this->cli_insm = $cli_insm;
    }

    public function getCli_insm(){
        return $this->cli_insm;
    }

    public function setCli_tel($cli_tel){
        $this->cli_tel = $cli_tel;
    }

    public function getCli_tel(){
        return $this->cli_tel;
    }

    public function setCli_tel2($cli_tel2){
        $this->cli_tel2 = $cli_tel2;
    }

    public function getCli_tel2(){
        return $this->cli_tel2;
    }

    public function setCli_cel($cli_cel){
        $this->cli_cel = $cli_cel;
    }

    public function getCli_cel(){
        return $this->cli_cel;
    }

    public function setCli_cel2($cli_cel2){
        $this->cli_cel2 = $cli_cel2;
    }

    public function getCli_cel2(){
        return $this->cli_cel2;
    }

    public function setCli_fax($cli_fax){
        $this->cli_fax = $cli_fax;
    }

    public function getCli_fax(){
        return $this->cli_fax;
    }

    public function setCli_email($cli_email){
        $this->cli_email = $cli_email;
    }

    public function getCli_email(){
        return $this->cli_email;
    }


    public function setCli_homepage($cli_homepage){
        $this->cli_homepage = $cli_homepage;
    }

    public function getCli_homepage(){
        return $this->cli_homepage;
    }

    public function setCli_fuso($cli_fuso){
        $this->cli_fuso = $cli_fuso;
    }

    public function getCli_fuso(){
        return $this->cli_fuso;
    }

    public function setCli_senhavoz($cli_senhavoz){
        $this->cli_senhavoz = $cli_senhavoz;
    }

    public function getCli_senhavoz(){
        return $this->cli_senhavoz;
    }

    public function setCli_pergunta($cli_pergunta){
        $this->cli_pergunta = $cli_pergunta;
    }

    public function getCli_pergunta(){
        return $this->cli_pergunta;
    }

    public function setCli_resposta($cli_resposta){
        $this->cli_resposta = $cli_resposta;
    }

    public function getCli_resposta(){
        return $this->cli_resposta;
    }

    public function setCli_coasao($cli_coasao){
        $this->cli_coasao = $cli_coasao;
    }

    public function getCli_coasao(){
        return $this->cli_coasao;
    }

    public function setCli_dtca($cli_dtca){
        $this->cli_dtca = $cli_dtca;
    }

    public function getCli_dtca(){
        return $this->cli_dtca;
    }

    public function setCli_dtre($cli_dtre){
        $this->cli_dtre = $cli_dtre;
    }

    public function getCli_dtre(){
        return $this->cli_dtre;
    }

    public function setCli_obs($cli_obs){
        $this->cli_obs = $cli_obs;
    }

    public function getCli_obs(){
        return $this->cli_obs;
    }

    public function setCli_cont1($cli_cont1){
        $this->cli_cont1 = $cli_cont1;
    }

    public function getCli_cont1(){
        return $this->cli_cont1;
    }

    public function setCli_titu1($cli_titu1){
        $this->cli_titu1 = $cli_titu1;
    }

    public function getCli_titu1(){
        return $this->cli_titu1;
    }

    public function setCli_tel01($cli_tel01){
        $this->cli_tel01 = $cli_tel01;
    }

    public function getCli_tel01(){
        return $this->cli_tel01;
    }


    public function setCli_cpf1($cli_cpf1){
        $this->cli_cpf1 = $cli_cpf1;
    }

    public function getCli_cpf1(){
        return $this->cli_cpf1;
    }


    public function setCli_dtnasc1($cli_dtnasc1){
        $this->cli_dtnasc1 = $cli_dtnasc1;
    }

    public function getCli_dtnasc1(){
        return $this->cli_dtnasc1;
    }

    public function setCli_cont2($cli_cont2){
        $this->cli_cont2 = $cli_cont2;
    }

    public function getCli_cont2(){
        return $this->cli_cont2;
    }


    public function setCli_titu2($cli_titu2){
        $this->cli_titu2 = $cli_titu2;
    }

    public function getCli_titu2(){
        return $this->cli_titu2;
    }

    public function setCli_tel02($cli_tel02){
        $this->cli_tel02 = $cli_tel02;
    }

    public function getCli_tel02(){
        return $this->cli_tel02;
    }

    public function setCli_cpf2($cli_cpf2){
        $this->cli_cpf2 = $cli_cpf2;
    }

    public function getCli_cpf2(){
        return $this->cli_cpf2;
    }

    public function setCli_dtnasc2($cli_dtnasc2){
        $this->cli_dtnasc2 = $cli_dtnasc2;
    }

    public function getCli_dtnasc2(){
        return $this->cli_dtnasc2;
    }

    public function setCli_cont3($cli_cont3){
        $this->cli_cont3 = $cli_cont3;
    }

    public function getCli_cont3(){
        return $this->cli_cont3;
    }

    public function setCli_titu3($cli_titu3){
        $this->cli_titu3 = $cli_titu3;
    }

    public function getCli_titu3(){
        return $this->cli_titu3;
    }

    public function setCli_tel03($cli_tel03){
        $this->cli_tel03 = $cli_tel03;
    }

    public function getCli_tel03(){
        return $this->cli_tel03;
    }

    public function setCli_cpf3($cli_cpf3){
        $this->cli_cpf3 = $cli_cpf3;
    }

    public function getCli_cpf3(){
        return $this->cli_cpf3;
    }

    public function setCli_dtnasc3($cli_dtnasc3){
        $this->cli_dtnasc3 = $cli_dtnasc3;
    }

    public function getCli_dtnasc3(){
        return $this->cli_dtnasc3;
    }

}

?>