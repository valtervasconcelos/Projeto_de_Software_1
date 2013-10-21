<?php
include_once 'visao/Tela.php';
/**
 * Descrição da Login
 *
 * @Autor Valter Vasconcelos 03/07/2012
 * 
 */
class Login extends Tela{
    var $sConteudo;

    //Construtor da Classe
    function Login(){        
        $sConteudo = $this->cabecalhoSistema("login");
        
        $sConteudo .=
           "<div id='loginPrincipal'>
              <form name='formlogin' id='formlogin' action='' method='post' onsubmit='return false;'>               
              <div id='loginContainer'>
                <div class='logo_lg' style='margin:0 auto;'>
                    <center><img src='imagens/logo/".LOGOMARCA."' title='".TITLE."' longdesc='http://www.solucaostrack.com.br'></img></center>
                </div><!--fecha logo-->
                <div id=\"warning\"></div>
                <div class='campos'>
                    <div>
                        <span class='tc'>Login:</span>
                        <input name='entered_login' type='text'  class='text' id='login'/>
                    </div>
                    <div>
                        <span class='tc'>Senha:</span>
                        <input name='entered_password' type='password' class='text' id='senha'/>
                    </div>    
                    <input name='' type='image' src='imagens/login/bt_entrar_login.jpg' /></label>                    
                </div><!--fecha campos-->                
              </div><!--fecha login-->              

              <div id='visualizacao'>
                Este sistema é melhor visualizado com um dos navegadores abaixo e com resolução de 1024 x 768
              </div>

              <div id='w3c'>
                <!-- Inicio do botao do Firefox -->
                <a href='http://br.mozdev.org/' target='_blank' title='Baixar Mozila Firefox'>
                <img src='imagens/navegadores/firefox.png' title='Firefox' width='70' height='20' style='border-style:none;' title='Mozilla Firefox' />
                </a><!-- Fim do botao do Firefox -->
                &nbsp;
                <!-- Inicio do botao do chrome -->
                <a href='http://www.google.com/chrome/eula.html' target='_blank' title='Baixar Google Chrome'>
                <img src='imagens/navegadores/chrome.png' width='70' height='20' title='Google Chrome' style='border-style:none;'/>
                </a><!-- Fim do botao do chrome -->
              </div>

              <div id='licenca'>
                Copyright © <img src='imagens/logo/suporti.gif' align='top' longdesc='http://www.suporteemti.com.br' /> Todos os direitos reservados / All rights reserved.
              </div><!--fecha licenca-->

              <div id='w3c'>
                <p>
                <a href='http://jigsaw.w3.org/css-validator/check/referer'>
                <img style='border:0;width:52px;height:19px' src='http://jigsaw.w3.org/css-validator/images/vcss-blue' title='CSS válido!' />
                </a>
                <a href='http://validator.w3.org/check?uri=referer'>
                <img src='http://www.w3.org/Icons/valid-xhtml10-blue' title='Valid XHTML 1.0 Transitional' height='19' width='52' />
                </a>
                </p>
              </div>
              <div id=\"w3c\">
                <p>
                <img alt=\"Google Maps Premier\" src=\"imagens/logo/google_premier.jpg\">
                </p>
              </div>
              <!--fecha w3c-->";
        
        $script = 
            '<script type="text/javascript">
		$(\'document\').ready(function(){
                    $("#formlogin").validate({
                        errorContainer: "#warning",
                        rules: {
                            "entered_login"            : { required: true },
                            "entered_password"         : { required: true }
                        },
                        messages: {
                            "entered_login"            : { required: true },
                            "entered_password"         : { required: true }
                        },
                        submitHandler: function(form){
                        $(form).ajaxSubmit({
                            url: "'.PATHPRINCIPAL.'/autentica",
                            type: \'POST\',
                            target: "#warning",
                            success: function(data){                                
                                if(data == "true"){
                                    window.top.location = "'.PATHPRINCIPAL.'";
                                }else{
                                    $("#dialog-message p span").addClass("ui-icon-circle-check");
                                    $("#dialog-message p b").html("Erro no login! Tente Novamente! ('.ESQUEMA.')");
                                    $("#dialog-message").dialog({
                                        resizable: false,
                                        modal: true,
                                        title: "Comunicado",
                                        buttons: {
                                            "Ok": function() {
                                                $( this ).dialog( "destroy" );
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
            </script>
            </form>
            </div>';
        
        $sConteudo .= $script;
        
        $sConteudo .= $this->rodapeSistema();
        
        $this->setConteudo($sConteudo);
        
    }    
}

?>