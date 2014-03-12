<?php
/**
 * Descrição da Equipamento
 *
 * @Autor Valter Vasconcelos 02/08/2012
 */
class Equipamento {
    
    private $equip_id;
    private $equip_serial;
           
    //construtor
    public  function Equipamento() {
        
    }
    
    public function getEquip_id() {
        return $this->equip_id;
    }

    public function setEquip_id($equip_id) {
        $this->equip_id = $equip_id;
    }

    public function getEquip_serial() {
        return $this->equip_serial;
    }

    public function setEquip_serial($equip_serial) {
        $this->equip_serial = $equip_serial;
    }
  
}

?>