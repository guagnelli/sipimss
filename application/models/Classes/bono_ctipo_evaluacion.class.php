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

Class bono_ctipo_evaluacion {

	private $tipo_eva_cve; //int(11)
	private $tipo_eva_nombre; //varchar(100)
	private $id_regla_evaluacion; //int(11)
	private $connection;

	public function bono_ctipo_evaluacion(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_bono_ctipo_evaluacion($tipo_eva_nombre,$id_regla_evaluacion){
		$this->tipo_eva_nombre = $tipo_eva_nombre;
		$this->id_regla_evaluacion = $id_regla_evaluacion;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from bono_ctipo_evaluacion where tipo_eva_cve = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->tipo_eva_cve = $row["tipo_eva_cve"];
			$this->tipo_eva_nombre = $row["tipo_eva_nombre"];
			$this->id_regla_evaluacion = $row["id_regla_evaluacion"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM bono_ctipo_evaluacion WHERE tipo_eva_cve = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE bono_ctipo_evaluacion set tipo_eva_nombre = \"$this->tipo_eva_nombre\", id_regla_evaluacion = \"$this->id_regla_evaluacion\" where tipo_eva_cve = \"$this->tipo_eva_cve\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into bono_ctipo_evaluacion (tipo_eva_nombre, id_regla_evaluacion) values (\"$this->tipo_eva_nombre\", \"$this->id_regla_evaluacion\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT tipo_eva_cve from bono_ctipo_evaluacion order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["tipo_eva_cve"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return tipo_eva_cve - int(11)
	 */
	public function gettipo_eva_cve(){
		return $this->tipo_eva_cve;
	}

	/**
	 * @return tipo_eva_nombre - varchar(100)
	 */
	public function gettipo_eva_nombre(){
		return $this->tipo_eva_nombre;
	}

	/**
	 * @return id_regla_evaluacion - int(11)
	 */
	public function getid_regla_evaluacion(){
		return $this->id_regla_evaluacion;
	}

	/**
	 * @param Type: int(11)
	 */
	public function settipo_eva_cve($tipo_eva_cve){
		$this->tipo_eva_cve = $tipo_eva_cve;
	}

	/**
	 * @param Type: varchar(100)
	 */
	public function settipo_eva_nombre($tipo_eva_nombre){
		$this->tipo_eva_nombre = $tipo_eva_nombre;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setid_regla_evaluacion($id_regla_evaluacion){
		$this->id_regla_evaluacion = $id_regla_evaluacion;
	}

    /**
     * Close mysql connection
     */
	public function endbono_ctipo_evaluacion(){
		$this->connection->CloseMysql();
	}

}