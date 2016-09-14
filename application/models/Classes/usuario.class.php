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

Class usuario {

	private $USU_MATRICULA; //varchar(25)
	private $USUARIO_CVE; //int(11)
	private $USU_CORREO; //varchar(40)
	private $USU_CONTRASENIA; //varchar(150)
	private $USU_FCH_REGISTRO; //timestamp
	private $USU_NOMBRE; //varchar(30)
	private $USU_PATERNO; //varchar(30)
	private $USU_MATERNO; //varchar(30)
	private $USU_TEL_PARTICULAR; //int(11)
	private $ESTADO_USUARIO_CVE; //int(11)
	private $connection;

	public function usuario(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_usuario($USU_MATRICULA,$USU_CORREO,$USU_CONTRASENIA,$USU_FCH_REGISTRO,$USU_NOMBRE,$USU_PATERNO,$USU_MATERNO,$USU_TEL_PARTICULAR,$ESTADO_USUARIO_CVE){
		$this->USU_MATRICULA = $USU_MATRICULA;
		$this->USU_CORREO = $USU_CORREO;
		$this->USU_CONTRASENIA = $USU_CONTRASENIA;
		$this->USU_FCH_REGISTRO = $USU_FCH_REGISTRO;
		$this->USU_NOMBRE = $USU_NOMBRE;
		$this->USU_PATERNO = $USU_PATERNO;
		$this->USU_MATERNO = $USU_MATERNO;
		$this->USU_TEL_PARTICULAR = $USU_TEL_PARTICULAR;
		$this->ESTADO_USUARIO_CVE = $ESTADO_USUARIO_CVE;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from usuario where USUARIO_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->USU_MATRICULA = $row["USU_MATRICULA"];
			$this->USUARIO_CVE = $row["USUARIO_CVE"];
			$this->USU_CORREO = $row["USU_CORREO"];
			$this->USU_CONTRASENIA = $row["USU_CONTRASENIA"];
			$this->USU_FCH_REGISTRO = $row["USU_FCH_REGISTRO"];
			$this->USU_NOMBRE = $row["USU_NOMBRE"];
			$this->USU_PATERNO = $row["USU_PATERNO"];
			$this->USU_MATERNO = $row["USU_MATERNO"];
			$this->USU_TEL_PARTICULAR = $row["USU_TEL_PARTICULAR"];
			$this->ESTADO_USUARIO_CVE = $row["ESTADO_USUARIO_CVE"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM usuario WHERE USUARIO_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE usuario set USU_MATRICULA = \"$this->USU_MATRICULA\", USU_CORREO = \"$this->USU_CORREO\", USU_CONTRASENIA = \"$this->USU_CONTRASENIA\", USU_FCH_REGISTRO = \"$this->USU_FCH_REGISTRO\", USU_NOMBRE = \"$this->USU_NOMBRE\", USU_PATERNO = \"$this->USU_PATERNO\", USU_MATERNO = \"$this->USU_MATERNO\", USU_TEL_PARTICULAR = \"$this->USU_TEL_PARTICULAR\", ESTADO_USUARIO_CVE = \"$this->ESTADO_USUARIO_CVE\" where USUARIO_CVE = \"$this->USUARIO_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into usuario (USU_MATRICULA, USU_CORREO, USU_CONTRASENIA, USU_FCH_REGISTRO, USU_NOMBRE, USU_PATERNO, USU_MATERNO, USU_TEL_PARTICULAR, ESTADO_USUARIO_CVE) values (\"$this->USU_MATRICULA\", \"$this->USU_CORREO\", \"$this->USU_CONTRASENIA\", \"$this->USU_FCH_REGISTRO\", \"$this->USU_NOMBRE\", \"$this->USU_PATERNO\", \"$this->USU_MATERNO\", \"$this->USU_TEL_PARTICULAR\", \"$this->ESTADO_USUARIO_CVE\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT USUARIO_CVE from usuario order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["USUARIO_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return USU_MATRICULA - varchar(25)
	 */
	public function getUSU_MATRICULA(){
		return $this->USU_MATRICULA;
	}

	/**
	 * @return USUARIO_CVE - int(11)
	 */
	public function getUSUARIO_CVE(){
		return $this->USUARIO_CVE;
	}

	/**
	 * @return USU_CORREO - varchar(40)
	 */
	public function getUSU_CORREO(){
		return $this->USU_CORREO;
	}

	/**
	 * @return USU_CONTRASENIA - varchar(150)
	 */
	public function getUSU_CONTRASENIA(){
		return $this->USU_CONTRASENIA;
	}

	/**
	 * @return USU_FCH_REGISTRO - timestamp
	 */
	public function getUSU_FCH_REGISTRO(){
		return $this->USU_FCH_REGISTRO;
	}

	/**
	 * @return USU_NOMBRE - varchar(30)
	 */
	public function getUSU_NOMBRE(){
		return $this->USU_NOMBRE;
	}

	/**
	 * @return USU_PATERNO - varchar(30)
	 */
	public function getUSU_PATERNO(){
		return $this->USU_PATERNO;
	}

	/**
	 * @return USU_MATERNO - varchar(30)
	 */
	public function getUSU_MATERNO(){
		return $this->USU_MATERNO;
	}

	/**
	 * @return USU_TEL_PARTICULAR - int(11)
	 */
	public function getUSU_TEL_PARTICULAR(){
		return $this->USU_TEL_PARTICULAR;
	}

	/**
	 * @return ESTADO_USUARIO_CVE - int(11)
	 */
	public function getESTADO_USUARIO_CVE(){
		return $this->ESTADO_USUARIO_CVE;
	}

	/**
	 * @param Type: varchar(25)
	 */
	public function setUSU_MATRICULA($USU_MATRICULA){
		$this->USU_MATRICULA = $USU_MATRICULA;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setUSUARIO_CVE($USUARIO_CVE){
		$this->USUARIO_CVE = $USUARIO_CVE;
	}

	/**
	 * @param Type: varchar(40)
	 */
	public function setUSU_CORREO($USU_CORREO){
		$this->USU_CORREO = $USU_CORREO;
	}

	/**
	 * @param Type: varchar(150)
	 */
	public function setUSU_CONTRASENIA($USU_CONTRASENIA){
		$this->USU_CONTRASENIA = $USU_CONTRASENIA;
	}

	/**
	 * @param Type: timestamp
	 */
	public function setUSU_FCH_REGISTRO($USU_FCH_REGISTRO){
		$this->USU_FCH_REGISTRO = $USU_FCH_REGISTRO;
	}

	/**
	 * @param Type: varchar(30)
	 */
	public function setUSU_NOMBRE($USU_NOMBRE){
		$this->USU_NOMBRE = $USU_NOMBRE;
	}

	/**
	 * @param Type: varchar(30)
	 */
	public function setUSU_PATERNO($USU_PATERNO){
		$this->USU_PATERNO = $USU_PATERNO;
	}

	/**
	 * @param Type: varchar(30)
	 */
	public function setUSU_MATERNO($USU_MATERNO){
		$this->USU_MATERNO = $USU_MATERNO;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setUSU_TEL_PARTICULAR($USU_TEL_PARTICULAR){
		$this->USU_TEL_PARTICULAR = $USU_TEL_PARTICULAR;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setESTADO_USUARIO_CVE($ESTADO_USUARIO_CVE){
		$this->ESTADO_USUARIO_CVE = $ESTADO_USUARIO_CVE;
	}

    /**
     * Close mysql connection
     */
	public function endusuario(){
		$this->connection->CloseMysql();
	}

}