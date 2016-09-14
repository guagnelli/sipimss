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

Class cejercicio_profesional {

	private $EJE_PRO_NOMBRE; //varchar(50)
	private $EJE_PRO_CVE; //int(11)
	private $connection;

	public function cejercicio_profesional(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_cejercicio_profesional($EJE_PRO_NOMBRE,){
		$this->EJE_PRO_NOMBRE = $EJE_PRO_NOMBRE;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from cejercicio_profesional where EJE_PRO_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->EJE_PRO_NOMBRE = $row["EJE_PRO_NOMBRE"];
			$this->EJE_PRO_CVE = $row["EJE_PRO_CVE"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM cejercicio_profesional WHERE EJE_PRO_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE cejercicio_profesional set EJE_PRO_NOMBRE = \"$this->EJE_PRO_NOMBRE\",  where EJE_PRO_CVE = \"$this->EJE_PRO_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into cejercicio_profesional (EJE_PRO_NOMBRE, ) values (\"$this->EJE_PRO_NOMBRE\", )");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT EJE_PRO_CVE from cejercicio_profesional order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["EJE_PRO_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return EJE_PRO_NOMBRE - varchar(50)
	 */
	public function getEJE_PRO_NOMBRE(){
		return $this->EJE_PRO_NOMBRE;
	}

	/**
	 * @return EJE_PRO_CVE - int(11)
	 */
	public function getEJE_PRO_CVE(){
		return $this->EJE_PRO_CVE;
	}

	/**
	 * @param Type: varchar(50)
	 */
	public function setEJE_PRO_NOMBRE($EJE_PRO_NOMBRE){
		$this->EJE_PRO_NOMBRE = $EJE_PRO_NOMBRE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setEJE_PRO_CVE($EJE_PRO_CVE){
		$this->EJE_PRO_CVE = $EJE_PRO_CVE;
	}

    /**
     * Close mysql connection
     */
	public function endcejercicio_profesional(){
		$this->connection->CloseMysql();
	}

}