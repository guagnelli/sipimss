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

Class ctipo_comprobante {

	private $TIPO_COMPROBANTE_CVE; //int(11)
	private $TIP_COM_NOMBRE; //varchar(20)
	private $connection;

	public function ctipo_comprobante(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_ctipo_comprobante($TIP_COM_NOMBRE){
		$this->TIP_COM_NOMBRE = $TIP_COM_NOMBRE;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from ctipo_comprobante where TIPO_COMPROBANTE_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->TIPO_COMPROBANTE_CVE = $row["TIPO_COMPROBANTE_CVE"];
			$this->TIP_COM_NOMBRE = $row["TIP_COM_NOMBRE"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM ctipo_comprobante WHERE TIPO_COMPROBANTE_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE ctipo_comprobante set TIP_COM_NOMBRE = \"$this->TIP_COM_NOMBRE\" where TIPO_COMPROBANTE_CVE = \"$this->TIPO_COMPROBANTE_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into ctipo_comprobante (TIP_COM_NOMBRE) values (\"$this->TIP_COM_NOMBRE\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT TIPO_COMPROBANTE_CVE from ctipo_comprobante order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["TIPO_COMPROBANTE_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return TIPO_COMPROBANTE_CVE - int(11)
	 */
	public function getTIPO_COMPROBANTE_CVE(){
		return $this->TIPO_COMPROBANTE_CVE;
	}

	/**
	 * @return TIP_COM_NOMBRE - varchar(20)
	 */
	public function getTIP_COM_NOMBRE(){
		return $this->TIP_COM_NOMBRE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTIPO_COMPROBANTE_CVE($TIPO_COMPROBANTE_CVE){
		$this->TIPO_COMPROBANTE_CVE = $TIPO_COMPROBANTE_CVE;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setTIP_COM_NOMBRE($TIP_COM_NOMBRE){
		$this->TIP_COM_NOMBRE = $TIP_COM_NOMBRE;
	}

    /**
     * Close mysql connection
     */
	public function endctipo_comprobante(){
		$this->connection->CloseMysql();
	}

}