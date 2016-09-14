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

Class cita_tipo_libro {

	private $CITA_CVE; //int(11)
	private $CIT_TIP_LIB_CIUDAD; //varchar(20)
	private $CIT_TIP_LIB_EDITORIAL; //varchar(20)
	private $CIT_TIP_LIB_EDICION; //varchar(20)
	private $CIT_TIP_LIB_VOLUMEN; //varchar(20)
	private $CIT_TIP_LIB_NUMERO_VOLUMENES; //int(11)
	private $CIT_TIP_LIB_TRADUCTOR; //varchar(20)
	private $CIT_TIP_LIB_TITULO_BREVE; //varchar(20)
	private $CIT_TIP_LIB_NUMERO_ESTANDAR; //int(11)
	private $CIT_TIP_LIB_PAGINAS; //int(11)
	private $CIT_TIP_LIB_COMENTARIO; //varchar(200)
	private $CIT_TIP_LIB_SOPORTE; //varchar(20)
	private $CIT_TIP_LIB_ANIO_CONSULTA; //int(11)
	private $CIT_TIP_LIB_MES_CONSULTA; //varchar(20)
	private $CIT_TIP_LIB_DIA_CONSULTA; //varchar(20)
	private $CIT_TIP_LIB_URL; //varchar(200)
	private $CIT_TIP_LIB_DOI; //varchar(20)
	private $connection;

	public function cita_tipo_libro(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_cita_tipo_libro($CIT_TIP_LIB_CIUDAD,$CIT_TIP_LIB_EDITORIAL,$CIT_TIP_LIB_EDICION,$CIT_TIP_LIB_VOLUMEN,$CIT_TIP_LIB_NUMERO_VOLUMENES,$CIT_TIP_LIB_TRADUCTOR,$CIT_TIP_LIB_TITULO_BREVE,$CIT_TIP_LIB_NUMERO_ESTANDAR,$CIT_TIP_LIB_PAGINAS,$CIT_TIP_LIB_COMENTARIO,$CIT_TIP_LIB_SOPORTE,$CIT_TIP_LIB_ANIO_CONSULTA,$CIT_TIP_LIB_MES_CONSULTA,$CIT_TIP_LIB_DIA_CONSULTA,$CIT_TIP_LIB_URL,$CIT_TIP_LIB_DOI){
		$this->CIT_TIP_LIB_CIUDAD = $CIT_TIP_LIB_CIUDAD;
		$this->CIT_TIP_LIB_EDITORIAL = $CIT_TIP_LIB_EDITORIAL;
		$this->CIT_TIP_LIB_EDICION = $CIT_TIP_LIB_EDICION;
		$this->CIT_TIP_LIB_VOLUMEN = $CIT_TIP_LIB_VOLUMEN;
		$this->CIT_TIP_LIB_NUMERO_VOLUMENES = $CIT_TIP_LIB_NUMERO_VOLUMENES;
		$this->CIT_TIP_LIB_TRADUCTOR = $CIT_TIP_LIB_TRADUCTOR;
		$this->CIT_TIP_LIB_TITULO_BREVE = $CIT_TIP_LIB_TITULO_BREVE;
		$this->CIT_TIP_LIB_NUMERO_ESTANDAR = $CIT_TIP_LIB_NUMERO_ESTANDAR;
		$this->CIT_TIP_LIB_PAGINAS = $CIT_TIP_LIB_PAGINAS;
		$this->CIT_TIP_LIB_COMENTARIO = $CIT_TIP_LIB_COMENTARIO;
		$this->CIT_TIP_LIB_SOPORTE = $CIT_TIP_LIB_SOPORTE;
		$this->CIT_TIP_LIB_ANIO_CONSULTA = $CIT_TIP_LIB_ANIO_CONSULTA;
		$this->CIT_TIP_LIB_MES_CONSULTA = $CIT_TIP_LIB_MES_CONSULTA;
		$this->CIT_TIP_LIB_DIA_CONSULTA = $CIT_TIP_LIB_DIA_CONSULTA;
		$this->CIT_TIP_LIB_URL = $CIT_TIP_LIB_URL;
		$this->CIT_TIP_LIB_DOI = $CIT_TIP_LIB_DOI;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from cita_tipo_libro where CITA_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->CITA_CVE = $row["CITA_CVE"];
			$this->CIT_TIP_LIB_CIUDAD = $row["CIT_TIP_LIB_CIUDAD"];
			$this->CIT_TIP_LIB_EDITORIAL = $row["CIT_TIP_LIB_EDITORIAL"];
			$this->CIT_TIP_LIB_EDICION = $row["CIT_TIP_LIB_EDICION"];
			$this->CIT_TIP_LIB_VOLUMEN = $row["CIT_TIP_LIB_VOLUMEN"];
			$this->CIT_TIP_LIB_NUMERO_VOLUMENES = $row["CIT_TIP_LIB_NUMERO_VOLUMENES"];
			$this->CIT_TIP_LIB_TRADUCTOR = $row["CIT_TIP_LIB_TRADUCTOR"];
			$this->CIT_TIP_LIB_TITULO_BREVE = $row["CIT_TIP_LIB_TITULO_BREVE"];
			$this->CIT_TIP_LIB_NUMERO_ESTANDAR = $row["CIT_TIP_LIB_NUMERO_ESTANDAR"];
			$this->CIT_TIP_LIB_PAGINAS = $row["CIT_TIP_LIB_PAGINAS"];
			$this->CIT_TIP_LIB_COMENTARIO = $row["CIT_TIP_LIB_COMENTARIO"];
			$this->CIT_TIP_LIB_SOPORTE = $row["CIT_TIP_LIB_SOPORTE"];
			$this->CIT_TIP_LIB_ANIO_CONSULTA = $row["CIT_TIP_LIB_ANIO_CONSULTA"];
			$this->CIT_TIP_LIB_MES_CONSULTA = $row["CIT_TIP_LIB_MES_CONSULTA"];
			$this->CIT_TIP_LIB_DIA_CONSULTA = $row["CIT_TIP_LIB_DIA_CONSULTA"];
			$this->CIT_TIP_LIB_URL = $row["CIT_TIP_LIB_URL"];
			$this->CIT_TIP_LIB_DOI = $row["CIT_TIP_LIB_DOI"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM cita_tipo_libro WHERE CITA_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE cita_tipo_libro set CIT_TIP_LIB_CIUDAD = \"$this->CIT_TIP_LIB_CIUDAD\", CIT_TIP_LIB_EDITORIAL = \"$this->CIT_TIP_LIB_EDITORIAL\", CIT_TIP_LIB_EDICION = \"$this->CIT_TIP_LIB_EDICION\", CIT_TIP_LIB_VOLUMEN = \"$this->CIT_TIP_LIB_VOLUMEN\", CIT_TIP_LIB_NUMERO_VOLUMENES = \"$this->CIT_TIP_LIB_NUMERO_VOLUMENES\", CIT_TIP_LIB_TRADUCTOR = \"$this->CIT_TIP_LIB_TRADUCTOR\", CIT_TIP_LIB_TITULO_BREVE = \"$this->CIT_TIP_LIB_TITULO_BREVE\", CIT_TIP_LIB_NUMERO_ESTANDAR = \"$this->CIT_TIP_LIB_NUMERO_ESTANDAR\", CIT_TIP_LIB_PAGINAS = \"$this->CIT_TIP_LIB_PAGINAS\", CIT_TIP_LIB_COMENTARIO = \"$this->CIT_TIP_LIB_COMENTARIO\", CIT_TIP_LIB_SOPORTE = \"$this->CIT_TIP_LIB_SOPORTE\", CIT_TIP_LIB_ANIO_CONSULTA = \"$this->CIT_TIP_LIB_ANIO_CONSULTA\", CIT_TIP_LIB_MES_CONSULTA = \"$this->CIT_TIP_LIB_MES_CONSULTA\", CIT_TIP_LIB_DIA_CONSULTA = \"$this->CIT_TIP_LIB_DIA_CONSULTA\", CIT_TIP_LIB_URL = \"$this->CIT_TIP_LIB_URL\", CIT_TIP_LIB_DOI = \"$this->CIT_TIP_LIB_DOI\" where CITA_CVE = \"$this->CITA_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into cita_tipo_libro (CIT_TIP_LIB_CIUDAD, CIT_TIP_LIB_EDITORIAL, CIT_TIP_LIB_EDICION, CIT_TIP_LIB_VOLUMEN, CIT_TIP_LIB_NUMERO_VOLUMENES, CIT_TIP_LIB_TRADUCTOR, CIT_TIP_LIB_TITULO_BREVE, CIT_TIP_LIB_NUMERO_ESTANDAR, CIT_TIP_LIB_PAGINAS, CIT_TIP_LIB_COMENTARIO, CIT_TIP_LIB_SOPORTE, CIT_TIP_LIB_ANIO_CONSULTA, CIT_TIP_LIB_MES_CONSULTA, CIT_TIP_LIB_DIA_CONSULTA, CIT_TIP_LIB_URL, CIT_TIP_LIB_DOI) values (\"$this->CIT_TIP_LIB_CIUDAD\", \"$this->CIT_TIP_LIB_EDITORIAL\", \"$this->CIT_TIP_LIB_EDICION\", \"$this->CIT_TIP_LIB_VOLUMEN\", \"$this->CIT_TIP_LIB_NUMERO_VOLUMENES\", \"$this->CIT_TIP_LIB_TRADUCTOR\", \"$this->CIT_TIP_LIB_TITULO_BREVE\", \"$this->CIT_TIP_LIB_NUMERO_ESTANDAR\", \"$this->CIT_TIP_LIB_PAGINAS\", \"$this->CIT_TIP_LIB_COMENTARIO\", \"$this->CIT_TIP_LIB_SOPORTE\", \"$this->CIT_TIP_LIB_ANIO_CONSULTA\", \"$this->CIT_TIP_LIB_MES_CONSULTA\", \"$this->CIT_TIP_LIB_DIA_CONSULTA\", \"$this->CIT_TIP_LIB_URL\", \"$this->CIT_TIP_LIB_DOI\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT CITA_CVE from cita_tipo_libro order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["CITA_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return CITA_CVE - int(11)
	 */
	public function getCITA_CVE(){
		return $this->CITA_CVE;
	}

	/**
	 * @return CIT_TIP_LIB_CIUDAD - varchar(20)
	 */
	public function getCIT_TIP_LIB_CIUDAD(){
		return $this->CIT_TIP_LIB_CIUDAD;
	}

	/**
	 * @return CIT_TIP_LIB_EDITORIAL - varchar(20)
	 */
	public function getCIT_TIP_LIB_EDITORIAL(){
		return $this->CIT_TIP_LIB_EDITORIAL;
	}

	/**
	 * @return CIT_TIP_LIB_EDICION - varchar(20)
	 */
	public function getCIT_TIP_LIB_EDICION(){
		return $this->CIT_TIP_LIB_EDICION;
	}

	/**
	 * @return CIT_TIP_LIB_VOLUMEN - varchar(20)
	 */
	public function getCIT_TIP_LIB_VOLUMEN(){
		return $this->CIT_TIP_LIB_VOLUMEN;
	}

	/**
	 * @return CIT_TIP_LIB_NUMERO_VOLUMENES - int(11)
	 */
	public function getCIT_TIP_LIB_NUMERO_VOLUMENES(){
		return $this->CIT_TIP_LIB_NUMERO_VOLUMENES;
	}

	/**
	 * @return CIT_TIP_LIB_TRADUCTOR - varchar(20)
	 */
	public function getCIT_TIP_LIB_TRADUCTOR(){
		return $this->CIT_TIP_LIB_TRADUCTOR;
	}

	/**
	 * @return CIT_TIP_LIB_TITULO_BREVE - varchar(20)
	 */
	public function getCIT_TIP_LIB_TITULO_BREVE(){
		return $this->CIT_TIP_LIB_TITULO_BREVE;
	}

	/**
	 * @return CIT_TIP_LIB_NUMERO_ESTANDAR - int(11)
	 */
	public function getCIT_TIP_LIB_NUMERO_ESTANDAR(){
		return $this->CIT_TIP_LIB_NUMERO_ESTANDAR;
	}

	/**
	 * @return CIT_TIP_LIB_PAGINAS - int(11)
	 */
	public function getCIT_TIP_LIB_PAGINAS(){
		return $this->CIT_TIP_LIB_PAGINAS;
	}

	/**
	 * @return CIT_TIP_LIB_COMENTARIO - varchar(200)
	 */
	public function getCIT_TIP_LIB_COMENTARIO(){
		return $this->CIT_TIP_LIB_COMENTARIO;
	}

	/**
	 * @return CIT_TIP_LIB_SOPORTE - varchar(20)
	 */
	public function getCIT_TIP_LIB_SOPORTE(){
		return $this->CIT_TIP_LIB_SOPORTE;
	}

	/**
	 * @return CIT_TIP_LIB_ANIO_CONSULTA - int(11)
	 */
	public function getCIT_TIP_LIB_ANIO_CONSULTA(){
		return $this->CIT_TIP_LIB_ANIO_CONSULTA;
	}

	/**
	 * @return CIT_TIP_LIB_MES_CONSULTA - varchar(20)
	 */
	public function getCIT_TIP_LIB_MES_CONSULTA(){
		return $this->CIT_TIP_LIB_MES_CONSULTA;
	}

	/**
	 * @return CIT_TIP_LIB_DIA_CONSULTA - varchar(20)
	 */
	public function getCIT_TIP_LIB_DIA_CONSULTA(){
		return $this->CIT_TIP_LIB_DIA_CONSULTA;
	}

	/**
	 * @return CIT_TIP_LIB_URL - varchar(200)
	 */
	public function getCIT_TIP_LIB_URL(){
		return $this->CIT_TIP_LIB_URL;
	}

	/**
	 * @return CIT_TIP_LIB_DOI - varchar(20)
	 */
	public function getCIT_TIP_LIB_DOI(){
		return $this->CIT_TIP_LIB_DOI;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setCITA_CVE($CITA_CVE){
		$this->CITA_CVE = $CITA_CVE;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setCIT_TIP_LIB_CIUDAD($CIT_TIP_LIB_CIUDAD){
		$this->CIT_TIP_LIB_CIUDAD = $CIT_TIP_LIB_CIUDAD;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setCIT_TIP_LIB_EDITORIAL($CIT_TIP_LIB_EDITORIAL){
		$this->CIT_TIP_LIB_EDITORIAL = $CIT_TIP_LIB_EDITORIAL;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setCIT_TIP_LIB_EDICION($CIT_TIP_LIB_EDICION){
		$this->CIT_TIP_LIB_EDICION = $CIT_TIP_LIB_EDICION;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setCIT_TIP_LIB_VOLUMEN($CIT_TIP_LIB_VOLUMEN){
		$this->CIT_TIP_LIB_VOLUMEN = $CIT_TIP_LIB_VOLUMEN;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setCIT_TIP_LIB_NUMERO_VOLUMENES($CIT_TIP_LIB_NUMERO_VOLUMENES){
		$this->CIT_TIP_LIB_NUMERO_VOLUMENES = $CIT_TIP_LIB_NUMERO_VOLUMENES;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setCIT_TIP_LIB_TRADUCTOR($CIT_TIP_LIB_TRADUCTOR){
		$this->CIT_TIP_LIB_TRADUCTOR = $CIT_TIP_LIB_TRADUCTOR;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setCIT_TIP_LIB_TITULO_BREVE($CIT_TIP_LIB_TITULO_BREVE){
		$this->CIT_TIP_LIB_TITULO_BREVE = $CIT_TIP_LIB_TITULO_BREVE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setCIT_TIP_LIB_NUMERO_ESTANDAR($CIT_TIP_LIB_NUMERO_ESTANDAR){
		$this->CIT_TIP_LIB_NUMERO_ESTANDAR = $CIT_TIP_LIB_NUMERO_ESTANDAR;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setCIT_TIP_LIB_PAGINAS($CIT_TIP_LIB_PAGINAS){
		$this->CIT_TIP_LIB_PAGINAS = $CIT_TIP_LIB_PAGINAS;
	}

	/**
	 * @param Type: varchar(200)
	 */
	public function setCIT_TIP_LIB_COMENTARIO($CIT_TIP_LIB_COMENTARIO){
		$this->CIT_TIP_LIB_COMENTARIO = $CIT_TIP_LIB_COMENTARIO;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setCIT_TIP_LIB_SOPORTE($CIT_TIP_LIB_SOPORTE){
		$this->CIT_TIP_LIB_SOPORTE = $CIT_TIP_LIB_SOPORTE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setCIT_TIP_LIB_ANIO_CONSULTA($CIT_TIP_LIB_ANIO_CONSULTA){
		$this->CIT_TIP_LIB_ANIO_CONSULTA = $CIT_TIP_LIB_ANIO_CONSULTA;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setCIT_TIP_LIB_MES_CONSULTA($CIT_TIP_LIB_MES_CONSULTA){
		$this->CIT_TIP_LIB_MES_CONSULTA = $CIT_TIP_LIB_MES_CONSULTA;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setCIT_TIP_LIB_DIA_CONSULTA($CIT_TIP_LIB_DIA_CONSULTA){
		$this->CIT_TIP_LIB_DIA_CONSULTA = $CIT_TIP_LIB_DIA_CONSULTA;
	}

	/**
	 * @param Type: varchar(200)
	 */
	public function setCIT_TIP_LIB_URL($CIT_TIP_LIB_URL){
		$this->CIT_TIP_LIB_URL = $CIT_TIP_LIB_URL;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setCIT_TIP_LIB_DOI($CIT_TIP_LIB_DOI){
		$this->CIT_TIP_LIB_DOI = $CIT_TIP_LIB_DOI;
	}

    /**
     * Close mysql connection
     */
	public function endcita_tipo_libro(){
		$this->connection->CloseMysql();
	}

}