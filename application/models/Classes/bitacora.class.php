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

Class bitacora {

	private $BITACORA_CVE; //int(11)
	private $BIT_FCH_CAMBIO; //timestamp
	private $BIT_RUTA; //varchar(250)
	private $BIT_OPERACION; //varchar(20)
	private $BIT_IP; //varchar(20)
	private $USUARIO_CVE; //int(11)
	private $MODULO_CVE; //int(11)
	private $ENTIDAD; //varchar(300)
	private $REGISTRO_ENTIDAD_CVE; //varchar(50)
	private $PARAMETROS_JSON; //text
	private $connection;

	public function bitacora(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_bitacora($BIT_FCH_CAMBIO,$BIT_RUTA,$BIT_OPERACION,$BIT_IP,$USUARIO_CVE,$MODULO_CVE,$ENTIDAD,$REGISTRO_ENTIDAD_CVE,$PARAMETROS_JSON){
		$this->BIT_FCH_CAMBIO = $BIT_FCH_CAMBIO;
		$this->BIT_RUTA = $BIT_RUTA;
		$this->BIT_OPERACION = $BIT_OPERACION;
		$this->BIT_IP = $BIT_IP;
		$this->USUARIO_CVE = $USUARIO_CVE;
		$this->MODULO_CVE = $MODULO_CVE;
		$this->ENTIDAD = $ENTIDAD;
		$this->REGISTRO_ENTIDAD_CVE = $REGISTRO_ENTIDAD_CVE;
		$this->PARAMETROS_JSON = $PARAMETROS_JSON;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from bitacora where BITACORA_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->BITACORA_CVE = $row["BITACORA_CVE"];
			$this->BIT_FCH_CAMBIO = $row["BIT_FCH_CAMBIO"];
			$this->BIT_RUTA = $row["BIT_RUTA"];
			$this->BIT_OPERACION = $row["BIT_OPERACION"];
			$this->BIT_IP = $row["BIT_IP"];
			$this->USUARIO_CVE = $row["USUARIO_CVE"];
			$this->MODULO_CVE = $row["MODULO_CVE"];
			$this->ENTIDAD = $row["ENTIDAD"];
			$this->REGISTRO_ENTIDAD_CVE = $row["REGISTRO_ENTIDAD_CVE"];
			$this->PARAMETROS_JSON = $row["PARAMETROS_JSON"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM bitacora WHERE BITACORA_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE bitacora set BIT_FCH_CAMBIO = \"$this->BIT_FCH_CAMBIO\", BIT_RUTA = \"$this->BIT_RUTA\", BIT_OPERACION = \"$this->BIT_OPERACION\", BIT_IP = \"$this->BIT_IP\", USUARIO_CVE = \"$this->USUARIO_CVE\", MODULO_CVE = \"$this->MODULO_CVE\", ENTIDAD = \"$this->ENTIDAD\", REGISTRO_ENTIDAD_CVE = \"$this->REGISTRO_ENTIDAD_CVE\", PARAMETROS_JSON = \"$this->PARAMETROS_JSON\" where BITACORA_CVE = \"$this->BITACORA_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into bitacora (BIT_FCH_CAMBIO, BIT_RUTA, BIT_OPERACION, BIT_IP, USUARIO_CVE, MODULO_CVE, ENTIDAD, REGISTRO_ENTIDAD_CVE, PARAMETROS_JSON) values (\"$this->BIT_FCH_CAMBIO\", \"$this->BIT_RUTA\", \"$this->BIT_OPERACION\", \"$this->BIT_IP\", \"$this->USUARIO_CVE\", \"$this->MODULO_CVE\", \"$this->ENTIDAD\", \"$this->REGISTRO_ENTIDAD_CVE\", \"$this->PARAMETROS_JSON\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT BITACORA_CVE from bitacora order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["BITACORA_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return BITACORA_CVE - int(11)
	 */
	public function getBITACORA_CVE(){
		return $this->BITACORA_CVE;
	}

	/**
	 * @return BIT_FCH_CAMBIO - timestamp
	 */
	public function getBIT_FCH_CAMBIO(){
		return $this->BIT_FCH_CAMBIO;
	}

	/**
	 * @return BIT_RUTA - varchar(250)
	 */
	public function getBIT_RUTA(){
		return $this->BIT_RUTA;
	}

	/**
	 * @return BIT_OPERACION - varchar(20)
	 */
	public function getBIT_OPERACION(){
		return $this->BIT_OPERACION;
	}

	/**
	 * @return BIT_IP - varchar(20)
	 */
	public function getBIT_IP(){
		return $this->BIT_IP;
	}

	/**
	 * @return USUARIO_CVE - int(11)
	 */
	public function getUSUARIO_CVE(){
		return $this->USUARIO_CVE;
	}

	/**
	 * @return MODULO_CVE - int(11)
	 */
	public function getMODULO_CVE(){
		return $this->MODULO_CVE;
	}

	/**
	 * @return ENTIDAD - varchar(300)
	 */
	public function getENTIDAD(){
		return $this->ENTIDAD;
	}

	/**
	 * @return REGISTRO_ENTIDAD_CVE - varchar(50)
	 */
	public function getREGISTRO_ENTIDAD_CVE(){
		return $this->REGISTRO_ENTIDAD_CVE;
	}

	/**
	 * @return PARAMETROS_JSON - text
	 */
	public function getPARAMETROS_JSON(){
		return $this->PARAMETROS_JSON;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setBITACORA_CVE($BITACORA_CVE){
		$this->BITACORA_CVE = $BITACORA_CVE;
	}

	/**
	 * @param Type: timestamp
	 */
	public function setBIT_FCH_CAMBIO($BIT_FCH_CAMBIO){
		$this->BIT_FCH_CAMBIO = $BIT_FCH_CAMBIO;
	}

	/**
	 * @param Type: varchar(250)
	 */
	public function setBIT_RUTA($BIT_RUTA){
		$this->BIT_RUTA = $BIT_RUTA;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setBIT_OPERACION($BIT_OPERACION){
		$this->BIT_OPERACION = $BIT_OPERACION;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setBIT_IP($BIT_IP){
		$this->BIT_IP = $BIT_IP;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setUSUARIO_CVE($USUARIO_CVE){
		$this->USUARIO_CVE = $USUARIO_CVE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setMODULO_CVE($MODULO_CVE){
		$this->MODULO_CVE = $MODULO_CVE;
	}

	/**
	 * @param Type: varchar(300)
	 */
	public function setENTIDAD($ENTIDAD){
		$this->ENTIDAD = $ENTIDAD;
	}

	/**
	 * @param Type: varchar(50)
	 */
	public function setREGISTRO_ENTIDAD_CVE($REGISTRO_ENTIDAD_CVE){
		$this->REGISTRO_ENTIDAD_CVE = $REGISTRO_ENTIDAD_CVE;
	}

	/**
	 * @param Type: text
	 */
	public function setPARAMETROS_JSON($PARAMETROS_JSON){
		$this->PARAMETROS_JSON = $PARAMETROS_JSON;
	}

    /**
     * Close mysql connection
     */
	public function endbitacora(){
		$this->connection->CloseMysql();
	}

}