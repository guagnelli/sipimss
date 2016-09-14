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

Class cdelegacion {

	private $DELEGACION_CVE; //char(2)
	private $DEL_NOMBRE; //varchar(30)
	private $ref_tipo; //char(1)
	private $ref_identificador; //char(1)
	private $ind_baja; //smallint(6)
	private $connection;

	public function cdelegacion(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_cdelegacion($DEL_NOMBRE,$ref_tipo,$ref_identificador,$ind_baja){
		$this->DEL_NOMBRE = $DEL_NOMBRE;
		$this->ref_tipo = $ref_tipo;
		$this->ref_identificador = $ref_identificador;
		$this->ind_baja = $ind_baja;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from cdelegacion where DELEGACION_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->DELEGACION_CVE = $row["DELEGACION_CVE"];
			$this->DEL_NOMBRE = $row["DEL_NOMBRE"];
			$this->ref_tipo = $row["ref_tipo"];
			$this->ref_identificador = $row["ref_identificador"];
			$this->ind_baja = $row["ind_baja"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM cdelegacion WHERE DELEGACION_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE cdelegacion set DEL_NOMBRE = \"$this->DEL_NOMBRE\", ref_tipo = \"$this->ref_tipo\", ref_identificador = \"$this->ref_identificador\", ind_baja = \"$this->ind_baja\" where DELEGACION_CVE = \"$this->DELEGACION_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into cdelegacion (DEL_NOMBRE, ref_tipo, ref_identificador, ind_baja) values (\"$this->DEL_NOMBRE\", \"$this->ref_tipo\", \"$this->ref_identificador\", \"$this->ind_baja\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT DELEGACION_CVE from cdelegacion order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["DELEGACION_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return DELEGACION_CVE - char(2)
	 */
	public function getDELEGACION_CVE(){
		return $this->DELEGACION_CVE;
	}

	/**
	 * @return DEL_NOMBRE - varchar(30)
	 */
	public function getDEL_NOMBRE(){
		return $this->DEL_NOMBRE;
	}

	/**
	 * @return ref_tipo - char(1)
	 */
	public function getref_tipo(){
		return $this->ref_tipo;
	}

	/**
	 * @return ref_identificador - char(1)
	 */
	public function getref_identificador(){
		return $this->ref_identificador;
	}

	/**
	 * @return ind_baja - smallint(6)
	 */
	public function getind_baja(){
		return $this->ind_baja;
	}

	/**
	 * @param Type: char(2)
	 */
	public function setDELEGACION_CVE($DELEGACION_CVE){
		$this->DELEGACION_CVE = $DELEGACION_CVE;
	}

	/**
	 * @param Type: varchar(30)
	 */
	public function setDEL_NOMBRE($DEL_NOMBRE){
		$this->DEL_NOMBRE = $DEL_NOMBRE;
	}

	/**
	 * @param Type: char(1)
	 */
	public function setref_tipo($ref_tipo){
		$this->ref_tipo = $ref_tipo;
	}

	/**
	 * @param Type: char(1)
	 */
	public function setref_identificador($ref_identificador){
		$this->ref_identificador = $ref_identificador;
	}

	/**
	 * @param Type: smallint(6)
	 */
	public function setind_baja($ind_baja){
		$this->ind_baja = $ind_baja;
	}

    /**
     * Close mysql connection
     */
	public function endcdelegacion(){
		$this->connection->CloseMysql();
	}

}