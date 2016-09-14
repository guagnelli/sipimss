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

Class cnivel_academico {

	private $NIV_ACADEMICO_CVE; //int(11)
	private $NIV_ACA_NOMBRE; //varchar(20)
	private $connection;

	public function cnivel_academico(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_cnivel_academico($NIV_ACA_NOMBRE){
		$this->NIV_ACA_NOMBRE = $NIV_ACA_NOMBRE;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from cnivel_academico where NIV_ACADEMICO_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->NIV_ACADEMICO_CVE = $row["NIV_ACADEMICO_CVE"];
			$this->NIV_ACA_NOMBRE = $row["NIV_ACA_NOMBRE"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM cnivel_academico WHERE NIV_ACADEMICO_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE cnivel_academico set NIV_ACA_NOMBRE = \"$this->NIV_ACA_NOMBRE\" where NIV_ACADEMICO_CVE = \"$this->NIV_ACADEMICO_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into cnivel_academico (NIV_ACA_NOMBRE) values (\"$this->NIV_ACA_NOMBRE\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT NIV_ACADEMICO_CVE from cnivel_academico order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["NIV_ACADEMICO_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return NIV_ACADEMICO_CVE - int(11)
	 */
	public function getNIV_ACADEMICO_CVE(){
		return $this->NIV_ACADEMICO_CVE;
	}

	/**
	 * @return NIV_ACA_NOMBRE - varchar(20)
	 */
	public function getNIV_ACA_NOMBRE(){
		return $this->NIV_ACA_NOMBRE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setNIV_ACADEMICO_CVE($NIV_ACADEMICO_CVE){
		$this->NIV_ACADEMICO_CVE = $NIV_ACADEMICO_CVE;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setNIV_ACA_NOMBRE($NIV_ACA_NOMBRE){
		$this->NIV_ACA_NOMBRE = $NIV_ACA_NOMBRE;
	}

    /**
     * Close mysql connection
     */
	public function endcnivel_academico(){
		$this->connection->CloseMysql();
	}

}