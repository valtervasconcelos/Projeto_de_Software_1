<?php
include_once 'fachada/FachadaControl.php';
/**
 * Descrição da Tela
 *
 * @Autor Valter Vasconcelos 03/07/2012
 * 
 */
class Tela extends FachadaControl{    
    private   $conteudo;
    private   $pedaco_ip;
    public    $fachadaControl;

    public function Tela(){
        $this->pedaco_ip = substr($_SERVER['REMOTE_ADDR'], -3);
    }
    
    public function getInstanciaControle(){
	return parent::getIntanciaControl();
    }
    
    public function setConteudo($conteudo){
        $this->conteudo = $conteudo;
    }    
    
    public function getConteudo(){
        return $this->conteudo;    
    }
    
    public function alertMSG($mensagem){
        //echo "<script>alert('".$mensagem."');</script>";
        echo $mensagem;
    }
    
    public function chave_googlemaps($pedaco_ip = ""){
	//echo "<script type='text/javascript' src='http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=true_or_false&amp;key=ABQIAAAA_xMuwDPFTvFQ2dZoFONSehQALmbEYyC2qpxpR5sSu03w-vyzWxRtjrhioi3izcWS-6mmsiXXtJD_EQ'></script>	<!-- IP: 192.168.1.8	-->\n";
        //echo "<script src='https://maps-api-ssl.google.com/maps/api/js?sensor=true' type='text/javascript'></script>";
        echo "<script src=\"https://maps.googleapis.com/maps/api/js?sensor=true&libraries=drawing\"></script>";
    }

    public function getJquery(){
        return
        '<script type="text/javascript" src="'.PATHPRINCIPAL.'/js/JQuery/wi.js"></script>
        <script lang="text/javascript" src="'.PATHPRINCIPAL.'/js/JQuery/jquery.ui.tabs.js"></script>
        <script lang="text/javascript" src="'.PATHPRINCIPAL.'/js/JQuery/jquery-form.js"></script>
        <script lang="text/javascript" src="'.PATHPRINCIPAL.'/js/JQuery/jquery-validate.js"></script>
        <script lang="text/javascript" src="'.PATHPRINCIPAL.'/js/JQuery/jquery-additionalMethods.js"></script>
        <script type="text/javascript" src="'.PATHPRINCIPAL.'/js/JQuery/jquery-dataTables.js"></script>
        <script lang="text/javascript" src="'.PATHPRINCIPAL.'/js/JQuery/jquery-mask.js"></script>
        <script lang="text/javascript" src="'.PATHPRINCIPAL.'/js/JQuery/jquery-scrollTo.js"></script>
        <script lang="text/javascript" src="'.PATHPRINCIPAL.'/js/JQuery/jquery-price.js"></script>
        <script lang="text/javascript" src="'.PATHPRINCIPAL.'/js/JQuery/jquery.ui.datepicker.js"></script>
        <script lang="text/javascript" src="'.PATHPRINCIPAL.'/js/JQuery/jquery.ui.datetimepicker.js"></script>            
        <script type="text/javascript" src="'.PATHPRINCIPAL.'/js/JQuery/jquery.ui.accordion.js"></script>
        
        <script type="text/javascript" src="'.PATHPRINCIPAL.'/js/JQuery/pup-slider.js"></script>        
        <script type="text/javascript" src="'.PATHPRINCIPAL.'/js/JQuery/jquery.jplayer.min.js"></script>
        <script type="text/javascript" src="'.PATHPRINCIPAL.'/js/JQuery/jquery.jmap.js"></script>';
    }


