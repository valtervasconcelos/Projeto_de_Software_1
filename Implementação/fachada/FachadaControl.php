<?php
include_once 'modelo/PDOPlugin.php';
include_once 'controlador/controladorEmpresa.php';
include_once 'controlador/controladorClienteTipo.php';
include_once 'controlador/controladorCliente.php';
include_once 'controlador/controladorUsuario.php';
include_once 'controlador/controladorUsuarioTipo.php';
include_once 'controlador/controladorUsuarioLog.php';
include_once 'controlador/controladorMotorista.php';
include_once 'controlador/controladorServico.php';
include_once 'controlador/controladorEquipamento.php';
include_once 'controlador/controladorEquipamentoTipo.php';
include_once 'controlador/controladorChipGsm.php';
include_once 'controlador/controladorChipGsmPlano.php';
include_once 'controlador/controladorOperadora.php';
include_once 'controlador/controladorVeiculo.php';
include_once 'controlador/controladorVeiculoModelo.php';
include_once 'controlador/controladorVeiculoCor.php';
include_once 'controlador/controladorVeiculoMarca.php';
include_once 'controlador/controladorVeiculoIcone.php';
include_once 'controlador/controladorCombustivel.php';
include_once 'controlador/controladorPosto.php';
include_once 'controlador/controladorViagem.php';
include_once 'controlador/controladorInfracao.php';
include_once 'controlador/controladorAgenda.php';
include_once 'controlador/controladorPonto.php';
include_once 'controlador/controladorPontoIcone.php';
include_once 'controlador/controladorInstalacao.php';
include_once 'controlador/controladorInstalacaoCerca.php';
include_once 'controlador/controladorInstalacaoRota.php';
include_once 'controlador/controladorInstalacaoHistorico.php';
include_once 'controlador/controladorInstalacaoManutencao.php';
include_once 'controlador/controladorInstalacaoManutencaoItem.php';
include_once 'controlador/controladorCerca.php';
include_once 'controlador/controladorCercaPTS.php';
include_once 'controlador/controladorRota.php';
include_once 'controlador/controladorRotaPTS.php';
include_once 'controlador/controladorManutencao.php';
include_once 'controlador/controladorQuantaPosicUlt.php';
include_once 'controlador/controladorZenitePosicUlt.php';
include_once 'controlador/controladorSuntechPosicUlt.php';
include_once 'controlador/controladorMaxtrackPosicUlt.php';
include_once 'controlador/controladorMaxtrackPorta.php';
include_once 'controlador/controladorEnvioComando.php';
include_once 'controlador/controladorGooglePosicao.php';
/**
 * Descrição da FachadaControl
 *
 * @Autor Valter Vasconcelos 03/07/2012
 * 
 */
class FachadaControl {
    static $instanciaFachada = false;
    private $pdo;
    //Início
    private $oCtrlEmpresa;
    private $oCtrlClienteTipo;
    private $oCtrlCliente;
    private $oCtrlUsuario;
    private $oCtrlUsuarioTipo;
    private $oCtrlUsuarioLog;
    private $oCtrlMotorista;
    private $oCtrlServico;
    private $oCtrlEquipamento;
    private $oCtrlEquipamentoTipo;
    private $oCtrlChipGsm;
    private $oCtrlChipGsmPlano;
    private $oCtrlOperadora;
    private $oCtrlVeiculo;
    private $oCtrlVeiculoModelo;
    private $oCtrlVeiculoCor;
    private $oCtrlVeiculoMarca;
    private $oCtrlVeiculoIcone;
    private $oCtrlCombustivel;
    private $oCtrlPosto;
    private $oCtrlViagem;
    private $oCtrlInfracao;
    private $oCtrlAgenda;
    private $oCtrlPonto;
    private $oCtrlPontoIcone;
    private $oCtrlInstalacao;
    private $oCtrlInstalacaoCerca;
    private $oCtrlInstalacaoRota;
    private $oCtrlInstalacaoHistorico;
    private $oCtrlInstalacaoManutencao;
    private $oCtrlInstalacaoManutencaoItem;
    private $oCtrlCerca;
    private $oCtrlCercaPTS;
    private $oCtrlRota;
    private $oCtrlRotaPTS;
    private $oCtrlManutencao;
    private $oCtrlQuantaPosicUlt;
    private $oCtrlZenitePosicUlt;
    private $oCtrlSuntechPosicUlt;
    private $oCtrlMaxtrackPosicUlt;
    private $oCtrlMaxtrackPorta;
    private $oCtrlEnvioComando;
    private $oCtrlGooglePosicao;    
    //Fim    

    private function __construct(){
        //Início
        $this->pdo = PDOPlugin::getInstanciaPDO()->getPDO();
        $this->oCtrlEmpresa = new controladorEmpresa($this->pdo);
        $this->oCtrlClienteTipo = new controladorClienteTipo($this->pdo);
        $this->oCtrlCliente = new controladorCliente($this->pdo);
        $this->oCtrlUsuario = new controladorUsuario($this->pdo);
        $this->oCtrlUsuarioTipo = new controladorUsuarioTipo($this->pdo);
        $this->oCtrlUsuarioLog = new controladorUsuarioLog($this->pdo);
        $this->oCtrlMotorista = new controladorMotorista($this->pdo);
        $this->oCtrlServico = new controladorServico($this->pdo);
        $this->oCtrlEquipamento = new controladorEquipamento($this->pdo);
        $this->oCtrlEquipamentoTipo = new controladorEquipamentoTipo($this->pdo);
        $this->oCtrlChipGsm = new controladorChipGsm($this->pdo);
        $this->oCtrlChipGsmPlano = new controladorChipGsmPlano($this->pdo);
        $this->oCtrlOperadora = new controladorOperadora($this->pdo);
        $this->oCtrlVeiculo = new controladorVeiculo($this->pdo);
        $this->oCtrlVeiculoModelo = new controladorVeiculoModelo($this->pdo);
        $this->oCtrlVeiculoCor = new controladorVeiculoCor($this->pdo);
        $this->oCtrlVeiculoMarca = new controladorVeiculoMarca($this->pdo);
        $this->oCtrlVeiculoIcone = new controladorVeiculoIcone($this->pdo);
        $this->oCtrlCombustivel = new controladorCombustivel($this->pdo);
        $this->oCtrlPosto = new controladorPosto($this->pdo);
        $this->oCtrlViagem = new controladorViagem($this->pdo);
        $this->oCtrlInfracao = new controladorInfracao($this->pdo);
        $this->oCtrlAgenda = new controladorAgenda($this->pdo);
        $this->oCtrlPonto = new controladorPonto($this->pdo);
        $this->oCtrlPontoIcone = new controladorPontoIcone($this->pdo);
        $this->oCtrlInstalacao = new controladorInstalacao($this->pdo);
        $this->oCtrlInstalacaoCerca = new controladorInstalacaoCerca($this->pdo);
        $this->oCtrlInstalacaoRota = new controladorInstalacaoRota($this->pdo);
        $this->oCtrlInstalacaoHistorico = new controladorInstalacaoHistorico($this->pdo);
        $this->oCtrlInstalacaoManutencao = new controladorInstalacaoManutencao($this->pdo);
        $this->oCtrlInstalacaoManutencaoItem = new controladorInstalacaoManutencaoItem($this->pdo);
        $this->oCtrlCerca = new controladorCerca($this->pdo);
        $this->oCtrlCercaPTS = new controladorCercaPTS($this->pdo);
        $this->oCtrlRota = new controladorRota($this->pdo);
        $this->oCtrlRotaPTS = new controladorRotaPTS($this->pdo);
        $this->oCtrlManutencao = new controladorManutencao($this->pdo);
        $this->oCtrlQuantaPosicUlt = new controladorQuantaPosicUlt($this->pdo);
        $this->oCtrlZenitePosicUlt = new controladorZenitePosicUlt($this->pdo);
        $this->oCtrlSuntechPosicUlt = new controladorSuntechPosicUlt($this->pdo);
        $this->oCtrlMaxtrackPosicUlt = new controladorMaxtrackPosicUlt($this->pdo);
        $this->oCtrlMaxtrackPorta = new controladorMaxtrackPorta($this->pdo);
        $this->oCtrlEnvioComando = new controladorEnvioComando($this->pdo);
        $this->oCtrlGooglePosicao = new controladorGooglePosicao($this->pdo);        
        //Fim              
    }
    
