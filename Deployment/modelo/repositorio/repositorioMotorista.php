<?php
/**
 * Descricao da repositorioMotorista
 *
 * @Autor Valter Vasconcelos 13/07/2012
 * 
 */
class repositorioMotorista {
    private $pdo;

    //Construtor da Classe
    function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function inserir($oMotorista){
        $sql = 
            "INSERT INTO ".ESQUEMA.".motorista(
                cli_id,
                moto_dsc,
                moto_ende,
                moto_bair,
                moto_cida,
                esta_id,
                moto_cep,
                moto_iden,
                moto_cmot,
                moto_cmotvc,
                moto_cpf,
                moto_dtadm,
                moto_tel,
                moto_cel,
                moto_foto,
                moto_obs
            )values(
                '{$oMotorista->getCli_id()}',
                '{$oMotorista->getMoto_dsc()}',
                '{$oMotorista->getMoto_ende()}',
                '{$oMotorista->getMoto_bair()}',
                '{$oMotorista->getMoto_cida()}',
                '{$oMotorista->getEsta_id()}',
                '{$oMotorista->getMoto_cep()}',
                '{$oMotorista->getMoto_iden()}',
                '{$oMotorista->getMoto_cmot()}',
                {$oMotorista->getMoto_cmotvc()},
                '{$oMotorista->getMoto_cpf()}',
                {$oMotorista->getMoto_dtadm()},
                '{$oMotorista->getMoto_tel()}',
                '{$oMotorista->getMoto_cel()}',
                '{$oMotorista->getMoto_foto()}',
                '{$oMotorista->getMoto_obs()}'                
            )";

        $stmt = $this->pdo->prepare($sql);
	$stmt->execute();	
        return $this->pdo->lastInsertId();
    }
    
    public function alterar($oMotorista){        
        $sql = 
            "UPDATE ".ESQUEMA.".motorista SET
                moto_dsc = '{$oMotorista->getMoto_dsc()}',
                moto_ende = '{$oMotorista->getMoto_ende()}',
                moto_bair = '{$oMotorista->getMoto_bair()}',
                moto_cida = '{$oMotorista->getMoto_cida()}',
                esta_id = '{$oMotorista->getEsta_id()}',
                moto_cep = '{$oMotorista->getMoto_cep()}',
                moto_iden = '{$oMotorista->getMoto_iden()}',
                moto_cmot = '{$oMotorista->getMoto_cmot()}',
                moto_cmotvc = {$oMotorista->getMoto_cmotvc()},
                moto_cpf = '{$oMotorista->getMoto_cpf()}',
                moto_dtadm = {$oMotorista->getMoto_dtadm()},
                moto_tel = '{$oMotorista->getMoto_tel()}',
                moto_cel = '{$oMotorista->getMoto_cel()}',
                moto_foto = '{$oMotorista->getMoto_foto()}',
                moto_obs = '{$oMotorista->getMoto_obs()}'
            
            WHERE
                moto_id = '{$oMotorista->getMoto_id()}'";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }
    
    public function remover($id){
        $dHoje	= date("Y-m-d");
        
        $sql = "UPDATE ".ESQUEMA.".motorista SET moto_dtre = '{$dHoje}' WHERE (moto_id = {$id}); ";		//-----  Remove os usuários do cliente
        $stmt = $this->pdo->prepare($sql);
	$stmt->execute();
    }
    
    public function listar($cli_id = "0"){        
        if ($cli_id != "0"){
            $sql =
                "SELECT m.moto_id, m.moto_dsc, moto_tel, moto_cel, i.inst_dsc ".
                "FROM ".ESQUEMA.".motorista m ".
                "LEFT JOIN ".ESQUEMA.".instalacao i ON (i.moto_id = m.moto_id AND i.inst_dtre IS NULL) ".
                "WHERE (m.moto_dtre IS NULL) AND (m.cli_id = '{$cli_id}') ".
                "ORDER BY m.moto_dsc;";

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
                moto_id,
                cli_id,                
                moto_dsc,
                moto_ende,
                moto_bair,
                moto_cida,
                esta_id,
                moto_cep,
                moto_iden,
                moto_cmot,
                to_char(moto_cmotvc, 'dd/mm/yyyy') as moto_cmotvc,
                moto_cpf,
                to_char(moto_dtadm, 'dd/mm/yyyy') as moto_dtadm,
                moto_tel,
                moto_cel,
                moto_foto,
                moto_obs
            
            FROM ".ESQUEMA.".motorista
            
            WHERE moto_id = '{$id}' AND (moto_dtre IS NULL) ".($sNivelUsuario == 'USUÁRIO TESTE' ? "AND (moto_id = '1') " : '' );
        
        $stmt = $this->pdo->prepare($sql);
	$stmt->execute();
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $results;
    }
    
    public function listarPorCliente($cli_id){
        if ($cli_id != "0"){
            $sql =
                "SELECT DISTINCT 
                    moto_id,
                    cli_id,
                    moto_dsc,
                    moto_ende,
                    moto_bair,
                    moto_cida,
                    esta_id,
                    moto_cep,
                    moto_iden,
                    moto_cmot,
                    to_char(moto_cmotvc, 'dd/mm/yyyy') as moto_cmotvc,
                    moto_cpf,
                    to_char(moto_dtadm, 'dd/mm/yyyy') as moto_dtadm,
                    moto_tel,
                    moto_cel,
                    moto_foto,
                    moto_obs

                FROM ".ESQUEMA.".motorista

                WHERE cli_id = '{$cli_id}' AND (moto_dtre IS NULL) ";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $results;
        }else
            return NULL;
    }    

}

?>