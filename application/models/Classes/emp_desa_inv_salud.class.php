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

Class emp_desa_inv_salud {

	private $EDIS_FOLIO_ACEPTACION; //varchar(20)
	private $EDIS_CITA_PUBLICACION; //varchar(20)
	private $TIP_ESTUDIO_CVE; //int(11)
	private $MED_DIVULGACION_CVE; //int(11)
	private $TIP_PARTICIPACION_CVE; //int(11)
	private $COMPROBANTE_CVE; //int(11)
	private $EMPLEADO_CVE; //int(11)
	private $EDIS_DURACION; //varchar(20)
	private $EDIS_NOMBRE_INV; //varchar(40)
	private $EDIS_CVE; //int(11)
	private $EDIS_FCH_FIN; //date
	private $EDIS_FCH_INICIO; //char(18)
	private $INS_AVALA_CVE; //int(11)
	private $IS_VALIDO_PROFESIONALIZACION; //tinyint(1)
	private $connection;

	public function emp_desa_inv_salud(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_emp_desa_inv_salud($EDIS_FOLIO_ACEPTACION,$EDIS_CITA_PUBLICACION,$TIP_ESTUDIO_CVE,$MED_DIVULGACION_CVE,$TIP_PARTICIPACION_CVE,$COMPROBANTE_CVE,$EMPLEADO_CVE,$EDIS_DURACION,$EDIS_NOMBRE_INV,$EDIS_FCH_FIN,$EDIS_FCH_INICIO,$INS_AVALA_CVE,$IS_VALIDO_PROFESIONALIZACION){
		$this->EDIS_FOLIO_ACEPTACION = $EDIS_FOLIO_ACEPTACION;
		$this->EDIS_CITA_PUBLICACION = $EDIS_CITA_PUBLICACION;
		$this->TIP_ESTUDIO_CVE = $TIP_ESTUDIO_CVE;
		$this->MED_DIVULGACION_CVE = $MED_DIVULGACION_CVE;
		$this->TIP_PARTICIPACION_CVE = $TIP_PARTICIPACION_CVE;
		$this->COMPROBANTE_CVE = $COMPROBANTE_CVE;
		$this->EMPLEADO_CVE = $EMPLEADO_CVE;
		$this->EDIS_DURACION = $EDIS_DURACION;
		$this->EDIS_NOMBRE_INV = $EDIS_NOMBRE_INV;
		$this->EDIS_FCH_FIN = $EDIS_FCH_FIN;
		$this->EDIS_FCH_INICIO = $EDIS_FCH_INICIO;
		$this->INS_AVALA_CVE = $INS_AVALA_CVE;
		$this->IS_VALIDO_PROFESIONALIZACION = $IS_VALIDO_PROFESIONALIZACION;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from emp_desa_inv_salud where EDIS_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->EDIS_FOLIO_ACEPTACION = $row["EDIS_FOLIO_ACEPTACION"];
			$this->EDIS_CITA_PUBLICACION = $row["EDIS_CITA_PUBLICACION"];
			$this->TIP_ESTUDIO_CVE = $row["TIP_ESTUDIO_CVE"];
			$this->MED_DIVULGACION_CVE = $row["MED_DIVULGACION_CVE"];
			$this->TIP_PARTICIPACION_CVE = $row["TIP_PARTICIPACION_CVE"];
			$this->COMPROBANTE_CVE = $row["COMPROBANTE_CVE"];
			$this->EMPLEADO_CVE = $row["EMPLEADO_CVE"];
			$this->EDIS_DURACION = $row["EDIS_DURACION"];
			$this->EDIS_NOMBRE_INV = $row["EDIS_NOMBRE_INV"];
			$this->EDIS_CVE = $row["EDIS_CVE"];
			$this->EDIS_FCH_FIN = $row["EDIS_FCH_FIN"];
			$this->EDIS_FCH_INICIO = $row["EDIS_FCH_INICIO"];
			$this->INS_AVALA_CVE = $row["INS_AVALA_CVE"];
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
		$this->connection->RunQuery("DELETE FROM emp_desa_inv_salud WHERE EDIS_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE emp_desa_inv_salud set EDIS_FOLIO_ACEPTACION = \"$this->EDIS_FOLIO_ACEPTACION\", EDIS_CITA_PUBLICACION = \"$this->EDIS_CITA_PUBLICACION\", TIP_ESTUDIO_CVE = \"$this->TIP_ESTUDIO_CVE\", MED_DIVULGACION_CVE = \"$this->MED_DIVULGACION_CVE\", TIP_PARTICIPACION_CVE = \"$this->TIP_PARTICIPACION_CVE\", COMPROBANTE_CVE = \"$this->COMPROBANTE_CVE\", EMPLEADO_CVE = \"$this->EMPLEADO_CVE\", EDIS_DURACION = \"$this->EDIS_DURACION\", EDIS_NOMBRE_INV = \"$this->EDIS_NOMBRE_INV\", EDIS_FCH_FIN = \"$this->EDIS_FCH_FIN\", EDIS_FCH_INICIO = \"$this->EDIS_FCH_INICIO\", INS_AVALA_CVE = \"$this->INS_AVALA_CVE\", IS_VALIDO_PROFESIONALIZACION = \"$this->IS_VALIDO_PROFESIONALIZACION\" where EDIS_CVE = \"$this->EDIS_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into emp_desa_inv_salud (EDIS_FOLIO_ACEPTACION, EDIS_CITA_PUBLICACION, TIP_ESTUDIO_CVE, MED_DIVULGACION_CVE, TIP_PARTICIPACION_CVE, COMPROBANTE_CVE, EMPLEADO_CVE, EDIS_DURACION, EDIS_NOMBRE_INV, EDIS_FCH_FIN, EDIS_FCH_INICIO, INS_AVALA_CVE, IS_VALIDO_PROFESIONALIZACION) values (\"$this->EDIS_FOLIO_ACEPTACION\", \"$this->EDIS_CITA_PUBLICACION\", \"$this->TIP_ESTUDIO_CVE\", \"$this->MED_DIVULGACION_CVE\", \"$this->TIP_PARTICIPACION_CVE\", \"$this->COMPROBANTE_CVE\", \"$this->EMPLEADO_CVE\", \"$this->EDIS_DURACION\", \"$this->EDIS_NOMBRE_INV\", \"$this->EDIS_FCH_FIN\", \"$this->EDIS_FCH_INICIO\", \"$this->INS_AVALA_CVE\", \"$this->IS_VALIDO_PROFESIONALIZACION\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT EDIS_CVE from emp_desa_inv_salud order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["EDIS_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return EDIS_FOLIO_ACEPTACION - varchar(20)
	 */
	public function getEDIS_FOLIO_ACEPTACION(){
		return $this->EDIS_FOLIO_ACEPTACION;
	}

	/**
	 * @return EDIS_CITA_PUBLICACION - varchar(20)
	 */
	public function getEDIS_CITA_PUBLICACION(){
		return $this->EDIS_CITA_PUBLICACION;
	}

	/**
	 * @return TIP_ESTUDIO_CVE - int(11)
	 */
	public function getTIP_ESTUDIO_CVE(){
		return $this->TIP_ESTUDIO_CVE;
	}

	/**
	 * @return MED_DIVULGACION_CVE - int(11)
	 */
	public function getMED_DIVULGACION_CVE(){
		return $this->MED_DIVULGACION_CVE;
	}

	/**
	 * @return TIP_PARTICIPACION_CVE - int(11)
	 */
	public function getTIP_PARTICIPACION_CVE(){
		return $this->TIP_PARTICIPACION_CVE;
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
	 * @return EDIS_DURACION - varchar(20)
	 */
	public function getEDIS_DURACION(){
		return $this->EDIS_DURACION;
	}

	/**
	 * @return EDIS_NOMBRE_INV - varchar(40)
	 */
	public function getEDIS_NOMBRE_INV(){
		return $this->EDIS_NOMBRE_INV;
	}

	/**
	 * @return EDIS_CVE - int(11)
	 */
	public function getEDIS_CVE(){
		return $this->EDIS_CVE;
	}

	/**
	 * @return EDIS_FCH_FIN - date
	 */
	public function getEDIS_FCH_FIN(){
		return $this->EDIS_FCH_FIN;
	}

	/**
	 * @return EDIS_FCH_INICIO - char(18)
	 */
	public function getEDIS_FCH_INICIO(){
		return $this->EDIS_FCH_INICIO;
	}

	/**
	 * @return INS_AVALA_CVE - int(11)
	 */
	public function getINS_AVALA_CVE(){
		return $this->INS_AVALA_CVE;
	}

	/**
	 * @return IS_VALIDO_PROFESIONALIZACION - tinyint(1)
	 */
	public function getIS_VALIDO_PROFESIONALIZACION(){
		return $this->IS_VALIDO_PROFESIONALIZACION;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setEDIS_FOLIO_ACEPTACION($EDIS_FOLIO_ACEPTACION){
		$this->EDIS_FOLIO_ACEPTACION = $EDIS_FOLIO_ACEPTACION;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setEDIS_CITA_PUBLICACION($EDIS_CITA_PUBLICACION){
		$this->EDIS_CITA_PUBLICACION = $EDIS_CITA_PUBLICACION;
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
	public function setMED_DIVULGACION_CVE($MED_DIVULGACION_CVE){
		$this->MED_DIVULGACION_CVE = $MED_DIVULGACION_CVE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTIP_PARTICIPACION_CVE($TIP_PARTICIPACION_CVE){
		$this->TIP_PARTICIPACION_CVE = $TIP_PARTICIPACION_CVE;
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
	 * @param Type: varchar(20)
	 */
	public function setEDIS_DURACION($EDIS_DURACION){
		$this->EDIS_DURACION = $EDIS_DURACION;
	}

	/**
	 * @param Type: varchar(40)
	 */
	public function setEDIS_NOMBRE_INV($EDIS_NOMBRE_INV){
		$this->EDIS_NOMBRE_INV = $EDIS_NOMBRE_INV;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setEDIS_CVE($EDIS_CVE){
		$this->EDIS_CVE = $EDIS_CVE;
	}

	/**
	 * @param Type: date
	 */
	public function setEDIS_FCH_FIN($EDIS_FCH_FIN){
		$this->EDIS_FCH_FIN = $EDIS_FCH_FIN;
	}

	/**
	 * @param Type: char(18)
	 */
	public function setEDIS_FCH_INICIO($EDIS_FCH_INICIO){
		$this->EDIS_FCH_INICIO = $EDIS_FCH_INICIO;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setINS_AVALA_CVE($INS_AVALA_CVE){
		$this->INS_AVALA_CVE = $INS_AVALA_CVE;
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
	public function endemp_desa_inv_salud(){
		$this->connection->CloseMysql();
	}

}