    public function getIntanciaControl(){
        if (FachadaControl::$instanciaFachada == false)
            FachadaControl::$instanciaFachada = new FachadaControl();

        return FachadaControl::$instanciaFachada;  
    }

    //Início
    //Métodos da classe do controlado Empresa (delegate)
    public function autenticarUsuario($login, $senha, $ip){
        $retorno = $this->oCtrlEmpresa->autenticarUsuario($login, $senha, $ip);
        return $retorno;
    }
    
    public function listarCalcDtHrDif($dthr_fim, $dthr_ini, $data_dia){
        return $this->oCtrlEmpresa->listarCalcDtHrDif($dthr_fim, $dthr_ini, $data_dia);
    }
    
    public function listarTotalRelVeicPeriodoTrab($periodo_seg, $sql_parada){
        return $this->oCtrlEmpresa->listarTotalRelVeicPeriodoTrab($periodo_seg, $sql_parada);
    }
    
    public function listarTotalRelOperacao($value){
        return $this->oCtrlEmpresa->listarTotalRelOperacao($value);
    }
    
    //Métodos da classe do controlador Cliente Tipo    
    public function inserirClienteTipo($oClienteTipo){
        $this->oCtrlClienteTipo->inserirClienteTipo($oClienteTipo);
    }
    
    public function alterarClienteTipo($oClienteTipo){
        $this->oCtrlClienteTipo->alterarClienteTipo($oClienteTipo);
    }
    
    public function listarClienteTipo(){
        return $this->oCtrlClienteTipo->listarClienteTipo();
    }
    
    public function listarClienteTipoId($id){        
        return $this->oCtrlClienteTipo->listarClienteTipoId($id);
    }
    
    public function removerClienteTipo($id){
        $this->oCtrlClienteTipo->removerClienteTipo($id);        
    }
    
    //Métodos da classe do controlador Cliente
    public function inserirCliente($oCliente){
        $this->oCtrlCliente->inserirCliente($oCliente);        
    }
    
    public function alterarCliente($oCliente){
        $this->oCtrlCliente->alterarCliente($oCliente);        
    }
    
    public function removerCliente($id){
        $this->oCtrlCliente->removerCliente($id);        
    }
    
    public function listarCliente(){
        return $this->oCtrlCliente->listarCliente();        
    }
    
    public function listarClienteId($id){        
        return $this->oCtrlCliente->listarClienteId($id);
    }
    
    public function listarClienteSelect(){
        return $this->oCtrlCliente->listarClienteSelect();
    }
    
    public function listarClienteNivel(){
        return $this->oCtrlCliente->listarClienteNivel();
    }
    
    public function listarClienteJSON($s_cli_id){
        return $this->oCtrlCliente->listarClienteJSON($s_cli_id);
    }    
    
    public function validarCliente($params){
        return $this->oCtrlCliente->validarCliente($params);
    }
    
    //Métodos da classe do controlador Usuário
    public function inserirUsuario($oUsuario){
        return $this->oCtrlUsuario->inserirUsuario($oUsuario);
    }
    
    public function alterarUsuario($oUsuario){
        $this->oCtrlUsuario->alterarUsuario($oUsuario);        
    }
    
    public function alterarSenhaUsuario($oUsuario){
        $this->oCtrlUsuario->alterarSenhaUsuario($oUsuario);        
    }
    
    public function removerUsuario($id){
        $this->oCtrlUsuario->removerUsuario($id);        
    }
    
    public function listarUsuario($iCliente){
        return $this->oCtrlUsuario->listarUsuario($iCliente);
    }
    
    public function listarUsuarioId($id){        
        return $this->oCtrlUsuario->listarUsuarioId($id);
    }
    
    public function listarUsuarioMonitor(){
        return $this->oCtrlUsuario->listarUsuarioMonitor();
    }
    
    public function validarUsuario($params){
        return $this->oCtrlUsuario->validarUsuario($params);
    }
    
    //Métodos da classe do controlador Usuário Tipo
    public function inserirUsuarioTipo($oUsuarioTipo){
        $this->oCtrlUsuarioTipo->inserirUsuarioTipo($oUsuarioTipo);        
    }
    
    public function alterarUsuarioTipo($oUsuarioTipo){
        $this->oCtrlUsuarioTipo->alterarUsuarioTipo($oUsuarioTipo);        
    }
    
    public function removerUsuarioTipo($id){
        return $this->oCtrlUsuarioTipo->removerUsuarioTipo($id);        
    }
    
    public function listarUsuarioTipo(){
        return $this->oCtrlUsuarioTipo->listarUsuarioTipo();
    }
    
    public function listarUsuarioTipoId($id){
        return $this->oCtrlUsuarioTipo->listarUsuarioTipoId($id);
    }
    
