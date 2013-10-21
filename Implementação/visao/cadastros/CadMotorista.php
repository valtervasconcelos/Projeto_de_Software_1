<?php
include_once 'visao/Tela.php';
/**
 * Descricao da CadMotorista
 *
 * @Autor Valter Vasconcelos 13/07/2012
 * 
 */
class CadMotorista extends Tela{
    var $sConteudo;

    //Construtor da Classe
    function CadMotorista($aParams) {
        $this->fachadaControl = $this->getInstanciaControle();

        if($aParams['opcao'] == "l" || $aParams['opcao'] == "d" || $aParams['opcao'] == "a"){
            if($aParams['opcao'] == "d"){
                $this->fachadaControl->removerMotorista($aParams['registro']);
            }
            
            if ($aParams['opcao'] == "a")
                $retornoAlter = $this->fachadaControl->listarMotoristaId($aParams['registro']);
            
            if(@$aParams['param1'] != ""){                
                $_SESSION[SESSAOEMPRESA]['cli_select'] = $aParams['param1'];
            }            

            $retorno = $this->fachadaControl->listarMotorista(@$aParams['param1']);            
            $retornoCliente = $this->fachadaControl->listarClienteNivel();
            
            $sConteudo ='
                <div class="tabs" style="margin-top: 40px;">
                    <h2 class="cabecalho">Cadastro de Motoristas</h2>
                    <ul class="tabs-nav">
                        <li><a class="abas" href="#listagem">Listagem</a></li>
                        <li><a class="abas" id="abaform" style="color:#2c82fc;" href="#formulario">Formulário</a></li>
                    </ul>
                    <form name="form_cadastro" id="form_cadastro" action="" method="POST" enctype="multipart/form-data" onsubmit="return false;">
                    <input type="hidden" name="txt_action" id="txt_action" value="" />
                    <input type="hidden" name="txt_id" id="txt_id" value="" />
                    <input type="hidden" name="sel_cli" id="sel_cli" value="'.@$_SESSION[SESSAOEMPRESA]['cli_select'].'" />
                    <div class="box-content" id="listagem" style="padding: 0px 0px 15px 0px;">
                        <table class="grid" id="grid">
                            <thead>
                                <tr>
                                    <th title="Ordenar por Código">#</th>
                                    <th title="Ordenar por Nome">NOME</th>
                                    <th title="Ordenar por Celular">CELULAR</th>
                                    <th title="Ordenar por Telefone">TELEFONE</th>
                                    <th title="Ordenar por Veículo">VEÍCULO INSTALADO</th>                                    

                                    <th class="imgOrdenacao"></th>
                                </tr>	
                            </thead>
                            <tbody>';

                                if ($retorno != NULL){
                                    foreach($retorno as $ret){                                            
                                        $sConteudo .= "
                                        <tr>
                                            <td>".$ret['moto_id']."</td>                                            
                                            <td>".$ret['moto_dsc']."</td>                                            
                                            <td>".$ret['moto_cel']."</td>
                                            <td>".$ret['moto_tel']."</td>
                                            <td>".$ret['inst_dsc']."</td>    
                                            <td id=\"alt\">
                                                <a title='Alterar' href='javascript:carregaHomeContainer(\"".PATHPRINCIPAL."/motorista/a/".$ret['moto_id']."/".@$aParams['param1']."\");' class=\"edit\"></a>
                                                <a title='Excluir' href=\"#\" class=\"mtRemove remove\" id=\"".$ret['moto_id']."\"></a>
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
                    <div class="box-content" id="formulario">                        
                        <div class="box center800">
                            <div class="box-intro">
                                <h2 style="width: auto;">Formulário de Motoristas</h2>
                                <div id="warning" class="warning">
                                    Os campos abaixo devem ser preenchidos ou corrigidos!
                                </div>
                                <table style="width:100%" >
                                <tr>
                                    <td>
                                    <div style="float:left; width:55%;">
                                        <label for="nome" style="float:left; width:100%">
                                            <strong>* Nome</strong><input type="text" name="moto_dsc" id="moto_dsc" value="" maxlength="50" tabindex="1" />
                                        </label>
                                        <label for="habilitacao" style="float:left; width:100%;">
                                            <strong>* Número Habilitação</strong><input type="text" name="moto_cmot" id="moto_cmot" value="" maxlength="15" tabindex="4" />
                                        </label>                                    
                                        <label for="telefone" style="float:left;width:45%;">
                                            <strong>Telefone</strong><input class="telefone" type="text" name="moto_tel" id="moto_tel" value="" maxlength="20" tabindex="7" />
                                        </label>                                
                                        <label for="celular" style="float:right; width:45%;">
                                            <strong>Celular</strong><input class="telefone" type="text" name="moto_cel" id="moto_cel" value="" maxlength="20" tabindex="8" />
                                        </label>
                                    </div>
                                    <div style="float:right; width:40%;">
                                        <label for="identidade" style="float:left; width:45%;">
                                            <strong>* Identidade</strong><input class="rg" type="text" name="moto_iden" id="moto_iden" value="" maxlength="9" tabindex="2" />
                                        </label>
                                        <label for="cpf" style="float:right; width:45%;">
                                            <strong>* CPF</strong><input type="text" class="cpf" name="moto_cpf" id="moto_cpf" value="" maxlength="14" tabindex="3" />
                                        </label>                                    
                                        <label for="vencimento" style="float:left; width:45%;">
                                            <strong>Venc.Cart.Motorista</strong><input class="data" type="text" name="moto_cmotvc" id="moto_cmotvc" value="" tabindex="5" />
                                        </label>
                                        <label for="admissao" style="float:right; width:45%;">
                                            <strong>Data Admissão</strong><input class="data" type="text" name="moto_dtadm" id="moto_dtadm" value="'.date('d/m/Y').'" tabindex="6" />
                                        </label>
                                        <script>
                                        $(function() {
                                            $( "#moto_cmotvc" ).datepicker();
                                            $( "#moto_dtadm" ).datepicker();
                                        });
                                        </script>
                                        <div class="limpa"></div>
                                    </div>
                                    <br class="clear">
                                    </td>
                                 </tr> 
                                 <tr>
                                    <td>
                                        <div class="tabs" style="margin-top: 20px; float:left; width:100%;">
                                        <h2 class="cabecalho" style="width:98%;">Outros Dados</h2>
                                        <ul class="tabs-nav">
                                            <li><a style="color:#2c82fc;" href="#endereco">Endereço</a></li>
                                            <li><a style="color:#2c82fc;" href="#observacao">Observacao</a></li>
                                        </ul>
                                        <div class="box-content" id="endereco" style="padding: 0px 0px 15px 0px;">
                                            <label for="cep" style="float:left; width:25%">
                                                <strong>* CEP</strong><input class="cep" type="text" name="cep" id="cep" value="" maxlength="9" tabindex="9" />
                                            </label>
                                            <label for="rua" style="float:right; width:65%">
                                                <strong>* Rua</strong><input type="text" name="ende" id="ende" value="" maxlength="50" />
                                            </label>                                      
                                            <label for="bairro" style="float:left; width:50%">
                                                <strong>* Bairro</strong><input type="text" name="bair" id="bair" value="" maxlength="20" />
                                            </label>
                                            <label for="cidade" style="float:right; width:45%">
                                                <strong>* Cidade</strong><input type="text" name="cida" id="cida" value="" maxlength="20" />
                                            </label>                                        
                                            <label for="estado" style="float:left; width:45%">
                                                <strong>* Estado</strong>
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
                                        </div>
                                        <div class="box-content" id="observacao">
                                            <label for="observacao" style="float:left; width:100%;">
                                                <strong>Observação</strong><textarea style="width:98%" name="moto_obs" id="moto_obs" value="" rows="6">'.@$retornoAlter[0]['moto_obs'].'</textarea>
                                            </label>                                        
                                        </div>                                
                                    </div>
                                    </td>
                                 </tr> 
                                 <tr>
                                    <td>
                                        <input type="submit" class="button button-submit" name="bt_salvar" id="salvar" value="Salvar Dados" />
                                    </td>
                                 </tr>
                                 <tr>
                                     
                            </div>
                        </div>
                    </div>                    
                    </form>
                </div>
                
                <br class="clear">';

            $script =
                "<script type=\"text/javascript\">
                    $('document').ready(function(){
			$(\".tabs\").tabs();			
			$('#grid').dataTable( {
                            \"bRetrieve\":true,
                            \"sScrollY\": \"350px\"
                        } );
                        $(\".telefone\").mask(\"(99)9999-9999\");                        
                        $(\".cep\").mask(\"99999-999\");
                        $(\".rg\").mask(\"9.999.999\");
                        $(\".cpf\").mask(\"999.999.999-99\");
                        $(\".data\").mask(\"99/99/9999\");

                        $('.botoes:eq(0)').append('<strong>Cliente : </strong>'+
                                             '<select class=\"form clientes\" id=\"mtcli_id\" style=\"width:180px; margin-right:10px;\">'+
                                                '<option value=\"\" selected=\"selected\">Selecione o Cliente...</opition>'+";
                                                if ($retornoCliente != NULL){
                                                    foreach ($retornoCliente as $ret)
                                                        $script .= " '<option value=\"".$ret['cli_id']."\">".$ret['cli_dsc']."</option>'+";
                                                }
                                            
                                                $script .= "
                                             '</select>');";
                        
                        
                        $script .= "
                        $('.botoes:eq(0)').append('<a id=\"mtBtAdd\" class=\"button button-submit\" style=\"margin-top:0px;\">Novo Registro</a>');
                        $('#mtcli_id').val('".@$_SESSION[SESSAOEMPRESA]['cli_select']."', 'selected');

                        $(\".abas\").click(function(){
                            $(\"#form_cadastro\").reset();                            
                            $('#mask').css({'width':'100%','height':'auto'});
                            $(\"#txt_action\").val(\"adicionar\");
                            $('#mtcli_id').val('".@$_SESSION[SESSAOEMPRESA]['cli_select']."', 'selected');
			});
                        
                        $(\"#mtcli_id\").change(function(){
                            carregaHomeContainer(\"".PATHPRINCIPAL."/motorista/l/0/\"+this.value);
			});

                        $(\".mtRemove\").live(\"click\", function(){
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
                                            carregaHomeContainer(\"".PATHPRINCIPAL."/motorista/d/\"+codigo+\"/".$aParams['param1']."\");
                                    },
                                    \"Cancelar\": function() {
                                        $( this ).dialog(\"destroy\");
                                    }
                                }
                            });
			});
                        
                        $('#cep').blur(function (){
                           getEndereco();
                        });";
                        
			$activeTabs = ($aParams['opcao'] == "a") ? "
			$(\".tabs\").tabs({ selected: '#formulario' });
			$(\"#txt_action\").val(\"alterar\");
                        $('#mask').css({'width':'100%','height':'auto'});
	
			$(\"input[name='txt_id']\").val('".$retornoAlter[0]['moto_id']."');
			$(\"input[name='moto_dsc']\").val('".$retornoAlter[0]['moto_dsc']."');                        
			$(\"input[name='ende']\").val('".$retornoAlter[0]['moto_ende']."');			
                        $(\"input[name='bair']\").val('".$retornoAlter[0]['moto_bair']."');
                        $(\"input[name='cida']\").val('".$retornoAlter[0]['moto_cida']."');			
                        $('#esta').val('".$retornoAlter[0]['esta_id']."', 'selected');
                        $(\"input[name='moto_iden']\").val('".$retornoAlter[0]['moto_iden']."');
                        $(\"input[name='moto_cmot']\").val('".$retornoAlter[0]['moto_cmot']."');
                        $(\"input[name='moto_cmotvc']\").val('".$retornoAlter[0]['moto_cmotvc']."');
                        $(\"input[name='moto_cpf']\").val('".$retornoAlter[0]['moto_cpf']."');
                        $(\"input[name='moto_dtadm']\").val('".$retornoAlter[0]['moto_dtadm']."');
                        $(\"input[name='cep']\").val('".$retornoAlter[0]['moto_cep']."');			
			$(\"input[name='moto_tel']\").val('".$retornoAlter[0]['moto_tel']."');			
                        $(\"input[name='moto_cel']\").val('".$retornoAlter[0]['moto_cel']."');                        
			" : "";
			
			$script .= @$activeTabs."
			
			$(\"#form_cadastro\").validate({
                            errorContainer: \"#warning\",
                            rules: {
                                \"sel_cli\"          : { required: true },
                                \"moto_dsc\"          : { required: true },
                                \"moto_iden\"          : { required: true },
                                \"moto_cpf\"          : { required: true, validaCPF: true },
                                \"moto_cmot\"          : { required: true },
                                \"cep\"          : { required: true },
                                \"ende\"             : { required: true },
                                \"bair\"             : { required: true },
                                \"cida\"             : { required: true },
                                \"esta\"             : { required: true }
                            },
                            messages: {                                
                                \"sel_cli\"          : { required: \"Favor selecionar um cliente na aba de listagem!!!\"},
                                \"moto_dsc\"          : { required: \"Favor digitar o nome!\" },
                                \"moto_iden\"          : { required: \"Favor digitar o rg!\" },
                                \"moto_cpf\"          : { required: \"Favor digitar o cpf!\", validaCPF: \"CPF inválido!!!\" },
                                \"moto_cmot\"          : { required: \"Favor digitar o número da habilitação!\" },
                                \"cep\"          : { required: \"Favor digitar o cep!\" },
                                \"ende\"             : { required: \"Favor digitar a rua!\" },
                                \"bair\"             : { required: \"Favor digitar o bairro\" },
                                \"cida\"             : { required: \"Favor digitar a cidade!\" },
                                \"esta\"             : { required: \"Favor informar o estado!\"}
                            },
                            submitHandler: function(form){
                                $(form).ajaxSubmit({
                                    url: \"".PATHPRINCIPAL."/motorista/i\",
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
                                                    carregaHomeContainer(\"".PATHPRINCIPAL."/motorista/l/0/".$_SESSION[SESSAOEMPRESA]['cli_select']."\");
                                                }
                                            }
                                        });
                                    }
                                });
                                return false;
                            }
			});
                    });

                    $('#mtBtAdd').click(function (){                        
                        if(document.getElementById('mtcli_id').value == ''){
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
            
        }elseif($aParams['opcao'] == "v"){
            $params = array("tipo"=>$_POST['tipo'],"value"=>$_POST['value'],"acao"=>$_POST['acao'],"id"=>$_POST['id']);            
            $this->validarCadastro($params);
        }elseif($aParams['opcao'] == "lmc"){
            $respMot = $this->fachadaControl->listarMotoristaPorCliente($aParams['registro']);
            $sConteudo ='
            <option value="" selected>Selecione uma Opção</option>';                                        
            if ($respMot != NULL){
                foreach ($respMot as $ret)
                $sConteudo .= ' <option value="'.$ret['moto_id'].'">'.$ret['moto_dsc'].'</option>';
            }
        }elseif($aParams['opcao'] == "i"){
            include_once('modelo/classes/Motorista.php');
            $oMotorista = new Motorista();            
            $oMotorista->setCli_id($_SESSION[SESSAOEMPRESA]['cli_select']);            
            $oMotorista->setmoto_dsc($_POST['moto_dsc']);            
            $oMotorista->setmoto_ende($_POST['ende']);
            $oMotorista->setmoto_bair($_POST['bair']);
            $oMotorista->setmoto_cida($_POST['cida']);
            $oMotorista->setEsta_id($_POST['esta']);
            $oMotorista->setmoto_cep($_POST['cep']);
            $oMotorista->setmoto_iden($_POST['moto_iden']);
            $oMotorista->setmoto_cmot($_POST['moto_cmot']);
            $oMotorista->setMoto_cmotvc($_POST['moto_cmotvc']);
            $oMotorista->setMoto_cpf($_POST['moto_cpf']);
            $oMotorista->setMoto_dtadm($_POST['moto_dtadm']);
            $oMotorista->setmoto_tel($_POST['moto_tel']);            
            $oMotorista->setmoto_cel($_POST['moto_cel']);
            $oMotorista->setmoto_obs($_POST['moto_obs']);

            if($_POST['txt_action'] == 'adicionar'){
                $this->fachadaControl->inserirMotorista($oMotorista);
            }else{
                $oMotorista->setmoto_id($_POST['txt_id']);
                $this->fachadaControl->alterarMotorista($oMotorista);
            }	

            $sConteudo = 'ok';

        }
        
        $this->setConteudo($sConteudo);
        
    }

}

?>