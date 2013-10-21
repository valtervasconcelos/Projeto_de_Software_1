<?php
/**
 * Descricao da repositorioCliente
 *
 * @Autor Valter Vasconcelos 06/07/2012
 * 
 */
class repositorioCliente {
    private $pdo;

    //Construtor da Classe
    function __construct($pdo) {
        $this->pdo = $pdo;
    }
    
    public function inserir($oCliente){
        $data1 = ($oCliente->getCli_dtnasc1() != '')? $oCliente->getCli_dtnasc1() : 'NULL';
        $data2 = ($oCliente->getCli_dtnasc2() != '')? $oCliente->getCli_dtnasc2() : 'NULL';
        $data3 = ($oCliente->getCli_dtnasc3() != '')? $oCliente->getCli_dtnasc3() : 'NULL';
        
        $sql = 
            "INSERT INTO ".ESQUEMA.".cliente(
                cli_mae,
                cli_dsc,
                cli_sigla,
                cli_logo,
                pess_id,
                cli_ende,
                cli_bair,
                cli_cida,
                esta_id,
                cli_cep,
                cli_cpfcnpj,
                cli_inse,
                cli_insm,
                cli_tel,
                cli_tel2,
                cli_cel,
                cli_cel2,
                cli_fax,
                cli_email,
                cli_homepage,
                cli_fuso,
                cli_senhavoz,
                cli_pergunta,
                cli_resposta,
                cli_coasao,
                cli_obs,
                cli_cont1,
                cli_titu1,
                cli_tel01,
                cli_cpf1,
                cli_dtnasc1,
                cli_cont2,
                cli_titu2,
                cli_tel02,
                cli_cpf2,
                cli_dtnasc2,
                cli_cont3,
                cli_titu3,
                cli_tel03,
                cli_cpf3,
                cli_dtnasc3
            )values(
                {$oCliente->getCli_mae()},
                '{$oCliente->getCli_dsc()}',
                '{$oCliente->getCli_sigla()}',
                '{$oCliente->getCli_logo()}',
                '{$oCliente->getPess_id()}',
                '{$oCliente->getCli_ende()}',
                '{$oCliente->getCli_bair()}',
                '{$oCliente->getCli_cida()}',
                '{$oCliente->getEsta_id()}',
                '{$oCliente->getCli_cep()}',
                '{$oCliente->getCli_cpfcnpj()}',
                '{$oCliente->getCli_inse()}',
                '{$oCliente->getCli_insm()}',
                '{$oCliente->getCli_tel()}',
                '{$oCliente->getCli_tel2()}',
                '{$oCliente->getCli_cel()}',
                '{$oCliente->getCli_cel2()}',
                '{$oCliente->getCli_fax()}',
                '{$oCliente->getCli_email()}',
                '{$oCliente->getCli_homepage()}',
                '{$oCliente->getCli_fuso()}',
                '{$oCliente->getCli_senhavoz()}',
                '{$oCliente->getCli_pergunta()}',
                '{$oCliente->getCli_resposta()}',
                '{$oCliente->getCli_coasao()}',
                '{$oCliente->getCli_obs()}',
                '{$oCliente->getCli_cont1()}',
                '{$oCliente->getCli_titu1()}',
                '{$oCliente->getCli_tel01()}',
                '{$oCliente->getCli_cpf1()}',
                {$data1},
                '{$oCliente->getCli_cont2()}',
                '{$oCliente->getCli_titu2()}',
                '{$oCliente->getCli_tel02()}',
                '{$oCliente->getCli_cpf2()}',
                {$data2},
                '{$oCliente->getCli_cont3()}',
                '{$oCliente->getCli_titu3()}',
                '{$oCliente->getCli_tel03()}',
                '{$oCliente->getCli_cpf3()}',
                {$data3}
            )";