    public function validarUsuarioTipo($aParams){
        return $this->oCtrlUsuarioTipo->validarUsuarioTipo($aParams);
    }
    
    //Métodos da classe do controlador Usuário Log
    public function inserirUsuarioLog($oUsuarioLog){
        $this->oCtrlUsuarioLog->inserirUsuarioLog($oUsuarioLog);        
    }    
    
    public function removerUsuarioLog($id){
        $this->oCtrlUsuarioLog->removerUsuarioLog($id);        
    }
    
    public function listarUsuarioLog(){
        return $this->oCtrlUsuarioLog->listarUsuarioLog();
    }
    
    public function listarUsuarioLogId($id){        
        return $this->oCtrlUsuarioLog->listarUsuarioLogId($id);
    }
    
    public function listarUsuarioAcesso() {
        return $this->oCtrlUsuarioLog->listarUsuarioAcesso();
    }

    //Métodos da classe do controlador Motorista
    public function inserirMotorista($oMotorista){
        $this->oCtrlMotorista->inserirMotorista($oMotorista);        
    }
    
    public function alterarMotorista($oMotorista){
        $this->oCtrlMotorista->alterarMotorista($oMotorista);        
    }
    
    public function removerMotorista($id){
        $this->oCtrlMotorista->removerMotorista($id);        
    }
    
    public function listarMotorista($iCliente){
        return $this->oCtrlMotorista->listarMotorista($iCliente);
    }
    
    public function listarMotoristaId($id){        
        return $this->oCtrlMotorista->listarMotoristaId($id);
    }
    
    public function listarMotoristaPorCliente($cli_id = "0"){
        return $this->oCtrlMotorista->listarMotoristaPorCliente($cli_id);
    }

	//Métodos da classe do controlador Servico
    public function inserirServico($oServico){
        $this->oCtrlServico->inserirServico($oServico);    
    }
    
    public function alterarServico($oServico){
        $this->oCtrlServico->alterarServico($oServico);        
    }
    
      public function listarServico(){
        return $this->oCtrlServico->listarServico();  
    }
      public function listarServicoId($id){        
        return $this->oCtrlServico->listarServicoId($id);
    } 
      public function removerServico($id){
        $this->oCtrlServico->removerServico($id);        
    }
    
    // Métodos da classe do controlador  Equipamento   
    public function inserirEquipamento($oCtrlEquipamento) {
        $this->oCtrlEquipamento->inserirEquipamento($oCtrlEquipamento);
    }
    
    public function alterarEquipamento($oCtrlEquipamento) {
        $this->oCtrlEquipamento->alterarEquipamento($oCtrlEquipamento);
    }
    
    public function removerEquipamento($id) {
        $this->oCtrlEquipamento->removerEquipamento($id);
    }
    
    public function listarEquipamento () {
        return $this->oCtrlEquipamento->listarEquipamento();
    }
    
    public function listarEquipamentoPorId($id) {
        return $this->oCtrlEquipamento->listarEquipamentoPorId($id); 
    }
    
    public function listarEquipamentoPorInstalacao($inst_id = "0", $acao) {
        return $this->oCtrlEquipamento->listarEquipamentoPorInstalacao($inst_id, $acao);
    }
    
    public function validarEquipamento($params){
        return $this->oCtrlEquipamento->validarEquipamento($params);
    }

    // Métodos da classe do controlador Equipamento Tipo
    public function inserirEquipamentoTipo($oEquipamentoTipo) {
        $this->oCtrlEquipamentoTipo->inserirEquipamentoTipo($oEquipamentoTipo);
    }
    
    public function alterarEquipamentoTipo($oEquipamentoTipo) {
        $this->oCtrlEquipamentoTipo->alterarEquipamentoTipo($oEquipamentoTipo);
    }
    
    public function removerEquipamentoTipo($id) {
        $this->oCtrlEquipamentoTipo->removerEquipamentoTipo($id);
    }
    
    public function listarEquipamentoTipo() {
        return $this->oCtrlEquipamentoTipo->listarEquipamentoTipo();
    }
    
    public function listarEquipamentoTipoId($id) {
        return $this->oCtrlEquipamentoTipo->listarEquipamentoTipoId($id); 
    }
    
    public function validarEquipamentoTipo($params){
        return $this->oCtrlEquipamentoTipo->validarEquipamentoTipo($params);
    }
    
    // Métodos da classe do controlador chip
    public function inserirChipGsm($oCtrlChipGsm) {
        $this->oCtrlChipGsm->inserirChipGsm($oCtrlChipGsm);
    }
     
    public function alterarChipGsm($oCtrlChipGsm){
        $this->oCtrlChipGsm->alterarChipGsm($oCtrlChipGsm);
    }
    
    public function removerChipGsm($id) {
        $this->oCtrlChipGsm->removerChipGsm($id);
    }

    public function listarChipGsm() {
        return $this->oCtrlChipGsm->listarChipGsm();
    }
    
    public function listarChipGsmPorId($id) {
        return $this->oCtrlChipGsm->listarChipGsmPorId($id);
    }
    
    public function listarChipNaoCad($tipo) {
        return $this->oCtrlChipGsm->listarChipNaoCad($tipo);
    }
    
    // Métodos da classe do controlador ChipGsmPlano
    public function inserirChipGsmPlano($oCtrlChipGsmPlano) {
        $this->oCtrlChipGsmPlano->inserirChipGsmPlano($oCtrlChipGsmPlano);
    }

    public function alterarChipGsmPlano($oCtrlChipGsmPlano) {
        $this->oCtrlChipGsmPlano->alterarChipGsmPlano($oCtrlChipGsmPlano);
    }
    
    public function removerChipGsmPlano($id) {
        $this->oCtrlChipGsmPlano->removerChipGsmPlano($id);                
    }
    
    public function listarChipGsmPlano() {
        return $this->oCtrlChipGsmPlano->listarChipGsmPlano();
    }
   
    public function listarChipGsmPlanoPorId($id) {
        return $this->oCtrlChipGsmPlano->listarChipGsmPlanoPorId($id);
    }
    
    // Métodos da classe do controlador Operadora
    public function listarOperadora() {
        return $this->oCtrlOperadora->listarOperadora();
    }
    
    public function listarOperadoraPorId($id) {
        return $this->oCtrlOperadora->listarOperadoraPorId($id);
    }
    
    public function inserirOperadora($oCtrlOperadora) {
        $this->oCtrlOperadora->inserirOperadora($oCtrlOperadora);
    }
    
