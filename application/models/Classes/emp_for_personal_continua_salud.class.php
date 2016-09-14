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

Class emp_for_personal_continua_salud {

	private $FPCS_CVE; //int(11)
	private $COMPROBANTE_CVE; //int(11)
	private $EMPLEADO_CVE; //int(11)
	private $EFPCS_FCH_INICIO; //date
	private $EFPCS_FCH_FIN; //date
	private $EFPCS_FOR_INICIAL; //tinyint(1)
	private $FECHA_INSERSION; //timestamp
	private $CSUBTIP_FORM_SALUD_CVE; //int(11)
	private $TIP_FORM_SALUD_CVE; //int(11)
	private $IS_VALIDO_PROFESIONALIZACION; //tinyint(1)
	private $connection;

	public function emp_for_personal_continua_salud(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_emp_for_personal_continua_salud($COMPROBANTE_CVE,$EMPLEADO_CVE,$EFPCS_FCH_INICIO,$EFPCS_FCH_FIN,$EFPCS_FOR_INICIAL,$FECHA_INSERSION,$CSUBTIP_FORM_SALUD_CVE,$TIP_FORM_SALUD_CVE,$IS_VALIDO_PROFESIONALIZACION){
		$this->COMPROBANTE_CVE = $COMPROBANTE_CVE;
		$this->EMPLEADO_CVE = $EMPLEADO_CVE;
		$this->EFPCS_FCH_INICIO = $EFPCS_FCH_INICIO;
		$this->EFPCS_FCH_FIN = $EFPCS_FCH_FIN;
		$this->EFPCS_FOR_INICIAL = $EFPCS_FOR_INICIAL;
		$this->FECHA_INSERSION = $FECHA_INSERSION;
		$this->CSUBTIP_FORM_SALUD_CVE = $CSUBTIP_FORM_SALUD_CVE;
		$this->TIP_FORM_SALUD_CVE = $TIP_FORM_SALUD_CVE;
		$this->IS_VALIDO_PROFESIONALIZACION = $IS_VALIDO_PROFESIONALIZACION;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from emp_for_personal_continua_salud where FPCS_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->FPCS_CVE = $row["FPCS_CVE"];
			$this->COMPROBANTE_CVE = $row["COMPROBANTE_CVE"];
			$this->EMPLEADO_CVE = $row["EMPLEADO_CVE"];
			$this->EFPCS_FCH_INICIO = $row["EFPCS_FCH_INICIO"];
			$this->EFPCS_FCH_FIN = $row["EFPCS_FCH_FIN"];
			$this->EFPCS_FOR_INICIAL = $row["EFPCS_FOR_INICIAL"];
			$this->FECHA_INSERSION = $row["FECHA_INSERSION"];
			$this->CSUBTIP_FORM_SALUD_CVE = $row["CSUBTIP_FORM_SALUD_CVE"];
			$this->TIP_FORM_SALUD_CVE = $row["TIP_FORM_SALUD_CVE"];
			$this->IS_VALIDO_PROFESIONALIZACION = $row["IS_VALIDO_PROFESIONALIZACION"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM emp_for_personal_continua_salud WHERE FPCS_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE emp_for_personal_continua_salud set COMPROBANTE_CVE = \"$this->COMPROBANTE_CVE\", EMPLEADO_CVE = \"$this->EMPLEADO_CVE\", EFPCS_FCH_INICIO = \"$this->EFPCS_FCH_INICIO\", EFPCS_FCH_FIN = \"$this->EFPCS_FCH_FIN\", EFPCS_FOR_INICIAL = \"$this->EFPCS_FOR_INICIAL\", FECHA_INSERSION = \"$this->FECHA_INSERSION\", CSUBTIP_FORM_SALUD_CVE = \"$this->CSUBTIP_FORM_SALUD_CVE\", TIP_FORM_SALUD_CVE = \"$this->TIP_FORM_SALUD_CVE\", IS_VALIDO_PROFESIONALIZACION = \"$this->IS_VALIDO_PROFESIONALIZACION\" where FPCS_CVE = \"$this->FPCS_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into emp_for_personal_continua_salud (COMPROBANTE_CVE, EMPLEADO_CVE, EFPCS_FCH_INICIO, EFPCS_FCH_FIN, EFPCS_FOR_INICIAL, FECHA_INSERSION, CSUBTIP_FORM_SALUD_CVE, TIP_FORM_SALUD_CVE, IS_VALIDO_PROFESIONALIZACION) values (\"$this->COMPROBANTE_CVE\", \"$this->EMPLEADO_CVE\", \"$this->EFPCS_FCH_INICIO\", \"$this->EFPCS_FCH_FIN\", \"$this->EFPCS_FOR_INICIAL\", \"$this->FECHA_INSERSION\", \"$this->CSUBTIP_FORM_SALUD_CVE\", \"$this->TIP_FORM_SALUD_CVE\", \"$this->IS_VALIDO_PROFESIONALIZACION\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT FPCS_CVE from emp_for_personal_continua_salud order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["FPCS_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return FPCS_CVE - int(11)
	 */
	public function getFPCS_CVE(){
		return $this->FPCS_CVE;
	}

	/**
	 * @return COMPROBANTE_CVE - int(11)
	 */
	public function getCOMPROBANTE_CVE(){
		return $this->COMPROBANTE_CVE;
	}

	/**
	 * @return EMPLEADO_CVE - int(11)
	 */
	public function getEMPLEADO_CVE(){
		return $this->EMPLEADO_CVE;
	}

	/**
	 * @return EFPCS_FCH_INICIO - date
	 */
	public function getEFPCS_FCH_INICIO(){
		return $this->EFPCS_FCH_INICIO;
	}

	/**
	 * @return EFPCS_FCH_FIN - date
	 */
	public function getEFPCS_FCH_FIN(){
		return $this->EFPCS_FCH_FIN;
	}

	/**
	 * @return EFPCS_FOR_INICIAL - tinyint(1)
	 */
	public function getEFPCS_FOR_INICIAL(){
		return $this->EFPCS_FOR_INICIAL;
	}

	/**
	 * @return FECHA_INSERSION - timestamp
	 */
	public function getFECHA_INSERSION(){
		return $this->FECHA_INSERSION;
	}

	/**
	 * @return CSUBTIP_FORM_SALUD_CVE - int(11)
	 */
	public function getCSUBTIP_FORM_SALUD_CVE(){
		return $this->CSUBTIP_FORM_SALUD_CVE;
	}

	/**
	 * @return TIP_FORM_SALUD_CVE - int(11)
	 */
	public function getTIP_FORM_SALUD_CVE(){
		return $this->TIP_FORM_SALUD_CVE;
	}

	/**
	 * @return IS_VALIDO_PROFESIONALIZACION - tinyint(1)
	 */
	public function getIS_VALIDO_PROFESIONALIZACION(){
		return $this->IS_VALIDO_PROFESIONALIZACION;
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
	public function setCOMPROBANTE_CVE($COMPROBANTE_CVE){
		$this->COMPROBANTE_CVE = $COMPROBANTE_CVE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setEMPLEADO_CVE($EMPLEADO_CVE){
		$this->EMPLEADO_CVE = $EMPLEADO_CVE;
	}

	/**
	 * @param Type: date
	 */
	public function setEFPCS_FCH_INICIO($EFPCS_FCH_INICIO){
		$this->EFPCS_FCH_INICIO = $EFPCS_FCH_INICIO;
	}

	/**
	 * @param Type: date
	 */
	public function setEFPCS_FCH_FIN($EFPCS_FCH_FIN){
		$this->EFPCS_FCH_FIN = $EFPCS_FCH_FIN;
	}

	/**
	 * @param Type: tinyint(1)
	 */
	public function setEFPCS_FOR_INICIAL($EFPCS_FOR_INICIAL){
		$this->EFPCS_FOR_INICIAL = $EFPCS_FOR_INICIAL;
	}

	/**
	 * @param Type: timestamp
	 */
	public function setFECHA_INSERSION($FECHA_INSERSION){
		$this->FECHA_INSERSION = $FECHA_INSERSION;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setCSUBTIP_FORM_SALUD_CVE($CSUBTIP_FORM_SALUD_CVE){
		$this->CSUBTIP_FORM_SALUD_CVE = $CSUBTIP_FORM_SALUD_CVE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTIP_FORM_SALUD_CVE($TIP_FORM_SALUD_CVE){
		$this->TIP_FORM_SALUD_CVE = $TIP_FORM_SALUD_CVE;
	}

	/**
	 * @param Type: tinyint(1)
	 */
	public function setIS_VALIDO_PROFESIONALIZACION($IS_VALIDO_PROFESIONALIZACION){
		$this->IS_VALIDO_PROFESIONALIZACION = $IS_VALIDO_PROFESIONALIZACION;
	}

    /**
     * Close mysql connection
     */
	public function endemp_for_personal_continua_salud(){
		$this->connection->CloseMysql();
	}

}