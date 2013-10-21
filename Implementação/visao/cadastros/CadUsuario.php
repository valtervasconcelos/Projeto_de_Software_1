<?php
include_once 'visao/Tela.php';
/**
 * Descricao da CadUsuario
 *
 * @Autor Valter Vasconcelos 11/07/2012
 * 
 */
class CadUsuario extends Tela{
    var $sConteudo;

    //Construtor da Classe
    function CadUsuario($aParams) {
        $this->fachadaControl = $this->getInstanciaControle();

        if($aParams['opcao'] == "l" || $aParams['opcao'] == "d" || $aParams['opcao'] == "a"){
            if($aParams['opcao'] == "d"){
                $this->fachadaControl->removerUsuario($aParams['registro']);
            }
            
            if ($aParams['opcao'] == "a")
                $retornoAlter = $this->fachadaControl->listarUsuarioId($aParams['registro']);
            
            if(@$aParams['param1'] != ""){
                $_SESSION[SESSAOEMPRESA]['cli_select'] = $aParams['param1'];
            }
        
            $retorno = $this->fachadaControl->listarUsuario(@$aParams['param1']);
            $retornoCliente = $this->fachadaControl->listarClienteNivel();
            $retornoUsuarioTipo = $this->fachadaControl->listarUsuarioTipo();
            $sConteudo ='
                <div class="tabs" style="margin-top: 40px;">
                    <h2 class="cabecalho">Cadastro de Usuários</h2>
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
                                    <th title="Ordenar por Login">LOGIN</th>
                                    <th title="Ordenar por Nome">NOME</th>
                                    <th title="Ordenar por Tipo">TIPO</th>
                                    <th title="Ordenar por Celular">CELULAR</th>
                                    <th title="Ordenar por Telefone">TELEFONE</th>                                    
                                    <th title="Ordenar por Data">DT.CADAS.</th>

                                    <th class="imgOrdenacao"></th>
                                </tr>	
                            </thead>
                            <tbody>';

                                if ($retorno != NULL){
                                    foreach($retorno as $ret){                                            
                                        $sConteudo .= "
                                        <tr>
                                            <td>".$ret['usr_id']."</td>
                                            <td>".$ret['usr_login']."</td>
                                            <td>".$ret['usr_dsc']."</td>
                                            <td>".$ret['usrt_dsc']."</td>
                                            <td>".$ret['usr_cel']."</td>
                                            <td>".$ret['usr_tel']."</td>
                                            <td>".$ret['usr_dtca']."</td>    
                                            <td id=\"alt\">
                                                <a title='Alterar' href='javascript:carregaHomeContainer(\"".PATHPRINCIPAL."/usuario/a/".$ret['usr_id']."/".@$aParams['param1']."\");' class=\"edit\"></a>
                                                <a title='Excluir' href=\"#\" class=\"usRemove remove\" id=\"".$ret['usr_id']."\"></a>
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
                                <h2 style="width: auto;">Formulário de Usuários</h2>
                                <div id="warning" class="warning">
                                    Os campos abaixo devem ser preenchidos ou corrigidos!
                                </div>
                                <table style="width:100%" >
                                <tr>
                                    <td>
                                    <label for="nome" style="float:left; width:45%">
                                        <strong>* Nome</strong><input type="text" name="usr_dsc" id="usr_dsc" value="" maxlength="50" />
                                    </label>
                                    <label for="tipo" style="float:right; width:45%; margin-left:10px;">
                                        <strong>* Tipo</strong>
                                            <select id="usrt_id" size="1" name="usrt_id" class="form">
                                                <option value="" selected>Selecione uma Opção</option>';                                        

                                            if ($retornoUsuarioTipo != NULL){
                                                foreach ($retornoUsuarioTipo as $ret)
                                                    $sConteudo .= " <option value='".$ret['usrt_id']."'>".$ret['usrt_dsc']."</option>";
                                            }

                                            $sConteudo .= '    

                                            </select>
                                    </label>
                                    <br class="clear">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    <label for="login" style="float:left; width:45%;">
                                        <strong>* Login</strong><input type="text" name="usr_login" id="usr_login" value="" maxlength="50" />
                                    </label>                                    
                                    <label for="senha" style="float:left; width:20%; margin-left:75px;">
                                        <strong>* Senha</strong><input type="password" name="usr_senha" id="usr_senha" value="" maxlength="10" />
                                    </label>
                                    <label for="repete" style="float:right; width:20%; margin-left:0px;">
                                        <strong>* Repete Senha</strong><input type="password" name="usr_repete" id="usr_repete" value="" maxlength="10" />                                        
                                    </label>
                                    <br class="clear">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    <label for="telefone" style="float:left;width:20%;">
                                        <strong>Telefone</strong><input class="telefone" type="text" name="usr_tel" id="usr_tel" value="" maxlength="20" />
                                    </label>                                
                                    <label for="celular" style="float:left;width:20%;margin-left:10px">
                                        <strong>Celular</strong><input class="telefone" type="text" name="usr_cel" id="usr_cel" value="" maxlength="20" />
                                    </label>
                                    <label for="email" style="float:right;width:50%;">
                                        <strong>E-Mail</strong><input type="text" name="usr_email" id="usr_email" value="" maxlength="50" />
                                    </label>
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
                                                <strong>* CEP</strong><input class="cep" type="text" name="cep" id="cep" value="" maxlength="9" />
                                            </label>
                                            <label for="rua" style="float:right; width:65%">
                                                <strong>* Rua</strong><input type="text" name="ende" id="ende" value="" maxlength="50" />
                                            </label>
                                            <br class="clear">
                                            <label for="bairro" style="float:left; width:50%">
                                                <strong>* Bairro</strong><input type="text" name="bair" id="bair" value="" maxlength="20" />
                                            </label>
                                            <label for="cidade" style="float:right; width:45%">
                                                <strong>* Cidade</strong><input type="text" name="cida" id="cida" value="" maxlength="20" />
                                            </label>
                                            <br class="clear">
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
                                            <br class="clear">

                                        </div>
                                        <div class="box-content" id="observacao">
                                            <label for="observacao" style="float:left; width:100%;">
                                                <strong>Observação</strong><textarea style="width:98%" name="usr_obs" id="usr_obs" value="" rows="6">'.@$retornoAlter[0]['usr_obs'].'</textarea>
                                            </label>                                        
                                        </div>                                
                                    </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    <br class="clear">
                                    <input type="submit" class="button button-submit" name="bt_salvar" id="salvar" value="Salvar Dados">
                                    </td>
                                </tr>
                                </table> 
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
                        
                        $('.botoes:eq(0)').append('<strong>Cliente : </strong>'+
                                             '<select class=\"form clientes\" id=\"uscli_id\" style=\"width:180px; margin-right:10px;\">'+
                                                '<option value=\"\" selected=\"selected\">Selecione o Cliente...</opition>'+";
                                                if ($retornoCliente != NULL){
                                                    foreach ($retornoCliente as $ret)
                                                        $script .= " '<option value=\"".$ret['cli_id']."\">".$ret['cli_dsc']."</option>'+";
                                                }
                                            
                                                $script .= "
                                             '</select>');";
                        
                        $script .= "                            
                        $('.botoes:eq(0)').append('<a id=\"usBtAdd\" class=\"button button-submit\" style=\"margin-top:0px;\">Novo Registro</a>');
                        $('#uscli_id').val('".@$_SESSION[SESSAOEMPRESA]['cli_select']."', 'selected');
                        
                        $(\".abas\").click(function(){
                            $(\"#form_cadastro\").reset();
                            $('#mask').css({'width':'100%','height':'auto'});
                            $(\"#txt_action\").val(\"adicionar\");
                            $('#uscli_id').val('".@$_SESSION[SESSAOEMPRESA]['cli_select']."', 'selected');
			});
                        
                        $(\"#uscli_id\").change(function(){
                            carregaHomeContainer(\"".PATHPRINCIPAL."/usuario/l/0/\"+this.value);
			});

			$(\".usRemove\").live(\"click\", function(){
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
                                            carregaHomeContainer(\"".PATHPRINCIPAL."/usuario/d/\"+codigo+\"/".$aParams['param1']."\");
                                    },
                                    \"Cancelar\": function() {
                                        $( this ).dialog(\"destroy\");
                                    }
                                }
                            });
			});

                        $('#usr_dsc').blur(function () {
                            $(this).val($(this).val().toUpperCase());
                            $.ajax({
                                url: \"".PATHPRINCIPAL."/usuario/v\",
                                type: 'POST',
                                data: {tipo: 'nome',value: $(this).val(),id: $('#txt_id').val(),acao: $('#txt_action').val()},
                                success: function(txt){
                                    if (txt == 'Erro'){
                                        alert('Nome do Usuário já existe! Verifique');
                                        $('#usr_dsc').focus();
                                        return;
                                    }
                                }
                            });
                        });
                        
                        $('#usr_login').blur(function () {
                            $.ajax({
                                url: \"".PATHPRINCIPAL."/usuario/v\",
                                type: 'POST',
                                data: {tipo: 'login',value: $(this).val(),id: $('#txt_id').val(),acao: $('#txt_action').val()},
                                success: function(txt){
                                    if (txt == 'Erro'){
                                        alert('Login do Usuario já existe! Verifique');
                                        $('#usr_login').focus();
                                        return;
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
	
			$(\"input[name='txt_id']\").val('".$retornoAlter[0]['usr_id']."');
                        $('#usrt_id').val('".$retornoAlter[0]['usrt_id']."', 'selected');
			$(\"input[name='usr_dsc']\").val('".$retornoAlter[0]['usr_dsc']."');
                        $(\"input[name='usr_login']\").val('".$retornoAlter[0]['usr_login']."');
                        $(\"input[name='usr_senha']\").val('".$retornoAlter[0]['usr_senha']."');
                        $(\"input[name='usr_repete']\").val('".$retornoAlter[0]['usr_senha']."');
			$(\"input[name='ende']\").val('".$retornoAlter[0]['usr_ende']."');
                        $(\"input[name='bair']\").val('".$retornoAlter[0]['usr_bair']."');
                        $(\"input[name='cida']\").val('".$retornoAlter[0]['usr_cida']."');
                        $('#esta').val('".$retornoAlter[0]['esta_id']."', 'selected');
                        $(\"input[name='cep']\").val('".$retornoAlter[0]['usr_cep']."');
			$(\"input[name='usr_tel']\").val('".$retornoAlter[0]['usr_tel']."');
                        $(\"input[name='usr_cel']\").val('".$retornoAlter[0]['usr_cel']."');
                        $(\"input[name='usr_email']\").val('".$retornoAlter[0]['usr_email']."');
			" : "";

			$script .= @$activeTabs."

			$(\"#form_cadastro\").validate({
                            errorContainer: \"#warning\",
                            rules: {  
                                \"sel_cli\"          : { required: true },
                                \"usr_dsc\"          : { required: true },
                                \"usr_login\"        : { required: true },
                                \"usr_senha\"        : { required: true },
                                \"usr_repete\"       : { required: true, equalTo: \"#usr_senha\" },
                                \"usrt_id\"          : { required: true },
                                \"usr_email\"        : { required: false, email: true },
                                \"cep\"              : { required: true },
                                \"ende\"             : { required: true },
                                \"bair\"             : { required: true },
                                \"cida\"             : { required: true },
                                \"esta\"             : { required: true }                                
                            },
                            messages: { 
                                \"sel_cli\"          : { required: \"Favor selecionar um cliente na aba de listagem!!!\"},
                                \"usr_dsc\"          : { required: \"Favor digitar o nome!\" },
                                \"usr_login\"        : { required: \"Favor digitar o seu login!\" },
                                \"usr_senha\"        : { required: \"Favor digitar a senha\"},
                                \"usr_repete\"       : { required: \"Favor repetir a mesma senha.\", equalTo: \"As senhas são diferentes!!!\" },
                                \"usrt_id\"          : { required: \"Favor informar o tipo!\" },
                                \"usr_email\"        : { required: false, email: \"Favor digitar um e-mail válido!\" },
                                \"cep\"              : { required: \"Favor digitar o cep!\" },
                                \"ende\"             : { required: \"Favor digitar a rua!\" },
                                \"bair\"             : { required: \"Favor digitar o bairro\" },
                                \"cida\"             : { required: \"Favor digitar a cidade!\" },
                                \"esta\"             : { required: \"Favor informar o estado!\"}
                            },
                            submitHandler: function(form){
                                $(form).ajaxSubmit({
                                    url: \"".PATHPRINCIPAL."/usuario/i\",
                                    type: 'POST',
                                    target: \"#warning\",
                                    success: function(data){                                    
                                        if (data == '1'){
                                            $(\"#dialog-message p span\").addClass(\"ui-icon-circle-check\");
                                            $(\"#dialog-message p b\").html(\"Cadastro realizado com sucesso!!!\");
                                            $(\"#dialog-message\").dialog({
                                                resizable: false,
                                                modal: true,
                                                title: \"Comunicado\",
                                                buttons: {
                                                    \"Ok\": function() {
                                                        $( this ).dialog( \"destroy\" );
                                                        carregaHomeContainer(\"".PATHPRINCIPAL."/usuario/l/0/".$_SESSION[SESSAOEMPRESA]['cli_select']."\");
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
                
                    $('#usBtAdd').click(function (){                        
                        if(document.getElementById('uscli_id').value == ''){
                            alert('Por favor Selecione um Cliente.');
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
        }elseif($aParams['opcao'] == "i"){            
            include_once('modelo/classes/Usuario.php');
            $oUsuario = new Usuario();            

            $oUsuario->setCli_id($_SESSION[SESSAOEMPRESA]['cli_select']);
            $oUsuario->setUsrt_id($_POST['usrt_id']);
            $oUsuario->setUsr_dsc($_POST['usr_dsc']);
            $oUsuario->setUsr_login($_POST['usr_login']);
            $oUsuario->setUsr_senha($_POST['usr_senha']);
            $oUsuario->setUsr_ende($_POST['ende']);
            $oUsuario->setUsr_bair($_POST['bair']);
            $oUsuario->setUsr_cida($_POST['cida']);
            $oUsuario->setEsta_id($_POST['esta']);
            $oUsuario->setUsr_cep($_POST['cep']);                        
            $oUsuario->setUsr_tel($_POST['usr_tel']);            
            $oUsuario->setUsr_cel($_POST['usr_cel']);
            $oUsuario->setUsr_email($_POST['usr_email']);
            $oUsuario->setUsr_obs($_POST['usr_obs']);

            $params = array("tipo"=>"nome","value"=>$_POST['usr_dsc'],"acao"=>$_POST['txt_action'],"id"=>$_POST['txt_id']);
            $retornoDsc = $this->fachadaControl->validarUsuario($params);
            $params = array("tipo"=>"login","value"=>$_POST['usr_login'],"acao"=>$_POST['txt_action'],"id"=>$_POST['txt_id']);
            $retornoLogin = $this->fachadaControl->validarUsuario($params);

            if($retornoDsc != 'Erro' && $retornoLogin != 'Erro'){
                if($_POST['txt_action'] == 'adicionar'){
                    $sConteudo = $this->fachadaControl->inserirUsuario($oUsuario);
                }else{
                    $oUsuario->setUsr_id($_POST['txt_id']);
                    $this->fachadaControl->alterarUsuario($oUsuario);
                    $sConteudo = '1';
                }
            }else
                $sConteudo = '0';

        }
        
        $this->setConteudo($sConteudo);
        
    }
    
    private function validarCadastro($params){
        echo $this->fachadaControl->validarUsuario($params);
    }

}

?>