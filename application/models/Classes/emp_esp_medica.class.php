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

Class emp_esp_medica {

	private $TIP_ESP_MEDICA_CVE; //int(11)
	private $ROL_DESEMPENIA_CVE; //int(11)
	private $INS_AVALA_CVE; //int(11)
	private $MODALIDAD_CVE; //int(11)
	private $COMPROBANTE_CVE; //int(11)
	private $EEM_FCH_INICIO; //date
	private $EEM_FCH_FIN; //date
	private $EEM_PAGO_EXTRA; //varchar(20)
	private $EEM_ANIO_FUNGIO; //int(11)
	private $EMPLEADO_CVE; //int(11)
	private $EEM_DURACION; //varchar(20)
	private $EMP_ESP_MEDICA_CVE; //int(11)
	private $ACT_DOC_GRAL_CVE; //int(10)
	private $TIP_ACT_DOC_CVE; //int(10)
	private $FECHA_INSERSION; //timestamp
	private $IS_VALIDO_PROFESIONALIZACION; //tinyint(1)
	private $connection;

	public function emp_esp_medica(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_emp_esp_medica($TIP_ESP_MEDICA_CVE,$ROL_DESEMPENIA_CVE,$INS_AVALA_CVE,$MODALIDAD_CVE,$COMPROBANTE_CVE,$EEM_FCH_INICIO,$EEM_FCH_FIN,$EEM_PAGO_EXTRA,$EEM_ANIO_FUNGIO,$EMPLEADO_CVE,$EEM_DURACION,$ACT_DOC_GRAL_CVE,$TIP_ACT_DOC_CVE,$FECHA_INSERSION,$IS_VALIDO_PROFESIONALIZACION){
		$this->TIP_ESP_MEDICA_CVE = $TIP_ESP_MEDICA_CVE;
		$this->ROL_DESEMPENIA_CVE = $ROL_DESEMPENIA_CVE;
		$this->INS_AVALA_CVE = $INS_AVALA_CVE;
		$this->MODALIDAD_CVE = $MODALIDAD_CVE;
		$this->COMPROBANTE_CVE = $COMPROBANTE_CVE;
		$this->EEM_FCH_INICIO = $EEM_FCH_INICIO;
		$this->EEM_FCH_FIN = $EEM_FCH_FIN;
		$this->EEM_PAGO_EXTRA = $EEM_PAGO_EXTRA;
		$this->EEM_ANIO_FUNGIO = $EEM_ANIO_FUNGIO;
		$this->EMPLEADO_CVE = $EMPLEADO_CVE;
		$this->EEM_DURACION = $EEM_DURACION;
		$this->ACT_DOC_GRAL_CVE = $ACT_DOC_GRAL_CVE;
		$this->TIP_ACT_DOC_CVE = $TIP_ACT_DOC_CVE;
		$this->FECHA_INSERSION = $FECHA_INSERSION;
		$this->IS_VALIDO_PROFESIONALIZACION = $IS_VALIDO_PROFESIONALIZACION;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from emp_esp_medica where EMP_ESP_MEDICA_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->TIP_ESP_MEDICA_CVE = $row["TIP_ESP_MEDICA_CVE"];
			$this->ROL_DESEMPENIA_CVE = $row["ROL_DESEMPENIA_CVE"];
			$this->INS_AVALA_CVE = $row["INS_AVALA_CVE"];
			$this->MODALIDAD_CVE = $row["MODALIDAD_CVE"];
			$this->COMPROBANTE_CVE = $row["COMPROBANTE_CVE"];
			$this->EEM_FCH_INICIO = $row["EEM_FCH_INICIO"];
			$this->EEM_FCH_FIN = $row["EEM_FCH_FIN"];
			$this->EEM_PAGO_EXTRA = $row["EEM_PAGO_EXTRA"];
			$this->EEM_ANIO_FUNGIO = $row["EEM_ANIO_FUNGIO"];
			$this->EMPLEADO_CVE = $row["EMPLEADO_CVE"];
			$this->EEM_DURACION = $row["EEM_DURACION"];
			$this->EMP_ESP_MEDICA_CVE = $row["EMP_ESP_MEDICA_CVE"];
			$this->ACT_DOC_GRAL_CVE = $row["ACT_DOC_GRAL_CVE"];
			$this->TIP_ACT_DOC_CVE = $row["TIP_ACT_DOC_CVE"];
			$this->FECHA_INSERSION = $row["FECHA_INSERSION"];
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
		$this->connection->RunQuery("DELETE FROM emp_esp_medica WHERE EMP_ESP_MEDICA_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE emp_esp_medica set TIP_ESP_MEDICA_CVE = \"$this->TIP_ESP_MEDICA_CVE\", ROL_DESEMPENIA_CVE = \"$this->ROL_DESEMPENIA_CVE\", INS_AVALA_CVE = \"$this->INS_AVALA_CVE\", MODALIDAD_CVE = \"$this->MODALIDAD_CVE\", COMPROBANTE_CVE = \"$this->COMPROBANTE_CVE\", EEM_FCH_INICIO = \"$this->EEM_FCH_INICIO\", EEM_FCH_FIN = \"$this->EEM_FCH_FIN\", EEM_PAGO_EXTRA = \"$this->EEM_PAGO_EXTRA\", EEM_ANIO_FUNGIO = \"$this->EEM_ANIO_FUNGIO\", EMPLEADO_CVE = \"$this->EMPLEADO_CVE\", EEM_DURACION = \"$this->EEM_DURACION\", ACT_DOC_GRAL_CVE = \"$this->ACT_DOC_GRAL_CVE\", TIP_ACT_DOC_CVE = \"$this->TIP_ACT_DOC_CVE\", FECHA_INSERSION = \"$this->FECHA_INSERSION\", IS_VALIDO_PROFESIONALIZACION = \"$this->IS_VALIDO_PROFESIONALIZACION\" where EMP_ESP_MEDICA_CVE = \"$this->EMP_ESP_MEDICA_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into emp_esp_medica (TIP_ESP_MEDICA_CVE, ROL_DESEMPENIA_CVE, INS_AVALA_CVE, MODALIDAD_CVE, COMPROBANTE_CVE, EEM_FCH_INICIO, EEM_FCH_FIN, EEM_PAGO_EXTRA, EEM_ANIO_FUNGIO, EMPLEADO_CVE, EEM_DURACION, ACT_DOC_GRAL_CVE, TIP_ACT_DOC_CVE, FECHA_INSERSION, IS_VALIDO_PROFESIONALIZACION) values (\"$this->TIP_ESP_MEDICA_CVE\", \"$this->ROL_DESEMPENIA_CVE\", \"$this->INS_AVALA_CVE\", \"$this->MODALIDAD_CVE\", \"$this->COMPROBANTE_CVE\", \"$this->EEM_FCH_INICIO\", \"$this->EEM_FCH_FIN\", \"$this->EEM_PAGO_EXTRA\", \"$this->EEM_ANIO_FUNGIO\", \"$this->EMPLEADO_CVE\", \"$this->EEM_DURACION\", \"$this->ACT_DOC_GRAL_CVE\", \"$this->TIP_ACT_DOC_CVE\", \"$this->FECHA_INSERSION\", \"$this->IS_VALIDO_PROFESIONALIZACION\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT EMP_ESP_MEDICA_CVE from emp_esp_medica order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["EMP_ESP_MEDICA_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return TIP_ESP_MEDICA_CVE - int(11)
	 */
	public function getTIP_ESP_MEDICA_CVE(){
		return $this->TIP_ESP_MEDICA_CVE;
	}

	/**
	 * @return ROL_DESEMPENIA_CVE - int(11)
	 */
	public function getROL_DESEMPENIA_CVE(){
		return $this->ROL_DESEMPENIA_CVE;
	}

	/**
	 * @return INS_AVALA_CVE - int(11)
	 */
	public function getINS_AVALA_CVE(){
		return $this->INS_AVALA_CVE;
	}

	/**
	 * @return MODALIDAD_CVE - int(11)
	 */
	public function getMODALIDAD_CVE(){
		return $this->MODALIDAD_CVE;
	}

	/**
	 * @return COMPROBANTE_CVE - int(11)
	 */
	public function getCOMPROBANTE_CVE(){
		return $this->COMPROBANTE_CVE;
	}

	/**
	 * @return EEM_FCH_INICIO - date
	 */
	public function getEEM_FCH_INICIO(){
		return $this->EEM_FCH_INICIO;
	}

	/**
	 * @return EEM_FCH_FIN - date
	 */
	public function getEEM_FCH_FIN(){
		return $this->EEM_FCH_FIN;
	}

	/**
	 * @return EEM_PAGO_EXTRA - varchar(20)
	 */
	public function getEEM_PAGO_EXTRA(){
		return $this->EEM_PAGO_EXTRA;
	}

	/**
	 * @return EEM_ANIO_FUNGIO - int(11)
	 */
	public function getEEM_ANIO_FUNGIO(){
		return $this->EEM_ANIO_FUNGIO;
	}

	/**
	 * @return EMPLEADO_CVE - int(11)
	 */
	public function getEMPLEADO_CVE(){
		return $this->EMPLEADO_CVE;
	}

	/**
	 * @return EEM_DURACION - varchar(20)
	 */
	public function getEEM_DURACION(){
		return $this->EEM_DURACION;
	}

	/**
	 * @return EMP_ESP_MEDICA_CVE - int(11)
	 */
	public function getEMP_ESP_MEDICA_CVE(){
		return $this->EMP_ESP_MEDICA_CVE;
	}

	/**
	 * @return ACT_DOC_GRAL_CVE - int(10)
	 */
	public function getACT_DOC_GRAL_CVE(){
		return $this->ACT_DOC_GRAL_CVE;
	}

	/**
	 * @return TIP_ACT_DOC_CVE - int(10)
	 */
	public function getTIP_ACT_DOC_CVE(){
		return $this->TIP_ACT_DOC_CVE;
	}

	/**
	 * @return FECHA_INSERSION - timestamp
	 */
	public function getFECHA_INSERSION(){
		return $this->FECHA_INSERSION;
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
	public function setTIP_ESP_MEDICA_CVE($TIP_ESP_MEDICA_CVE){
		$this->TIP_ESP_MEDICA_CVE = $TIP_ESP_MEDICA_CVE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setROL_DESEMPENIA_CVE($ROL_DESEMPENIA_CVE){
		$this->ROL_DESEMPENIA_CVE = $ROL_DESEMPENIA_CVE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setINS_AVALA_CVE($INS_AVALA_CVE){
		$this->INS_AVALA_CVE = $INS_AVALA_CVE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setMODALIDAD_CVE($MODALIDAD_CVE){
		$this->MODALIDAD_CVE = $MODALIDAD_CVE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setCOMPROBANTE_CVE($COMPROBANTE_CVE){
		$this->COMPROBANTE_CVE = $COMPROBANTE_CVE;
	}

	/**
	 * @param Type: date
	 */
	public function setEEM_FCH_INICIO($EEM_FCH_INICIO){
		$this->EEM_FCH_INICIO = $EEM_FCH_INICIO;
	}

	/**
	 * @param Type: date
	 */
	public function setEEM_FCH_FIN($EEM_FCH_FIN){
		$this->EEM_FCH_FIN = $EEM_FCH_FIN;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setEEM_PAGO_EXTRA($EEM_PAGO_EXTRA){
		$this->EEM_PAGO_EXTRA = $EEM_PAGO_EXTRA;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setEEM_ANIO_FUNGIO($EEM_ANIO_FUNGIO){
		$this->EEM_ANIO_FUNGIO = $EEM_ANIO_FUNGIO;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setEMPLEADO_CVE($EMPLEADO_CVE){
		$this->EMPLEADO_CVE = $EMPLEADO_CVE;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setEEM_DURACION($EEM_DURACION){
		$this->EEM_DURACION = $EEM_DURACION;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setEMP_ESP_MEDICA_CVE($EMP_ESP_MEDICA_CVE){
		$this->EMP_ESP_MEDICA_CVE = $EMP_ESP_MEDICA_CVE;
	}

	/**
	 * @param Type: int(10)
	 */
	public function setACT_DOC_GRAL_CVE($ACT_DOC_GRAL_CVE){
		$this->ACT_DOC_GRAL_CVE = $ACT_DOC_GRAL_CVE;
	}

	/**
	 * @param Type: int(10)
	 */
	public function setTIP_ACT_DOC_CVE($TIP_ACT_DOC_CVE){
		$this->TIP_ACT_DOC_CVE = $TIP_ACT_DOC_CVE;
	}

	/**
	 * @param Type: timestamp
	 */
	public function setFECHA_INSERSION($FECHA_INSERSION){
		$this->FECHA_INSERSION = $FECHA_INSERSION;
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
	public function endemp_esp_medica(){
		$this->connection->CloseMysql();
	}

}