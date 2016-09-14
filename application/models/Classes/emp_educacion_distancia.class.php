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

Class emp_educacion_distancia {

	private $EED_DURACION; //varchar(20)
	private $EMPLEADO_CVE; //int(11)
	private $ROL_DESEMPENIA_CVE; //int(11)
	private $EED_FCH_FIN; //date
	private $EMP_EDU_DISTANCIA_CVE; //int(11)
	private $COMPROBANTE_CVE; //int(11)
	private $EDD_FCH_INICIO; //date
	private $EDD_CUR_ANIO; //int(11)
	private $EDD_CUR_PUN_ROL; //int(11)
	private $EDD_CUR_PUN_ALCANCE; //int(11)
	private $EDD_PUN_DURACION; //int(11)
	private $EDD_CUR_SUM_TOT_ACT; //int(11)
	private $EDD_CUR_PROM_EVALUACIONES; //int(11)
	private $TIP_ACT_DOC_CVE; //int(11)
	private $FOLIO_CONSTANCIA; //varchar(35)
	private $TIPO_CURSO_CVE; //int(11)
	private $EED_NOMBRE_CURSO; //varchar(100)
	private $ACT_DOC_GRAL_CVE; //int(10)
	private $FECHA_INSERSION; //timestamp
	private $IS_CURSO_TUTURIZADO; //tinyint(1)
	private $IS_LOADED; //decimal(1,0)
	private $IS_VALIDO_PROFESIONALIZACION; //tinyint(1)
	private $CURSO_CVE; //int(11)
	private $connection;

	public function emp_educacion_distancia(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_emp_educacion_distancia($EED_DURACION,$EMPLEADO_CVE,$ROL_DESEMPENIA_CVE,$EED_FCH_FIN,$COMPROBANTE_CVE,$EDD_FCH_INICIO,$EDD_CUR_ANIO,$EDD_CUR_PUN_ROL,$EDD_CUR_PUN_ALCANCE,$EDD_PUN_DURACION,$EDD_CUR_SUM_TOT_ACT,$EDD_CUR_PROM_EVALUACIONES,$TIP_ACT_DOC_CVE,$FOLIO_CONSTANCIA,$TIPO_CURSO_CVE,$EED_NOMBRE_CURSO,$ACT_DOC_GRAL_CVE,$FECHA_INSERSION,$IS_CURSO_TUTURIZADO,$IS_LOADED,$IS_VALIDO_PROFESIONALIZACION,$CURSO_CVE){
		$this->EED_DURACION = $EED_DURACION;
		$this->EMPLEADO_CVE = $EMPLEADO_CVE;
		$this->ROL_DESEMPENIA_CVE = $ROL_DESEMPENIA_CVE;
		$this->EED_FCH_FIN = $EED_FCH_FIN;
		$this->COMPROBANTE_CVE = $COMPROBANTE_CVE;
		$this->EDD_FCH_INICIO = $EDD_FCH_INICIO;
		$this->EDD_CUR_ANIO = $EDD_CUR_ANIO;
		$this->EDD_CUR_PUN_ROL = $EDD_CUR_PUN_ROL;
		$this->EDD_CUR_PUN_ALCANCE = $EDD_CUR_PUN_ALCANCE;
		$this->EDD_PUN_DURACION = $EDD_PUN_DURACION;
		$this->EDD_CUR_SUM_TOT_ACT = $EDD_CUR_SUM_TOT_ACT;
		$this->EDD_CUR_PROM_EVALUACIONES = $EDD_CUR_PROM_EVALUACIONES;
		$this->TIP_ACT_DOC_CVE = $TIP_ACT_DOC_CVE;
		$this->FOLIO_CONSTANCIA = $FOLIO_CONSTANCIA;
		$this->TIPO_CURSO_CVE = $TIPO_CURSO_CVE;
		$this->EED_NOMBRE_CURSO = $EED_NOMBRE_CURSO;
		$this->ACT_DOC_GRAL_CVE = $ACT_DOC_GRAL_CVE;
		$this->FECHA_INSERSION = $FECHA_INSERSION;
		$this->IS_CURSO_TUTURIZADO = $IS_CURSO_TUTURIZADO;
		$this->IS_LOADED = $IS_LOADED;
		$this->IS_VALIDO_PROFESIONALIZACION = $IS_VALIDO_PROFESIONALIZACION;
		$this->CURSO_CVE = $CURSO_CVE;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from emp_educacion_distancia where EMP_EDU_DISTANCIA_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->EED_DURACION = $row["EED_DURACION"];
			$this->EMPLEADO_CVE = $row["EMPLEADO_CVE"];
			$this->ROL_DESEMPENIA_CVE = $row["ROL_DESEMPENIA_CVE"];
			$this->EED_FCH_FIN = $row["EED_FCH_FIN"];
			$this->EMP_EDU_DISTANCIA_CVE = $row["EMP_EDU_DISTANCIA_CVE"];
			$this->COMPROBANTE_CVE = $row["COMPROBANTE_CVE"];
			$this->EDD_FCH_INICIO = $row["EDD_FCH_INICIO"];
			$this->EDD_CUR_ANIO = $row["EDD_CUR_ANIO"];
			$this->EDD_CUR_PUN_ROL = $row["EDD_CUR_PUN_ROL"];
			$this->EDD_CUR_PUN_ALCANCE = $row["EDD_CUR_PUN_ALCANCE"];
			$this->EDD_PUN_DURACION = $row["EDD_PUN_DURACION"];
			$this->EDD_CUR_SUM_TOT_ACT = $row["EDD_CUR_SUM_TOT_ACT"];
			$this->EDD_CUR_PROM_EVALUACIONES = $row["EDD_CUR_PROM_EVALUACIONES"];
			$this->TIP_ACT_DOC_CVE = $row["TIP_ACT_DOC_CVE"];
			$this->FOLIO_CONSTANCIA = $row["FOLIO_CONSTANCIA"];
			$this->TIPO_CURSO_CVE = $row["TIPO_CURSO_CVE"];
			$this->EED_NOMBRE_CURSO = $row["EED_NOMBRE_CURSO"];
			$this->ACT_DOC_GRAL_CVE = $row["ACT_DOC_GRAL_CVE"];
			$this->FECHA_INSERSION = $row["FECHA_INSERSION"];
			$this->IS_CURSO_TUTURIZADO = $row["IS_CURSO_TUTURIZADO"];
			$this->IS_LOADED = $row["IS_LOADED"];
			$this->IS_VALIDO_PROFESIONALIZACION = $row["IS_VALIDO_PROFESIONALIZACION"];
			$this->CURSO_CVE = $row["CURSO_CVE"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM emp_educacion_distancia WHERE EMP_EDU_DISTANCIA_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE emp_educacion_distancia set EED_DURACION = \"$this->EED_DURACION\", EMPLEADO_CVE = \"$this->EMPLEADO_CVE\", ROL_DESEMPENIA_CVE = \"$this->ROL_DESEMPENIA_CVE\", EED_FCH_FIN = \"$this->EED_FCH_FIN\", COMPROBANTE_CVE = \"$this->COMPROBANTE_CVE\", EDD_FCH_INICIO = \"$this->EDD_FCH_INICIO\", EDD_CUR_ANIO = \"$this->EDD_CUR_ANIO\", EDD_CUR_PUN_ROL = \"$this->EDD_CUR_PUN_ROL\", EDD_CUR_PUN_ALCANCE = \"$this->EDD_CUR_PUN_ALCANCE\", EDD_PUN_DURACION = \"$this->EDD_PUN_DURACION\", EDD_CUR_SUM_TOT_ACT = \"$this->EDD_CUR_SUM_TOT_ACT\", EDD_CUR_PROM_EVALUACIONES = \"$this->EDD_CUR_PROM_EVALUACIONES\", TIP_ACT_DOC_CVE = \"$this->TIP_ACT_DOC_CVE\", FOLIO_CONSTANCIA = \"$this->FOLIO_CONSTANCIA\", TIPO_CURSO_CVE = \"$this->TIPO_CURSO_CVE\", EED_NOMBRE_CURSO = \"$this->EED_NOMBRE_CURSO\", ACT_DOC_GRAL_CVE = \"$this->ACT_DOC_GRAL_CVE\", FECHA_INSERSION = \"$this->FECHA_INSERSION\", IS_CURSO_TUTURIZADO = \"$this->IS_CURSO_TUTURIZADO\", IS_LOADED = \"$this->IS_LOADED\", IS_VALIDO_PROFESIONALIZACION = \"$this->IS_VALIDO_PROFESIONALIZACION\", CURSO_CVE = \"$this->CURSO_CVE\" where EMP_EDU_DISTANCIA_CVE = \"$this->EMP_EDU_DISTANCIA_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into emp_educacion_distancia (EED_DURACION, EMPLEADO_CVE, ROL_DESEMPENIA_CVE, EED_FCH_FIN, COMPROBANTE_CVE, EDD_FCH_INICIO, EDD_CUR_ANIO, EDD_CUR_PUN_ROL, EDD_CUR_PUN_ALCANCE, EDD_PUN_DURACION, EDD_CUR_SUM_TOT_ACT, EDD_CUR_PROM_EVALUACIONES, TIP_ACT_DOC_CVE, FOLIO_CONSTANCIA, TIPO_CURSO_CVE, EED_NOMBRE_CURSO, ACT_DOC_GRAL_CVE, FECHA_INSERSION, IS_CURSO_TUTURIZADO, IS_LOADED, IS_VALIDO_PROFESIONALIZACION, CURSO_CVE) values (\"$this->EED_DURACION\", \"$this->EMPLEADO_CVE\", \"$this->ROL_DESEMPENIA_CVE\", \"$this->EED_FCH_FIN\", \"$this->COMPROBANTE_CVE\", \"$this->EDD_FCH_INICIO\", \"$this->EDD_CUR_ANIO\", \"$this->EDD_CUR_PUN_ROL\", \"$this->EDD_CUR_PUN_ALCANCE\", \"$this->EDD_PUN_DURACION\", \"$this->EDD_CUR_SUM_TOT_ACT\", \"$this->EDD_CUR_PROM_EVALUACIONES\", \"$this->TIP_ACT_DOC_CVE\", \"$this->FOLIO_CONSTANCIA\", \"$this->TIPO_CURSO_CVE\", \"$this->EED_NOMBRE_CURSO\", \"$this->ACT_DOC_GRAL_CVE\", \"$this->FECHA_INSERSION\", \"$this->IS_CURSO_TUTURIZADO\", \"$this->IS_LOADED\", \"$this->IS_VALIDO_PROFESIONALIZACION\", \"$this->CURSO_CVE\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT EMP_EDU_DISTANCIA_CVE from emp_educacion_distancia order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["EMP_EDU_DISTANCIA_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return EED_DURACION - varchar(20)
	 */
	public function getEED_DURACION(){
		return $this->EED_DURACION;
	}

	/**
	 * @return EMPLEADO_CVE - int(11)
	 */
	public function getEMPLEADO_CVE(){
		return $this->EMPLEADO_CVE;
	}

	/**
	 * @return ROL_DESEMPENIA_CVE - int(11)
	 */
	public function getROL_DESEMPENIA_CVE(){
		return $this->ROL_DESEMPENIA_CVE;
	}

	/**
	 * @return EED_FCH_FIN - date
	 */
	public function getEED_FCH_FIN(){
		return $this->EED_FCH_FIN;
	}

	/**
	 * @return EMP_EDU_DISTANCIA_CVE - int(11)
	 */
	public function getEMP_EDU_DISTANCIA_CVE(){
		return $this->EMP_EDU_DISTANCIA_CVE;
	}

	/**
	 * @return COMPROBANTE_CVE - int(11)
	 */
	public function getCOMPROBANTE_CVE(){
		return $this->COMPROBANTE_CVE;
	}

	/**
	 * @return EDD_FCH_INICIO - date
	 */
	public function getEDD_FCH_INICIO(){
		return $this->EDD_FCH_INICIO;
	}

	/**
	 * @return EDD_CUR_ANIO - int(11)
	 */
	public function getEDD_CUR_ANIO(){
		return $this->EDD_CUR_ANIO;
	}

	/**
	 * @return EDD_CUR_PUN_ROL - int(11)
	 */
	public function getEDD_CUR_PUN_ROL(){
		return $this->EDD_CUR_PUN_ROL;
	}

	/**
	 * @return EDD_CUR_PUN_ALCANCE - int(11)
	 */
	public function getEDD_CUR_PUN_ALCANCE(){
		return $this->EDD_CUR_PUN_ALCANCE;
	}

	/**
	 * @return EDD_PUN_DURACION - int(11)
	 */
	public function getEDD_PUN_DURACION(){
		return $this->EDD_PUN_DURACION;
	}

	/**
	 * @return EDD_CUR_SUM_TOT_ACT - int(11)
	 */
	public function getEDD_CUR_SUM_TOT_ACT(){
		return $this->EDD_CUR_SUM_TOT_ACT;
	}

	/**
	 * @return EDD_CUR_PROM_EVALUACIONES - int(11)
	 */
	public function getEDD_CUR_PROM_EVALUACIONES(){
		return $this->EDD_CUR_PROM_EVALUACIONES;
	}

	/**
	 * @return TIP_ACT_DOC_CVE - int(11)
	 */
	public function getTIP_ACT_DOC_CVE(){
		return $this->TIP_ACT_DOC_CVE;
	}

	/**
	 * @return FOLIO_CONSTANCIA - varchar(35)
	 */
	public function getFOLIO_CONSTANCIA(){
		return $this->FOLIO_CONSTANCIA;
	}

	/**
	 * @return TIPO_CURSO_CVE - int(11)
	 */
	public function getTIPO_CURSO_CVE(){
		return $this->TIPO_CURSO_CVE;
	}

	/**
	 * @return EED_NOMBRE_CURSO - varchar(100)
	 */
	public function getEED_NOMBRE_CURSO(){
		return $this->EED_NOMBRE_CURSO;
	}

	/**
	 * @return ACT_DOC_GRAL_CVE - int(10)
	 */
	public function getACT_DOC_GRAL_CVE(){
		return $this->ACT_DOC_GRAL_CVE;
	}

	/**
	 * @return FECHA_INSERSION - timestamp
	 */
	public function getFECHA_INSERSION(){
		return $this->FECHA_INSERSION;
	}

	/**
	 * @return IS_CURSO_TUTURIZADO - tinyint(1)
	 */
	public function getIS_CURSO_TUTURIZADO(){
		return $this->IS_CURSO_TUTURIZADO;
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
	 * @return CURSO_CVE - int(11)
	 */
	public function getCURSO_CVE(){
		return $this->CURSO_CVE;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setEED_DURACION($EED_DURACION){
		$this->EED_DURACION = $EED_DURACION;
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
	public function setROL_DESEMPENIA_CVE($ROL_DESEMPENIA_CVE){
		$this->ROL_DESEMPENIA_CVE = $ROL_DESEMPENIA_CVE;
	}

	/**
	 * @param Type: date
	 */
	public function setEED_FCH_FIN($EED_FCH_FIN){
		$this->EED_FCH_FIN = $EED_FCH_FIN;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setEMP_EDU_DISTANCIA_CVE($EMP_EDU_DISTANCIA_CVE){
		$this->EMP_EDU_DISTANCIA_CVE = $EMP_EDU_DISTANCIA_CVE;
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
	public function setEDD_FCH_INICIO($EDD_FCH_INICIO){
		$this->EDD_FCH_INICIO = $EDD_FCH_INICIO;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setEDD_CUR_ANIO($EDD_CUR_ANIO){
		$this->EDD_CUR_ANIO = $EDD_CUR_ANIO;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setEDD_CUR_PUN_ROL($EDD_CUR_PUN_ROL){
		$this->EDD_CUR_PUN_ROL = $EDD_CUR_PUN_ROL;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setEDD_CUR_PUN_ALCANCE($EDD_CUR_PUN_ALCANCE){
		$this->EDD_CUR_PUN_ALCANCE = $EDD_CUR_PUN_ALCANCE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setEDD_PUN_DURACION($EDD_PUN_DURACION){
		$this->EDD_PUN_DURACION = $EDD_PUN_DURACION;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setEDD_CUR_SUM_TOT_ACT($EDD_CUR_SUM_TOT_ACT){
		$this->EDD_CUR_SUM_TOT_ACT = $EDD_CUR_SUM_TOT_ACT;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setEDD_CUR_PROM_EVALUACIONES($EDD_CUR_PROM_EVALUACIONES){
		$this->EDD_CUR_PROM_EVALUACIONES = $EDD_CUR_PROM_EVALUACIONES;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTIP_ACT_DOC_CVE($TIP_ACT_DOC_CVE){
		$this->TIP_ACT_DOC_CVE = $TIP_ACT_DOC_CVE;
	}

	/**
	 * @param Type: varchar(35)
	 */
	public function setFOLIO_CONSTANCIA($FOLIO_CONSTANCIA){
		$this->FOLIO_CONSTANCIA = $FOLIO_CONSTANCIA;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTIPO_CURSO_CVE($TIPO_CURSO_CVE){
		$this->TIPO_CURSO_CVE = $TIPO_CURSO_CVE;
	}

	/**
	 * @param Type: varchar(100)
	 */
	public function setEED_NOMBRE_CURSO($EED_NOMBRE_CURSO){
		$this->EED_NOMBRE_CURSO = $EED_NOMBRE_CURSO;
	}

	/**
	 * @param Type: int(10)
	 */
	public function setACT_DOC_GRAL_CVE($ACT_DOC_GRAL_CVE){
		$this->ACT_DOC_GRAL_CVE = $ACT_DOC_GRAL_CVE;
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
	public function setIS_CURSO_TUTURIZADO($IS_CURSO_TUTURIZADO){
		$this->IS_CURSO_TUTURIZADO = $IS_CURSO_TUTURIZADO;
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
	 * @param Type: int(11)
	 */
	public function setCURSO_CVE($CURSO_CVE){
		$this->CURSO_CVE = $CURSO_CVE;
	}

    /**
     * Close mysql connection
     */
	public function endemp_educacion_distancia(){
		$this->connection->CloseMysql();
	}

}