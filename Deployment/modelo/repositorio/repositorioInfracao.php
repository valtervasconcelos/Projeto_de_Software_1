<?php
/**
 * Description of repositorioInfracao
 *
 * @author Valter Vasconcelos
 */
class repositorioInfracao {

   //Construtor da Classe
    function __construct($pdo) {
        $this->pdo = $pdo;
    }
    
    public function inserir($oInfracao){
        $pagamento = ($oInfracao->getInfr_dtpag()=="" ? 'NULL' : $oInfracao->getInfr_dtpag());
        
        $sql = 
            "INSERT INTO ".ESQUEMA.".infracao(
                infr_dthr,
                cli_id,
                moto_id,
                inst_id,
                tab_id,
                infr_dsc,
                infr_lembrar,
                infr_status,
                infr_valor,
                infr_dtpag,
                infr_ponto,
                infr_vecimento
            )values(
                '{$oInfracao->getInfr_dthr()}',
                '{$oInfracao->getCli_id()}',
                '{$oInfracao->getMoto_id()}',
                '{$oInfracao->getInst_id()}',
                '{$oInfracao->getTab_id()}',
                '{$oInfracao->getInfr_dsc()}',
                '{$oInfracao->getInfr_lembrar()}',
                '{$oInfracao->getInfr_status()}',
                '{$oInfracao->getInfr_valor()}',
                {$pagamento},
                '{$oInfracao->getInfr_ponto()}',
                '{$oInfracao->getInfr_vecimento()}'
            )";

        $stmt = $this->pdo->prepare($sql);
	$stmt->execute();	
    }   
    
    public function alterar($oInfracao){ 
        $pagamento = ($oInfracao->getInfr_dtpag()=="" ? 'NULL' : $oInfracao->getInfr_dtpag());

        $sql = 
            "UPDATE ".ESQUEMA.".infracao SET
                infr_dthr = '{$oInfracao->getInfr_dthr()}',
                moto_id = '{$oInfracao->getMoto_id()}',
                inst_id = '{$oInfracao->getInst_id()}',
                tab_id = '{$oInfracao->getTab_id()}',
                infr_dsc = '{$oInfracao->getInfr_dsc()}',
                infr_lembrar = '{$oInfracao->getInfr_lembrar()}',
                infr_status = '{$oInfracao->getInfr_status()}',
                infr_valor = '{$oInfracao->getInfr_valor()}',
                infr_dtpag = '{$pagamento}'
            WHERE
                infr_id = '{$oInfracao->getInfr_id()}'";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }

    public function remover($id){
        $dHoje	= date("Y-m-d");
      	$sql = "UPDATE ".ESQUEMA.".infracao SET infr_dtre = '{$dHoje}' WHERE infr_id = {$id}; ";	//-----  Remove o cliente
        $stmt = $this->pdo->prepare($sql);
	$stmt->execute();
    }

    public function listar(){
        $sql = "SELECT  * FROM ".ESQUEMA.".infracao where infr_dtre is null";
        $stmt = $this->pdo->prepare($sql);
	$stmt->execute();
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);     
        return $results;
    }
    
    public function listarPorId($id){
        $sql ="
            SELECT  
                infr_id, 
                to_char(infr_dthr, 'dd/mm/yyyy hh24:mi:ss') as  infr_dthr,
                moto_id, 
                inst_id,
                tab_id,
                infr_dsc, 
                infr_status, 
                infr_valor, 
                infr_dtpag, 
                infr_ponto,
                infr_lembrar,
                infr_dtpag,
                to_char(infr_vecimento, 'dd/mm/yyyy') as infr_vecimento
            
            FROM ".ESQUEMA.".infracao WHERE infr_id = '{$id}' and infr_dtre is null";
                
        $stmt = $this->pdo->prepare($sql);
	$stmt->execute();
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }
        
    public function listarInfracaoPorCli($cli){
        $sql = 
        "SELECT  
            if.infr_id, 
            to_char(if.infr_dthr, 'dd/mm/yyyy hh24:mi:ss') as  infr_dthr,
            if.moto_id, 
            if.inst_id,
            if.tab_id,
            m.moto_dsc, 
            if.infr_dsc, 
            if.infr_status, 
            if.infr_valor, 
            if.infr_dtpag, 
            if.infr_ponto, 
            to_char(if.infr_vecimento, 'dd/mm/yyyy') as infr_vecimento, 
            i.inst_dsc 

        FROM ".ESQUEMA.".infracao if 
        LEFT JOIN ".ESQUEMA.".instalacao i ON if.inst_id = i.inst_id
        LEFT JOIN  ".ESQUEMA.".motorista m ON if.moto_id = m.moto_id  
        where if.infr_dtre is null and i.inst_dtre is null and if.cli_id='{$cli}'";

        $stmt = $this->pdo->prepare($sql);
	$stmt->execute();
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }
    
    public function listarTabelaInfracao() {
        $sql ="SELECT  * FROM public.tabela_infracao order by tab_cod";
        $stmt = $this->pdo->prepare($sql);
	$stmt->execute();
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }
    
     public function listarTabelaInfracaoPorId($cod) {
        $sql ="SELECT  * FROM public.tabela_infracao  where tab_id = '{$cod}' ";
        $stmt = $this->pdo->prepare($sql);
	$stmt->execute();
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }
    
}

?>