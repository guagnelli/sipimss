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

Class ctipo_material {

	private $TIP_MAT_NOMBRE; //varchar(100)
	private $TIP_MAT_TIPO; //int(11)
	private $TIP_MATERIAL_CVE; //int(11)
	private $TIP_MAT_OPCION; //varchar(30)
	private $connection;

	public function ctipo_material(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_ctipo_material($TIP_MAT_NOMBRE,$TIP_MAT_TIPO,$TIP_MAT_OPCION){
		$this->TIP_MAT_NOMBRE = $TIP_MAT_NOMBRE;
		$this->TIP_MAT_TIPO = $TIP_MAT_TIPO;
		$this->TIP_MAT_OPCION = $TIP_MAT_OPCION;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from ctipo_material where TIP_MATERIAL_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->TIP_MAT_NOMBRE = $row["TIP_MAT_NOMBRE"];
			$this->TIP_MAT_TIPO = $row["TIP_MAT_TIPO"];
			$this->TIP_MATERIAL_CVE = $row["TIP_MATERIAL_CVE"];
			$this->TIP_MAT_OPCION = $row["TIP_MAT_OPCION"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM ctipo_material WHERE TIP_MATERIAL_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE ctipo_material set TIP_MAT_NOMBRE = \"$this->TIP_MAT_NOMBRE\", TIP_MAT_TIPO = \"$this->TIP_MAT_TIPO\", TIP_MAT_OPCION = \"$this->TIP_MAT_OPCION\" where TIP_MATERIAL_CVE = \"$this->TIP_MATERIAL_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into ctipo_material (TIP_MAT_NOMBRE, TIP_MAT_TIPO, TIP_MAT_OPCION) values (\"$this->TIP_MAT_NOMBRE\", \"$this->TIP_MAT_TIPO\", \"$this->TIP_MAT_OPCION\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT TIP_MATERIAL_CVE from ctipo_material order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["TIP_MATERIAL_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return TIP_MAT_NOMBRE - varchar(100)
	 */
	public function getTIP_MAT_NOMBRE(){
		return $this->TIP_MAT_NOMBRE;
	}

	/**
	 * @return TIP_MAT_TIPO - int(11)
	 */
	public function getTIP_MAT_TIPO(){
		return $this->TIP_MAT_TIPO;
	}

	/**
	 * @return TIP_MATERIAL_CVE - int(11)
	 */
	public function getTIP_MATERIAL_CVE(){
		return $this->TIP_MATERIAL_CVE;
	}

	/**
	 * @return TIP_MAT_OPCION - varchar(30)
	 */
	public function getTIP_MAT_OPCION(){
		return $this->TIP_MAT_OPCION;
	}

	/**
	 * @param Type: varchar(100)
	 */
	public function setTIP_MAT_NOMBRE($TIP_MAT_NOMBRE){
		$this->TIP_MAT_NOMBRE = $TIP_MAT_NOMBRE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTIP_MAT_TIPO($TIP_MAT_TIPO){
		$this->TIP_MAT_TIPO = $TIP_MAT_TIPO;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTIP_MATERIAL_CVE($TIP_MATERIAL_CVE){
		$this->TIP_MATERIAL_CVE = $TIP_MATERIAL_CVE;
	}

	/**
	 * @param Type: varchar(30)
	 */
	public function setTIP_MAT_OPCION($TIP_MAT_OPCION){
		$this->TIP_MAT_OPCION = $TIP_MAT_OPCION;
	}

    /**
     * Close mysql connection
     */
	public function endctipo_material(){
		$this->connection->CloseMysql();
	}

}