<?php
/**
 * Descricao da repositorioUsuarioTipo
 *
 * @Autor Valter Vasconcelos 11/07/2012
 * 
 */
class repositorioUsuarioTipo {
    private $pdo;

    //Construtor da Classe
    function __construct($pdo) {
        $this->pdo = $pdo;        
    }
    
    public function inserir($oUsuarioTipo){
        $sql = 
            "INSERT INTO ".ESQUEMA.".usuario_tipo(    
                usrt_dsc,
                usrt_obs
            )values(
                '{$oUsuarioTipo->getUsrt_dsc()}',
                '{$oUsuarioTipo->getUsrt_obs()}'
            )";

        $stmt = $this->pdo->prepare($sql);
	$stmt->execute();	
    }
    
    public function alterar($oUsuarioTipo){        
        $sql = 
            "UPDATE ".ESQUEMA.".usuario_tipo SET
                usrt_dsc = '{$oUsuarioTipo->getUsrt_dsc()}',
                usrt_obs = '{$oUsuarioTipo->getUsrt_obs()}'
            
            WHERE
                usrt_id = '{$oUsuarioTipo->getUsrt_id()}'";        
        
        $stmt = $this->pdo->prepare($sql);
	$stmt->execute();	
    }
    
    public function remover($id){
        $sql = "SELECT COUNT(*) as total FROM ".ESQUEMA.".usuario WHERE (usrt_id = {$id}) and usr_dtre is null; ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if ($results[0]['total'] > 0)
            return false;
        else{        
            $sql = "DELETE FROM ".ESQUEMA.".usuario_tipo WHERE (usrt_id = {$id}); ";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return true;
        }
    }
    
    public function listar(){        
        $sql =
            "SELECT usrt_id, usrt_dsc " .
            "FROM ".ESQUEMA.".usuario_tipo " .
            "ORDER BY usrt_dsc;";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }
    
    public function listarPorId($id){
        $sNivelUsuario = $_SESSION[SESSAOEMPRESA]['usrt_dsc'];
        $sql =
            "SELECT DISTINCT 
                usrt_id,                
                usrt_dsc,
                usrt_obs
            
            FROM ".ESQUEMA.".usuario_tipo
            
            WHERE usrt_id = '{$id}'";
        
        $stmt = $this->pdo->prepare($sql);
	$stmt->execute();
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $results;
    }
    
    public function validar($params){
        $valor = strtoupper($params['value']);

        $sql = "SELECT count(0) AS total ".
            "FROM ".ESQUEMA.".usuario_tipo ".
            "WHERE (UPPER(usrt_dsc) = '{$valor}')".($params['acao'] == 'alterar' ? " AND (usrt_id != '{$params['id']}')" : '').";";

        $stmt = $this->pdo->prepare($sql);
	$stmt->execute();
	$results = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return ($results['total'] == '0') ? 'Ok' : 'Erro';
    }
}

?>