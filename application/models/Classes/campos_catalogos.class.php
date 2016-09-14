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

Class campos_catalogos {

	private $MED_DIVULGACION_CVE; //int(11)
	private $CURSO_CVE; //int(11)
	private $TIP_MATERIAL_CVE; //int(11)
	private $MODULO_CVE; //int(11)
	private $LICENCIATURA_CVE; //int(11)
	private $ROL_DESEMPENIA_CVE; //int(11)
	private $connection;

	public function campos_catalogos(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_campos_catalogos($MED_DIVULGACION_CVE,$CURSO_CVE,$TIP_MATERIAL_CVE,$MODULO_CVE,$LICENCIATURA_CVE,$ROL_DESEMPENIA_CVE){
		$this->MED_DIVULGACION_CVE = $MED_DIVULGACION_CVE;
		$this->CURSO_CVE = $CURSO_CVE;
		$this->TIP_MATERIAL_CVE = $TIP_MATERIAL_CVE;
		$this->MODULO_CVE = $MODULO_CVE;
		$this->LICENCIATURA_CVE = $LICENCIATURA_CVE;
		$this->ROL_DESEMPENIA_CVE = $ROL_DESEMPENIA_CVE;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from campos_catalogos where MED_DIVULGACION_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->MED_DIVULGACION_CVE = $row["MED_DIVULGACION_CVE"];
			$this->CURSO_CVE = $row["CURSO_CVE"];
			$this->TIP_MATERIAL_CVE = $row["TIP_MATERIAL_CVE"];
			$this->MODULO_CVE = $row["MODULO_CVE"];
			$this->LICENCIATURA_CVE = $row["LICENCIATURA_CVE"];
			$this->ROL_DESEMPENIA_CVE = $row["ROL_DESEMPENIA_CVE"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM campos_catalogos WHERE MED_DIVULGACION_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE campos_catalogos set MED_DIVULGACION_CVE = \"$this->MED_DIVULGACION_CVE\", CURSO_CVE = \"$this->CURSO_CVE\", TIP_MATERIAL_CVE = \"$this->TIP_MATERIAL_CVE\", MODULO_CVE = \"$this->MODULO_CVE\", LICENCIATURA_CVE = \"$this->LICENCIATURA_CVE\", ROL_DESEMPENIA_CVE = \"$this->ROL_DESEMPENIA_CVE\" where MED_DIVULGACION_CVE = \"$this->MED_DIVULGACION_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into campos_catalogos (MED_DIVULGACION_CVE, CURSO_CVE, TIP_MATERIAL_CVE, MODULO_CVE, LICENCIATURA_CVE, ROL_DESEMPENIA_CVE) values (\"$this->MED_DIVULGACION_CVE\", \"$this->CURSO_CVE\", \"$this->TIP_MATERIAL_CVE\", \"$this->MODULO_CVE\", \"$this->LICENCIATURA_CVE\", \"$this->ROL_DESEMPENIA_CVE\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT MED_DIVULGACION_CVE from campos_catalogos order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["MED_DIVULGACION_CVE"];
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
	 * @return CURSO_CVE - int(11)
	 */
	public function getCURSO_CVE(){
		return $this->CURSO_CVE;
	}

	/**
	 * @return TIP_MATERIAL_CVE - int(11)
	 */
	public function getTIP_MATERIAL_CVE(){
		return $this->TIP_MATERIAL_CVE;
	}

	/**
	 * @return MODULO_CVE - int(11)
	 */
	public function getMODULO_CVE(){
		return $this->MODULO_CVE;
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
	 * @param Type: int(11)
	 */
	public function setMED_DIVULGACION_CVE($MED_DIVULGACION_CVE){
		$this->MED_DIVULGACION_CVE = $MED_DIVULGACION_CVE;
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
	public function setTIP_MATERIAL_CVE($TIP_MATERIAL_CVE){
		$this->TIP_MATERIAL_CVE = $TIP_MATERIAL_CVE;
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
     * Close mysql connection
     */
	public function endcampos_catalogos(){
		$this->connection->CloseMysql();
	}

}