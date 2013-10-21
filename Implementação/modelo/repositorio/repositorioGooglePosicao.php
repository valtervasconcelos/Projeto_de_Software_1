<?php
/**
 * Descricao da repositorioGooglePosicao
 *
 * @Autor Valter Vasconcelos 14/12/2012
 * Analista de Sistemas
 */
class repositorioGooglePosicao {
    private $pdo;

    //Construtor da Classe
    function __construct($pdo) {
        $this->pdo = $pdo;
    }
    
    public function listarLatLon($lat, $lon){
        $sql = 
        "SELECT goop_ender, goop_bairro, goop_cidade, goop_uf, goop_pais, goop_cep ".
        "FROM gerencia.google_posicao ".
        "WHERE (goop_lat = '{$lat}'::double precision AND goop_lon = '{$lon}'::double precision) LIMIT 1;";
        
        $results = $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
      
        return $results;
    }
    
    public function listarEndereco($lat, $lon){
        $sql =" 
        select count(*) as qtd from gerencia.google_posicao  where goop_lat='{$lat}' and goop_lon = '{$lon}' and goop_ender  is not null limit 1";        
        $results = $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);     
        return $results;
    }
    
    public function AtualizarGoogleEndereco($lat, $lon, $end) {
        $sql = "update gerencia.google_posicao set goop_ender= '{$end}' where goop_lat='{$lat}' and goop_lon = '{$lon}'";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }
    
    public function inserirGoogleEndereco($lat, $lon, $endereco) {
        $sql = "INSERT INTO gerencia.google_posicao(goop_lat, goop_lon, goop_ender) ".
		"VALUES('{$lat}', '{$lon}', '{$endereco}')";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }

}

?>