        $stmt = $this->pdo->prepare($sql);
	$stmt->execute();	
    }
    
    public function alterar($oCliente){
        $data1 = ($oCliente->getCli_dtnasc1() != '')? $oCliente->getCli_dtnasc1() : 'NULL';
        $data2 = ($oCliente->getCli_dtnasc2() != '')? $oCliente->getCli_dtnasc2() : 'NULL';
        $data3 = ($oCliente->getCli_dtnasc3() != '')? $oCliente->getCli_dtnasc3() : 'NULL';
        
        $sql = 
            "UPDATE ".ESQUEMA.".cliente SET
                cli_mae = {$oCliente->getCli_mae()},
                cli_dsc = '{$oCliente->getCli_dsc()}',
                cli_sigla = '{$oCliente->getCli_sigla()}',
                cli_logo = '{$oCliente->getCli_logo()}',
                pess_id = '{$oCliente->getPess_id()}',
                cli_ende = '{$oCliente->getCli_ende()}',
                cli_bair = '{$oCliente->getCli_bair()}',
                cli_cida = '{$oCliente->getCli_cida()}',
                esta_id = '{$oCliente->getEsta_id()}',
                cli_cep = '{$oCliente->getCli_cep()}',
                cli_cpfcnpj = '{$oCliente->getCli_cpfcnpj()}',
                cli_inse = '{$oCliente->getCli_inse()}',
                cli_insm = '{$oCliente->getCli_insm()}',
                cli_tel = '{$oCliente->getCli_tel()}',
                cli_tel2 = '{$oCliente->getCli_tel2()}',
                cli_cel = '{$oCliente->getCli_cel()}',
                cli_cel2 = '{$oCliente->getCli_cel2()}',
                cli_fax = '{$oCliente->getCli_fax()}',
                cli_email = '{$oCliente->getCli_email()}',
                cli_homepage = '{$oCliente->getCli_homepage()}',
                cli_fuso = '{$oCliente->getCli_fuso()}',
                cli_senhavoz = '{$oCliente->getCli_senhavoz()}',
                cli_pergunta = '{$oCliente->getCli_pergunta()}',
                cli_resposta = '{$oCliente->getCli_resposta()}',
                cli_coasao = '{$oCliente->getCli_coasao()}',
                cli_obs = '{$oCliente->getCli_obs()}',
                cli_cont1 = '{$oCliente->getCli_cont1()}',
                cli_titu1 = '{$oCliente->getCli_titu1()}',
                cli_tel01 = '{$oCliente->getCli_tel01()}',
                cli_cpf1 = '{$oCliente->getCli_cpf1()}',
                cli_dtnasc1 = {$data1},
                cli_cont2 = '{$oCliente->getCli_cont2()}',
                cli_titu2 = '{$oCliente->getCli_titu2()}',
                cli_tel02 = '{$oCliente->getCli_tel02()}',
                cli_cpf2 = '{$oCliente->getCli_cpf2()}',
                cli_dtnasc2 = {$data2},
                cli_cont3 = '{$oCliente->getCli_cont3()}',
                cli_titu3 = '{$oCliente->getCli_titu3()}',
                cli_tel03 = '{$oCliente->getCli_tel03()}',
                cli_cpf3 = '{$oCliente->getCli_cpf3()}',
                cli_dtnasc3 = {$data3}
            
            WHERE
                cli_id = '{$oCliente->getCli_id()}'";        
        
        $stmt = $this->pdo->prepare($sql);
	$stmt->execute();	
    }
    
    public function remover($id){
        $dHoje	= date("Y-m-d");
        
        $sql = "UPDATE ".ESQUEMA.".usuario SET usr_dtre = '{$dHoje}' WHERE (cli_id = {$id}); ";		//-----  Remove os usuários do cliente
        $stmt = $this->pdo->prepare($sql);
	$stmt->execute();
	$sql = "UPDATE ".ESQUEMA.".motorista SET moto_dtre = '{$dHoje}' WHERE (cli_id = {$id}); ";	//-----  Remove os motoristas do cliente
        $stmt = $this->pdo->prepare($sql);
	$stmt->execute();
	$sql = "UPDATE ".ESQUEMA.".veiculo SET veic_dtre = '{$dHoje}' WHERE (cli_id = {$id}); ";       //-----  Remove os veículos do cliente
        $stmt = $this->pdo->prepare($sql);
	$stmt->execute();
	$sql = "UPDATE ".ESQUEMA.".instalacao SET inst_dtre = '{$dHoje}' WHERE (cli_id = {$id}); ";	//-----  Remove as instalações do cliente
        $stmt = $this->pdo->prepare($sql);
	$stmt->execute();
	$sql = "UPDATE ".ESQUEMA.".cliente SET cli_dtre = '{$dHoje}' WHERE (cli_id = {$id}); ";	//-----  Remove o cliente
        $stmt = $this->pdo->prepare($sql);
	$stmt->execute();
    }
    
    public function listar(){
        $sNivelUsuario = $_SESSION[SESSAOEMPRESA]['usrt_dsc'];
        $sql =
            "SELECT DISTINCT c.cli_id, c.cli_cpfcnpj, c.cli_sigla, c.cli_dsc, cm.cli_dsc AS cli_mae_dsc, c.cli_cel, c.cli_tel, c.cli_email,
            to_char(c.cli_dtca, 'dd/mm/yyyy') AS dtca,
            (SELECT count(0) FROM ".ESQUEMA.".instalacao i WHERE (i.cli_id = c.cli_id) AND (i.inst_dtre IS NULL)) AS inst_total
            FROM ".ESQUEMA.".cliente c
            LEFT JOIN ".ESQUEMA.".usuario u ON u.cli_id = c.cli_id AND (u.usr_dtre IS NULL)
            LEFT JOIN ".ESQUEMA.".usuario_tipo ut ON ut.usrt_id = u.usrt_id
            LEFT JOIN ".ESQUEMA.".cliente cm ON cm.cli_id = c.cli_mae AND (cm.cli_dtre IS NULL)
            WHERE (c.cli_dtre IS NULL) ".($sNivelUsuario == 'USUÁRIO TESTE' ? "AND (c.cli_id = '1') " : ($sNivelUsuario == 'GERENCIA' ? '' : "AND (ut.usrt_dsc != 'USUARIO VIP') ")).
            "ORDER BY c.cli_dsc;";
        
        $stmt = $this->pdo->prepare($sql);
	$stmt->execute();
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $results;
    }
    
    public function listarPorId($id){
        $sNivelUsuario = $_SESSION[SESSAOEMPRESA]['usrt_dsc'];
        $sql =
            "SELECT DISTINCT 
                c.cli_id,                 
                c.cli_mae,
                c.cli_dsc,
                c.cli_sigla,
                cli_logo,
                c.pess_id,
                c.cli_ende,
                c.cli_bair,
                c.cli_cida,
                c.esta_id,
                c.cli_cep,
                c.cli_cpfcnpj,
                c.cli_inse,
                c.cli_insm,
                c.cli_tel,
                c.cli_tel2,
                c.cli_cel,
                c.cli_cel2,
                c.cli_fax,
                c.cli_email,
                c.cli_homepage,
                c.cli_fuso,
                c.cli_senhavoz,
                c.cli_pergunta,
                c.cli_resposta,
                c.cli_coasao,            
                c.cli_obs,
                c.cli_cont1,            
                c.cli_tel01,
                c.cli_cont2,            
                c.cli_tel02,            
                c.cli_cont3,            
                c.cli_tel03
            
            FROM ".ESQUEMA.".cliente c
            
            WHERE c.cli_id = '{$id}' AND (c.cli_dtre IS NULL) ".($sNivelUsuario == 'USUÁRIO TESTE' ? "AND (c.cli_id = '1') " : '' );
        
        $stmt = $this->pdo->prepare($sql);
	$stmt->execute();
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $results;
    }
    
    public function listarSelect(){
        $sql =
            "SELECT cli_id, cli_dsc ".
            "FROM ".ESQUEMA.".cliente ".
            "WHERE (cli_dtre IS NULL) ".
            "ORDER BY cli_dsc;";
        
        $stmt = $this->pdo->prepare($sql);
	$stmt->execute();
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $results;
    }
    
    public function listarPorNivel(){
        $s_cli_id = $_SESSION[SESSAOEMPRESA]['cli_id'];
        $sNivelUsuario = $_SESSION[SESSAOEMPRESA]['usrt_dsc'];
        
        if ($sNivelUsuario == 'GERENCIA')
            $sql = 
                "SELECT cli_id, cli_dsc ".
                "FROM ".ESQUEMA.".cliente ".
                "WHERE (cli_dtre IS NULL) ".
                "ORDER BY cli_dsc;";
        
        elseif (in_array($sNivelUsuario, array('USUÁRIO GERENTE', 'USUÁRIO SUB-GERENTE')))
            $sql = 
                "SELECT cli_id, cli_dsc ".
                "FROM ".ESQUEMA.".cliente ".
                "WHERE (cli_dtre IS NULL) AND ((cli_id = '{$s_cli_id}') OR (cli_mae = '{$s_cli_id}')) ".
                "ORDER BY cli_dsc;";
                
        elseif ($sNivelUsuario == 'MONITORADOR') 
            $sql = 
                "SELECT DISTINCT c.cli_id, c.cli_dsc 
		FROM ".ESQUEMA.".cliente c 
		INNER JOIN ".ESQUEMA.".usuario u ON u.cli_id = c.cli_id AND u.usr_dtre IS NULL 
		INNER JOIN ".ESQUEMA.".usuario_tipo ut ON ut.usrt_id = u.usrt_id 
		WHERE (c.cli_dtre IS NULL) AND (ut.usrt_dsc != 'USUARIO VIP') AND ((SELECT count(i.inst_id) FROM ".ESQUEMA.".instalacao i WHERE (i.cli_id = c.cli_id) AND (i.inst_dtre IS NULL)) > 0) 
		ORDER BY c.cli_dsc;";
        else
            $sql = 
                "SELECT DISTINCT cli_id, cli_dsc 
		FROM ".ESQUEMA.".cliente 
		WHERE (cli_dtre IS NULL) AND ((cli_id = '{$s_cli_id}') OR (cli_mae = '{$s_cli_id}')) 
		ORDER BY cli_dsc;";
                
        $stmt = $this->pdo->prepare($sql);
	$stmt->execute();
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $results;
    }
    
    public function listarJSON($s_cli_id){
        $sNivelUsuario = $_SESSION[SESSAOEMPRESA]['usrt_dsc'];
        
        if ($sNivelUsuario == 'GERENCIA') 
            $sql = "SELECT DISTINCT c.cli_id, c.cli_dsc 
                FROM ".ESQUEMA.".cliente c 
                WHERE (c.cli_dtre IS NULL) AND ((SELECT count(i.inst_id) FROM ".ESQUEMA.".instalacao i WHERE (i.cli_id = c.cli_id) AND (i.inst_dtre IS NULL)) > 0) 
                ORDER BY cli_dsc;";
        elseif ($sNivelUsuario == 'MONITORADOR') 
            $sql = "SELECT DISTINCT c.cli_id, c.cli_dsc 
                FROM ".ESQUEMA.".cliente c 
                INNER JOIN ".ESQUEMA.".usuario u ON u.cli_id = c.cli_id AND u.usr_dtre IS NULL 
                INNER JOIN ".ESQUEMA.".usuario_tipo ut ON ut.usrt_id = u.usrt_id 
                WHERE (c.cli_dtre IS NULL) AND (ut.usrt_dsc != 'USUARIO VIP') AND ((SELECT count(i.inst_id) FROM ".ESQUEMA.".instalacao i WHERE (i.cli_id = c.cli_id) AND (i.inst_dtre IS NULL)) > 0) 
                ORDER BY c.cli_dsc;";
        else
            $sql = "SELECT DISTINCT cli_id, cli_dsc 
            FROM ".ESQUEMA.".cliente 
            WHERE (cli_dtre IS NULL) AND ((cli_id = '{$s_cli_id}') OR (cli_mae = '{$s_cli_id}')) 
            ORDER BY cli_dsc;";
        
        $stmt = $this->pdo->prepare($sql);
	$stmt->execute();
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $results;        
    }
    
    public function validar($params){
        $valor = strtoupper($params['value']);
        if ($params['tipo'] == 'nome'){
            $sql = "SELECT count(0) AS total ".
		"FROM ".ESQUEMA.".cliente ".
		"WHERE (cli_dtre IS NULL) AND (UPPER(cli_dsc) = '{$valor}')".($params['acao'] == 'alterar' ? " AND (cli_id != '{$params['id']}')" : '').";";
            
        }elseif($params['tipo'] == 'sigla'){
            $sql = "SELECT count(0) AS total ".
		"FROM ".ESQUEMA.".cliente ".
		"WHERE (cli_dtre IS NULL) AND (UPPER(cli_sigla) = '{$valor}')".($params['acao'] == 'alterar' ? " AND (cli_id != '{$params['id']}')" : '').";";
            
        }
        
        $stmt = $this->pdo->prepare($sql);
	$stmt->execute();
	$results = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return ($results['total'] == '0') ? 'Ok' : 'Erro';
        
        
    }

}

?>