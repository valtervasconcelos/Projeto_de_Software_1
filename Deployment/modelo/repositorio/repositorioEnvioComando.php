<?php
/**
 * Descricao da repositorioEnvioComando
 *
 * @Autor Valter Vasconcelos 03/08/2012
 * 
 */
class repositorioEnvioComando {
    private $pdo;
     
    //Construtor da Classe
    function __construct($pdo) {
        $this->pdo = $pdo;
    }
   
    public function inserir($oEnvioComando){
        $data1 = ($oEnvioComando->getEnvcom_dthren() != '')? $oEnvioComando->getEnvcom_dthren() : 'NULL';
        $data2 = ($oEnvioComando->getEnvcom_dthrco() != '')? $oEnvioComando->getEnvcom_dthrco() : 'NULL';
        
        $sql = 
            "INSERT INTO ".ESQUEMA.".envio_comando(
                inst_id,
                envcom_dsc,
                envcom_comando,
                envcom_obs,
                usr_id_cad,
                envcom_dthren,
                envcom_dthrco,
                usr_id_rem
            ) values(
                '{$oEnvioComando->getInst_id()}',
                '{$oEnvioComando->getEnvcom_dsc()}',
                '{$oEnvioComando->getEnvcom_comando()}',
                '{$oEnvioComando->getEnvcom_obs()}',
                '{$oEnvioComando->getUsr_id_cad()}',
                {$data1},
                {$data2},
                '{$oEnvioComando->getUsr_id_rem()}'
            )"; 
                
        $stmt = $this->pdo->prepare($sql);
	$stmt->execute();	
    }    
    
    public function alterar($oEnvioComando){
        $data1 = ($oEnvioComando->getEnvcom_dthren() != '')? $oEnvioComando->getEnvcom_dthren() : 'NULL';
        $data2 = ($oEnvioComando->getEnvcom_dthrco() != '')? $oEnvioComando->getEnvcom_dthrco() : 'NULL';
        
        $sql = 
            "UPDATE ".ESQUEMA.".envio_comando SET                
                envcom_dsc = '{$oEnvioComando->getEnvcom_dsc()}',
                envcom_comando = '{$oEnvioComando->getEquipt_dsc()}',
                envcom_obs = '{$oEnvioComando->getEnvcom_comando()}',
                usr_id_cad = '{$oEnvioComando->getEnvcom_obs()}',
                envcom_dthren = {$data1},
                envcom_dthrco = {$data2},
                usr_id_rem = '{$oEnvioComando->getEnvcom_dthrco()}'

            WHERE
                envcom_id = '{$oEnvioComando->getEnvcom_id()}'";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }    
    
    public function remover($id){
        $dHoje	= date("Y-m-d");
        $sql = "UPDATE ".ESQUEMA.".envio_comando SET envcom_dthrre = '{$dHoje}' WHERE (envcom_id = {$id}); ";		//-----  Remove os usuários do cliente
        $stmt = $this->pdo->prepare($sql);
	$stmt->execute();
    }    

    public function listar(){        
        $sql =
            "SELECT 
                envcom_id,
                inst_id,
                envcom_dsc,
                envcom_comando,
                envcom_obs,
                usr_id_cad,
                envcom_dthrca,
                envcom_dthren,
                envcom_dthrco,
                usr_id_rem,
                envcom_dthrre
                
            FROM ".ESQUEMA.".envio_comando 
            WHERE envcom_dthrre is null     
            ORDER BY envcom_dsc;";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;        
    }

    public function listarPorId($id){
        $sql =
            "SELECT 
                envcom_id,
                inst_id,
                envcom_dsc,
                envcom_comando,
                envcom_obs,
                usr_id_cad,
                envcom_dthrca,
                envcom_dthren,
                envcom_dthrco,
                usr_id_rem,
                envcom_dthrre
    
            FROM ".ESQUEMA.".envio_comando
            WHERE envcom_id = '{$id}' and
            envcom_dthrre is null";
            
        $stmt = $this->pdo->prepare($sql);
	$stmt->execute();
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;    
    }
    
}

?>