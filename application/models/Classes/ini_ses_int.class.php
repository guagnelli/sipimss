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

Class ini_ses_int {

	private $usr_matricula; //int(11)
	private $fecha; //timestamp
	private $connection;

	public function ini_ses_int(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_ini_ses_int($usr_matricula,$fecha){
		$this->usr_matricula = $usr_matricula;
		$this->fecha = $fecha;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from ini_ses_int where usr_matricula = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->usr_matricula = $row["usr_matricula"];
			$this->fecha = $row["fecha"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM ini_ses_int WHERE usr_matricula = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE ini_ses_int set usr_matricula = \"$this->usr_matricula\", fecha = \"$this->fecha\" where usr_matricula = \"$this->usr_matricula\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into ini_ses_int (usr_matricula, fecha) values (\"$this->usr_matricula\", \"$this->fecha\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT usr_matricula from ini_ses_int order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["usr_matricula"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return usr_matricula - int(11)
	 */
	public function getusr_matricula(){
		return $this->usr_matricula;
	}

	/**
	 * @return fecha - timestamp
	 */
	public function getfecha(){
		return $this->fecha;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setusr_matricula($usr_matricula){
		$this->usr_matricula = $usr_matricula;
	}

	/**
	 * @param Type: timestamp
	 */
	public function setfecha($fecha){
		$this->fecha = $fecha;
	}

    /**
     * Close mysql connection
     */
	public function endini_ses_int(){
		$this->connection->CloseMysql();
	}

}