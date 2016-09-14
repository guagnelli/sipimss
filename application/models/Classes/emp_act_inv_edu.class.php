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

Class emp_act_inv_edu {

	private $MED_DIVULGACION_CVE; //int(11)
	private $EAIE_FCH_INICIO; //date
	private $EAIE_FCH_FIN; //date
	private $EAIE_PUB_CITA; //mediumtext
	private $COMPROBANTE_CVE; //int(11)
	private $EAIE_FOLIO_ACEPTACION; //varchar(20)
	private $EMPLEADO_CVE; //int(11)
	private $TIP_PARTICIPACION_CVE; //int(11)
	private $EIAE_DURACION; //varchar(20)
	private $EIAE_NOMBRE_INV; //varchar(40)
	private $EAID_CVE; //int(11)
	private $TIP_ESTUDIO_CVE; //int(11)
	private $TIP_ACT_DOC_CVE; //int(11)
	private $FECHA_INSERSION; //timestamp
	private $IS_LOADED; //decimal(1,0)
	private $IS_VALIDO_PROFESIONALIZACION; //tinyint(1)
	private $connection;

	public function emp_act_inv_edu(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_emp_act_inv_edu($MED_DIVULGACION_CVE,$EAIE_FCH_INICIO,$EAIE_FCH_FIN,$EAIE_PUB_CITA,$COMPROBANTE_CVE,$EAIE_FOLIO_ACEPTACION,$EMPLEADO_CVE,$TIP_PARTICIPACION_CVE,$EIAE_DURACION,$EIAE_NOMBRE_INV,$TIP_ESTUDIO_CVE,$TIP_ACT_DOC_CVE,$FECHA_INSERSION,$IS_LOADED,$IS_VALIDO_PROFESIONALIZACION){
		$this->MED_DIVULGACION_CVE = $MED_DIVULGACION_CVE;
		$this->EAIE_FCH_INICIO = $EAIE_FCH_INICIO;
		$this->EAIE_FCH_FIN = $EAIE_FCH_FIN;
		$this->EAIE_PUB_CITA = $EAIE_PUB_CITA;
		$this->COMPROBANTE_CVE = $COMPROBANTE_CVE;
		$this->EAIE_FOLIO_ACEPTACION = $EAIE_FOLIO_ACEPTACION;
		$this->EMPLEADO_CVE = $EMPLEADO_CVE;
		$this->TIP_PARTICIPACION_CVE = $TIP_PARTICIPACION_CVE;
		$this->EIAE_DURACION = $EIAE_DURACION;
		$this->EIAE_NOMBRE_INV = $EIAE_NOMBRE_INV;
		$this->TIP_ESTUDIO_CVE = $TIP_ESTUDIO_CVE;
		$this->TIP_ACT_DOC_CVE = $TIP_ACT_DOC_CVE;
		$this->FECHA_INSERSION = $FECHA_INSERSION;
		$this->IS_LOADED = $IS_LOADED;
		$this->IS_VALIDO_PROFESIONALIZACION = $IS_VALIDO_PROFESIONALIZACION;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from emp_act_inv_edu where EAID_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->MED_DIVULGACION_CVE = $row["MED_DIVULGACION_CVE"];
			$this->EAIE_FCH_INICIO = $row["EAIE_FCH_INICIO"];
			$this->EAIE_FCH_FIN = $row["EAIE_FCH_FIN"];
			$this->EAIE_PUB_CITA = $row["EAIE_PUB_CITA"];
			$this->COMPROBANTE_CVE = $row["COMPROBANTE_CVE"];
			$this->EAIE_FOLIO_ACEPTACION = $row["EAIE_FOLIO_ACEPTACION"];
			$this->EMPLEADO_CVE = $row["EMPLEADO_CVE"];
			$this->TIP_PARTICIPACION_CVE = $row["TIP_PARTICIPACION_CVE"];
			$this->EIAE_DURACION = $row["EIAE_DURACION"];
			$this->EIAE_NOMBRE_INV = $row["EIAE_NOMBRE_INV"];
			$this->EAID_CVE = $row["EAID_CVE"];
			$this->TIP_ESTUDIO_CVE = $row["TIP_ESTUDIO_CVE"];
			$this->TIP_ACT_DOC_CVE = $row["TIP_ACT_DOC_CVE"];
			$this->FECHA_INSERSION = $row["FECHA_INSERSION"];
			$this->IS_LOADED = $row["IS_LOADED"];
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
		$this->connection->RunQuery("DELETE FROM emp_act_inv_edu WHERE EAID_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE emp_act_inv_edu set MED_DIVULGACION_CVE = \"$this->MED_DIVULGACION_CVE\", EAIE_FCH_INICIO = \"$this->EAIE_FCH_INICIO\", EAIE_FCH_FIN = \"$this->EAIE_FCH_FIN\", EAIE_PUB_CITA = \"$this->EAIE_PUB_CITA\", COMPROBANTE_CVE = \"$this->COMPROBANTE_CVE\", EAIE_FOLIO_ACEPTACION = \"$this->EAIE_FOLIO_ACEPTACION\", EMPLEADO_CVE = \"$this->EMPLEADO_CVE\", TIP_PARTICIPACION_CVE = \"$this->TIP_PARTICIPACION_CVE\", EIAE_DURACION = \"$this->EIAE_DURACION\", EIAE_NOMBRE_INV = \"$this->EIAE_NOMBRE_INV\", TIP_ESTUDIO_CVE = \"$this->TIP_ESTUDIO_CVE\", TIP_ACT_DOC_CVE = \"$this->TIP_ACT_DOC_CVE\", FECHA_INSERSION = \"$this->FECHA_INSERSION\", IS_LOADED = \"$this->IS_LOADED\", IS_VALIDO_PROFESIONALIZACION = \"$this->IS_VALIDO_PROFESIONALIZACION\" where EAID_CVE = \"$this->EAID_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into emp_act_inv_edu (MED_DIVULGACION_CVE, EAIE_FCH_INICIO, EAIE_FCH_FIN, EAIE_PUB_CITA, COMPROBANTE_CVE, EAIE_FOLIO_ACEPTACION, EMPLEADO_CVE, TIP_PARTICIPACION_CVE, EIAE_DURACION, EIAE_NOMBRE_INV, TIP_ESTUDIO_CVE, TIP_ACT_DOC_CVE, FECHA_INSERSION, IS_LOADED, IS_VALIDO_PROFESIONALIZACION) values (\"$this->MED_DIVULGACION_CVE\", \"$this->EAIE_FCH_INICIO\", \"$this->EAIE_FCH_FIN\", \"$this->EAIE_PUB_CITA\", \"$this->COMPROBANTE_CVE\", \"$this->EAIE_FOLIO_ACEPTACION\", \"$this->EMPLEADO_CVE\", \"$this->TIP_PARTICIPACION_CVE\", \"$this->EIAE_DURACION\", \"$this->EIAE_NOMBRE_INV\", \"$this->TIP_ESTUDIO_CVE\", \"$this->TIP_ACT_DOC_CVE\", \"$this->FECHA_INSERSION\", \"$this->IS_LOADED\", \"$this->IS_VALIDO_PROFESIONALIZACION\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT EAID_CVE from emp_act_inv_edu order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["EAID_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return MED_DIVULGACION_CVE - int(11)
	 */
	public function getMED_DIVULGACION_CVE(){
		return $this->MED_DIVULGACION_CVE;
	}

	/**
	 * @return EAIE_FCH_INICIO - date
	 */
	public function getEAIE_FCH_INICIO(){
		return $this->EAIE_FCH_INICIO;
	}

	/**
	 * @return EAIE_FCH_FIN - date
	 */
	public function getEAIE_FCH_FIN(){
		return $this->EAIE_FCH_FIN;
	}

	/**
	 * @return EAIE_PUB_CITA - mediumtext
	 */
	public function getEAIE_PUB_CITA(){
		return $this->EAIE_PUB_CITA;
	}

	/**
	 * @return COMPROBANTE_CVE - int(11)
	 */
	public function getCOMPROBANTE_CVE(){
		return $this->COMPROBANTE_CVE;
	}

	/**
	 * @return EAIE_FOLIO_ACEPTACION - varchar(20)
	 */
	public function getEAIE_FOLIO_ACEPTACION(){
		return $this->EAIE_FOLIO_ACEPTACION;
	}

	/**
	 * @return EMPLEADO_CVE - int(11)
	 */
	public function getEMPLEADO_CVE(){
		return $this->EMPLEADO_CVE;
	}

	/**
	 * @return TIP_PARTICIPACION_CVE - int(11)
	 */
	public function getTIP_PARTICIPACION_CVE(){
		return $this->TIP_PARTICIPACION_CVE;
	}

	/**
	 * @return EIAE_DURACION - varchar(20)
	 */
	public function getEIAE_DURACION(){
		return $this->EIAE_DURACION;
	}

	/**
	 * @return EIAE_NOMBRE_INV - varchar(40)
	 */
	public function getEIAE_NOMBRE_INV(){
		return $this->EIAE_NOMBRE_INV;
	}

	/**
	 * @return EAID_CVE - int(11)
	 */
	public function getEAID_CVE(){
		return $this->EAID_CVE;
	}

	/**
	 * @return TIP_ESTUDIO_CVE - int(11)
	 */
	public function getTIP_ESTUDIO_CVE(){
		return $this->TIP_ESTUDIO_CVE;
	}

	/**
	 * @return TIP_ACT_DOC_CVE - int(11)
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
	 * @return IS_LOADED - decimal(1,0)
	 */
	public function getIS_LOADED(){
		return $this->IS_LOADED;
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
	public function setMED_DIVULGACION_CVE($MED_DIVULGACION_CVE){
		$this->MED_DIVULGACION_CVE = $MED_DIVULGACION_CVE;
	}

	/**
	 * @param Type: date
	 */
	public function setEAIE_FCH_INICIO($EAIE_FCH_INICIO){
		$this->EAIE_FCH_INICIO = $EAIE_FCH_INICIO;
	}

	/**
	 * @param Type: date
	 */
	public function setEAIE_FCH_FIN($EAIE_FCH_FIN){
		$this->EAIE_FCH_FIN = $EAIE_FCH_FIN;
	}

	/**
	 * @param Type: mediumtext
	 */
	public function setEAIE_PUB_CITA($EAIE_PUB_CITA){
		$this->EAIE_PUB_CITA = $EAIE_PUB_CITA;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setCOMPROBANTE_CVE($COMPROBANTE_CVE){
		$this->COMPROBANTE_CVE = $COMPROBANTE_CVE;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setEAIE_FOLIO_ACEPTACION($EAIE_FOLIO_ACEPTACION){
		$this->EAIE_FOLIO_ACEPTACION = $EAIE_FOLIO_ACEPTACION;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setEMPLEADO_CVE($EMPLEADO_CVE){
		$this->EMPLEADO_CVE = $EMPLEADO_CVE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTIP_PARTICIPACION_CVE($TIP_PARTICIPACION_CVE){
		$this->TIP_PARTICIPACION_CVE = $TIP_PARTICIPACION_CVE;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setEIAE_DURACION($EIAE_DURACION){
		$this->EIAE_DURACION = $EIAE_DURACION;
	}

	/**
	 * @param Type: varchar(40)
	 */
	public function setEIAE_NOMBRE_INV($EIAE_NOMBRE_INV){
		$this->EIAE_NOMBRE_INV = $EIAE_NOMBRE_INV;
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
	public function setTIP_ESTUDIO_CVE($TIP_ESTUDIO_CVE){
		$this->TIP_ESTUDIO_CVE = $TIP_ESTUDIO_CVE;
	}

	/**
	 * @param Type: int(11)
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
	 * @param Type: decimal(1,0)
	 */
	public function setIS_LOADED($IS_LOADED){
		$this->IS_LOADED = $IS_LOADED;
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
	public function endemp_act_inv_edu(){
		$this->connection->CloseMysql();
	}

}