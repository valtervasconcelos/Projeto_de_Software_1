<?php
include_once 'visao/Tela.php';
/**
 * Descricao da LogUsuario
 *
 * @Autor Valter Vasconcelos 01/03/2013
 * 
 */
class LogUsuario extends Tela{
    var $sConteudo;
    
     function LogUsuario($aParams) {
        $this->fachadaControl = $this->getInstanciaControle();
    
        if($aParams['opcao'] == "l"){
            $retorno = $this->fachadaControl->listarUsuarioAcesso();

            $sConteudo ='
                <div class="tabs" style="margin-top: 40px; height:600px;">
                    <h2 class="cabecalho">Acesso de Usuários</h2>
                    <ul class="tabs-nav">
                        <li><a class="abas" href="#listagem">Listagem</a></li>
                    </ul>
                    <div class="box-content" id="listagem" style="padding: 0px 0px 15px 0px;">
                        <table class="grid" id="grid">
                            <thead>
                                <tr>
                                    <th title="Ordenar por Código">ID</th>
                                    <th title="Ordenar por IP">IP</th>
                                    <th title="Ordenar por Usuário">USÚARIO</th>
                                    <th title="Ordenar por Usuário">LOGIN</th>
                                    <th title="Ordenar por Data de Acesso">DT/ACESSO</th>
                                    <th title="Ordenar por Cliente">CLIENTE</th>
                                </tr>	
                            </thead>
                            <tbody>';
                            if ($retorno != NULL){
                                foreach($retorno as $ret){                                            
                                    $sConteudo .= "
                                    <tr>
                                        <td>".$ret['usra_id']."</td>
                                        <td>".$ret['usra_ip']."</td>
                                        <td>".$ret['usra_dsc']."</td>
                                        <td>".$ret['usra_login']."</td>
                                        <td>".$ret['usra_dthr']."</td>
                                        <td>".$ret['usra_cli_dsc']."</td>                                                                       
                                    </tr>";
                                }
                            }else{
                                $sConteudo .= '';
                            }	
                                $sConteudo .= '
                            </tbody>
                        </table>
                    </div>
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
			});

                    });
                </script>";

            $sConteudo .= $script;
                   
        }
        
        $this->setConteudo($sConteudo);
        
    }
   
}

?>