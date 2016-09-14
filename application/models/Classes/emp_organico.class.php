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

Class emp_organico {

	private $EMP_ORGANICO_CVE; //int(11)
	private $EMP_MATRICULA; //varchar(25)
	private $CATEGORIA_CVE; //int(11)
	private $ADSCRIPCION_CVE; //varchar(20)
	private $DELEGACION_CVE; //char(2)
	private $PRESUPUESTAL_ADSCRIPCION_CVE; //varchar(20)
	private $TIP_CONTRATACION_CVE; //int(11)
	private $EDO_LABORAL_CVE; //int(11)
	private $EMP_EMAIL; //varchar(30)
	private $EMP_TEL_LABORAL; //int(11)
	private $EMP_TEL_PARTICULAR; //int(11)
	private $CESTADO_CIVIL_CVE; //int(11)
	private $FCH_REGISTRO; //datetime
	private $FCH_CAMBIO; //datetime
	private $EMP_ACTUAL; //decimal(1,0)
	private $connection;

	public function emp_organico(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_emp_organico($EMP_MATRICULA,$CATEGORIA_CVE,$ADSCRIPCION_CVE,$DELEGACION_CVE,$PRESUPUESTAL_ADSCRIPCION_CVE,$TIP_CONTRATACION_CVE,$EDO_LABORAL_CVE,$EMP_EMAIL,$EMP_TEL_LABORAL,$EMP_TEL_PARTICULAR,$CESTADO_CIVIL_CVE,$FCH_REGISTRO,$FCH_CAMBIO,$EMP_ACTUAL){
		$this->EMP_MATRICULA = $EMP_MATRICULA;
		$this->CATEGORIA_CVE = $CATEGORIA_CVE;
		$this->ADSCRIPCION_CVE = $ADSCRIPCION_CVE;
		$this->DELEGACION_CVE = $DELEGACION_CVE;
		$this->PRESUPUESTAL_ADSCRIPCION_CVE = $PRESUPUESTAL_ADSCRIPCION_CVE;
		$this->TIP_CONTRATACION_CVE = $TIP_CONTRATACION_CVE;
		$this->EDO_LABORAL_CVE = $EDO_LABORAL_CVE;
		$this->EMP_EMAIL = $EMP_EMAIL;
		$this->EMP_TEL_LABORAL = $EMP_TEL_LABORAL;
		$this->EMP_TEL_PARTICULAR = $EMP_TEL_PARTICULAR;
		$this->CESTADO_CIVIL_CVE = $CESTADO_CIVIL_CVE;
		$this->FCH_REGISTRO = $FCH_REGISTRO;
		$this->FCH_CAMBIO = $FCH_CAMBIO;
		$this->EMP_ACTUAL = $EMP_ACTUAL;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from emp_organico where EMP_ORGANICO_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->EMP_ORGANICO_CVE = $row["EMP_ORGANICO_CVE"];
			$this->EMP_MATRICULA = $row["EMP_MATRICULA"];
			$this->CATEGORIA_CVE = $row["CATEGORIA_CVE"];
			$this->ADSCRIPCION_CVE = $row["ADSCRIPCION_CVE"];
			$this->DELEGACION_CVE = $row["DELEGACION_CVE"];
			$this->PRESUPUESTAL_ADSCRIPCION_CVE = $row["PRESUPUESTAL_ADSCRIPCION_CVE"];
			$this->TIP_CONTRATACION_CVE = $row["TIP_CONTRATACION_CVE"];
			$this->EDO_LABORAL_CVE = $row["EDO_LABORAL_CVE"];
			$this->EMP_EMAIL = $row["EMP_EMAIL"];
			$this->EMP_TEL_LABORAL = $row["EMP_TEL_LABORAL"];
			$this->EMP_TEL_PARTICULAR = $row["EMP_TEL_PARTICULAR"];
			$this->CESTADO_CIVIL_CVE = $row["CESTADO_CIVIL_CVE"];
			$this->FCH_REGISTRO = $row["FCH_REGISTRO"];
			$this->FCH_CAMBIO = $row["FCH_CAMBIO"];
			$this->EMP_ACTUAL = $row["EMP_ACTUAL"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM emp_organico WHERE EMP_ORGANICO_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE emp_organico set EMP_MATRICULA = \"$this->EMP_MATRICULA\", CATEGORIA_CVE = \"$this->CATEGORIA_CVE\", ADSCRIPCION_CVE = \"$this->ADSCRIPCION_CVE\", DELEGACION_CVE = \"$this->DELEGACION_CVE\", PRESUPUESTAL_ADSCRIPCION_CVE = \"$this->PRESUPUESTAL_ADSCRIPCION_CVE\", TIP_CONTRATACION_CVE = \"$this->TIP_CONTRATACION_CVE\", EDO_LABORAL_CVE = \"$this->EDO_LABORAL_CVE\", EMP_EMAIL = \"$this->EMP_EMAIL\", EMP_TEL_LABORAL = \"$this->EMP_TEL_LABORAL\", EMP_TEL_PARTICULAR = \"$this->EMP_TEL_PARTICULAR\", CESTADO_CIVIL_CVE = \"$this->CESTADO_CIVIL_CVE\", FCH_REGISTRO = \"$this->FCH_REGISTRO\", FCH_CAMBIO = \"$this->FCH_CAMBIO\", EMP_ACTUAL = \"$this->EMP_ACTUAL\" where EMP_ORGANICO_CVE = \"$this->EMP_ORGANICO_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into emp_organico (EMP_MATRICULA, CATEGORIA_CVE, ADSCRIPCION_CVE, DELEGACION_CVE, PRESUPUESTAL_ADSCRIPCION_CVE, TIP_CONTRATACION_CVE, EDO_LABORAL_CVE, EMP_EMAIL, EMP_TEL_LABORAL, EMP_TEL_PARTICULAR, CESTADO_CIVIL_CVE, FCH_REGISTRO, FCH_CAMBIO, EMP_ACTUAL) values (\"$this->EMP_MATRICULA\", \"$this->CATEGORIA_CVE\", \"$this->ADSCRIPCION_CVE\", \"$this->DELEGACION_CVE\", \"$this->PRESUPUESTAL_ADSCRIPCION_CVE\", \"$this->TIP_CONTRATACION_CVE\", \"$this->EDO_LABORAL_CVE\", \"$this->EMP_EMAIL\", \"$this->EMP_TEL_LABORAL\", \"$this->EMP_TEL_PARTICULAR\", \"$this->CESTADO_CIVIL_CVE\", \"$this->FCH_REGISTRO\", \"$this->FCH_CAMBIO\", \"$this->EMP_ACTUAL\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT EMP_ORGANICO_CVE from emp_organico order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["EMP_ORGANICO_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return EMP_ORGANICO_CVE - int(11)
	 */
	public function getEMP_ORGANICO_CVE(){
		return $this->EMP_ORGANICO_CVE;
	}

	/**
	 * @return EMP_MATRICULA - varchar(25)
	 */
	public function getEMP_MATRICULA(){
		return $this->EMP_MATRICULA;
	}

	/**
	 * @return CATEGORIA_CVE - int(11)
	 */
	public function getCATEGORIA_CVE(){
		return $this->CATEGORIA_CVE;
	}

	/**
	 * @return ADSCRIPCION_CVE - varchar(20)
	 */
	public function getADSCRIPCION_CVE(){
		return $this->ADSCRIPCION_CVE;
	}

	/**
	 * @return DELEGACION_CVE - char(2)
	 */
	public function getDELEGACION_CVE(){
		return $this->DELEGACION_CVE;
	}

	/**
	 * @return PRESUPUESTAL_ADSCRIPCION_CVE - varchar(20)
	 */
	public function getPRESUPUESTAL_ADSCRIPCION_CVE(){
		return $this->PRESUPUESTAL_ADSCRIPCION_CVE;
	}

	/**
	 * @return TIP_CONTRATACION_CVE - int(11)
	 */
	public function getTIP_CONTRATACION_CVE(){
		return $this->TIP_CONTRATACION_CVE;
	}

	/**
	 * @return EDO_LABORAL_CVE - int(11)
	 */
	public function getEDO_LABORAL_CVE(){
		return $this->EDO_LABORAL_CVE;
	}

	/**
	 * @return EMP_EMAIL - varchar(30)
	 */
	public function getEMP_EMAIL(){
		return $this->EMP_EMAIL;
	}

	/**
	 * @return EMP_TEL_LABORAL - int(11)
	 */
	public function getEMP_TEL_LABORAL(){
		return $this->EMP_TEL_LABORAL;
	}

	/**
	 * @return EMP_TEL_PARTICULAR - int(11)
	 */
	public function getEMP_TEL_PARTICULAR(){
		return $this->EMP_TEL_PARTICULAR;
	}

	/**
	 * @return CESTADO_CIVIL_CVE - int(11)
	 */
	public function getCESTADO_CIVIL_CVE(){
		return $this->CESTADO_CIVIL_CVE;
	}

	/**
	 * @return FCH_REGISTRO - datetime
	 */
	public function getFCH_REGISTRO(){
		return $this->FCH_REGISTRO;
	}

	/**
	 * @return FCH_CAMBIO - datetime
	 */
	public function getFCH_CAMBIO(){
		return $this->FCH_CAMBIO;
	}

	/**
	 * @return EMP_ACTUAL - decimal(1,0)
	 */
	public function getEMP_ACTUAL(){
		return $this->EMP_ACTUAL;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setEMP_ORGANICO_CVE($EMP_ORGANICO_CVE){
		$this->EMP_ORGANICO_CVE = $EMP_ORGANICO_CVE;
	}

	/**
	 * @param Type: varchar(25)
	 */
	public function setEMP_MATRICULA($EMP_MATRICULA){
		$this->EMP_MATRICULA = $EMP_MATRICULA;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setCATEGORIA_CVE($CATEGORIA_CVE){
		$this->CATEGORIA_CVE = $CATEGORIA_CVE;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setADSCRIPCION_CVE($ADSCRIPCION_CVE){
		$this->ADSCRIPCION_CVE = $ADSCRIPCION_CVE;
	}

	/**
	 * @param Type: char(2)
	 */
	public function setDELEGACION_CVE($DELEGACION_CVE){
		$this->DELEGACION_CVE = $DELEGACION_CVE;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setPRESUPUESTAL_ADSCRIPCION_CVE($PRESUPUESTAL_ADSCRIPCION_CVE){
		$this->PRESUPUESTAL_ADSCRIPCION_CVE = $PRESUPUESTAL_ADSCRIPCION_CVE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTIP_CONTRATACION_CVE($TIP_CONTRATACION_CVE){
		$this->TIP_CONTRATACION_CVE = $TIP_CONTRATACION_CVE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setEDO_LABORAL_CVE($EDO_LABORAL_CVE){
		$this->EDO_LABORAL_CVE = $EDO_LABORAL_CVE;
	}

	/**
	 * @param Type: varchar(30)
	 */
	public function setEMP_EMAIL($EMP_EMAIL){
		$this->EMP_EMAIL = $EMP_EMAIL;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setEMP_TEL_LABORAL($EMP_TEL_LABORAL){
		$this->EMP_TEL_LABORAL = $EMP_TEL_LABORAL;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setEMP_TEL_PARTICULAR($EMP_TEL_PARTICULAR){
		$this->EMP_TEL_PARTICULAR = $EMP_TEL_PARTICULAR;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setCESTADO_CIVIL_CVE($CESTADO_CIVIL_CVE){
		$this->CESTADO_CIVIL_CVE = $CESTADO_CIVIL_CVE;
	}

	/**
	 * @param Type: datetime
	 */
	public function setFCH_REGISTRO($FCH_REGISTRO){
		$this->FCH_REGISTRO = $FCH_REGISTRO;
	}

	/**
	 * @param Type: datetime
	 */
	public function setFCH_CAMBIO($FCH_CAMBIO){
		$this->FCH_CAMBIO = $FCH_CAMBIO;
	}

	/**
	 * @param Type: decimal(1,0)
	 */
	public function setEMP_ACTUAL($EMP_ACTUAL){
		$this->EMP_ACTUAL = $EMP_ACTUAL;
	}

    /**
     * Close mysql connection
     */
	public function endemp_organico(){
		$this->connection->CloseMysql();
	}

}