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

Class cejercicio_predominante {

	private $EJER_PREDOMI_CVE; //int(11)
	private $EJE_PRE_NOMBRE; //varchar(40)
	private $connection;

	public function cejercicio_predominante(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_cejercicio_predominante($EJE_PRE_NOMBRE){
		$this->EJE_PRE_NOMBRE = $EJE_PRE_NOMBRE;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from cejercicio_predominante where EJER_PREDOMI_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->EJER_PREDOMI_CVE = $row["EJER_PREDOMI_CVE"];
			$this->EJE_PRE_NOMBRE = $row["EJE_PRE_NOMBRE"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM cejercicio_predominante WHERE EJER_PREDOMI_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE cejercicio_predominante set EJE_PRE_NOMBRE = \"$this->EJE_PRE_NOMBRE\" where EJER_PREDOMI_CVE = \"$this->EJER_PREDOMI_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into cejercicio_predominante (EJE_PRE_NOMBRE) values (\"$this->EJE_PRE_NOMBRE\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT EJER_PREDOMI_CVE from cejercicio_predominante order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["EJER_PREDOMI_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return EJER_PREDOMI_CVE - int(11)
	 */
	public function getEJER_PREDOMI_CVE(){
		return $this->EJER_PREDOMI_CVE;
	}

	/**
	 * @return EJE_PRE_NOMBRE - varchar(40)
	 */
	public function getEJE_PRE_NOMBRE(){
		return $this->EJE_PRE_NOMBRE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setEJER_PREDOMI_CVE($EJER_PREDOMI_CVE){
		$this->EJER_PREDOMI_CVE = $EJER_PREDOMI_CVE;
	}

	/**
	 * @param Type: varchar(40)
	 */
	public function setEJE_PRE_NOMBRE($EJE_PRE_NOMBRE){
		$this->EJE_PRE_NOMBRE = $EJE_PRE_NOMBRE;
	}

    /**
     * Close mysql connection
     */
	public function endcejercicio_predominante(){
		$this->connection->CloseMysql();
	}

}