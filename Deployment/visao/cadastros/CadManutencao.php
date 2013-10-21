<?php
include_once 'visao/Tela.php';
/**
 * Descricao da CadManutencao
 *
 * @Autor Valter Vasconcelos 21/01/2013
 * 
 */
class CadManutencao extends Tela{

    //Construtor da Classe
    function CadManutencao($aParams) {
        $this->fachadaControl = $this->getInstanciaControle();
        define("TIPOMANU", ($aParams['opcao'] == "l" ? $aParams['registro'] : TIPOMANU ));

        if($aParams['opcao'] == "l" || $aParams['opcao'] == "d" || $aParams['opcao'] == "a"){
            if($aParams['opcao'] == "d"){
                $this->fachadaControl->removerInstalacaoManutencao($aParams['registro']);
            }
            
            if($aParams['opcao'] == "a"){
                $retornoAlter = $this->fachadaControl->listarInstalacaoManutencaoId($aParams['registro']);
                $itensManutencao = $this->fachadaControl->listarInstalacaoManutencaoItem($retornoAlter['manu_id']);
            }

            if(@$aParams['param1'] != ""){
                $_SESSION[SESSAOEMPRESA]['cli_select'] = $aParams['param1'];
            }

            $retorno = $this->fachadaControl->listarInstalacaoManutencao(@$_SESSION[SESSAOEMPRESA]['cli_select'], TIPOMANU);
            $retornoInstalacao = $this->fachadaControl->listarInstalacaoPorCliente(@$_SESSION[SESSAOEMPRESA]['cli_select']);
            $retornoCliente = $this->fachadaControl->listarCliente();
                                                                         
            $sConteudo ='
                <div class="tabs" id="tabsitens" style="margin-top: 40px; height: 600px;">
                    <h2 class="cabecalho">Lançamento de Manutenções</h2>
                    <ul class="tabs-nav">
                        <li><a class="abas" href="#listagem">Listagem</a></li>
                        <li><a class="abas" id="abaform" style="color:#2c82fc;" href="#formulario">Formulário</a></li>
                    </ul>
                    <div class="box-content" id="listagem" style="padding: 0px 0px 15px 0px;">
                        <table class="grid" id="grid">
                            <thead>
                                <tr>
                                    <th title="Ordenar por Código">ID</th>
                                    <th title="Ordenar por Placa">PLACA</th>
                                    <th title="Ordenar por Descrição">DESCRIÇÃO</th>
                                    <th title="Ordenar por Data">DATA</th>
                                    <th title="Ordenar por Data de Alerta">AVISAR EM</th>

                                    <th class="imgOrdenacao"></th>
                                </tr>
                            </thead>
                            <tbody>';
                            if ($retorno != NULL){
                                foreach($retorno as $ret){
                                    $sConteudo .= "
                                    <tr>
                                        <td>".$ret['manu_id']."</td>
                                        <td>".$ret['inst_dsc']."</td>
                                        <td>".$ret['manu_dsc']."</td>
                                        <td>".$ret['manu_dtca']."</td>
                                        <td>".$ret['manu_dtalerta']."</td>
                                        <td id=\"alt\">
                                            <a title='Alterar' href='javascript:carregaHomeContainer(\"".PATHPRINCIPAL."/manutencao/a/".$ret['manu_id']."/".$_SESSION[SESSAOEMPRESA]['cli_select']."/\");' class=\"edit\"></a>
                                            <a title='Excluir' href=\"#\" class=\"instmRemove remove\" id=\"".$ret['manu_id']."\"></a>

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
                                <h2 style="width: auto;">Formulário de Manutenções</h2>
                                <div id="warning" class="warning">
                                    Os campos abaixo devem ser preenchidos ou corrigidos!
                                </div>
                                <table width="100%">
                                <tr>
                                    <td>
                                    <label for="instalacao" style="float:left; width:20%;">
                                        <strong>* Placa</strong>
                                        <select id="inst_id" size="1" name="inst_id" class="form">
                                            <option label="" value="">Selecione uma Opção</option>';
                                            if ($retornoInstalacao != NULL){
                                                foreach ($retornoInstalacao as $ret)
                                                    $sConteudo .= " <option label='".$ret['veic_consumo']."' value='".$ret['inst_id']."'>".$ret['inst_dsc']."</option>";
                                            }
                                            $sConteudo .= '
                                        </select>        
                                    </label>   
                                    <label for="descricao" style="float:left; width:40%; margin-left:10px; ">
                                        <strong>* Descrição</strong>
                                        <input type="text" id="manu_dsc" name="manu_dsc" value="" maxlength="254" />
                                    </label>
                                    <label for="documento" style="float:left; width:20%; margin-left:10px; ">
                                        <strong>* Nº Documento</strong>
                                        <input type="text" id="manu_numdoc" name="manu_numdoc" value="" maxlength="15" />
                                    </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    <label for="dataalerta" style="float:left; width:20%;">
                                        <strong>* Data Alerta</strong><input type="text" name="manu_dtalerta" id="manu_dtalerta" value="" maxlength="11" />
                                    </label>
                                    <label for="email" style="float:left; width:45%; margin-left:25px;">
                                        <strong>* E-mail </strong><input type="text" name="manu_email" id="manu_email" value="" maxlength="254" />
                                    </label>                                    
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    <div class="tabs" style="margin-top: 20px; float:left; width:100%;">
                                        <h2 class="cabecalho" style="width:98%;">Outros Dados</h2>
                                        <ul class="tabs-nav">
                                            <li><a style="color:#2c82fc;" href="#item">Itens</a></li>
                                            <li><a style="color:#2c82fc;" href="#observacao">Observação</a></li>
                                        </ul>
                                        <div class="box-content" id="item" style="height:450px;">
                                            
                                        </div>
                                        <div class="box-content" id="observacao" style="height:250px;">
                                            
                                        </div>
                                    </div>
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

                        $('#manu_dtalerta').datetimepicker();

                        $(\"#inst_id\").change(function(){
                            $(\"#form_cadastro\").reset();
                        });
                        
                        $('.botoes:eq(0)').append('<strong>Cliente : </strong>'+
                                             '<select class=\"form clientes\" id=\"instmcli_id\" style=\"width:180px; margin-right:10px;\">'+
                                                '<option value=\"\" selected=\"selected\">Selecione o Cliente...</opition>'+";
                                                if ($retornoCliente != NULL){
                                                    foreach ($retornoCliente as $ret)
                                                        $script .= " '<option value=\"".$ret['cli_id']."\">".$ret['cli_dsc']."</option>'+";
                                                }
                                            
                                                $script .= "
                                             '</select>');";
                        
                        $script .= "                            
                        $('.botoes:eq(0)').append('<a id=\"instmBtAdd\" class=\"button button-submit\" style=\"margin-top:0px;\">Novo Registro</a>');
                        $('#instmcli_id').val('".@$_SESSION[SESSAOEMPRESA]['cli_select']."', 'selected');

                        $(\".abas\").click(function(){
                            $(\"#form_cadastro\").reset();
                            $('#mask').css({'width':'100%','height':'auto'});
                            $(\"#txt_action\").val(\"adicionar\");
                            $('#instmcli_id').val('".@$_SESSION[SESSAOEMPRESA]['cli_select']."', 'selected');
                                
                            if (this.href.indexOf('listagem') > -1){
                                $('#tabsitens').css({'height':'600px'});
                            }else{
                                $('#tabsitens').css({'height':'820px'});
                            }
			});
                            
                        $(\"#instmcli_id\").change(function(){
                            carregaHomeContainer(\"".PATHPRINCIPAL."/manutencao/l/".TIPOMANU."/\"+this.value);
			});

 			$(\".instmRemove\").live(\"click\", function(){
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
                                            carregaHomeContainer(\"".PATHPRINCIPAL."/manutencao/d/\"+codigo);
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

                    	$(\"input[name='manu_dsc']\").val('".$retornoAlter[0]['manu_dsc']."');
                  	$(\"input[name='manu_dtalerta']\").val('".$retornoAlter[0]['manu_dtalerta']."');
                        $('#inst_id').val('".$retornoAlter[0]['inst_id']."', 'selected');
                        $(\"input[name='manu_email']\").val('".$retornoAlter[0]['manu_email']."');
                        $('#mask').css({'width':'100%','height':'135%'});
                        $('#tabsitens').css({'height':'820px'});

			" : "";

			$script .= @$activeTabs."			
			
			$(\"#form_cadastro\").validate({
                            errorContainer: \"#warning\",
                            rules: {                                
                                \"manu_dsc\"          : { required: true },
                                \"inst_id\"           : { required: true },
                                \"manu_dtalerta\"     : { required: true },
                                \"manu_email\"        : { required: true }
                            },
                            messages: {
                                \"manu_dsc\"          : { required: \"Favor digitar a data de abastecimento\" },
                                \"inst_id\"           : { required: \"Favor selecione o veículo!\" },
                                \"manu_dtalerta\"     : { required: \"Favor selecione o tipo de combustível!\" },
                                \"manu_email\"        : { required: \"Favor informe o valor do litro!\" }
                            },
                            submitHandler: function(form){
                                $('#qtd_litro').attr('disabled', false);
                                $('#comb_total').attr('disabled', false);
                                $(form).ajaxSubmit({
                                    url: \"".PATHPRINCIPAL."/manutencao/i\",
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
                                                    carregaHomeContainer(\"".PATHPRINCIPAL."/manutencao/l/".TIPOMANU."/".$_SESSION[SESSAOEMPRESA]['cli_select']."\");
                                                    $('#mask').css({'width':'100%','height':'auto'});
                                                    $('#tabsitens').css({'height':'600px'});
                                                }
                                            }
                                        });
                                    }
                                });
                                return false;
                            }
			});
                    });
                
                    $('#instmBtAdd').click(function (){                        
                        if(document.getElementById('instmcli_id').value == ''){
                            alert('Por favor Selecione um Cliente.');
                            return false;
                        }else{
                            $(\"#txt_action\").val(\"adicionar\");
                            $(\".tabs\").tabs({ selected: '#formulario' });
                            $('#mask').css({'width':'100%','height':'135%'});
                            $('#tabsitens').css({'height':'820px'});
                        }
                    });
                    
                    ".(@$_SESSION[SESSAOEMPRESA]['cli_select'] == "" ? "$('#abaform').attr(\"href\", \"javascript:alert('Por favor Selecione um Cliente');\");" : "" )."
                </script>"; 

            $sConteudo .= $script;
            
        }elseif($aParams['opcao'] == "i"){
            include_once('modelo/classes/InstalacaoManutencao.php');
            $oInstalacaoManutencao = new instalacaoManutencao();
            
            $oInstalacaoManutencao->setCli_id($_SESSION[SESSAOEMPRESA]['cli_select']);            
            $oInstalacaoManutencao->setInst_id($_POST['inst_id']);
            $oInstalacaoManutencao->setManu_dsc($_POST['comb_dthr']);
            $oInstalacaoManutencao->setManu_numdoc($_POST['comb_tipoc']);
            $oInstalacaoManutencao->setManu_dtalerta($_POST['comb_posto']);
            $oInstalacaoManutencao->setManu_email($_POST['valor_litro']);
            $oInstalacaoManutencao->setManu_idtpm(TIPOMANU);
            
            foreach ($_POST['listItem'] as $itens){                
                $aItens = array(
                    $_POST['itmanu_dscprod'],
                    $_POST['itmanu_modeloprod'],
                    $_POST['itmanu_validadeprod'],
                    $_POST['itmanu_qtdprod'],
                    $_POST['itmanu_valorprod'],
                    $_POST['itmanu_dttroca'],
                    $_POST['itmanu_dtproxtroca'],
                    $_POST['itmanu_odome'],
                    $_POST['itmanu_kmproxtroca'],
                    $_POST['itmanu_obs']
                );
                
                $oInstalacaoManutencao->setItens_colection($aItens);
            }

            if($_POST['txt_action'] == 'adicionar'){
                $this->fachadaControl->inserirInstalacaoManutencao($oInstalacaoManutencao);
            }else{
                $oInstalacaoManutencao->setManu_id($_POST['txt_id']);
                $this->fachadaControl->alterarInstalacaoManutencao($oInstalacaoManutencao);
            }

            $sConteudo = 'ok';

        }
        
        $this->setConteudo($sConteudo);
        
    }

}

?>
