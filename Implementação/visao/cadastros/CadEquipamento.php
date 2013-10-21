<?php
include_once 'visao/Tela.php';
/**
 * Descrição da CadEquipamento
 *
 * @Autor Valter Vasconcelos 02/08/2012
 */
class CadEquipamento extends Tela{
    var $sConteudo;

    function CadEquipamento($aParams) {
         $this->fachadaControl = $this->getInstanciaControle();
         
         if($aParams['opcao'] == "l" || $aParams['opcao'] == "d" || $aParams['opcao'] == "a"){
            if($aParams['opcao'] == "d"){
                $this->fachadaControl->removerEquipamento($aParams['registro']);
            }
            
            if ($aParams['opcao'] == "a")
                $retornoAlter = $this->fachadaControl->listarEquipamentoPorId($aParams['registro']);
                       
            $retorno = $this->fachadaControl->listarEquipamento();
            $retornoEquiTipo = $this->fachadaControl->listarEquipamentoTipo();
            $retornoChipGsm = $this->fachadaControl->listarChipNaoCad($aParams);

            $sConteudo ='
                <div class="tabs" style="margin-top: 40px; height:600px;">
                    <h2 class="cabecalho">Cadastro de Equipamento</h2>
                    <ul class="tabs-nav">
                        <li><a class="abas" href="#listagem">Listagem</a></li>
                        <li><a class="abas" style="color:#2c82fc;" href="#formulario">Formulário</a></li>
                    </ul>
                    <div class="box-content" id="listagem" style="padding: 0px 0px 15px 0px;">
                        <table class="grid" id="grid">
                            <thead>
                                <tr>
                                    <th title="Ordenar por Código">#</th>
                                    <th title="Ordenar por Serial Number">SERIAL NUMBER</th>
                                    <th title="Ordenar por Imei">IMEI</th>
                                    <th title="Ordenar por Chip Gsm">CHIP GSM</th>
                                    <th title="Ordenar por Tel. Chip Gms">TEL.CHIP GSM</th>
                                    <th title="Ordenar por Tipo Equipamento">TIPO EQUIP</th>
                                    <th title="Ordenar por Cliente">CLIENTE</th>
                                    <th title="Ordenar por Veiculo Instalado">VEIC.INSTALADO</th>
                                    <th class="imgOrdenacao"></th>
                                </tr>	
                            </thead>
                            <tbody>';
                            if ($retorno != NULL){
                                foreach($retorno as $ret){                                            
                                    $sConteudo .= "
                                    <tr>
                                        <td>".$ret['equip_id']."</td>
                                        <td>".$ret['equip_serial']."</td>
                                        <td>".$ret['equip_imei']."</td>
                                        <td>".$ret['chip_serial']."</td>     
                                        <td>".$ret['chip_tel']."</td>
                                        <td>".$ret['equipt_dsc']."</td>
                                        <td>".$ret['cli_dsc']."</td>
                                        <td>".$ret['inst_dsc']."</td>                                         
                                        <td id=\"alt\">
                                            <a title='Alterar' href='javascript:carregaHomeContainer(\"".PATHPRINCIPAL."/equipamento/a/".$ret['equip_id']."\");' class=\"edit\"></a>
                                            ".($ret['inst_dsc'] == "" ? "<a title='Excluir' href=\"#\" class=\"eqRemove remove\" id=\"".$ret['equip_id']."\"></a>" : "")."
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
                                <h2 style="width: auto;">Formulário Equipamento</h2>
                                <div id="warning" class="warning">
                                    Os campos abaixo devem ser preenchidos ou corrigidos!
                                </div>
                                <table width="100%">
                                <tr>
                                    <td>
                                    <label for="Serial" style="float:left; width:45%">
                                        <strong>* Serial Equipamento</strong><input type="text" name="equip_serial" id="equip_serial" value="" maxlength="20" />
                                    </label>
                                    <label for="Imei" style="float:right; width:45%; margin-left:60px; ">
                                        <strong>*Imei</strong><input type="text" name="equip_imei" id="equip_imei" value="" maxlength="20" />
                                    </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    <label for="Tipo Equipamento" style="float:left; width:45%;" >
                                        <strong>*Tipo Equipamento</strong>
                                            <select id="equipt_id" size="1" name="equipt_id" class="form">
                                                <option value="" selected>Selecione uma Opção</option>';                                                               
                                                if ($retorno != NULL){
                                                    foreach ($retornoEquiTipo as $ret)
                                                        $sConteudo .= " <option value='".$ret['equipt_id']."'>".$ret['equipt_dsc']."</option>";
                                                }
                                                $sConteudo .= '     
                                            </select>
                                    </label>
                                    <label for="Chip Gsm" style="float:right; width:45%; margin-left:60px;" >
                                        <strong>Chip Gsm</strong>
                                            <select id="chip_id" size="1" name="chip_id" class="form">
                                                <option value="NULL" selected>Selecione uma Opção</option>';                                                               
                                                if ($retorno != NULL){
                                                    foreach ($retornoChipGsm as $ret)
                                                        $sConteudo .= " <option value='".$ret['chip_id']."'>".$ret['chip_serial']."</option>";
                                                }
                                                $sConteudo .= '     
                                            </select>
                                    </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    <label for="datacompra" style="float:left; width:15%;">
                                            <strong>Data de Compra</strong><input class="data" type="text" name="equip_dtcp" id="equip_dtcp" value="" />
                                    </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    <div class="tabs" style="margin-top: 20px; float:left; width:100%;">
                                        <h2 class="cabecalho" style="width:98%;">Outros Dados</h2>
                                        <ul class="tabs-nav">
                                            <li><a style="color:#2c82fc;" href="#observacao">Observacao</a></li>
                                        </ul>
                                        <div class="box-content" id="observacao">
                                            <label for="observacao" style="float:left; width:100%;">
                                                <strong>Observação</strong><textarea style="width:98%" name="equip_obs" id="equip_obs" value="" rows="6">'.@$retornoAlter[0]['equip_obs'].'</textarea>
                                            </label>
                                        </div>
                                    </div>
                                    </td>
                                </tr>
                                </table>
                                <div class="clear"></div>
                                <input type="submit" class="left button button-submit" name="bt_salvar" id="salvar" value="Salvar Dados" />
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
                        
                        $(\".data\").mask(\"99/99/9999\");
                        $(\"#equip_dtcp\" ).datepicker();

                        $(\".abas\").click(function(){
                            $(\"#form_cadastro\").reset();
                            $('#mask').css({'width':'100%','height':'auto'});
			});
                        
        		$('.botoes:eq(0)').append('<a id=\"eqBtAdd\" class=\"button button-submit\" style=\"margin-top:0px;\">Novo Registro</a>');
		
			$(\"#eqBtAdd\").live(\"click\",function(){
                            $(\"#form_cadastro\").reset();
                            $(\"#txt_action\").val(\"adicionar\");
                            $(\".tabs\").tabs({ selected: '#formulario' });
                            $('#mask').css({'width':'100%','height':'auto'});
			});
                        
 			$(\".eqRemove\").live(\"click\", function(){
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
                                            carregaHomeContainer(\"".PATHPRINCIPAL."/equipamento/d/\"+codigo);
                                    },
                                    \"Cancelar\": function() {
                                        $( this ).dialog(\"destroy\");
                                    }
                                }
                            });
			});

                        $('#equip_serial').blur(function () {
                            $.ajax({
                                url: \"".PATHPRINCIPAL."/equipamento/v\",
                                type: 'POST',
                                data: {tipo: 'serial',value: $(this).val(),id: $('#txt_id').val(),acao: $('#txt_action').val()},
                                success: function(txt){
                                    if (txt == 'Erro'){
                                        alert('Serial Number já existe! Verifique');
                                        $('#equip_serial').focus();
                                        return;
                                    }
                                }
                            });
                        });

                        $('#equip_imei').blur(function () {
                            $.ajax({
                                url: \"".PATHPRINCIPAL."/equipamento/v\",
                                type: 'POST',
                                data: {tipo: 'imei',value: $(this).val(),id: $('#txt_id').val(),acao: $('#txt_action').val()},
                                success: function(txt){
                                    if (txt == 'Erro'){
                                        alert('Imei já existe! Verifique');
                                        $('#equip_imei').focus();
                                        return;
                                    }
                                }
                            });
                        });";

			$activeTabs = ($aParams['opcao'] == "a") ? "
			$(\".tabs\").tabs({ selected: '#formulario' });
        		$(\"#txt_action\").val(\"alterar\");
                        $('#mask').css({'width':'100%','height':'auto'});
            		$(\"input[name='txt_id']\").val('".$retornoAlter[0]['equip_id']."');
			$(\"input[name='equip_serial']\").val('".$retornoAlter[0]['equip_serial']."');
			$(\"input[name='equip_imei']\").val('".$retornoAlter[0]['equip_imei']."');
                        $('#chip_id').val('".$retornoAlter[0]['chip_id']."', 'selected');
                        $('#equipt_id').val('".$retornoAlter[0]['equipt_id']."', 'selected');
                        $(\"input[name='equip_dtcp']\").val('".$retornoAlter[0]['equip_dtcp']."');
			" : "";
			
			$script .= @$activeTabs."

			$(\"#form_cadastro\").validate({
                            errorContainer: \"#warning\",
                            rules: {                                
                                \"equip_serial\"          : { required: true },
                                \"equip_imei\"            : { required: true },
                                \"equipt_id\"             : { required: true }

                             },
                            messages: {                                
                                \"equip_serial\"         : { required: \"Favor digitar o serial do equipamento!\"},
                                \"equip_imei\"           : { required: \"Favor digitar o imei do equipamento!\"},
                                \"equipt_id\"            : { required: \"Favor digitar o tipo de equipamento!\" }
                            },
                            submitHandler: function(form){
                                $(form).ajaxSubmit({
                                    url: \"".PATHPRINCIPAL."/equipamento/i\",
                                    type: 'POST',
                                    target: \"#warning\",
                                    success: function(data){
                                        if(data != 'Erro'){
                                            $(\"#dialog-message p span\").addClass(\"ui-icon-circle-check\");
                                            $(\"#dialog-message p b\").html(\"Cadastro realizado com sucesso!!!\");
                                            $(\"#dialog-message\").dialog({
                                                resizable: false,
                                                modal: true,
                                                title: \"Comunicado\",
                                                buttons: {
                                                    \"Ok\": function() {
                                                        $( this ).dialog( \"destroy\" );
                                                        carregaHomeContainer(\"".PATHPRINCIPAL."/equipamento/l\");
                                                    }
                                                }
                                            });
                                        }
                                    }
                                });
                                return false;
                            }
			});
                    });
                </script>";

            $sConteudo .= $script;
            
        }elseif($aParams['opcao'] == "v"){
            $params = array("tipo"=>$_POST['tipo'],"value"=>$_POST['value'],"acao"=>$_POST['acao'],"id"=>$_POST['id']);            
            $this->validarCadastro($params);
        }elseif($aParams['opcao'] == "i"){
            include_once('modelo/classes/Equipamento.php');
            $oEquipamento = new Equipamento();

            $oEquipamento->setEquipt_id($_POST['equipt_id']);
            $oEquipamento->setChip_id($_POST['chip_id']);
            $oEquipamento->setEquip_serial($_POST['equip_serial']);
            $oEquipamento->setEquip_imei($_POST['equip_imei']);
            $oEquipamento->setEquip_dtcp($_POST['equip_dtcp']);
            $oEquipamento->setEquip_obs($_POST['equip_obs']);

            $params = array("tipo"=>"serial","value"=>$_POST['equip_serial'],"acao"=>$_POST['txt_action'],"id"=>$_POST['txt_id']);
            $retornoSer = $this->fachadaControl->validarEquipamento($params);
            $params = array("tipo"=>"imei","value"=>$_POST['equip_imei'],"acao"=>$_POST['txt_action'],"id"=>$_POST['txt_id']);
            $retornoImei = $this->fachadaControl->validarEquipamento($params);

            if($retornoSer != 'Erro' && $retornoImei != 'Erro'){
                if($_POST['txt_action'] == 'adicionar'){
                    $this->fachadaControl->inserirEquipamento($oEquipamento);
                }else{
                    $oEquipamento->setEquip_id($_POST['txt_id']);
                    $this->fachadaControl->alterarEquipamento($oEquipamento);
                }
                $sConteudo = 'ok';
            }else
                $sConteudo = 'Erro';
        }

        $this->setConteudo($sConteudo);

    }
    
    private function validarCadastro($params){
        echo $this->fachadaControl->validarEquipamento($params);
    }
    
}

?>