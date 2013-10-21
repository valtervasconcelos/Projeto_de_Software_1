<?php
include_once 'visao/Tela.php';

/**
 * Arquivo PHP CadVeiculo
 *
 * @Autor Valter Vasconcelos 27/07/2012
 */
Class CadVeiculo extends Tela{
    var $sConteudo;
    //Contrutor da Classe CadVeiculo
    
     function CadVeiculo($aParams) {
        $this->fachadaControl = $this->getInstanciaControle();

        if($aParams['opcao'] == "l" || $aParams['opcao'] == "d" || $aParams['opcao'] == "a"){
            if($aParams['opcao'] == "d"){
                $this->fachadaControl->removerVeiculo($aParams['registro']);
            }

            if ($aParams['opcao'] == "a")
                $retornoAlter = $this->fachadaControl->listarVeiculoPorId($aParams['registro']);
                
            if(@$aParams['param1'] != ""){
                $_SESSION[SESSAOEMPRESA]['cli_select'] = $aParams['param1'];
            }
            
            $retorno = $this->fachadaControl->listarVeiculo(@$aParams['param1']);
            $retornoCliente = $this->fachadaControl->listarClienteNivel();
            $retornoVeiculoIcone = $this->fachadaControl->listarVeiculoIcone();
            $retornoVeiculoMarca = $this->fachadaControl->listarVeiculoMarca();
            $retornoVeiculoModelo = $this->fachadaControl->listarVeiculoModelo();
            $retornoVeiculoCor = $this->fachadaControl->listarVeiculoCor();
                
            $sConteudo ='
                <div class="tabs" style="margin-top: 40px; height:600px;">
                    <h2 class="cabecalho">Cadastro de Veiculo</h2>
                    <ul class="tabs-nav">
                        <li><a class="abas" href="#listagem">Listagem</a></li>
                        <li><a class="abas" id="abaform" style="color:#2c82fc;" href="#formulario">Formulário</a></li>
                    </ul>

                    <div class="box-content" id="listagem" style="padding: 0px 0px 15px 0px;">
                        <table class="grid" id="grid">
                            <thead>
                                <tr>
                                    <th title="Ordenar por CÓDIGO">ID</th>
                                    <th title="Ordenar por INSTALAÇÃO">INSTALAÇÃO</th>
                                    <th title="Ordenar por PLACA">PLACA</th>
                                    <th title="Ordenar por CHASSI">CHASSI</th>
                                    <th title="Ordenar por RENAVAM">RENAVAM</th>
                                    <th title="Ordenar por ESTADO">UF</th>
                                    <th title="Ordenar por MARCA">MARCA</th>
                                    <th title="Ordenar por MODELO">MODELO</th>
                                    <th title="Ordenar por ANO">ANO</th>
                                    <th title="Ordenar por DATA DE CADASTRO">CADASTRO</th>

                                    <th class="imgOrdenacao"></th>
                                </tr>
                            </thead>
                            <tbody>';
                            if ($retorno != NULL){
                                foreach($retorno as $ret){                                            
                                    $sConteudo .= "
                                    <tr>
                                        <td>".$ret['veic_id']."</td>
                                        <td>".$ret['inst_dsc']."</td>
                                        <td>".$ret['veic_placa']."</td>
                                        <td>".$ret['veic_chassi']."</td>
                                        <td>".$ret['veic_renavam']."</td>
                                        <td>".$ret['esta_id']."</td>
                                        <td>".$ret['veicma_dsc']."</td>
                                        <td>".$ret['veicmo_dsc']."</td>
                                        <td>".$ret['veic_ano']."</td>
                                        <td>".$ret['veic_dtca']."</td>

                                        <td id=\"alt\">
                                            <a title='Alterar' href='javascript:carregaHomeContainer(\"".PATHPRINCIPAL."/veiculo/a/".$ret['veic_id']."/".@$aParams['param1']."\");' class=\"edit\"></a>
                                            ".($ret['inst_dsc'] == "" ? "<a title='Excluir' href=\"#\" class=\"viRemove remove\" id=\"".$ret['veic_id']."\"></a>" : "")."
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
                    <input type="hidden" name="sel_cli" id="sel_cli" value="'.@$_SESSION[SESSAOEMPRESA]['cli_select'].'" />
                    <div class="box-content" id="formulario">
                        <div class="box center800">
                            <div class="box-intro">
                                <h2 style="width: auto;">Formulário de Veículo</h2>
                                <div id="warning" class="warning">
                                    Os campos abaixo devem ser preenchidos ou corrigidos!
                                </div>
                                <table style="width:100%" >
                                <tr>
                                    <td>
                                    <label for="Marca" style="float:left; width:45%;">
                                        <strong>* Marca</strong>
                                        <select id="veicma_id" size="1" name="veicma_id" class="form">
                                            <option value="" selected>Selecione uma Opção</option>';                                        
                                            if ($retornoVeiculoMarca != NULL){
                                                foreach ($retornoVeiculoMarca as $ret)
                                                    $sConteudo .= " <option value='".$ret['veicma_id']."'>".$ret['veicma_dsc']."</option>";
                                            }
                                            $sConteudo .= '
                                        </select>
                                    </label>

                                    <label for="Modelo" style="float:right; width:45%;">
                                        <strong>* Modelo</strong>
                                        <select id="veicmo_id" size="1" name="veicmo_id" class="form">
                                            <option value="" selected>Selecione uma Opção</option>';                                        
                                            if ($retornoVeiculoModelo != NULL){
                                                foreach ($retornoVeiculoModelo as $ret)
                                                    $sConteudo .= " <option value='".$ret['veicmo_id']."'>".$ret['veicmo_dsc']."</option>";
                                            }
                                            $sConteudo .= '
                                        </select>
                                    </label>                            
                                    <br class="clear" />
                                    </td> 
                                </tr>
                                <tr>
                                    <td>
                                    <label for="Placa" style="float:left; width:10%;">
                                        <strong>* Placa</strong><input class="placa" type="text" name="veic_placa" id="veic_placa" value="" maxlength="50" />
                                    </label>

                                    <label for="Chassi" style="float:left; width:30%; margin-left:10px;">
                                        <strong>* Chassi</strong><input type="text" name="veic_chassi" id="veic_chassi" value="" maxlength="50" />
                                    </label>

                                    <label for="Renavam" style="float:left; width:30%; margin-left:10px;">
                                        <strong> Renavam</strong><input type="text" name="veic_renavam" id="veic_renavam" value="" maxlength="50" />
                                    </label>

                                    <label for="Ano" style="float:right; width:10%; margin-left:10px;">
                                        <strong> Ano</strong><input class="ano" type="text" name="veic_ano" id="veic_ano" value="" maxlength="50" />
                                    </label> 
                                    <br class="clear" />
                                    </td>
                                </tr>    
                                <tr>     
                                    <td> 
                                    <label for="Est" style="float:left; width:30%;">
                                        <strong> Estado</strong>
                                        <select id="esta" size="1" name="esta" class="form">
                                            <option value="">Selecione uma Opção</option>
                                            <option value="AC">Acre</option>
                                            <option value="AL">Alagoas</option>
                                            <option value="AP">Amapá</option>
                                            <option value="AM">Amazonas</option>
                                            <option value="BA">Bahia</option>
                                            <option value="CE">Ceará</option>
                                            <option value="DF">Distrito Federal</option>
                                            <option value="ES">Espí­rito Santo</option>
                                            <option value="GO">Goias</option>
                                            <option value="MA">Maranhão</option>
                                            <option value="MT">Mato Grosso</option>
                                            <option value="MS">Mato Grosso do Sul</option>
                                            <option value="MG">Minas Gerais</option>
                                            <option value="PA">Pará</option>
                                            <option value="PB">Paraíba</option>
                                            <option value="PR">Paraná</option>
                                            <option value="PE">Pernambuco</option>
                                            <option value="PI">Piauí</option>
                                            <option value="RJ">Rio de Janeiro</option>
                                            <option value="RN">Rio Grande do Norte</option>
                                            <option value="RS">Rio Grande do Sul</option>
                                            <option value="RO">Rondônia</option>
                                            <option value="RR">Roraima</option>
                                            <option value="SC">Santa Catarina</option>
                                            <option value="SP">São Paulo</option>
                                            <option value="SE">Sergipe</option>
                                            <option value="TO">Tocantins</option>
                                        </select>
                                    </label>
                                    <label for="Cor" style="float:right; width:20%;">
                                        <strong> * Cor</strong>
                                        <select id="veicor_id" size="1" name="veicor_id" class="form">
                                            <option value="" selected>Selecione uma Opção</option>';
                                            if ($retornoVeiculoCor != NULL){
                                                foreach ($retornoVeiculoCor as $ret)
                                                    $sConteudo .= "<option value='".$ret['veicor_id']."'>".$ret['veicor_dsc']."</option>";
                                            }

                                            $sConteudo .= '
                                        </select>
                                    </label>
                                    <label for="Icone" style="float:right; width:20%; margin-right:10px; margin-left:10px;">
                                        <strong>* Ícone</strong>
                                        <select id="veicic_id" size="1" name="veicic_id" class="form">
                                            <option value="" selected>Selecione uma Opção</option>';

                                            if ($retornoVeiculoIcone != NULL){
                                                foreach ($retornoVeiculoIcone as $ret)
                                                    $sConteudo .= " <option value='".$ret['veicic_id']."'>".$ret['veicic_dsc']."</option>";
                                            }

                                            $sConteudo .= '
                                        </select>
                                    </label>
                                    <label for="consumo" style="float:right; width:13%; margin-right:10px; margin-left:10px;">
                                        <strong>* Consumo Km/L</strong><input class="consumo" type="text" name="veic_consumo" id="veic_consumo" value="12" maxlength="2" />
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
                                                <strong>Observação</strong><textarea style="width:98%" name="veic_obs" id="veic_obs" value="" rows="6">'.@$retornoAlter[0]['veic_obs'].'</textarea>
                                            </label>
                                        </div>
                                    </div>
                                    </td>
                                </tr>
                                </table>
                                <input type="submit" class="button button-submit" name="bt_salvar" id="salvar" value="Salvar Dados">
                            </div>
                        </div>
                    </div>
                    </form>
                </div>';

            $script =
                "<script type=\"text/javascript\">
                    $('document').ready(function(){
                        $(\".tabs\").tabs();
                        $('#grid').dataTable({
                            \"bRetrieve\":true,
                            \"sScrollY\": \"350px\"
                        });

                        $(\".ano\").mask(\"9999\");
                        $(\".placa\").mask(\"***-9999\");
                        $(\".consumo\").mask(\"99\");

                        $('.botoes:eq(0)').append('<strong>Cliente : </strong>'+
                                                '<select class=\"form clientes\" id=\"vicli_id\" style=\"width:180px; margin-right:10px;\">'+
                                                '<option value=\"\" selected=\"selected\">Selecione o Cliente...</opition>'+";
                                                if ($retornoCliente != NULL){
                                                    foreach ($retornoCliente as $ret)
                                                        $script .= " '<option value=\"".$ret['cli_id']."\">".$ret['cli_dsc']."</option>'+";
                                                }

                                                $script .= "
                                                '</select>');";


                        $script .= "
                        $('.botoes:eq(0)').append('<a id=\"viBtAdd\" class=\"button button-submit\" style=\"margin-top:0px;\">Novo Registro</a>');
                        $('#vicli_id').val('".@$_SESSION[SESSAOEMPRESA]['cli_select']."', 'selected');

                        $(\".abas\").click(function(){
                            $(\"#form_cadastro\").reset();
                            $('#mask').css({'width':'100%','height':'auto'});
                            $(\"#txt_action\").val(\"adicionar\");
                            $('#vicli_id').val('".@$_SESSION[SESSAOEMPRESA]['cli_select']."', 'selected');
                        });

                        $(\"#vicli_id\").change(function(){
                            carregaHomeContainer(\"".PATHPRINCIPAL."/veiculo/l/0/\"+this.value);
                        });

                        $(\".viRemove\").live(\"click\", function(){
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
                                            carregaHomeContainer(\"".PATHPRINCIPAL."/veiculo/d/\"+codigo+\"/".$aParams['param1']."\");
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

                        $(\"input[name='txt_id']\").val('".$retornoAlter[0]['veic_id']."');
                        $('#veicic_id').val('".$retornoAlter[0]['veicic_id']."', 'selected');
                        $('#veicma_id').val('".$retornoAlter[0]['veicma_id']."', 'selected');
                        $('#veicmo_id').val('".$retornoAlter[0]['veicmo_id']."', 'selected');  
                        $('#veicor_id').val('".$retornoAlter[0]['veicor_id']."', 'selected'); 
                        $(\"input[name='veic_placa']\").val('".$retornoAlter[0]['veic_placa']."');
                        $(\"input[name='veic_chassi']\").val('".$retornoAlter[0]['veic_chassi']."');
                        $(\"input[name='veic_renavam']\").val('".$retornoAlter[0]['veic_renavam']."');
                        $(\"input[name='veic_consumo']\").val('".$retornoAlter[0]['veic_consumo']."');
                        $(\"input[name='veic_ano']\").val('".$retornoAlter[0]['veic_ano']."');
                        $('#esta').val('".$retornoAlter[0]['esta_id']."', 'selected');
                        " : "";

                        $script .= @$activeTabs."

                        $(\"#form_cadastro\").validate({
                            errorContainer: \"#warning\",
                            rules: {
                                \"sel_cli\"             : { required: true },
                                \"veic_placa\"          : { required: true },
                                \"veic_chassi\"         : { required: true },
                                \"veic_consumo\"        : { required: true },
                                \"veicic_id\"           : { required: true },
                                \"veicma_id\"           : { required: true },
                                \"veicmo_id\"           : { required: true },
                                \"veicor_id\"           : { required: true },
                                \"esta_id\"             : { required: true }
                            },
                            messages: {  
                                \"sel_cli\"             : { required: \"Favor selecionar um cliente na aba de listagem!!!\"},
                                \"veic_placa\"          : { required: \"Favor Informar a placa!\" },
                                \"veic_chassi\"         : { required: \"Favor Informar o chassi!\" },
                                \"veic_consumo\"        : { required: \"Favor Informar o consumo!\"},
                                \"veicic_id\"           : { required: \"Favor Informar o ícone!\" },
                                \"veicma_id\"           : { required: \"Favor Informar a marca!\" },
                                \"veicmo_id\"           : { required: \"Favor Informar o modelo!\" },
                                \"veicor_id\"           : { required: \"Favor selecionar a cor!\" },
                                \"esta_id\"             : { required: \"Favor Informar o estado!\" }

                            },

                            submitHandler: function(form){
                                $(form).ajaxSubmit({
                                    url: \"".PATHPRINCIPAL."/veiculo/i\",
                                    type: 'POST',
                                    target: \"#warning\",
                                    success: function(data){
                                        $(\"#dialog-message p span\").addClass(\"ui-icon-circle-check\");
                                        $(\"#dialog-message p b\").html(\"Cadastro realizada com sucesso!!!\");
                                        $(\"#dialog-message\").dialog({
                                            resizable: false,
                                            modal: true,
                                            title: \"Comunicado\",
                                            buttons: {
                                                \"Ok\": function() {
                                                    $( this ).dialog( \"destroy\" );
                                                    carregaHomeContainer(\"".PATHPRINCIPAL."/veiculo/l/0/".$_SESSION[SESSAOEMPRESA]['cli_select']."\");
                                                }
                                            }
                                        });
                                    }
                                });
                                return false;
                            }
                        });
                    });

                    $('#viBtAdd').click(function (){
                        if(document.getElementById('vicli_id').value == ''){
                            alert('Por favor Selecione um Cliente');
                            return false;
                        }else{
                            $(\"#txt_action\").val(\"adicionar\");
                            $(\".tabs\").tabs({ selected: '#formulario' });
                            $('#mask').css({'width':'100%','height':'auto'});
                        }
                    });

                    ".(@$_SESSION[SESSAOEMPRESA]['cli_select'] == "" ? "$('#abaform').attr(\"href\", \"javascript:alert('Por favor Selecione um Cliente');\");" : "" )."
                </script>";

            $sConteudo .= $script;

        }elseif($aParams['opcao'] == "i"){
            include_once('modelo/classes/Veiculo.php');
            $oVeiculo = new Veiculo();
            
            $oVeiculo->setCli_id($_SESSION[SESSAOEMPRESA]['cli_select']);
            $oVeiculo->setVeic_placa($_POST['veic_placa']);
            $oVeiculo->setVeicic_id($_POST['veicic_id']);
            $oVeiculo->setVeicma_id($_POST['veicma_id']);
            $oVeiculo->setVeicmo_id($_POST['veicmo_id']);
            $oVeiculo->setVeicor_id($_POST['veicor_id']);
            $oVeiculo->setVeic_chassi($_POST['veic_chassi']);
            $oVeiculo->setVeic_renavam($_POST['veic_renavam']);
            $oVeiculo->setVeic_consumo($_POST['veic_consumo']);
            $oVeiculo->setVeic_ano($_POST['veic_ano']);
            $oVeiculo->setEsta_id($_POST['esta']);
            $oVeiculo->setVeic_obs($_POST['veic_obs']);
            
            if($_POST['txt_action'] == 'adicionar'){
                $this->fachadaControl->inserirVeiculo($oVeiculo);
            }else{
                $oVeiculo->setVeic_id($_POST['txt_id']);
                $this->fachadaControl->alterarVeiculo($oVeiculo);
            }	

            $sConteudo = 'ok';

        }
        
        $this->setConteudo($sConteudo);
        
    }
   
}
 
?>