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

Class bono_cestado_bono {

	private $est_bono_cve; //int(11)
	private $est_nombre; //varchar(50)
	private $est_estado_nombre; //varchar(30)
	private $est_orden; //int(2)
	private $connection;

	public function bono_cestado_bono(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_bono_cestado_bono($est_nombre,$est_estado_nombre,$est_orden){
		$this->est_nombre = $est_nombre;
		$this->est_estado_nombre = $est_estado_nombre;
		$this->est_orden = $est_orden;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from bono_cestado_bono where est_bono_cve = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->est_bono_cve = $row["est_bono_cve"];
			$this->est_nombre = $row["est_nombre"];
			$this->est_estado_nombre = $row["est_estado_nombre"];
			$this->est_orden = $row["est_orden"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM bono_cestado_bono WHERE est_bono_cve = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE bono_cestado_bono set est_nombre = \"$this->est_nombre\", est_estado_nombre = \"$this->est_estado_nombre\", est_orden = \"$this->est_orden\" where est_bono_cve = \"$this->est_bono_cve\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into bono_cestado_bono (est_nombre, est_estado_nombre, est_orden) values (\"$this->est_nombre\", \"$this->est_estado_nombre\", \"$this->est_orden\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT est_bono_cve from bono_cestado_bono order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["est_bono_cve"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return est_bono_cve - int(11)
	 */
	public function getest_bono_cve(){
		return $this->est_bono_cve;
	}

	/**
	 * @return est_nombre - varchar(50)
	 */
	public function getest_nombre(){
		return $this->est_nombre;
	}

	/**
	 * @return est_estado_nombre - varchar(30)
	 */
	public function getest_estado_nombre(){
		return $this->est_estado_nombre;
	}

	/**
	 * @return est_orden - int(2)
	 */
	public function getest_orden(){
		return $this->est_orden;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setest_bono_cve($est_bono_cve){
		$this->est_bono_cve = $est_bono_cve;
	}

	/**
	 * @param Type: varchar(50)
	 */
	public function setest_nombre($est_nombre){
		$this->est_nombre = $est_nombre;
	}

	/**
	 * @param Type: varchar(30)
	 */
	public function setest_estado_nombre($est_estado_nombre){
		$this->est_estado_nombre = $est_estado_nombre;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setest_orden($est_orden){
		$this->est_orden = $est_orden;
	}

    /**
     * Close mysql connection
     */
	public function endbono_cestado_bono(){
		$this->connection->CloseMysql();
	}

}