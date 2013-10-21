<?php
/**
 * Descrição da repositorioVeiculo
 *
 * @Autor Valter Vasconcelos 26/07/2012
 */
class repositorioVeiculo {private $pdo;

    //Construtor da Classe
    function __construct($pdo) {
        $this->pdo = $pdo;
    }

     public function inserir($oVeiculo){        
        $sql = 
            "INSERT INTO ".ESQUEMA.".veiculo(    
                cli_id,
                veicic_id,
                veicma_id,
                veicmo_id,
                veicor_id,
                veic_placa,
                veic_chassi,
                veic_renavam,
                veic_consumo,
                veic_ano,
                esta_id,
                veic_obs
               )values(
                '{$oVeiculo->getCli_id()}',
                '{$oVeiculo->getVeicic_id()}',
                '{$oVeiculo->getVeicma_id()}',
                '{$oVeiculo->getVeicmo_id()}',
                '{$oVeiculo->getVeicor_id()}',
                '{$oVeiculo->getVeic_placa()}',
                '{$oVeiculo->getVeic_chassi()}',
                '{$oVeiculo->getVeic_renavam()}',
                '{$oVeiculo->getVeic_consumo()}',
                '{$oVeiculo->getVeic_ano()}',
                '{$oVeiculo->getEsta_id()}',
                '{$oVeiculo->getVeic_obs()}'
            )";
                
        $stmt = $this->pdo->prepare($sql);
	$stmt->execute();	
        return $this->pdo->lastInsertId();      
    } 
        
    public function alterar($oVeiculo){        
        $sql = 
            "UPDATE ".ESQUEMA.".veiculo SET        
                veicma_id = '{$oVeiculo->getVeicma_id()}',
                veicmo_id = '{$oVeiculo->getVeicmo_id()}',
                veicor_id = '{$oVeiculo->getVeicor_id()}',
                veic_placa = '{$oVeiculo->getVeic_placa()}',
                veic_chassi = '{$oVeiculo->getVeic_chassi()}',
                veic_renavam = '{$oVeiculo->getVeic_renavam()}',
                veic_consumo = '{$oVeiculo->getVeic_consumo()}',
                veic_ano = '{$oVeiculo->getVeic_ano()}',
                esta_id = '{$oVeiculo->getEsta_id()}',
                veic_obs = '{$oVeiculo->getVeic_obs()}'            
            WHERE
                veic_id = '{$oVeiculo->getVeic_id()}'";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
      
    }
    
    public function remover($id){
        $dHoje	= date("Y-m-d");
        
        $sql = "UPDATE ".ESQUEMA.".veiculo SET veic_dtre = '{$dHoje}' WHERE (veic_id = {$id}); ";
        $stmt = $this->pdo->prepare($sql);
	$stmt->execute();
    }
    
    public function listar($cli_id = "0"){
        if ($cli_id != "0"){                 
            $sql =
            "SELECT DISTINCT v.veic_id, 
                             v.veic_placa,
                             esta_id,
                             to_char(v.veic_dtca, 'dd/mm/yyyy') as veic_dtca, 
                             v.veic_chassi, 
                             v.veic_renavam,
                             v.veic_consumo,
                             v.veic_ano, 
                             ma.veicma_dsc,
                             mo.veicmo_dsc,
                             vc.veicor_dsc, 
                             vi.veicic_dsc, 
                             i.inst_dsc ".
			"FROM ".ESQUEMA.".veiculo v " .
			"LEFT JOIN ".ESQUEMA.".instalacao i ON i.veic_id = v.veic_id AND i.inst_dtre IS NULL ".
			"LEFT JOIN ".ESQUEMA.".veiculo_marca ma ON ma.veicma_id = v.veicma_id " .
			"LEFT JOIN ".ESQUEMA.".veiculo_modelo mo ON mo.veicmo_id = v.veicmo_id " .
			"LEFT JOIN ".ESQUEMA.".veiculo_cor vc ON vc.veicor_id = v.veicor_id " .
			"LEFT JOIN ".ESQUEMA.".veiculo_icone vi ON vi.veicic_id = v.veicic_id " .
			"WHERE (v.veic_dtre IS NULL) AND (v.cli_id = '{$cli_id}')".
			"ORDER BY v.veic_id;";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $_SESSION[SESSAOEMPRESA]['cli_select'] = $cli_id;
            
           return $results;
        }else
            return NULL;
    }
    
    
    public function listarPorId($id){        
        $sql =
           "SELECT veic_id, cli_id, veicma_id, veicmo_id, veicor_id, veicic_id, esta_id, " .
           "veic_placa, veic_chassi, veic_renavam, veic_consumo, veic_ano, veic_obs " .
           "FROM ".ESQUEMA.".veiculo".
           " WHERE veic_id='{$id}' AND veic_dtre IS NULL ";

        $stmt = $this->pdo->prepare($sql);
	$stmt->execute();
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
      
        return $results;
    }
    
    public function listarVeiculoInstalacao($cli_id, $inst_id,  $acao){
        if ($cli_id != "0"){
            $sql = 
            "SELECT DISTINCT v.veic_id, v.veic_placa, v.veic_consumo
            FROM ".ESQUEMA.".veiculo v 
            LEFT JOIN ".ESQUEMA.".instalacao i ON (i.veic_id = v.veic_id) AND (i.inst_dtre IS NULL) 
            WHERE (v.veic_dtre IS NULL) AND (v.cli_id='{$cli_id}') AND ((i.inst_id IS NULL) OR (i.inst_dtre IS NOT NULL)) 
            ".($acao == 'a' ? " OR (i.inst_id = '{$inst_id}') " : '')."
            ORDER BY v.veic_placa;";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $results;
        }else
            return NULL;
    }
      
}

?>