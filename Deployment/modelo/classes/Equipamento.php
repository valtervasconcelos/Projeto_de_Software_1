<?php
/**
 * Descrição da Equipamento
 *
 * @Autor Valter Vasconcelos 02/08/2012
 */
class Equipamento {
    
    private $equip_id;
    private $equipt_id;
    private $chip_id;
    private $equip_serial;
    private $equip_imei;
    private $equip_dtcp;
    private $equip_dtca;
    private $equip_dtre;
    private $equip_obs;    
        
    //construtor
    public  function Equipamento() {
        
    }
    
    public function getEquip_id() {
        return $this->equip_id;
    }

    public function setEquip_id($equip_id) {
        $this->equip_id = $equip_id;
    }

    public function getEquipt_id() {
        return $this->equipt_id;
    }

    public function setEquipt_id($equipt_id) {
        $this->equipt_id = $equipt_id;
    }

    public function getChip_id() {
        return $this->chip_id;
    }

    public function setChip_id($chip_id) {
        $this->chip_id = $chip_id;
    }

    public function getEquip_serial() {
        return $this->equip_serial;
    }

    public function setEquip_serial($equip_serial) {
        $this->equip_serial = $equip_serial;
    }

    public function getEquip_imei() {
        return $this->equip_imei;
    }

    public function setEquip_imei($equip_imei) {
        $this->equip_imei = $equip_imei;
    }

    public function getEquip_dtcp() {
        return $this->equip_dtcp;
    }

    public function setEquip_dtcp($equip_dtcp) {
        $this->equip_dtcp = $equip_dtcp;
    }

    public function getEquip_dtca() {
        return $this->equip_dtca;
    }

    public function setEquip_dtca($equip_dtca) {
        $this->equip_dtca = $equip_dtca;
    }

    public function getEquip_dtre() {
        return $this->equip_dtre;
    }

    public function setEquip_dtre($equip_dtre) {
        $this->equip_dtre = $equip_dtre;
    }

    public function getEquip_obs() {
        return $this->equip_obs;
    }

    public function setEquip_obs($equip_obs) {
        $this->equip_obs = $equip_obs;
    }  
            
}

?>