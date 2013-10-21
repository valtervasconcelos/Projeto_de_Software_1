<?php
include_once 'visao/Tela.php';
/**
 * Descricao da CadServico
 * @Autor Valter Vasconcelos
 */
class CadInfracao extends Tela{
    var $sConteudo;
    //Contrutor da Classe CadServico
    
    function CadInfracao($aParams) {
        $this->fachadaControl = $this->getInstanciaControle();
    
        if($aParams['opcao'] == "l" || $aParams['opcao'] == "d" || $aParams['opcao'] == "a"){
            if($aParams['opcao'] == "d")
                $this->fachadaControl->removerInfracao($aParams['registro']);

            if ($aParams['opcao'] == "a")
                $retornoAlter = $this->fachadaControl->listarInfracaoPorId($aParams['registro']);
            
            if(@$aParams['param1'] != "")
                $_SESSION[SESSAOEMPRESA]['cli_select'] = $aParams['param1'];

            $retornoCliente = $this->fachadaControl->listarClienteNivel();
            $retorno = $this->fachadaControl->listarInfracaoPorCli(@$_SESSION[SESSAOEMPRESA]['cli_select']);
            $retornoMotorista = $this->fachadaControl->listarMotorista(@$_SESSION[SESSAOEMPRESA]['cli_select']);               
            $retornoVeiculo = $this->fachadaControl->listarInstalacaoPorCliente(@$_SESSION[SESSAOEMPRESA]['cli_select']);
            $retornoTabInfracao = $this->fachadaControl->listarTabelaInfracao();
                
            $sConteudo = '
                <div class="tabs" style="margin-top: 40px; height:800px;">
                    <h2 class="cabecalho">Cadastro de Multas</h2>
                    <ul class="tabs-nav">
                        <li><a class="abas" href="#listagem">Listagem</a></li>
                        <li><a class="abas" id="abaform"  style="color:#2c82fc;" href="#formulario">Formulário</a></li>
                    </ul>
                    <div class="box-content" id="listagem" style="padding: 0px 0px 15px 0px;">
                        <table class="grid" id="grid">
                            <thead>
                                <tr>
                                    <th title="Ordenar por Código">ID</th>
                                    <th title="Ordenar por Data">DATA</th>
                                    <th title="Ordenar por Veículo">VEÍCULO</th>
                                    <th title="Ordenar por Descrição">DESCRIÇÃO DA MULTA</th>
                                    <th title="Ordenar por Motorista">MOTORISTA</th>                                    
                                    <th title="Ordenar por Valor">VALOR</th>
                                    <th title="Ordenar por Ponto">PONTO</th>     
                                    <th title="Ordenar por Status">STATUS</th>
                                    <th title="Ordenar por Vencimento">VENCIMENTO</th>                                    
                                    <th class="imgOrdenacao"></th>
                                </tr>	
                            </thead>
                            <tbody>';
                            if ($retorno != NULL){
                                foreach($retorno as $ret){                                            
                                    $sConteudo .= "
                                    <tr>
                                        <td>".$ret['infr_id']."</td>    
                                        <td>".$ret['infr_dthr']."</td>                                          
                                        <td>".$ret['inst_dsc']."</td>
                                        <td>".$ret['infr_dsc']."</td> 
                                        <td>".$ret['moto_dsc']."</td>
                                        <td>".$ret['infr_valor']."</td> 
                                        <td>".$ret['infr_ponto']."</td>
                                        <td>".$ret['infr_status']."</td>
                                        <td>".$ret['infr_vecimento']."</td>                                             
                                        <td id=\"alt\">
                                            <a title='Alterar' href='javascript:carregaHomeContainer(\"".PATHPRINCIPAL."/infracao/a/".$ret['infr_id']."/".$_SESSION[SESSAOEMPRESA]['cli_select']."/\");' class=\"edit\"></a>
                                            <a title='Excluir' href=\"#\" class=\"infRemove remove\" id=\"".$ret['infr_id']."\"></a>
                                        </td>
                                    </tr>";
                                }
                            }else{
                                $sConteudo .= '';
                            }

                            $sConteudo .= '
                            </tbody>
                        </table>
                    </div>
                    <form name="form_cadastro" id="form_cadastro" action="" method="POST" enctype="multipart/form-data" onsubmit="return false;">
                    <input type="hidden" name="txt_action" id="txt_action" value="" />
                    <input type="hidden" name="txt_id" id="txt_id" value="" />
                    <div class="box-content" id="formulario" >
                        <div class="box center800">
                            <div class="box-intro">
                                <h2 style="width: auto;">Formulário de Infração</h2>
                                <div id="warning" class="warning">
                                    Os campos abaixo devem ser preenchidos ou corrigidos!
                                </div>
                                <table width="100%">
                                <tr>
                                    <td>
                                    <label for="Motorista" style="float:left; width:22%;">
                                        <strong>*Motorista</strong>
                                        <select id="motorista" size="1" name="motorista" class="form">
                                            <option value="" selected>Selecione uma Opção</option>';                                                               
                                            if ($retornoMotorista != NULL){
                                                foreach ($retornoMotorista as $ret)
                                                    $sConteudo .= " <option value='".$ret['moto_id']."'>".$ret['moto_dsc']."</option>";
                                            }

                                            $sConteudo .= '     
                                        </select>
                                    </label>  
                                    <label for="data" style="float:left; width:20%; margin-left:20px;">
                                        <strong>* Data da Multa</strong><input  type="text" name="infr_dthr" id="infr_dthr" value=""/>
                                    </label>
                                    <label for="veiculo" style="float:left; width:22%; margin-left:20px;">
                                        <strong>* Placa</strong>
                                        <select id="inst_id" size="1" name="inst_id" class="form">
                                            <option value="">Selecione uma Opção</option>';
                                            if ($retornoVeiculo != NULL){
                                                    foreach ($retornoVeiculo as $ret)
                                                        $sConteudo .= " <option value='".$ret['inst_id']."'>".$ret['inst_dsc']."</option>";
                                                }
                                                $sConteudo .= '     
                                        </select>        
                                    </label>
                                    <label for="Status" style="float:right; width:22%;">
                                        <strong>* Status</strong>
                                        <select id="infr_status" size="1" name="infr_status" class="form">
                                            <option value="">Selecione uma Opção</option>
                                            <option value="Aguardando">Aguardando</option>                                         
                                            <option value="Cancelado">Cancelado</option>
                                            <option value="Recurso">Recurso</option>
                                            <option value="Pago">Pago</option>
                                        </select>        
                                    </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    <label for="Descricao" style="float:left; width:60%;">
                                        <strong>* Descricao</strong><input type="text" name="infr_dsc" id="infr_dsc" value="" maxlength="100" />
                                    </label>
                                    <label for="infracao" style="float:right; width:22%;">
                                        <strong>* Codigo da Infracao</strong>
                                        <select id="cod_infr" size="1" name="cod_infr" class="form">
                                            <option value="">Selecione uma Opção</option>';
                                            if ($retornoTabInfracao != NULL){
                                                foreach ($retornoTabInfracao as $ret)
                                                    $sConteudo .= " <option value='".$ret['tab_id']."'>".$ret['tab_cod']."</option>";
                                            }

                                            $sConteudo .= '
                                        </select>        
                                    </label>                                    
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    <label for="Pontos" style="float:left; width:22%; ">
                                        <strong>* Pontos</strong>
                                        <select id="infr_ponto" size="1" name="infr_ponto" class="form">
                                            <option value="">Selecione uma Opção</option>
                                            <option value="7">7 Pontos</option>                                         
                                            <option value="5">5 Pontos</option>
                                            <option value="4">4 Pontos</option>
                                            <option value="3">3 Pontos</option>
                                        </select>        
                                    </label>
                                    <label for="Vecimento" style="float:left; width:20%;  margin-left:10px;">
                                        <strong>* Vecimento</strong><input  type="text" name="infr_venc" id="infr_venc" value="" maxlength="16" />
                                    </label>
                                    <label for="* Valor" style="float:left; width:10%; margin-left:10px;">
                                        <strong>Valor</strong><input  type="text" name="infr_valor" id="infr_valor" value="" maxlength="6" />
                                    </label>
                                    <label for="lembrar" style="float:left; width:15%; margin-left:10px;">
                                        <strong>* Lembrar</strong>
                                        <select id="infr_lembrar" size="1" name="infr_lembrar" class="form">
                                            <option value="">Selecione...</option>
                                            <option value="1">SIM</option>                                         
                                            <option value="0">NÃO</option>
                                        </select>        
                                    </label>
                                    <label for="Pagoem" style="float:right; width:22%;">
                                        <strong>Pago em:</strong><input  type="text" name="infr_dtpag" id="infr_dtpag" value="" maxlength="16" />
                                    </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    <input type="submit" class="button button-submit" name="bt_salvar" id="salvar" value="Salvar Dados">
                                    </td>
                                </tr>
                                </table>
                            </div>   
                       </div> 
                    </div>
                    </form>
                </div>';

                $script =
                "<script type=\"text/javascript\">
                    $('document').ready(function(){
			$(\".tabs\").tabs();
                        $('#grid').dataTable( {
                            \"bRetrieve\":true,
                            \"sScrollY\": \"350px\"
                        } );
                        
                        $( \"#infr_dthr\" ).datetimepicker();
                        $( \"#infr_venc\" ).datetimepicker();                                  
                        $( \"#infr_dtpag\" ).datetimepicker();
                        
                        $('.botoes:eq(0)').append('<strong>Cliente : </strong>'+
                                             '<select class=\"form clientes\" id=\"infcli_id\" style=\"width:180px; margin-right:10px;\">'+
                                                '<option value=\"\" selected=\"selected\">Selecione o Cliente...</opition>'+";
                                                if ($retornoCliente != NULL){
                                                    foreach ($retornoCliente as $ret)
                                                        $script .= " '<option value=\"".$ret['cli_id']."\">".$ret['cli_dsc']."</option>'+";
                                                }
                                            
                                                $script .= "
                                             '</select>');";
                        
                        $script .= "                            
                        $('.botoes:eq(0)').append('<a id=\"infBtAdd\" class=\"button button-submit\" style=\"margin-top:0px;\">Novo Registro</a>');
                        $('#infcli_id').val('".@$_SESSION[SESSAOEMPRESA]['cli_select']."', 'selected');

                        $(\".abas\").click(function(){
                            $(\"#form_cadastro\").reset();
                            $('#mask').css({'width':'100%','height':'auto'});
                            $(\"#txt_action\").val(\"adicionar\");
                            $('#infcli_id').val('".@$_SESSION[SESSAOEMPRESA]['cli_select']."', 'selected');
			});

                        $(\"#infcli_id\").change(function(){
                            carregaHomeContainer(\"".PATHPRINCIPAL."/viagem/l/0/\"+this.value);
			});
                        
                        $(\"#cod_infr\").change(function(){
                            var codInfracao = $('#cod_infr').val();
                            $('#infr_dsc').val('carregando...');

                            $.ajax({
                                type: 'POST',
                                url: '".PATHPRINCIPAL."/infracao/codInfra',
                                text: 'Carregando...',
                                data: {
                                    cod: codInfracao
                                },
                                beforeSend: function(){},
                                success: function(txt){
                                    $('#infr_dsc').val(txt);
                                }
                            });                            

                        });
                        
 			$(\".infRemover\").live(\"click\", function(){
                            var codigo = $(this).attr(\"id\");
                            $(\"#dialog-message p span\").addClass(\"ui-icon-alert\");
                            $(\"#dialog-message p b\").html(\"Deseja realmente excluir o registro de número \"+codigo+\"?\");
                            $(\"#dialog-message\").dialog({
                                resizable: false,
                                modal: true,
                                title: \"Comunicado\",
                                buttons: {
                                    \"Excluir\": function() {
                                        $( this ).dialog(\"destroy\");							  
                                            carregaHomeContainer(\"".PATHPRINCIPAL."/infracao/d/\"+codigo);
                                    },
                                    \"Cancelar\": function() {
                                        $( this ).dialog(\"destroy\");
                                    }
                                }
                            });
			});";

			$activeTabs = ($aParams['opcao'] == "a") ? "
			$(\".tabs\").tabs({ selected: '#formulario' });
			$(\"#txt_action\").val(\"alterar\");
                        $('#mask').css({'width':'100%','height':'auto'});
                        
                    	$(\"input[name='txt_id']\").val('".$retornoAlter[0]['infr_id']."');
			$(\"input[name='infr_dsc']\").val('".$retornoAlter[0]['infr_dsc']."');
                        $(\"input[name='infr_dthr']\").val('".$retornoAlter[0]['infr_dthr']."');
                        $('#motorista').val('".$retornoAlter[0]['moto_id']."', 'selected');
                        $('#inst_id').val('".$retornoAlter[0]['inst_id']."', 'selected');
                        $('#cod_infr').val('".$retornoAlter[0]['tab_id']."', 'selected');
                        $('#infr_ponto').val('".$retornoAlter[0]['infr_ponto']."', 'selected');
                        $('#infr_status').val('".$retornoAlter[0]['infr_status']."', 'selected');
                        $('#infr_lembrar').val('".$retornoAlter[0]['infr_lembrar']."', 'selected');
                        $(\"input[name='infr_venc']\").val('".$retornoAlter[0]['infr_vecimento']."');
                        $(\"input[name='infr_valor']\").val('".$retornoAlter[0]['infr_valor']."');
			" : "";
			
			$script .= @$activeTabs."			
			
			$(\"#form_cadastro\").validate({
                            errorContainer: \"#warning\",
                            rules: {                                
                                \"motorista\"      : { required: true },
                                \"infr_dthr\"      : { required: true },
                                \"infr_venc\"      : { required: true },
                                \"cod_infr\"       : { required: true },
                                \"inst_id\"        : { required: true },
                                \"infr_dsc\"       : { required: true },
                                \"infr_status\"    : { required: true },
                                \"infr_valor\"     : { required: true },
                                \"infr_ponto\"     : { required: true },
                                \"infr_vecimento\" : { required: true },
                                \"infr_lembrar\"   : { required: true }
                            },
                            messages: {                                
                                \"motorista\"      : { required: \"Favor selecionar o motorista!\" },
                                \"infr_dthr\"      : { required: \"Favor digitar a hora!\" },
                                \"infr_venc\"      : { required: \"Favor digitar o vecimento!\" },
                                \"cod_infr\"       : { required: \"Favor selecionar o código da infração!\" },
                                \"inst_id\"        : { required: \"Favor selecionar o veículo!\" },
                                \"infr_dsc\"       : { required: \"Favor selecionar o código da infração ao lado!\" },
                                \"infr_status\"    : { required: \"Favor selecionar o status!\" },
                                \"infr_valor\"     : { required: \"Fovor informar o valor da multa!\" },
                                \"infr_ponto\"     : { required: \"Favor selecionar os pontos!\" },
                                \"infr_vecimento\" : { required: \"Favor informar o vencimento!\" },
                                \"infr_lembrar\"   : { required: \"Favor selecionar o lembrete!\" }

                            },
                            submitHandler: function(form){
                                $(form).ajaxSubmit({
                                    url: \"".PATHPRINCIPAL."/infracao/i\",
                                    type: 'POST',
                                    target: \"#warning\",
                                    success: function(data){
                                        $(\"#dialog-message p span\").addClass(\"ui-icon-circle-check\");
                                        $(\"#dialog-message p b\").html(\"Cadastro realizado com sucesso!!!\");
                                        $(\"#dialog-message\").dialog({
                                            resizable: false,
                                            modal: true,
                                            title: \"Comunicado\",
                                            buttons: {
                                                \"Ok\": function() {
                                                    $( this ).dialog( \"destroy\" );
                                                    carregaHomeContainer(\"".PATHPRINCIPAL."/infracao/l/0/".$_SESSION[SESSAOEMPRESA]['cli_select']."\");
                                                }
                                            }
                                        });
                                    }
                                });
                                return false;
                            }
			});
                    });
                    $('#infBtAdd').click(function (){                        
                        if(document.getElementById('infcli_id').value == ''){
                            alert('Por favor Selecione um Cliente.');
                            return false;
                        }else{
                            $(\"#txt_action\").val(\"adicionar\");
                            $(\".tabs\").tabs({ selected: '#formulario' });
                            $('#mask').css({'width':'100%','height':'135%'});
                        }
                    });
                    
                    ".(@$_SESSION[SESSAOEMPRESA]['cli_select'] == "" ? "$('#abaform').attr(\"href\", \"javascript:alert('Por favor Selecione um Cliente');\");" : "" )."
                </script>";

            $sConteudo .= $script;
        
        }elseif($aParams['opcao'] == "codInfra"){
            $retorno = $this->fachadaControl->listarTabelaInfracaoPorId(@$_POST['cod']);
            $sConteudo = $retorno[0]['tab_dsc'];
        }elseif($aParams['opcao'] == "i"){
            include_once('modelo/classes/Infracao.php');
            $oInfracao = new Infracao();

            $oInfracao->setCli_id($_SESSION[SESSAOEMPRESA]['cli_select']);
            $oInfracao->setInfr_dsc($_POST['infr_dsc']);
            $oInfracao->setInfr_dthr($_POST['infr_dthr']);
            $oInfracao->setInst_id($_POST['inst_id']);
            $oInfracao->setMoto_id($_POST['motorista']);
            $oInfracao->setTab_id($_POST['cod_infr']);
            $oInfracao->setInfr_dtpag($_POST['infr_dtpag']);
            $oInfracao->setInfr_valor($_POST['infr_valor']);
            $oInfracao->setInfr_ponto($_POST['infr_ponto']);
            $oInfracao->setInfr_vecimento($_POST['infr_venc']);
            $oInfracao->setInfr_status($_POST['infr_status']);
            $oInfracao->setInfr_lembrar($_POST['infr_lembrar']);

            if($_POST['txt_action'] == 'adicionar'){
                $this->fachadaControl->inserirInfracao($oInfracao);
            }else{
                $oInfracao->setInfr_id($_POST['txt_id']);
                $this->fachadaControl->alterarInfracao($oInfracao);
            }	

            $sConteudo = 'ok';

        }
        
        $this->setConteudo($sConteudo);
        
    }
   
}

?>