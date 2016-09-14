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

Class licenciatura {

	private $LICENCIATURA_CVE; //int(11)
	private $LIC_NOMBRE; //varchar(25)
	private $TIP_LICENCIATURA_CVE; //int(11)
	private $connection;

	public function licenciatura(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_licenciatura($LIC_NOMBRE,$TIP_LICENCIATURA_CVE){
		$this->LIC_NOMBRE = $LIC_NOMBRE;
		$this->TIP_LICENCIATURA_CVE = $TIP_LICENCIATURA_CVE;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from licenciatura where LICENCIATURA_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->LICENCIATURA_CVE = $row["LICENCIATURA_CVE"];
			$this->LIC_NOMBRE = $row["LIC_NOMBRE"];
			$this->TIP_LICENCIATURA_CVE = $row["TIP_LICENCIATURA_CVE"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM licenciatura WHERE LICENCIATURA_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE licenciatura set LIC_NOMBRE = \"$this->LIC_NOMBRE\", TIP_LICENCIATURA_CVE = \"$this->TIP_LICENCIATURA_CVE\" where LICENCIATURA_CVE = \"$this->LICENCIATURA_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into licenciatura (LIC_NOMBRE, TIP_LICENCIATURA_CVE) values (\"$this->LIC_NOMBRE\", \"$this->TIP_LICENCIATURA_CVE\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT LICENCIATURA_CVE from licenciatura order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["LICENCIATURA_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return LICENCIATURA_CVE - int(11)
	 */
	public function getLICENCIATURA_CVE(){
		return $this->LICENCIATURA_CVE;
	}

	/**
	 * @return LIC_NOMBRE - varchar(25)
	 */
	public function getLIC_NOMBRE(){
		return $this->LIC_NOMBRE;
	}

	/**
	 * @return TIP_LICENCIATURA_CVE - int(11)
	 */
	public function getTIP_LICENCIATURA_CVE(){
		return $this->TIP_LICENCIATURA_CVE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setLICENCIATURA_CVE($LICENCIATURA_CVE){
		$this->LICENCIATURA_CVE = $LICENCIATURA_CVE;
	}

	/**
	 * @param Type: varchar(25)
	 */
	public function setLIC_NOMBRE($LIC_NOMBRE){
		$this->LIC_NOMBRE = $LIC_NOMBRE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTIP_LICENCIATURA_CVE($TIP_LICENCIATURA_CVE){
		$this->TIP_LICENCIATURA_CVE = $TIP_LICENCIATURA_CVE;
	}

    /**
     * Close mysql connection
     */
	public function endlicenciatura(){
		$this->connection->CloseMysql();
	}

}