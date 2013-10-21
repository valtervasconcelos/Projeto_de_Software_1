<?php
/**
 * Descrição da repositorioEquipamento  
 *
 * @Autor Valter Vasconcelos 02/08/2012
 */
class repositorioEquipamento {
    private $pdo;

    //Construtor da Classe
    function __construct($pdo) {
        $this->pdo = $pdo;
    }
    
    public function inserir($oEquipamento){
        $dataCompra = ($oEquipamento->getEquip_dtcp() != '')? "'".$oEquipamento->getEquip_dtcp()."'" : 'NULL';
        $sql = 
            "INSERT INTO ".ESQUEMA.".equipamento(
                equipt_id,
                chip_id,
                equip_serial,
                equip_imei,
                equip_dtcp,
                equip_obs
            ) values (
                '{$oEquipamento->getEquipt_id()}',
                '{$oEquipamento->getChip_id()}',
                '{$oEquipamento->getEquip_serial()}',
                '{$oEquipamento->getEquip_imei()}',
                {$dataCompra},
                '{$oEquipamento->getEquip_obs()}'
            )";  
                
        $stmt = $this->pdo->prepare($sql);
	$stmt->execute();	
    }
        
    public function alterar($oEquipamento){
        $dataCompra = ($oEquipamento->getEquip_dtcp() != '')? "'".$oEquipamento->getEquip_dtcp()."'" : 'NULL';
        $sql = 
            "UPDATE ".ESQUEMA.".equipamento SET
                equipt_id = '{$oEquipamento->getEquipt_id()}',
                chip_id = '{$oEquipamento->getChip_id()}',
                equip_serial = '{$oEquipamento->getEquip_serial()}',
                equip_imei = '{$oEquipamento->getEquip_imei()}',
                equip_dtcp = {$dataCompra},
                equip_obs  = '{$oEquipamento->getEquip_obs()}'
            WHERE
                equip_id = '{$oEquipamento->getEquip_id()}'";
                
        $stmt = $this->pdo->prepare($sql);
	$stmt->execute();	       
    }
    
    public function listar(){        
        $sql =
            "SELECT e.equip_id, e.equip_imei, e.equipt_id, e.chip_id, e.equip_serial, et.equipt_dsc, cg.chip_serial,
                e.equip_obs, cg.chip_tel, c.cli_dsc, c.cli_sigla, i.inst_dsc 
		FROM ".ESQUEMA.".equipamento e 
		LEFT JOIN ".ESQUEMA.".equipamento_tipo et ON (et.equipt_id = e.equipt_id) 
		LEFT JOIN ".ESQUEMA.".chip_gsm cg ON (cg.chip_id = e.chip_id) AND (cg.chip_dtre IS NULL) 
		LEFT JOIN ".ESQUEMA.".instalacao i ON (i.equip_id = e.equip_id) AND (i.inst_dtre IS NULL)
		LEFT JOIN ".ESQUEMA.".cliente c ON (c.cli_id = i.cli_id) AND (c.cli_dtre IS NULL) where e.equip_dtre is null order by e.equip_id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results; 
    }
    
    public function listarPorId($id){
        $sql =
           "SELECT e.equip_id,  to_char(e.equip_dtcp, 'dd/mm/yyyy') as equip_dtcp, e.equip_imei, e.equipt_id,
		e.equip_obs, e.equip_serial, et.equipt_dsc, cg.chip_id,  cg.chip_serial, cg.chip_tel,
		c.cli_dsc, c.cli_sigla, i.inst_dsc 
		FROM ".ESQUEMA.".equipamento e 
		LEFT JOIN ".ESQUEMA.".equipamento_tipo et ON (et.equipt_id = e.equipt_id) 
		LEFT JOIN ".ESQUEMA.".chip_gsm cg ON (cg.chip_id = e.chip_id) AND (cg.chip_dtre IS NULL) 
		LEFT JOIN ".ESQUEMA.".instalacao i ON (i.equip_id = e.equip_id) AND (i.inst_dtre IS NULL)
		LEFT JOIN ".ESQUEMA.".cliente c ON (c.cli_id = i.cli_id) AND (c.cli_dtre IS NULL) where e.equip_id='$id' and e.equip_dtre is null";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results; 
    }
    
    public function remover($id){
        $dHoje	= date("Y-m-d");
        $sql = "UPDATE ".ESQUEMA.".equipamento SET equip_dtre = '{$dHoje}' WHERE (equip_id = {$id}); ";		//-----  Remove os usuários do cliente
        $stmt = $this->pdo->prepare($sql);
	$stmt->execute();       
    }
    
    
    public function listarEquipamentoInstalacao($inst_id, $acao) {
        $sql =
            "SELECT DISTINCT e.equip_id, e.equip_serial ".
            "FROM ".ESQUEMA.".equipamento e ".
            "LEFT JOIN ".ESQUEMA.".instalacao i ON (i.equip_id = e.equip_id) AND (i.inst_dtre IS NULL) ".
            "WHERE ((i.equip_id IS NULL) AND (e.equip_dtre IS NULL) AND (e.chip_id IS NOT NULL)) ".($acao != 'a' ? '' : "OR (i.inst_id = '{$inst_id}') ").
            "ORDER BY e.equip_serial;";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }
    
    public function validar($params){
        $valor = strtoupper($params['value']);
        
        if ($params['tipo'] == 'serial'){
            $sql = "SELECT count(0) AS total ".
		"FROM ".ESQUEMA.".equipamento ".
		"WHERE (equip_dtre IS NULL) AND (UPPER(equip_serial) = '{$valor}')".($params['acao'] == 'alterar' ? " AND (equip_id != '{$params['id']}')" : '').";";
            
        }elseif($params['tipo'] == 'imei'){
            $sql = "SELECT count(0) AS total ".
		"FROM ".ESQUEMA.".equipamento ".
		"WHERE (equip_dtre IS NULL) AND (UPPER(equip_imei) = '{$valor}')".($params['acao'] == 'alterar' ? " AND (equip_id != '{$params['id']}')" : '').";";
            
        }
        
        $stmt = $this->pdo->prepare($sql);
	$stmt->execute();
	$results = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return ($results['total'] == '0') ? 'Ok' : 'Erro';
    
    }
    
}

?>