<?php
ob_start();
/* Arquivo Index.php criado em 03/02/2012
 * @author Valter Vasconcelos 03/07/2012
 *
 */
session_start();
header("Content-type: text/html; charset=UTF-8");

/*Ips de Conexão!!!*/
define('HOSTQUANTA', '187.84.226.82');

//define('HOST', '192.168.254.212'); //Servidor antigo
define('HOST', '187.45.245.220'); // Servidor!
define('SGBD', 'pgsql');
define('DATABASENAME', '*******');
define('DATAUSER', '******');
//define('DATAPASS', "***********"); //Senha servidor antigo
define('DATAPASS', "**********"); // Senha servidor!
define('PORTA','2222');

//define('PATHPRINCIPAL','http://189.126.110.196/novosistema');
define('PATHPRINCIPAL','http://localhost/Strack');

$url = explode('/', $_SERVER['REDIRECT_URL']);

if (@$_SESSION['business'] != NULL){
    $sEmpresa = $_SESSION['business'];
}  elseif(@$url[2] == NULL) {
    header("Location: http://189.126.110.196/index.html");
    die();
    /*$sEmpresa = "default";*/
}else{
    $sEmpresa = $url[2];
}

$sNextEmpresa = (substr(@$url[2], 0, 4));

if(strtoupper($sNextEmpresa) == "NEXT"){
    $sEmpresa = substr($url[2],4, strlen ($url[2]));    
    unset ($_SESSION['business']);
    
    if($sEmpresa == "")
        $sEmpresa = "default";
        
}
//$sEmpresa = (@$_SESSION['business'] == NULL) ? $_SESSION['business'] : (@$url[2] == NULL) ? "default" : $url[2];

include_once 'AcessoSistema.php';
$oAcesso = new AcessoSistema();

if (@$_SESSION['business'] == NULL && $sEmpresa != "default"){    
    $qtdeClientes = count($oAcesso->clientes['cliente']);
    
    $indice = 0;
    while($indice < $qtdeClientes){        
        if ($oAcesso->clientes['cliente'][$indice]['nome'] == $sEmpresa){            
            if ($oAcesso->clientes['cliente'][$indice]['permissao'] == "false"){
                $url[2] = "acessonegado";
                $indice = 1000;
                header("Location: http://189.126.110.196/index.html");
                die();
            }else{                
                $url[2] = "login";
                $_SESSION['business'] = $sEmpresa;
                $_SESSION['indice'] = $indice;

                define('ESQUEMA',$oAcesso->clientes['cliente'][$indice]['esquema']);
                define('TITLE',$oAcesso->clientes['cliente'][$indice]['title']);
                define('LOGOMARCA',"logomarca_".$oAcesso->clientes['cliente'][$indice]['nome'].".png");
                $indice = 1000;
            }
        }

        $indice++;
    }

    //if ($url[2] == $sEmpresa)    
    if (@$_SESSION['business'] == NULL) // Não achou a empresa!
        $url[2] = "empresaNaoEncontrada";
    
}else{    
    if ($sEmpresa == "default"){
        if ($_SESSION['business']==NULL)
            $url[2] = "login";
        
        $_SESSION['business'] = "default";
        define('ESQUEMA',"public");
        define('TITLE'," S - Track");
        define('LOGOMARCA',"logomarca_public.png");
    }else{        
        define('ESQUEMA',$oAcesso->clientes['cliente'][$_SESSION['indice']]['esquema']);
        define('TITLE',$oAcesso->clientes['cliente'][$_SESSION['indice']]['title']);
        define('LOGOMARCA',"logomarca_".$oAcesso->clientes['cliente'][$_SESSION['indice']]['nome'].".png");
    }    
}

define('SESSAOEMPRESA',$_SESSION['business']);

$liberacaoG	= in_array(@$_SESSION[SESSAOEMPRESA]['usrt_dsc'], array('GERENCIA'));
$liberacaoGM	= in_array(@$_SESSION[SESSAOEMPRESA]['usrt_dsc'], array('GERENCIA', 'MONITORADOR'));
$liberacaoGMUG	= in_array(@$_SESSION[SESSAOEMPRESA]['usrt_dsc'], array('GERENCIA', 'MONITORADOR', 'USUÁRIO GERENTE', 'USUÁRIO SUB-GERENTE'));
$liberacao	= in_array(@$_SESSION[SESSAOEMPRESA]['usrt_dsc'], array('GERENCIA', 'MONITORADOR', 'G.R.'));
$liberacao2	= in_array(@$_SESSION[SESSAOEMPRESA]['usrt_dsc'], array('GERENCIA', 'MONITORADOR', 'USUÁRIO TESTE'));

define("LIBERACAOG", $liberacaoG);
define("LIBERACAOGM", $liberacaoGM);
define("LIBERACAOGMUG", $liberacaoGMUG);
define("LIBERACAO", $liberacao);
define("LIBERACAO2", $liberacao2);

define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');

include_once 'fachada/FachadaTela.php';
$oFachada = new FachadaTela($url);
$oFachada->printHtml();

?>