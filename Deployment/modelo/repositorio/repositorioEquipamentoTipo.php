<?php
/**
 * Descrição da repositorioEquipamentoTipo
 *
 * @Autor Valter Vasconcelos 12/07/2012
 */
class repositorioEquipamentoTipo {
    private $pdo;
     
    //Construtor da Classe
    function __construct($pdo) {
        $this->pdo = $pdo;
    }
    
    //inserir equipamento tipo
    public function inserir($oEquipamentoTipo){
        $sql = 
            "INSERT INTO ".ESQUEMA.".equipamento_tipo(
                equipt_dsc,
                equipt_forn,
                equipt_obs
                ) values
                ('{$oEquipamentoTipo->getEquipt_dsc()}',
                '{$oEquipamentoTipo->getEquipt_forn()}',
                '{$oEquipamentoTipo->getEquipt_obs()}')"; 
                
        $stmt = $this->pdo->prepare($sql);
	$stmt->execute();	
    }
    
    //remover equipamento tipo
    public function remover($id){
        $dHoje	= date("Y-m-d");
        $sql = "UPDATE ".ESQUEMA.".equipamento_tipo SET equipt_dtre = '{$dHoje}' WHERE (equipt_id = {$id}); ";		//-----  Remove os usuários do cliente
        $stmt = $this->pdo->prepare($sql);
	$stmt->execute();
        
    }
    
    //exibir equipamento tipo
    public function listar(){        
        $sql =
            "SELECT 
                equipt_id, 
                equipt_dsc,
                equipt_forn, 
                equipt_obs 
            FROM ".ESQUEMA.".equipamento_tipo 
            WHERE equipt_dtre is null     
            ORDER BY equipt_dsc;";     
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;        
    }
    
    //exibir equipamento tipo por id
    public function listarPorId($id){
        $sql =
            "SELECT 
                equipt_id,                
                equipt_dsc,
                equipt_forn,
                equipt_obs
            FROM ".ESQUEMA.".equipamento_tipo
            WHERE equipt_id = '{$id}' and
            equipt_dtre is null
            ORDER BY equipt_dsc LIMIT 1;";        
        $stmt = $this->pdo->prepare($sql);
	$stmt->execute();
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);              
        return $results;    
    }
    
    // alterar equipamento tipo 
     public function alterar($oEquipamentoTipo){        
        $sql = 
            "UPDATE ".ESQUEMA.".equipamento_tipo SET
                equipt_dsc = '{$oEquipamentoTipo->getEquipt_dsc()}',
                equipt_forn = '{$oEquipamentoTipo->getEquipt_forn()}'
            
            WHERE
                equipt_id = '{$oEquipamentoTipo->getEquipt_id()}'";    
        $stmt = $this->pdo->prepare($sql);
	$stmt->execute();	
    }
    
    public function validar($params){        
        $sql = "SELECT count(0) AS total ".
            "FROM ".ESQUEMA.".equipamento_tipo ".
            "WHERE (UPPER(equipt_dsc) = UPPER('{$params['value']}'))".($params['acao'] == 'alterar' ? " AND (equipt_id != '{$params['id']}')" : '').";";
        
        $stmt = $this->pdo->prepare($sql);
	$stmt->execute();
	$results = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return ($results['total'] == '0') ? 'Ok' : 'Erro';
        
        
    }
    
}

?>