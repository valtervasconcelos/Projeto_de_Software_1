<?php
/**
 * Descricao da repositorioUsuario
 *
 * @Autor Valter Vasconcelos 11/07/2012
 * 
 */
class repositorioUsuario {
    private $pdo;

    //Construtor da Classe
    function __construct($pdo) {
        $this->pdo = $pdo;
    }
    
    public function inserir($oUsuario){
        $sql =
            "SELECT usr_id, cli_id, usr_dsc, usr_dtre
            FROM ".ESQUEMA.".usuario            
            WHERE usr_login = '{$oUsuario->getUsr_login()}' LIMIT 1";
        
        $results = $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);

        if($results){
            if($results['usr_dtre']!=''){
                $sql = "UPDATE ".ESQUEMA.".usuario SET usr_login = '{$oUsuario->getUsr_login()}ANTIGODEL'  WHERE usr_login = '{$oUsuario->getUsr_login()}'";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute();
            }else{
                echo "<script>alert('Já existe um usuário com esse login! Favor verificar...');</script>";
                die();
            }
        }
            
        $sql = 
            "INSERT INTO ".ESQUEMA.".usuario(    
                usrt_id,
                cli_id,
                usr_login,
                usr_senha,
                usr_dsc,
                usr_ende,
                usr_bair,
                usr_cida,
                esta_id,
                usr_cep,
                usr_tel,
                usr_cel,
                usr_email,
                usr_obs
            )values(
                '{$oUsuario->getUsrt_id()}',
                '{$oUsuario->getCli_id()}',
                '{$oUsuario->getUsr_login()}',
                '{$oUsuario->getUsr_senha()}',
                '{$oUsuario->getUsr_dsc()}',
                '{$oUsuario->getUsr_ende()}',
                '{$oUsuario->getUsr_bair()}',
                '{$oUsuario->getUsr_cida()}',
                '{$oUsuario->getEsta_id()}',
                '{$oUsuario->getUsr_cep()}',
                '{$oUsuario->getUsr_tel()}',
                '{$oUsuario->getUsr_cel()}',
                '{$oUsuario->getUsr_email()}',
                '{$oUsuario->getUsr_obs()}'                
            )";

        try{
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return '1';
        }catch(Exception $e){
            return 'error';
        }
        
    }
    
    public function alterar($oUsuario){        
        $sql = 
            "UPDATE ".ESQUEMA.".usuario SET
                usrt_id = {$oUsuario->getUsrt_id()},
                cli_id = {$oUsuario->getCli_id()},
                usr_login = '{$oUsuario->getUsr_login()}',
                usr_senha = '{$oUsuario->getUsr_senha()}',
                usr_dsc = '{$oUsuario->getUsr_dsc()}',
                usr_ende = '{$oUsuario->getUsr_ende()}',
                usr_bair = '{$oUsuario->getUsr_bair()}',
                usr_cida = '{$oUsuario->getUsr_cida()}',
                esta_id = '{$oUsuario->getEsta_id()}',
                usr_cep = '{$oUsuario->getUsr_cep()}',
                usr_tel = '{$oUsuario->getUsr_tel()}',
                usr_cel = '{$oUsuario->getUsr_cel()}',
                usr_email = '{$oUsuario->getUsr_email()}',
                usr_obs = '{$oUsuario->getUsr_obs()}'
            
            WHERE
                usr_id = {$oUsuario->getUsr_id()}";
                
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }
    
    public function alterarSenha($oUsuario){
        $sql = 
            "UPDATE ".ESQUEMA.".usuario SET                
                usr_senha = '{$oUsuario->getUsr_senha()}'
            WHERE
                usr_id = {$oUsuario->getUsr_id()}";
                
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }
    
    public function remover($id){
        $dHoje	= date("Y-m-d");
        
        $sql = "UPDATE ".ESQUEMA.".usuario SET usr_dtre = '{$dHoje}' WHERE (usr_id = {$id}); ";		//-----  Remove os usuários do cliente
        $stmt = $this->pdo->prepare($sql);
	$stmt->execute();
    }
    
    public function listar($cli_id = "0"){
        if ($cli_id != "0"){
            $sql =
                "SELECT DISTINCT u.usr_id, u.usr_login, u.usr_dsc, u.usr_cel, u.usr_tel, ut.usrt_dsc, to_char(u.usr_dtca, 'dd/mm/yyyy') AS usr_dtca ".
                "FROM ".ESQUEMA.".usuario u ".
                "INNER JOIN ".ESQUEMA.".usuario_tipo ut ON ut.usrt_id = u.usrt_id ".
                "WHERE (u.cli_id = '{$cli_id}') AND (u.usr_dtre IS NULL) ".
                "ORDER BY u.usr_dsc;";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            $_SESSION[SESSAOEMPRESA]['cli_select'] = $cli_id;

            return $results;
        }else
            return NULL;
    }
    
    public function listarPorId($id){
        $sNivelUsuario = $_SESSION[SESSAOEMPRESA]['usrt_dsc'];
        $sql =
            "SELECT DISTINCT 
                usr_id,
                usrt_id,
                cli_id,
                usr_login,
                usr_senha,
                usr_dsc,
                usr_ende,
                usr_bair,
                usr_cida,
                esta_id,
                usr_cep,
                usr_tel,
                usr_cel,
                usr_email,
                usr_obs
            
            FROM ".ESQUEMA.".usuario
            
            WHERE usr_id = '{$id}' AND (usr_dtre IS NULL) ".($sNivelUsuario == 'USUÁRIO TESTE' ? "AND (usr_id = '1') " : '' );
        
        $stmt = $this->pdo->prepare($sql);
	$stmt->execute();
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $results;
    }
    
    public function listarMonitor(){
        $sql =
        "SELECT u.usr_id, u.usr_dsc ".
	"FROM ".ESQUEMA.".usuario u ".
	"INNER JOIN ".ESQUEMA.".usuario_tipo ut ON ut.usrt_id = u.usrt_id ".
	"WHERE (ut.usrt_dsc IN ('GERENCIA', 'MONITORADOR')) ".
	"ORDER BY u.usr_dsc;";
        
        $stmt = $this->pdo->prepare($sql);
	$stmt->execute();
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $results;
    }
    
    public function validar($params){        
        if ($params['tipo'] == 'nome'){
            $sql = "SELECT count(0) AS total ".
		"FROM ".ESQUEMA.".usuario ".
		"WHERE (usr_dtre IS NULL) AND (usr_dsc = '{$params['value']}')".($params['acao'] == 'alterar' ? " AND (usr_id != '{$params['id']}')" : '').";";
            
        }elseif($params['tipo'] == 'login'){
            $sql = "SELECT count(0) AS total ".
		"FROM ".ESQUEMA.".usuario ".
		"WHERE (usr_dtre IS NULL) AND (usr_login = '{$params['value']}')".($params['acao'] == 'alterar' ? " AND (usr_id != '{$params['id']}')" : '').";";
        

        }elseif($params['tipo'] == 'alterarsenha'){
            $sql = "SELECT count(0) AS total ".
		"FROM ".ESQUEMA.".usuario ".
		"WHERE (usr_dtre IS NULL) AND (usr_senha = '{$params['value']}') AND usr_id = '{$params['id']}';";
        }

        $stmt = $this->pdo->prepare($sql);
	$stmt->execute();
	$results = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return ($results['total'] == '0') ? 'Ok' : 'Erro';
        
        
    }

}

?>