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

Class cita_usuario {

	private $CITA_USUARIO_CVE; //int(11)
	private $CIT_USU_TIPO; //varchar(20)
	private $CIT_USU_APELLIDOS; //varchar(20)
	private $CIT_USU_NOMBRE; //varchar(20)
	private $CIT_USU_SEGUNDO_NOMBRE; //varchar(20)
	private $connection;

	public function cita_usuario(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_cita_usuario($CIT_USU_TIPO,$CIT_USU_APELLIDOS,$CIT_USU_NOMBRE,$CIT_USU_SEGUNDO_NOMBRE){
		$this->CIT_USU_TIPO = $CIT_USU_TIPO;
		$this->CIT_USU_APELLIDOS = $CIT_USU_APELLIDOS;
		$this->CIT_USU_NOMBRE = $CIT_USU_NOMBRE;
		$this->CIT_USU_SEGUNDO_NOMBRE = $CIT_USU_SEGUNDO_NOMBRE;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from cita_usuario where CITA_USUARIO_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->CITA_USUARIO_CVE = $row["CITA_USUARIO_CVE"];
			$this->CIT_USU_TIPO = $row["CIT_USU_TIPO"];
			$this->CIT_USU_APELLIDOS = $row["CIT_USU_APELLIDOS"];
			$this->CIT_USU_NOMBRE = $row["CIT_USU_NOMBRE"];
			$this->CIT_USU_SEGUNDO_NOMBRE = $row["CIT_USU_SEGUNDO_NOMBRE"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM cita_usuario WHERE CITA_USUARIO_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE cita_usuario set CIT_USU_TIPO = \"$this->CIT_USU_TIPO\", CIT_USU_APELLIDOS = \"$this->CIT_USU_APELLIDOS\", CIT_USU_NOMBRE = \"$this->CIT_USU_NOMBRE\", CIT_USU_SEGUNDO_NOMBRE = \"$this->CIT_USU_SEGUNDO_NOMBRE\" where CITA_USUARIO_CVE = \"$this->CITA_USUARIO_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into cita_usuario (CIT_USU_TIPO, CIT_USU_APELLIDOS, CIT_USU_NOMBRE, CIT_USU_SEGUNDO_NOMBRE) values (\"$this->CIT_USU_TIPO\", \"$this->CIT_USU_APELLIDOS\", \"$this->CIT_USU_NOMBRE\", \"$this->CIT_USU_SEGUNDO_NOMBRE\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT CITA_USUARIO_CVE from cita_usuario order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["CITA_USUARIO_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return CITA_USUARIO_CVE - int(11)
	 */
	public function getCITA_USUARIO_CVE(){
		return $this->CITA_USUARIO_CVE;
	}

	/**
	 * @return CIT_USU_TIPO - varchar(20)
	 */
	public function getCIT_USU_TIPO(){
		return $this->CIT_USU_TIPO;
	}

	/**
	 * @return CIT_USU_APELLIDOS - varchar(20)
	 */
	public function getCIT_USU_APELLIDOS(){
		return $this->CIT_USU_APELLIDOS;
	}

	/**
	 * @return CIT_USU_NOMBRE - varchar(20)
	 */
	public function getCIT_USU_NOMBRE(){
		return $this->CIT_USU_NOMBRE;
	}

	/**
	 * @return CIT_USU_SEGUNDO_NOMBRE - varchar(20)
	 */
	public function getCIT_USU_SEGUNDO_NOMBRE(){
		return $this->CIT_USU_SEGUNDO_NOMBRE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setCITA_USUARIO_CVE($CITA_USUARIO_CVE){
		$this->CITA_USUARIO_CVE = $CITA_USUARIO_CVE;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setCIT_USU_TIPO($CIT_USU_TIPO){
		$this->CIT_USU_TIPO = $CIT_USU_TIPO;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setCIT_USU_APELLIDOS($CIT_USU_APELLIDOS){
		$this->CIT_USU_APELLIDOS = $CIT_USU_APELLIDOS;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setCIT_USU_NOMBRE($CIT_USU_NOMBRE){
		$this->CIT_USU_NOMBRE = $CIT_USU_NOMBRE;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setCIT_USU_SEGUNDO_NOMBRE($CIT_USU_SEGUNDO_NOMBRE){
		$this->CIT_USU_SEGUNDO_NOMBRE = $CIT_USU_SEGUNDO_NOMBRE;
	}

    /**
     * Close mysql connection
     */
	public function endcita_usuario(){
		$this->connection->CloseMysql();
	}

}