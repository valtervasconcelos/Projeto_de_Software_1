<?php
/**
 * Descrição da Bloqueio
 *
 * @Autor Valter Vasconcelos 04/07/2012
 * 
 */
class AcessoSistema {
    public $clientes;
    
    function AcessoSistema(){
        $this->carregaClientesLiberados();
    }
    
    protected function carregaClientesLiberados(){        
        $this->clientes = array("cliente"=>array(
                                                array("nome"=>"demo","title"=>"S-Track DEMO","esquema"=>"demo2","permissao"=>"true"),
                                                array("nome"=>"public","title"=>"SOLUÇÃO S-Track Public","esquema"=>"public","permissao"=>"true"),
                                                array("nome"=>"strack","title"=>"SOLUÇÃO S-Track","esquema"=>"public","permissao"=>"true"),
                                                array("nome"=>"ctrack","title"=>"SOLUÇÃO C-Track","esquema"=>"ctrack","permissao"=>"true"),
                                                array("nome"=>"redetrack","title"=>"SOLUÇÃO REDE TRACK","esquema"=>"redetrack","permissao"=>"true"),
                                                array("nome"=>"global","title"=>"SOLUÇÃO GLOBAL","esquema"=>"global","permissao"=>"true"),
                                                array("nome"=>"inovasat","title"=>"SOLUÇÃO INOVASAT","esquema"=>"inovasat","permissao"=>"true"),
                                                array("nome"=>"pinguinsat","title"=>"SOLUÇÃO PINGUINSAT","esquema"=>"pinguinsat","permissao"=>"true"),
                                                array("nome"=>"c2sat","title"=>"SOLUÇÃO C2SAT","esquema"=>"c2sat","permissao"=>"true"),
                                                array("nome"=>"projectus","title"=>"SOLUÇÃO PROJECTUS","esquema"=>"projectus","permissao"=>"true"),
                                                array("nome"=>"setta","title"=>"SOLUÇÃO SETTA","esquema"=>"setta","permissao"=>"true"),
                                                array("nome"=>"pyxis","title"=>"SOLUÇÃO PYXIS","esquema"=>"pyxis","permissao"=>"true"),
                                                array("nome"=>"shock","title"=>"SOLUÇÃO SHOCK","esquema"=>"shock","permissao"=>"true"),
                                                array("nome"=>"keeper","title"=>"SOLUÇÃO KEEPER","esquema"=>"keeper","permissao"=>"true"),
                                                array("nome"=>"connect","title"=>"SOLUÇÃO CONNECT","esquema"=>"connect","permissao"=>"true"),
                                                array("nome"=>"digital","title"=>"SOLUÇÃO DIGITAL","esquema"=>"digital","permissao"=>"true"),
                                                array("nome"=>"bbc","title"=>"SOLUÇÃO BBC","esquema"=>"bbc","permissao"=>"true"),
                                                array("nome"=>"srs","title"=>"SOLUÇÃO RASTREIO SOLUTIONS","esquema"=>"srs","permissao"=>"true")));
    }
}

?>