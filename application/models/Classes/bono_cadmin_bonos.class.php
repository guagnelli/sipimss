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

Class bono_cadmin_bonos {

	private $id_admin; //int(11)
	private $usr_matricula; //varchar(20)
	private $usr_nombre; //varchar(60)
	private $usr_paterno; //varchar(60)
	private $usr_materno; //varchar(60)
	private $usr_correo; //varchar(80)
	private $usr_activo; //decimal(1,0)
	private $usr_passwd; //char(128)
	private $usr_rol_admin; //tinyint(1)
	private $connection;

	public function bono_cadmin_bonos(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_bono_cadmin_bonos($usr_matricula,$usr_nombre,$usr_paterno,$usr_materno,$usr_correo,$usr_activo,$usr_passwd,$usr_rol_admin){
		$this->usr_matricula = $usr_matricula;
		$this->usr_nombre = $usr_nombre;
		$this->usr_paterno = $usr_paterno;
		$this->usr_materno = $usr_materno;
		$this->usr_correo = $usr_correo;
		$this->usr_activo = $usr_activo;
		$this->usr_passwd = $usr_passwd;
		$this->usr_rol_admin = $usr_rol_admin;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from bono_cadmin_bonos where id_admin = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->id_admin = $row["id_admin"];
			$this->usr_matricula = $row["usr_matricula"];
			$this->usr_nombre = $row["usr_nombre"];
			$this->usr_paterno = $row["usr_paterno"];
			$this->usr_materno = $row["usr_materno"];
			$this->usr_correo = $row["usr_correo"];
			$this->usr_activo = $row["usr_activo"];
			$this->usr_passwd = $row["usr_passwd"];
			$this->usr_rol_admin = $row["usr_rol_admin"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM bono_cadmin_bonos WHERE id_admin = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE bono_cadmin_bonos set usr_matricula = \"$this->usr_matricula\", usr_nombre = \"$this->usr_nombre\", usr_paterno = \"$this->usr_paterno\", usr_materno = \"$this->usr_materno\", usr_correo = \"$this->usr_correo\", usr_activo = \"$this->usr_activo\", usr_passwd = \"$this->usr_passwd\", usr_rol_admin = \"$this->usr_rol_admin\" where id_admin = \"$this->id_admin\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into bono_cadmin_bonos (usr_matricula, usr_nombre, usr_paterno, usr_materno, usr_correo, usr_activo, usr_passwd, usr_rol_admin) values (\"$this->usr_matricula\", \"$this->usr_nombre\", \"$this->usr_paterno\", \"$this->usr_materno\", \"$this->usr_correo\", \"$this->usr_activo\", \"$this->usr_passwd\", \"$this->usr_rol_admin\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT id_admin from bono_cadmin_bonos order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["id_admin"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return id_admin - int(11)
	 */
	public function getid_admin(){
		return $this->id_admin;
	}

	/**
	 * @return usr_matricula - varchar(20)
	 */
	public function getusr_matricula(){
		return $this->usr_matricula;
	}

	/**
	 * @return usr_nombre - varchar(60)
	 */
	public function getusr_nombre(){
		return $this->usr_nombre;
	}

	/**
	 * @return usr_paterno - varchar(60)
	 */
	public function getusr_paterno(){
		return $this->usr_paterno;
	}

	/**
	 * @return usr_materno - varchar(60)
	 */
	public function getusr_materno(){
		return $this->usr_materno;
	}

	/**
	 * @return usr_correo - varchar(80)
	 */
	public function getusr_correo(){
		return $this->usr_correo;
	}

	/**
	 * @return usr_activo - decimal(1,0)
	 */
	public function getusr_activo(){
		return $this->usr_activo;
	}

	/**
	 * @return usr_passwd - char(128)
	 */
	public function getusr_passwd(){
		return $this->usr_passwd;
	}

	/**
	 * @return usr_rol_admin - tinyint(1)
	 */
	public function getusr_rol_admin(){
		return $this->usr_rol_admin;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setid_admin($id_admin){
		$this->id_admin = $id_admin;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setusr_matricula($usr_matricula){
		$this->usr_matricula = $usr_matricula;
	}

	/**
	 * @param Type: varchar(60)
	 */
	public function setusr_nombre($usr_nombre){
		$this->usr_nombre = $usr_nombre;
	}

	/**
	 * @param Type: varchar(60)
	 */
	public function setusr_paterno($usr_paterno){
		$this->usr_paterno = $usr_paterno;
	}

	/**
	 * @param Type: varchar(60)
	 */
	public function setusr_materno($usr_materno){
		$this->usr_materno = $usr_materno;
	}

	/**
	 * @param Type: varchar(80)
	 */
	public function setusr_correo($usr_correo){
		$this->usr_correo = $usr_correo;
	}

	/**
	 * @param Type: decimal(1,0)
	 */
	public function setusr_activo($usr_activo){
		$this->usr_activo = $usr_activo;
	}

	/**
	 * @param Type: char(128)
	 */
	public function setusr_passwd($usr_passwd){
		$this->usr_passwd = $usr_passwd;
	}

	/**
	 * @param Type: tinyint(1)
	 */
	public function setusr_rol_admin($usr_rol_admin){
		$this->usr_rol_admin = $usr_rol_admin;
	}

    /**
     * Close mysql connection
     */
	public function endbono_cadmin_bonos(){
		$this->connection->CloseMysql();
	}

}