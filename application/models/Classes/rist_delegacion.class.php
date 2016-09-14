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

Class rist_delegacion {

	private $cve_delegacion; //char(2)
	private $nom_delegacion; //varchar(30)
	private $ref_tipo; //char(1)
	private $ind_baja; //smallint(6)
	private $connection;

	public function rist_delegacion(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_rist_delegacion($nom_delegacion,$ref_tipo,$ind_baja){
		$this->nom_delegacion = $nom_delegacion;
		$this->ref_tipo = $ref_tipo;
		$this->ind_baja = $ind_baja;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from rist_delegacion where cve_delegacion = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->cve_delegacion = $row["cve_delegacion"];
			$this->nom_delegacion = $row["nom_delegacion"];
			$this->ref_tipo = $row["ref_tipo"];
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
		$this->connection->RunQuery("DELETE FROM rist_delegacion WHERE cve_delegacion = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE rist_delegacion set nom_delegacion = \"$this->nom_delegacion\", ref_tipo = \"$this->ref_tipo\", ind_baja = \"$this->ind_baja\" where cve_delegacion = \"$this->cve_delegacion\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into rist_delegacion (nom_delegacion, ref_tipo, ind_baja) values (\"$this->nom_delegacion\", \"$this->ref_tipo\", \"$this->ind_baja\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT cve_delegacion from rist_delegacion order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["cve_delegacion"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return cve_delegacion - char(2)
	 */
	public function getcve_delegacion(){
		return $this->cve_delegacion;
	}

	/**
	 * @return nom_delegacion - varchar(30)
	 */
	public function getnom_delegacion(){
		return $this->nom_delegacion;
	}

	/**
	 * @return ref_tipo - char(1)
	 */
	public function getref_tipo(){
		return $this->ref_tipo;
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
	public function setcve_delegacion($cve_delegacion){
		$this->cve_delegacion = $cve_delegacion;
	}

	/**
	 * @param Type: varchar(30)
	 */
	public function setnom_delegacion($nom_delegacion){
		$this->nom_delegacion = $nom_delegacion;
	}

	/**
	 * @param Type: char(1)
	 */
	public function setref_tipo($ref_tipo){
		$this->ref_tipo = $ref_tipo;
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
	public function endrist_delegacion(){
		$this->connection->CloseMysql();
	}

}