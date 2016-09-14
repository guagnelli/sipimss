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

Class bono_can_bono_reg {

	private $reg_bono_cve; //int(11)
	private $emp_can_cve; //int(11)
	private $est_bono_cve; //int(11)
	private $reg_fecha; //datetime
	private $reg_promedio; //decimal(5,2)
	private $reg_msg; //varchar(150)
	private $tar_cve; //int(11)
	private $accion_tarjeton; //tinyint(1)
	private $act_cve; //int(11)
	private $accion_actuacion; //tinyint(1)
	private $connection;

	public function bono_can_bono_reg(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_bono_can_bono_reg($emp_can_cve,$est_bono_cve,$reg_fecha,$reg_promedio,$reg_msg,$tar_cve,$accion_tarjeton,$act_cve,$accion_actuacion){
		$this->emp_can_cve = $emp_can_cve;
		$this->est_bono_cve = $est_bono_cve;
		$this->reg_fecha = $reg_fecha;
		$this->reg_promedio = $reg_promedio;
		$this->reg_msg = $reg_msg;
		$this->tar_cve = $tar_cve;
		$this->accion_tarjeton = $accion_tarjeton;
		$this->act_cve = $act_cve;
		$this->accion_actuacion = $accion_actuacion;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from bono_can_bono_reg where reg_bono_cve = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->reg_bono_cve = $row["reg_bono_cve"];
			$this->emp_can_cve = $row["emp_can_cve"];
			$this->est_bono_cve = $row["est_bono_cve"];
			$this->reg_fecha = $row["reg_fecha"];
			$this->reg_promedio = $row["reg_promedio"];
			$this->reg_msg = $row["reg_msg"];
			$this->tar_cve = $row["tar_cve"];
			$this->accion_tarjeton = $row["accion_tarjeton"];
			$this->act_cve = $row["act_cve"];
			$this->accion_actuacion = $row["accion_actuacion"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM bono_can_bono_reg WHERE reg_bono_cve = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE bono_can_bono_reg set emp_can_cve = \"$this->emp_can_cve\", est_bono_cve = \"$this->est_bono_cve\", reg_fecha = \"$this->reg_fecha\", reg_promedio = \"$this->reg_promedio\", reg_msg = \"$this->reg_msg\", tar_cve = \"$this->tar_cve\", accion_tarjeton = \"$this->accion_tarjeton\", act_cve = \"$this->act_cve\", accion_actuacion = \"$this->accion_actuacion\" where reg_bono_cve = \"$this->reg_bono_cve\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into bono_can_bono_reg (emp_can_cve, est_bono_cve, reg_fecha, reg_promedio, reg_msg, tar_cve, accion_tarjeton, act_cve, accion_actuacion) values (\"$this->emp_can_cve\", \"$this->est_bono_cve\", \"$this->reg_fecha\", \"$this->reg_promedio\", \"$this->reg_msg\", \"$this->tar_cve\", \"$this->accion_tarjeton\", \"$this->act_cve\", \"$this->accion_actuacion\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT reg_bono_cve from bono_can_bono_reg order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["reg_bono_cve"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return reg_bono_cve - int(11)
	 */
	public function getreg_bono_cve(){
		return $this->reg_bono_cve;
	}

	/**
	 * @return emp_can_cve - int(11)
	 */
	public function getemp_can_cve(){
		return $this->emp_can_cve;
	}

	/**
	 * @return est_bono_cve - int(11)
	 */
	public function getest_bono_cve(){
		return $this->est_bono_cve;
	}

	/**
	 * @return reg_fecha - datetime
	 */
	public function getreg_fecha(){
		return $this->reg_fecha;
	}

	/**
	 * @return reg_promedio - decimal(5,2)
	 */
	public function getreg_promedio(){
		return $this->reg_promedio;
	}

	/**
	 * @return reg_msg - varchar(150)
	 */
	public function getreg_msg(){
		return $this->reg_msg;
	}

	/**
	 * @return tar_cve - int(11)
	 */
	public function gettar_cve(){
		return $this->tar_cve;
	}

	/**
	 * @return accion_tarjeton - tinyint(1)
	 */
	public function getaccion_tarjeton(){
		return $this->accion_tarjeton;
	}

	/**
	 * @return act_cve - int(11)
	 */
	public function getact_cve(){
		return $this->act_cve;
	}

	/**
	 * @return accion_actuacion - tinyint(1)
	 */
	public function getaccion_actuacion(){
		return $this->accion_actuacion;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setreg_bono_cve($reg_bono_cve){
		$this->reg_bono_cve = $reg_bono_cve;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setemp_can_cve($emp_can_cve){
		$this->emp_can_cve = $emp_can_cve;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setest_bono_cve($est_bono_cve){
		$this->est_bono_cve = $est_bono_cve;
	}

	/**
	 * @param Type: datetime
	 */
	public function setreg_fecha($reg_fecha){
		$this->reg_fecha = $reg_fecha;
	}

	/**
	 * @param Type: decimal(5,2)
	 */
	public function setreg_promedio($reg_promedio){
		$this->reg_promedio = $reg_promedio;
	}

	/**
	 * @param Type: varchar(150)
	 */
	public function setreg_msg($reg_msg){
		$this->reg_msg = $reg_msg;
	}

	/**
	 * @param Type: int(11)
	 */
	public function settar_cve($tar_cve){
		$this->tar_cve = $tar_cve;
	}

	/**
	 * @param Type: tinyint(1)
	 */
	public function setaccion_tarjeton($accion_tarjeton){
		$this->accion_tarjeton = $accion_tarjeton;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setact_cve($act_cve){
		$this->act_cve = $act_cve;
	}

	/**
	 * @param Type: tinyint(1)
	 */
	public function setaccion_actuacion($accion_actuacion){
		$this->accion_actuacion = $accion_actuacion;
	}

    /**
     * Close mysql connection
     */
	public function endbono_can_bono_reg(){
		$this->connection->CloseMysql();
	}

}