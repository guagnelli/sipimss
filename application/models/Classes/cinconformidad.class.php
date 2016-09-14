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

Class cinconformidad {

	private $FCH_INCONFORMIDAD; //date
	private $MSG_INCONFORMIDAD; //varchar(20)
	private $INCONFORMIDAD_CVE; //int(11)
	private $connection;

	public function cinconformidad(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_cinconformidad($FCH_INCONFORMIDAD,$MSG_INCONFORMIDAD,){
		$this->FCH_INCONFORMIDAD = $FCH_INCONFORMIDAD;
		$this->MSG_INCONFORMIDAD = $MSG_INCONFORMIDAD;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from cinconformidad where INCONFORMIDAD_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->FCH_INCONFORMIDAD = $row["FCH_INCONFORMIDAD"];
			$this->MSG_INCONFORMIDAD = $row["MSG_INCONFORMIDAD"];
			$this->INCONFORMIDAD_CVE = $row["INCONFORMIDAD_CVE"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM cinconformidad WHERE INCONFORMIDAD_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE cinconformidad set FCH_INCONFORMIDAD = \"$this->FCH_INCONFORMIDAD\", MSG_INCONFORMIDAD = \"$this->MSG_INCONFORMIDAD\",  where INCONFORMIDAD_CVE = \"$this->INCONFORMIDAD_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into cinconformidad (FCH_INCONFORMIDAD, MSG_INCONFORMIDAD, ) values (\"$this->FCH_INCONFORMIDAD\", \"$this->MSG_INCONFORMIDAD\", )");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT INCONFORMIDAD_CVE from cinconformidad order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["INCONFORMIDAD_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return FCH_INCONFORMIDAD - date
	 */
	public function getFCH_INCONFORMIDAD(){
		return $this->FCH_INCONFORMIDAD;
	}

	/**
	 * @return MSG_INCONFORMIDAD - varchar(20)
	 */
	public function getMSG_INCONFORMIDAD(){
		return $this->MSG_INCONFORMIDAD;
	}

	/**
	 * @return INCONFORMIDAD_CVE - int(11)
	 */
	public function getINCONFORMIDAD_CVE(){
		return $this->INCONFORMIDAD_CVE;
	}

	/**
	 * @param Type: date
	 */
	public function setFCH_INCONFORMIDAD($FCH_INCONFORMIDAD){
		$this->FCH_INCONFORMIDAD = $FCH_INCONFORMIDAD;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setMSG_INCONFORMIDAD($MSG_INCONFORMIDAD){
		$this->MSG_INCONFORMIDAD = $MSG_INCONFORMIDAD;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setINCONFORMIDAD_CVE($INCONFORMIDAD_CVE){
		$this->INCONFORMIDAD_CVE = $INCONFORMIDAD_CVE;
	}

    /**
     * Close mysql connection
     */
	public function endcinconformidad(){
		$this->connection->CloseMysql();
	}

}