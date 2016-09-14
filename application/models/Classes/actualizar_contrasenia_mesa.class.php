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

Class actualizar_contrasenia_mesa {

	private $USUARIO_CVE; //int(11)
	private $ACM_FCH_ACTUALIZA; //date
	private $ACM_CONTRASENIA_TEMP; //varchar(20)
	private $USR_QUIEN_REALIZA_ACT; //varchar(20)
	private $USR_A_QUIEN_ACTUALIZAN; //varchar(20)
	private $ACTUALIZA_ESTADO; //varchar(20)
	private $ACTUA_CONTRA_MESA; //int(11)
	private $connection;

	public function actualizar_contrasenia_mesa(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_actualizar_contrasenia_mesa($USUARIO_CVE,$ACM_FCH_ACTUALIZA,$ACM_CONTRASENIA_TEMP,$USR_QUIEN_REALIZA_ACT,$USR_A_QUIEN_ACTUALIZAN,$ACTUALIZA_ESTADO,){
		$this->USUARIO_CVE = $USUARIO_CVE;
		$this->ACM_FCH_ACTUALIZA = $ACM_FCH_ACTUALIZA;
		$this->ACM_CONTRASENIA_TEMP = $ACM_CONTRASENIA_TEMP;
		$this->USR_QUIEN_REALIZA_ACT = $USR_QUIEN_REALIZA_ACT;
		$this->USR_A_QUIEN_ACTUALIZAN = $USR_A_QUIEN_ACTUALIZAN;
		$this->ACTUALIZA_ESTADO = $ACTUALIZA_ESTADO;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from actualizar_contrasenia_mesa where ACTUA_CONTRA_MESA = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->USUARIO_CVE = $row["USUARIO_CVE"];
			$this->ACM_FCH_ACTUALIZA = $row["ACM_FCH_ACTUALIZA"];
			$this->ACM_CONTRASENIA_TEMP = $row["ACM_CONTRASENIA_TEMP"];
			$this->USR_QUIEN_REALIZA_ACT = $row["USR_QUIEN_REALIZA_ACT"];
			$this->USR_A_QUIEN_ACTUALIZAN = $row["USR_A_QUIEN_ACTUALIZAN"];
			$this->ACTUALIZA_ESTADO = $row["ACTUALIZA_ESTADO"];
			$this->ACTUA_CONTRA_MESA = $row["ACTUA_CONTRA_MESA"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM actualizar_contrasenia_mesa WHERE ACTUA_CONTRA_MESA = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE actualizar_contrasenia_mesa set USUARIO_CVE = \"$this->USUARIO_CVE\", ACM_FCH_ACTUALIZA = \"$this->ACM_FCH_ACTUALIZA\", ACM_CONTRASENIA_TEMP = \"$this->ACM_CONTRASENIA_TEMP\", USR_QUIEN_REALIZA_ACT = \"$this->USR_QUIEN_REALIZA_ACT\", USR_A_QUIEN_ACTUALIZAN = \"$this->USR_A_QUIEN_ACTUALIZAN\", ACTUALIZA_ESTADO = \"$this->ACTUALIZA_ESTADO\",  where ACTUA_CONTRA_MESA = \"$this->ACTUA_CONTRA_MESA\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into actualizar_contrasenia_mesa (USUARIO_CVE, ACM_FCH_ACTUALIZA, ACM_CONTRASENIA_TEMP, USR_QUIEN_REALIZA_ACT, USR_A_QUIEN_ACTUALIZAN, ACTUALIZA_ESTADO, ) values (\"$this->USUARIO_CVE\", \"$this->ACM_FCH_ACTUALIZA\", \"$this->ACM_CONTRASENIA_TEMP\", \"$this->USR_QUIEN_REALIZA_ACT\", \"$this->USR_A_QUIEN_ACTUALIZAN\", \"$this->ACTUALIZA_ESTADO\", )");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT ACTUA_CONTRA_MESA from actualizar_contrasenia_mesa order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["ACTUA_CONTRA_MESA"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return USUARIO_CVE - int(11)
	 */
	public function getUSUARIO_CVE(){
		return $this->USUARIO_CVE;
	}

	/**
	 * @return ACM_FCH_ACTUALIZA - date
	 */
	public function getACM_FCH_ACTUALIZA(){
		return $this->ACM_FCH_ACTUALIZA;
	}

	/**
	 * @return ACM_CONTRASENIA_TEMP - varchar(20)
	 */
	public function getACM_CONTRASENIA_TEMP(){
		return $this->ACM_CONTRASENIA_TEMP;
	}

	/**
	 * @return USR_QUIEN_REALIZA_ACT - varchar(20)
	 */
	public function getUSR_QUIEN_REALIZA_ACT(){
		return $this->USR_QUIEN_REALIZA_ACT;
	}

	/**
	 * @return USR_A_QUIEN_ACTUALIZAN - varchar(20)
	 */
	public function getUSR_A_QUIEN_ACTUALIZAN(){
		return $this->USR_A_QUIEN_ACTUALIZAN;
	}

	/**
	 * @return ACTUALIZA_ESTADO - varchar(20)
	 */
	public function getACTUALIZA_ESTADO(){
		return $this->ACTUALIZA_ESTADO;
	}

	/**
	 * @return ACTUA_CONTRA_MESA - int(11)
	 */
	public function getACTUA_CONTRA_MESA(){
		return $this->ACTUA_CONTRA_MESA;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setUSUARIO_CVE($USUARIO_CVE){
		$this->USUARIO_CVE = $USUARIO_CVE;
	}

	/**
	 * @param Type: date
	 */
	public function setACM_FCH_ACTUALIZA($ACM_FCH_ACTUALIZA){
		$this->ACM_FCH_ACTUALIZA = $ACM_FCH_ACTUALIZA;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setACM_CONTRASENIA_TEMP($ACM_CONTRASENIA_TEMP){
		$this->ACM_CONTRASENIA_TEMP = $ACM_CONTRASENIA_TEMP;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setUSR_QUIEN_REALIZA_ACT($USR_QUIEN_REALIZA_ACT){
		$this->USR_QUIEN_REALIZA_ACT = $USR_QUIEN_REALIZA_ACT;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setUSR_A_QUIEN_ACTUALIZAN($USR_A_QUIEN_ACTUALIZAN){
		$this->USR_A_QUIEN_ACTUALIZAN = $USR_A_QUIEN_ACTUALIZAN;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setACTUALIZA_ESTADO($ACTUALIZA_ESTADO){
		$this->ACTUALIZA_ESTADO = $ACTUALIZA_ESTADO;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setACTUA_CONTRA_MESA($ACTUA_CONTRA_MESA){
		$this->ACTUA_CONTRA_MESA = $ACTUA_CONTRA_MESA;
	}

    /**
     * Close mysql connection
     */
	public function endactualizar_contrasenia_mesa(){
		$this->connection->CloseMysql();
	}

}