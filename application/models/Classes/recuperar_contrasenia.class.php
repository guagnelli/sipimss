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

Class recuperar_contrasenia {

	private $REC_CON_CVE; //int(11)
	private $REC_CON_CODIGO; //varchar(20)
	private $REC_CON_FCH; //timestamp
	private $REC_CON_ESTADO; //varchar(20)
	private $USUARIO_CVE; //int(11)
	private $connection;

	public function recuperar_contrasenia(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_recuperar_contrasenia($REC_CON_CODIGO,$REC_CON_FCH,$REC_CON_ESTADO,$USUARIO_CVE){
		$this->REC_CON_CODIGO = $REC_CON_CODIGO;
		$this->REC_CON_FCH = $REC_CON_FCH;
		$this->REC_CON_ESTADO = $REC_CON_ESTADO;
		$this->USUARIO_CVE = $USUARIO_CVE;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from recuperar_contrasenia where REC_CON_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->REC_CON_CVE = $row["REC_CON_CVE"];
			$this->REC_CON_CODIGO = $row["REC_CON_CODIGO"];
			$this->REC_CON_FCH = $row["REC_CON_FCH"];
			$this->REC_CON_ESTADO = $row["REC_CON_ESTADO"];
			$this->USUARIO_CVE = $row["USUARIO_CVE"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM recuperar_contrasenia WHERE REC_CON_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE recuperar_contrasenia set REC_CON_CODIGO = \"$this->REC_CON_CODIGO\", REC_CON_FCH = \"$this->REC_CON_FCH\", REC_CON_ESTADO = \"$this->REC_CON_ESTADO\", USUARIO_CVE = \"$this->USUARIO_CVE\" where REC_CON_CVE = \"$this->REC_CON_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into recuperar_contrasenia (REC_CON_CODIGO, REC_CON_FCH, REC_CON_ESTADO, USUARIO_CVE) values (\"$this->REC_CON_CODIGO\", \"$this->REC_CON_FCH\", \"$this->REC_CON_ESTADO\", \"$this->USUARIO_CVE\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT REC_CON_CVE from recuperar_contrasenia order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["REC_CON_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return REC_CON_CVE - int(11)
	 */
	public function getREC_CON_CVE(){
		return $this->REC_CON_CVE;
	}

	/**
	 * @return REC_CON_CODIGO - varchar(20)
	 */
	public function getREC_CON_CODIGO(){
		return $this->REC_CON_CODIGO;
	}

	/**
	 * @return REC_CON_FCH - timestamp
	 */
	public function getREC_CON_FCH(){
		return $this->REC_CON_FCH;
	}

	/**
	 * @return REC_CON_ESTADO - varchar(20)
	 */
	public function getREC_CON_ESTADO(){
		return $this->REC_CON_ESTADO;
	}

	/**
	 * @return USUARIO_CVE - int(11)
	 */
	public function getUSUARIO_CVE(){
		return $this->USUARIO_CVE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setREC_CON_CVE($REC_CON_CVE){
		$this->REC_CON_CVE = $REC_CON_CVE;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setREC_CON_CODIGO($REC_CON_CODIGO){
		$this->REC_CON_CODIGO = $REC_CON_CODIGO;
	}

	/**
	 * @param Type: timestamp
	 */
	public function setREC_CON_FCH($REC_CON_FCH){
		$this->REC_CON_FCH = $REC_CON_FCH;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setREC_CON_ESTADO($REC_CON_ESTADO){
		$this->REC_CON_ESTADO = $REC_CON_ESTADO;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setUSUARIO_CVE($USUARIO_CVE){
		$this->USUARIO_CVE = $USUARIO_CVE;
	}

    /**
     * Close mysql connection
     */
	public function endrecuperar_contrasenia(){
		$this->connection->CloseMysql();
	}

}