    public function alterarOperadora($oCtrlOperadora) {
        $this->oCtrlOperadora->alterarOperadora($oCtrlOperadora);
    }
    
    public function removerOperadora($id) {
        $this->oCtrlOperadora->removerOperadora($id);
    }
    
    // Métodos da classe do controldar Veiculo
    public function inserirVeiculo($oVeiculo) {
        $this->oCtrlVeiculo->inserirVeiculo($oVeiculo);
    }
    
    public function alterarVeiculo($oVeiculo) {
        $this->oCtrlVeiculo->alterarVeiculo($oVeiculo);
    }
    
    public function removerVeiculo($id) {
        $this->oCtrlVeiculo->removerVeiculo($id);
    }
    
    public function listarveiculo($iCliente){
        return $this->oCtrlVeiculo->listarVeiculo($iCliente);
    }
    
    public function listarVeiculoPorId($id) {
        return $this->oCtrlVeiculo->listarVeiculoPorId($id);
    }
    
    public function listarVeiculoPorInstalacao($cli_id = "0", $inst_id = "0", $acao) {
        return $this->oCtrlVeiculo->listarVeiculoPorInstalacao($cli_id, $inst_id, $acao);
    }
    
    // Métodos da classe do controlador Veiculo Modelo    
    public function inserirVeiculoModelo($oVeiculoModelo) {
        $this->oCtrlVeiculoModelo->inserirVeiculoModelo($oVeiculoModelo);
    }
    
    public function alterarVeiculoModelo($oVeiculoModelo) {
        $this->oCtrlVeiculoModelo->alterarVeiculoModelo($oVeiculoModelo);
    }
    
    public function removerVeiculoModelo($id) {
        $this->oCtrlVeiculoModelo->removerVeiculoModelo($id);
    }
    
    public function listarVeiculoModelo() {
        return $this->oCtrlVeiculoModelo->listarVeiculoModelo();
    }
    
    public function listarVeiculoModeloPorId($id) {
        return $this->oCtrlVeiculoModelo->listarVeiculoModeloPorId($id); 
    }
    
    
      // Métodos da classe do controlador Veiculo Cor    
    public function inserirVeiculoCor($oVeiculoCor) {
        $this->oCtrlVeiculoCor->inserirVeiculoCor($oVeiculoCor);
    }
    
    public function alterarVeiculoCor($oVeiculoCor) {
        $this->oCtrlVeiculoCor->alterarVeiculoCor($oVeiculoCor);
    }
    
    public function removerVeiculoCor($id) {
        $this->oCtrlVeiculoCor->removerVeiculoCor($id);
    }
    
    public function listarVeiculoCor() {
        return $this->oCtrlVeiculoCor->listarVeiculoCor();
    }
    
    public function listarVeiculoCorPorId($id) {
        return $this->oCtrlVeiculoCor->listarVeiculoCorPorId($id); 
    }
    
    
     // Métodos da classe do controldar Veiculo Marca
    public function inserirVeiculoMarca($oVeiculoMarca) {
        $this->oCtrlVeiculoMarca->inserirVeiculoMarca($oVeiculoMarca);
    }
    
    public function alterarVeiculoMarca($oVeiculoMarca) {
        $this->oCtrlVeiculoMarca->alterarVeiculoMarca($oVeiculoMarca);
    }
    
    public function removerVeiculoMarca($id) {
        $this->oCtrlVeiculoMarca->removerVeiculoMarca($id);
    }
    
    public function listarVeiculoMarca() {
        return $this->oCtrlVeiculoMarca->listarVeiculoMarca();
    }
    
    public function listarVeiculoMarcaPorId($id) {
        return $this->oCtrlVeiculoMarca->listarVeiculoMarcaPorId($id);
    }    

    // Métodos da classe do controldar VeiculoIcone
    public function inserirVeiculoIcone($oVeiculoIcone) {
        $this->oCtrlVeiculoIcone->inserirVeiculoIcone($oVeiculoIcone);
    }
    
    public function alterarVeiculoIcone($oVeiculoIcone) {
        $this->oCtrlVeiculoIcone->alterarVeiculoIcone($oVeiculoIcone);
    }
    
    public function removerVeiculoIcone($id) {
        $this->oCtrlVeiculoIcone->removerVeiculoIcone($id);
    }
    
    public function listarVeiculoIcone(){
        return $this->oCtrlVeiculoIcone->listarVeiculoIcone();
    }
    
    public function listarVeiculoIconePorId($id) {
        return $this->oCtrlVeiculoIcone->listarVeiculoIconePorId($id);
    }
    
    // métodos Posto de gasolina
    public function inserirPosto($oPosto) {
        $this->oCtrlPosto->inserirPosto($oPosto);
    }
    
    public function alterarPosto($oPosto) {
        $this->oCtrlPosto->alterarPosto($oPosto);
    }
    
    public function removerPosto($id) {
        $this->oCtrlPosto->removerPosto($id);
    }
    
    public function listarPosto() {
        return $this->oCtrlPosto->listarPosto();
    }
    
    public function listarPostoPorId($id) {
        return $this->oCtrlPosto->listarPostoPorId($id);
    }
    
    // Métodos da classe do controldar Combustível    
    public function inserirCombustivel($oCombustivel){
        $this->oCtrlCombustivel->inserirCombustivel($oCombustivel);
    }
    
    public function alterarCombustivel($oCombustivel){
        $this->oCtrlCombustivel->alterarCombustivel($oCombustivel);
    }
    
    public function removerCombustivel($oCombustivel){
        $this->oCtrlCombustivel->removerCombustivel($oCombustivel);
    }
    
    public function listarCombustivel(){
        return $this->oCtrlCombustivel->listarCombustivel();
    }
    
    public function listarCombustivelPorId($id){
        return $this->oCtrlCombustivel->listarCombustivelPorId($id);
    }
    
    public function listarHodometroPorId($id) {
        return $this->oCtrlCombustivel->listarHodometroPorId($id);
    }
       
    public function listarUltimoOdometro($id) {
        return $this->oCtrlCombustivel->listarUltimoOdometro($id);
    }
        
    public function listarCombustivelPorVeiculo($id){
        return $this->oCtrlCombustivel->listarCombustivelPorVeiculo($id);
    }
    
    public function listarCombustivelPorCliente($id) {
        return $this->oCtrlCombustivel->listarCombustivelPorCliente($id);
    }
    
    public function filtroClienteCombustivel() {
        return $this->oCtrlCombustivel->filtroClienteCombustivel();
    }
    
