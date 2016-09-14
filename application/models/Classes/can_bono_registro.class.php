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

Class can_bono_registro {

	private $CAN_BON_REG_FCH; //date
	private $CAN_BON_REG_CVE; //int(11)
	private $CAN_BON_REG_PROMEDIO; //int(11)
	private $CAN_BON_REG_MSG; //varchar(20)
	private $EMP_CAN_BONO_CVE; //int(11)
	private $ESTADO_BONO_CVE; //int(11)
	private $connection;

	public function can_bono_registro(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_can_bono_registro($CAN_BON_REG_FCH,$CAN_BON_REG_PROMEDIO,$CAN_BON_REG_MSG,$EMP_CAN_BONO_CVE,$ESTADO_BONO_CVE){
		$this->CAN_BON_REG_FCH = $CAN_BON_REG_FCH;
		$this->CAN_BON_REG_PROMEDIO = $CAN_BON_REG_PROMEDIO;
		$this->CAN_BON_REG_MSG = $CAN_BON_REG_MSG;
		$this->EMP_CAN_BONO_CVE = $EMP_CAN_BONO_CVE;
		$this->ESTADO_BONO_CVE = $ESTADO_BONO_CVE;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from can_bono_registro where CAN_BON_REG_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->CAN_BON_REG_FCH = $row["CAN_BON_REG_FCH"];
			$this->CAN_BON_REG_CVE = $row["CAN_BON_REG_CVE"];
			$this->CAN_BON_REG_PROMEDIO = $row["CAN_BON_REG_PROMEDIO"];
			$this->CAN_BON_REG_MSG = $row["CAN_BON_REG_MSG"];
			$this->EMP_CAN_BONO_CVE = $row["EMP_CAN_BONO_CVE"];
			$this->ESTADO_BONO_CVE = $row["ESTADO_BONO_CVE"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM can_bono_registro WHERE CAN_BON_REG_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE can_bono_registro set CAN_BON_REG_FCH = \"$this->CAN_BON_REG_FCH\", CAN_BON_REG_PROMEDIO = \"$this->CAN_BON_REG_PROMEDIO\", CAN_BON_REG_MSG = \"$this->CAN_BON_REG_MSG\", EMP_CAN_BONO_CVE = \"$this->EMP_CAN_BONO_CVE\", ESTADO_BONO_CVE = \"$this->ESTADO_BONO_CVE\" where CAN_BON_REG_CVE = \"$this->CAN_BON_REG_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into can_bono_registro (CAN_BON_REG_FCH, CAN_BON_REG_PROMEDIO, CAN_BON_REG_MSG, EMP_CAN_BONO_CVE, ESTADO_BONO_CVE) values (\"$this->CAN_BON_REG_FCH\", \"$this->CAN_BON_REG_PROMEDIO\", \"$this->CAN_BON_REG_MSG\", \"$this->EMP_CAN_BONO_CVE\", \"$this->ESTADO_BONO_CVE\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT CAN_BON_REG_CVE from can_bono_registro order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["CAN_BON_REG_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return CAN_BON_REG_FCH - date
	 */
	public function getCAN_BON_REG_FCH(){
		return $this->CAN_BON_REG_FCH;
	}

	/**
	 * @return CAN_BON_REG_CVE - int(11)
	 */
	public function getCAN_BON_REG_CVE(){
		return $this->CAN_BON_REG_CVE;
	}

	/**
	 * @return CAN_BON_REG_PROMEDIO - int(11)
	 */
	public function getCAN_BON_REG_PROMEDIO(){
		return $this->CAN_BON_REG_PROMEDIO;
	}

	/**
	 * @return CAN_BON_REG_MSG - varchar(20)
	 */
	public function getCAN_BON_REG_MSG(){
		return $this->CAN_BON_REG_MSG;
	}

	/**
	 * @return EMP_CAN_BONO_CVE - int(11)
	 */
	public function getEMP_CAN_BONO_CVE(){
		return $this->EMP_CAN_BONO_CVE;
	}

	/**
	 * @return ESTADO_BONO_CVE - int(11)
	 */
	public function getESTADO_BONO_CVE(){
		return $this->ESTADO_BONO_CVE;
	}

	/**
	 * @param Type: date
	 */
	public function setCAN_BON_REG_FCH($CAN_BON_REG_FCH){
		$this->CAN_BON_REG_FCH = $CAN_BON_REG_FCH;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setCAN_BON_REG_CVE($CAN_BON_REG_CVE){
		$this->CAN_BON_REG_CVE = $CAN_BON_REG_CVE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setCAN_BON_REG_PROMEDIO($CAN_BON_REG_PROMEDIO){
		$this->CAN_BON_REG_PROMEDIO = $CAN_BON_REG_PROMEDIO;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setCAN_BON_REG_MSG($CAN_BON_REG_MSG){
		$this->CAN_BON_REG_MSG = $CAN_BON_REG_MSG;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setEMP_CAN_BONO_CVE($EMP_CAN_BONO_CVE){
		$this->EMP_CAN_BONO_CVE = $EMP_CAN_BONO_CVE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setESTADO_BONO_CVE($ESTADO_BONO_CVE){
		$this->ESTADO_BONO_CVE = $ESTADO_BONO_CVE;
	}

    /**
     * Close mysql connection
     */
	public function endcan_bono_registro(){
		$this->connection->CloseMysql();
	}

}