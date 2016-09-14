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

Class comprobante {

	private $COMPROBANTE_CVE; //int(11)
	private $COM_NOMBRE; //varchar(250)
	private $TIPO_COMPROBANTE_CVE; //int(11)
	private $com_extension; //varchar(5)
	private $FECHA_INSERSION; //timestamp
	private $connection;

	public function comprobante(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_comprobante($COM_NOMBRE,$TIPO_COMPROBANTE_CVE,$com_extension,$FECHA_INSERSION){
		$this->COM_NOMBRE = $COM_NOMBRE;
		$this->TIPO_COMPROBANTE_CVE = $TIPO_COMPROBANTE_CVE;
		$this->com_extension = $com_extension;
		$this->FECHA_INSERSION = $FECHA_INSERSION;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from comprobante where COMPROBANTE_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->COMPROBANTE_CVE = $row["COMPROBANTE_CVE"];
			$this->COM_NOMBRE = $row["COM_NOMBRE"];
			$this->TIPO_COMPROBANTE_CVE = $row["TIPO_COMPROBANTE_CVE"];
			$this->com_extension = $row["com_extension"];
			$this->FECHA_INSERSION = $row["FECHA_INSERSION"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM comprobante WHERE COMPROBANTE_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE comprobante set COM_NOMBRE = \"$this->COM_NOMBRE\", TIPO_COMPROBANTE_CVE = \"$this->TIPO_COMPROBANTE_CVE\", com_extension = \"$this->com_extension\", FECHA_INSERSION = \"$this->FECHA_INSERSION\" where COMPROBANTE_CVE = \"$this->COMPROBANTE_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into comprobante (COM_NOMBRE, TIPO_COMPROBANTE_CVE, com_extension, FECHA_INSERSION) values (\"$this->COM_NOMBRE\", \"$this->TIPO_COMPROBANTE_CVE\", \"$this->com_extension\", \"$this->FECHA_INSERSION\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT COMPROBANTE_CVE from comprobante order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["COMPROBANTE_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return COMPROBANTE_CVE - int(11)
	 */
	public function getCOMPROBANTE_CVE(){
		return $this->COMPROBANTE_CVE;
	}

	/**
	 * @return COM_NOMBRE - varchar(250)
	 */
	public function getCOM_NOMBRE(){
		return $this->COM_NOMBRE;
	}

	/**
	 * @return TIPO_COMPROBANTE_CVE - int(11)
	 */
	public function getTIPO_COMPROBANTE_CVE(){
		return $this->TIPO_COMPROBANTE_CVE;
	}

	/**
	 * @return com_extension - varchar(5)
	 */
	public function getcom_extension(){
		return $this->com_extension;
	}

	/**
	 * @return FECHA_INSERSION - timestamp
	 */
	public function getFECHA_INSERSION(){
		return $this->FECHA_INSERSION;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setCOMPROBANTE_CVE($COMPROBANTE_CVE){
		$this->COMPROBANTE_CVE = $COMPROBANTE_CVE;
	}

	/**
	 * @param Type: varchar(250)
	 */
	public function setCOM_NOMBRE($COM_NOMBRE){
		$this->COM_NOMBRE = $COM_NOMBRE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTIPO_COMPROBANTE_CVE($TIPO_COMPROBANTE_CVE){
		$this->TIPO_COMPROBANTE_CVE = $TIPO_COMPROBANTE_CVE;
	}

	/**
	 * @param Type: varchar(5)
	 */
	public function setcom_extension($com_extension){
		$this->com_extension = $com_extension;
	}

	/**
	 * @param Type: timestamp
	 */
	public function setFECHA_INSERSION($FECHA_INSERSION){
		$this->FECHA_INSERSION = $FECHA_INSERSION;
	}

    /**
     * Close mysql connection
     */
	public function endcomprobante(){
		$this->connection->CloseMysql();
	}

}