    public function filtroCombustivelVeiculoInstalado($cli) {
        return $this->oCtrlCombustivel->filtroCombustivelVeiculoInstalado($cli);
    }
    
    public function listarHistoricoPorData($inst_id, $dtInicial, $dtFinal) {
        return $this->oCtrlCombustivel->listarHistoricoPorData($inst_id, $dtInicial, $dtFinal);
    }
    
    public function listarHistoricoPorCliente($cli_id, $dtInicial, $dtFinal) {
        return $this->oCtrlCombustivel->listarHistoricoPorCliente($cli_id, $dtInicial, $dtFinal);
    }
    
    // Métodos da classe controlador de viagem
    public function inserirViagem($oViagem) {
        $this->oCtrlViagem->inserirViagem($oViagem);
    }
    
    public function alterarViagem($oViagem) {
        $this->oCtrlViagem->alterarViagem($oViagem);
    }
    
    public function removerViagem($id) {
        $this->oCtrlViagem->removerViagem($id);
    }
    
    public function listarViagem($cli) {
        return $this->oCtrlViagem->listarViagem($cli);
    }
    
    public function listarViagemPorId($id) {
        return $this->oCtrlViagem->listarViagemPorId($id);
    }
    
    // Métodos da classe de controlador de infração
    public function inserirInfracao($oInfracao) {
        $this->oCtrlInfracao->inserirInfracao($oInfracao);
    }
    
    public function alterarInfracao($oInfracao) {
        $this->oCtrlInfracao->alterarInfracao($oInfracao);
    }
    
    public function removerInfracao($id) {
        $this->oCtrlInfracao->removerInfracao($id);
    }
    
    public function listarInfracao() {
        return $this->oCtrlInfracao->listarInfracao();
    }
    
    public function listarInfracaoPorId($id) {
        return $this->oCtrlInfracao->listarInfracaoPorId($id);
    }
    
    public function listarTabelaInfracao() {
        return $this->oCtrlInfracao->listarTabelaInfracao();
    }
    
    public function listarTabelaInfracaoPorId($cod) {
        return $this->oCtrlInfracao->listarTabelaInfracaoPorId($cod);
    }
    
    public function listarInfracaoPorCli($cli) {
        return $this->oCtrlInfracao->listarInfracaoPorCli($cli);
    }

    // Métodos da classe do controldar Agenda    
    public function inserirAgenda($oAgenda) {
        $this->oCtrlAgenda->inserirAgenda($oAgenda);
    }
    
    public function alterarAgenda($oAgenda) {
        $this->oCtrlAgenda->alterarAgenda($oAgenda);
    }
    
    public function removerAgenda($id) {
        $this->oCtrlAgenda->removerAgenda($id);
    }
    
    public function listarAgenda() {
        return $this->oCtrlAgenda->listarAgenda();
    }
    
    public function listarAgendaPorId($id) {
        return $this->oCtrlAgenda->listarAgendaPorId($id);
    }
    
    //Métodos da classe do controlador Ponto
    public function inserirPonto($oPonto){
        $this->oCtrlPonto->inserirPonto($oPonto);
    }
    
    public function alterarPonto($oPonto){
        $this->oCtrlPonto->alterarPonto($oPonto);        
    }
    
    public function removerPonto($id){
        $this->oCtrlPonto->removerPonto($id);        
    }
    
    public function listarPonto(){
        return $this->oCtrlPonto->listarPonto();
    }
    
    public function listarPontoId($id){        
        return $this->oCtrlPonto->listarPontoId($id);
    }
    
    public function listarPontoJson(){
        return $this->oCtrlPonto->listarPontoJson();
    }
    
    public function listarPontoProximoPorCliente($cli_id, $lat, $lon){
        return $this->oCtrlPonto->listarPontoProximoPorCliente($cli_id, $lat, $lon);
    }
    
    public function listarPontoProximoPorCidade($lat, $lon){
        return $this->oCtrlPonto->listarPontoProximoPorCidade($lat, $lon);
    }
    
    public function listarPontoProximo($lat, $lon){
        return $this->oCtrlPonto->listarPontoProximo($lat, $lon);
    }
    
    public function validarPonto($params){
        return $this->oCtrlPonto->validarPonto($params);
    }
    
    //Métodos da classe do controlador Ponto Icone
    public function inserirPontoIcone($oPontoIcone){
        $this->oCtrlPontoIcone->inserirPontoIcone($oPontoIcone);        
    }
    
    public function alterarPontoIcone($oPontoIcone){
        $this->oCtrlPontoIcone->alterarPontoIcone($oPontoIcone);        
    }
    
    public function removerPontoIcone($id){
        $this->oCtrlPontoIcone->removerPontoIcone($id);        
    }
    
    public function listarPontoIcone(){
        return $this->oCtrlPontoIcone->listarPontoIcone();
    }
    
    public function listarPontoIconeId($id){        
        return $this->oCtrlPontoIcone->listarPontoIconeId($id);
    }
    
    public function listarPontoIconeFrameVeiculoGrid(){
        return $this->oCtrlPontoIcone->listarPontoIconeFrameVeiculoGrid();
    }
    
    public function listarPontoIconeFrameVeiculoGridMapa(){
        return $this->oCtrlPontoIcone->listarPontoIconeFrameVeiculoGridMapa();
    }    
    
    public function validarPontoIcone($params){
        return $this->oCtrlPontoIcone->validarPontoIcone($params);
    }
    
    //Métodos da classe do controlador Instalação
    public function inserirInstalacao($oInstalacao){
        $this->oCtrlInstalacao->inserirInstalacao($oInstalacao);        
    }
    
    public function alterarInstalacao($oInstalacao, $tipo = ""){
        $this->oCtrlInstalacao->alterarInstalacao($oInstalacao, $tipo);        
    }
    
    public function removerInstalacao($id){
       return $this->oCtrlInstalacao->removerInstalacao($id);        
    }
    
    public function listarInstalacao($cli_id = "0"){
        return $this->oCtrlInstalacao->listarInstalacao($cli_id);
    }
    
    public function listarInstalacaoId($id){        
        return $this->oCtrlInstalacao->listarInstalacaoId($id);
    }
    
    public function listarInstalacaoJsonEvento(){
        return $this->oCtrlInstalacao->listarInstalacaoJsonEvento();
    }
    
    public function listarInstalacaoJsonGridInferior($aParams){
        return $this->oCtrlInstalacao->listarInstalacaoJsonGridInferior($aParams);
    }
    
    public function listarInstalacaoJsonGridMapa($aParams){
        return $this->oCtrlInstalacao->listarInstalacaoJsonGridMapa($aParams);
    }    
    
