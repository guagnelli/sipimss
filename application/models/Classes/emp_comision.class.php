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

Class emp_comision {

	private $EC_DURACION; //varchar(20)
	private $EMPLEADO_CVE; //int(11)
	private $TIP_COMISION_CVE; //int(11)
	private $COMPROBANTE_CVE; //int(11)
	private $EC_ANIO; //int(11)
	private $COM_AREA_CVE; //int(11)
	private $SIN_EXA_ANIO; //int(11)
	private $NIV_ACADEMICO_CVE; //int(11)
	private $EMP_COMISION_CVE; //int(11)
	private $EC_FCH_INICIO; //date
	private $EC_FCH_FIN; //date
	private $FECHA_INSERSION; //timestamp
	private $TIP_CURSO_CVE; //int(11)
	private $CURSO_CVE; //int(11)
	private $IS_VALIDO_PROFESIONALIZACION; //tinyint(1)
	private $connection;

	public function emp_comision(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_emp_comision($EC_DURACION,$EMPLEADO_CVE,$TIP_COMISION_CVE,$COMPROBANTE_CVE,$EC_ANIO,$COM_AREA_CVE,$SIN_EXA_ANIO,$NIV_ACADEMICO_CVE,$EC_FCH_INICIO,$EC_FCH_FIN,$FECHA_INSERSION,$TIP_CURSO_CVE,$CURSO_CVE,$IS_VALIDO_PROFESIONALIZACION){
		$this->EC_DURACION = $EC_DURACION;
		$this->EMPLEADO_CVE = $EMPLEADO_CVE;
		$this->TIP_COMISION_CVE = $TIP_COMISION_CVE;
		$this->COMPROBANTE_CVE = $COMPROBANTE_CVE;
		$this->EC_ANIO = $EC_ANIO;
		$this->COM_AREA_CVE = $COM_AREA_CVE;
		$this->SIN_EXA_ANIO = $SIN_EXA_ANIO;
		$this->NIV_ACADEMICO_CVE = $NIV_ACADEMICO_CVE;
		$this->EC_FCH_INICIO = $EC_FCH_INICIO;
		$this->EC_FCH_FIN = $EC_FCH_FIN;
		$this->FECHA_INSERSION = $FECHA_INSERSION;
		$this->TIP_CURSO_CVE = $TIP_CURSO_CVE;
		$this->CURSO_CVE = $CURSO_CVE;
		$this->IS_VALIDO_PROFESIONALIZACION = $IS_VALIDO_PROFESIONALIZACION;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from emp_comision where EMP_COMISION_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->EC_DURACION = $row["EC_DURACION"];
			$this->EMPLEADO_CVE = $row["EMPLEADO_CVE"];
			$this->TIP_COMISION_CVE = $row["TIP_COMISION_CVE"];
			$this->COMPROBANTE_CVE = $row["COMPROBANTE_CVE"];
			$this->EC_ANIO = $row["EC_ANIO"];
			$this->COM_AREA_CVE = $row["COM_AREA_CVE"];
			$this->SIN_EXA_ANIO = $row["SIN_EXA_ANIO"];
			$this->NIV_ACADEMICO_CVE = $row["NIV_ACADEMICO_CVE"];
			$this->EMP_COMISION_CVE = $row["EMP_COMISION_CVE"];
			$this->EC_FCH_INICIO = $row["EC_FCH_INICIO"];
			$this->EC_FCH_FIN = $row["EC_FCH_FIN"];
			$this->FECHA_INSERSION = $row["FECHA_INSERSION"];
			$this->TIP_CURSO_CVE = $row["TIP_CURSO_CVE"];
			$this->CURSO_CVE = $row["CURSO_CVE"];
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
		$this->connection->RunQuery("DELETE FROM emp_comision WHERE EMP_COMISION_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE emp_comision set EC_DURACION = \"$this->EC_DURACION\", EMPLEADO_CVE = \"$this->EMPLEADO_CVE\", TIP_COMISION_CVE = \"$this->TIP_COMISION_CVE\", COMPROBANTE_CVE = \"$this->COMPROBANTE_CVE\", EC_ANIO = \"$this->EC_ANIO\", COM_AREA_CVE = \"$this->COM_AREA_CVE\", SIN_EXA_ANIO = \"$this->SIN_EXA_ANIO\", NIV_ACADEMICO_CVE = \"$this->NIV_ACADEMICO_CVE\", EC_FCH_INICIO = \"$this->EC_FCH_INICIO\", EC_FCH_FIN = \"$this->EC_FCH_FIN\", FECHA_INSERSION = \"$this->FECHA_INSERSION\", TIP_CURSO_CVE = \"$this->TIP_CURSO_CVE\", CURSO_CVE = \"$this->CURSO_CVE\", IS_VALIDO_PROFESIONALIZACION = \"$this->IS_VALIDO_PROFESIONALIZACION\" where EMP_COMISION_CVE = \"$this->EMP_COMISION_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into emp_comision (EC_DURACION, EMPLEADO_CVE, TIP_COMISION_CVE, COMPROBANTE_CVE, EC_ANIO, COM_AREA_CVE, SIN_EXA_ANIO, NIV_ACADEMICO_CVE, EC_FCH_INICIO, EC_FCH_FIN, FECHA_INSERSION, TIP_CURSO_CVE, CURSO_CVE, IS_VALIDO_PROFESIONALIZACION) values (\"$this->EC_DURACION\", \"$this->EMPLEADO_CVE\", \"$this->TIP_COMISION_CVE\", \"$this->COMPROBANTE_CVE\", \"$this->EC_ANIO\", \"$this->COM_AREA_CVE\", \"$this->SIN_EXA_ANIO\", \"$this->NIV_ACADEMICO_CVE\", \"$this->EC_FCH_INICIO\", \"$this->EC_FCH_FIN\", \"$this->FECHA_INSERSION\", \"$this->TIP_CURSO_CVE\", \"$this->CURSO_CVE\", \"$this->IS_VALIDO_PROFESIONALIZACION\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT EMP_COMISION_CVE from emp_comision order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["EMP_COMISION_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return EC_DURACION - varchar(20)
	 */
	public function getEC_DURACION(){
		return $this->EC_DURACION;
	}

	/**
	 * @return EMPLEADO_CVE - int(11)
	 */
	public function getEMPLEADO_CVE(){
		return $this->EMPLEADO_CVE;
	}

	/**
	 * @return TIP_COMISION_CVE - int(11)
	 */
	public function getTIP_COMISION_CVE(){
		return $this->TIP_COMISION_CVE;
	}

	/**
	 * @return COMPROBANTE_CVE - int(11)
	 */
	public function getCOMPROBANTE_CVE(){
		return $this->COMPROBANTE_CVE;
	}

	/**
	 * @return EC_ANIO - int(11)
	 */
	public function getEC_ANIO(){
		return $this->EC_ANIO;
	}

	/**
	 * @return COM_AREA_CVE - int(11)
	 */
	public function getCOM_AREA_CVE(){
		return $this->COM_AREA_CVE;
	}

	/**
	 * @return SIN_EXA_ANIO - int(11)
	 */
	public function getSIN_EXA_ANIO(){
		return $this->SIN_EXA_ANIO;
	}

	/**
	 * @return NIV_ACADEMICO_CVE - int(11)
	 */
	public function getNIV_ACADEMICO_CVE(){
		return $this->NIV_ACADEMICO_CVE;
	}

	/**
	 * @return EMP_COMISION_CVE - int(11)
	 */
	public function getEMP_COMISION_CVE(){
		return $this->EMP_COMISION_CVE;
	}

	/**
	 * @return EC_FCH_INICIO - date
	 */
	public function getEC_FCH_INICIO(){
		return $this->EC_FCH_INICIO;
	}

	/**
	 * @return EC_FCH_FIN - date
	 */
	public function getEC_FCH_FIN(){
		return $this->EC_FCH_FIN;
	}

	/**
	 * @return FECHA_INSERSION - timestamp
	 */
	public function getFECHA_INSERSION(){
		return $this->FECHA_INSERSION;
	}

	/**
	 * @return TIP_CURSO_CVE - int(11)
	 */
	public function getTIP_CURSO_CVE(){
		return $this->TIP_CURSO_CVE;
	}

	/**
	 * @return CURSO_CVE - int(11)
	 */
	public function getCURSO_CVE(){
		return $this->CURSO_CVE;
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
	public function setEC_DURACION($EC_DURACION){
		$this->EC_DURACION = $EC_DURACION;
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
	public function setTIP_COMISION_CVE($TIP_COMISION_CVE){
		$this->TIP_COMISION_CVE = $TIP_COMISION_CVE;
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
	public function setEC_ANIO($EC_ANIO){
		$this->EC_ANIO = $EC_ANIO;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setCOM_AREA_CVE($COM_AREA_CVE){
		$this->COM_AREA_CVE = $COM_AREA_CVE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setSIN_EXA_ANIO($SIN_EXA_ANIO){
		$this->SIN_EXA_ANIO = $SIN_EXA_ANIO;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setNIV_ACADEMICO_CVE($NIV_ACADEMICO_CVE){
		$this->NIV_ACADEMICO_CVE = $NIV_ACADEMICO_CVE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setEMP_COMISION_CVE($EMP_COMISION_CVE){
		$this->EMP_COMISION_CVE = $EMP_COMISION_CVE;
	}

	/**
	 * @param Type: date
	 */
	public function setEC_FCH_INICIO($EC_FCH_INICIO){
		$this->EC_FCH_INICIO = $EC_FCH_INICIO;
	}

	/**
	 * @param Type: date
	 */
	public function setEC_FCH_FIN($EC_FCH_FIN){
		$this->EC_FCH_FIN = $EC_FCH_FIN;
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
	public function setTIP_CURSO_CVE($TIP_CURSO_CVE){
		$this->TIP_CURSO_CVE = $TIP_CURSO_CVE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setCURSO_CVE($CURSO_CVE){
		$this->CURSO_CVE = $CURSO_CVE;
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
	public function endemp_comision(){
		$this->connection->CloseMysql();
	}

}