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

Class tarjeton {

	private $TARJETON_CVE; //int(11)
	private $TAR_FOLIO; //varchar(20)
	private $TAR_QUINCENA; //varchar(20)
	private $TAR_INCIDENCIA; //int(11)
	private $CAN_BON_REG_CVE; //int(11)
	private $connection;

	public function tarjeton(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_tarjeton($TAR_FOLIO,$TAR_QUINCENA,$TAR_INCIDENCIA,$CAN_BON_REG_CVE){
		$this->TAR_FOLIO = $TAR_FOLIO;
		$this->TAR_QUINCENA = $TAR_QUINCENA;
		$this->TAR_INCIDENCIA = $TAR_INCIDENCIA;
		$this->CAN_BON_REG_CVE = $CAN_BON_REG_CVE;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from tarjeton where TARJETON_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->TARJETON_CVE = $row["TARJETON_CVE"];
			$this->TAR_FOLIO = $row["TAR_FOLIO"];
			$this->TAR_QUINCENA = $row["TAR_QUINCENA"];
			$this->TAR_INCIDENCIA = $row["TAR_INCIDENCIA"];
			$this->CAN_BON_REG_CVE = $row["CAN_BON_REG_CVE"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM tarjeton WHERE TARJETON_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE tarjeton set TAR_FOLIO = \"$this->TAR_FOLIO\", TAR_QUINCENA = \"$this->TAR_QUINCENA\", TAR_INCIDENCIA = \"$this->TAR_INCIDENCIA\", CAN_BON_REG_CVE = \"$this->CAN_BON_REG_CVE\" where TARJETON_CVE = \"$this->TARJETON_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into tarjeton (TAR_FOLIO, TAR_QUINCENA, TAR_INCIDENCIA, CAN_BON_REG_CVE) values (\"$this->TAR_FOLIO\", \"$this->TAR_QUINCENA\", \"$this->TAR_INCIDENCIA\", \"$this->CAN_BON_REG_CVE\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT TARJETON_CVE from tarjeton order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["TARJETON_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return TARJETON_CVE - int(11)
	 */
	public function getTARJETON_CVE(){
		return $this->TARJETON_CVE;
	}

	/**
	 * @return TAR_FOLIO - varchar(20)
	 */
	public function getTAR_FOLIO(){
		return $this->TAR_FOLIO;
	}

	/**
	 * @return TAR_QUINCENA - varchar(20)
	 */
	public function getTAR_QUINCENA(){
		return $this->TAR_QUINCENA;
	}

	/**
	 * @return TAR_INCIDENCIA - int(11)
	 */
	public function getTAR_INCIDENCIA(){
		return $this->TAR_INCIDENCIA;
	}

	/**
	 * @return CAN_BON_REG_CVE - int(11)
	 */
	public function getCAN_BON_REG_CVE(){
		return $this->CAN_BON_REG_CVE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTARJETON_CVE($TARJETON_CVE){
		$this->TARJETON_CVE = $TARJETON_CVE;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setTAR_FOLIO($TAR_FOLIO){
		$this->TAR_FOLIO = $TAR_FOLIO;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setTAR_QUINCENA($TAR_QUINCENA){
		$this->TAR_QUINCENA = $TAR_QUINCENA;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTAR_INCIDENCIA($TAR_INCIDENCIA){
		$this->TAR_INCIDENCIA = $TAR_INCIDENCIA;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setCAN_BON_REG_CVE($CAN_BON_REG_CVE){
		$this->CAN_BON_REG_CVE = $CAN_BON_REG_CVE;
	}

    /**
     * Close mysql connection
     */
	public function endtarjeton(){
		$this->connection->CloseMysql();
	}

}