    public function getMenuPrincipal(){
        $pos        = strpos($_SESSION[SESSAOEMPRESA]['usr_dsc'], ' ');
        $username   = strtoupper($_SESSION[SESSAOEMPRESA]['usr_dsc']);
        $username   = ($pos > 0 ? substr($username, 0, strpos($username, " ")) : $_SESSION[SESSAOEMPRESA]['usr_dsc']);
        $s_usrt_dsc = $_SESSION[SESSAOEMPRESA]['usrt_dsc'];
        $cliente    = @$_SESSION[SESSAOEMPRESA]['cli_select'];
        
        $mCadastro  = (LIBERACAO2 ? 
                        "<li class='active'><a href='#' ><span>CADASTROS</span></a>
                        <ul>
                            <li><a href='#Cadastro' onclick='carregaHomeContainer(\"".PATHPRINCIPAL."/cliente/l\");' name='modal' id='cliteste'><span>CLIENTE</span></a></li>
                            <li><a href='#Cadastro' onclick='carregaHomeContainer(\"".PATHPRINCIPAL."/usuario/l/0/".$cliente."\");' name='modal'><span>USUÁRIO</span></a></li>
                            <li><a href='#Cadastro' onclick='carregaHomeContainer(\"".PATHPRINCIPAL."/usuarioTipo/l\");' name='modal'><span>TIPO DE USUÁRIO</span></a></li>
                            <li><a href='#Cadastro' onclick='carregaHomeContainer(\"".PATHPRINCIPAL."/motorista/l/0/".$cliente."\");' name='modal'><span>MOTORISTA</span></a></li>
                            <li><a href='#Cadastro' onclick='carregaHomeContainer(\"".PATHPRINCIPAL."/servico/l\");' name='modal'><span>SERVICO</span></a></li>                            
                            <li><a href='#' ><span>VEICULO</span></a>
                                <ul class='sb1 subsub'>
                                    <li><a href='#Cadastro' onclick='carregaHomeContainer(\"".PATHPRINCIPAL."/veiculo/l/0/".$cliente."\");' name='modal'><span>CADASTRAR VEÍCULO</span></a></li>
                                    <li><a href='#Cadastro' onclick='carregaHomeContainer(\"".PATHPRINCIPAL."/veiculoCor/l\");' name='modal'><span>VEICULO COR</span></a></li>
                                    <li><a href='#Cadastro' onclick='carregaHomeContainer(\"".PATHPRINCIPAL."/veiculoMarca/l\");' name='modal'><span>VEICULO MARCA</span></a></li>
                                    <li><a href='#Cadastro' onclick='carregaHomeContainer(\"".PATHPRINCIPAL."/veiculoModelo/l\");' name='modal'><span>VEICULO MODELO</span></a></li>
                                    <li><a href='#Cadastro' onclick='carregaHomeContainer(\"".PATHPRINCIPAL."/veiculoIcone/l\");' name='modal'><span>VEICULO ICONE</span></a></li>
                                </ul>    
                            </li>
                            <li><a href='#Cadastro' onclick='carregaHomeContainer(\"".PATHPRINCIPAL."/veiculoInstalado/l/0/".$cliente."\");' name='modal'><span>VEÍCULO/INSTALAÇÃO</span></a></li>                            
                            <li><a href='#' ><span>EQUIPAMENTO</span></a>
                                <ul class='sb2 subsub'>
                                    <li><a href='#Cadastro' onclick='carregaHomeContainer(\"".PATHPRINCIPAL."/equipamento/l\");' name='modal'><span>CAD. EQUIPAMENTO</span></a></li>
                                    <li><a href='#Cadastro' onclick='carregaHomeContainer(\"".PATHPRINCIPAL."/equipamentoTipo/l\");' name='modal'><span>TIPO DO EQUIPAMENTO</span></a></li>
                                    <li><a href='#Cadastro' onclick='carregaHomeContainer(\"".PATHPRINCIPAL."/maxtrackPorta/l\");' name='modal'><span>CONFIG. DAS PORTAS</span></a></li>
                                    <li><a href='#Cadastro' onclick='carregaHomeContainer(\"".PATHPRINCIPAL."/operadora/l\");' name='modal'><span>OPERADORA</span></a></li>
                                    <li><a href='#Cadastro' onclick='carregaHomeContainer(\"".PATHPRINCIPAL."/chipGsmPlano/l\");' name='modal'><span>PLANO DE CHIP</span></a></li>
                                    <li><a href='#Cadastro' onclick='carregaHomeContainer(\"".PATHPRINCIPAL."/chipGsm/l\");' name='modal'><span>CHIP GSM</span></a></li>
                                </ul>    
                            </li>
                            <li><a href='#Cadastro' onclick='carregaHomeContainer(\"".PATHPRINCIPAL."/agenda/l\");' name='modal'><span>AGENDA</span></a></li>
                            <li><a href='#Cadastro' onclick='carregaHomeContainer(\"".PATHPRINCIPAL."/ponto/l\");' name='modal'><span>PONTO</span></a></li>
                            <li><a href='#Cadastro' onclick='carregaHomeContainer(\"".PATHPRINCIPAL."/pontoIcone/l\");' name='modal'><span>ÍCONE PONTO</span></a></li>
                            <!--<li><a href='#'><span>INFORMATIVO</span></a></li>-->

                        </ul>
                        </li>" :
                        (in_array($s_usrt_dsc, array('USUÁRIO GERENTE', 'USUÁRIO SUB-GERENTE')) ? 
                        "<li class='active'><a href='#' ><span>CADASTROS</span></a>
                        <ul>                            
                            <li><a href='#Cadastro' onclick='carregaHomeContainer(\"".PATHPRINCIPAL."/usuario/l/0/".$cliente."\");' name='modal'><span>USUÁRIO</span></a></li>
                            <li><a href='#Cadastro' onclick='carregaHomeContainer(\"".PATHPRINCIPAL."/motorista/l/0/".$cliente."\");' name='modal'><span>MOTORISTA</span></a></li>
                            <li><a href='#Cadastro' onclick='carregaHomeContainer(\"".PATHPRINCIPAL."/veiculo/l/0/".$cliente."\");' name='modal'><span>VEÍCULO</span></a></li>
                            <!--<li><a href='#Cadastro' onclick='carregaHomeContainer(\"".PATHPRINCIPAL."/agenda/l\");' name='modal'><span>AGENDA</span></a></li>-->
                            <li><a href='#Cadastro' onclick='carregaHomeContainer(\"".PATHPRINCIPAL."/ponto/l\");' name='modal'><span>PONTO</span></a></li>
                        </ul>
                        </li>" : ""));
        
        $mRelatorio = (!in_array($s_usrt_dsc, array('USUÁRIO SIMPLES')) ? 
                        "<li class='active'><a href='#'><span>RELATORIOS</span></a>
                        <ul>
                            <li><a href='#Cadastro' onclick='carregaHomeContainer(\"".PATHPRINCIPAL."/relveiculo/f\");' name='modal'><span>VEÍCULO</span></a></li>
                            ".(LIBERACAO2 ? "<li><a href='".PATHPRINCIPAL."/relclienteveiculo/l' target='_blank'><span>CLIENTE/VEÍCULO</span></a></li>" : "")."
                            <li><a href='#Cadastro' onclick='carregaHomeContainer(\"".PATHPRINCIPAL."/relveiculoposicao/f\");' name='modal'><span>VEÍCULO/POSIÇÃO</span></a></li>
                            <li><a href='#Cadastro' onclick='carregaHomeContainer(\"".PATHPRINCIPAL."/relposicaobasico/f\");' name='modal'><span>POSICAO SIMPLIFICADO</span></a></li>
                            <li><a href='#Cadastro' onclick='carregaHomeContainer(\"".PATHPRINCIPAL."/reloperacao/f\");' name='modal'><span>OPERAÇÃO</span></a></li>
                            ".(LIBERACAOGM ? "<li><a href='#Cadastro' onclick='carregaHomeContainer(\"".PATHPRINCIPAL."/relhistoricoinst/f\");' name='modal'><span>HISTÓRICO DA INSTALAÇÃO</span></a></li>" : "")."
                            </ul>
                        </li>" : "");
        $logacesso  = (LIBERACAO2 ? "<li><a href='#Cadastro' onclick='carregaHomeContainer(\"".PATHPRINCIPAL."/acessousuario/l\");' name='modal'><span>ACESSO USUÁRIO</span></a></li>" : "");
        $mGerencia  =   "<li class='active'><a href='#'><span>GERÊNCIA</span></a>
                        <ul>
                            ".$logacesso."
                            <li><a href='#Cadastro' onclick='carregaHomeContainer(\"".PATHPRINCIPAL."/alterarsenha/a\");' name='modal'><span>ALTERAR SENHA</span></a></li>                                
                            ".(LIBERACAOG ? "<!--<li><a href='#'><span>DOWNLOADS</span></a></li>
                            <li><a href='#'><span>FINANCEIRO</span></a></li>-->" : "")."
                            </ul>
                        </li>";
        $mRota      = (in_array($s_usrt_dsc, array('USUÁRIO', 'USUÁRIO SIMPLES', 'USUÁRIO VIP')) ? "" : "<li><a href='#Cadastro' onclick='carregaHomeContainer(\"".PATHPRINCIPAL."/rota/l\");' name='modal'><span>ROTAS</span></a></li>");
        $mCerca     = (in_array($s_usrt_dsc, array('USUÁRIO', 'USUÁRIO SIMPLES', 'USUÁRIO VIP')) ? "" : "<li><a href='#Cadastro' onclick='carregaHomeContainer(\"".PATHPRINCIPAL."/cerca/l\");' name='modal'><span>CERCA</span></a></li>");
        /*$mManutencao= (in_array($s_usrt_dsc, array('USUÁRIO', 'USUÁRIO SIMPLES', 'USUÁRIO VIP')) ? "" : 
            "<li><a href='#'><span>MANUTENÇÃO</span></a>
                <ul>
                    <li><a href='#Cadastro' onclick='carregaHomeContainer(\"".PATHPRINCIPAL."/manutencao/l/1\");' name='modal'><span>TROCA DE ÓLEO</span></a></li>
                    <li><a href='#Cadastro' onclick='carregaHomeContainer(\"".PATHPRINCIPAL."/manutencao/l/2\");' name='modal'><span>TROCA DE BATERIA</span></a></li>
                    <li><a href='#Cadastro' onclick='carregaHomeContainer(\"".PATHPRINCIPAL."/manutencao/l/3\");' name='modal'><span>SISTEMA DE FREIO</span></a></li>
                    <li><a href='#Cadastro' onclick='carregaHomeContainer(\"".PATHPRINCIPAL."/manutencao/l/4\");' name='modal'><span>SISTEMA DE EMBREAGEM</span></a></li>
                    <li><a href='#Cadastro' onclick='carregaHomeContainer(\"".PATHPRINCIPAL."/manutencao/l/5\");' name='modal'><span>PNEUS</span></a></li>
                    <li><a href='#Cadastro' onclick='carregaHomeContainer(\"".PATHPRINCIPAL."/manutencao/l/6\");' name='modal'><span>SISTEMA DE SUSPENÇÃO</span></a></li>
                </ul>
            </li>");*/
        
        $mFrota     = (in_array($s_usrt_dsc, array('USUÁRIO', 'USUÁRIO SIMPLES', 'USUÁRIO VIP')) ? "" : 
            "<li><a href='#'><span>FROTA</span></a>
                <ul>
                    <li><a href='#Cadastro' onclick='carregaHomeContainer(\"".PATHPRINCIPAL."/posto/l\");' name='modal'><span>POSTO</span></a></li>
                    <li><a href='#Cadastro' onclick='carregaHomeContainer(\"".PATHPRINCIPAL."/combustivel/l\");' name='modal'><span>COMBUSTÍVEL</span></a></li>
                    <li><a href='#Cadastro' onclick='carregaHomeContainer(\"".PATHPRINCIPAL."/relhistoricocombustivel/l\");' name='modal'><span>HISTÓRICO COMBUSTÍVEL</span></a></li>
                    <li><a href='#Cadastro' onclick='carregaHomeContainer(\"".PATHPRINCIPAL."/viagem/l\");' name='modal'><span>VIAGEM</span></a></li>
                    <li><a href='#Cadastro' onclick='carregaHomeContainer(\"".PATHPRINCIPAL."/infracao/l\");' name='modal'><span>MULTAS</span></a></li>
                </ul>
            </li>");

        return "
            <div id=\"topo\"> 
                <div id=\"menu\">
                    <div id='cssmenu'>
                        <a class='hist' href='#Cadastro' name='modal' onclick='carregaHomeContainer(\"".PATHPRINCIPAL."/instalacaohistorico/l/\"+this.id);'></a>
                        <ul>
                        <li class='active'><a href='".PATHPRINCIPAL."' ><span>INÍCIO</span></a>
                        ".$mCadastro."
                        ".$mRelatorio."
                        ".$mGerencia." 
                        ".$mManutencao."
                        ".$mFrota."
                        <!--<li><a href='#'><span>ALERTAS</span></a></li>-->
                        ".$mRota."
                        ".$mCerca."
                        </ul>
                    </div>
                </div>
                
                <a id='cadponto' href='#Cadastro' onclick='' name='modal' style='display:none'></a>

                <div id=\"dadosTopo\">
                    <ul class=\"dadosUsu\">
                        <li id=\"user_td\">USUÁRIO: ".$username."</li>
                        <li><a class=\"sairBt\" href='".PATHPRINCIPAL."/sair'> <img src='imagens/icons/16x16/exit.png' alt='Sair do Sistema'></img></a></li>
                    </ul>
                </div>
            </div> 
            
            <div id = \"popupUsu\">
                <div id = \"popupBtFechar\"> 
                    <li id=\"sairBtFechar\"><a href='#'><span>x</span></a></li>
                </div>
                <table width='190' height='40' style='border:0px solid #ffffff;'>
                <tr>
                    <td align='center' style='color:#FFFFFF;'>
                    ".$_SESSION[SESSAOEMPRESA]['usr_dsc']."
                    </td>
                </tr>
                <tr>
                    <td align='center' class='sairUsu'>
                        <a href='".PATHPRINCIPAL."/sair'><span>SAIR</span></a>
                    </td>
                </tr>
                </table>
            </div>";
    }
    
    public function getGridsRodape(){
        $this->fachadaControl = $this->getInstanciaControle();
        $retornoCliente = $this->fachadaControl->listarClienteNivel();

        $grid = 
               '<div id="filtroVeiculo">
                    <form id="formFiltro" name="formFiltro" onsubimit="return false;">
                    <table>
                        <tr>
                            <td>CLIENTE:</td>
                            <td>
                                <select id="tlcli_id" size="1" name="tlcli_id" class="form">
                                    <option value="" selected>Selecione uma Opção</option>';
                                    if ($retornoCliente != NULL){
                                        foreach ($retornoCliente as $ret)
                                            $grid .=" <option value='".$ret['cli_id']."'>".$ret['cli_dsc']."</option>";
                                    }
                                    $grid .= '
                                </select>
                            </td>
                        </tr>
                        <tr>
                           <td>INSTALAÇÃO:</td>
                           <td>                                     
                                <select id="tlinst_id" size="1" name="tlinst_id" class="form">
                                    <option value="">Selecione um Cliente Primeiro.</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>DESCRIÇÃO:</td>
                            <td>
                            <input class="texto" type="text" name="tlinst_dsc" id="tlinst_dsc" value="" maxlength="50" />
                            </td>
                        </tr>
                        <tr>
                            <td>SERIAL:</td>
                            <td>
                            <input class="texto" type="text" name="tlequip_serial" id="tlequip_serial" value="" maxlength="50" />
                            </td>
                        </tr>                        
                    </table>
                    
                    <div id="filtroGridBT">
                      <table>
                        <tr>
                            <td><input type="button" class="button button-submit" value="Filtrar" onclick="reiniciaMapa(true); carregaFrame(\''.PATHPRINCIPAL.'/frameveiculogrid/null\');"> </td>
                            <td><input type="button" class="button button-submit" value="Limpar" onClick="$(\'#formFiltro\').reset()"> </td>
                        </tr>
                      </table>
                    </div>
                    </form>
                </div>
                   
                <div id="buttonAlertas">
                    <input type="image" id="escondeAl" src="imagens/icons/bootom3.png"> 
                    <input type="image" id="apareceAl" src="imagens/icons/bootom4.png"> 
                </div>

                <div id = "alertas">
                    <dl class="accordion" id="acrEventos">
                    </dl>                
                </div>

                <div id="gridButton">       
                    <div id="topgrid">
                        <div id="buttonGrid">
                            <input type="image" id="escondeGrid" src="imagens/icons/bootom.png"> 
                            <input type="image" id="apareceGrid" src="imagens/icons/bootom2.png"> 		 
                        </div>
                    </div>

                    <div id="contGrid">
                        <div id="gridTable">
                        <table border="0" cellspacing="0" cellpadding="1" class="grid" id="grid">
                        <thead>
                            <tr>
                                <th>Veículo</th>
                                <th>Cliente</th>
                                <th>Data</th>
                                <th>Hora</th>
                                <th>Endereço</th>
                                <th>UF</th>
                                <th>Km/h</th>
                                <th>Direção</th>
                                <th>Ignição</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        </table>
                        <script>
                            $(\'#grid\').dataTable({
                                "sScrollY": "120px"
                            });
                            
                            $(\'.grid\').css("width", "1024px");
                            $(".dataTables_wrapper").css({width:1040, height:120, \'margin-top\':\'0px\'});
                            $(".dataTables_filter").css("height", "20px");
                            $(".top").css("height", "35px");
                            $(".bottom").css({ height: 35, \'background-color\': \'#000000\', \'color\': \'#ffffff\' });
                            $(".dataTables_info").css({height:10, \'margin-top\': \'7px\'});
                            $(".dataTables_length").css({height:10, \'margin-top\': \'7px\'});
                            $(".grid_paginate").css({height:10, \'margin-top\': \'2px\'});                            
                            $(\'#grid td\').css("font-size", "10px");

                            $(\'.top:eq(0)\').append(
                                \'<input title="Filtrar Cliente" style="margin:2px 0 0 10px;" type="image" id="filtroVeic" height="32" src="imagens/icons/clifiltro.png">\'+
                                \'<input title=\"Imprimir PDF\" style=\"margin:0px 0 0 2px;\" type="image" id=\"adobePrint\" height=\"32\" src=\"imagens/icons/adobe.png\">\'+                                
                                \'<label style="float:left; margin-top:10px;">REFRESH</label>\'+
                                \'<select style="float:left; height:22px; margin-top:5px; margin-left:2px;" size="1" id="timerefresh" onchange="refresh_tempo_mapa(this.value);" >\'+
                                    \'<option value=30>Refresh do Mapa/Grid: 30 seg</option>\'+
                                    \'<option value=60>Refresh do Mapa/Grid: 1 min</option>\'+
                                    \'<option value=90>Refresh do Mapa: 2 min</option>\'+
                                    \'<option value=300>Refresh do Mapa: 5 min</option>\'+
                                    \'<option value=600>Refresh do Mapa: 10 min</option>\'+
                                    \'<option value=1200>Refresh do Mapa: 20 min</option>\'+
                                    \'<option value=1800>Refresh do Mapa: 30 min</option>\'+
                                    \'<option value=0>Refresh do Mapa: desativado</option>\'+
                                \'</select></span>\'
                            );
                            
                            $(\'#timerefresh\').val(tempo_mapa_valor, \'selected\');
                            
                        </script>
                        </div>    
                    </div>
                </div>';

        return $grid;
    }

    public function cabecalhoSistema($tipo = NULL){
        if ($tipo == "login"){
            $onload = "javascript: document.formlogin.login.focus();";
            $linksCss = '<link rel="stylesheet" type="text/css" href="'.PATHPRINCIPAL.'/css/stLogin.css" />';
        }elseif($tipo == "home"){
            $browser = $_SERVER[ 'HTTP_USER_AGENT' ];
            $linksCss = '<link rel="stylesheet" type="text/css" href="'.PATHPRINCIPAL.'/css/stMenu.css" />
                         <link rel="stylesheet" type="text/css" href="'.PATHPRINCIPAL.'/css/searchMap.css" />
                         <script type="text/javascript" src="'.PATHPRINCIPAL.'/js/GoogleMaps/tooltip.js"></script>
                         <script type="text/javascript" src="'.PATHPRINCIPAL.'/js/GoogleMaps/markerclusterer.js"></script>
                         <script type="text/javascript" src="'.PATHPRINCIPAL.'/js/GoogleMaps/markerclusterer_compiled.js"></script>    <!-- Para colocar imagens ao invés de números para muitos pontos e carros -->
                         <script type="text/javascript" src="'.PATHPRINCIPAL.'/js/GoogleMaps/jquery.toastmessage-min.js"></script>     <!-- Criar Layer para os pontos -->
                         <script type="text/javascript" src="'.PATHPRINCIPAL.'/js/GoogleMaps/jMenu.jquery.min.js"></script>            <!-- Criar Placa para os pontos no mapa -->
                         <script type="text/javascript" src="'.PATHPRINCIPAL.'/js/GoogleMaps/jquery.mousewheel-3.0.4.pack.js"></script><!-- Trabalha os poligonos no mapa -->
                         <script type="text/javascript" src="'.PATHPRINCIPAL.'/js/GoogleMaps/jquery.fancybox-1.3.4.pack.js"></script>  <!-- Função para label no mapa -->
                         <script type="text/javascript" src="'.PATHPRINCIPAL.'/js/GoogleMaps/jquery.tablesorter.min.js"></script>      <!-- Função abrir mapa local -->
                         <script type="text/javascript" src="'.PATHPRINCIPAL.'/js/GoogleMaps/jquery.tablesorter.pager.js"></script>    <!-- Função para criar ajustar o Google Maps -->
                         <script type="text/javascript" src="'.PATHPRINCIPAL.'/js/GoogleMaps/googlemaps.js"></script>                  <!-- Função criadas para google -->
                         <script type="text/javascript" src="'.PATHPRINCIPAL.'/js/GoogleMaps/jGoogleBarV3.js"></script>                <!-- Função criadas para pesquisa google -->
                         <script type="text/javascript" src="'.PATHPRINCIPAL.'/js/GoogleMaps/RouteBoxer.js"></script>                  <!-- Função para criar cerca nas rotas -->
                         <script type="text/javascript" src="'.PATHPRINCIPAL.'/js/JQuery/jquery-AeroWindow.js"></script>               <!-- Função para criar efeito aero para eventos -->
                         '.(preg_match( "/MSIE/", $browser ) ? 
                         '<script type="text/javascript" src="'.PATHPRINCIPAL.'/js/JQuery/jquery.styledButtonIE.js"></script>' : 
                         '<script type="text/javascript" src="'.PATHPRINCIPAL.'/js/JQuery/jquery.styledButton.js"></script>');
        }
        
        return 
           '<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="pt-br">
            <head>

            <noscript><meta http-equiv="Refresh" content="0; URL='.PATHPRINCIPAL.'"/></noscript>
            <meta name="author" content="Empetec" />
            <meta name="language" content="pt-br" />
            <meta http-equiv="Expires" CONTENT="0">
            <meta http-equiv="Cache-Control" CONTENT="no-cache">
            <meta http-equiv="Pragma" CONTENT="no-cache">
            <title>'.TITLE.'</title>
            
            <script lang="text/javascript" src="'.PATHPRINCIPAL.'/js/JQuery/jquery-1.6.4.min.js"></script>
            <script lang="text/javascript" src="'.PATHPRINCIPAL.'/js/JQuery/jquery-ui-1.8.16.custom.min.js"></script>
            '.$this->chave_googlemaps($this->pedaco_ip).'
            '.$this->getJquery().'
            '.@$linksCss.'
            
            <script lang="text/javascript" src="'.PATHPRINCIPAL.'/js/ajax.js"></script>
            <script lang="text/javascript" src="'.PATHPRINCIPAL.'/js/sistema.js"></script>
            <script type="text/javascript" src="'.PATHPRINCIPAL.'/js/teclasAtalho.js"></script>

            <link rel="stylesheet" type="text/css" href="'.PATHPRINCIPAL.'/css/stSistema.css" />
            <link rel="stylesheet" type="text/css" href="'.PATHPRINCIPAL.'/css/jquery.toastmessage-min.css" />
            <link rel="stylesheet" type="text/css" href="'.PATHPRINCIPAL.'/css/normalize.css" />
            
            <link rel="stylesheet" type="text/css" href="'.PATHPRINCIPAL.'/css/stIncludes.css" />
            <!--[if IE]> <link rel="stylesheet" type="text/css" href="'.PATHPRINCIPAL.'/css/stIncludesIE.css" /> <![endif]-->

            </head>
            <body onload="'.@$onload.'">';
        
    }
    
    public function rodapeSistema(){
        return
               '<div id="dialog-message" title="Comunicado" style="display: none;">
                    <p>
                        <span class="ui-icon" style="float:left; margin:0 7px 50px 0;"></span>
                        <b></b>
                    </p>
		</div>
                
            </body>
            </html> ';        
    }
    
    //======================================================================
    // Funções para Posições / Grid
    //======================================================================
    public function getDirecao($direcao){        
        switch ($direcao){
            case 0:		return 'norte';
            case 1:		return 'nordeste';
            case 2:		return 'leste';
            case 3:		return 'sudeste';
            case 4:		return 'sul';
            case 5:		return 'sudoeste';
            case 6:		return 'oeste';
            case 7:		return 'noroeste';
            default:
                if ($direcao < 23)
                        $retorno = 'norte';
                elseif ($direcao < 68)
                        $retorno = 'nordeste';
                elseif ($direcao < 113)
                        $retorno = 'leste';
                elseif ($direcao < 158)
                        $retorno = 'sudeste';
                elseif ($direcao < 203)
                        $retorno = 'sul';
                elseif ($direcao < 248)
                        $retorno = 'sudoeste';
                elseif ($direcao < 293)
                        $retorno = 'oeste';
                elseif ($direcao < 338)
                        $retorno = 'noroeste';
                else
                        $retorno = 'norte';

                return $retorno;
        }

        return 'Null';
    }
    
    //======================================================================
    // Função para retornar o status da posição do veículo
    //======================================================================
    public function getStatus($tabela, $ign = false){
        $tIgnicao = (isset($tabela['ignicao']) ? $tabela['ignicao'] : $tabela['ign']);

        if ($tabela['equipt_forn'] == 'ZENITE')
            $ignicao= ($tabela['vel'] == 0 ? 'Desligado'	: 'Ligado');
        else{
            if ($tIgnicao == '0'){
                $ignicao= ($tabela['vel'] < 10	? 'Desligado'	: 'Ligado');
            }else
                $ignicao= 'Ligado';
        }

        $sos = (($tabela['sos'] == '1'||($tabela['zanpo_even'] == '2')) ? ' / SOS' : '');

        if ($ign == '1' || $ign == true)
            return $ignicao;
        else
            return $ignicao.$sos;
    }
    
    //======================================================================
    // Função para pegar o endereço do ponto
    //======================================================================
    public function getPosicaoGoogle($lat, $lon){
        $posicao = $this->fachadaControl->listarGooglePosicaoLatLon($lat, $lon);

        if ($posicao && $posicao != NULL){
            $endereco = array('ender' => $posicao[0]['goop_ender'],
                    'bairro' => $posicao[0]['goop_bairro'],
                    'cidade' => $posicao[0]['goop_cidade'],
                    'uf' => $posicao[0]['goop_uf'],
                    'pais' => $posicao[0]['goop_pais'],
                    'cep' => $posicao[0]['goop_cep']);
        }else
            $endereco = array('ender' => '',
                    'bairro' => '',
                    'cidade' => '',
                    'uf' => '',
                    'pais' => '',
                    'cep' => '');

        return $endereco;
    }
    
    //======================================================================
    // Função para calcular a distancia mais próxima do veículo
    // (Ponto ou Cidade)
    //======================================================================
    public function getLocalizacao($cli_id, $lat, $lon, $dividir = false){
        $ponto = $this->fachadaControl->listarPontoProximoPorCliente($cli_id, $lat, $lon);
        $cidade = $this->fachadaControl->listarPontoProximoPorCidade($lat, $lon);
        //-----  Distancias
        $retorno_cidade = ($dividir ? "{$cidade[0]['esta_id']}{$cidade[0]['descricao']}" : "{$cidade[0]['descricao']} - {$cidade[0]['esta_id']}")." (".number_format($cidade[0]['distancia'], 3, ',', '').' Km)';
        $retorno_ponto  = ($ponto[0]['esta_id'] == '' ? '  ' : $ponto[0]['esta_id']).$ponto[0]['descricao'].' ('.number_format($ponto[0]['distancia'], 3, ',', '').' Km)';

        if ($cidade[0]['descricao'] == '')
            return $retorno_ponto;

        if ($ponto[0]['descricao'] == '')
            return $retorno_cidade;

        //-----  Calcula se o ponto ou a cidade mais próxima da localização do veículo
        if ($cidade[0]['distancia'] < $ponto[0]['distancia'])
            return $retorno_cidade;
        else
            return $retorno_ponto;
    }
    
    //======================================================================
    // Função para calcular a diferença entre datas resultado pode 
    // ser em segundos, horas e dias
    //======================================================================
    public function getCalcula_dthr_dif($dthr_fim, $dthr_ini, $data_dia){        
        $dthr_ini = ($dthr_ini == '' ? $dthr_fim : $dthr_ini);
        $calculo_dataL = $this->fachadaControl->listarCalcDtHrDif($dthr_fim, $dthr_ini, $data_dia);

        return $calculo_dataL[0]['dthr_dif'];
    }
    
    //======================================================================
    // Função para converter uma data em segundos
    //======================================================================
    public function getConverter_segundos($periodo, $dia = true){
        if ($dia)
            $periodo_retorno = ((int)(substr($periodo, 0, 2))*86400)+ // Dias convertidos em segundos
                               ((int)(substr($periodo, -8, 2))*3600)+ // Horas convertidas em segundos
                               ((int)(substr($periodo, -5, 2))*60)+   // Minutos convertidos em segundos
                               ((int)(substr($periodo, -2, 2)));      // Segundos
        else{
            if (strlen($periodo) == 9)
                $periodo_retorno = ((int)(substr($periodo, -9, 3))*3600)+// Horas convertidas em segundos
                                   ((int)(substr($periodo, -5, 2))*60)+  // Minutos convertidos em segundos
                                   ((int)(substr($periodo, -2, 2)));     // Segundos
            else
                $periodo_retorno = ((int)(substr($periodo, -8, 2))*3600)+// Horas convertidas em segundos
                                   ((int)(substr($periodo, -5, 2))*60)+  // Minutos convertidos em segundos
                                   ((int)(substr($periodo, -2, 2)));     // Segundos
        }

        return $periodo_retorno;
    }
    
    function grtDiffDate($d1, $d2, $type='', $sep='-'){
        $d1 = explode($sep, $d1);
        $d2 = explode($sep, $d2);
        
        switch ($type){
            case 'A':
            $X = 31536000;
            break;
            case 'M':
            $X = 2592000;
            break;
            case 'D':
            $X = 86400;
            break;
            case 'H':
            $X = 3600;
            break;
            case 'MI':
            $X = 60;
            break;
            default:
            $X = 1;
        }
        
        return floor( ( ( mktime(0, 0, 0, $d2[1], $d2[2], $d2[0]) - mktime(0, 0, 0, $d1[1], $d1[2], $d1[0] ) ) / $X ) );
    }
    
    public function imprimirTela(){
        echo $this->getConteudo();
    }
    
    public function redirecionar(){
        //$src = (PATHPRINCIPAL == "" ? "http://189.126.110.196/novosistema" : PATHPRINCIPAL );
        $src = (PATHPRINCIPAL == "" ? "http://localhost/Strack" : PATHPRINCIPAL );
        header('Location: '.$src);
    }
    
    public function validarLogin(){
        if (@$_SESSION[SESSAOEMPRESA]['usr_id'] == NULL)
            $this->redirecionar();
            
    }

}

?>