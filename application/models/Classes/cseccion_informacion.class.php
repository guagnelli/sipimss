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

Class cseccion_informacion {

	private $sec_info_cve; //int(11)
	private $csi_nombre; //varchar(50)
	private $csi_entidad; //varchar(50)
	private $nom_camp_pk; //varchar(30)
	private $connection;

	public function cseccion_informacion(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_cseccion_informacion($csi_nombre,$csi_entidad,$nom_camp_pk){
		$this->csi_nombre = $csi_nombre;
		$this->csi_entidad = $csi_entidad;
		$this->nom_camp_pk = $nom_camp_pk;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from cseccion_informacion where sec_info_cve = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->sec_info_cve = $row["sec_info_cve"];
			$this->csi_nombre = $row["csi_nombre"];
			$this->csi_entidad = $row["csi_entidad"];
			$this->nom_camp_pk = $row["nom_camp_pk"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM cseccion_informacion WHERE sec_info_cve = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE cseccion_informacion set csi_nombre = \"$this->csi_nombre\", csi_entidad = \"$this->csi_entidad\", nom_camp_pk = \"$this->nom_camp_pk\" where sec_info_cve = \"$this->sec_info_cve\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into cseccion_informacion (csi_nombre, csi_entidad, nom_camp_pk) values (\"$this->csi_nombre\", \"$this->csi_entidad\", \"$this->nom_camp_pk\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT sec_info_cve from cseccion_informacion order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["sec_info_cve"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return sec_info_cve - int(11)
	 */
	public function getsec_info_cve(){
		return $this->sec_info_cve;
	}

	/**
	 * @return csi_nombre - varchar(50)
	 */
	public function getcsi_nombre(){
		return $this->csi_nombre;
	}

	/**
	 * @return csi_entidad - varchar(50)
	 */
	public function getcsi_entidad(){
		return $this->csi_entidad;
	}

	/**
	 * @return nom_camp_pk - varchar(30)
	 */
	public function getnom_camp_pk(){
		return $this->nom_camp_pk;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setsec_info_cve($sec_info_cve){
		$this->sec_info_cve = $sec_info_cve;
	}

	/**
	 * @param Type: varchar(50)
	 */
	public function setcsi_nombre($csi_nombre){
		$this->csi_nombre = $csi_nombre;
	}

	/**
	 * @param Type: varchar(50)
	 */
	public function setcsi_entidad($csi_entidad){
		$this->csi_entidad = $csi_entidad;
	}

	/**
	 * @param Type: varchar(30)
	 */
	public function setnom_camp_pk($nom_camp_pk){
		$this->nom_camp_pk = $nom_camp_pk;
	}

    /**
     * Close mysql connection
     */
	public function endcseccion_informacion(){
		$this->connection->CloseMysql();
	}

}