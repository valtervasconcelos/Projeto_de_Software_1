<?php
include_once 'visao/Tela.php';
/**
 * Descricao da CadUsuarioTipo
 *
 * @Autor Valter Vasconcelos 04/12/2012
 * 
 */
class CadUsuarioTipo extends Tela{
    var $sConteudo;

    //Construtor da Classe
    function CadUsuarioTipo($aParams) {
        $this->fachadaControl = $this->getInstanciaControle();
        
        if($aParams['opcao'] == "l" || $aParams['opcao'] == "d" || $aParams['opcao'] == "a"){
            if($aParams['opcao'] == "d"){
                $retorno = $this->fachadaControl->removerUsuarioTipo($aParams['registro']);
                if($retorno == false){
                    echo "<script>alert('Não foi possível remover o registro, verifique se há usuários vinculado a esse tipo de usuário!!!');</script>";
                }
            }
            
            if ($aParams['opcao'] == "a")
                $retornoAlter = $this->fachadaControl->listarUsuarioTipoId($aParams['registro']);
        
            $retorno = $this->fachadaControl->listarUsuarioTipo(@$aParams['param1']);

            $sConteudo ='
                <div class="tabs" style="margin-top: 40px; height:auto">
                    <h2 class="cabecalho">Cadastro de Tipo de Usuários</h2>
                    <ul class="tabs-nav">
                        <li><a class="abas" href="#listagem">Listagem</a></li>
                        <li><a class="abas" style="color:#2c82fc;" href="#formulario">Formulário</a></li>
                    </ul>
                    <form name="form_cadastro" id="form_cadastro" action="" method="POST" enctype="multipart/form-data" onsubmit="return false;">
                    <input type="hidden" name="txt_action" id="txt_action" value="" />
                    <input type="hidden" name="txt_id" id="txt_id" value="" />
                    
                    <div class="box-content" id="listagem" style="padding: 0px 0px 15px 0px;">
                        <table class="grid" id="grid">
                            <thead>
                                <tr>
                                    <th title="Ordenar por Código">#</th>
                                    <th title="Ordenar por Descrição">DESCRIÇÃO</th>
                                    <th class="imgOrdenacao"></th>
                                </tr>	
                            </thead>
                            <tbody>';

                                if ($retorno != NULL){
                                    foreach($retorno as $ret){
                                        $sConteudo .= "
                                        <tr>
                                            <td>".$ret['usrt_id']."</td>
                                            <td>".$ret['usrt_dsc']."</td>
                                            <td id=\"alt\">
                                                <a title='Alterar' href='javascript:carregaHomeContainer(\"".PATHPRINCIPAL."/usuarioTipo/a/".$ret['usrt_id']."\");' class=\"edit\"></a>
                                                <a title='Excluir' href=\"#\" class=\"ustRemove remove\" id=\"".$ret['usrt_id']."\"></a>
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
                                <h2 style="width: auto;">Formulário de Tipos de Usuários</h2>
                                <div id="warning" class="warning">
                                    Os campos abaixo devem ser preenchidos ou corrigidos!
                                </div>
                                <table style="width:100%">
                                <tr>
                                    <td>
                                    <label for="descricao" style="float:left; width:45%">
                                        <strong>* Descrição</strong><input type="text" name="usrt_dsc" id="usrt_dsc" value="" maxlength="20" />
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
                                                <strong>Observação</strong><textarea style="width:98%" name="usrt_obs" id="usrt_obs" value="" rows="6">'.@$retornoAlter[0]['usrt_obs'].'</textarea>
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
			$('#grid').dataTable( {
                            \"bRetrieve\":true,
                            \"sScrollY\": \"350px\"
                        } );
                        
                        $('.botoes:eq(0)').append('<a id=\"ustBtAdd\" class=\"button button-submit\" style=\"margin-top:0px;\">Novo Registro</a>');

                        $('#ustBtAdd').click(function (){
                            $(\"#form_cadastro\").reset();
                            $(\"#txt_action\").val(\"adicionar\");
                            $(\".tabs\").tabs({ selected: '#formulario' });
                            $('#mask').css({'width':'100%','height':'100%'});
                        });
                        
                        $(\".abas\").click(function(){
                            $(\"#form_cadastro\").reset();
                            $('#mask').css({'width':'100%','height':'100%'});
                            $(\"#txt_action\").val(\"adicionar\");
			});

			$(\".ustRemove\").live(\"click\", function(){
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
                                            carregaHomeContainer(\"".PATHPRINCIPAL."/usuarioTipo/d/\"+codigo+\"/".$aParams['param1']."\");
                                    },
                                    \"Cancelar\": function() {
                                        $( this ).dialog(\"destroy\");
                                    }
                                }
                            });
			});                        
                        
                        $('#usrt_dsc').blur(function () {
                            $(this).val($(this).val().toUpperCase());
                            $.ajax({
                                url: \"".PATHPRINCIPAL."/usuarioTipo/v\",
                                type: 'POST',
                                data: {value: $(this).val(),id: $('#txt_id').val(),acao: $('#txt_action').val()},
                                success: function(txt){
                                    if (txt == 'Erro'){
                                        alert('Tipo do Usuário já existe! Verifique.');
                                        $('#usrt_dsc').focus();
                                        return;
                                    }
                                }
                            });
                        });";
                        
			$activeTabs = ($aParams['opcao'] == "a") ? "
			$(\".tabs\").tabs({ selected: '#formulario' });
			$(\"#txt_action\").val(\"alterar\");
                        $('#mask').css({'width':'100%','height':'100%'});
	
			$(\"input[name='txt_id']\").val('".$retornoAlter[0]['usrt_id']."');
			$(\"input[name='usrt_dsc']\").val('".$retornoAlter[0]['usrt_dsc']."');
			" : "";
			
			$script .= @$activeTabs."			

			$(\"#form_cadastro\").validate({
                            errorContainer: \"#warning\",
                            rules: {                                  
                                \"usrt_dsc\"          : { required: true }                                
                            },
                            messages: {                                 
                                \"usrt_dsc\"          : { required: \"Favor digitar a descrição!\" }
                            },
                            submitHandler: function(form){
                                $(form).ajaxSubmit({
                                    url: \"".PATHPRINCIPAL."/usuarioTipo/i\",
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
                                                        carregaHomeContainer(\"".PATHPRINCIPAL."/usuarioTipo/l\");
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
            $params = array("value"=>$_POST['value'],"acao"=>$_POST['acao'],"id"=>$_POST['id']);
            $this->validarCadastro($params);
        }elseif($aParams['opcao'] == "i"){            
            include_once('modelo/classes/UsuarioTipo.php');
            $oUsuarioTipo = new UsuarioTipo();

            $oUsuarioTipo->setUsrt_dsc($_POST['usrt_dsc']);
            $oUsuarioTipo->setUsrt_obs($_POST['usrt_obs']);

            $params = array("value"=>$_POST['usrt_dsc'],"acao"=>$_POST['txt_action'],"id"=>$_POST['txt_id']);
            $retorno = $this->fachadaControl->validarUsuarioTipo($params);

            if($retorno != 'Erro'){
                if($_POST['txt_action'] == 'adicionar'){
                    $this->fachadaControl->inserirUsuarioTipo($oUsuarioTipo);
                }else{
                    $oUsuarioTipo->setUsrt_id($_POST['txt_id']);
                    $this->fachadaControl->alterarUsuarioTipo($oUsuarioTipo);
                }

                $sConteudo = 'ok';
            }else
                $sConteudo = 'Erro';

        }
        
        $this->setConteudo($sConteudo);
        
    }
    
    private function validarCadastro($params){
        echo $this->fachadaControl->validarUsuarioTipo($params);
    }

}

?>