    public function listarInstalacaoTotalJsonEvento(){
        return $this->oCtrlInstalacao->listarInstalacaoTotalJsonEvento();
    }
    
    public function listarInstalacaoFrameSOS($inst_id){
        return $this->oCtrlInstalacao->listarInstalacaoFrameSOS($inst_id);
    }
    
    public function listarInstalacaoFrameCERCAIN($inst_id){
        return $this->oCtrlInstalacao->listarInstalacaoFrameCARCAIN($inst_id);
    }
    
    public function listarInstalacaoFrameCERCAOUT($inst_id){
        return $this->oCtrlInstalacao->listarInstalacaoFrameCARCAOUT($inst_id);
    }
    
    public function listarInstalacaoFrameGridMapa($inst_id){
        return $this->oCtrlInstalacao->listarInstalacaoFrameGridMapa($inst_id);
    }
    
    public function listarInstalacaoFrameGridComando($inst_id){
        return $this->oCtrlInstalacao->listarInstalacaoFrameGridComando($inst_id);
    }
    
    public function listarInstalacaoEnviarComando($inst_id, $tipo){
        return $this->oCtrlInstalacao->listarInstalacaoEnviarComando($inst_id, $tipo);
    }
    
    public function listarInstalacaoSalvaProcedimento($inst_id, $tipo){
        return $this->oCtrlInstalacao->listarInstalacaoSalvaProcedimento($inst_id, $tipo);
    }
    
    public function listarInstalacaoPorCliente($cli_id){
        return $this->oCtrlInstalacao->listarInstalacaoPorCliente($cli_id);
    }
    
    public function listarInstalacaoPorClienteCerca($cli_id, $cerca_id){
        return $this->oCtrlInstalacao->listarInstalacaoPorClienteCerca($cli_id, $cerca_id);
    }
    
    public function listarInstalacaoPorClienteRota($cli_id, $rota_id){
        return $this->oCtrlInstalacao->listarInstalacaoPorClienteRota($cli_id, $rota_id);
    }
    
    public function listarInstalacaoRelVeiculo($aParams){
        return $this->oCtrlInstalacao->listarInstalacaoRelVeiculo($aParams);
    }
    
    public function listarInstalacaoRelVeiculoPosicao($aParams){
        return $this->oCtrlInstalacao->listarInstalacaoRelVeiculoPosicao($aParams);
    }

    public function listarInstalacaoRelCliVeiculo(){
        return $this->oCtrlInstalacao->listarInstalacaoRelCliVeiculo();
    }
    
    public function listarInstalacaoRelOperacao($aParams){
        return $this->oCtrlInstalacao->listarInstalacaoRelOperacao($aParams);
    }
    
    public function listarInstalacaoRelHistoricoInst($aParams){
        return $this->oCtrlInstalacao->listarInstalacaoRelHistoricoInst($aParams);
    }
    
    public function validarInstalacao($params){
        return $this->oCtrlInstalacao->validarInstalacao($params);
    }
    
    //Métodos da classe do controlador Instalação Cerca
    public function inserirInstalacaoCerca($oInstalacaoCerca){
        $this->oCtrlInstalacaoCerca->inserirInstalacaoCerca($oInstalacaoCerca);        
    }
    
    public function alterarInstalacaoCerca($oInstalacaoCerca){
        $this->oCtrlInstalacaoCerca->alterarInstalacaoCerca($oInstalacaoCerca);        
    }
    
    public function removerInstalacaoCerca($id){
        $this->oCtrlInstalacaoCerca->removerInstalacaoCerca($id);        
    }
    
    public function excluirInstalacaoCerca($id){
        $this->oCtrlInstalacaoCerca->excluirInstalacaoCerca($id);        
    }
    
    public function listarInstalacaoCerca(){
        return $this->oCtrlInstalacaoCerca->listarInstalacaoCerca();
    }
    
    public function listarInstalacaoCercaId($id){        
        return $this->oCtrlInstalacaoCerca->listarInstalacaoCercaId($id);
    }
    
    public function listarInstalacaoCercaDentroFora($idInstalacao, $dthrServer){
        return $this->oCtrlInstalacaoCerca->listarInstalacaoCercaDentroFora($idInstalacao, $dthrServer);
    }

    public function listarInstalacaoCercaTipo(){
        return $this->oCtrlInstalacaoCerca->listarInstalacaoCercaTipo();
    }
    
    //Métodos da classe do controlador Instalação Rota
    public function inserirInstalacaoRota($oInstalacaoRota){
        $this->oCtrlInstalacaoRota->inserirInstalacaoRota($oInstalacaoRota);
    }
    
    public function alterarInstalacaoRota($oInstalacaoRota){
        $this->oCtrlInstalacaoRota->alterarInstalacaoRota($oInstalacaoRota);
    }
    
    public function removerInstalacaoRota($id){
        $this->oCtrlInstalacaoRota->removerInstalacaoRota($id);
    }
    
    public function excluirInstalacaoRota($id){
        $this->oCtrlInstalacaoRota->excluirInstalacaoRota($id);
    }
    
    public function listarInstalacaoRota(){
        return $this->oCtrlInstalacaoRota->listarInstalacaoRota();
    }
    
    public function listarInstalacaoRotaId($id){
        return $this->oCtrlInstalacaoRota->listarInstalacaoRotaId($id);
    }
    
    //Métodos da classe do controlador Instalação Histórico (Observação)
    public function inserirInstalacaoHistorico($oInstalacaoHistorico){
        $this->oCtrlInstalacaoHistorico->inserirInstalacaoHistorico($oInstalacaoHistorico);        
    }
    
    public function alterarInstalacaoHistorico($oInstalacaoHistorico){
        $this->oCtrlInstalacaoHistorico->alterarInstalacaoHistorico($oInstalacaoHistorico);        
    }
    
    public function removerInstalacaoHistorico($id){
        $this->oCtrlInstalacaoHistorico->removerInstalacaoHistorico($id);        
    }
    
    public function listarInstalacaoHistorico($inst_id){
        return $this->oCtrlInstalacaoHistorico->listarInstalacaoHistorico($inst_id);
    }
    
    public function listarInstalacaoHistoricoId($id){        
        return $this->oCtrlInstalacaoHistorico->listarInstalacaoHistoricoId($id);
    }
    
