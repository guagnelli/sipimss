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

Class emp_can_bono {

	private $EMP_CAN_BONO_CVE; //int(11)
	private $CAN_BON_PERIODO; //varchar(20)
	private $CAN_BON_SUM_ACTI; //varchar(20)
	private $CAN_BON_ESTADO; //varchar(20)
	private $CAN_BON_TOT_PRO_EVA; //varchar(20)
	private $CAN_BON_CORREO; //varchar(20)
	private $EMPLEADO_CVE; //int(11)
	private $connection;

	public function emp_can_bono(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_emp_can_bono($CAN_BON_PERIODO,$CAN_BON_SUM_ACTI,$CAN_BON_ESTADO,$CAN_BON_TOT_PRO_EVA,$CAN_BON_CORREO,$EMPLEADO_CVE){
		$this->CAN_BON_PERIODO = $CAN_BON_PERIODO;
		$this->CAN_BON_SUM_ACTI = $CAN_BON_SUM_ACTI;
		$this->CAN_BON_ESTADO = $CAN_BON_ESTADO;
		$this->CAN_BON_TOT_PRO_EVA = $CAN_BON_TOT_PRO_EVA;
		$this->CAN_BON_CORREO = $CAN_BON_CORREO;
		$this->EMPLEADO_CVE = $EMPLEADO_CVE;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from emp_can_bono where EMP_CAN_BONO_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->EMP_CAN_BONO_CVE = $row["EMP_CAN_BONO_CVE"];
			$this->CAN_BON_PERIODO = $row["CAN_BON_PERIODO"];
			$this->CAN_BON_SUM_ACTI = $row["CAN_BON_SUM_ACTI"];
			$this->CAN_BON_ESTADO = $row["CAN_BON_ESTADO"];
			$this->CAN_BON_TOT_PRO_EVA = $row["CAN_BON_TOT_PRO_EVA"];
			$this->CAN_BON_CORREO = $row["CAN_BON_CORREO"];
			$this->EMPLEADO_CVE = $row["EMPLEADO_CVE"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM emp_can_bono WHERE EMP_CAN_BONO_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE emp_can_bono set CAN_BON_PERIODO = \"$this->CAN_BON_PERIODO\", CAN_BON_SUM_ACTI = \"$this->CAN_BON_SUM_ACTI\", CAN_BON_ESTADO = \"$this->CAN_BON_ESTADO\", CAN_BON_TOT_PRO_EVA = \"$this->CAN_BON_TOT_PRO_EVA\", CAN_BON_CORREO = \"$this->CAN_BON_CORREO\", EMPLEADO_CVE = \"$this->EMPLEADO_CVE\" where EMP_CAN_BONO_CVE = \"$this->EMP_CAN_BONO_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into emp_can_bono (CAN_BON_PERIODO, CAN_BON_SUM_ACTI, CAN_BON_ESTADO, CAN_BON_TOT_PRO_EVA, CAN_BON_CORREO, EMPLEADO_CVE) values (\"$this->CAN_BON_PERIODO\", \"$this->CAN_BON_SUM_ACTI\", \"$this->CAN_BON_ESTADO\", \"$this->CAN_BON_TOT_PRO_EVA\", \"$this->CAN_BON_CORREO\", \"$this->EMPLEADO_CVE\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT EMP_CAN_BONO_CVE from emp_can_bono order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["EMP_CAN_BONO_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return EMP_CAN_BONO_CVE - int(11)
	 */
	public function getEMP_CAN_BONO_CVE(){
		return $this->EMP_CAN_BONO_CVE;
	}

	/**
	 * @return CAN_BON_PERIODO - varchar(20)
	 */
	public function getCAN_BON_PERIODO(){
		return $this->CAN_BON_PERIODO;
	}

	/**
	 * @return CAN_BON_SUM_ACTI - varchar(20)
	 */
	public function getCAN_BON_SUM_ACTI(){
		return $this->CAN_BON_SUM_ACTI;
	}

	/**
	 * @return CAN_BON_ESTADO - varchar(20)
	 */
	public function getCAN_BON_ESTADO(){
		return $this->CAN_BON_ESTADO;
	}

	/**
	 * @return CAN_BON_TOT_PRO_EVA - varchar(20)
	 */
	public function getCAN_BON_TOT_PRO_EVA(){
		return $this->CAN_BON_TOT_PRO_EVA;
	}

	/**
	 * @return CAN_BON_CORREO - varchar(20)
	 */
	public function getCAN_BON_CORREO(){
		return $this->CAN_BON_CORREO;
	}

	/**
	 * @return EMPLEADO_CVE - int(11)
	 */
	public function getEMPLEADO_CVE(){
		return $this->EMPLEADO_CVE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setEMP_CAN_BONO_CVE($EMP_CAN_BONO_CVE){
		$this->EMP_CAN_BONO_CVE = $EMP_CAN_BONO_CVE;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setCAN_BON_PERIODO($CAN_BON_PERIODO){
		$this->CAN_BON_PERIODO = $CAN_BON_PERIODO;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setCAN_BON_SUM_ACTI($CAN_BON_SUM_ACTI){
		$this->CAN_BON_SUM_ACTI = $CAN_BON_SUM_ACTI;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setCAN_BON_ESTADO($CAN_BON_ESTADO){
		$this->CAN_BON_ESTADO = $CAN_BON_ESTADO;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setCAN_BON_TOT_PRO_EVA($CAN_BON_TOT_PRO_EVA){
		$this->CAN_BON_TOT_PRO_EVA = $CAN_BON_TOT_PRO_EVA;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setCAN_BON_CORREO($CAN_BON_CORREO){
		$this->CAN_BON_CORREO = $CAN_BON_CORREO;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setEMPLEADO_CVE($EMPLEADO_CVE){
		$this->EMPLEADO_CVE = $EMPLEADO_CVE;
	}

    /**
     * Close mysql connection
     */
	public function endemp_can_bono(){
		$this->connection->CloseMysql();
	}

}