<?php
include_once 'modelo/repositorio/repositorioGooglePosicao.php';
/**
 * Descricao da controladorGooglePosicao
 *
 * @Autor Valter Vasconcelos 14/12/2012
 * 
 */
class controladorGooglePosicao {
    private $oRepoGooglePosicao;

    //Construtor da Classe
    function __construct($pdo){
        $this->oRepoGooglePosicao = new repositorioGooglePosicao($pdo);
    }
    
    public function listarGooglePosicaoLatLon($lat, $lon){
        return $this->oRepoGooglePosicao->listarLatLon($lat, $lon);
    }
    
    public function listarGoogleEndereco($lat, $lon) {
        return $this->oRepoGooglePosicao->listarEndereco($lat, $lon);
    }
    
    public function AtualizarGoogleEndereco($lat, $lon, $end) {
        $this->oRepoGooglePosicao->AtualizarGoogleEndereco($lat, $lon, $end);
    }
    
    public function inserirGoogleEndereco($lat, $lon, $end) {
        $this->oRepoGooglePosicao->inserirGoogleEndereco($lat, $lon, $end);
    }

}

?>