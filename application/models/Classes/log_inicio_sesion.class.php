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

Class log_inicio_sesion {

	private $LOG_INI_SES_FCH_INICIO; //timestamp
	private $LOG_INI_SES_IP; //varchar(20)
	private $USUARIO_CVE; //int(11)
	private $LOG_INI_S_CVE; //int(11)
	private $INICIO_SATISFACTORIO; //tinyint(4)
	private $connection;

	public function log_inicio_sesion(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_log_inicio_sesion($LOG_INI_SES_FCH_INICIO,$LOG_INI_SES_IP,$USUARIO_CVE,$INICIO_SATISFACTORIO){
		$this->LOG_INI_SES_FCH_INICIO = $LOG_INI_SES_FCH_INICIO;
		$this->LOG_INI_SES_IP = $LOG_INI_SES_IP;
		$this->USUARIO_CVE = $USUARIO_CVE;
		$this->INICIO_SATISFACTORIO = $INICIO_SATISFACTORIO;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from log_inicio_sesion where LOG_INI_S_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->LOG_INI_SES_FCH_INICIO = $row["LOG_INI_SES_FCH_INICIO"];
			$this->LOG_INI_SES_IP = $row["LOG_INI_SES_IP"];
			$this->USUARIO_CVE = $row["USUARIO_CVE"];
			$this->LOG_INI_S_CVE = $row["LOG_INI_S_CVE"];
			$this->INICIO_SATISFACTORIO = $row["INICIO_SATISFACTORIO"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM log_inicio_sesion WHERE LOG_INI_S_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE log_inicio_sesion set LOG_INI_SES_FCH_INICIO = \"$this->LOG_INI_SES_FCH_INICIO\", LOG_INI_SES_IP = \"$this->LOG_INI_SES_IP\", USUARIO_CVE = \"$this->USUARIO_CVE\", INICIO_SATISFACTORIO = \"$this->INICIO_SATISFACTORIO\" where LOG_INI_S_CVE = \"$this->LOG_INI_S_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into log_inicio_sesion (LOG_INI_SES_FCH_INICIO, LOG_INI_SES_IP, USUARIO_CVE, INICIO_SATISFACTORIO) values (\"$this->LOG_INI_SES_FCH_INICIO\", \"$this->LOG_INI_SES_IP\", \"$this->USUARIO_CVE\", \"$this->INICIO_SATISFACTORIO\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT LOG_INI_S_CVE from log_inicio_sesion order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["LOG_INI_S_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return LOG_INI_SES_FCH_INICIO - timestamp
	 */
	public function getLOG_INI_SES_FCH_INICIO(){
		return $this->LOG_INI_SES_FCH_INICIO;
	}

	/**
	 * @return LOG_INI_SES_IP - varchar(20)
	 */
	public function getLOG_INI_SES_IP(){
		return $this->LOG_INI_SES_IP;
	}

	/**
	 * @return USUARIO_CVE - int(11)
	 */
	public function getUSUARIO_CVE(){
		return $this->USUARIO_CVE;
	}

	/**
	 * @return LOG_INI_S_CVE - int(11)
	 */
	public function getLOG_INI_S_CVE(){
		return $this->LOG_INI_S_CVE;
	}

	/**
	 * @return INICIO_SATISFACTORIO - tinyint(4)
	 */
	public function getINICIO_SATISFACTORIO(){
		return $this->INICIO_SATISFACTORIO;
	}

	/**
	 * @param Type: timestamp
	 */
	public function setLOG_INI_SES_FCH_INICIO($LOG_INI_SES_FCH_INICIO){
		$this->LOG_INI_SES_FCH_INICIO = $LOG_INI_SES_FCH_INICIO;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setLOG_INI_SES_IP($LOG_INI_SES_IP){
		$this->LOG_INI_SES_IP = $LOG_INI_SES_IP;
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
	public function setLOG_INI_S_CVE($LOG_INI_S_CVE){
		$this->LOG_INI_S_CVE = $LOG_INI_S_CVE;
	}

	/**
	 * @param Type: tinyint(4)
	 */
	public function setINICIO_SATISFACTORIO($INICIO_SATISFACTORIO){
		$this->INICIO_SATISFACTORIO = $INICIO_SATISFACTORIO;
	}

    /**
     * Close mysql connection
     */
	public function endlog_inicio_sesion(){
		$this->connection->CloseMysql();
	}

}