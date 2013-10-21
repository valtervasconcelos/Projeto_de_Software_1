<?php
include_once 'visao/Tela.php';
/**
 * Descrição da FachadaTela
 *
 * @Autor Valter Vasconcelos 03/07/2012 
 * 
 */
class FachadaTela extends Tela{
    var $aParams;
    private $oSuperTela;

    public function FachadaTela($url){
        $this->oSuperTela = new Tela();
        
        $aParams = array("tela"=>@$url[2],"opcao"=>@$url[3],"registro"=>@$url[4],"param1"=>@$url[5],"param2"=>@$url[6],"param3"=>@$url[7],"param4"=>@$url[8]);
        
        if (@$aParams['tela'] == "empresaNaoEncontrada"){
            echo "<script>alert('Empresa não encontrada!!!');</script>";
            unset($_SESSION[SESSAOEMPRESA]);
            $this->oSuperTela->redirecionar();
        }elseif( (IS_AJAX) && (@$aParams['tela'] != "autentica") && (@$_SESSION[SESSAOEMPRESA]['usr_id'] == NULL) ){
            unset($_SESSION[SESSAOEMPRESA]);
            $this->oSuperTela->redirecionar();
        }else{
            $tela = (@$_SESSION[SESSAOEMPRESA]['usr_id'] == NULL && @$aParams['tela'] != "autentica") ? "login" : @$aParams['tela'];

            if( ($tela != "login") && ($tela != "autentica")  ){
                parent::validarLogin();
            }

            switch ($tela){
                case "autentica" :
                    require_once 'Autenticar.php';
                    $oLogin = new Autenticar();                
                    break;

                case "sair" :
                    unset($_SESSION[SESSAOEMPRESA]);
                    $this->oSuperTela->redirecionar();
                    break;                
                
                case "acessousuario" :
                    require_once 'visao/gerencia/LogUsuario.php';
                    $oLogUsuario = new LogUsuario($aParams);
                    $this->oSuperTela->setConteudo($oLogUsuario->getConteudo());
                    break;
                
                case "alterarsenha" :
                    require_once 'visao/gerencia/AlterarSenha.php';
                    $oAlterarSenha = new AlterarSenha($aParams);
                    $this->oSuperTela->setConteudo($oAlterarSenha->getConteudo());
                    break;

                case "cliente" :
                    require_once 'visao/cadastros/CadCliente.php';
                    $oCliente = new CadCliente($aParams);
                    $this->oSuperTela->setConteudo($oCliente->getConteudo());
                    break;

                case "clienteTipo" :
                    require_once 'visao/cadastros/CadClienteTipo.php';
                    $oCadClienteTipo = new CadClienteTipo($aParams);
                    $this->oSuperTela->setConteudo($oCadClienteTipo->getConteudo());
                    break;

                case "usuario" :
                    require_once 'visao/cadastros/CadUsuario.php';
                    $oUsuario = new CadUsuario($aParams);
                    $this->oSuperTela->setConteudo($oUsuario->getConteudo());
                    break;
                
                case "usuarioTipo" :
                    require_once 'visao/cadastros/CadUsuarioTipo.php';
                    $oUsuarioTipo = new CadUsuarioTipo($aParams);
                    $this->oSuperTela->setConteudo($oUsuarioTipo->getConteudo());
                    break;                

                case "motorista" :
                    require_once 'visao/cadastros/CadMotorista.php';
                    $oMotorista = new CadMotorista($aParams);
                    $this->oSuperTela->setConteudo($oMotorista->getConteudo());
                    break;

                case "servico" :
                    require_once 'visao/cadastros/CadServico.php';
                    $oServico = new CadServico($aParams);
                    $this->oSuperTela->setConteudo($oServico->getConteudo());
                    break;
                
                case "equipamento" :
                    require_once 'visao/cadastros/CadEquipamento.php';
                    $oCadEquipamento = new CadEquipamento($aParams);
                    $this->oSuperTela->setConteudo($oCadEquipamento->getConteudo());
                    break;

                case "equipamentoTipo" :
                    require_once 'visao/cadastros/CadEquipamentoTipo.php';
                    $oEquipamentoTipo = new CadEquipamentoTipo($aParams);
                    $this->oSuperTela->setConteudo($oEquipamentoTipo->getConteudo());
                    break;
                
                case "maxtrackPorta" :
                    require_once 'visao/cadastros/CadMaxtrackPorta.php';
                    $oMaxtrackPorta = new CadMaxtrackPorta($aParams);
                    $this->oSuperTela->setConteudo($oMaxtrackPorta->getConteudo());
                    break;
                
                case "chipGsm" :
                    require_once 'visao/cadastros/CadChipGsm.php';
                    $oCadChipGsm = new CadChipGsm($aParams);
                    $this->oSuperTela->setConteudo($oCadChipGsm->getConteudo());
                    break;
                
                case "chipGsmPlano" :
                    require_once 'visao/cadastros/CadChipGsmPlano.php';
                    $oCadChipGsmPlano = new CadChipGsmPlano($aParams);
                    $this->oSuperTela->setConteudo($oCadChipGsmPlano->getConteudo());
                    break;                
                
                case "operadora" :
                    require_once 'visao/cadastros/CadOperadora.php';
                    $oCadOperadora = new CadOperadora($aParams);
                    $this->oSuperTela->setConteudo($oCadOperadora->getConteudo());
                    break;

                case "veiculo":
                    require_once 'visao/cadastros/CadVeiculo.php';
                    $oVeiculo = new CadVeiculo ($aParams);
                    $this->oSuperTela->setConteudo($oVeiculo->getConteudo());
                    break;

                case "veiculoModelo":
                    require_once 'visao/cadastros/CadVeiculoModelo.php';
                    $oVeiculoModelo = new CadVeiculoModelo ($aParams);
                    $this->oSuperTela->setConteudo($oVeiculoModelo ->getConteudo());
                    break;

                case "veiculoCor":
                    require_once 'visao/cadastros/CadVeiculoCor.php';
                    $oVeiculoCor = new CadVeiculoCor($aParams);
                    $this->oSuperTela->setConteudo($oVeiculoCor->getConteudo());
                    break;

                case "veiculoMarca" :
                    require_once 'visao/cadastros/CadVeiculoMarca.php';
                    $oCadVeiculoMarca = new CadVeiculoMarca($aParams);
                    $this->oSuperTela->setConteudo($oCadVeiculoMarca->getConteudo());
                    break;

                case "veiculoIcone" :
                    require_once 'visao/cadastros/CadVeiculoIcone.php';
                    $oCadVeiculoIcone = new CadVeiculoIcone($aParams);
                    $this->oSuperTela->setConteudo($oCadVeiculoIcone->getConteudo());
                    break;
                
                case "veiculoInstalado" :
                    require_once 'visao/cadastros/CadVeiculoInstalado.php';
                    $oCadVeiculoInstalado = new CadVeiculoInstalado($aParams);
                    $this->oSuperTela->setConteudo($oCadVeiculoInstalado->getConteudo());
                    break;
                
                case "manutencao" :
                    require_once 'visao/cadastros/CadManutencao.php';
                    $oCadManutencao = new CadManutencao($aParams);
                    $this->oSuperTela->setConteudo($oCadManutencao->getConteudo());
                    break;
                
                case "posto" :
                    require_once 'visao/cadastros/CadPosto.php';
                    $oCadPosto = new CadPosto($aParams);
                    $this->oSuperTela->setConteudo($oCadPosto->getConteudo());
                    break;
                
                case "combustivel" :
                    require_once 'visao/cadastros/CadCombustivel.php';
                    $oCadCombustivel = new CadCombustivel($aParams);
                    $this->oSuperTela->setConteudo($oCadCombustivel->getConteudo());
                    break;
                
                case "viagem" :
                    require_once 'visao/cadastros/CadViagem.php';
                    $oCadViagem = new CadViagem($aParams);
                    $this->oSuperTela->setConteudo($oCadViagem->getConteudo());
                    break;
                
                case "infracao" :
                    require_once 'visao/cadastros/CadInfracao.php';
                    $oCadInfracao = new CadInfracao($aParams);
                    $this->oSuperTela->setConteudo($oCadInfracao->getConteudo());
                    break;

                case "agenda" :
                    require_once 'visao/cadastros/CadAgenda.php';
                    $oCadAgenda = new CadAgenda($aParams);
                    $this->oSuperTela->setConteudo($oCadAgenda->getConteudo());
                    break;
                
                case "instalacaohistorico" :
                    require_once 'visao/cadastros/CadInstalacaoHistorico.php';
                    $oCadInstHistorico = new CadInstalacaoHistorico($aParams);
                    $this->oSuperTela->setConteudo($oCadInstHistorico->getConteudo());
                    break;

                case "ponto" :
                    require_once 'visao/cadastros/CadPonto.php';
                    $oCadPonto = new CadPonto($aParams);
                    $this->oSuperTela->setConteudo($oCadPonto->getConteudo());
                    break;
                
                case "pontoIcone" :
                    require_once 'visao/cadastros/CadPontoIcone.php';
                    $oCadPontoIcone = new CadPontoIcone($aParams);
                    $this->oSuperTela->setConteudo($oCadPontoIcone->getConteudo());
                    break;                
                
                case "cerca" :
                    require_once 'visao/cadastros/CadCerca.php';
                    $oCadCerca = new CadCerca($aParams);
                    $this->oSuperTela->setConteudo($oCadCerca->getConteudo());
                    break;
                
                case "rota" :
                    require_once 'visao/cadastros/CadRota.php';
                    $oCadRota = new CadRota($aParams);
                    $this->oSuperTela->setConteudo($oCadRota->getConteudo());
                    break;

                case "jsoncliente" :
                    require_once 'ajax/jsonCliente.php';
                    $oJsonCliente = new jSonCliente();
                    $this->oSuperTela->setConteudo($oJsonCliente->getConteudo());
                    break;

                case "jsonponto" :
                    require_once 'ajax/jsonPonto.php';
                    $oJsonPonto = new jsonPonto();
                    $this->oSuperTela->setConteudo($oJsonPonto->getConteudo());
                    break;

                case "jsoneventos" :
                    require_once 'ajax/jsonEvento.php';
                    $oJsonEvento = new jsonEvento();                
                    $this->oSuperTela->setConteudo($oJsonEvento->getConteudo());
                    break;

                case "jsonGridInferior" :
                    require_once 'ajax/jsonGridInferior.php';
                    $oJsonGridInferior = new jsonGridInferior($url);                
                    $this->oSuperTela->setConteudo($oJsonGridInferior->getConteudo());
                    break;
                
                case "jsonGridMapa" :
                    require_once 'ajax/jsonGridMapa.php';
                    $oJsonGridMapa = new jsonGridMapa($url);
                    $this->oSuperTela->setConteudo($oJsonGridMapa->getConteudo());
                    break;

                case "framesos" :
                    require_once 'visao/frames/frameSOS.php';
                    $oFrameSOS = new frameSOS($aParams);
                    $this->oSuperTela->setConteudo($oFrameSOS->getConteudo());
                    break;

                case "framecercain" :
                    require_once 'visao/frames/frameCERCAIN.php';
                    $oFrameCERCAIN = new frameCERCAIN($aParams);
                    $this->oSuperTela->setConteudo($oFrameCERCAIN->getConteudo());
                    break;

                case "framecercaout" :
                    require_once 'visao/frames/frameCERCAOUT.php';
                    $oFrameCERCAOUT = new frameCERCAOUT($aParams);
                    $this->oSuperTela->setConteudo($oFrameCERCAOUT->getConteudo());
                    break;

                case "frameveiculogrid" :
                    require_once 'visao/frames/frameVeiculoGrid.php';
                    $oFrameVeiculoGrid = new frameVeiculoGrid($aParams);
                    $this->oSuperTela->setConteudo($oFrameVeiculoGrid->getConteudo());
                    break;
                
                case "frameveiculogridmapa" :
                    require_once 'visao/frames/frameVeiculoGridMapa.php';
                    $oFrameVeiculoGridMapa = new frameVeiculoGridMapa($aParams);
                    $this->oSuperTela->setConteudo($oFrameVeiculoGridMapa->getConteudo());
                    break;
                
                case "frameveiculogridcomando" :
                    require_once 'visao/frames/frameVeiculoGridComando.php';
                    $oFrameVeiculoGridComando = new frameVeiculoGridComando($aParams);
                    $this->oSuperTela->setConteudo($oFrameVeiculoGridComando->getConteudo());
                    break;
                
                case "framecalcularrota" :
                    require_once 'visao/frames/frameCalcularRota.php';
                    $oFrameCalcularRota = new frameCalcularRota($aParams);
                    $this->oSuperTela->setConteudo($oFrameCalcularRota->getConteudo());
                    break;
                
                case "framestreetview" :
                    require_once 'visao/frames/frameStreetView.php';
                    $oFrameStreetView= new frameStreetView($aParams);
                    $this->oSuperTela->setConteudo($oFrameStreetView->getConteudo());
                    break;
                
                case "frameponto" :
                    require_once 'visao/frames/framePonto.php';
                    $oFramePonto = new framePonto($aParams);
                    $this->oSuperTela->setConteudo($oFramePonto->getConteudo());
                    break;

                case "jsonenviarcomando" :
                    require_once 'ajax/jsonEnviarComando.php';
                    $oJsonEnviarComando = new jsonEnviarComando();
                    $this->oSuperTela->setConteudo($oJsonEnviarComando->getConteudo());
                    break;

                case "jsonsalvaprocedimento" :
                    require_once 'ajax/jsonSalvaProcedimento.php';
                    $oJsonSalvaProcedimento = new jsonSalvaProcedimento();
                    $this->oSuperTela->setConteudo($oJsonSalvaProcedimento->getConteudo());
                    break;
                
                case "relveiculo" :
                    require_once 'visao/relatorio/relVeiculo.php';
                    $oRelVeiculo = new relVeiculo($aParams);
                    $this->oSuperTela->setConteudo($oRelVeiculo->getConteudo());
                    break;
                
                case "relveiculoposicao" :
                    require_once 'visao/relatorio/relVeiculoPosicao.php';
                    $oRelVeiculoPosicao = new relVeiculoPosicao($aParams);
                    $this->oSuperTela->setConteudo($oRelVeiculoPosicao->getConteudo());
                    break;
                
                case "relclienteveiculo" :
                    require_once 'visao/relatorio/relClienteVeiculo.php';
                    $oRelCliVeiculo = new relClienteVeiculo($aParams);
                    $this->oSuperTela->setConteudo($oRelCliVeiculo->getConteudo());
                    break;
                
                case "reloperacao" :
                    require_once 'visao/relatorio/relOperacao.php';
                    $oRelOperacao = new relOperacao($aParams);
                    $this->oSuperTela->setConteudo($oRelOperacao->getConteudo());
                    break;
                
                case "relhistoricoinst" :
                    require_once 'visao/relatorio/relHistoricoInstalacao.php';
                    $oRelHistoricoInst = new relHistoricoInstalacao($aParams);
                    $this->oSuperTela->setConteudo($oRelHistoricoInst->getConteudo());
                    break;
                
                case "relhistoricocombustivel" :
                    require_once 'visao/relatorio/relHistoricoCombustivel.php';
                    $oRelHistoricoCombustivel = new relHistoricoCombustivel($aParams);
                    $this->oSuperTela->setConteudo($oRelHistoricoCombustivel->getConteudo());
                    break;
                
                case "relposicaobasico" :
                    require_once 'visao/relatorio/relPosicaoBasico.php';
                    $orelPosicaoBasico = new relPosicaoBasico($aParams);
                    $this->oSuperTela->setConteudo($orelPosicaoBasico->getConteudo());
                    break;

                default :
                    if(@$_SESSION[SESSAOEMPRESA]['usr_id'] != NULL){
                        require_once 'visao/home/Home.php';                
                        $oHome = new Home();
                        $this->oSuperTela->setConteudo($oHome->getConteudo());
                    }else{
                        require_once 'Login.php';                
                        $oLogin = new Login();
                        $this->oSuperTela->setConteudo($oLogin->getConteudo());
                    }    
                    break;
            }
        }
    }
    
    public function printHtml(){
        $this->oSuperTela->imprimirTela();
    }
}

?>