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

Class bono_emp_can_bono {

	private $emp_can_cve; //int(11)
	private $empleado_cve; //int(11)
	private $can_periodo_bono; //int(4)
	private $can_sum_act; //smallint(3)
	private $can_estado; //smallint(1)
	private $can_tot_pro_eva; //decimal(3,1)
	private $can_correo; //varchar(100)
	private $conv_bono_cve; //int(11)
	private $connection;

	public function bono_emp_can_bono(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_bono_emp_can_bono($empleado_cve,$can_periodo_bono,$can_sum_act,$can_estado,$can_tot_pro_eva,$can_correo,$conv_bono_cve){
		$this->empleado_cve = $empleado_cve;
		$this->can_periodo_bono = $can_periodo_bono;
		$this->can_sum_act = $can_sum_act;
		$this->can_estado = $can_estado;
		$this->can_tot_pro_eva = $can_tot_pro_eva;
		$this->can_correo = $can_correo;
		$this->conv_bono_cve = $conv_bono_cve;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from bono_emp_can_bono where emp_can_cve = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->emp_can_cve = $row["emp_can_cve"];
			$this->empleado_cve = $row["empleado_cve"];
			$this->can_periodo_bono = $row["can_periodo_bono"];
			$this->can_sum_act = $row["can_sum_act"];
			$this->can_estado = $row["can_estado"];
			$this->can_tot_pro_eva = $row["can_tot_pro_eva"];
			$this->can_correo = $row["can_correo"];
			$this->conv_bono_cve = $row["conv_bono_cve"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM bono_emp_can_bono WHERE emp_can_cve = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE bono_emp_can_bono set empleado_cve = \"$this->empleado_cve\", can_periodo_bono = \"$this->can_periodo_bono\", can_sum_act = \"$this->can_sum_act\", can_estado = \"$this->can_estado\", can_tot_pro_eva = \"$this->can_tot_pro_eva\", can_correo = \"$this->can_correo\", conv_bono_cve = \"$this->conv_bono_cve\" where emp_can_cve = \"$this->emp_can_cve\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into bono_emp_can_bono (empleado_cve, can_periodo_bono, can_sum_act, can_estado, can_tot_pro_eva, can_correo, conv_bono_cve) values (\"$this->empleado_cve\", \"$this->can_periodo_bono\", \"$this->can_sum_act\", \"$this->can_estado\", \"$this->can_tot_pro_eva\", \"$this->can_correo\", \"$this->conv_bono_cve\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT emp_can_cve from bono_emp_can_bono order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["emp_can_cve"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return emp_can_cve - int(11)
	 */
	public function getemp_can_cve(){
		return $this->emp_can_cve;
	}

	/**
	 * @return empleado_cve - int(11)
	 */
	public function getempleado_cve(){
		return $this->empleado_cve;
	}

	/**
	 * @return can_periodo_bono - int(4)
	 */
	public function getcan_periodo_bono(){
		return $this->can_periodo_bono;
	}

	/**
	 * @return can_sum_act - smallint(3)
	 */
	public function getcan_sum_act(){
		return $this->can_sum_act;
	}

	/**
	 * @return can_estado - smallint(1)
	 */
	public function getcan_estado(){
		return $this->can_estado;
	}

	/**
	 * @return can_tot_pro_eva - decimal(3,1)
	 */
	public function getcan_tot_pro_eva(){
		return $this->can_tot_pro_eva;
	}

	/**
	 * @return can_correo - varchar(100)
	 */
	public function getcan_correo(){
		return $this->can_correo;
	}

	/**
	 * @return conv_bono_cve - int(11)
	 */
	public function getconv_bono_cve(){
		return $this->conv_bono_cve;
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
	public function setempleado_cve($empleado_cve){
		$this->empleado_cve = $empleado_cve;
	}

	/**
	 * @param Type: int(4)
	 */
	public function setcan_periodo_bono($can_periodo_bono){
		$this->can_periodo_bono = $can_periodo_bono;
	}

	/**
	 * @param Type: smallint(3)
	 */
	public function setcan_sum_act($can_sum_act){
		$this->can_sum_act = $can_sum_act;
	}

	/**
	 * @param Type: smallint(1)
	 */
	public function setcan_estado($can_estado){
		$this->can_estado = $can_estado;
	}

	/**
	 * @param Type: decimal(3,1)
	 */
	public function setcan_tot_pro_eva($can_tot_pro_eva){
		$this->can_tot_pro_eva = $can_tot_pro_eva;
	}

	/**
	 * @param Type: varchar(100)
	 */
	public function setcan_correo($can_correo){
		$this->can_correo = $can_correo;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setconv_bono_cve($conv_bono_cve){
		$this->conv_bono_cve = $conv_bono_cve;
	}

    /**
     * Close mysql connection
     */
	public function endbono_emp_can_bono(){
		$this->connection->CloseMysql();
	}

}