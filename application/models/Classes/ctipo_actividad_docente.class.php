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

Class ctipo_actividad_docente {

	private $TIP_ACT_DOC_NOMBRE; //varchar(50)
	private $TIP_ACT_DOC_CVE; //int(11)
	private $connection;

	public function ctipo_actividad_docente(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_ctipo_actividad_docente($TIP_ACT_DOC_NOMBRE,){
		$this->TIP_ACT_DOC_NOMBRE = $TIP_ACT_DOC_NOMBRE;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from ctipo_actividad_docente where TIP_ACT_DOC_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->TIP_ACT_DOC_NOMBRE = $row["TIP_ACT_DOC_NOMBRE"];
			$this->TIP_ACT_DOC_CVE = $row["TIP_ACT_DOC_CVE"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM ctipo_actividad_docente WHERE TIP_ACT_DOC_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE ctipo_actividad_docente set TIP_ACT_DOC_NOMBRE = \"$this->TIP_ACT_DOC_NOMBRE\",  where TIP_ACT_DOC_CVE = \"$this->TIP_ACT_DOC_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into ctipo_actividad_docente (TIP_ACT_DOC_NOMBRE, ) values (\"$this->TIP_ACT_DOC_NOMBRE\", )");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT TIP_ACT_DOC_CVE from ctipo_actividad_docente order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["TIP_ACT_DOC_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return TIP_ACT_DOC_NOMBRE - varchar(50)
	 */
	public function getTIP_ACT_DOC_NOMBRE(){
		return $this->TIP_ACT_DOC_NOMBRE;
	}

	/**
	 * @return TIP_ACT_DOC_CVE - int(11)
	 */
	public function getTIP_ACT_DOC_CVE(){
		return $this->TIP_ACT_DOC_CVE;
	}

	/**
	 * @param Type: varchar(50)
	 */
	public function setTIP_ACT_DOC_NOMBRE($TIP_ACT_DOC_NOMBRE){
		$this->TIP_ACT_DOC_NOMBRE = $TIP_ACT_DOC_NOMBRE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTIP_ACT_DOC_CVE($TIP_ACT_DOC_CVE){
		$this->TIP_ACT_DOC_CVE = $TIP_ACT_DOC_CVE;
	}

    /**
     * Close mysql connection
     */
	public function endctipo_actividad_docente(){
		$this->connection->CloseMysql();
	}

}