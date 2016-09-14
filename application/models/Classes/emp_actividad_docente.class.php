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

Class emp_actividad_docente {

	private $EAD_DURACION; //varchar(20)
	private $EAD_FCH_INICIO; //date
	private $EAD_FCH_FIN; //date
	private $MODALIDAD_CVE; //int(11)
	private $LICENCIATURA_CVE; //int(11)
	private $COMPROBANTE_CVE; //int(11)
	private $EAD_EXTRA_INS_AVALA; //int(11)
	private $EAD_CURSO_PRIN_IMPARTE; //varchar(20)
	private $ROL_DESEMPENIA_CVE; //int(11)
	private $TIP_ACT_DOC_CVE; //int(11)
	private $INS_AVALA_CVE; //int(11)
	private $CURSO_CVE; //int(11)
	private $EMP_ACT_DOCENTE_CVE; //int(11)
	private $TIP_MATERIAL_CVE; //int(11)
	private $AREA_CVE; //int(11)
	private $ACT_DOC_GRAL_CVE; //int(11)
	private $MODULO_CVE; //int(11)
	private $EAD_ANIO_CURSO; //int(11)
	private $EAD_NOMBRE_CURSO; //varchar(100)
	private $EAD_NOMBRE_MATERIA_IMPARTIO; //varchar(100)
	private $TIP_FOR_PROF_CVE; //int(10)
	private $FECHA_INSERSION; //timestamp
	private $EMPLEADO_CVE; //int(11)
	private $IS_VALIDO_PROFESIONALIZACION; //tinyint(1)
	private $connection;

	public function emp_actividad_docente(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_emp_actividad_docente($EAD_DURACION,$EAD_FCH_INICIO,$EAD_FCH_FIN,$MODALIDAD_CVE,$LICENCIATURA_CVE,$COMPROBANTE_CVE,$EAD_EXTRA_INS_AVALA,$EAD_CURSO_PRIN_IMPARTE,$ROL_DESEMPENIA_CVE,$TIP_ACT_DOC_CVE,$INS_AVALA_CVE,$CURSO_CVE,$TIP_MATERIAL_CVE,$AREA_CVE,$ACT_DOC_GRAL_CVE,$MODULO_CVE,$EAD_ANIO_CURSO,$EAD_NOMBRE_CURSO,$EAD_NOMBRE_MATERIA_IMPARTIO,$TIP_FOR_PROF_CVE,$FECHA_INSERSION,$EMPLEADO_CVE,$IS_VALIDO_PROFESIONALIZACION){
		$this->EAD_DURACION = $EAD_DURACION;
		$this->EAD_FCH_INICIO = $EAD_FCH_INICIO;
		$this->EAD_FCH_FIN = $EAD_FCH_FIN;
		$this->MODALIDAD_CVE = $MODALIDAD_CVE;
		$this->LICENCIATURA_CVE = $LICENCIATURA_CVE;
		$this->COMPROBANTE_CVE = $COMPROBANTE_CVE;
		$this->EAD_EXTRA_INS_AVALA = $EAD_EXTRA_INS_AVALA;
		$this->EAD_CURSO_PRIN_IMPARTE = $EAD_CURSO_PRIN_IMPARTE;
		$this->ROL_DESEMPENIA_CVE = $ROL_DESEMPENIA_CVE;
		$this->TIP_ACT_DOC_CVE = $TIP_ACT_DOC_CVE;
		$this->INS_AVALA_CVE = $INS_AVALA_CVE;
		$this->CURSO_CVE = $CURSO_CVE;
		$this->TIP_MATERIAL_CVE = $TIP_MATERIAL_CVE;
		$this->AREA_CVE = $AREA_CVE;
		$this->ACT_DOC_GRAL_CVE = $ACT_DOC_GRAL_CVE;
		$this->MODULO_CVE = $MODULO_CVE;
		$this->EAD_ANIO_CURSO = $EAD_ANIO_CURSO;
		$this->EAD_NOMBRE_CURSO = $EAD_NOMBRE_CURSO;
		$this->EAD_NOMBRE_MATERIA_IMPARTIO = $EAD_NOMBRE_MATERIA_IMPARTIO;
		$this->TIP_FOR_PROF_CVE = $TIP_FOR_PROF_CVE;
		$this->FECHA_INSERSION = $FECHA_INSERSION;
		$this->EMPLEADO_CVE = $EMPLEADO_CVE;
		$this->IS_VALIDO_PROFESIONALIZACION = $IS_VALIDO_PROFESIONALIZACION;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from emp_actividad_docente where EMP_ACT_DOCENTE_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->EAD_DURACION = $row["EAD_DURACION"];
			$this->EAD_FCH_INICIO = $row["EAD_FCH_INICIO"];
			$this->EAD_FCH_FIN = $row["EAD_FCH_FIN"];
			$this->MODALIDAD_CVE = $row["MODALIDAD_CVE"];
			$this->LICENCIATURA_CVE = $row["LICENCIATURA_CVE"];
			$this->COMPROBANTE_CVE = $row["COMPROBANTE_CVE"];
			$this->EAD_EXTRA_INS_AVALA = $row["EAD_EXTRA_INS_AVALA"];
			$this->EAD_CURSO_PRIN_IMPARTE = $row["EAD_CURSO_PRIN_IMPARTE"];
			$this->ROL_DESEMPENIA_CVE = $row["ROL_DESEMPENIA_CVE"];
			$this->TIP_ACT_DOC_CVE = $row["TIP_ACT_DOC_CVE"];
			$this->INS_AVALA_CVE = $row["INS_AVALA_CVE"];
			$this->CURSO_CVE = $row["CURSO_CVE"];
			$this->EMP_ACT_DOCENTE_CVE = $row["EMP_ACT_DOCENTE_CVE"];
			$this->TIP_MATERIAL_CVE = $row["TIP_MATERIAL_CVE"];
			$this->AREA_CVE = $row["AREA_CVE"];
			$this->ACT_DOC_GRAL_CVE = $row["ACT_DOC_GRAL_CVE"];
			$this->MODULO_CVE = $row["MODULO_CVE"];
			$this->EAD_ANIO_CURSO = $row["EAD_ANIO_CURSO"];
			$this->EAD_NOMBRE_CURSO = $row["EAD_NOMBRE_CURSO"];
			$this->EAD_NOMBRE_MATERIA_IMPARTIO = $row["EAD_NOMBRE_MATERIA_IMPARTIO"];
			$this->TIP_FOR_PROF_CVE = $row["TIP_FOR_PROF_CVE"];
			$this->FECHA_INSERSION = $row["FECHA_INSERSION"];
			$this->EMPLEADO_CVE = $row["EMPLEADO_CVE"];
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
		$this->connection->RunQuery("DELETE FROM emp_actividad_docente WHERE EMP_ACT_DOCENTE_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE emp_actividad_docente set EAD_DURACION = \"$this->EAD_DURACION\", EAD_FCH_INICIO = \"$this->EAD_FCH_INICIO\", EAD_FCH_FIN = \"$this->EAD_FCH_FIN\", MODALIDAD_CVE = \"$this->MODALIDAD_CVE\", LICENCIATURA_CVE = \"$this->LICENCIATURA_CVE\", COMPROBANTE_CVE = \"$this->COMPROBANTE_CVE\", EAD_EXTRA_INS_AVALA = \"$this->EAD_EXTRA_INS_AVALA\", EAD_CURSO_PRIN_IMPARTE = \"$this->EAD_CURSO_PRIN_IMPARTE\", ROL_DESEMPENIA_CVE = \"$this->ROL_DESEMPENIA_CVE\", TIP_ACT_DOC_CVE = \"$this->TIP_ACT_DOC_CVE\", INS_AVALA_CVE = \"$this->INS_AVALA_CVE\", CURSO_CVE = \"$this->CURSO_CVE\", TIP_MATERIAL_CVE = \"$this->TIP_MATERIAL_CVE\", AREA_CVE = \"$this->AREA_CVE\", ACT_DOC_GRAL_CVE = \"$this->ACT_DOC_GRAL_CVE\", MODULO_CVE = \"$this->MODULO_CVE\", EAD_ANIO_CURSO = \"$this->EAD_ANIO_CURSO\", EAD_NOMBRE_CURSO = \"$this->EAD_NOMBRE_CURSO\", EAD_NOMBRE_MATERIA_IMPARTIO = \"$this->EAD_NOMBRE_MATERIA_IMPARTIO\", TIP_FOR_PROF_CVE = \"$this->TIP_FOR_PROF_CVE\", FECHA_INSERSION = \"$this->FECHA_INSERSION\", EMPLEADO_CVE = \"$this->EMPLEADO_CVE\", IS_VALIDO_PROFESIONALIZACION = \"$this->IS_VALIDO_PROFESIONALIZACION\" where EMP_ACT_DOCENTE_CVE = \"$this->EMP_ACT_DOCENTE_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into emp_actividad_docente (EAD_DURACION, EAD_FCH_INICIO, EAD_FCH_FIN, MODALIDAD_CVE, LICENCIATURA_CVE, COMPROBANTE_CVE, EAD_EXTRA_INS_AVALA, EAD_CURSO_PRIN_IMPARTE, ROL_DESEMPENIA_CVE, TIP_ACT_DOC_CVE, INS_AVALA_CVE, CURSO_CVE, TIP_MATERIAL_CVE, AREA_CVE, ACT_DOC_GRAL_CVE, MODULO_CVE, EAD_ANIO_CURSO, EAD_NOMBRE_CURSO, EAD_NOMBRE_MATERIA_IMPARTIO, TIP_FOR_PROF_CVE, FECHA_INSERSION, EMPLEADO_CVE, IS_VALIDO_PROFESIONALIZACION) values (\"$this->EAD_DURACION\", \"$this->EAD_FCH_INICIO\", \"$this->EAD_FCH_FIN\", \"$this->MODALIDAD_CVE\", \"$this->LICENCIATURA_CVE\", \"$this->COMPROBANTE_CVE\", \"$this->EAD_EXTRA_INS_AVALA\", \"$this->EAD_CURSO_PRIN_IMPARTE\", \"$this->ROL_DESEMPENIA_CVE\", \"$this->TIP_ACT_DOC_CVE\", \"$this->INS_AVALA_CVE\", \"$this->CURSO_CVE\", \"$this->TIP_MATERIAL_CVE\", \"$this->AREA_CVE\", \"$this->ACT_DOC_GRAL_CVE\", \"$this->MODULO_CVE\", \"$this->EAD_ANIO_CURSO\", \"$this->EAD_NOMBRE_CURSO\", \"$this->EAD_NOMBRE_MATERIA_IMPARTIO\", \"$this->TIP_FOR_PROF_CVE\", \"$this->FECHA_INSERSION\", \"$this->EMPLEADO_CVE\", \"$this->IS_VALIDO_PROFESIONALIZACION\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT EMP_ACT_DOCENTE_CVE from emp_actividad_docente order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["EMP_ACT_DOCENTE_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return EAD_DURACION - varchar(20)
	 */
	public function getEAD_DURACION(){
		return $this->EAD_DURACION;
	}

	/**
	 * @return EAD_FCH_INICIO - date
	 */
	public function getEAD_FCH_INICIO(){
		return $this->EAD_FCH_INICIO;
	}

	/**
	 * @return EAD_FCH_FIN - date
	 */
	public function getEAD_FCH_FIN(){
		return $this->EAD_FCH_FIN;
	}

	/**
	 * @return MODALIDAD_CVE - int(11)
	 */
	public function getMODALIDAD_CVE(){
		return $this->MODALIDAD_CVE;
	}

	/**
	 * @return LICENCIATURA_CVE - int(11)
	 */
	public function getLICENCIATURA_CVE(){
		return $this->LICENCIATURA_CVE;
	}

	/**
	 * @return COMPROBANTE_CVE - int(11)
	 */
	public function getCOMPROBANTE_CVE(){
		return $this->COMPROBANTE_CVE;
	}

	/**
	 * @return EAD_EXTRA_INS_AVALA - int(11)
	 */
	public function getEAD_EXTRA_INS_AVALA(){
		return $this->EAD_EXTRA_INS_AVALA;
	}

	/**
	 * @return EAD_CURSO_PRIN_IMPARTE - varchar(20)
	 */
	public function getEAD_CURSO_PRIN_IMPARTE(){
		return $this->EAD_CURSO_PRIN_IMPARTE;
	}

	/**
	 * @return ROL_DESEMPENIA_CVE - int(11)
	 */
	public function getROL_DESEMPENIA_CVE(){
		return $this->ROL_DESEMPENIA_CVE;
	}

	/**
	 * @return TIP_ACT_DOC_CVE - int(11)
	 */
	public function getTIP_ACT_DOC_CVE(){
		return $this->TIP_ACT_DOC_CVE;
	}

	/**
	 * @return INS_AVALA_CVE - int(11)
	 */
	public function getINS_AVALA_CVE(){
		return $this->INS_AVALA_CVE;
	}

	/**
	 * @return CURSO_CVE - int(11)
	 */
	public function getCURSO_CVE(){
		return $this->CURSO_CVE;
	}

	/**
	 * @return EMP_ACT_DOCENTE_CVE - int(11)
	 */
	public function getEMP_ACT_DOCENTE_CVE(){
		return $this->EMP_ACT_DOCENTE_CVE;
	}

	/**
	 * @return TIP_MATERIAL_CVE - int(11)
	 */
	public function getTIP_MATERIAL_CVE(){
		return $this->TIP_MATERIAL_CVE;
	}

	/**
	 * @return AREA_CVE - int(11)
	 */
	public function getAREA_CVE(){
		return $this->AREA_CVE;
	}

	/**
	 * @return ACT_DOC_GRAL_CVE - int(11)
	 */
	public function getACT_DOC_GRAL_CVE(){
		return $this->ACT_DOC_GRAL_CVE;
	}

	/**
	 * @return MODULO_CVE - int(11)
	 */
	public function getMODULO_CVE(){
		return $this->MODULO_CVE;
	}

	/**
	 * @return EAD_ANIO_CURSO - int(11)
	 */
	public function getEAD_ANIO_CURSO(){
		return $this->EAD_ANIO_CURSO;
	}

	/**
	 * @return EAD_NOMBRE_CURSO - varchar(100)
	 */
	public function getEAD_NOMBRE_CURSO(){
		return $this->EAD_NOMBRE_CURSO;
	}

	/**
	 * @return EAD_NOMBRE_MATERIA_IMPARTIO - varchar(100)
	 */
	public function getEAD_NOMBRE_MATERIA_IMPARTIO(){
		return $this->EAD_NOMBRE_MATERIA_IMPARTIO;
	}

	/**
	 * @return TIP_FOR_PROF_CVE - int(10)
	 */
	public function getTIP_FOR_PROF_CVE(){
		return $this->TIP_FOR_PROF_CVE;
	}

	/**
	 * @return FECHA_INSERSION - timestamp
	 */
	public function getFECHA_INSERSION(){
		return $this->FECHA_INSERSION;
	}

	/**
	 * @return EMPLEADO_CVE - int(11)
	 */
	public function getEMPLEADO_CVE(){
		return $this->EMPLEADO_CVE;
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
	public function setEAD_DURACION($EAD_DURACION){
		$this->EAD_DURACION = $EAD_DURACION;
	}

	/**
	 * @param Type: date
	 */
	public function setEAD_FCH_INICIO($EAD_FCH_INICIO){
		$this->EAD_FCH_INICIO = $EAD_FCH_INICIO;
	}

	/**
	 * @param Type: date
	 */
	public function setEAD_FCH_FIN($EAD_FCH_FIN){
		$this->EAD_FCH_FIN = $EAD_FCH_FIN;
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
	public function setLICENCIATURA_CVE($LICENCIATURA_CVE){
		$this->LICENCIATURA_CVE = $LICENCIATURA_CVE;
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
	public function setEAD_EXTRA_INS_AVALA($EAD_EXTRA_INS_AVALA){
		$this->EAD_EXTRA_INS_AVALA = $EAD_EXTRA_INS_AVALA;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setEAD_CURSO_PRIN_IMPARTE($EAD_CURSO_PRIN_IMPARTE){
		$this->EAD_CURSO_PRIN_IMPARTE = $EAD_CURSO_PRIN_IMPARTE;
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
	public function setTIP_ACT_DOC_CVE($TIP_ACT_DOC_CVE){
		$this->TIP_ACT_DOC_CVE = $TIP_ACT_DOC_CVE;
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
	public function setCURSO_CVE($CURSO_CVE){
		$this->CURSO_CVE = $CURSO_CVE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setEMP_ACT_DOCENTE_CVE($EMP_ACT_DOCENTE_CVE){
		$this->EMP_ACT_DOCENTE_CVE = $EMP_ACT_DOCENTE_CVE;
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
	public function setAREA_CVE($AREA_CVE){
		$this->AREA_CVE = $AREA_CVE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setACT_DOC_GRAL_CVE($ACT_DOC_GRAL_CVE){
		$this->ACT_DOC_GRAL_CVE = $ACT_DOC_GRAL_CVE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setMODULO_CVE($MODULO_CVE){
		$this->MODULO_CVE = $MODULO_CVE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setEAD_ANIO_CURSO($EAD_ANIO_CURSO){
		$this->EAD_ANIO_CURSO = $EAD_ANIO_CURSO;
	}

	/**
	 * @param Type: varchar(100)
	 */
	public function setEAD_NOMBRE_CURSO($EAD_NOMBRE_CURSO){
		$this->EAD_NOMBRE_CURSO = $EAD_NOMBRE_CURSO;
	}

	/**
	 * @param Type: varchar(100)
	 */
	public function setEAD_NOMBRE_MATERIA_IMPARTIO($EAD_NOMBRE_MATERIA_IMPARTIO){
		$this->EAD_NOMBRE_MATERIA_IMPARTIO = $EAD_NOMBRE_MATERIA_IMPARTIO;
	}

	/**
	 * @param Type: int(10)
	 */
	public function setTIP_FOR_PROF_CVE($TIP_FOR_PROF_CVE){
		$this->TIP_FOR_PROF_CVE = $TIP_FOR_PROF_CVE;
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
	public function setEMPLEADO_CVE($EMPLEADO_CVE){
		$this->EMPLEADO_CVE = $EMPLEADO_CVE;
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
	public function endemp_actividad_docente(){
		$this->connection->CloseMysql();
	}

}