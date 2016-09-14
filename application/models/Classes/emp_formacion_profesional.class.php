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

Class emp_formacion_profesional {

	private $EFP_DURACION; //varchar(20)
	private $MODALIDAD_CVE; //int(11)
	private $COMPROBANTE_CVE; //int(11)
	private $CLAVE_CURSO; //varchar(50)
	private $INS_AVALA_CVE; //int(11)
	private $EFP_FCH_INICIO; //date
	private $EFP_FCH_FIN; //date
	private $EFP_EXTRA_INS_AVALA; //int(11)
	private $EMPLEADO_CVE; //int(11)
	private $CURSO_CVE; //int(11)
	private $EJE_PRO_CVE; //int(11)
	private $EMP_FORMACION_PROFESIONAL_CVE; //int(11)
	private $LICENCIATURA_CVE; //int(11)
	private $TIP_FOR_PROF_CVE; //int(11)
	private $EFO_ANIO_CURSO; //int(11)
	private $FECHA_INSERSION; //timestamp
	private $SUB_FOR_PRO_CVE; //int(11)
	private $EFP_NOMBRE_CURSO; //varchar(125)
	private $IS_LOADED; //decimal(1,0)
	private $IS_VALIDO_PROFESIONALIZACION; //tinyint(1)
	private $efp_aplica_ecd; //decimal(1,0)
	private $connection;

	public function emp_formacion_profesional(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_emp_formacion_profesional($EFP_DURACION,$MODALIDAD_CVE,$COMPROBANTE_CVE,$CLAVE_CURSO,$INS_AVALA_CVE,$EFP_FCH_INICIO,$EFP_FCH_FIN,$EFP_EXTRA_INS_AVALA,$EMPLEADO_CVE,$CURSO_CVE,$EJE_PRO_CVE,$LICENCIATURA_CVE,$TIP_FOR_PROF_CVE,$EFO_ANIO_CURSO,$FECHA_INSERSION,$SUB_FOR_PRO_CVE,$EFP_NOMBRE_CURSO,$IS_LOADED,$IS_VALIDO_PROFESIONALIZACION,$efp_aplica_ecd){
		$this->EFP_DURACION = $EFP_DURACION;
		$this->MODALIDAD_CVE = $MODALIDAD_CVE;
		$this->COMPROBANTE_CVE = $COMPROBANTE_CVE;
		$this->CLAVE_CURSO = $CLAVE_CURSO;
		$this->INS_AVALA_CVE = $INS_AVALA_CVE;
		$this->EFP_FCH_INICIO = $EFP_FCH_INICIO;
		$this->EFP_FCH_FIN = $EFP_FCH_FIN;
		$this->EFP_EXTRA_INS_AVALA = $EFP_EXTRA_INS_AVALA;
		$this->EMPLEADO_CVE = $EMPLEADO_CVE;
		$this->CURSO_CVE = $CURSO_CVE;
		$this->EJE_PRO_CVE = $EJE_PRO_CVE;
		$this->LICENCIATURA_CVE = $LICENCIATURA_CVE;
		$this->TIP_FOR_PROF_CVE = $TIP_FOR_PROF_CVE;
		$this->EFO_ANIO_CURSO = $EFO_ANIO_CURSO;
		$this->FECHA_INSERSION = $FECHA_INSERSION;
		$this->SUB_FOR_PRO_CVE = $SUB_FOR_PRO_CVE;
		$this->EFP_NOMBRE_CURSO = $EFP_NOMBRE_CURSO;
		$this->IS_LOADED = $IS_LOADED;
		$this->IS_VALIDO_PROFESIONALIZACION = $IS_VALIDO_PROFESIONALIZACION;
		$this->efp_aplica_ecd = $efp_aplica_ecd;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from emp_formacion_profesional where EMP_FORMACION_PROFESIONAL_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->EFP_DURACION = $row["EFP_DURACION"];
			$this->MODALIDAD_CVE = $row["MODALIDAD_CVE"];
			$this->COMPROBANTE_CVE = $row["COMPROBANTE_CVE"];
			$this->CLAVE_CURSO = $row["CLAVE_CURSO"];
			$this->INS_AVALA_CVE = $row["INS_AVALA_CVE"];
			$this->EFP_FCH_INICIO = $row["EFP_FCH_INICIO"];
			$this->EFP_FCH_FIN = $row["EFP_FCH_FIN"];
			$this->EFP_EXTRA_INS_AVALA = $row["EFP_EXTRA_INS_AVALA"];
			$this->EMPLEADO_CVE = $row["EMPLEADO_CVE"];
			$this->CURSO_CVE = $row["CURSO_CVE"];
			$this->EJE_PRO_CVE = $row["EJE_PRO_CVE"];
			$this->EMP_FORMACION_PROFESIONAL_CVE = $row["EMP_FORMACION_PROFESIONAL_CVE"];
			$this->LICENCIATURA_CVE = $row["LICENCIATURA_CVE"];
			$this->TIP_FOR_PROF_CVE = $row["TIP_FOR_PROF_CVE"];
			$this->EFO_ANIO_CURSO = $row["EFO_ANIO_CURSO"];
			$this->FECHA_INSERSION = $row["FECHA_INSERSION"];
			$this->SUB_FOR_PRO_CVE = $row["SUB_FOR_PRO_CVE"];
			$this->EFP_NOMBRE_CURSO = $row["EFP_NOMBRE_CURSO"];
			$this->IS_LOADED = $row["IS_LOADED"];
			$this->IS_VALIDO_PROFESIONALIZACION = $row["IS_VALIDO_PROFESIONALIZACION"];
			$this->efp_aplica_ecd = $row["efp_aplica_ecd"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM emp_formacion_profesional WHERE EMP_FORMACION_PROFESIONAL_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE emp_formacion_profesional set EFP_DURACION = \"$this->EFP_DURACION\", MODALIDAD_CVE = \"$this->MODALIDAD_CVE\", COMPROBANTE_CVE = \"$this->COMPROBANTE_CVE\", CLAVE_CURSO = \"$this->CLAVE_CURSO\", INS_AVALA_CVE = \"$this->INS_AVALA_CVE\", EFP_FCH_INICIO = \"$this->EFP_FCH_INICIO\", EFP_FCH_FIN = \"$this->EFP_FCH_FIN\", EFP_EXTRA_INS_AVALA = \"$this->EFP_EXTRA_INS_AVALA\", EMPLEADO_CVE = \"$this->EMPLEADO_CVE\", CURSO_CVE = \"$this->CURSO_CVE\", EJE_PRO_CVE = \"$this->EJE_PRO_CVE\", LICENCIATURA_CVE = \"$this->LICENCIATURA_CVE\", TIP_FOR_PROF_CVE = \"$this->TIP_FOR_PROF_CVE\", EFO_ANIO_CURSO = \"$this->EFO_ANIO_CURSO\", FECHA_INSERSION = \"$this->FECHA_INSERSION\", SUB_FOR_PRO_CVE = \"$this->SUB_FOR_PRO_CVE\", EFP_NOMBRE_CURSO = \"$this->EFP_NOMBRE_CURSO\", IS_LOADED = \"$this->IS_LOADED\", IS_VALIDO_PROFESIONALIZACION = \"$this->IS_VALIDO_PROFESIONALIZACION\", efp_aplica_ecd = \"$this->efp_aplica_ecd\" where EMP_FORMACION_PROFESIONAL_CVE = \"$this->EMP_FORMACION_PROFESIONAL_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into emp_formacion_profesional (EFP_DURACION, MODALIDAD_CVE, COMPROBANTE_CVE, CLAVE_CURSO, INS_AVALA_CVE, EFP_FCH_INICIO, EFP_FCH_FIN, EFP_EXTRA_INS_AVALA, EMPLEADO_CVE, CURSO_CVE, EJE_PRO_CVE, LICENCIATURA_CVE, TIP_FOR_PROF_CVE, EFO_ANIO_CURSO, FECHA_INSERSION, SUB_FOR_PRO_CVE, EFP_NOMBRE_CURSO, IS_LOADED, IS_VALIDO_PROFESIONALIZACION, efp_aplica_ecd) values (\"$this->EFP_DURACION\", \"$this->MODALIDAD_CVE\", \"$this->COMPROBANTE_CVE\", \"$this->CLAVE_CURSO\", \"$this->INS_AVALA_CVE\", \"$this->EFP_FCH_INICIO\", \"$this->EFP_FCH_FIN\", \"$this->EFP_EXTRA_INS_AVALA\", \"$this->EMPLEADO_CVE\", \"$this->CURSO_CVE\", \"$this->EJE_PRO_CVE\", \"$this->LICENCIATURA_CVE\", \"$this->TIP_FOR_PROF_CVE\", \"$this->EFO_ANIO_CURSO\", \"$this->FECHA_INSERSION\", \"$this->SUB_FOR_PRO_CVE\", \"$this->EFP_NOMBRE_CURSO\", \"$this->IS_LOADED\", \"$this->IS_VALIDO_PROFESIONALIZACION\", \"$this->efp_aplica_ecd\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT EMP_FORMACION_PROFESIONAL_CVE from emp_formacion_profesional order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["EMP_FORMACION_PROFESIONAL_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return EFP_DURACION - varchar(20)
	 */
	public function getEFP_DURACION(){
		return $this->EFP_DURACION;
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
	 * @return CLAVE_CURSO - varchar(50)
	 */
	public function getCLAVE_CURSO(){
		return $this->CLAVE_CURSO;
	}

	/**
	 * @return INS_AVALA_CVE - int(11)
	 */
	public function getINS_AVALA_CVE(){
		return $this->INS_AVALA_CVE;
	}

	/**
	 * @return EFP_FCH_INICIO - date
	 */
	public function getEFP_FCH_INICIO(){
		return $this->EFP_FCH_INICIO;
	}

	/**
	 * @return EFP_FCH_FIN - date
	 */
	public function getEFP_FCH_FIN(){
		return $this->EFP_FCH_FIN;
	}

	/**
	 * @return EFP_EXTRA_INS_AVALA - int(11)
	 */
	public function getEFP_EXTRA_INS_AVALA(){
		return $this->EFP_EXTRA_INS_AVALA;
	}

	/**
	 * @return EMPLEADO_CVE - int(11)
	 */
	public function getEMPLEADO_CVE(){
		return $this->EMPLEADO_CVE;
	}

	/**
	 * @return CURSO_CVE - int(11)
	 */
	public function getCURSO_CVE(){
		return $this->CURSO_CVE;
	}

	/**
	 * @return EJE_PRO_CVE - int(11)
	 */
	public function getEJE_PRO_CVE(){
		return $this->EJE_PRO_CVE;
	}

	/**
	 * @return EMP_FORMACION_PROFESIONAL_CVE - int(11)
	 */
	public function getEMP_FORMACION_PROFESIONAL_CVE(){
		return $this->EMP_FORMACION_PROFESIONAL_CVE;
	}

	/**
	 * @return LICENCIATURA_CVE - int(11)
	 */
	public function getLICENCIATURA_CVE(){
		return $this->LICENCIATURA_CVE;
	}

	/**
	 * @return TIP_FOR_PROF_CVE - int(11)
	 */
	public function getTIP_FOR_PROF_CVE(){
		return $this->TIP_FOR_PROF_CVE;
	}

	/**
	 * @return EFO_ANIO_CURSO - int(11)
	 */
	public function getEFO_ANIO_CURSO(){
		return $this->EFO_ANIO_CURSO;
	}

	/**
	 * @return FECHA_INSERSION - timestamp
	 */
	public function getFECHA_INSERSION(){
		return $this->FECHA_INSERSION;
	}

	/**
	 * @return SUB_FOR_PRO_CVE - int(11)
	 */
	public function getSUB_FOR_PRO_CVE(){
		return $this->SUB_FOR_PRO_CVE;
	}

	/**
	 * @return EFP_NOMBRE_CURSO - varchar(125)
	 */
	public function getEFP_NOMBRE_CURSO(){
		return $this->EFP_NOMBRE_CURSO;
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
	 * @return efp_aplica_ecd - decimal(1,0)
	 */
	public function getefp_aplica_ecd(){
		return $this->efp_aplica_ecd;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setEFP_DURACION($EFP_DURACION){
		$this->EFP_DURACION = $EFP_DURACION;
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
	 * @param Type: varchar(50)
	 */
	public function setCLAVE_CURSO($CLAVE_CURSO){
		$this->CLAVE_CURSO = $CLAVE_CURSO;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setINS_AVALA_CVE($INS_AVALA_CVE){
		$this->INS_AVALA_CVE = $INS_AVALA_CVE;
	}

	/**
	 * @param Type: date
	 */
	public function setEFP_FCH_INICIO($EFP_FCH_INICIO){
		$this->EFP_FCH_INICIO = $EFP_FCH_INICIO;
	}

	/**
	 * @param Type: date
	 */
	public function setEFP_FCH_FIN($EFP_FCH_FIN){
		$this->EFP_FCH_FIN = $EFP_FCH_FIN;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setEFP_EXTRA_INS_AVALA($EFP_EXTRA_INS_AVALA){
		$this->EFP_EXTRA_INS_AVALA = $EFP_EXTRA_INS_AVALA;
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
	public function setCURSO_CVE($CURSO_CVE){
		$this->CURSO_CVE = $CURSO_CVE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setEJE_PRO_CVE($EJE_PRO_CVE){
		$this->EJE_PRO_CVE = $EJE_PRO_CVE;
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
	public function setLICENCIATURA_CVE($LICENCIATURA_CVE){
		$this->LICENCIATURA_CVE = $LICENCIATURA_CVE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTIP_FOR_PROF_CVE($TIP_FOR_PROF_CVE){
		$this->TIP_FOR_PROF_CVE = $TIP_FOR_PROF_CVE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setEFO_ANIO_CURSO($EFO_ANIO_CURSO){
		$this->EFO_ANIO_CURSO = $EFO_ANIO_CURSO;
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
	public function setSUB_FOR_PRO_CVE($SUB_FOR_PRO_CVE){
		$this->SUB_FOR_PRO_CVE = $SUB_FOR_PRO_CVE;
	}

	/**
	 * @param Type: varchar(125)
	 */
	public function setEFP_NOMBRE_CURSO($EFP_NOMBRE_CURSO){
		$this->EFP_NOMBRE_CURSO = $EFP_NOMBRE_CURSO;
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
	 * @param Type: decimal(1,0)
	 */
	public function setefp_aplica_ecd($efp_aplica_ecd){
		$this->efp_aplica_ecd = $efp_aplica_ecd;
	}

    /**
     * Close mysql connection
     */
	public function endemp_formacion_profesional(){
		$this->connection->CloseMysql();
	}

}