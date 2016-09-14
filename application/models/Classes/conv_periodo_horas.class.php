<?php
/*
 * Author: Rafael Rocha - www.rafaelrocha.net - info@rafaelrocha.net
 * 
 * Create Date: 13-09-2016
 * 
 * Version of MYSQL_to_PHP: 1.1
 * 
 * License: LGPL 
 * 
 */
require_once 'DataBaseMysql.class.php';

Class conv_periodo_horas {

	private $EMP_ESP_MEDICA_CVE; //int(11)
	private $EMP_ACT_DOCENTE_CVE; //int(11)
	private $EMP_FORMACION_PROFESIONAL_CVE; //int(11)
	private $EDIS_CVE; //int(11)
	private $EAID_CVE; //int(11)
	private $EMP_COMISION_CVE; //int(11)
	private $FPCS_CVE; //int(11)
	private $TAB_CONV_PER_HORAS; //int(11)
	private $TAB_CON_PER_HORAS_CVE; //int(11)
	private $connection;

	public function conv_periodo_horas(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_conv_periodo_horas($EMP_ESP_MEDICA_CVE,$EMP_ACT_DOCENTE_CVE,$EMP_FORMACION_PROFESIONAL_CVE,$EDIS_CVE,$EAID_CVE,$EMP_COMISION_CVE,$FPCS_CVE,$TAB_CONV_PER_HORAS,$TAB_CON_PER_HORAS_CVE){
		$this->EMP_ESP_MEDICA_CVE = $EMP_ESP_MEDICA_CVE;
		$this->EMP_ACT_DOCENTE_CVE = $EMP_ACT_DOCENTE_CVE;
		$this->EMP_FORMACION_PROFESIONAL_CVE = $EMP_FORMACION_PROFESIONAL_CVE;
		$this->EDIS_CVE = $EDIS_CVE;
		$this->EAID_CVE = $EAID_CVE;
		$this->EMP_COMISION_CVE = $EMP_COMISION_CVE;
		$this->FPCS_CVE = $FPCS_CVE;
		$this->TAB_CONV_PER_HORAS = $TAB_CONV_PER_HORAS;
		$this->TAB_CON_PER_HORAS_CVE = $TAB_CON_PER_HORAS_CVE;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from conv_periodo_horas where EMP_ESP_MEDICA_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->EMP_ESP_MEDICA_CVE = $row["EMP_ESP_MEDICA_CVE"];
			$this->EMP_ACT_DOCENTE_CVE = $row["EMP_ACT_DOCENTE_CVE"];
			$this->EMP_FORMACION_PROFESIONAL_CVE = $row["EMP_FORMACION_PROFESIONAL_CVE"];
			$this->EDIS_CVE = $row["EDIS_CVE"];
			$this->EAID_CVE = $row["EAID_CVE"];
			$this->EMP_COMISION_CVE = $row["EMP_COMISION_CVE"];
			$this->FPCS_CVE = $row["FPCS_CVE"];
			$this->TAB_CONV_PER_HORAS = $row["TAB_CONV_PER_HORAS"];
			$this->TAB_CON_PER_HORAS_CVE = $row["TAB_CON_PER_HORAS_CVE"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM conv_periodo_horas WHERE EMP_ESP_MEDICA_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE conv_periodo_horas set EMP_ESP_MEDICA_CVE = \"$this->EMP_ESP_MEDICA_CVE\", EMP_ACT_DOCENTE_CVE = \"$this->EMP_ACT_DOCENTE_CVE\", EMP_FORMACION_PROFESIONAL_CVE = \"$this->EMP_FORMACION_PROFESIONAL_CVE\", EDIS_CVE = \"$this->EDIS_CVE\", EAID_CVE = \"$this->EAID_CVE\", EMP_COMISION_CVE = \"$this->EMP_COMISION_CVE\", FPCS_CVE = \"$this->FPCS_CVE\", TAB_CONV_PER_HORAS = \"$this->TAB_CONV_PER_HORAS\", TAB_CON_PER_HORAS_CVE = \"$this->TAB_CON_PER_HORAS_CVE\" where EMP_ESP_MEDICA_CVE = \"$this->EMP_ESP_MEDICA_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into conv_periodo_horas (EMP_ESP_MEDICA_CVE, EMP_ACT_DOCENTE_CVE, EMP_FORMACION_PROFESIONAL_CVE, EDIS_CVE, EAID_CVE, EMP_COMISION_CVE, FPCS_CVE, TAB_CONV_PER_HORAS, TAB_CON_PER_HORAS_CVE) values (\"$this->EMP_ESP_MEDICA_CVE\", \"$this->EMP_ACT_DOCENTE_CVE\", \"$this->EMP_FORMACION_PROFESIONAL_CVE\", \"$this->EDIS_CVE\", \"$this->EAID_CVE\", \"$this->EMP_COMISION_CVE\", \"$this->FPCS_CVE\", \"$this->TAB_CONV_PER_HORAS\", \"$this->TAB_CON_PER_HORAS_CVE\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT EMP_ESP_MEDICA_CVE from conv_periodo_horas order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["EMP_ESP_MEDICA_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return EMP_ESP_MEDICA_CVE - int(11)
	 */
	public function getEMP_ESP_MEDICA_CVE(){
		return $this->EMP_ESP_MEDICA_CVE;
	}

	/**
	 * @return EMP_ACT_DOCENTE_CVE - int(11)
	 */
	public function getEMP_ACT_DOCENTE_CVE(){
		return $this->EMP_ACT_DOCENTE_CVE;
	}

	/**
	 * @return EMP_FORMACION_PROFESIONAL_CVE - int(11)
	 */
	public function getEMP_FORMACION_PROFESIONAL_CVE(){
		return $this->EMP_FORMACION_PROFESIONAL_CVE;
	}

	/**
	 * @return EDIS_CVE - int(11)
	 */
	public function getEDIS_CVE(){
		return $this->EDIS_CVE;
	}

	/**
	 * @return EAID_CVE - int(11)
	 */
	public function getEAID_CVE(){
		return $this->EAID_CVE;
	}

	/**
	 * @return EMP_COMISION_CVE - int(11)
	 */
	public function getEMP_COMISION_CVE(){
		return $this->EMP_COMISION_CVE;
	}

	/**
	 * @return FPCS_CVE - int(11)
	 */
	public function getFPCS_CVE(){
		return $this->FPCS_CVE;
	}

	/**
	 * @return TAB_CONV_PER_HORAS - int(11)
	 */
	public function getTAB_CONV_PER_HORAS(){
		return $this->TAB_CONV_PER_HORAS;
	}

	/**
	 * @return TAB_CON_PER_HORAS_CVE - int(11)
	 */
	public function getTAB_CON_PER_HORAS_CVE(){
		return $this->TAB_CON_PER_HORAS_CVE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setEMP_ESP_MEDICA_CVE($EMP_ESP_MEDICA_CVE){
		$this->EMP_ESP_MEDICA_CVE = $EMP_ESP_MEDICA_CVE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setEMP_ACT_DOCENTE_CVE($EMP_ACT_DOCENTE_CVE){
		$this->EMP_ACT_DOCENTE_CVE = $EMP_ACT_DOCENTE_CVE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setEMP_FORMACION_PROFESIONAL_CVE($EMP_FORMACION_PROFESIONAL_CVE){
		$this->EMP_FORMACION_PROFESIONAL_CVE = $EMP_FORMACION_PROFESIONAL_CVE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setEDIS_CVE($EDIS_CVE){
		$this->EDIS_CVE = $EDIS_CVE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setEAID_CVE($EAID_CVE){
		$this->EAID_CVE = $EAID_CVE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setEMP_COMISION_CVE($EMP_COMISION_CVE){
		$this->EMP_COMISION_CVE = $EMP_COMISION_CVE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setFPCS_CVE($FPCS_CVE){
		$this->FPCS_CVE = $FPCS_CVE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTAB_CONV_PER_HORAS($TAB_CONV_PER_HORAS){
		$this->TAB_CONV_PER_HORAS = $TAB_CONV_PER_HORAS;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTAB_CON_PER_HORAS_CVE($TAB_CON_PER_HORAS_CVE){
		$this->TAB_CON_PER_HORAS_CVE = $TAB_CON_PER_HORAS_CVE;
	}

    /**
     * Close mysql connection
     */
	public function endconv_periodo_horas(){
		$this->connection->CloseMysql();
	}

}