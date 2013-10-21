<?php
/**
 * Descricao da repositorioInstalacao
 *
 * @Autor Valter Vasconcelos 19/07/2012
 *
 */
class repositorioInstalacao {
    private $pdo;

    //Construtor da Classe
    function __construct($pdo) {
        $this->pdo = $pdo;
    }
    
    public function inserir($oInstalacao){        
        $sql = 
            "INSERT INTO ".ESQUEMA.".instalacao(
                inst_dsc,
                cli_id,
                equip_id,
                veic_id,
                --carr_id,
                moto_id,
                maxpor_id,
                gr_id,
                --inst_valor,
                inst_teclado,
                inst_senhavoz,
                inst_pergunta,
                inst_resposta,
                inst_coasao,
                inst_dtin,
                inst_obs,
                inst_qacc,
                inst_qsn,
                inst_qpid,
                inst_valinst,
                inst_valmen,
                inst_qenv,
                inst_manut,
                inst_odom,
                inst_offset
            )values(
                '{$oInstalacao->getInst_dsc()}',
                '{$oInstalacao->getCli_id()}',
                '{$oInstalacao->getEquip_id()}',
                '{$oInstalacao->getVeic_id()}',
                --'{$oInstalacao->getCarr_id()}',
                ".($oInstalacao->getMoto_id()=="" ? 'NULL' : $oInstalacao->getMoto_id()).",
                ".($oInstalacao->getMaxpor_id()=="" ? 'NULL' : $oInstalacao->getMaxpor_id()).",
                ".($oInstalacao->getGr_id()=="" ? 'NULL' : $oInstalacao->getGr_id()).",
                --'{$oInstalacao->getInst_valor()}',
                ".($oInstalacao->getInst_teclado()=="" ? 'NULL' : $oInstalacao->getInst_teclado()).",
                '{$oInstalacao->getInst_senhavoz()}',
                '{$oInstalacao->getInst_pergunta()}',
                '{$oInstalacao->getInst_resposta()}',
                '{$oInstalacao->getInst_coasao()}',
                ".($oInstalacao->getInst_dtin()=="" ? 'NULL' : "'".$oInstalacao->getInst_dtin()."'").",
                '{$oInstalacao->getInst_obs()}',
                '{$oInstalacao->getInst_qacc()}',
                '{$oInstalacao->getInst_qsn()}',
                '{$oInstalacao->getInst_qpid()}',
                ".($oInstalacao->getInst_valinst()=="" ? 'NULL' : $oInstalacao->getInst_valinst()).",
                ".($oInstalacao->getInst_valmen()=="" ? 'NULL' : $oInstalacao->getInst_valmen()).",
                ".($oInstalacao->getInst_qenv()=="" ? 'NULL' : $oInstalacao->getInst_qenv()).",
                ".($oInstalacao->getInst_manut()=="" ? 'NULL' : $oInstalacao->getInst_manut()).",
                ".($oInstalacao->getInst_odom()=="" ? 'NULL' : $oInstalacao->getInst_odom()).",
                ".($oInstalacao->getInst_offset()=="" ? 'NULL' : $oInstalacao->getInst_offset())."
            )";

