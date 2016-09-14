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

Class bono_act_edu_dist {

	private $act_cve; //int(11)
	private $cur_edu_dist_cve; //int(11)
	private $tipo_eva_cve; //int(11)
	private $act_promedio; //decimal(5,2)
	private $connection;

	public function bono_act_edu_dist(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_bono_act_edu_dist($cur_edu_dist_cve,$tipo_eva_cve,$act_promedio){
		$this->cur_edu_dist_cve = $cur_edu_dist_cve;
		$this->tipo_eva_cve = $tipo_eva_cve;
		$this->act_promedio = $act_promedio;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from bono_act_edu_dist where act_cve = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->act_cve = $row["act_cve"];
			$this->cur_edu_dist_cve = $row["cur_edu_dist_cve"];
			$this->tipo_eva_cve = $row["tipo_eva_cve"];
			$this->act_promedio = $row["act_promedio"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM bono_act_edu_dist WHERE act_cve = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE bono_act_edu_dist set cur_edu_dist_cve = \"$this->cur_edu_dist_cve\", tipo_eva_cve = \"$this->tipo_eva_cve\", act_promedio = \"$this->act_promedio\" where act_cve = \"$this->act_cve\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into bono_act_edu_dist (cur_edu_dist_cve, tipo_eva_cve, act_promedio) values (\"$this->cur_edu_dist_cve\", \"$this->tipo_eva_cve\", \"$this->act_promedio\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT act_cve from bono_act_edu_dist order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["act_cve"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return act_cve - int(11)
	 */
	public function getact_cve(){
		return $this->act_cve;
	}

	/**
	 * @return cur_edu_dist_cve - int(11)
	 */
	public function getcur_edu_dist_cve(){
		return $this->cur_edu_dist_cve;
	}

	/**
	 * @return tipo_eva_cve - int(11)
	 */
	public function gettipo_eva_cve(){
		return $this->tipo_eva_cve;
	}

	/**
	 * @return act_promedio - decimal(5,2)
	 */
	public function getact_promedio(){
		return $this->act_promedio;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setact_cve($act_cve){
		$this->act_cve = $act_cve;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setcur_edu_dist_cve($cur_edu_dist_cve){
		$this->cur_edu_dist_cve = $cur_edu_dist_cve;
	}

	/**
	 * @param Type: int(11)
	 */
	public function settipo_eva_cve($tipo_eva_cve){
		$this->tipo_eva_cve = $tipo_eva_cve;
	}

	/**
	 * @param Type: decimal(5,2)
	 */
	public function setact_promedio($act_promedio){
		$this->act_promedio = $act_promedio;
	}

    /**
     * Close mysql connection
     */
	public function endbono_act_edu_dist(){
		$this->connection->CloseMysql();
	}

}