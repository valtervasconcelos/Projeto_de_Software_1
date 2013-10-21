<?php
include_once 'visao/Tela.php';
/**
 * Descricao da CadCliente
 *
 * @Autor Valter Vasconcelos 06/07/2012
 * 
 */
class CadCliente extends Tela{
    var $sConteudo;

    //Construtor da Classe
    function CadCliente($aParams) {
        $this->fachadaControl = $this->getInstanciaControle();
                        
        if($aParams['opcao'] == "l" || $aParams['opcao'] == "d" || $aParams['opcao'] == "a"){
            if($aParams['opcao'] == "d"){
                $this->fachadaControl->removerCliente($aParams['registro']);
            }
            
            if ($aParams['opcao'] == "a")
                $retornoAlter = $this->fachadaControl->listarClienteId($aParams['registro']);
        
            $retorno = $this->fachadaControl->listarCliente();
            $sConteudo ='
                <div class="tabs" style="margin-top: 40px;">
                    <h2 class="cabecalho">Cadastro de Clientes</h2>
                    <ul class="tabs-nav">
                        <li><a class="abas" href="#listagem">Listagem</a></li>
                        <li><a class="abas" style="color:#2c82fc;" href="#formulario">Formulário</a></li>                        
                    </ul>
                    <div class="box-content" id="listagem" style="padding: 0px 0px 15px 0px;">
                        <table class="grid" id="grid">
                            <thead>
                                <tr>
                                    <th title="Ordenar por Código">#</th>
                                    <th title="Ordenar por Sigla">SIGLA</th>
                                    <th title="Ordenar por Pessoa">CPF/CNPJ</th>
                                    <th title="Ordenar por Nome">NOME</th>
                                    <th title="Ordenar por Celular">CELULAR</th>
                                    <th title="Ordenar por Telefone">TELEFONE</th>
                                    <th title="Ordenar por Instalação">INSTALAÇÃO</th>
                                    <th title="Ordenar por Data">DT.CADAS.</th>

                                    <th class="imgOrdenacao"></th>
                                </tr>	
                            </thead>
                            <tbody>';

                                if ($retorno != NULL){
                                    foreach($retorno as $ret){
                                        $cor = ($ret['cli_mae_dsc']!=""?"style='background-color:#FFC79A' title='Matriz: ".$ret['cli_mae_dsc']."'":"");
                                        $sConteudo .= "
                                        <tr ".$cor.">
                                            <td>".$ret['cli_id']."</td>
                                            <td>".$ret['cli_sigla']."</td>
                                            <td>".$ret['cli_cpfcnpj']."</td>
                                            <td>".$ret['cli_dsc']."</td>
                                            <td>".$ret['cli_cel']."</td>
                                            <td>".$ret['cli_tel']."</td>
                                            <td>".$ret['inst_total']."</td>
                                            <td>".$ret['dtca']."</td>
                                            <td id=\"alt\">
                                                <a title='Alterar' href='javascript:carregaHomeContainer(\"".PATHPRINCIPAL."/cliente/a/".$ret['cli_id']."\");' class=\"edit\"></a>                                                
                                                ".($ret['inst_total'] == "0" ? "<a title='Excluir' href=\"#\" class=\"clRemove remove\" id=\"".$ret['cli_id']."\"></a>" : "")."
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
                    <div class="box-content" id="formulario">                        
                        <div class="box center800">
                            <div class="box-intro">
                                <h2 style="width: auto;">Formulário de Clientes</h2>
                                <div id="warning" class="warning">
                                    Os campos abaixo devem ser preenchidos ou corrigidos!
                                </div>
                                <table style="width:100%" >
                                <tr>
                                    <td>
                                    <label for="nome" style="float:left; width:45%">
                                    <strong>* Nome</strong><input type="text" name="cli_dsc" id="cli_dsc" value="" maxlength="50" />
                                    </label>
                                    <label for="sigla" style="float:left; width:20%; margin-left:10px;">
                                        <strong>* Sigla</strong><input type="text" name="cli_sigla" id="cli_sigla" value="" maxlength="10" />
                                    </label>
                                    <label for="pessoa" style="float:right; width:30%; margin-left:10px;">
                                        <strong>* Pessoa</strong>
                                            <select id="pess_id" size="1" name="pess_id" class="form">
                                            <option value="">Selecione uma Opção</option>
                                            <option value="F">Física</option>
                                            <option value="J">Jurídica</option>                                            
                                            </select>
                                    </label>
                                    <br class="clear">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    <label for="matriz" style="float:left; width:45%">
                                        <strong>Cliente Mãe</strong>
                                            <select id="cli_mae" size="1" name="cli_mae" class="form">
                                                <option value="NULL" selected>Selecione uma Opção</option>';                                        

                                            if ($retorno != NULL){
                                                foreach ($retorno as $ret)
                                                    $sConteudo .= " <option value='".$ret['cli_id']."'>".$ret['cli_dsc']."</option>";
                                            }

                                            $sConteudo .= '    

                                            </select>
                                    </label>                                    

                                    <label for="cgccpf" style="float:right; width:45%">
                                        <strong>* CPF / CNPJ</strong><input type="text" name="cli_cpfcnpj" id="cli_cpfcnpj" value="" maxlength="20" />
                                    </label>
                                    <br class="clear">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    <label for="inscestadual" style="float:left; width:40%">
                                    <strong>Insc.Estadual</strong><input type="text" name="cli_inse" id="cli_inse" value="" maxlength="20" />
                                    </label>
                                    <label for="inscmunicipal" style="float:right;width:45%;margin-left:10px">
                                        <strong>Insc.Municipal</strong><input type="text" name="cli_insm" id="cli_insm" value="" maxlength="20" />
                                    </label>          

                                    <br class="clear">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    <label for="telefone1" style="float:left;width:18%;">
                                    <strong>1º Telefone</strong><input class="telefone" type="text" name="cli_tel" id="cli_tel" value="" maxlength="20" />
                                    </label>
                                    <label for="telefone2" style="float:left;width:18%;margin-left:10px">
                                        <strong>2º Telefone</strong><input class="telefone" type="text" name="cli_tel2" id="cli_tel2" value="" maxlength="20" />
                                    </label>
                                    <label for="telefone3" style="float:left;width:18%;margin-left:10px">
                                        <strong>1º Celular</strong><input class="telefone" type="text" name="cli_cel" id="cli_cel" value="" maxlength="20" />
                                    </label>
                                    <label for="telefone4" style="float:left;width:18%;margin-left:10px">
                                        <strong>2º Celular</strong><input class="telefone" type="text" name="cli_cel2" id="cli_cel2" value="" maxlength="20" />
                                    </label>
                                    <label for="fax" style="float:right;width:18%;margin-left:10px">
                                        <strong>Fax</strong><input class="telefone" type="text" name="cli_fax" id="cli_fax" value="" maxlength="20" />
                                    </label>
                                    <br class="clear">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    <label for="email" style="float:left;width:30%;">
                                    <strong>E-Mail</strong><input type="text" name="cli_email" id="cli_email" value="" maxlength="50" />
                                    </label>                                
                                    <label for="homepage" style="float:left;width:30%;margin-left:10px">
                                        <strong>Homepage</strong><input type="text" name="cli_homepage" id="cli_homepage" value="" maxlength="50" />
                                    </label>
                                    <label for="imagem" style="float:left;width:30%;margin-left:10px">
                                        <strong>Logo Marca</strong><input type="text" name="cli_logo" id="cli_logo" value="'.$_SESSION[SESSAOEMPRESA]['cli_logo'].'" maxlength="50" readonly />
                                    </label>
                                    <label for="fuso" style="float:right;width:5%;">
                                        <strong>* Fuso</strong><input type="text" name="cli_fuso" id="cli_fuso" value="-3" maxlength="2" />
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
                                            <li><a style="color:#2c82fc;" href="#seguranca">Segurança</a></li>
                                            <li><a style="color:#2c82fc;" href="#procedimento">Procedimento</a></li>
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
                                                    <option value="ES">Espírito Santo</option>
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
                                        <div class="box-content" id="seguranca">
                                            <label for="senhavoz" style="float:left; width:45%;">
                                                <strong>Senha de Voz</strong><input type="text" name="cli_senhavoz" id="cli_senhavoz" value="" maxlength="50" />
                                            </label>
                                            <label for="pergunta" style="float:right; width:45%; margin-left:10px;">
                                                <strong>Pergunta Secreta</strong><input type="text" name="cli_pergunta" id="cli_pergunta" value="" maxlength="50" />
                                            </label>                                        
                                            <label for="reposta" style="float:left; width:45%;">
                                                <strong>Resposta</strong><input type="text" name="cli_resposta" id="cli_resposta" value="" maxlength="50" />
                                            </label>
                                            <label for="coacao" style="float:right; width:45%; margin-left:10px;">
                                                <strong>Resposta de Coação</strong><input type="text" name="cli_coasao" id="cli_coasao" value="" maxlength="50" />
                                            </label>

                                            <br class="clear">
                                        </div>
                                        <div class="box-content" id="procedimento">
                                            <label for="contato1" style="float:left; width:45%;">
                                                <strong>1º Contato</strong><input type="text" name="cli_cont1" id="cli_cont1" value="" maxlength="20" />
                                            </label>
                                            <label for="telefon1" style="float:right; width:45%; margin-left:10px;">
                                                <strong>1º Telefone</strong><input class="telefone" type="text" name="cli_tel01" id="cli_tel01" value="" maxlength="13" />
                                            </label>
                                            <label for="contato2" style="float:left; width:45%;">
                                                <strong>2º Contato</strong><input type="text" name="cli_cont2" id="cli_cont2" value="" maxlength="13" />
                                            </label>
                                            <label for="telefon2" style="float:right; width:45%; margin-left:10px;">
                                                <strong>2º Telefone</strong><input class="telefone" type="text" name="cli_tel02" id="cli_tel02" value="" maxlength="20" />
                                            </label>
                                            <label for="contato3" style="float:left; width:45%;">
                                                <strong>3º Contato</strong><input type="text" name="cli_cont3" id="cli_cont3" value="" maxlength="20" />
                                            </label>
                                            <label for="telefon3" style="float:right; width:45%; margin-left:10px;">
                                                <strong>3º Telefone</strong><input class="telefone" type="text" name="cli_tel03" id="cli_tel03" value="" maxlength="20" />
                                            </label>


                                            <br class="clear">

                                        </div>
                                        <div class="box-content" id="observacao">
                                            <label for="observacao" style="float:left; width:100%;">
                                                <strong>Observação</strong><textarea style="width:98%" name="cli_obs" id="cli_obs" value="" rows="6">'.@$retornoAlter[0]['cli_obs'].'</textarea>
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
                </div>';

            $script =
                "<script type=\"text/javascript\">
                    $('document').ready(function(){

			$(\".tabs\").tabs();			
			$('#grid').dataTable( {
                            \"bRetrieve\":true,
                            \"sScrollY\": \"350px\"
                        } );
                        $(\".telefone\").mask(\"(99)9999-9999\");
                        $(\".cpf\").mask(\"999.999.999-99\");
                        $(\".cep\").mask(\"99999-999\");
                        $(\".data\").mask(\"99/99/9999\");
                        $('.tabs').fadeTo(\"slow\",9);
			
			$(\".abas\").click(function(){
                            $(\"#form_cadastro\").reset();
                            $('#mask').css({'width':'100%','height':'auto'});
                            $(\"#txt_action\").val(\"adicionar\");
			});
			
			$('.botoes:eq(0)').append('<a id=\"clBtAdd\" class=\"button button-submit\" style=\"margin-top:0px;\">Novo Registro</a>');
			
			$(\"#clBtAdd\").live(\"click\",function(){                            
                            $(\"#form_cadastro\").reset();
                            $(\"#txt_action\").val(\"adicionar\");
                            $(\".tabs\").tabs({ selected: '#formulario' });
                            $('#mask').css({'width':'100%','height':'auto'});
			});

			$(\".clRemove\").live(\"click\", function(){
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
                                            carregaHomeContainer(\"".PATHPRINCIPAL."/cliente/d/\"+codigo);
                                    },
                                    \"Cancelar\": function() {
                                        $( this ).dialog(\"destroy\");
                                    }
                                }
                            });
			});
                        
                        $('#cli_cpfcnpj').blur(function (){
                           validar(this);
                        });
                        
                        $('#cli_dsc').blur(function () {
                            $(this).val($(this).val().toUpperCase());
                            $.ajax({
                                url: \"".PATHPRINCIPAL."/cliente/v\",
                                type: 'POST',
                                data: {tipo: 'nome',value: $(this).val(),id: $('#txt_id').val(),acao: $('#txt_action').val()},
                                success: function(txt){
                                    if (txt == 'Erro'){                                     
                                        alert('Descrição do Cliente já existe! Verifique');
                                        $('#cli_dsc').focus();
                                        return;
                                    }
                                }
                            });
                        });
                        
                        $('#cli_sigla').blur(function () {
                            $(this).val($(this).val().toUpperCase());
                            $.ajax({
                                url: \"".PATHPRINCIPAL."/cliente/v\",
                                type: 'POST',
                                data: {tipo: 'sigla',value: $(this).val(),id: $('#txt_id').val(),acao: $('#txt_action').val()},
                                success: function(txt){
                                    if (txt == 'Erro'){                                     
                                        alert('Sigla do Cliente já existe! Verifique');
                                        $('#cli_sigla').focus();
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
	
			$(\"input[name='txt_id']\").val('".$retornoAlter[0]['cli_id']."');
                        $('#cli_mae').val('".$retornoAlter[0]['cli_mae']."', 'selected');
			$(\"input[name='cli_dsc']\").val('".$retornoAlter[0]['cli_dsc']."');
                        $(\"input[name='cli_sigla']\").val('".$retornoAlter[0]['cli_sigla']."');
                        $('#pess_id').val('".$retornoAlter[0]['pess_id']."', 'selected');
			$(\"input[name='ende']\").val('".$retornoAlter[0]['cli_ende']."');			
                        $(\"input[name='bair']\").val('".$retornoAlter[0]['cli_bair']."');
                        $(\"input[name='cida']\").val('".$retornoAlter[0]['cli_cida']."');
			$(\"input[name='esta']\").val('".$retornoAlter[0]['esta_id']."');
                        $('#esta').val('".$retornoAlter[0]['esta_id']."', 'selected');
                        $(\"input[name='cep']\").val('".$retornoAlter[0]['cli_cep']."');
			$(\"input[name='cli_cpfcnpj']\").val('".$retornoAlter[0]['cli_cpfcnpj']."');			
			$(\"input[name='cli_inse']\").val('".$retornoAlter[0]['cli_inse']."');
                        $(\"input[name='cli_insm']\").val('".$retornoAlter[0]['cli_insm']."');
			$(\"input[name='cli_tel']\").val('".$retornoAlter[0]['cli_tel']."');			
			$(\"input[name='cli_tel2']\").val('".$retornoAlter[0]['cli_tel2']."');
                        $(\"input[name='cli_cel']\").val('".$retornoAlter[0]['cli_cel']."');
			$(\"input[name='cli_cel2']\").val('".$retornoAlter[0]['cli_cel2']."');			
			$(\"input[name='cli_fax']\").val('".$retornoAlter[0]['cli_fax']."');
                        $(\"input[name='cli_email']\").val('".$retornoAlter[0]['cli_email']."');
			$(\"input[name='cli_homepage']\").val('".$retornoAlter[0]['cli_homepage']."');			
			$(\"input[name='cli_fuso']\").val('".$retornoAlter[0]['cli_fuso']."');
                        $(\"input[name='cli_senhavoz']\").val('".$retornoAlter[0]['cli_senhavoz']."');
			$(\"input[name='cli_pergunta']\").val('".$retornoAlter[0]['cli_pergunta']."');
			$(\"input[name='cli_resposta']\").val('".$retornoAlter[0]['cli_resposta']."');
                        $(\"input[name='cli_coasao']\").val('".$retornoAlter[0]['cli_coasao']."');			
			$(\"input[name='cli_cont1']\").val('".$retornoAlter[0]['cli_cont1']."');
                        $(\"input[name='cli_tel01']\").val('".$retornoAlter[0]['cli_tel01']."');
			$(\"input[name='cli_cont2']\").val('".$retornoAlter[0]['cli_cont2']."');
			$(\"input[name='cli_tel02']\").val('".$retornoAlter[0]['cli_tel02']."');
                        $(\"input[name='cli_cont3']\").val('".$retornoAlter[0]['cli_cont3']."');
			$(\"input[name='cli_tel03']\").val('".$retornoAlter[0]['cli_tel03']."');
                        $(\"input[name='cli_logo']\").val('".$retornoAlter[0]['cli_logo']."');
			" : "";
			
			$script .= @$activeTabs."
			
			
			$(\"#form_cadastro\").validate({
                            errorContainer: \"#warning\",
                            rules: {                                
                                \"cli_dsc\"          : { required: true },
                                \"cli_sigla\"        : { required: true },
                                \"pess_id\"          : { required: true },
                                \"cli_cpfcnpj\"      : { required: true },
                                \"cli_email\"        : { required: false, email: true },
                                \"cep\"              : { required: true },
                                \"ende\"             : { required: true },
                                \"bair\"             : { required: true },
                                \"cida\"             : { required: true },
                                \"esta\"             : { required: true },
                                \"valido\"           : { required: true },
                                \"cli_fuso\"         : { required: true }
                            },
                            messages: {                                
                                \"cli_dsc\"          : { required: \"Favor digitar o nome!\" },
                                \"cli_sigla\"        : { required: \"Favor digitar a sigla!\" },
                                \"pess_id\"          : { required: \"Favor informar o tipo de pessoa!\" },
                                \"cli_cpfcnpj\"      : { required: \"Fovor digitar o CPF ou o CNPJ\"},
                                \"cli_email\"        : { required: false, email: \"Favor digitar um e-mail válido!\" },
                                \"cep\"              : { required: \"Favor digitar o cep!\" },
                                \"ende\"             : { required: \"Favor digitar a rua!\" },
                                \"bair\"             : { required: \"Favor digitar o bairro\" },
                                \"cida\"             : { required: \"Favor digitar a cidade!\" },
                                \"esta\"             : { required: \"Favor informar o estado!\"},
                                \"valido\"           : { required: true },
                                \"cli_fuso\"         : { required: \"Favor digitar o fuso horário!\" }
                            },
                            submitHandler: function(form){
                                $(form).ajaxSubmit({
                                    url: \"".PATHPRINCIPAL."/cliente/i\",
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
                                                        carregaHomeContainer(\"".PATHPRINCIPAL."/cliente/l\");
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
            include_once('modelo/classes/Cliente.php');
            $oCliente = new Cliente();

            $oCliente->setCli_mae($_POST['cli_mae']);
            $oCliente->setCli_dsc($_POST['cli_dsc']);
            $oCliente->setCli_sigla($_POST['cli_sigla']);
            //$oCliente->setCli_logo($_POST['cli_logo']);
            $oCliente->setCli_logo($_SESSION[SESSAOEMPRESA]['cli_logo']);
            $oCliente->setPess_id($_POST['pess_id']);
            $oCliente->setCli_ende($_POST['ende']);
            $oCliente->setCli_bair($_POST['bair']);
            $oCliente->setCli_cida($_POST['cida']);
            $oCliente->setEsta_id($_POST['esta']);
            $oCliente->setCli_cep($_POST['cep']);
            $oCliente->setCli_cpfcnpj($_POST['cli_cpfcnpj']);
            $oCliente->setCli_inse($_POST['cli_inse']);
            $oCliente->setCli_insm($_POST['cli_insm']);
            $oCliente->setCli_tel($_POST['cli_tel']);
            $oCliente->setCli_tel2($_POST['cli_tel2']);
            $oCliente->setCli_cel($_POST['cli_cel']);
            $oCliente->setCli_cel2($_POST['cli_cel2']);
            $oCliente->setCli_fax($_POST['cli_fax']);
            $oCliente->setCli_email($_POST['cli_email']);
            $oCliente->setCli_homepage($_POST['cli_homepage']);
            $oCliente->setCli_fuso($_POST['cli_fuso']);
            $oCliente->setCli_senhavoz($_POST['cli_senhavoz']);
            $oCliente->setCli_pergunta($_POST['cli_pergunta']);
            $oCliente->setCli_resposta($_POST['cli_resposta']);
            $oCliente->setCli_coasao($_POST['cli_coasao']);            
            $oCliente->setCli_obs($_POST['cli_obs']);
            $oCliente->setCli_cont1($_POST['cli_cont1']);            
            $oCliente->setCli_tel01($_POST['cli_tel01']);
            $oCliente->setCli_cont2($_POST['cli_cont2']);            
            $oCliente->setCli_tel02($_POST['cli_tel02']);            
            $oCliente->setCli_cont3($_POST['cli_cont3']);            
            $oCliente->setCli_tel03($_POST['cli_tel03']);

            $params = array("tipo"=>"nome","value"=>$_POST['cli_dsc'],"acao"=>$_POST['txt_action'],"id"=>$_POST['txt_id']);
            $retornoDsc = $this->fachadaControl->validarCliente($params);
            $params = array("tipo"=>"sigla","value"=>$_POST['cli_sigla'],"acao"=>$_POST['txt_action'],"id"=>$_POST['txt_id']);
            $retornoSigla = $this->fachadaControl->validarCliente($params);

            if($retornoDsc != 'Erro' && $retornoSigla != 'Erro'){
                if($_POST['txt_action'] == 'adicionar'){
                    $this->fachadaControl->inserirCliente($oCliente);
                }else{
                    $oCliente->setCli_id($_POST['txt_id']);
                    $this->fachadaControl->alterarCliente($oCliente);
                }	

                $sConteudo = 'ok';
            }else
                $sConteudo = 'Erro';

        }elseif($aParams['opcao'] == "lic"){
            $respVec = $this->fachadaControl->listarInstalacaoPorCliente($aParams['registro']);
            $sConteudo ='
            <option value="" selected>Selecione uma Opção</option>';                                        
            if ($respVec != NULL){
                foreach ($respVec as $ret)
                $sConteudo .= ' <option value="'.$ret['inst_id'].'">'.$ret['inst_dsc'].'</option>';
            }
        }elseif($aParams['opcao'] == "lvc"){
            $retInstCliCerca = $this->fachadaControl->listarInstalacaoPorClienteCerca($aParams['registro'], $aParams['param1']);            
            $retCarcaTipo    = $this->fachadaControl->listarInstalacaoCercaTipo();
            
            if ($retCarcaTipo != NULL){
                $ctoption = "";
                $f = 0;
                foreach ($retCarcaTipo as $ret){
                    $ctoption .= "<option ".($f == 0 ? "selected='selected'" : "" )." value='{$ret['instcert_id']}'>{$ret['instcert_dsc']}</option>";
                    $f++;
                }
            }

            $sConteudo = '<div class="accordion-event" id="veiculoAcordion">';

            if ($retInstCliCerca != NULL){
                $timepicker   = "";
                $optionSelect = "";
                
                foreach ($retInstCliCerca as $ret){
                    $timepicker .= "$('#dtini_".$ret['inst_id']."').datetimepicker();
                                    $('#dtfim_".$ret['inst_id']."').datetimepicker();";
                    
                    $optionSelect .= "$('#instcert_id_".$ret['inst_id']."').val('".$ret['instcert_id']."', 'selected');";
                    $cor = (@$ret['dtini'] != "" ? "background-color:#ffffcc" : "");

                    $sConteudo .= '
                    <h3><a href="javascript:return false;" style="margin-left:20px;'.$cor.'">Instalação :'.$ret['inst_id'].'   <span style="float:right;"><b>Veículo : </b><font style="color:#B12611;">'.$ret['inst_dsc'].'</font></span></a></h3>
                    <div id="cerc'.$ret['inst_id'].'">
                        <label style="float:left; width:20%;">
                            <strong>Data/Hora Início</strong><input type="text" class="instcer_dtini data" name="instcer_dtini[]" id="dtini_'.$ret['inst_id'].'" value="'.@$ret['dtini'].'" />
                        </label>
                        <label style="float:left; margin-left:20px; width:20%;">
                            <strong>Data/Hora Final</strong><input type="text" class="instcer_dtfim data" name="instcer_dtfim[]" id="dtfim_'.$ret['inst_id'].'" value="'.@$ret['dtfim'].'" />
                        </label>
                        <label style="float:left; margin-left:20px; width:20%;">
                            <strong>Tipo</strong>
                            <select class="instcert_id" name="instcert_id[]" id="instcert_id_'.$ret['inst_id'].'" size="1" style="width:150px;">
                                '.$ctoption.'
                            </select>
                        </label>
                        <label style="float:right; width:25%;">
                            <input type="button" value="Remover" class="button btnLimpa" />
                            <!--input type="button" value="Adicionar" class="button btnAdd button-submit" /-->
                        </label>
                    </div>
                    <input type="hidden" name="instcer_id[]" id="instcer_id" value="'.$ret['instcer_id'].'" />
                    <input type="hidden" name="inst_id[]" id="inst_id" value="'.$ret['inst_id'].'" />';
                }
                
            }
            
            $sConteudo .= "</div>
                          <script>
                            $('#veiculoAcordion').accordion();
                            $(\".ui-accordion .ui-accordion-content\").css({height:50});
                            $(\".data\").mask(\"99/99/9999 99:99\");
                            ".$timepicker."
                            ".$optionSelect."    
                            $('.btnLimpa').each(function(i){
                                $(this).click(function(){
                                    $('.instcer_dtini').each(function(j){
                                        if(i == j) $(this).val('');
                                    });
                                    $('.instcer_dtfim').each(function(j){
                                        if(i == j) $(this).val('');
                                    });
                                    $('.instcert_id').each(function(j){
                                        if(i == j) $(this).val('');
                                    });
                                });
                            });
                          </script>";

        }elseif($aParams['opcao'] == "lvr"){
            $retInstCliRota = $this->fachadaControl->listarInstalacaoPorClienteRota($aParams['registro'], $aParams['param1']);

            $sConteudo = '<div class="accordion-event" id="veiculoAcordion">';

            if ($retInstCliRota != NULL){
                $timepicker   = "";
                
                foreach ($retInstCliRota as $ret){
                    $timepicker .= "$('#dtini_".$ret['inst_id']."').datetimepicker();
                                    $('#dtfim_".$ret['inst_id']."').datetimepicker();";
                    
                    $cor = (@$ret['dtini'] != "" ? "background-color:#ffffcc" : "");

                    $sConteudo .= '
                    <h3><a href="javascript:return false;" style="margin-left:20px;'.$cor.'">Instalação :'.$ret['inst_id'].'   <span style="float:right;"><b>Veículo : </b><font style="color:#B12611;">'.$ret['inst_dsc'].'</font></span></a></h3>
                    <div id="rota'.$ret['inst_id'].'">
                        <label style="float:left; width:20%;">
                            <strong>Data/Hora Início</strong><input type="text" class="instrota_dtini data" name="instrota_dtini[]" id="dtini_'.$ret['inst_id'].'" value="'.@$ret['dtini'].'" />
                        </label>
                        <label style="float:left; margin-left:20px; width:20%;">
                            <strong>Data/Hora Final</strong><input type="text" class="instrota_dtfim data" name="instrota_dtfim[]" id="dtfim_'.$ret['inst_id'].'" value="'.@$ret['dtfim'].'" />
                        </label>
                        <label style="float:right; width:25%;">
                            <input type="button" value="Remover" class="button btnLimpa" />
                            <!--input type="button" value="Adicionar" class="button btnAdd button-submit" /-->
                        </label>
                    </div>
                    <input type="hidden" name="instrota_id[]" id="instrota_id" value="'.$ret['instrota_id'].'" />
                    <input type="hidden" name="inst_id[]" id="inst_id" value="'.$ret['inst_id'].'" />';
                }
                
            }
            
            $sConteudo .= "</div>
                          <script>
                            $('#veiculoAcordion').accordion();
                            $(\".ui-accordion .ui-accordion-content\").css({height:50});
                            $(\".data\").mask(\"99/99/9999 99:99\");
                            ".$timepicker."
                            $('.btnLimpa').each(function(i){
                                $(this).click(function(){
                                    $('.instrota_dtini').each(function(j){
                                        if(i == j) $(this).val('');
                                    });
                                    $('.instrota_dtfim').each(function(j){
                                        if(i == j) $(this).val('');
                                    });
                                });
                            });
                          </script>";

        }
        
        $this->setConteudo($sConteudo);
        
    }
    
    private function validarCadastro($params){
        echo $this->fachadaControl->validarCliente($params);
    }

}

?>