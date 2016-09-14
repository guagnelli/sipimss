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

Class cvalidacion_curso_estado {

	private $VAL_CUR_EST_CVE; //int(11)
	private $VAl_CUR_EST_NOMBRE; //varchar(20)
	private $connection;

	public function cvalidacion_curso_estado(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_cvalidacion_curso_estado($VAl_CUR_EST_NOMBRE){
		$this->VAl_CUR_EST_NOMBRE = $VAl_CUR_EST_NOMBRE;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from cvalidacion_curso_estado where VAL_CUR_EST_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->VAL_CUR_EST_CVE = $row["VAL_CUR_EST_CVE"];
			$this->VAl_CUR_EST_NOMBRE = $row["VAl_CUR_EST_NOMBRE"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM cvalidacion_curso_estado WHERE VAL_CUR_EST_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE cvalidacion_curso_estado set VAl_CUR_EST_NOMBRE = \"$this->VAl_CUR_EST_NOMBRE\" where VAL_CUR_EST_CVE = \"$this->VAL_CUR_EST_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into cvalidacion_curso_estado (VAl_CUR_EST_NOMBRE) values (\"$this->VAl_CUR_EST_NOMBRE\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT VAL_CUR_EST_CVE from cvalidacion_curso_estado order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["VAL_CUR_EST_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return VAL_CUR_EST_CVE - int(11)
	 */
	public function getVAL_CUR_EST_CVE(){
		return $this->VAL_CUR_EST_CVE;
	}

	/**
	 * @return VAl_CUR_EST_NOMBRE - varchar(20)
	 */
	public function getVAl_CUR_EST_NOMBRE(){
		return $this->VAl_CUR_EST_NOMBRE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setVAL_CUR_EST_CVE($VAL_CUR_EST_CVE){
		$this->VAL_CUR_EST_CVE = $VAL_CUR_EST_CVE;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setVAl_CUR_EST_NOMBRE($VAl_CUR_EST_NOMBRE){
		$this->VAl_CUR_EST_NOMBRE = $VAl_CUR_EST_NOMBRE;
	}

    /**
     * Close mysql connection
     */
	public function endcvalidacion_curso_estado(){
		$this->connection->CloseMysql();
	}

}