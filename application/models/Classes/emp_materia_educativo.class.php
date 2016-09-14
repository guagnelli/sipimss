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

Class emp_materia_educativo {

	private $COMPROBANTE_CVE; //int(11)
	private $MAT_EDU_ANIO; //int(11)
	private $TIP_MATERIAL_CVE; //int(11)
	private $EMPLEADO_CVE; //int(11)
	private $NOMBRE_MATERIAL_EDUCATIVO; //varchar(100)
	private $MATERIA_EDUCATIVO_CVE; //int(11)
	private $FECHA_INSERSION; //timestamp
	private $IS_VALIDO_PROFESIONALIZACION; //tinyint(1)
	private $connection;

	public function emp_materia_educativo(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_emp_materia_educativo($COMPROBANTE_CVE,$MAT_EDU_ANIO,$TIP_MATERIAL_CVE,$EMPLEADO_CVE,$NOMBRE_MATERIAL_EDUCATIVO,$FECHA_INSERSION,$IS_VALIDO_PROFESIONALIZACION){
		$this->COMPROBANTE_CVE = $COMPROBANTE_CVE;
		$this->MAT_EDU_ANIO = $MAT_EDU_ANIO;
		$this->TIP_MATERIAL_CVE = $TIP_MATERIAL_CVE;
		$this->EMPLEADO_CVE = $EMPLEADO_CVE;
		$this->NOMBRE_MATERIAL_EDUCATIVO = $NOMBRE_MATERIAL_EDUCATIVO;
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
		$result = $this->connection->RunQuery("Select * from emp_materia_educativo where MATERIA_EDUCATIVO_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->COMPROBANTE_CVE = $row["COMPROBANTE_CVE"];
			$this->MAT_EDU_ANIO = $row["MAT_EDU_ANIO"];
			$this->TIP_MATERIAL_CVE = $row["TIP_MATERIAL_CVE"];
			$this->EMPLEADO_CVE = $row["EMPLEADO_CVE"];
			$this->NOMBRE_MATERIAL_EDUCATIVO = $row["NOMBRE_MATERIAL_EDUCATIVO"];
			$this->MATERIA_EDUCATIVO_CVE = $row["MATERIA_EDUCATIVO_CVE"];
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
		$this->connection->RunQuery("DELETE FROM emp_materia_educativo WHERE MATERIA_EDUCATIVO_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE emp_materia_educativo set COMPROBANTE_CVE = \"$this->COMPROBANTE_CVE\", MAT_EDU_ANIO = \"$this->MAT_EDU_ANIO\", TIP_MATERIAL_CVE = \"$this->TIP_MATERIAL_CVE\", EMPLEADO_CVE = \"$this->EMPLEADO_CVE\", NOMBRE_MATERIAL_EDUCATIVO = \"$this->NOMBRE_MATERIAL_EDUCATIVO\", FECHA_INSERSION = \"$this->FECHA_INSERSION\", IS_VALIDO_PROFESIONALIZACION = \"$this->IS_VALIDO_PROFESIONALIZACION\" where MATERIA_EDUCATIVO_CVE = \"$this->MATERIA_EDUCATIVO_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into emp_materia_educativo (COMPROBANTE_CVE, MAT_EDU_ANIO, TIP_MATERIAL_CVE, EMPLEADO_CVE, NOMBRE_MATERIAL_EDUCATIVO, FECHA_INSERSION, IS_VALIDO_PROFESIONALIZACION) values (\"$this->COMPROBANTE_CVE\", \"$this->MAT_EDU_ANIO\", \"$this->TIP_MATERIAL_CVE\", \"$this->EMPLEADO_CVE\", \"$this->NOMBRE_MATERIAL_EDUCATIVO\", \"$this->FECHA_INSERSION\", \"$this->IS_VALIDO_PROFESIONALIZACION\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT MATERIA_EDUCATIVO_CVE from emp_materia_educativo order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["MATERIA_EDUCATIVO_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return COMPROBANTE_CVE - int(11)
	 */
	public function getCOMPROBANTE_CVE(){
		return $this->COMPROBANTE_CVE;
	}

	/**
	 * @return MAT_EDU_ANIO - int(11)
	 */
	public function getMAT_EDU_ANIO(){
		return $this->MAT_EDU_ANIO;
	}

	/**
	 * @return TIP_MATERIAL_CVE - int(11)
	 */
	public function getTIP_MATERIAL_CVE(){
		return $this->TIP_MATERIAL_CVE;
	}

	/**
	 * @return EMPLEADO_CVE - int(11)
	 */
	public function getEMPLEADO_CVE(){
		return $this->EMPLEADO_CVE;
	}

	/**
	 * @return NOMBRE_MATERIAL_EDUCATIVO - varchar(100)
	 */
	public function getNOMBRE_MATERIAL_EDUCATIVO(){
		return $this->NOMBRE_MATERIAL_EDUCATIVO;
	}

	/**
	 * @return MATERIA_EDUCATIVO_CVE - int(11)
	 */
	public function getMATERIA_EDUCATIVO_CVE(){
		return $this->MATERIA_EDUCATIVO_CVE;
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
	public function setCOMPROBANTE_CVE($COMPROBANTE_CVE){
		$this->COMPROBANTE_CVE = $COMPROBANTE_CVE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setMAT_EDU_ANIO($MAT_EDU_ANIO){
		$this->MAT_EDU_ANIO = $MAT_EDU_ANIO;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTIP_MATERIAL_CVE($TIP_MATERIAL_CVE){
		$this->TIP_MATERIAL_CVE = $TIP_MATERIAL_CVE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setEMPLEADO_CVE($EMPLEADO_CVE){
		$this->EMPLEADO_CVE = $EMPLEADO_CVE;
	}

	/**
	 * @param Type: varchar(100)
	 */
	public function setNOMBRE_MATERIAL_EDUCATIVO($NOMBRE_MATERIAL_EDUCATIVO){
		$this->NOMBRE_MATERIAL_EDUCATIVO = $NOMBRE_MATERIAL_EDUCATIVO;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setMATERIA_EDUCATIVO_CVE($MATERIA_EDUCATIVO_CVE){
		$this->MATERIA_EDUCATIVO_CVE = $MATERIA_EDUCATIVO_CVE;
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
	public function endemp_materia_educativo(){
		$this->connection->CloseMysql();
	}

}