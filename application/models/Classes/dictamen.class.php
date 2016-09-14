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

Class dictamen {

	private $MSG_INCONFORMIDAD; //varchar(200)
	private $FCH_DICTAMEN; //date
	private $FCH_VIGENCIA_INICIO; //date
	private $FCH_VIGENCIA_FIN; //date
	private $FCH_INCONFOR_FIN; //date
	private $CATEGORIA_CVE; //int(11)
	private $ESTADO_DICTAMEN_CVE; //int(11)
	private $EMPLEADO_CVE; //int(11)
	private $DICTAMEN_CVE; //int(11)
	private $connection;

	public function dictamen(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_dictamen($MSG_INCONFORMIDAD,$FCH_DICTAMEN,$FCH_VIGENCIA_INICIO,$FCH_VIGENCIA_FIN,$FCH_INCONFOR_FIN,$CATEGORIA_CVE,$ESTADO_DICTAMEN_CVE,$EMPLEADO_CVE,){
		$this->MSG_INCONFORMIDAD = $MSG_INCONFORMIDAD;
		$this->FCH_DICTAMEN = $FCH_DICTAMEN;
		$this->FCH_VIGENCIA_INICIO = $FCH_VIGENCIA_INICIO;
		$this->FCH_VIGENCIA_FIN = $FCH_VIGENCIA_FIN;
		$this->FCH_INCONFOR_FIN = $FCH_INCONFOR_FIN;
		$this->CATEGORIA_CVE = $CATEGORIA_CVE;
		$this->ESTADO_DICTAMEN_CVE = $ESTADO_DICTAMEN_CVE;
		$this->EMPLEADO_CVE = $EMPLEADO_CVE;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from dictamen where DICTAMEN_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->MSG_INCONFORMIDAD = $row["MSG_INCONFORMIDAD"];
			$this->FCH_DICTAMEN = $row["FCH_DICTAMEN"];
			$this->FCH_VIGENCIA_INICIO = $row["FCH_VIGENCIA_INICIO"];
			$this->FCH_VIGENCIA_FIN = $row["FCH_VIGENCIA_FIN"];
			$this->FCH_INCONFOR_FIN = $row["FCH_INCONFOR_FIN"];
			$this->CATEGORIA_CVE = $row["CATEGORIA_CVE"];
			$this->ESTADO_DICTAMEN_CVE = $row["ESTADO_DICTAMEN_CVE"];
			$this->EMPLEADO_CVE = $row["EMPLEADO_CVE"];
			$this->DICTAMEN_CVE = $row["DICTAMEN_CVE"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM dictamen WHERE DICTAMEN_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE dictamen set MSG_INCONFORMIDAD = \"$this->MSG_INCONFORMIDAD\", FCH_DICTAMEN = \"$this->FCH_DICTAMEN\", FCH_VIGENCIA_INICIO = \"$this->FCH_VIGENCIA_INICIO\", FCH_VIGENCIA_FIN = \"$this->FCH_VIGENCIA_FIN\", FCH_INCONFOR_FIN = \"$this->FCH_INCONFOR_FIN\", CATEGORIA_CVE = \"$this->CATEGORIA_CVE\", ESTADO_DICTAMEN_CVE = \"$this->ESTADO_DICTAMEN_CVE\", EMPLEADO_CVE = \"$this->EMPLEADO_CVE\",  where DICTAMEN_CVE = \"$this->DICTAMEN_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into dictamen (MSG_INCONFORMIDAD, FCH_DICTAMEN, FCH_VIGENCIA_INICIO, FCH_VIGENCIA_FIN, FCH_INCONFOR_FIN, CATEGORIA_CVE, ESTADO_DICTAMEN_CVE, EMPLEADO_CVE, ) values (\"$this->MSG_INCONFORMIDAD\", \"$this->FCH_DICTAMEN\", \"$this->FCH_VIGENCIA_INICIO\", \"$this->FCH_VIGENCIA_FIN\", \"$this->FCH_INCONFOR_FIN\", \"$this->CATEGORIA_CVE\", \"$this->ESTADO_DICTAMEN_CVE\", \"$this->EMPLEADO_CVE\", )");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT DICTAMEN_CVE from dictamen order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["DICTAMEN_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return MSG_INCONFORMIDAD - varchar(200)
	 */
	public function getMSG_INCONFORMIDAD(){
		return $this->MSG_INCONFORMIDAD;
	}

	/**
	 * @return FCH_DICTAMEN - date
	 */
	public function getFCH_DICTAMEN(){
		return $this->FCH_DICTAMEN;
	}

	/**
	 * @return FCH_VIGENCIA_INICIO - date
	 */
	public function getFCH_VIGENCIA_INICIO(){
		return $this->FCH_VIGENCIA_INICIO;
	}

	/**
	 * @return FCH_VIGENCIA_FIN - date
	 */
	public function getFCH_VIGENCIA_FIN(){
		return $this->FCH_VIGENCIA_FIN;
	}

	/**
	 * @return FCH_INCONFOR_FIN - date
	 */
	public function getFCH_INCONFOR_FIN(){
		return $this->FCH_INCONFOR_FIN;
	}

	/**
	 * @return CATEGORIA_CVE - int(11)
	 */
	public function getCATEGORIA_CVE(){
		return $this->CATEGORIA_CVE;
	}

	/**
	 * @return ESTADO_DICTAMEN_CVE - int(11)
	 */
	public function getESTADO_DICTAMEN_CVE(){
		return $this->ESTADO_DICTAMEN_CVE;
	}

	/**
	 * @return EMPLEADO_CVE - int(11)
	 */
	public function getEMPLEADO_CVE(){
		return $this->EMPLEADO_CVE;
	}

	/**
	 * @return DICTAMEN_CVE - int(11)
	 */
	public function getDICTAMEN_CVE(){
		return $this->DICTAMEN_CVE;
	}

	/**
	 * @param Type: varchar(200)
	 */
	public function setMSG_INCONFORMIDAD($MSG_INCONFORMIDAD){
		$this->MSG_INCONFORMIDAD = $MSG_INCONFORMIDAD;
	}

	/**
	 * @param Type: date
	 */
	public function setFCH_DICTAMEN($FCH_DICTAMEN){
		$this->FCH_DICTAMEN = $FCH_DICTAMEN;
	}

	/**
	 * @param Type: date
	 */
	public function setFCH_VIGENCIA_INICIO($FCH_VIGENCIA_INICIO){
		$this->FCH_VIGENCIA_INICIO = $FCH_VIGENCIA_INICIO;
	}

	/**
	 * @param Type: date
	 */
	public function setFCH_VIGENCIA_FIN($FCH_VIGENCIA_FIN){
		$this->FCH_VIGENCIA_FIN = $FCH_VIGENCIA_FIN;
	}

	/**
	 * @param Type: date
	 */
	public function setFCH_INCONFOR_FIN($FCH_INCONFOR_FIN){
		$this->FCH_INCONFOR_FIN = $FCH_INCONFOR_FIN;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setCATEGORIA_CVE($CATEGORIA_CVE){
		$this->CATEGORIA_CVE = $CATEGORIA_CVE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setESTADO_DICTAMEN_CVE($ESTADO_DICTAMEN_CVE){
		$this->ESTADO_DICTAMEN_CVE = $ESTADO_DICTAMEN_CVE;
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
	public function setDICTAMEN_CVE($DICTAMEN_CVE){
		$this->DICTAMEN_CVE = $DICTAMEN_CVE;
	}

    /**
     * Close mysql connection
     */
	public function enddictamen(){
		$this->connection->CloseMysql();
	}

}