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

Class emp_ciclos_clinicos {

	private $LICENCIATURA_CVE; //int(11)
	private $ROL_DESEMPENIA_CVE; //int(11)
	private $INS_AVALA_CVE; //int(11)
	private $ECC_PAGO_EXTRA; //varchar(20)
	private $MODALIDAD_CVE; //int(11)
	private $ECC_ANIO_IMPARTIDO; //int(11)
	private $ECC_DURACION; //varchar(20)
	private $EMPLEADO_CVE; //int(11)
	private $ECC_CURSO; //varchar(20)
	private $ECC_CVE; //int(11)
	private $ECC_FCH_INICIO; //date
	private $ECC_FCH_FIN; //date
	private $FECHA_INSERSION; //timestamp
	private $IS_VALIDO_PROFESIONALIZACION; //tinyint(1)
	private $connection;

	public function emp_ciclos_clinicos(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_emp_ciclos_clinicos($LICENCIATURA_CVE,$ROL_DESEMPENIA_CVE,$INS_AVALA_CVE,$ECC_PAGO_EXTRA,$MODALIDAD_CVE,$ECC_ANIO_IMPARTIDO,$ECC_DURACION,$EMPLEADO_CVE,$ECC_CURSO,$ECC_FCH_INICIO,$ECC_FCH_FIN,$FECHA_INSERSION,$IS_VALIDO_PROFESIONALIZACION){
		$this->LICENCIATURA_CVE = $LICENCIATURA_CVE;
		$this->ROL_DESEMPENIA_CVE = $ROL_DESEMPENIA_CVE;
		$this->INS_AVALA_CVE = $INS_AVALA_CVE;
		$this->ECC_PAGO_EXTRA = $ECC_PAGO_EXTRA;
		$this->MODALIDAD_CVE = $MODALIDAD_CVE;
		$this->ECC_ANIO_IMPARTIDO = $ECC_ANIO_IMPARTIDO;
		$this->ECC_DURACION = $ECC_DURACION;
		$this->EMPLEADO_CVE = $EMPLEADO_CVE;
		$this->ECC_CURSO = $ECC_CURSO;
		$this->ECC_FCH_INICIO = $ECC_FCH_INICIO;
		$this->ECC_FCH_FIN = $ECC_FCH_FIN;
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
		$result = $this->connection->RunQuery("Select * from emp_ciclos_clinicos where ECC_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->LICENCIATURA_CVE = $row["LICENCIATURA_CVE"];
			$this->ROL_DESEMPENIA_CVE = $row["ROL_DESEMPENIA_CVE"];
			$this->INS_AVALA_CVE = $row["INS_AVALA_CVE"];
			$this->ECC_PAGO_EXTRA = $row["ECC_PAGO_EXTRA"];
			$this->MODALIDAD_CVE = $row["MODALIDAD_CVE"];
			$this->ECC_ANIO_IMPARTIDO = $row["ECC_ANIO_IMPARTIDO"];
			$this->ECC_DURACION = $row["ECC_DURACION"];
			$this->EMPLEADO_CVE = $row["EMPLEADO_CVE"];
			$this->ECC_CURSO = $row["ECC_CURSO"];
			$this->ECC_CVE = $row["ECC_CVE"];
			$this->ECC_FCH_INICIO = $row["ECC_FCH_INICIO"];
			$this->ECC_FCH_FIN = $row["ECC_FCH_FIN"];
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
		$this->connection->RunQuery("DELETE FROM emp_ciclos_clinicos WHERE ECC_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE emp_ciclos_clinicos set LICENCIATURA_CVE = \"$this->LICENCIATURA_CVE\", ROL_DESEMPENIA_CVE = \"$this->ROL_DESEMPENIA_CVE\", INS_AVALA_CVE = \"$this->INS_AVALA_CVE\", ECC_PAGO_EXTRA = \"$this->ECC_PAGO_EXTRA\", MODALIDAD_CVE = \"$this->MODALIDAD_CVE\", ECC_ANIO_IMPARTIDO = \"$this->ECC_ANIO_IMPARTIDO\", ECC_DURACION = \"$this->ECC_DURACION\", EMPLEADO_CVE = \"$this->EMPLEADO_CVE\", ECC_CURSO = \"$this->ECC_CURSO\", ECC_FCH_INICIO = \"$this->ECC_FCH_INICIO\", ECC_FCH_FIN = \"$this->ECC_FCH_FIN\", FECHA_INSERSION = \"$this->FECHA_INSERSION\", IS_VALIDO_PROFESIONALIZACION = \"$this->IS_VALIDO_PROFESIONALIZACION\" where ECC_CVE = \"$this->ECC_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into emp_ciclos_clinicos (LICENCIATURA_CVE, ROL_DESEMPENIA_CVE, INS_AVALA_CVE, ECC_PAGO_EXTRA, MODALIDAD_CVE, ECC_ANIO_IMPARTIDO, ECC_DURACION, EMPLEADO_CVE, ECC_CURSO, ECC_FCH_INICIO, ECC_FCH_FIN, FECHA_INSERSION, IS_VALIDO_PROFESIONALIZACION) values (\"$this->LICENCIATURA_CVE\", \"$this->ROL_DESEMPENIA_CVE\", \"$this->INS_AVALA_CVE\", \"$this->ECC_PAGO_EXTRA\", \"$this->MODALIDAD_CVE\", \"$this->ECC_ANIO_IMPARTIDO\", \"$this->ECC_DURACION\", \"$this->EMPLEADO_CVE\", \"$this->ECC_CURSO\", \"$this->ECC_FCH_INICIO\", \"$this->ECC_FCH_FIN\", \"$this->FECHA_INSERSION\", \"$this->IS_VALIDO_PROFESIONALIZACION\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT ECC_CVE from emp_ciclos_clinicos order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["ECC_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return LICENCIATURA_CVE - int(11)
	 */
	public function getLICENCIATURA_CVE(){
		return $this->LICENCIATURA_CVE;
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
	 * @return ECC_PAGO_EXTRA - varchar(20)
	 */
	public function getECC_PAGO_EXTRA(){
		return $this->ECC_PAGO_EXTRA;
	}

	/**
	 * @return MODALIDAD_CVE - int(11)
	 */
	public function getMODALIDAD_CVE(){
		return $this->MODALIDAD_CVE;
	}

	/**
	 * @return ECC_ANIO_IMPARTIDO - int(11)
	 */
	public function getECC_ANIO_IMPARTIDO(){
		return $this->ECC_ANIO_IMPARTIDO;
	}

	/**
	 * @return ECC_DURACION - varchar(20)
	 */
	public function getECC_DURACION(){
		return $this->ECC_DURACION;
	}

	/**
	 * @return EMPLEADO_CVE - int(11)
	 */
	public function getEMPLEADO_CVE(){
		return $this->EMPLEADO_CVE;
	}

	/**
	 * @return ECC_CURSO - varchar(20)
	 */
	public function getECC_CURSO(){
		return $this->ECC_CURSO;
	}

	/**
	 * @return ECC_CVE - int(11)
	 */
	public function getECC_CVE(){
		return $this->ECC_CVE;
	}

	/**
	 * @return ECC_FCH_INICIO - date
	 */
	public function getECC_FCH_INICIO(){
		return $this->ECC_FCH_INICIO;
	}

	/**
	 * @return ECC_FCH_FIN - date
	 */
	public function getECC_FCH_FIN(){
		return $this->ECC_FCH_FIN;
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
	public function setLICENCIATURA_CVE($LICENCIATURA_CVE){
		$this->LICENCIATURA_CVE = $LICENCIATURA_CVE;
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
	 * @param Type: varchar(20)
	 */
	public function setECC_PAGO_EXTRA($ECC_PAGO_EXTRA){
		$this->ECC_PAGO_EXTRA = $ECC_PAGO_EXTRA;
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
	public function setECC_ANIO_IMPARTIDO($ECC_ANIO_IMPARTIDO){
		$this->ECC_ANIO_IMPARTIDO = $ECC_ANIO_IMPARTIDO;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setECC_DURACION($ECC_DURACION){
		$this->ECC_DURACION = $ECC_DURACION;
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
	public function setECC_CURSO($ECC_CURSO){
		$this->ECC_CURSO = $ECC_CURSO;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setECC_CVE($ECC_CVE){
		$this->ECC_CVE = $ECC_CVE;
	}

	/**
	 * @param Type: date
	 */
	public function setECC_FCH_INICIO($ECC_FCH_INICIO){
		$this->ECC_FCH_INICIO = $ECC_FCH_INICIO;
	}

	/**
	 * @param Type: date
	 */
	public function setECC_FCH_FIN($ECC_FCH_FIN){
		$this->ECC_FCH_FIN = $ECC_FCH_FIN;
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
	public function endemp_ciclos_clinicos(){
		$this->connection->CloseMysql();
	}

}