        $stmt = $this->pdo->prepare($sql);
	$stmt->execute();	
        return $this->pdo->lastInsertId();
    }
    
    public function alterar($oInstalacao, $tipo){
        if ($tipo == "jsonEnviarComando"){
            $sql = 
                "UPDATE ".ESQUEMA.".instalacao ".
                "SET inst_qenv = '{$oInstalacao->getInst_qenv()}' ".
                "WHERE (inst_id = '{$oInstalacao->getInst_id()}');";
        }elseif ($tipo == "suntech_envio") {
            $sql = 
                "UPDATE ".ESQUEMA.".instalacao 
                SET inst_odom = '{$oInstalacao->getInst_odom()}' 
                WHERE (inst_id = '{$oInstalacao->getInst_id()}');";
            
        }else{
            $moto_id = ($oInstalacao->getMoto_id() == '' ? 'NULL' : $oInstalacao->getMoto_id());
            $maxpor_id = ($oInstalacao->getMaxpor_id() == '' ? 'NULL' : $oInstalacao->getMaxpor_id());
            $valorinst = ($oInstalacao->getInst_valinst() == '' ? 'NULL' : $oInstalacao->getInst_valinst());
            $valormens = ($oInstalacao->getInst_valmen() == '' ? 'NULL' : $oInstalacao->getInst_valmen());            
            
            $sql = 
                "UPDATE ".ESQUEMA.".instalacao SET
                    inst_dsc = '{$oInstalacao->getInst_dsc()}',
                    equip_id = '{$oInstalacao->getEquip_id()}', 
                    veic_id = '{$oInstalacao->getVeic_id()}', 
                    moto_id = {$moto_id},
                    maxpor_id = {$maxpor_id},
                    inst_senhavoz = '{$oInstalacao->getInst_senhavoz()}',
                    inst_pergunta = '{$oInstalacao->getInst_pergunta()}', 
                    inst_resposta = '{$oInstalacao->getInst_resposta()}', 
                    inst_coasao = '{$oInstalacao->getInst_coasao()}', 
                    inst_obs = '{$oInstalacao->getInst_obs()}', 
                    inst_valinst = {$valorinst},
                    inst_valmen = {$valormens}

                WHERE
                    inst_id = {$oInstalacao->getInst_id()}";                        
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }
    
    public function remover($id){
        /*Verificar todas as dependências da instalação e deleta-las!!!*/
        $dHoje	= date("Y-m-d");
        
        $sql = "UPDATE ".ESQUEMA.".instalacao SET inst_dtre = '{$dHoje}' WHERE (inst_id = {$id}); ";
        $stmt = $this->pdo->prepare($sql);
	$stmt->execute();

        return true;
    }
    
    public function listar($cli_id){
        if ($cli_id != "0"){
            $s_cli_fuso = $_SESSION[SESSAOEMPRESA]['cli_fuso'];

            $sql =
                "SELECT i.inst_id, to_char(i.inst_dtin, 'dd/mm/yyyy') AS inst_dtin_f, i.inst_dsc, v.veic_placa, e.equip_serial, ".
                "	m.moto_dsc, gr.cli_dsc AS gr_dsc, ".
                "	CASE et.equipt_forn ".
                "		WHEN 'MAXTRACK' THEN to_char(mpu.maxpo_dthr + interval '{$s_cli_fuso}h', 'dd/mm/yy hh24:mi:ss') ".
                "		WHEN 'ZENITE' THEN to_char(zpu.zenpo_dthr + interval '{$s_cli_fuso}h', 'dd/mm/yy hh24:mi:ss') ".
                "		WHEN 'QUANTA' THEN to_char(qpu.quapo_dthr + interval '{$s_cli_fuso}h', 'dd/mm/yy hh24:mi:ss') ".
                "		WHEN 'CONTINENTAL' THEN to_char(cpu.conpo_dthr + interval '{$s_cli_fuso}h', 'dd/mm/yy hh24:mi:ss') ".
                "		WHEN 'SUNTECH' THEN to_char(spu.sunpo_dthr + interval '{$s_cli_fuso}h', 'dd/mm/yy hh24:mi:ss') ".
                "		WHEN 'SONABYTE' THEN to_char(rpu.rstpo_dthr + interval '{$s_cli_fuso}h', 'dd/mm/yy hh24:mi:ss') ".
                "	END AS dthrl ".
                "FROM ".ESQUEMA.".instalacao i ".
                "LEFT JOIN ".ESQUEMA.".veiculo v ON (v.veic_id = i.veic_id AND v.veic_dtre IS NULL) ".
                "LEFT JOIN ".ESQUEMA.".equipamento e ON (e.equip_id = i.equip_id AND e.equip_dtre IS NULL) ".
                "LEFT JOIN ".ESQUEMA.".equipamento_tipo et ON (et.equipt_id = e.equipt_id) ".
                "LEFT JOIN ".ESQUEMA.".motorista m ON (m.moto_id = i.moto_id AND m.moto_dtre IS NULL) ".
                "LEFT JOIN ".ESQUEMA.".maxtrack_posic_ult mpu ON (mpu.inst_id = i.inst_id) ".
                "LEFT JOIN ".ESQUEMA.".zenite_posic_ult zpu ON (zpu.inst_id = i.inst_id) ".
                "LEFT JOIN ".ESQUEMA.".quanta_posic_ult qpu ON (qpu.inst_id = i.inst_id) ".
                "LEFT JOIN ".ESQUEMA.".continental_posic_ult cpu ON (cpu.inst_id = i.inst_id) ".
                "LEFT JOIN ".ESQUEMA.".suntech_posic_ult spu ON (spu.inst_id = i.inst_id) ".
                "LEFT JOIN ".ESQUEMA.".rstvt_posic_ult rpu ON (rpu.inst_id = i.inst_id) ".
                "LEFT JOIN ".ESQUEMA.".veiculo_icone vi ON vi.veicic_id = v.veicic_id ".
                "LEFT JOIN ".ESQUEMA.".cliente gr ON (gr.cli_id = i.gr_id AND gr.cli_dtre IS NULL) ".
                "WHERE (i.inst_dtre IS NULL) AND (i.cli_id = '{$cli_id}') ".
                "ORDER BY i.inst_dsc;";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $results;
        }else
            return NULL;
    }
    
    public function listarPorId($id){
        $sNivelUsuario = $_SESSION[SESSAOEMPRESA]['usrt_dsc'];
        $sql =
            "SELECT DISTINCT 
                inst_id,
                inst_dsc,
                cli_id,
                equip_id,
                veic_id,
                --carr_id,
                moto_id,
                maxpor_id,
                gr_id,
                --inst_valor,
                inst_teclado,
                inst_senhavoz,
                inst_pergunta,
                inst_resposta,
                inst_coasao,
                to_char(inst_dtin, 'dd/mm/yyyy') AS inst_dtin,
                inst_obs,
                inst_qacc,
                inst_qsn,
                inst_qpid,
                --inst_valinst,
                --inst_valmen,
                to_char(inst_valinst, '999990D99') AS inst_valinst,
                to_char(inst_valmen, '999990D99') AS inst_valmen,
                inst_qenv,
                inst_manut,
                inst_odom,
                inst_offset
            
            FROM ".ESQUEMA.".instalacao
            
            WHERE inst_id = '{$id}' AND (inst_dtre IS NULL) ".($sNivelUsuario == 'USUÁRIO TESTE' ? "AND (inst_id = '1') " : '' ).
            "ORDER BY inst_dsc LIMIT 1;";
            
        $stmt = $this->pdo->prepare($sql);
	$stmt->execute();
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $results;
    }
    
    public function listarJsonEvento(){
        $filtro = 'WHERE (i.inst_dtre IS NULL) '; //-----  inicia a variável filtro

        if (!LIBERACAOGM)
            $filtro .= "AND ((i.cli_id = '{$_SESSION[SESSAOEMPRESA]['cli_id']}') OR (c.cli_mae = '{$_SESSION[SESSAOEMPRESA]['cli_id']}')) ";
            
        $dthr_server	= date('d/m/y H:i:s', strtotime(($_SESSION[SESSAOEMPRESA]['cli_fuso']).' hour'));	// Hora/Data do servidor (-1 porque o servidor Locaweb não consegue consertar a hora corretamente)
            
        $sql = 
        "SELECT DISTINCT
	i.inst_id, i.inst_dsc, c.cli_dsc, i.inst_manut, et.equipt_forn, ic.inst_id as cerca_inst_id, ic.cerc_id, ict.instcert_dsc,
        ir.inst_id as rota_inst_id, ir.rota_id, rt.rota_orig, rt.rota_dest, rt.rota_raio,
	CASE et.equipt_forn
		WHEN 'MAXTRACK' THEN to_char(mpu.maxpo_dthr, 'dd/mm/yy hh24:mi:ss')
		WHEN 'ZENITE' THEN to_char(zpu.zenpo_dthr, 'dd/mm/yy hh24:mi:ss')
		WHEN 'QUANTA' THEN to_char(qpu.quapo_dthr, 'dd/mm/yy hh24:mi:ss')
		WHEN 'CONTINENTAL' THEN to_char(cpu.conpo_dthr, 'dd/mm/yy hh24:mi:ss')
		WHEN 'SUNTECH' THEN to_char(spu.sunpo_dthr, 'dd/mm/yy hh24:mi:ss')
		WHEN 'SONABYTE' THEN to_char(rpu.rstpo_dthr, 'dd/mm/yy hh24:mi:ss')
	END AS dthr,
	CASE et.equipt_forn
		WHEN 'MAXTRACK' THEN to_char(CURRENT_TIMESTAMP AT TIME ZONE 'UTC'-mpu.maxpo_dthr, 'DD HH24:MM:SS')
		WHEN 'ZENITE' THEN to_char(CURRENT_TIMESTAMP AT TIME ZONE 'UTC'-zpu.zenpo_dthr, 'DD HH24:MM:SS')
		WHEN 'QUANTA' THEN to_char(CURRENT_TIMESTAMP AT TIME ZONE 'UTC'-qpu.quapo_dthr, 'DD HH24:MM:SS')
		WHEN 'CONTINENTAL' THEN to_char(CURRENT_TIMESTAMP AT TIME ZONE 'UTC'-cpu.conpo_dthr, 'DD HH24:MM:SS')
		WHEN 'SUNTECH' THEN to_char(CURRENT_TIMESTAMP AT TIME ZONE 'UTC'-spu.sunpo_dthr, 'DD HH24:MM:SS')
		WHEN 'SONABYTE' THEN to_char(CURRENT_TIMESTAMP AT TIME ZONE 'UTC'-rpu.rstpo_dthr, 'DD HH24:MM:SS')
	END AS dthr_dif,
	CASE et.equipt_forn
		WHEN 'MAXTRACK' THEN mpu.maxpo_lat
		WHEN 'ZENITE' THEN zpu.zenpo_lat
		WHEN 'QUANTA' THEN qpu.quapo_lat
		WHEN 'CONTINENTAL' THEN cpu.conpo_lat
		WHEN 'SUNTECH' THEN spu.sunpo_lat
		WHEN 'SONABYTE' THEN rpu.rstpo_lat
	END AS lat,
	CASE et.equipt_forn
		WHEN 'MAXTRACK' THEN mpu.maxpo_lon
		WHEN 'ZENITE' THEN zpu.zenpo_lon
		WHEN 'QUANTA' THEN qpu.quapo_lon
		WHEN 'CONTINENTAL' THEN cpu.conpo_lon
		WHEN 'SUNTECH' THEN spu.sunpo_lon
		WHEN 'SONABYTE' THEN rpu.rstpo_lon
	END AS lon,
	CASE et.equipt_forn
		WHEN 'MAXTRACK' THEN mpu.maxpo_alert::int
/*		WHEN 'ZENITE' THEN zpu.zenpo_lon								*/
/*		WHEN 'QUANTA' THEN qpu.quapo_lon								*/
		WHEN 'CONTINENTAL' THEN (cpu.conpo_volt < 7)::boolean::int
		WHEN 'SUNTECH' THEN (spu.sunpo_pwr < 7)::boolean::int
		WHEN 'SONABYTE' THEN rpu.rstpo_ent04::int
	END AS alerta,
	CASE et.equipt_forn
		WHEN 'MAXTRACK' THEN mpu.maxpo_ign::int
		WHEN 'ZENITE' THEN ".(ESQUEMA == 'ciclopecas' ? "substr(zpu.zenpo_entr::int::bit(8)::varchar, 6, 1)::int " : "substr(zpu.zenpo_entr::int::bit(8)::varchar, 7, 1)::int ").
		"WHEN 'QUANTA' THEN qpu.quapo_ign::int
		WHEN 'CONTINENTAL' THEN substr(cpu.conpo_statusin::bit(16)::varchar, 16, 1)::int
		WHEN 'SUNTECH' THEN spu.sunpo_ign::int
		WHEN 'SONABYTE' THEN rpu.rstpo_ent07::int
	END AS ignicao,
	CASE et.equipt_forn
		WHEN 'MAXTRACK' THEN mpu.maxpo_vel::int
		WHEN 'ZENITE' THEN zpu.zenpo_vel::int
		WHEN 'QUANTA' THEN qpu.quapo_vel::int
		WHEN 'CONTINENTAL' THEN cpu.conpo_vel::int
		WHEN 'SUNTECH' THEN spu.sunpo_spd::int	
		WHEN 'SONABYTE' THEN rpu.rstpo_vel::int
	END AS vel,
	CASE et.equipt_forn
		WHEN 'MAXTRACK' THEN mpu.maxpo_out1::int
		WHEN 'ZENITE' THEN 0::int
		WHEN 'QUANTA' THEN qpu.quapo_block::int
		WHEN 'CONTINENTAL' THEN substr(cpu.conpo_statusout::bit(8)::varchar, 8, 1)::int
	 	WHEN 'SUNTECH' THEN spu.sunpo_out1::int
		WHEN 'SONABYTE' THEN rpu.rstpo_sai00::int
	END AS bloqueio,
	CASE et.equipt_forn
		WHEN 'MAXTRACK' THEN mpu.maxpo_out3::int
		WHEN 'ZENITE' THEN 0::int
		WHEN 'QUANTA' THEN qpu.quapo_buz::boolean::int
		WHEN 'CONTINENTAL' THEN substr(cpu.conpo_statusout::bit(8)::varchar, 7, 1)::int
		WHEN 'SUNTECH' THEN spu.sunpo_out2::int
		WHEN 'SONABYTE' THEN rpu.rstpo_sai02::int
	END AS sirene,
	CASE et.equipt_forn
		WHEN 'MAXTRACK' THEN mpu.maxpou_jsos
		WHEN 'ZENITE' THEN zpu.zenpou_jsos
		WHEN 'QUANTA' THEN qpu.quapou_jsos
		WHEN 'CONTINENTAL' THEN cpu.conpou_jsos
		WHEN 'SUNTECH' THEN spu.sunpou_jsos
		WHEN 'SONABYTE' THEN rpu.rstpou_jsos
	END AS jsos,	
	CASE et.equipt_forn
		WHEN 'MAXTRACK' THEN mpu.maxpo_in1::int
		WHEN 'SUNTECH' THEN spu.sunpo_in1::int
		WHEN 'SONABYTE' THEN rpu.rstpo_ent01::int
	END AS in1,
	CASE et.equipt_forn
		WHEN 'MAXTRACK' THEN mpu.maxpo_in2::int
		WHEN 'CONTINENTAL' THEN substr(cpu.conpo_statusin::bit(16)::varchar, 13, 1)::int
		WHEN 'SUNTECH' THEN spu.sunpo_in2::int
		WHEN 'SONABYTE' THEN rpu.rstpo_ent02::int
	END AS in2,
	CASE et.equipt_forn
		WHEN 'MAXTRACK' THEN mpu.maxpo_in3::int
		WHEN 'CONTINENTAL' THEN substr(cpu.conpo_statusin::bit(16)::varchar, 7, 1)::int
		WHEN 'SUNTECH' THEN spu.sunpo_in3::int
		WHEN 'SONABYTE' THEN rpu.rstpo_ent03::int
	END AS in3,
	CASE et.equipt_forn
		WHEN 'MAXTRACK' THEN mpu.maxpo_in4::int
		WHEN 'CONTINENTAL' THEN substr(cpu.conpo_statusin::bit(16)::varchar, 5, 1)::int
/*		WHEN 'SUNTECH' THEN spu.sunpo_in3::int							*/
		WHEN 'SONABYTE' THEN rpu.rstpo_ent04::int
	END AS in4,
	CASE et.equipt_forn
		WHEN 'MAXTRACK' THEN mpu.maxpo_in5::int
		WHEN 'SUNTECH' THEN
			CASE mp.maxpor_in2 
				WHEN 'SENSOR COMBUSTIVEL' THEN
					CASE spu.sunpo_in2::int
						WHEN 0 THEN 1
						WHEN 1 THEN 0
					END
				ELSE spu.sunpo_in2::int
			END
	END AS in5,
	CASE et.equipt_forn
		WHEN 'MAXTRACK' THEN mpu.maxpo_out1::int
		WHEN 'SUNTECH' THEN spu.sunpo_out1::int
		WHEN 'SONABYTE' THEN rpu.rstpo_sai01::int
	END AS out1,
	CASE et.equipt_forn
		WHEN 'MAXTRACK' THEN mpu.maxpo_out2::int
		WHEN 'SUNTECH' THEN spu.sunpo_out2::int
		WHEN 'SONABYTE' THEN rpu.rstpo_sai02::int
	END AS out2,
	CASE et.equipt_forn
		WHEN 'MAXTRACK' THEN mpu.maxpo_out3::int
/*		WHEN 'SUNTECH' THEN spu.sunpo_out3::int							*/
		WHEN 'SONABYTE' THEN rpu.rstpo_sai03::int
	END AS out3,
	CASE et.equipt_forn
		WHEN 'MAXTRACK' THEN mpu.maxpo_out4::int
/*		WHEN 'SUNTECH' THEN spu.sunpo_out4::int							*/
		WHEN 'SONABYTE' THEN rpu.rstpo_sai04::int
	END AS out4
	FROM ".ESQUEMA.".instalacao i
	INNER JOIN ".ESQUEMA.".equipamento e ON e.equip_id = i.equip_id AND e.equip_dtre IS NULL
	LEFT JOIN ".ESQUEMA.".maxtrack_porta mp ON mp.maxpor_id = i.maxpor_id
	INNER JOIN ".ESQUEMA.".equipamento_tipo et ON et.equipt_id = e.equipt_id
	INNER JOIN ".ESQUEMA.".chip_gsm cg ON cg.chip_id = e.chip_id AND cg.chip_dtre IS NULL
	INNER JOIN ".ESQUEMA.".cliente c ON c.cli_id = i.cli_id AND c.cli_dtre IS NULL
	INNER JOIN ".ESQUEMA.".veiculo v ON v.veic_id = i.veic_id AND v.veic_dtre IS NULL
	INNER JOIN ".ESQUEMA.".veiculo_cor vc ON vc.veicor_id = v.veicor_id
	INNER JOIN ".ESQUEMA.".veiculo_marca vma ON vma.veicma_id = v.veicma_id
	INNER JOIN ".ESQUEMA.".veiculo_modelo vmo ON vmo.veicmo_id = v.veicmo_id
	INNER JOIN ".ESQUEMA.".veiculo_icone vi ON vi.veicic_id = v.veicic_id
	INNER JOIN ".ESQUEMA.".usuario u ON u.cli_id = c.cli_id AND u.usr_dtre IS NULL
	INNER JOIN ".ESQUEMA.".usuario_tipo ut ON ut.usrt_id = u.usrt_id
	LEFT JOIN ".ESQUEMA.".motorista m ON m.moto_id = i.moto_id AND m.moto_dtre IS NULL
	LEFT JOIN ".ESQUEMA.".cliente gr ON gr.cli_id = i.gr_id AND gr.cli_dtre IS NULL
	LEFT JOIN ".ESQUEMA.".maxtrack_posic_ult mpu ON mpu.inst_id = i.inst_id
	LEFT JOIN ".ESQUEMA.".zenite_posic_ult zpu ON zpu.inst_id = i.inst_id
	LEFT JOIN ".ESQUEMA.".quanta_posic_ult qpu ON qpu.inst_id = i.inst_id
	LEFT JOIN ".ESQUEMA.".continental_posic_ult cpu ON cpu.inst_id = i.inst_id
	LEFT JOIN ".ESQUEMA.".suntech_posic_ult spu ON spu.inst_id = i.inst_id
	LEFT JOIN ".ESQUEMA.".rstvt_posic_ult rpu ON rpu.inst_id = i.inst_id
        LEFT JOIN ".ESQUEMA.".instalacao_cerca ic on ic.inst_id = i.inst_id AND ('{$dthr_server}' BETWEEN ic.instcer_dtini AND ic.instcer_dtfim) AND (ic.instcer_dtre IS NULL)
        LEFT JOIN ".ESQUEMA.".instalacao_cerca_tipo ict ON ict.instcert_id = ic.instcert_id
        LEFT JOIN ".ESQUEMA.".instalacao_rota ir on ir.inst_id = i.inst_id AND ('{$dthr_server}' BETWEEN ir.instrota_ini AND ir.instrota_fim) AND (ir.instrota_dtre IS NULL)
        LEFT JOIN ".ESQUEMA.".rota rt on rt.rota_id = ir.rota_id
	{$filtro}
	ORDER BY c.cli_dsc, i.inst_dsc;";

        $stmt = $this->pdo->prepare($sql);
	$stmt->execute();
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $results;
    }
    
    public function listarJsonGridInferior($aParams){
        ini_set("max_execution_time", 3600);
        
        $fuso	= "{$_SESSION[SESSAOEMPRESA]['cli_fuso']}h";  //-----  Fuso horário que o cliente está utilizando
        $filtro = 'WHERE (i.inst_dtre IS NULL) ';             //-----  Filtra as instalações não deletadas

        if (!LIBERACAOGM)  //-----  Liberar as instalações para o cliente e cliente mãe
            $filtro .= "AND ((i.cli_id = {$_SESSION[SESSAOEMPRESA]['cli_id']}) OR (c.cli_mae = {$_SESSION[SESSAOEMPRESA]['cli_id']})) ";

        if ($aParams['cli_id'] != '' && $aParams['cli_id'] != 'null')  //-----  Somente o cliente do filtro
            $filtro .= "AND (i.cli_id = {$aParams['cli_id']}) ";

        if ($aParams['inst_id'] != '' && $aParams['inst_id'] != 'null')  //-----  Somente a instalação
            $filtro .= "AND (i.inst_id = {$aParams['inst_id']}) ";

        if ($aParams['inst_dsc'] != '' && $aParams['inst_dsc'] != 'null')	  //-----  Descrição da instalação
            $filtro .= "AND (i.inst_dsc like \'%{$aParams['inst_dsc']}%\') ";

        if ($aParams['equip_serial'] != '' && $aParams['equip_serial'] != 'null')  //-----  Serial do equipamento
            $filtro .= "AND (e.equip_serial like \'%{$aParams['equip_serial']}%\') ";
            
        //$newIDS = substr($aParams['ids'], 0, strlen($aParams['ids'])-1);
        if (substr($aParams['ids'], -1) == '|')
            $aParams['ids'] = substr($aParams['ids'], 0, strlen($aParams['ids'])-1);

        if ($aParams['ids'] != '')	  //-----  Recebe parametros dos eventos
            $filtro .= "AND (i.inst_id IN (".str_replace('|', ", ", $aParams['ids']).")) ";

        $filtro = str_replace(", ''", '', $filtro);
        
        $sql = "SELECT * FROM listarVeiculoGrid('".ESQUEMA."','".$filtro."','".$fuso."')";

        $stmt = $this->pdo->prepare($sql);
	$stmt->execute();
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $results;
    }
    
    public function listarJsonGridMapa($aParams){
        if($aParams['tipo'] == 1){
            $dias    = $aParams['dias'];
            
            $sql = 
            "SELECT c.cli_id,c.cli_dsc, m.moto_dsc, m.moto_cel, 
            v.veic_placa, v.veic_ano, v.veic_chassi, v.veic_renavam, 
            vma.veicma_dsc, vmo.veicmo_dsc, vc.veicor_dsc, 
            et.equipt_forn,
            CASE et.equipt_forn 
                    WHEN 'MAXTRACK'    THEN to_char(mpu.maxpo_dthr, 'yyyy-mm-dd')
                    WHEN 'ZENITE'      THEN to_char(zpu.zenpo_dthr, 'yyyy-mm-dd')
                    WHEN 'QUANTA'      THEN to_char(qpu.quapo_dthr, 'yyyy-mm-dd')
                    WHEN 'CONTINENTAL' THEN to_char(cpu.conpo_dthr, 'yyyy-mm-dd')
                    WHEN 'SUNTECH'     THEN to_char(spu.sunpo_dthr, 'yyyy-mm-dd')
                    WHEN 'SONABYTE'    THEN to_char(rpu.rstpo_dthr, 'yyyy-mm-dd')
            END AS dthr_fim,
            CASE et.equipt_forn 
                    WHEN 'MAXTRACK'    THEN to_char(mpu.maxpo_dthr - interval '{$dias} days', 'yyyy-mm-dd') 
                    WHEN 'ZENITE'      THEN to_char(zpu.zenpo_dthr - interval '{$dias} days', 'yyyy-mm-dd') 
                    WHEN 'QUANTA'      THEN to_char(qpu.quapo_dthr - interval '{$dias} days', 'yyyy-mm-dd') 
                    WHEN 'CONTINENTAL' THEN to_char(cpu.conpo_dthr - interval '{$dias} days', 'yyyy-mm-dd') 
                    WHEN 'SUNTECH'     THEN to_char(spu.sunpo_dthr - interval '{$dias} days', 'yyyy-mm-dd') 
                    WHEN 'SONABYTE'    THEN to_char(rpu.rstpo_dthr - interval '{$dias} days', 'yyyy-mm-dd')
            END AS dthr_ini 
            FROM ".ESQUEMA.".instalacao i 
            LEFT JOIN ".ESQUEMA.".cliente c ON c.cli_id = i.cli_id AND c.cli_dtre IS NULL 
            LEFT JOIN ".ESQUEMA.".motorista m ON m.moto_id = i.moto_id AND m.moto_dtre IS NULL 
            LEFT JOIN ".ESQUEMA.".veiculo v ON v.veic_id = i.veic_id AND v.veic_dtre IS NULL 
            LEFT JOIN ".ESQUEMA.".equipamento e ON e.equip_id = i.equip_id AND e.equip_dtre IS NULL 
            LEFT JOIN ".ESQUEMA.".equipamento_tipo et ON et.equipt_id = e.equipt_id 
            LEFT JOIN ".ESQUEMA.".veiculo_icone vi ON vi.veicic_id = v.veicic_id 
            LEFT JOIN ".ESQUEMA.".veiculo_marca vma ON vma.veicma_id = v.veicma_id 
            LEFT JOIN ".ESQUEMA.".veiculo_modelo vmo ON vmo.veicmo_id = v.veicmo_id 
            LEFT JOIN ".ESQUEMA.".veiculo_cor vc ON vc.veicor_id = v.veicor_id 
            LEFT JOIN ".ESQUEMA.".maxtrack_posic_ult mpu ON mpu.inst_id = i.inst_id 
            LEFT JOIN ".ESQUEMA.".zenite_posic_ult zpu ON zpu.inst_id = i.inst_id 
            LEFT JOIN ".ESQUEMA.".quanta_posic_ult qpu ON qpu.inst_id = i.inst_id 
            LEFT JOIN ".ESQUEMA.".continental_posic_ult cpu ON cpu.inst_id = i.inst_id 
            LEFT JOIN ".ESQUEMA.".suntech_posic_ult spu ON spu.inst_id = i.inst_id
            LEFT JOIN ".ESQUEMA.".rstvt_posic_ult rpu ON rpu.inst_id = i.inst_id
            WHERE (i.inst_id = '{$aParams['inst_id']}');";

        }elseif($aParams['tipo'] == 2){
            //-----  Filtro
            $filtro	= '';
            $limitador	= '';
            $cli_fuso	= "{$_SESSION[SESSAOEMPRESA]['cli_fuso']}h";

            if ($aParams['dthr_ini'] == '' || $aParams['dthr_fim'] == ''){
                $dthr_hoje_ini = $aParams['qrydthr_ini'].' 00:00:00';
                $dthr_hoje_fim = $aParams['qrydthr_fim'].' 23:59:59';

                switch ($aParams['equipt_forn']){
                    case 'MAXTRACK':{
                        $filtro		= "mp.inst_id = {$aParams['inst_id']}::bigint AND mp.maxpo_dthr >= '{$dthr_hoje_ini}'::timestamp - interval '{$cli_fuso}' AND mp.maxpo_dthr <= '{$dthr_hoje_fim}'::timestamp - interval '{$cli_fuso}'";
                        break;
                    }
                    case 'ZENITE':{
                        $filtro		= "zp.inst_id = {$aParams['inst_id']}::bigint AND zp.zenpo_dthr >= '{$dthr_hoje_ini}'::timestamp - interval '{$cli_fuso}' AND zp.zenpo_dthr <= '{$dthr_hoje_fim}'::timestamp - interval '{$cli_fuso}'";
                        break;
                    }
                    case 'QUANTA':{
                        $filtro		= "qp.inst_id = {$aParams['inst_id']}::bigint AND qp.quapo_dthr >= '{$dthr_hoje_ini}'::timestamp - interval '{$cli_fuso}' AND qp.quapo_dthr <= '{$dthr_hoje_fim}'::timestamp - interval '{$cli_fuso}'";
                        break;
                    }
                    case 'CONTINENTAL':{
                        $filtro		= "cp.inst_id = {$aParams['inst_id']}::bigint AND cp.conpo_dthr >= '{$dthr_hoje_ini}'::timestamp - interval '{$cli_fuso}' AND cp.conpo_dthr <= '{$dthr_hoje_fim}'::timestamp - interval '{$cli_fuso}'";
                        break;
                    }
                    case 'SUNTECH':{
                        $filtro		= "sp.inst_id = {$aParams['inst_id']}::bigint AND sp.sunpo_dthr >= '{$dthr_hoje_ini}'::timestamp - interval '{$cli_fuso}' AND sp.sunpo_dthr <= '{$dthr_hoje_fim}'::timestamp - interval '{$cli_fuso}'";
                        break;
                    }
                    case 'SONABYTE':{
                        $filtro		= "rp.inst_id = {$aParams['inst_id']}::bigint AND rp.rstpo_dthr >= '{$dthr_hoje_ini}'::timestamp - interval '{$cli_fuso}' AND rp.rstpo_dthr <= '{$dthr_hoje_fim}'::timestamp - interval '{$cli_fuso}'";
                        break;
                    }
                }

                $limitador	= "LIMIT {$aParams['ultpo_qt']}";
            }else{
                switch ($aParams['equipt_forn']){
                    case 'MAXTRACK':{
                        $filtro		= "mp.inst_id = {$aParams['inst_id']}::bigint AND mp.maxpo_dthr >= '{$aParams['dthr_ini']}'::timestamp - interval '{$cli_fuso}' AND mp.maxpo_dthr <= '{$aParams['dthr_fim']}'::timestamp - interval '{$cli_fuso}'";
                        break;
                    }
                    case 'ZENITE':{
                        $filtro		= "zp.inst_id = {$aParams['inst_id']}::bigint AND zp.zenpo_dthr >= '{$aParams['dthr_ini']}'::timestamp - interval '{$cli_fuso}' AND zp.zenpo_dthr <= '{$aParams['dthr_fim']}'::timestamp - interval '{$cli_fuso}'";
                        break;
                    }
                    case 'QUANTA':{
                        $filtro		= "qp.inst_id = {$aParams['inst_id']}::bigint AND qp.quapo_dthr >= '{$aParams['dthr_ini']}'::timestamp - interval '{$cli_fuso}' AND qp.quapo_dthr <= '{$aParams['dthr_fim']}'::timestamp - interval '{$cli_fuso}'";
                        break;
                    }
                    case 'CONTINENTAL':{
                        $filtro		= "cp.inst_id = {$aParams['inst_id']}::bigint AND cp.conpo_dthr >= '{$aParams['dthr_ini']}'::timestamp - interval '{$cli_fuso}' AND cp.conpo_dthr <= '{$aParams['dthr_fim']}'::timestamp - interval '{$cli_fuso}'";
                        break;
                    }
                    case 'SUNTECH':{
                        $filtro		= "sp.inst_id = {$aParams['inst_id']}::bigint AND sp.sunpo_dthr >= '{$aParams['dthr_ini']}'::timestamp - interval '{$cli_fuso}' AND sp.sunpo_dthr <= '{$aParams['dthr_fim']}'::timestamp - interval '{$cli_fuso}'";
                        break;
                    }
                    case 'SONABYTE':{
                        $filtro		= "rp.inst_id = {$aParams['inst_id']}::bigint AND rp.rstpo_dthr >= '{$aParams['dthr_ini']}'::timestamp - interval '{$cli_fuso}' AND rp.rstpo_dthr <= '{$aParams['dthr_fim']}'::timestamp - interval '{$cli_fuso}'";
                        break;
                    }
                }
            }

            //-----  Filtro de VELOCIDADE, de GPRS e de IGNIÇÃO
            //-----  Query das posições da instalação
            $sql = '';

            switch ($aParams['equipt_forn']){
                case 'MAXTRACK':{
                    if (($aParams['velocidade_min'] != '0')||($aParams['velocidade_max'] != '300'))
                        $filtro .= "AND (mp.maxpo_vel::int BETWEEN {$aParams['velocidade_min']} AND {$aParams['velocidade_max']}) ";

                    if ($aParams['gprs'] == 'L')
                        $filtro .= "AND (mp.maxpo_gprs = '1') ";
                    elseif ($aParams['gprs'] == 'D')
                        $filtro .= "AND (mp.maxpo_gprs = '0') ";

                    if ($aParams['ignicao'] == 'L')
                        $filtro .= "AND (mp.maxpo_ign = '1') ";
                    elseif ($aParams['ignicao'] == 'D')
                        $filtro .= "AND (mp.maxpo_ign = '0') ";

                    if ($aParams['panico'] == 'L')
                        $filtro .= "AND (mp.maxpo_in1 = '1') ";

                    $sql = "SELECT 
                            to_char(mp.maxpo_dthr + interval '{$cli_fuso}', 'dd/mm/yy hh24:mi:ss') AS dthrl, 
                            mp.maxpo_lon AS lon, mp.maxpo_lat AS lat, mp.maxpo_ign AS ign, 
                            mp.maxpo_vel::int AS vel, mp.maxpo_dir AS dir, mp.maxpo_gps AS gps, 
                            mp.maxpo_gprs AS gprs, mp.maxpo_alert, mp.maxpo_in1 AS sos, mp.maxpo_volt AS volt, 
                            mp.maxpo_in2 AS in2, mp.maxpo_in3 AS in3, mp.maxpo_in4 AS in4, mp.maxpo_in5::int AS in5, 
                            mp.maxpo_out1 AS bloqueio, mp.maxpo_out2 AS out2, mp.maxpo_out3 AS sirene, mp.maxpo_out4 AS out4, 
                            mp.maxpo_velex, mp.maxpo_countavl AS countavl, mp.maxpo_odom/1000 AS odom, mp.maxpo_hour AS hour, 
                            mp.maxpo_temp AS temp, vi.veicic_para, vi.veicic_desl, 
                            vi.veicic_pani, vi.veicic_aler, gp.goop_ender, gp.goop_bairro, gp.goop_cidade, gp.goop_uf, gp.goop_pais, gp.goop_cep
                            FROM ".ESQUEMA.".maxtrack_posic mp 
                            INNER JOIN ".ESQUEMA.".instalacao i ON i.inst_id = mp.inst_id 
                            INNER JOIN ".ESQUEMA.".veiculo v ON v.veic_id = i.veic_id 
                            INNER JOIN ".ESQUEMA.".veiculo_icone vi ON vi.veicic_id = v.veicic_id 
                            LEFT JOIN gerencia.google_posicao gp ON (gp.goop_lat = mp.maxpo_lat::double precision AND gp.goop_lon = mp.maxpo_lon::double precision)
                            WHERE {$filtro}
                            ORDER BY mp.inst_id, mp.maxpo_dthr ".($aParams['ordem'] == 'C' ? 'ASC ' : 'DESC ').
                            "{$limitador};";
                    break;
                }

                case 'ZENITE':{
                    if (($aParams['velocidade_min'] != '0')||($aParams['velocidade_max'] != '300'))
                        $filtro .= "AND (zp.zenpo_vel::int BETWEEN {$aParams['velocidade_min']} AND {$aParams['velocidade_max']}) ";

                    if ($aParams['gprs'] == 'L')
                        $filtro .= "AND (zp.zenpo_gprs = 't') ";
                    elseif ($aParams['gprs'] == 'D')
                        $filtro .= "AND (zp.zenpo_gprs = 'f') ";

                    if ($aParams['ignicao'] == 'L')
                        $filtro .= "AND (zp.zenpo_ign = 't') ";
                    elseif ($aParams['ignicao'] == 'D')
                        $filtro .= "AND (zp.zenpo_ign = 'f') ";

                    //if ($aParams['panico'] == 'L')
                    //  $filtro .= "AND (mp.maxpo_in1 = '1') ";

                    $sql = "SELECT 
                            to_char(zp.zenpo_dthr + interval '{$cli_fuso}', 'dd/mm/yy hh24:mi:ss') AS dthrl, 
                            zp.zenpo_lon AS lon, zp.zenpo_lat AS lat, ".
                            (ESQUEMA == 'ciclopecas' ?	"substr(zp.zenpo_entr::int::bit(8)::varchar, 6, 1)::int " :	"substr(zp.zenpo_entr::int::bit(8)::varchar, 7, 1)::int ").
                            " AS ign, 
                            zp.zenpo_vel::int AS vel, zp.zenpo_dir AS dir, zp.zenpo_gps AS gps, 
                            zp.zenpo_gprs AS gprs, 
                            '0' AS sirene, '0' AS bloqueio, 
                            vi.veicic_para, vi.veicic_desl, vi.veicic_pani, vi.veicic_aler,
                            gp.goop_ender, gp.goop_bairro, gp.goop_cidade, gp.goop_uf, gp.goop_pais, gp.goop_cep
                            FROM ".ESQUEMA.".zenite_posic zp 
                            INNER JOIN ".ESQUEMA.".instalacao i ON i.inst_id = zp.inst_id 
                            INNER JOIN ".ESQUEMA.".veiculo v ON v.veic_id = i.veic_id 
                            INNER JOIN ".ESQUEMA.".veiculo_icone vi ON vi.veicic_id = v.veicic_id 
                            LEFT JOIN gerencia.google_posicao gp ON (gp.goop_lat = zp.zenpo_lat::double precision AND gp.goop_lon = zp.zenpo_lon::double precision)
                            WHERE {$filtro}
                            ORDER BY zp.inst_id, zp.zenpo_dthr ".($aParams['ordem'] == 'C' ? 'ASC ' : 'DESC ').
                            "{$limitador};";
                    break;
                }

                case 'QUANTA':{
                    if (($aParams['velocidade_min'] != '0')||($aParams['velocidade_max'] != '300'))
                        $filtro .= "AND (qp.quapo_vel::int BETWEEN {$aParams['velocidade_min']} AND {$aParams['velocidade_max']}) ";

                    if ($aParams['gprs'] == 'L')
                        $filtro .= "AND (zp.zenpo_gprs = 't') ";
                    elseif ($aParams['gprs'] == 'D')
                        $filtro .= "AND (zp.zenpo_gprs = 'f') ";

                    if ($aParams['ignicao'] == 'L')
                        $filtro .= "AND (qp.quapo_ign = 't') ";
                    elseif ($aParams['ignicao'] == 'D')
                        $filtro .= "AND (qp.quapo_ign = 'f') ";

                    if ($aParams['panico'] == 'L')
                        $filtro .= "AND (qp.quapo_panic::boolean::int = '1') ";

                    $sql = "SELECT 
                            to_char(qp.quapo_dthr + interval '{$cli_fuso}', 'dd/mm/yy hh24:mi:ss') AS dthrl, 
                            qp.quapo_lon AS lon, qp.quapo_lat AS lat, qp.quapo_ign::boolean::int AS ign, 
                            qp.quapo_vel::int AS vel, qp.quapo_dir AS dir, qp.quapo_gpsval AS gps, 
                            qp.quapo_buz::boolean::int AS sirene, qp.quapo_block::boolean::int AS bloqueio, 
                            qp.quapo_panic::boolean::int AS sos, qp.quapo_odom::int AS odom, 
                            vi.veicic_para, vi.veicic_desl, vi.veicic_pani, vi.veicic_aler,
                            gp.goop_ender, gp.goop_bairro, gp.goop_cidade, gp.goop_uf, gp.goop_pais, gp.goop_cep
                            FROM ".ESQUEMA.".quanta_posic qp 
                            INNER JOIN ".ESQUEMA.".instalacao i ON i.inst_id = qp.inst_id 
                            INNER JOIN ".ESQUEMA.".veiculo v ON v.veic_id = i.veic_id 
                            INNER JOIN ".ESQUEMA.".veiculo_icone vi ON vi.veicic_id = v.veicic_id 
                            LEFT JOIN gerencia.google_posicao gp ON (gp.goop_lat = qp.quapo_lat::double precision AND gp.goop_lon = qp.quapo_lon::double precision)
                            WHERE {$filtro}
                            ORDER BY qp.inst_id, qp.quapo_dthr ".($aParams['ordem'] == 'C' ? 'ASC ' : 'DESC ').
                            "{$limitador};";
                    break;
                }

                case 'CONTINENTAL':{
                    if (($aParams['velocidade_min'] != '0')||($aParams['velocidade_max'] != '300'))
                        $filtro .= "AND (cp.conpo_vel::int BETWEEN {$aParams['velocidade_min']} AND {$aParams['velocidade_max']}) ";

                    if ($aParams['gprs'] == 'L')
                        $filtro .= "AND (cp.conpo_qgps > '0') ";
                    elseif ($aParams['gprs'] == 'D')
                        $filtro .= "AND (cp.conpo_qgps = '0') ";

                    if ($aParams['ignicao'] == 'L')
                        $filtro .= "AND (cp.conpo_even = '1') ";
                    elseif ($aParams['ignicao'] == 'D')
                        $filtro .= "AND (cp.conpo_even <> '1') ";

                    if ($aParams['panico'] == 'L')
                        $filtro .= "AND ((cp.conpo_even = 2)::boolean::int = '1') ";

                    $sql = "SELECT 
                            to_char(cp.conpo_dthr + interval '{$cli_fuso}', 'dd/mm/yy hh24:mi:ss') AS dthrl, 
                            cp.conpo_lon AS lon, cp.conpo_lat AS lat, substr(cp.conpo_statusin::bit(16)::varchar, 16, 1)::int AS ign, 
                            substr(cp.conpo_statusin::bit(16)::varchar, 13, 1)::int AS in2, 
                            substr(cp.conpo_statusin::bit(16)::varchar, 7, 1)::int AS in3, 
                            substr(cp.conpo_statusin::bit(16)::varchar, 5, 1)::int AS in4, 
                            substr(cp.conpo_statusout::bit(8)::varchar, 7, 1)::int AS sirene, 
                            substr(cp.conpo_statusout::bit(8)::varchar, 8, 1)::int AS bloqueio, 
                            cp.conpo_vel::int AS vel, cp.conpo_dir AS dir, cp.conpo_qgps AS gps, 
                            (cp.conpo_even = 2)::boolean::int AS sos, 
                            cp.conpo_volt AS volt, cp.conpo_temp AS temp, conpo_odom::int AS odom, conpo_hori AS hour, 
                            vi.veicic_para, vi.veicic_desl, vi.veicic_pani, vi.veicic_aler,
                            gp.goop_ender, gp.goop_bairro, gp.goop_cidade, gp.goop_uf, gp.goop_pais, gp.goop_cep
                            FROM ".ESQUEMA.".continental_posic cp 
                            INNER JOIN ".ESQUEMA.".instalacao i ON i.inst_id = cp.inst_id 
                            INNER JOIN ".ESQUEMA.".veiculo v ON v.veic_id = i.veic_id 
                            INNER JOIN ".ESQUEMA.".veiculo_icone vi ON vi.veicic_id = v.veicic_id 
                            LEFT JOIN gerencia.google_posicao gp ON (gp.goop_lat = cp.conpo_lat::double precision AND gp.goop_lon = cp.conpo_lon::double precision)
                            WHERE {$filtro}
                            ORDER BY cp.inst_id, cp.conpo_dthr ".($aParams['ordem'] == 'C' ? 'ASC ' : 'DESC ').
                            "{$limitador};";
                    break;
                }

                case 'SUNTECH':{
                    if (($aParams['velocidade_min'] != '0')||($aParams['velocidade_max'] != '300'))
                        $filtro .= "AND (sp.sunpo_spd::int BETWEEN {$aParams['velocidade_min']} AND {$aParams['velocidade_max']}) ";

                    if ($aParams['gprs'] == 'L')
                        $filtro .= "AND (sp.sunpo_sat = 't') ";
                    elseif ($aParams['gprs'] == 'D')
                        $filtro .= "AND (sp.sunpo_sat = 'f') ";

                    if ($aParams['ignicao'] == 'L')
                        $filtro .= "AND (sp.sunpo_ign = 't') ";
                    elseif ($aParams['ignicao'] == 'D')
                        $filtro .= "AND (sp.sunpo_ign = 'f') ";

                    $sql = "SELECT 
                            to_char(sp.sunpo_dthr + interval '{$cli_fuso}', 'dd/mm/yy hh24:mi:ss') AS dthrl, 
                            sp.sunpo_lon AS lon, sp.sunpo_lat AS lat, sp.sunpo_ign::boolean::int AS ign, 
                            sp.sunpo_pwr::int AS volt,
                            sp.sunpo_spd::int AS vel, sp.sunpo_crs AS dir, sp.sunpo_sat AS gps, sp.sunpo_in1 AS sos,
                            sp.sunpo_in2 AS in2, sp.sunpo_in3 AS in3, 
                            CASE mp.maxpor_in2 
                                    WHEN 'SENSOR COMBUSTIVEL' THEN 
                                            CASE sp.sunpo_in2::int 
                                                    WHEN 0 THEN 1 
                                                    WHEN 1 THEN 0 
                                            END 
                            END AS in5, 
                            CASE mp.maxpor_in3
                                    WHEN 'SENSOR DE RAMPA' THEN sp.sunpo_in3::int 
                                    ELSE 0::int
                            END AS in6, 
                            sp.sunpo_out2::boolean::int AS sirene, 
                            sp.sunpo_out1::boolean::int AS bloqueio, 
                            sp.sunpo_dist/1000::int AS odom, 
                            vi.veicic_para, vi.veicic_desl, vi.veicic_pani, vi.veicic_aler,
                            gp.goop_ender, gp.goop_bairro, gp.goop_cidade, gp.goop_uf, gp.goop_pais, gp.goop_cep
                            FROM ".ESQUEMA.".suntech_posic sp 
                            INNER JOIN ".ESQUEMA.".instalacao i ON i.inst_id = sp.inst_id 
                            LEFT JOIN ".ESQUEMA.".maxtrack_porta mp ON mp.maxpor_id = i.maxpor_id 
                            INNER JOIN ".ESQUEMA.".veiculo v ON v.veic_id = i.veic_id 
                            INNER JOIN ".ESQUEMA.".veiculo_icone vi ON vi.veicic_id = v.veicic_id 
                            LEFT JOIN gerencia.google_posicao gp ON (gp.goop_lat = sp.sunpo_lat::double precision AND gp.goop_lon = sp.sunpo_lon::double precision)
                            WHERE {$filtro}
                            ORDER BY sp.inst_id, sp.sunpo_dthr ".($aParams['ordem'] == 'C' ? 'ASC ' : 'DESC ').
                            "{$limitador};";
                    break;
                }

                case 'SONABYTE':{
                    if (($aParams['velocidade_min'] != '0')||($aParams['velocidade_max'] != '300'))
                        $filtro .= "AND (rp.rstpo_vel::int BETWEEN {$aParams['velocidade_min']} AND {$aParams['velocidade_max']}) ";

                    if ($aParams['gprs'] == 'L')
                        $filtro .= "AND (rp.rstpo_gprs = 1) ";
                    elseif ($aParams['gprs'] == 'D')
                        $filtro .= "AND (rp.rstpo_sat = 0) ";

                    if ($aParams['ignicao'] == 'L')
                        $filtro .= "AND (rp.rstpo_ent07 = 1) ";
                    elseif ($aParams['ignicao'] == 'D')
                        $filtro .= "AND (rp.rstpo_ent07 = 0) ";

                    //	rp.sunpo_hdr,
                    $sql = "SELECT 
                            to_char(rp.rstpo_dthr + interval '{$cli_fuso}', 'dd/mm/yy hh24:mi:ss') AS dthrl, 
                            rp.rstpo_lon AS lon, rp.rstpo_lat AS lat, rp.rstpo_ent07 AS ign, 
                            rp.rstpo_batex::int AS volt,
                            rp.rstpo_vel::int AS vel, rp.rstpo_dir AS dir, rp.rstpo_numsat::boolean::int AS gps, rp.rstpo_ent02 AS in2, rp.rstpo_ent03 AS in3, 
                            CASE mp.maxpor_in2 
                                    WHEN 'SENSOR COMBUSTIVEL' THEN 
                                            CASE rp.rstpo_ent02::int 
                                                    WHEN 0 THEN 1 
                                                    WHEN 1 THEN 0 
                                            END 
                            END AS in5, 
                            CASE mp.maxpor_in3
                                    WHEN 'SENSOR DE RAMPA' THEN rp.rstpo_ent03::int 
                                    ELSE 0::int
                            END AS in6, 
                            rp.rstpo_sai02 AS sirene, 
                            rp.rstpo_sai00 AS bloqueio, rp.rstpo_hodom/1000::int AS odom, 
                            vi.veicic_para, vi.veicic_desl, vi.veicic_pani, vi.veicic_aler,
                            gp.goop_ender, gp.goop_bairro, gp.goop_cidade, gp.goop_uf, gp.goop_pais, gp.goop_cep
                            FROM ".ESQUEMA.".rstvt_posic rp 
                            INNER JOIN ".ESQUEMA.".instalacao i ON i.inst_id = rp.inst_id 
                            LEFT JOIN ".ESQUEMA.".maxtrack_porta mp ON mp.maxpor_id = i.maxpor_id 
                            INNER JOIN ".ESQUEMA.".veiculo v ON v.veic_id = i.veic_id 
                            INNER JOIN ".ESQUEMA.".veiculo_icone vi ON vi.veicic_id = v.veicic_id 
                            LEFT JOIN gerencia.google_posicao gp ON (gp.goop_lat = rp.rstpo_lat::double precision AND gp.goop_lon = rp.rstpo_lon::double precision)
                            WHERE (rp.inst_id = '{$aParams['inst_id']}') and
                            {$filtro}
                            ORDER BY rp.inst_id, rp.rstpo_dthr ".($aParams['ordem'] == 'C' ? 'ASC ' : 'DESC ').
                            "{$limitador};";
                    break;
                }                
            }
        }
        
        $results = $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
      
        return $results;        
    }
    
    public function listarTotalJsonEvento(){
        $filtro = 'WHERE (i.inst_dtre IS NULL) '; //-----  inicia a variável filtro

        if (!LIBERACAOGM)
            $filtro .= "AND ((i.cli_id = '{$_SESSION[SESSAOEMPRESA]['cli_id']}') OR (c.cli_mae = '{$_SESSION[SESSAOEMPRESA]['cli_id']}')) ";
            
        $sql = 
        "SELECT count(0) AS instalacao_total 
	FROM ".ESQUEMA.".instalacao i 
	INNER JOIN ".ESQUEMA.".cliente c ON c.cli_id = i.cli_id AND c.cli_dtre IS NULL
	{$filtro};";
        
        $stmt = $this->pdo->prepare($sql);
	$stmt->execute();
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $results;
    }
    
    public function listarFrameSOS($inst_id){
        $sql = 
        "SELECT DISTINCT i.inst_dsc, cli_dsc, cli_tel, cli_tel2, cli_cel, cli_cel2, ".
	"cli_senhavoz, cli_pergunta, cli_resposta, cli_coasao, mp.maxpor_out1, mp.maxpor_out2, ".
	"mp.maxpor_out3, mp.maxpor_out4, ".
	"c.cli_cont1, c.cli_titu1, c.cli_tel01, to_char(c.cli_dtnasc1, 'dd/mm/yyyy') AS dtnasc1, c.cli_cpf1, ".
	"c.cli_cont2, c.cli_titu2, c.cli_tel02, to_char(c.cli_dtnasc2, 'dd/mm/yyyy') AS dtnasc2, c.cli_cpf2, ".
	"c.cli_cont3, c.cli_titu3, c.cli_tel03, to_char(c.cli_dtnasc3, 'dd/mm/yyyy') AS dtnasc3, c.cli_cpf3 ".
	"FROM ".ESQUEMA.".instalacao i ".
	"INNER JOIN ".ESQUEMA.".cliente c ON c.cli_id = i.cli_id ".
	"INNER JOIN ".ESQUEMA.".equipamento e ON e.equip_id = i.equip_id ".
	"INNER JOIN ".ESQUEMA.".equipamento_tipo et ON et.equipt_id = e.equipt_id ".
	"LEFT JOIN ".ESQUEMA.".maxtrack_porta mp ON mp.maxpor_id = i.maxpor_id ".
	"WHERE (i.inst_id = '{$inst_id}');";
        
        $stmt = $this->pdo->prepare($sql);
	$stmt->execute();
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $results;
    }    
    
    public function listarEnviarComando($inst_id, $tipo){
        if($tipo == "construct"){
            $sql = 
            "SELECT i.inst_dsc, e.equip_serial, et.equipt_dsc, et.equipt_forn, ".
            "i.inst_qacc, i.inst_qsn, i.inst_qpid, i.inst_qenv ".
            "FROM ".ESQUEMA.".instalacao i ".
            "INNER JOIN ".ESQUEMA.".equipamento e ON e.equip_id = i.equip_id ".
            "INNER JOIN ".ESQUEMA.".equipamento_tipo et ON et.equipt_id = e.equipt_id ".
            "WHERE (i.inst_id = '{$inst_id}');";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $results;

        }elseif($tipo == "zenite_envio"){
            $sql = 
            "SELECT equip_serial ".
            "FROM ".ESQUEMA.".instalacao i ".
            "INNER JOIN ".ESQUEMA.".equipamento e ON i.equip_id = e.equip_id ".
            "WHERE (inst_id = '{$inst_id}');";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $results;
            
        }
    }
    
    public function listarSalvaProcedimento($inst_id, $tipo){        
        if($tipo == "construct"){
            $sql = 
                "SELECT DISTINCT i.inst_dsc, cli_tel, cli_tel2, cli_cel, cli_cel2, ".
                "cli_senhavoz, cli_pergunta, cli_resposta, cli_coasao, mp.maxpor_out1, mp.maxpor_out2, ".
                "mp.maxpor_out3, mp.maxpor_out4 ".
                "FROM ".ESQUEMA.".instalacao i ".
                "INNER JOIN ".ESQUEMA.".cliente c ON c.cli_id = i.cli_id ".
                "INNER JOIN ".ESQUEMA.".maxtrack_porta mp ON mp.maxpor_id = i.maxpor_id ".
                "WHERE (i.inst_id = '{$inst_id}');";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $results;
        }
    }
    
    public function listarFrameCERCAINOUT($inst_id){
        $sql = 
        "SELECT DISTINCT i.inst_dsc, cli_dsc, cli_tel, cli_tel2, cli_cel, cli_cel2, ".
	"cli_senhavoz, cli_pergunta, cli_resposta, cli_coasao, mp.maxpor_out1, mp.maxpor_out2, ".
	"mp.maxpor_out3, mp.maxpor_out4 ".
	"FROM ".ESQUEMA.".instalacao i ".
	"INNER JOIN ".ESQUEMA.".cliente c ON c.cli_id = i.cli_id ".
	"INNER JOIN ".ESQUEMA.".maxtrack_porta mp ON mp.maxpor_id = i.maxpor_id ".
	"WHERE (i.inst_id = '{$inst_id}');";
        
        $stmt = $this->pdo->prepare($sql);
	$stmt->execute();
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $results;
    }
    
    public function listarFrameGridMapa($inst_id){
        $sql = 
        "SELECT DISTINCT i.inst_dsc, c.cli_dsc 
	FROM ".ESQUEMA.".instalacao i 
	INNER JOIN ".ESQUEMA.".cliente c ON c.cli_id = i.cli_id 
	WHERE (i.inst_id = '{$inst_id}');";

        $stmt = $this->pdo->prepare($sql);
	$stmt->execute();
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $results;
    }
    
    public function listarFrameGridComando($inst_id){
        if ($inst_id != "0"){            
            $sql =
                "SELECT DISTINCT i.inst_dsc, c.cli_dsc, mp.maxpor_out1, ".
                "mp.maxpor_out2, mp.maxpor_out3, mp.maxpor_out4, et.equipt_dsc, et.equipt_forn ".
                "FROM ".ESQUEMA.".instalacao i ".
                "INNER JOIN ".ESQUEMA.".cliente c ON c.cli_id = i.cli_id ".
                "LEFT JOIN ".ESQUEMA.".maxtrack_porta mp ON mp.maxpor_id = i.maxpor_id ".
                "INNER JOIN ".ESQUEMA.".equipamento e ON e.equip_id = i.equip_id ".
                "INNER JOIN ".ESQUEMA.".equipamento_tipo et ON et.equipt_id = e.equipt_id ".
                "WHERE (i.inst_id = '{$inst_id}');";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $results;
        }else
            return NULL;
    }
    
    public function listarInstalacaoPorCliente($cli_id){
        $sql =
            "SELECT i.inst_id, i.inst_dsc, i.equip_id, i.veic_id, v.veic_consumo
            FROM ".ESQUEMA.".instalacao i
            LEFT JOIN ".ESQUEMA.".veiculo v on v.veic_id = i.veic_id
            WHERE i.cli_id ='{$cli_id}' AND i.inst_dtre IS NULL ";

        $stmt = $this->pdo->prepare($sql);
	$stmt->execute();
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
      
        return $results;
    }
    
    public function listarInstalacaoPorClienteCerca($cli_id, $cerca_id){
           $sql =
           " SELECT i.inst_id, i.inst_dsc, ic.instcer_id, TO_CHAR(ic.instcer_dtini, 'dd/mm/yyyy hh24:mi') AS dtini, ".
           " TO_CHAR(ic.instcer_dtfim, 'dd/mm/yyyy hh24:mi') AS dtfim, ic.instcert_id ".
           " FROM ".ESQUEMA.".instalacao i ".
           " LEFT JOIN ".ESQUEMA.".instalacao_cerca ic ON ic.inst_id = i.inst_id  AND (ic.cerc_id = ".($cerca_id == "" ? 0 : $cerca_id).") ".
           " WHERE (i.cli_id = {$cli_id}) AND (i.inst_dtre IS NULL); ";

        $stmt = $this->pdo->prepare($sql);
	$stmt->execute();
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
      
        return $results;
    }
    
    public function listarInstalacaoPorClienteRota($cli_id, $rota_id){
           $sql =
           " SELECT i.inst_id, i.inst_dsc, ir.instrota_id, TO_CHAR(ir.instrota_ini, 'dd/mm/yyyy hh24:mi') AS dtini, ".
           " TO_CHAR(ir.instrota_fim, 'dd/mm/yyyy hh24:mi') AS dtfim ".
           " FROM ".ESQUEMA.".instalacao i ".
           " LEFT JOIN ".ESQUEMA.".instalacao_rota ir ON ir.inst_id = i.inst_id  AND (ir.rota_id = ".($rota_id == "" ? 0 : $rota_id).") ".
           " WHERE (i.cli_id = {$cli_id}) AND (i.inst_dtre IS NULL); ";

        $stmt = $this->pdo->prepare($sql);
	$stmt->execute();
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
      
        return $results;
    }
    
    public function listarInstalacaoRelatorioVeiculo($aParams){
        if($aParams['tipo'] == 1){
            if ($aParams['moto_id'] != ""){
                $sql = 
                "SELECT i.inst_dsc, et.equipt_forn, m.moto_dsc, e.equipt_id 
                FROM ( SELECT * FROM ".ESQUEMA.".instalacao WHERE (inst_id = '{$aParams['inst_id']}') AND (moto_id = '{$aParams['moto_id']}') ) as i 
                INNER JOIN ".ESQUEMA.".equipamento e ON e.equip_id = i.equip_id AND e.equip_dtre IS NULL 
                INNER JOIN ".ESQUEMA.".equipamento_tipo et ON et.equipt_id = e.equipt_id 
                INNER JOIN ".ESQUEMA.".motorista m ON m.moto_id = i.moto_id ";
            }else{
                $sql = 
                "SELECT i.inst_dsc, et.equipt_forn, e.equipt_id 
                FROM ( SELECT * FROM ".ESQUEMA.".instalacao WHERE (inst_id = '{$aParams['inst_id']}') ) as i 
                INNER JOIN ".ESQUEMA.".equipamento e ON e.equip_id = i.equip_id AND e.equip_dtre IS NULL 
                INNER JOIN ".ESQUEMA.".equipamento_tipo et ON et.equipt_id = e.equipt_id ";
            }
        }elseif($aParams['tipo'] == 2){
            //-----  Abre a tabelas de posição
            switch ($aParams['equipt_forn']){
                case 'MAXTRACK':{
                    $sql = 
                    "SELECT DISTINCT i.inst_id, to_char(mp.maxpo_dthr + interval '{$aParams['cli_fuso']}', 'dd/mm/yyyy hh24:mi:ss') AS dthrl, 
                    mp.maxpo_lon AS lon, mp.maxpo_lat AS lat, mp.maxpo_dir AS dir, mp.maxpo_ign AS ign, mp.maxpo_vel::int AS vel, 
                    mp.maxpo_odom/1000::int AS odom 
                    FROM ".ESQUEMA.".instalacao i 
                    INNER JOIN ".ESQUEMA.".equipamento e ON e.equip_id = i.equip_id AND e.equip_dtre IS NULL 
                    LEFT JOIN ".ESQUEMA.".maxtrack_posic mp ON mp.inst_id = i.inst_id 
                    WHERE (i.inst_id = '{$aParams['inst_id']}') ".($aParams['data_ini'] == '' ? '' : "AND (mp.maxpo_dthr BETWEEN {$aParams['data_ini']} AND {$aParams['data_fim']}) ").
                    "ORDER BY dthrl;";
                    break;
                }
                case 'QUANTA':{
                    $sql = 
                    "SELECT DISTINCT i.inst_id, to_char(qp.quapo_dthr + interval '{$aParams['cli_fuso']}', 'dd/mm/yyyy hh24:mi:ss') AS dthrl, 
                    qp.quapo_lon AS lon, qp.quapo_lat AS lat, qp.quapo_dir AS dir, qp.quapo_ign::boolean::int AS ign, 
                    qp.quapo_vel::int AS vel, qp.quapo_odom/1000::int AS odom 
                    FROM ".ESQUEMA.".instalacao i 
                    INNER JOIN ".ESQUEMA.".equipamento e ON e.equip_id = i.equip_id AND e.equip_dtre IS NULL 
                    LEFT JOIN ".ESQUEMA.".quanta_posic qp ON qp.inst_id = i.inst_id 
                    WHERE (i.inst_id = '{$aParams['inst_id']}') ".($aParams['data_ini'] == '' ? '' : "AND (qp.quapo_dthr BETWEEN {$aParams['data_ini']} AND {$aParams['data_fim']}) ").
                    "ORDER BY dthrl;";
                    break;
                }
                case 'ZENITE':{
                    $sql = "";
                    break;
                }
                case 'CONTINENTAL':{
                    $sql = 
                    "SELECT DISTINCT i.inst_id, to_char(cp.conpo_dthr + interval '{$aParams['cli_fuso']}', 'dd/mm/yyyy hh24:mi:ss') AS dthrl, 
                    cp.conpo_lon AS lon, cp.conpo_lat AS lat, cp.conpo_dir AS dir, substr(cp.conpo_statusin::bit(16)::varchar, 16, 1)::int AS ign, 
                    cp.conpo_vel::int AS vel, cp.conpo_odom::int AS odom 
                    FROM ".ESQUEMA.".instalacao i 
                    INNER JOIN ".ESQUEMA.".equipamento e ON e.equip_id = i.equip_id AND e.equip_dtre IS NULL 
                    LEFT JOIN ".ESQUEMA.".continental_posic cp ON cp.inst_id = i.inst_id 
                    WHERE (i.inst_id = '{$aParams['inst_id']}') ".($aParams['data_ini'] == '' ? '' : "AND (cp.conpo_dthr BETWEEN {$aParams['data_ini']} AND {$aParams['data_fim']}) ").
                    "ORDER BY dthrl;";
                    break;
                }
                case 'SUNTECH':{
                    $sql = 
                    "SELECT DISTINCT i.inst_id, to_char(sp.sunpo_dthr + interval '{$aParams['cli_fuso']}', 'dd/mm/yyyy hh24:mi:ss') AS dthrl, 
                    sp.sunpo_lon AS lon, sp.sunpo_lat AS lat, sp.sunpo_crs AS dir, sp.sunpo_ign::boolean::int AS ign, sp.sunpo_spd::int AS vel, 
                    sp.sunpo_dist::int AS odom 
                    FROM ".ESQUEMA.".instalacao i 
                    INNER JOIN ".ESQUEMA.".equipamento e ON e.equip_id = i.equip_id AND e.equip_dtre IS NULL 
                    LEFT JOIN ".ESQUEMA.".suntech_posic sp ON sp.inst_id = i.inst_id 
                    WHERE (i.inst_id = '{$aParams['inst_id']}') ".($aParams['data_ini'] == '' ? '' : "AND (sp.sunpo_dthr BETWEEN {$aParams['data_ini']} AND {$aParams['data_fim']}) ").
                    "ORDER BY dthrl;";
                    break;
                }
                case 'SONABYTE':{
                    $sql = 
                    "SELECT DISTINCT i.inst_id, to_char(rp.rstpo_dthr + interval '{$aParams['cli_fuso']}', 'dd/mm/yyyy hh24:mi:ss') AS dthrl, 
                    rp.rstpo_lon AS lon, rp.rstpo_lat AS lat, rp.rstpo_dir AS dir, rp.rstpo_ent07 AS ign, rp.rstpo_vel::int AS vel,
                    rp.rstpo_hodom AS odom
                    FROM ".ESQUEMA.".instalacao i
                    INNER JOIN ".ESQUEMA.".equipamento e ON e.equip_id = i.equip_id AND e.equip_dtre IS NULL 
                    LEFT JOIN ".ESQUEMA.".rstvt_posic rp ON rp.inst_id = i.inst_id 
                    WHERE (i.inst_id = '{$aParams['inst_id']}') ".($aParams['data_ini'] == '' ? '' : "AND (rp.rstpo_dthr BETWEEN {$aParams['data_ini']} AND {$aParams['data_fim']}) ").
                    "ORDER BY dthrl;";
                    break;
                }                
            }
        }

        $results = $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
      
        return $results;
    }
    
    public function listarInstalacaoRelatorioVeiculoPosicao($aParams){
        $inst_id = $aParams['inst_id'];
        
        if($aParams['tipo'] == 1){
            $dias    = $aParams['dias'];
            
            $sql = 
            "SELECT i.inst_dsc, c.cli_id,c.cli_dsc,
            v.veic_placa,et.equipt_forn,
            CASE et.equipt_forn 
                    WHEN 'MAXTRACK'    THEN to_char(mpu.maxpo_dthr, 'yyyy-mm-dd')
                    WHEN 'ZENITE'      THEN to_char(zpu.zenpo_dthr, 'yyyy-mm-dd')
                    WHEN 'QUANTA'      THEN to_char(qpu.quapo_dthr, 'yyyy-mm-dd')
                    WHEN 'CONTINENTAL' THEN to_char(cpu.conpo_dthr, 'yyyy-mm-dd')
                    WHEN 'SUNTECH'     THEN to_char(spu.sunpo_dthr, 'yyyy-mm-dd')
                    WHEN 'SONABYTE'    THEN to_char(rpu.rstpo_dthr, 'yyyy-mm-dd')
            END AS dthr_fim,
            CASE et.equipt_forn 
                    WHEN 'MAXTRACK'    THEN to_char(mpu.maxpo_dthr - interval '{$dias} days', 'yyyy-mm-dd') 
                    WHEN 'ZENITE'      THEN to_char(zpu.zenpo_dthr - interval '{$dias} days', 'yyyy-mm-dd') 
                    WHEN 'QUANTA'      THEN to_char(qpu.quapo_dthr - interval '{$dias} days', 'yyyy-mm-dd') 
                    WHEN 'CONTINENTAL' THEN to_char(cpu.conpo_dthr - interval '{$dias} days', 'yyyy-mm-dd') 
                    WHEN 'SUNTECH'     THEN to_char(spu.sunpo_dthr - interval '{$dias} days', 'yyyy-mm-dd') 
                    WHEN 'SONABYTE'    THEN to_char(rpu.rstpo_dthr - interval '{$dias} days', 'yyyy-mm-dd')
            END AS dthr_ini 
            FROM ".ESQUEMA.".instalacao i 
            LEFT JOIN ".ESQUEMA.".cliente c ON c.cli_id = i.cli_id AND c.cli_dtre IS NULL
            LEFT JOIN ".ESQUEMA.".veiculo v ON v.veic_id = i.veic_id AND v.veic_dtre IS NULL 
            LEFT JOIN ".ESQUEMA.".equipamento e ON e.equip_id = i.equip_id AND e.equip_dtre IS NULL 
            LEFT JOIN ".ESQUEMA.".equipamento_tipo et ON et.equipt_id = e.equipt_id
            LEFT JOIN ".ESQUEMA.".maxtrack_posic_ult mpu ON mpu.inst_id = i.inst_id 
            LEFT JOIN ".ESQUEMA.".zenite_posic_ult zpu ON zpu.inst_id = i.inst_id 
            LEFT JOIN ".ESQUEMA.".quanta_posic_ult qpu ON qpu.inst_id = i.inst_id 
            LEFT JOIN ".ESQUEMA.".continental_posic_ult cpu ON cpu.inst_id = i.inst_id 
            LEFT JOIN ".ESQUEMA.".suntech_posic_ult spu ON spu.inst_id = i.inst_id
            LEFT JOIN ".ESQUEMA.".rstvt_posic_ult rpu ON rpu.inst_id = i.inst_id
            WHERE (i.inst_id = '{$inst_id}');";
            
        }elseif($aParams['tipo'] == 2){
            switch ($aParams['equipt_forn']){
                case 'MAXTRACK':{
                    $sql = "SELECT 
                    to_char(mp.maxpo_dthr + interval '{$aParams['cli_fuso']}', 'dd/mm/yy hh24:mi:ss') AS dthrl, 
                    mp.maxpo_lon AS lon, mp.maxpo_lat AS lat, mp.maxpo_ign AS ign, 
                    mp.maxpo_vel::int AS vel, mp.maxpo_dir AS dir, mp.maxpo_gps AS gps, 
                    mp.maxpo_gprs AS gprs, mp.maxpo_alert, mp.maxpo_in1 AS sos, mp.maxpo_volt AS volt, 
                    mp.maxpo_in2 AS in2, mp.maxpo_in3 AS in3, mp.maxpo_in4 AS in4, mp.maxpo_in5::int AS in5, 
                    mp.maxpo_out1 AS bloqueio, mp.maxpo_out2 AS out2, mp.maxpo_out3 AS sirene, mp.maxpo_out4 AS out4, 
                    mp.maxpo_velex, mp.maxpo_countavl AS countavl, mp.maxpo_odom/1000 AS odom, mp.maxpo_hour AS hour, 
                    mp.maxpo_temp AS temp, vi.veicic_para, vi.veicic_desl, 
                    vi.veicic_pani, vi.veicic_aler,			gp.goop_ender, gp.goop_bairro, gp.goop_cidade, gp.goop_uf, gp.goop_pais, gp.goop_cep
                    FROM ".ESQUEMA.".maxtrack_posic mp 
                    INNER JOIN ".ESQUEMA.".instalacao i ON i.inst_id = mp.inst_id 
                    INNER JOIN ".ESQUEMA.".veiculo v ON v.veic_id = i.veic_id 
                    INNER JOIN ".ESQUEMA.".veiculo_icone vi ON vi.veicic_id = v.veicic_id 
                    LEFT JOIN gerencia.google_posicao gp ON (gp.goop_lat = mp.maxpo_lat::double precision AND gp.goop_lon = mp.maxpo_lon::double precision)
                    WHERE {$aParams['filtro']}
                    ORDER BY mp.inst_id, mp.maxpo_dthr ".($aParams['ordem'] == 'C' ? 'ASC ' : 'DESC ').
                    "{$aParams['limitador']};";
                    break;
                }

                case 'ZENITE':{
                    $sql = "SELECT 
                    to_char(zp.zenpo_dthr + interval '{$aParams['cli_fuso']}', 'dd/mm/yy hh24:mi:ss') AS dthrl, 
                    zp.zenpo_lon AS lon, zp.zenpo_lat AS lat, ".
                    (ESQUEMA == 'ciclopecas' ?	"substr(zp.zenpo_entr::int::bit(8)::varchar, 6, 1)::int " :	"substr(zp.zenpo_entr::int::bit(8)::varchar, 7, 1)::int ").
                    " AS ign, 
                    zp.zenpo_vel::int AS vel, zp.zenpo_dir AS dir, zp.zenpo_gps AS gps, 
                    zp.zenpo_gprs AS gprs, 
                    '0' AS sirene, '0' AS bloqueio, 
                    vi.veicic_para, vi.veicic_desl, vi.veicic_pani, vi.veicic_aler,
                    gp.goop_ender, gp.goop_bairro, gp.goop_cidade, gp.goop_uf, gp.goop_pais, gp.goop_cep
                    FROM ".ESQUEMA.".zenite_posic zp 
                    INNER JOIN ".ESQUEMA.".instalacao i ON i.inst_id = zp.inst_id 
                    INNER JOIN ".ESQUEMA.".veiculo v ON v.veic_id = i.veic_id 
                    INNER JOIN ".ESQUEMA.".veiculo_icone vi ON vi.veicic_id = v.veicic_id 
                    LEFT JOIN gerencia.google_posicao gp ON (gp.goop_lat = zp.zenpo_lat::double precision AND gp.goop_lon = zp.zenpo_lon::double precision)
                    WHERE {$aParams['filtro']}
                    ORDER BY zp.inst_id, zp.zenpo_dthr ".($aParams['ordem'] == 'C' ? 'ASC ' : 'DESC ').
                    "{$aParams['limitador']};";
                    break;
                }

                case 'QUANTA':{
                    $sql = "SELECT 
                    to_char(qp.quapo_dthr + interval '{$aParams['cli_fuso']}', 'dd/mm/yy hh24:mi:ss') AS dthrl, 
                    qp.quapo_lon AS lon, qp.quapo_lat AS lat, qp.quapo_ign::boolean::int AS ign, 
                    qp.quapo_vel::int AS vel, qp.quapo_dir AS dir, qp.quapo_gpsval AS gps, 
                    qp.quapo_buz::boolean::int AS sirene, qp.quapo_block::boolean::int AS bloqueio, 
                    qp.quapo_panic::boolean::int AS sos, qp.quapo_odom::int AS odom, 
                    vi.veicic_para, vi.veicic_desl, vi.veicic_pani, vi.veicic_aler,
                    gp.goop_ender, gp.goop_bairro, gp.goop_cidade, gp.goop_uf, gp.goop_pais, gp.goop_cep
                    FROM ".ESQUEMA.".quanta_posic qp 
                    INNER JOIN ".ESQUEMA.".instalacao i ON i.inst_id = qp.inst_id 
                    INNER JOIN ".ESQUEMA.".veiculo v ON v.veic_id = i.veic_id 
                    INNER JOIN ".ESQUEMA.".veiculo_icone vi ON vi.veicic_id = v.veicic_id 
                    LEFT JOIN gerencia.google_posicao gp ON (gp.goop_lat = qp.quapo_lat::double precision AND gp.goop_lon = qp.quapo_lon::double precision)
                    WHERE {$aParams['filtro']}
                    ORDER BY qp.inst_id, qp.quapo_dthr ".($aParams['ordem'] == 'C' ? 'ASC ' : 'DESC ').
                    "{$aParams['limitador']};";
                    break;
                }

                case 'CONTINENTAL':{
                    $sql = "SELECT 
                    to_char(cp.conpo_dthr + interval '{$aParams['cli_fuso']}', 'dd/mm/yy hh24:mi:ss') AS dthrl, 
                    cp.conpo_lon AS lon, cp.conpo_lat AS lat, substr(cp.conpo_statusin::bit(16)::varchar, 16, 1)::int AS ign, 
                    substr(cp.conpo_statusin::bit(16)::varchar, 13, 1)::int AS in2, 
                    substr(cp.conpo_statusin::bit(16)::varchar, 7, 1)::int AS in3, 
                    substr(cp.conpo_statusin::bit(16)::varchar, 5, 1)::int AS in4, 
                    substr(cp.conpo_statusout::bit(8)::varchar, 7, 1)::int AS sirene, 
                    substr(cp.conpo_statusout::bit(8)::varchar, 8, 1)::int AS bloqueio, 
                    cp.conpo_vel::int AS vel, cp.conpo_dir AS dir, cp.conpo_qgps AS gps, 
                    (cp.conpo_even = 2)::boolean::int AS sos, 
                    cp.conpo_volt AS volt, cp.conpo_temp AS temp, conpo_odom::int AS odom, conpo_hori AS hour, 
                    vi.veicic_para, vi.veicic_desl, vi.veicic_pani, vi.veicic_aler,
                    gp.goop_ender, gp.goop_bairro, gp.goop_cidade, gp.goop_uf, gp.goop_pais, gp.goop_cep
                    FROM ".ESQUEMA.".continental_posic cp 
                    INNER JOIN ".ESQUEMA.".instalacao i ON i.inst_id = cp.inst_id 
                    INNER JOIN ".ESQUEMA.".veiculo v ON v.veic_id = i.veic_id 
                    INNER JOIN ".ESQUEMA.".veiculo_icone vi ON vi.veicic_id = v.veicic_id 
                    LEFT JOIN gerencia.google_posicao gp ON (gp.goop_lat = cp.conpo_lat::double precision AND gp.goop_lon = cp.conpo_lon::double precision)
                    WHERE {$aParams['filtro']}
                    ORDER BY cp.inst_id, cp.conpo_dthr ".($aParams['ordem'] == 'C' ? 'ASC ' : 'DESC ').
                    "{$aParams['limitador']};";
                    break;
                }

                case 'SUNTECH':{
                    $sql = "SELECT 
                    to_char(sp.sunpo_dthr + interval '{$aParams['cli_fuso']}', 'dd/mm/yy hh24:mi:ss') AS dthrl, 
                    sp.sunpo_lon AS lon, sp.sunpo_lat AS lat, sp.sunpo_ign::boolean::int AS ign, 
                    sp.sunpo_pwr::int AS volt,
                    sp.sunpo_spd::int AS vel, sp.sunpo_crs AS dir, sp.sunpo_sat AS gps, sp.sunpo_in1 AS sos,
                    sp.sunpo_in2 AS in2, sp.sunpo_in3 AS in3, 
                    CASE mp.maxpor_in2 
                    WHEN 'SENSOR COMBUSTIVEL' THEN 
                    CASE sp.sunpo_in2::int 
                    WHEN 0 THEN 1 
                    WHEN 1 THEN 0 
                    END 
                    END AS in5, 
                    CASE mp.maxpor_in3
                    WHEN 'SENSOR DE RAMPA' THEN sp.sunpo_in3::int 
                    ELSE 0::int
                    END AS in6, 
                    sp.sunpo_out2::boolean::int AS sirene, 
                    sp.sunpo_out1::boolean::int AS bloqueio, 
                    sp.sunpo_dist/1000::int AS odom, 
                    vi.veicic_para, vi.veicic_desl, vi.veicic_pani, vi.veicic_aler,
                    gp.goop_ender, gp.goop_bairro, gp.goop_cidade, gp.goop_uf, gp.goop_pais, gp.goop_cep
                    FROM ".ESQUEMA.".suntech_posic sp 
                    INNER JOIN ".ESQUEMA.".instalacao i ON i.inst_id = sp.inst_id 
                    LEFT JOIN ".ESQUEMA.".maxtrack_porta mp ON mp.maxpor_id = i.maxpor_id 
                    INNER JOIN ".ESQUEMA.".veiculo v ON v.veic_id = i.veic_id 
                    INNER JOIN ".ESQUEMA.".veiculo_icone vi ON vi.veicic_id = v.veicic_id 
                    LEFT JOIN gerencia.google_posicao gp ON (gp.goop_lat = sp.sunpo_lat::double precision AND gp.goop_lon = sp.sunpo_lon::double precision)
                    WHERE {$aParams['filtro']}
                    ORDER BY sp.inst_id, sp.sunpo_dthr ".($aParams['ordem'] == 'C' ? 'ASC ' : 'DESC ').
                    "{$aParams['limitador']};";
                    break;
                }

                case 'SONABYTE':{
                    //	rp.sunpo_hdr,
                    $sql = "SELECT 
                    to_char(rp.rstpo_dthr + interval '{$aParams['cli_fuso']}', 'dd/mm/yy hh24:mi:ss') AS dthrl, 
                    rp.rstpo_lon AS lon, rp.rstpo_lat AS lat, rp.rstpo_ent07 AS ign, 
                    rp.rstpo_batex::int AS volt,
                    rp.rstpo_vel::int AS vel, rp.rstpo_dir AS dir, rp.rstpo_numsat::boolean::int AS gps, rp.rstpo_ent02 AS in2, rp.rstpo_ent03 AS in3, 
                    CASE mp.maxpor_in2 
                    WHEN 'SENSOR COMBUSTIVEL' THEN 
                    CASE rp.rstpo_ent02::int 
                    WHEN 0 THEN 1 
                    WHEN 1 THEN 0 
                    END 
                    END AS in5, 
                    CASE mp.maxpor_in3
                    WHEN 'SENSOR DE RAMPA' THEN rp.rstpo_ent03::int 
                    ELSE 0::int
                    END AS in6, 
                    rp.rstpo_sai02 AS sirene, 
                    rp.rstpo_sai00 AS bloqueio, rp.rstpo_hodom/1000::int AS odom, 
                    vi.veicic_para, vi.veicic_desl, vi.veicic_pani, vi.veicic_aler,
                    gp.goop_ender, gp.goop_bairro, gp.goop_cidade, gp.goop_uf, gp.goop_pais, gp.goop_cep
                    FROM ".ESQUEMA.".rstvt_posic rp 
                    INNER JOIN ".ESQUEMA.".instalacao i ON i.inst_id = rp.inst_id 
                    LEFT JOIN ".ESQUEMA.".maxtrack_porta mp ON mp.maxpor_id = i.maxpor_id 
                    INNER JOIN ".ESQUEMA.".veiculo v ON v.veic_id = i.veic_id 
                    INNER JOIN ".ESQUEMA.".veiculo_icone vi ON vi.veicic_id = v.veicic_id 
                    LEFT JOIN gerencia.google_posicao gp ON (gp.goop_lat = rp.rstpo_lat::double precision AND gp.goop_lon = rp.rstpo_lon::double precision)
                    WHERE (rp.inst_id = '{$inst_id}') and
                    {$aParams['filtro']}
                    ORDER BY rp.inst_id, rp.rstpo_dthr ".($aParams['ordem'] == 'C' ? 'ASC ' : 'DESC ').
                    "{$aParams['limitador']};";
                    break;
                }
            }
        }
        
        $results = $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
      
        return $results;
    }
    
    public function listarInstalacaoRelatorioClienteVeiculo(){
        $s_usrt_dsc = $_SESSION[SESSAOEMPRESA]['usrt_dsc'];
        $sql =
        "SELECT c.cli_sigla, i.inst_dsc, e.equip_serial, et.equipt_dsc, cg.chip_serial, cg.chip_tel, o.oper_dsc, to_char(i.inst_dtin, 'dd/mm/yyyy') AS inst_dtinf ".
	"FROM ".ESQUEMA.".instalacao i ".
	"LEFT JOIN ".ESQUEMA.".cliente c ON c.cli_id = i.cli_id ".
	"LEFT JOIN ".ESQUEMA.".equipamento e ON e.equip_id = i.equip_id ".
	"LEFT JOIN ".ESQUEMA.".equipamento_tipo et ON et.equipt_id = e.equipt_id ".
	"LEFT JOIN ".ESQUEMA.".chip_gsm cg ON cg.chip_id = e.chip_id ".
	"LEFT JOIN ".ESQUEMA.".operadora o ON o.oper_id = cg.oper_id ".
	"WHERE (i.inst_dtre IS NULL) ".($s_usrt_dsc == 'USUÁRIO TESTE' ? "AND (i.cli_id = '1') " : '').
	"ORDER BY c.cli_dsc, i.inst_dsc;";
        
        $results = $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
      
        return $results;
    }
    
    public function listarInstalacaoRelatorioOperacao($aParams){
        if($aParams['tipo'] == 1){
            if($aParams['inst_id'] == ''){
                $sql = "SELECT i.inst_id, i.inst_dsc, et.equipt_forn
                    FROM ".ESQUEMA.".instalacao i 
                    INNER JOIN ".ESQUEMA.".equipamento e ON e.equip_id = i.equip_id  AND e.equip_dtre IS NULL
                    INNER JOIN ".ESQUEMA.".equipamento_tipo et ON et.equipt_id = e.equipt_id  AND et.equipt_dtre IS NULL
                    WHERE (i.inst_dtre IS NULL) AND (i.cli_id = '{$aParams['cli_id']}')
                    ORDER BY i.inst_dsc;";
            }else{
                $sql= "SELECT i.inst_id, i.inst_dsc, et.equipt_forn 
                    FROM ".ESQUEMA.".instalacao i 
                    INNER JOIN ".ESQUEMA.".equipamento e ON e.equip_id = i.equip_id 
                    INNER JOIN ".ESQUEMA.".equipamento_tipo et ON et.equipt_id = e.equipt_id 
                    WHERE (i.inst_dtre IS NULL) AND (i.inst_id = '{$aParams['inst_id']}');";
            }
        }elseif($aParams['tipo'] == 2){
            switch ($aParams['equipt_forn']){
                case 'MAXTRACK':{
                    $sql = "SELECT TO_CHAR(maxpo_dthr::timestamp+interval '{$aParams['cli_fuso']}', 'dd/mm/yyyy hh24:mi:ss') AS dthrl, maxpo_lon AS lon, 
                        maxpo_lat AS lat, maxpo_ign AS ign, maxpo_vel AS vel, maxpo_odom::float/1000 AS odom 
                        FROM ".ESQUEMA.".maxtrack_posic 
                        WHERE (inst_id = '{$aParams['inst_id']}') AND (maxpo_dthr BETWEEN {$aParams['data_ini']} AND {$aParams['data_fim']})
                        ORDER BY maxpo_dthr;";
                    break;
                }
                case 'QUANTA':{
                    $sql = "SELECT TO_CHAR(quapo_dthr::timestamp+interval '{$aParams['cli_fuso']}', 'dd/mm/yyyy hh24:mi:ss') AS dthrl, quapo_lon AS lon, 
                        quapo_lat AS lat, quapo_ign AS ign, quapo_vel AS vel 
                        FROM ".ESQUEMA.".quanta_posic 
                        WHERE (inst_id = '{$aParams['inst_id']}') AND (quapo_dthr BETWEEN {$aParams['data_ini']} AND {$aParams['data_fim']})
                        ORDER BY quapo_dthr;";
                    break;
                }
                case 'ZENITE':{
                    $sql = "SELECT TO_CHAR(zenpo_dthr::timestamp+interval '{$aParams['cli_fuso']}', 'dd/mm/yyyy hh24:mi:ss') AS dthrl, zenpo_lon AS lon, 
                        zenpo_lat AS lat, qp.quapo_ign::boolean::int AS ign, zenpo_vel AS vel 
                        FROM ".ESQUEMA.".zenite_posic 
                        WHERE (inst_id = '{$aParams['inst_id']}') AND (zenpo_dthr BETWEEN {$aParams['data_ini']} AND {$aParams['data_fim']}) 
                        ORDER BY zenpo_dthr;";
                    break;
                }
                case 'CONTINENTAL':{
                    $sql = "SELECT TO_CHAR(conpo_dthr::timestamp+interval '{$aParams['cli_fuso']}', 'dd/mm/yyyy hh24:mi:ss') AS dthrl, conpo_lon AS lon, 
                        conpo_lat AS lat, substr(conpo_statusin::bit(16)::varchar, 16, 1)::int AS ign, conpo_vel AS vel, conpo_odom AS odom 
                        FROM ".ESQUEMA.".continental_posic 
                        WHERE (inst_id = '{$aParams['inst_id']}') AND (conpo_dthr BETWEEN {$aParams['data_ini']} AND {$aParams['data_fim']}) 
                        ORDER BY conpo_dthr;";
                    break;
                }
                case 'SUNTECH':{
                    $sql = "SELECT TO_CHAR(sunpo_dthr::timestamp+interval '{$aParams['cli_fuso']}', 'dd/mm/yyyy hh24:mi:ss') AS dthrl, sunpo_lon AS lon, 
                        sunpo_lat AS lat, sunpo_ign AS ign, sunpo_spd AS vel, sunpo_dist::float/1000 AS odom 
                        FROM ".ESQUEMA.".suntech_posic 
                        WHERE (inst_id = '{$aParams['inst_id']}') AND (sunpo_dthr BETWEEN {$aParams['data_ini']} AND {$aParams['data_fim']}) 
                        ORDER BY sunpo_dthr;";
                    break;
                }
                case 'SONABYTE':{
                    $sql = "SELECT TO_CHAR(rstpo_dthr::timestamp+interval '{$aParams['cli_fuso']}', 'dd/mm/yyyy hh24:mi:ss') AS dthrl, 
                        rstpo_lon AS lon, rstpo_lat AS lat, rstpo_ent07 AS ign, rstpo_vel AS vel, rstpo_hodom AS odom 
                        FROM ".ESQUEMA.".rstvt_posic 
                        WHERE (inst_id = '{$aParams['inst_id']}') AND (rstpo_dthr BETWEEN {$aParams['data_ini']} AND {$aParams['data_fim']}) 
                        ORDER BY rstpo_dthr;";
                    break;
                }
            }
        }
        
        $stmt = $this->pdo->prepare($sql);
	$stmt->execute();
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
      
        return $results;
    }
    
    public function listarInstalacaoRelatorioHistoricoInst($aParams){
        $sql = 
        "SELECT io.insto_id, io.inst_id, io.usr_id, io.insto_obs, i.inst_dsc, c.cli_dsc, c.cli_sigla, u.usr_dsc, u.usr_login, ".
	"to_char(io.insto_dtca, 'dd/mm/yy hh24:mi:ss') as insto_dtcal, to_char(io.insto_dtca, 'dd/mm/yy') as insto_datal, ".
	"to_char(io.insto_dtca, 'hh24:mi:ss') as insto_horal ".
	"FROM ".ESQUEMA.".instalacao_obs io ".
	"LEFT JOIN ".ESQUEMA.".usuario u ON u.usr_id = io.usr_id ".
	"LEFT JOIN ".ESQUEMA.".instalacao i ON i.inst_id = io.inst_id ".
	"LEFT JOIN ".ESQUEMA.".cliente c ON c.cli_id = i.cli_id ".
	"LEFT JOIN ".ESQUEMA.".veiculo v ON v.veic_id = i.veic_id ".
	"LEFT JOIN ".ESQUEMA.".veiculo_marca vma ON vma.veicma_id = v.veicma_id ".
	"LEFT JOIN ".ESQUEMA.".veiculo_modelo vmo ON vmo.veicmo_id = v.veicmo_id ".
	"LEFT JOIN ".ESQUEMA.".veiculo_cor vc ON vc.veicor_id = v.veicor_id ".
	"{$aParams['filtro']}".
	"ORDER BY io.insto_dtca DESC ".
	"{$aParams['limitador']};";
        
        $results = $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
      
        return $results;
    }
    
    public function validar($params){
        $valor = strtoupper($params['value']);
        
        $sql = "SELECT count(0) AS total ".
            "FROM ".ESQUEMA.".instalacao ".
            "WHERE (inst_dtre IS NULL) and (cli_id = '{$params['cli_id']}') AND (UPPER(inst_dsc) = '{$valor}')".($params['acao'] == 'alterar' ? " AND (inst_id != '{$params['id']}')" : '').";";        

        $stmt = $this->pdo->prepare($sql);
	$stmt->execute();
	$results = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return ($results['total'] == '0') ? 'Ok' : 'Erro';
        
        
    }
    
    
}

?>