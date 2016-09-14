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

Class cestado_usuario {

	private $ESTADO_USUARIO_CVE; //int(11)
	private $EDO_USUARIO_DESC; //varchar(20)
	private $connection;

	public function cestado_usuario(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_cestado_usuario($EDO_USUARIO_DESC){
		$this->EDO_USUARIO_DESC = $EDO_USUARIO_DESC;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from cestado_usuario where ESTADO_USUARIO_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->ESTADO_USUARIO_CVE = $row["ESTADO_USUARIO_CVE"];
			$this->EDO_USUARIO_DESC = $row["EDO_USUARIO_DESC"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM cestado_usuario WHERE ESTADO_USUARIO_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE cestado_usuario set EDO_USUARIO_DESC = \"$this->EDO_USUARIO_DESC\" where ESTADO_USUARIO_CVE = \"$this->ESTADO_USUARIO_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into cestado_usuario (EDO_USUARIO_DESC) values (\"$this->EDO_USUARIO_DESC\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT ESTADO_USUARIO_CVE from cestado_usuario order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["ESTADO_USUARIO_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return ESTADO_USUARIO_CVE - int(11)
	 */
	public function getESTADO_USUARIO_CVE(){
		return $this->ESTADO_USUARIO_CVE;
	}

	/**
	 * @return EDO_USUARIO_DESC - varchar(20)
	 */
	public function getEDO_USUARIO_DESC(){
		return $this->EDO_USUARIO_DESC;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setESTADO_USUARIO_CVE($ESTADO_USUARIO_CVE){
		$this->ESTADO_USUARIO_CVE = $ESTADO_USUARIO_CVE;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setEDO_USUARIO_DESC($EDO_USUARIO_DESC){
		$this->EDO_USUARIO_DESC = $EDO_USUARIO_DESC;
	}

    /**
     * Close mysql connection
     */
	public function endcestado_usuario(){
		$this->connection->CloseMysql();
	}

}