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

Class emp_contacto {

	private $EMPLEADO_CVE; //int(11)
	private $CONTACTO_CVE; //int(11)
	private $CON_VALOR; //varchar(60)
	private $TIP_CON_CVE; //int(11)
	private $SECCION_CVE; //int(11)
	private $connection;

	public function emp_contacto(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_emp_contacto($EMPLEADO_CVE,$CON_VALOR,$TIP_CON_CVE,$SECCION_CVE){
		$this->EMPLEADO_CVE = $EMPLEADO_CVE;
		$this->CON_VALOR = $CON_VALOR;
		$this->TIP_CON_CVE = $TIP_CON_CVE;
		$this->SECCION_CVE = $SECCION_CVE;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from emp_contacto where CONTACTO_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->EMPLEADO_CVE = $row["EMPLEADO_CVE"];
			$this->CONTACTO_CVE = $row["CONTACTO_CVE"];
			$this->CON_VALOR = $row["CON_VALOR"];
			$this->TIP_CON_CVE = $row["TIP_CON_CVE"];
			$this->SECCION_CVE = $row["SECCION_CVE"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM emp_contacto WHERE CONTACTO_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE emp_contacto set EMPLEADO_CVE = \"$this->EMPLEADO_CVE\", CON_VALOR = \"$this->CON_VALOR\", TIP_CON_CVE = \"$this->TIP_CON_CVE\", SECCION_CVE = \"$this->SECCION_CVE\" where CONTACTO_CVE = \"$this->CONTACTO_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into emp_contacto (EMPLEADO_CVE, CON_VALOR, TIP_CON_CVE, SECCION_CVE) values (\"$this->EMPLEADO_CVE\", \"$this->CON_VALOR\", \"$this->TIP_CON_CVE\", \"$this->SECCION_CVE\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT CONTACTO_CVE from emp_contacto order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["CONTACTO_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return EMPLEADO_CVE - int(11)
	 */
	public function getEMPLEADO_CVE(){
		return $this->EMPLEADO_CVE;
	}

	/**
	 * @return CONTACTO_CVE - int(11)
	 */
	public function getCONTACTO_CVE(){
		return $this->CONTACTO_CVE;
	}

	/**
	 * @return CON_VALOR - varchar(60)
	 */
	public function getCON_VALOR(){
		return $this->CON_VALOR;
	}

	/**
	 * @return TIP_CON_CVE - int(11)
	 */
	public function getTIP_CON_CVE(){
		return $this->TIP_CON_CVE;
	}

	/**
	 * @return SECCION_CVE - int(11)
	 */
	public function getSECCION_CVE(){
		return $this->SECCION_CVE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setEMPLEADO_CVE($EMPLEADO_CVE){
		$this->EMPLEADO_CVE = $EMPLEADO_CVE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setCONTACTO_CVE($CONTACTO_CVE){
		$this->CONTACTO_CVE = $CONTACTO_CVE;
	}

	/**
	 * @param Type: varchar(60)
	 */
	public function setCON_VALOR($CON_VALOR){
		$this->CON_VALOR = $CON_VALOR;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTIP_CON_CVE($TIP_CON_CVE){
		$this->TIP_CON_CVE = $TIP_CON_CVE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setSECCION_CVE($SECCION_CVE){
		$this->SECCION_CVE = $SECCION_CVE;
	}

    /**
     * Close mysql connection
     */
	public function endemp_contacto(){
		$this->connection->CloseMysql();
	}

}