    //Métodos da classe do controlador Instalação Manutenção
    public function inserirInstalacaoManutencao($oInstalacaoManutencao){
        $manu_id = $this->oCtrlInstalacaoManutencao->inserirInstManutencao($oInstalacaoManutencao);
        
        try{
            $this->inserirInstalacaoManutencaoItem($manu_id, $oInstalacaoManutencao->getItens_colection());
        }  catch (Exception $e) {
            $this->removerInstalacaoManutencao($manu_id);
        }
    }
    
    public function alterarInstalacaoManutencao($oInstalacaoManutencao){
        $this->oCtrlInstalacaoManutencao->alterarInstManutencao($oInstalacaoManutencao);        
    }
    
    public function removerInstalacaoManutencao($id){
        $this->oCtrlInstalacaoManutencao->removerInstManutencao($id);        
    }
    
    public function listarInstalacaoManutencao($cli_id = "0", $tipo){
        return $this->oCtrlInstalacaoManutencao->listarInstManutencao($cli_id, $tipo);
    }
    
    public function listarInstalacaoManutencaoId($id){        
        return $this->oCtrlInstalacaoManutencao->listarInstManutencaoId($id);
    }
    
    //Métodos da classe de controle de instalação manutenção item
    public function inserirInstalacaoManutencaoItem($manu_id = "0", $aItens){
        if($manu_id == "0" || $aItens == NULL || empty($aItens)){
            trows_exception("Erro ao inserir itens de manutenção");
        }else{
            $this->oCtrlInstalacaoManutencaoItem->inserirInstManutencaoItem($manu_id, $aItens);
        }
        
    }
    
    public function removerInstalacaoMenutencaoItem($manu_id){
        $this->oCtrlInstalacaoManutencaoItem->removerInstManutencaoItem($manu_id);
    }
    
    public function listarInstalacaoManutencaoItem($manu_id){
        $this->oCtrlInstalacaoManutencaoItem->listarInstManutencaoItem($manu_id);
    }


        //Métodos da classe do controlador Cerca
    public function inserirCerca($oCerca){
        return $this->oCtrlCerca->inserirCerca($oCerca);
    }
    
    public function alterarCerca($oCerca){
        $this->oCtrlCerca->alterarCerca($oCerca);
    }
    
    public function removerCerca($id){
        $this->oCtrlCerca->removerCerca($id);
    }
    
    public function listarCerca(){
        return $this->oCtrlCerca->listarCerca();
    }
    
    public function listarCercaId($id){
        return $this->oCtrlCerca->listarCercaId($id);
    }
    
    public function listarCercaIdsPorInst($inst_ids){
        return $this->oCtrlCerca->listarCercaIds($inst_ids);
    }
    
    public function validarCerca($params){
        return $this->oCtrlCerca->validarCerca($params);
    }
    
    //Métodos da classe do controlador Cerca PTS
    public function inserirCercaPTS($oCercaPTS){
        $this->oCtrlCercaPTS->inserirCercaPTS($oCercaPTS);        
    }
    
    public function alterarCercaPTS($oCercaPTS){
        $this->oCtrlCercaPTS->alterarCercaPTS($oCercaPTS);        
    }
    
    public function removerCercaPTS($id){
        $this->oCtrlCercaPTS->removerCercaPTS($id);        
    }
    
    public function listarCercaPTS($inst_id){
        return $this->oCtrlCercaPTS->listarCercaPTS($inst_id);
    }
    
    public function listarCercaPTSPorId($id){        
        return $this->oCtrlCercaPTS->listarCercaPTSPorId($id);
    }
    
    public function listarCercaPTSPorCerca($idCerca){
        return $this->oCtrlCercaPTS->listarCercaPTSPorCerca($idCerca);
    }
    
    //Métodos da classe do controlador Rota
    public function inserirRota($oRota){
        return $this->oCtrlRota->inserirRota($oRota);
    }
    
    public function alterarRota($oRota){
        $this->oCtrlRota->alterarRota($oRota);
    }
    
    public function removerRota($id){
        $this->oCtrlRota->removerRota($id);
    }
    
    public function listarRota(){
        return $this->oCtrlRota->listarRota();
    }
    
    public function listarRotaId($id){
        return $this->oCtrlRota->listarRotaId($id);
    }
    
    public function validarRota($params){
        return $this->oCtrlRota->validarRota($params);
    }
    
    //Métodos da classe do controlador Rota PTS
    public function inserirRotaPTS($oRotaPTS){
        $this->oCtrlRotaPTS->inserirRotaPTS($oRotaPTS);        
    }
    
    public function alterarRotaPTS($oRotaPTS){
        $this->oCtrlRotaPTS->alterarRotaPTS($oRotaPTS);        
    }
    
    public function removerRotaPTS($id){
        $this->oCtrlRotaPTS->removerRotaPTS($id);        
    }
    
    public function listarRotaPTS($inst_id){
        return $this->oCtrlRotaPTS->listarRotaPTS($inst_id);
    }
    
    public function listarRotaPTSPorId($id){        
        return $this->oCtrlRotaPTS->listarRotaPTSPorId($id);
    }
    
    public function listarRotaPTSPorRota($idRota){
        return $this->oCtrlRotaPTS->listarRotaPTSPorRota($idRota);
    }
    
    //Métodos da classe do controlador Manutenção
    public function inserirManutencao($oManutencao){
        $this->oCtrlManutencao->inserirManutencao($oManutencao);        
    }
    
    public function alterarManutencao($oManutencao){
        $this->oCtrlManutencao->alterarManutencao($oManutencao);        
    }
    
    public function removerManutencao($id){
        $this->oCtrlManutencao->removerManutencao($id);        
    }
    
    public function listarManutencao($iCliente){
        return $this->oCtrlManutencao->listarManutencao($iCliente);
    }
    
    public function listarManutencaoId($id){        
        return $this->oCtrlManutencao->listarManutencaoId($id);
    }
    
    public function listarManutencaoJson(){
        return $this->oCtrlManutencao->listarManutencaoJson();
    }
    
    //Métodos da classe do controlador Quanta Posic ULT
    public function inserirQuantaPosicUlt($oQuantaPosicUlt){
        $this->oCtrlQuantaPosicUlt->inserirQuantaPosicUlt($oQuantaPosicUlt);        
    }
    
    public function alterarQuantaPosicUlt($oQuantaPosicUlt, $tipo = ""){
        $this->oCtrlQuantaPosicUlt->alterarQuantaPosicUlt($oQuantaPosicUlt, $tipo);
    }
    
    public function removerQuantaPosicUlt($id){
        $this->oCtrlQuantaPosicUlt->removerQuantaPosicUlt($id);        
    }
    
