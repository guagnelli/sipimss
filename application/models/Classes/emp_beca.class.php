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

Class emp_beca {

	private $EB_FCH_INICIO; //date
	private $EB_FCH_FIN; //date
	private $CLA_BECA_CVE; //int(11)
	private $COMPROBANTE_CVE; //int(11)
	private $EMPLEADO_CVE; //int(11)
	private $EB_DURACION; //varchar(20)
	private $EMP_BECA_CVE; //int(11)
	private $MOTIVO_BECADO_CVE; //int(11)
	private $BECA_INTERRIMPIDA_CVE; //int(11)
	private $FECHA_INSERSION; //timestamp
	private $IS_LOADED; //decimal(1,0)
	private $IS_VALIDO_PROFESIONALIZACION; //tinyint(1)
	private $connection;

	public function emp_beca(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_emp_beca($EB_FCH_INICIO,$EB_FCH_FIN,$CLA_BECA_CVE,$COMPROBANTE_CVE,$EMPLEADO_CVE,$EB_DURACION,$MOTIVO_BECADO_CVE,$BECA_INTERRIMPIDA_CVE,$FECHA_INSERSION,$IS_LOADED,$IS_VALIDO_PROFESIONALIZACION){
		$this->EB_FCH_INICIO = $EB_FCH_INICIO;
		$this->EB_FCH_FIN = $EB_FCH_FIN;
		$this->CLA_BECA_CVE = $CLA_BECA_CVE;
		$this->COMPROBANTE_CVE = $COMPROBANTE_CVE;
		$this->EMPLEADO_CVE = $EMPLEADO_CVE;
		$this->EB_DURACION = $EB_DURACION;
		$this->MOTIVO_BECADO_CVE = $MOTIVO_BECADO_CVE;
		$this->BECA_INTERRIMPIDA_CVE = $BECA_INTERRIMPIDA_CVE;
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
		$result = $this->connection->RunQuery("Select * from emp_beca where EMP_BECA_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->EB_FCH_INICIO = $row["EB_FCH_INICIO"];
			$this->EB_FCH_FIN = $row["EB_FCH_FIN"];
			$this->CLA_BECA_CVE = $row["CLA_BECA_CVE"];
			$this->COMPROBANTE_CVE = $row["COMPROBANTE_CVE"];
			$this->EMPLEADO_CVE = $row["EMPLEADO_CVE"];
			$this->EB_DURACION = $row["EB_DURACION"];
			$this->EMP_BECA_CVE = $row["EMP_BECA_CVE"];
			$this->MOTIVO_BECADO_CVE = $row["MOTIVO_BECADO_CVE"];
			$this->BECA_INTERRIMPIDA_CVE = $row["BECA_INTERRIMPIDA_CVE"];
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
		$this->connection->RunQuery("DELETE FROM emp_beca WHERE EMP_BECA_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE emp_beca set EB_FCH_INICIO = \"$this->EB_FCH_INICIO\", EB_FCH_FIN = \"$this->EB_FCH_FIN\", CLA_BECA_CVE = \"$this->CLA_BECA_CVE\", COMPROBANTE_CVE = \"$this->COMPROBANTE_CVE\", EMPLEADO_CVE = \"$this->EMPLEADO_CVE\", EB_DURACION = \"$this->EB_DURACION\", MOTIVO_BECADO_CVE = \"$this->MOTIVO_BECADO_CVE\", BECA_INTERRIMPIDA_CVE = \"$this->BECA_INTERRIMPIDA_CVE\", FECHA_INSERSION = \"$this->FECHA_INSERSION\", IS_LOADED = \"$this->IS_LOADED\", IS_VALIDO_PROFESIONALIZACION = \"$this->IS_VALIDO_PROFESIONALIZACION\" where EMP_BECA_CVE = \"$this->EMP_BECA_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into emp_beca (EB_FCH_INICIO, EB_FCH_FIN, CLA_BECA_CVE, COMPROBANTE_CVE, EMPLEADO_CVE, EB_DURACION, MOTIVO_BECADO_CVE, BECA_INTERRIMPIDA_CVE, FECHA_INSERSION, IS_LOADED, IS_VALIDO_PROFESIONALIZACION) values (\"$this->EB_FCH_INICIO\", \"$this->EB_FCH_FIN\", \"$this->CLA_BECA_CVE\", \"$this->COMPROBANTE_CVE\", \"$this->EMPLEADO_CVE\", \"$this->EB_DURACION\", \"$this->MOTIVO_BECADO_CVE\", \"$this->BECA_INTERRIMPIDA_CVE\", \"$this->FECHA_INSERSION\", \"$this->IS_LOADED\", \"$this->IS_VALIDO_PROFESIONALIZACION\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT EMP_BECA_CVE from emp_beca order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["EMP_BECA_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return EB_FCH_INICIO - date
	 */
	public function getEB_FCH_INICIO(){
		return $this->EB_FCH_INICIO;
	}

	/**
	 * @return EB_FCH_FIN - date
	 */
	public function getEB_FCH_FIN(){
		return $this->EB_FCH_FIN;
	}

	/**
	 * @return CLA_BECA_CVE - int(11)
	 */
	public function getCLA_BECA_CVE(){
		return $this->CLA_BECA_CVE;
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
	 * @return EB_DURACION - varchar(20)
	 */
	public function getEB_DURACION(){
		return $this->EB_DURACION;
	}

	/**
	 * @return EMP_BECA_CVE - int(11)
	 */
	public function getEMP_BECA_CVE(){
		return $this->EMP_BECA_CVE;
	}

	/**
	 * @return MOTIVO_BECADO_CVE - int(11)
	 */
	public function getMOTIVO_BECADO_CVE(){
		return $this->MOTIVO_BECADO_CVE;
	}

	/**
	 * @return BECA_INTERRIMPIDA_CVE - int(11)
	 */
	public function getBECA_INTERRIMPIDA_CVE(){
		return $this->BECA_INTERRIMPIDA_CVE;
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
	 * @param Type: date
	 */
	public function setEB_FCH_INICIO($EB_FCH_INICIO){
		$this->EB_FCH_INICIO = $EB_FCH_INICIO;
	}

	/**
	 * @param Type: date
	 */
	public function setEB_FCH_FIN($EB_FCH_FIN){
		$this->EB_FCH_FIN = $EB_FCH_FIN;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setCLA_BECA_CVE($CLA_BECA_CVE){
		$this->CLA_BECA_CVE = $CLA_BECA_CVE;
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
	public function setEB_DURACION($EB_DURACION){
		$this->EB_DURACION = $EB_DURACION;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setEMP_BECA_CVE($EMP_BECA_CVE){
		$this->EMP_BECA_CVE = $EMP_BECA_CVE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setMOTIVO_BECADO_CVE($MOTIVO_BECADO_CVE){
		$this->MOTIVO_BECADO_CVE = $MOTIVO_BECADO_CVE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setBECA_INTERRIMPIDA_CVE($BECA_INTERRIMPIDA_CVE){
		$this->BECA_INTERRIMPIDA_CVE = $BECA_INTERRIMPIDA_CVE;
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
	public function endemp_beca(){
		$this->connection->CloseMysql();
	}

}