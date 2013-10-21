<?php
include_once 'visao/Tela.php';
/**
  * Descrição da CadEquipamentoTipo
  *
  * @Autor Valter Vasconcelos 12/07/2012
 */
class CadEquipamentoTipo extends Tela {
    var $sConteudo;
      
    // Construtor da Classe
    function CadEquipamentoTipo($aParams) {
         $this->fachadaControl = $this->getInstanciaControle();
         
         if($aParams['opcao'] == "l" || $aParams['opcao'] == "d" || $aParams['opcao'] == "a"){
            if($aParams['opcao'] == "d"){
                $this->fachadaControl->removerEquipamentoTipo($aParams['registro']);
            }     
            
            if ($aParams['opcao'] == "a")
                $retornoAlter = $this->fachadaControl->listarEquipamentoTipoId($aParams['registro']);
            
            $retorno = $this->fachadaControl->listarEquipamentoTipo();
            $sConteudo ='
                <div class="tabs" style="margin-top: 40px; height:600px;">
                    <h2 class="cabecalho">Cadastro de Tipo de Equipamento</h2>
                    <ul class="tabs-nav">
                        <li><a class="abas" href="#listagem">Listagem</a></li>
                        <li><a class="abas" style="color:#2c82fc;" href="#formulario">Formulário</a></li>                        
                    </ul>
                    <div class="box-content" id="listagem" style="padding: 0px 0px 15px 0px;">
                        <table class="grid" id="grid">
                            <thead>
                                <tr>
                                    <th title="Ordenar por Código">#</th>
                                    <th title="Ordenar por Descrição">DESCRICAO</th>
                                    <th title="Ordenar por Fornecedor">FORNECEDOR</th>
                                    <th class="imgOrdenacao"></th>
                                </tr>	
                            </thead>
                            <tbody>';
                            if ($retorno != NULL){
                                foreach($retorno as $ret){                                            
                                    $sConteudo .= "
                                    <tr>
                                        <td>".$ret['equipt_id']."</td>
                                        <td>".$ret['equipt_dsc']."</td>
                                        <td>".$ret['equipt_forn']."</td>
                                        <td id=\"alt\">
                                            <a title='Alterar' href='javascript:carregaHomeContainer(\"".PATHPRINCIPAL."/equipamentoTipo/a/".$ret['equipt_id']."\");' class=\"edit\"></a>
                                            <a title='Excluir' href=\"#\" class=\"eqtRemove remove\" id=\"".$ret['equipt_id']."\"></a>
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
                                <h2 style="width: auto;">Formulário Tipo de Equipamento</h2>
                                <div id="warning" class="warning">
                                    Os campos abaixo devem ser preenchidos ou corrigidos!
                                </div>
                                <label for="Descrição" style="float:left; width:50%">
                                    <strong>* Descrição</strong><input type="text" name="equipt_dsc" id="equipt_dsc" value="" maxlength="50" />
                                </label>
                                <label for="Fornecedor" style="float:right; width:45%; margin-left:10px;">
                                    <strong>* Fornecedor</strong><input type="text" name="equipt_forn" id="equipt_forn" value="" maxlength="10" />
                                </label>  
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
                        
                        $(\".abas\").click(function(){
                            $(\"#form_cadastro\").reset();
                            $('#mask').css({'width':'100%','height':'auto'});
                            $(\"#txt_action\").val(\"adicionar\");
			});
                        
        		$('.botoes:eq(0)').append('<a id=\"eqtBtAdd\" class=\"button button-submit\" style=\"margin-top:0px;\">Novo Registro</a>');
		
			$(\"#eqtBtAdd\").live(\"click\",function(){
                            $(\"#form_cadastro\").reset();
                            $(\"#txt_action\").val(\"adicionar\");
                            $(\".tabs\").tabs({ selected: '#formulario' });
                            $('#mask').css({'width':'100%','height':'auto'});
			});

 			$(\".eqtRemove\").live(\"click\", function(){
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
                                            carregaHomeContainer(\"".PATHPRINCIPAL."/equipamentoTipo/d/\"+codigo);
                                    },
                                    \"Cancelar\": function() {
                                        $( this ).dialog(\"destroy\");
                                    }
                                }
                            });
			});

                        $('#equipt_dsc').blur(function () {
                            $(this).val($(this).val().toUpperCase());
                            $.ajax({
                                url: \"".PATHPRINCIPAL."/equipamentoTipo/v\",
                                type: 'POST',
                                data: {value: $(this).val(),id: $('#txt_id').val(),acao: $('#txt_action').val()},
                                success: function(txt){
                                    if (txt == 'Erro'){
                                        alert('Descrição do tipo de equipamento já existe! Verifique');
                                        $('#equipt_forn').focus();
                                        return;
                                    }
                                }
                            });
                        });";
                        
			$activeTabs = ($aParams['opcao'] == "a") ? "
			$(\".tabs\").tabs({ selected: '#formulario' });
        		$(\"#txt_action\").val(\"alterar\");
                        $('#mask').css({'width':'100%','height':'auto'});
			$(\"input[name='txt_id']\").val('".$retornoAlter[0]['equipt_id']."');                     
			$(\"input[name='equipt_dsc']\").val('".$retornoAlter[0]['equipt_dsc']."');
                        $(\"input[name='equipt_forn']\").val('".$retornoAlter[0]['equipt_forn']."');
			" : "";
			
			$script .= @$activeTabs."
			
			
			$(\"#form_cadastro\").validate({
                            errorContainer: \"#warning\",
                            rules: {                                
                                \"equipt_dsc\"          : { required: true },
                                \"equipt_forn\"        : { required: true }
                             },
                            messages: {                                
                                \"equipt_dsc\"          : { required: \"Favor digitar a descrição do Tipo de Equipamento!\" },
                                \"equipt_forn\"        : { required: \"Favor digitar o fornecedor!\" }
                            },
                            submitHandler: function(form){
                                $(form).ajaxSubmit({
                                    url: \"".PATHPRINCIPAL."/equipamentoTipo/i\",
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
                                                        carregaHomeContainer(\"".PATHPRINCIPAL."/equipamentoTipo/l\");
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
            include_once('modelo/classes/equipamentoTipo.php');
            $oEquipamentoTipo = new equipamentoTipo();
            $oEquipamentoTipo->setEquipt_dsc($_POST['equipt_dsc']);
            $oEquipamentoTipo->setEquipt_forn($_POST['equipt_forn']);

            $params = array("value"=>$_POST['equipt_dsc'],"acao"=>$_POST['txt_action'],"id"=>$_POST['txt_id']);
            $retorno = $this->fachadaControl->validarEquipamentoTipo($params);

            if($retorno != 'Erro'){
                if($_POST['txt_action'] == 'adicionar'){
                    $this->fachadaControl->inserirEquipamentoTipo($oEquipamentoTipo);
                }else{
                    $oEquipamentoTipo->setEquipt_id($_POST['txt_id']);
                    $this->fachadaControl->alterarEquipamentoTipo($oEquipamentoTipo);
                }
                $sConteudo = 'ok';
            }else
                $sConteudo = 'Erro';

        }
        
        $this->setConteudo($sConteudo);
        
    }
    
    private function validarCadastro($params){
        echo $this->fachadaControl->validarEquipamentoTipo($params);
    }

}

?>