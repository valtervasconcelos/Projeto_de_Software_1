<?php
include_once 'visao/Tela.php';
/**
 * Descricao da AlterarSenha
 *
 * @Autor Valter Vasconcelos 11/12/2012
 * 
 */
class AlterarSenha extends Tela{
    var $sConteudo;

    //Construtor da Classe
    function AlterarSenha($aParams) {
        $this->fachadaControl = $this->getInstanciaControle();
        
        if($aParams['opcao'] == "a"){
            $sConteudo ='
                <div class="tabs" style="margin-top: 60px; width:405px;">
                    <h2 class="cabecalho">Alterar Senha do Usuários</h2>
                    <form name="form_cadastro" id="form_cadastro" action="" method="POST" enctype="multipart/form-data" onsubmit="return false;">
                    <div class="box-content" style="padding: 0px 0px 15px 0px;">
                        <div class="box center400">
                            <div class="box-intro">
                                <h2 style="width: auto;"></h2>
                                <div id="warning" class="warning">
                                    Os campos abaixo devem ser preenchidos ou corrigidos!
                                </div>
                                <table style="width:100%" >
                                <tr>
                                    <td>
                                    <label for="senhaatual" style="float:left; width:90%;">
                                        <strong>* Senha Atual</strong><input type="password" name="senha_atual" id="senha_atual" value="" maxlength="10" />
                                    </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    <label for="senha" style="float:left; width:90%;">
                                        <strong>* Nova Senha</strong><input type="password" name="usr_senha" id="usr_senha" value="" maxlength="10" />
                                    </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    <label for="repete" style="float:left; width:90%;">
                                        <strong>* Repete Senha</strong><input type="password" name="usr_repete" id="usr_repete" value="" maxlength="10" />
                                    </label>
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
                        $('#mask').css({'width':'100%','height':'100%'});
                        
                        $('#senha_atual').blur(function () {
                            $.ajax({
                                url: \"".PATHPRINCIPAL."/usuario/v\",
                                type: 'POST',
                                data: {tipo: 'alterarsenha',value: $(this).val(),id: ".$_SESSION[SESSAOEMPRESA]['usr_id'].",acao: '' },
                                success: function(txt){
                                    if (txt != 'Erro'){
                                        alert('Senha não cadastrada, confira!!!');
                                        $('#senha_atual').focus();
                                        return;
                                    }
                                }
                            });
                        });                        

			$(\"#form_cadastro\").validate({
                            errorContainer: \"#warning\",
                            rules: {
                                \"senha_atual\"      : { required: true },
                                \"usr_senha\"        : { required: true },
                                \"usr_repete\"       : { required: true, equalTo: \"#usr_senha\" }
                            },
                            messages: {
                                \"senha_atual\"      : { required: \"Favor digitar sua senha atual!\" },
                                \"usr_senha\"        : { required: \"Favor digitar a senha\"},
                                \"usr_repete\"       : { required: \"Favor repetir a mesma senha.\", equalTo: \"As senhas são diferentes!!!\" }
                            },
                            submitHandler: function(form){
                                $(form).ajaxSubmit({
                                    url: \"".PATHPRINCIPAL."/alterarsenha/i\",
                                    type: 'POST',
                                    target: \"#warning\",
                                    success: function(data){                                        
                                        $(\"#dialog-message p span\").addClass(\"ui-icon-circle-check\");
                                        $(\"#dialog-message p b\").html(\"Senha alterada com sucesso!!!\");
                                        $(\"#dialog-message\").dialog({
                                            resizable: false,
                                            modal: true,
                                            title: \"Comunicado\",
                                            buttons: {
                                                \"Ok\": function() {
                                                    $( this ).dialog( \"destroy\" );
                                                    $('#close').click();
                                                }
                                            }
                                        });
                                    }
                                });
                                return false;
                            }
			});
                    });
                </script>";

            $sConteudo .= $script;

        }elseif($aParams['opcao'] == "i"){
            include_once('modelo/classes/Usuario.php');
            $oUsuario = new Usuario();
            $oUsuario->setUsr_id($_SESSION[SESSAOEMPRESA]['usr_id']);
            $oUsuario->setUsr_senha($_POST['usr_senha']);

            $this->fachadaControl->alterarSenhaUsuario($oUsuario);

            $sConteudo = 'ok';
        }
        $this->setConteudo($sConteudo);
        
    }

}

?>