    public function listarQuantaPosicUlt($iCliente){
        return $this->oCtrlQuantaPosicUlt->listarQuantaPosicUlt($iCliente);
    }
    
    public function listarQuantaPosicUltId($id){        
        return $this->oCtrlQuantaPosicUlt->listarQuantaPosicUltId($id);
    }
    
    public function listarQuantaPosicUltInstalacao($inst_id){
        return $this->oCtrlQuantaPosicUlt->listarQuantaPosicUltInstalacao($inst_id);
    }
    
    //Métodos da classe do controlador Zenite Posic ULT
    public function inserirZenitePosicUlt($oZenitePosicUlt){
        $this->oCtrlZenitePosicUlt->inserirZenitePosicUlt($oZenitePosicUlt);        
    }
    
    public function alterarZenitePosicUlt($oZenitePosicUlt, $tipo = ""){
        $this->oCtrlZenitePosicUlt->alterarZenitePosicUlt($oZenitePosicUlt, $tipo);
    }
    
    public function removerZenitePosicUlt($id){
        $this->oCtrlZenitePosicUlt->removerZenitePosicUlt($id);        
    }
    
    public function listarZenitePosicUlt($iCliente){
        return $this->oCtrlZenitePosicUlt->listarZenitePosicUlt($iCliente);
    }
    
    public function listarZenitePosicUltId($id){        
        return $this->oCtrlZenitePosicUlt->listarZenitePosicUltId($id);
    }
    
    public function listarZenitePosicUltInstalacao($inst_id){
        return $this->oCtrlZenitePosicUlt->listarZenitePosicUltInstalacao($inst_id);
    }
    
    //Métodos da classe do controlador Suntech Posic ULT
    public function inserirSuntechPosicUlt($oSuntechPosicUlt){
        $this->oCtrlSuntechPosicUlt->inserirSuntechPosicUlt($oSuntechPosicUlt);        
    }
    
    public function alterarSuntechPosicUlt($oSuntechPosicUlt, $tipo = ""){
        $this->oCtrlSuntechPosicUlt->alterarSuntechPosicUlt($oSuntechPosicUlt, $tipo);
    }
    
    public function removerSuntechPosicUlt($id){
        $this->oCtrlSuntechPosicUlt->removerSuntechPosicUlt($id);        
    }
    
    public function listarSuntechPosicUlt($iCliente){
        return $this->oCtrlSuntechPosicUlt->listarSuntechPosicUlt($iCliente);
    }
    
    public function listarSuntechPosicUltId($id){        
        return $this->oCtrlSuntechPosicUlt->listarSuntechPosicUltId($id);
    }
    
    public function listarSuntechPosicUltInstalacao($inst_id){
        return $this->oCtrlSuntechPosicUlt->listarSuntechPosicUltInstalacao($inst_id);
    }
    
    //Métodos da classe do controlador Maxtrack Posic ULT
    public function inserirMaxtrackPosicUlt($oMaxtrackPosicUlt){
        $this->oCtrlMaxtrackPosicUlt->inserirMaxtrackPosicUlt($oMaxtrackPosicUlt);        
    }
    
    public function alterarMaxtrackPosicUlt($oMaxtrackPosicUlt, $tipo = ""){
        $this->oCtrlMaxtrackPosicUlt->alterarMaxtrackPosicUlt($oMaxtrackPosicUlt, $tipo);
    }
    
    public function removerMaxtrackPosicUlt($id){
        $this->oCtrlMaxtrackPosicUlt->removerMaxtrackPosicUlt($id);        
    }
    
    public function listarMaxtrackPosicUlt(){
        return $this->oCtrlMaxtrackPosicUlt->listarMaxtrackPosicUlt();
    }
    
    public function listarMaxtrackPosicUltId($id){        
        return $this->oCtrlMaxtrackPosicUlt->listarMaxtrackPosicUltId($id);
    }
    
    public function listarMaxtrackPosicUltInstalacao($inst_id){
        return $this->oCtrlMaxtrackPosicUlt->listarMaxtrackPosicUltInstalacao($inst_id);
    }
    
    //Métodos da classe do controlador Maxtrack Porta
    public function inserirMaxtrackPorta($oMaxtrackPorta){
        $this->oCtrlMaxtrackPorta->inserirMaxtrackPorta($oMaxtrackPorta);
    }
    
    public function alterarMaxtrackPorta($oMaxtrackPorta){
        $this->oCtrlMaxtrackPorta->alterarMaxtrackPorta($oMaxtrackPorta);
    }
    
    public function removerMaxtrackPorta($id){
        $this->oCtrlMaxtrackPorta->removerMaxtrackPorta($id);
    }
    
    public function listarMaxtrackPorta(){
        return $this->oCtrlMaxtrackPorta->listarMaxtrackPorta();
    }
    
    public function listarMaxtrackPortaId($id){        
        return $this->oCtrlMaxtrackPorta->listarMaxtrackPortaId($id);
    }
    
    public function validarMaxtrackPorta($params){
        return $this->oCtrlMaxtrackPorta->validarMaxtrackPorta($params);
    }
    
    //Métodos da classe do controlador Envio Comando
    public function inserirEnvioComando($oEnvioComando){
        $this->oCtrlEnvioComando->inserirEnvioComando($oEnvioComando);        
    }
    
    public function alterarEnvioComando($oEnvioComando){
        $this->oCtrlEnvioComando->alterarEnvioComando($oEnvioComando);        
    }
    
    public function removerEnvioComando($id){
        $this->oCtrlEnvioComando->removerEnvioComando($id);        
    }
    
    public function listarEnvioComando(){
        return $this->oCtrlEnvioComando->listarEnvioComando();
    }
    
    public function listarEnvioComandoId($id){        
        return $this->oCtrlEnvioComando->listarEnvioComandoId($id);
    }
    
    //Métodos da classe do controlador Google Posição
    public function listarGooglePosicaoLatLon($lat, $lon){        
        return $this->oCtrlGooglePosicao->listarGooglePosicaoLatLon($lat, $lon);
    }
    
    public function listarGoogleEndereco($lat, $lon){        
        return $this->oCtrlGooglePosicao->listarGoogleEndereco($lat, $lon);
    }
    
    public function AtualizarGoogleEndereco($lat, $lon, $end){
        $this->oCtrlGooglePosicao->AtualizarGoogleEndereco($lat, $lon, $end);
    }
    
    public function inserirGoogleEndereco( $lat, $lon, $end) {
        $this->oCtrlGooglePosicao->inserirGoogleEndereco($lat, $lon, $end);
    }

    //Fim
}

?>