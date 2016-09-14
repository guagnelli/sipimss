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

Class cbeca_interrumpida {

	private $BECA_INTERRIMPIDA_CVE; //int(11)
	private $MSG_BEC_INTE; //varchar(40)
	private $connection;

	public function cbeca_interrumpida(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_cbeca_interrumpida($MSG_BEC_INTE){
		$this->MSG_BEC_INTE = $MSG_BEC_INTE;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from cbeca_interrumpida where BECA_INTERRIMPIDA_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->BECA_INTERRIMPIDA_CVE = $row["BECA_INTERRIMPIDA_CVE"];
			$this->MSG_BEC_INTE = $row["MSG_BEC_INTE"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM cbeca_interrumpida WHERE BECA_INTERRIMPIDA_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE cbeca_interrumpida set MSG_BEC_INTE = \"$this->MSG_BEC_INTE\" where BECA_INTERRIMPIDA_CVE = \"$this->BECA_INTERRIMPIDA_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into cbeca_interrumpida (MSG_BEC_INTE) values (\"$this->MSG_BEC_INTE\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT BECA_INTERRIMPIDA_CVE from cbeca_interrumpida order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["BECA_INTERRIMPIDA_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return BECA_INTERRIMPIDA_CVE - int(11)
	 */
	public function getBECA_INTERRIMPIDA_CVE(){
		return $this->BECA_INTERRIMPIDA_CVE;
	}

	/**
	 * @return MSG_BEC_INTE - varchar(40)
	 */
	public function getMSG_BEC_INTE(){
		return $this->MSG_BEC_INTE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setBECA_INTERRIMPIDA_CVE($BECA_INTERRIMPIDA_CVE){
		$this->BECA_INTERRIMPIDA_CVE = $BECA_INTERRIMPIDA_CVE;
	}

	/**
	 * @param Type: varchar(40)
	 */
	public function setMSG_BEC_INTE($MSG_BEC_INTE){
		$this->MSG_BEC_INTE = $MSG_BEC_INTE;
	}

    /**
     * Close mysql connection
     */
	public function endcbeca_interrumpida(){
		$this->connection->CloseMysql();
	}

}