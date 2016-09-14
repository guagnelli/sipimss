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

Class cita_tipo_articulo_revista {

	private $CITA_CVE; //int(11)
	private $CTAR_MES; //varchar(20)
	private $CTAR_NOMBRE_REVISTA; //varchar(20)
	private $CTAR_VOLUMEN; //varchar(20)
	private $CTAR_NUMERO; //int(11)
	private $CTAR_CIUDAD; //varchar(20)
	private $CTAR_DIA; //varchar(20)
	private $CTAR_PAGINAS; //int(11)
	private $CTAR_EDITORIAL; //char(18)
	private $CTAR_TITULO_BREVE; //varchar(20)
	private $CTAR_NUMERO_ESATANDAR; //varchar(20)
	private $CTAR_COMENTARIO; //mediumtext
	private $CTAR_SOPORTE; //varchar(20)
	private $CTAR_ANIO_CONSULTA; //int(11)
	private $CTAR_MES_CONSULTA; //varchar(20)
	private $CTAR_DIA_CONSULTA; //varchar(20)
	private $CTAR_URL; //varchar(200)
	private $CTAR_DOI; //varchar(20)
	private $connection;

	public function cita_tipo_articulo_revista(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_cita_tipo_articulo_revista($CTAR_MES,$CTAR_NOMBRE_REVISTA,$CTAR_VOLUMEN,$CTAR_NUMERO,$CTAR_CIUDAD,$CTAR_DIA,$CTAR_PAGINAS,$CTAR_EDITORIAL,$CTAR_TITULO_BREVE,$CTAR_NUMERO_ESATANDAR,$CTAR_COMENTARIO,$CTAR_SOPORTE,$CTAR_ANIO_CONSULTA,$CTAR_MES_CONSULTA,$CTAR_DIA_CONSULTA,$CTAR_URL,$CTAR_DOI){
		$this->CTAR_MES = $CTAR_MES;
		$this->CTAR_NOMBRE_REVISTA = $CTAR_NOMBRE_REVISTA;
		$this->CTAR_VOLUMEN = $CTAR_VOLUMEN;
		$this->CTAR_NUMERO = $CTAR_NUMERO;
		$this->CTAR_CIUDAD = $CTAR_CIUDAD;
		$this->CTAR_DIA = $CTAR_DIA;
		$this->CTAR_PAGINAS = $CTAR_PAGINAS;
		$this->CTAR_EDITORIAL = $CTAR_EDITORIAL;
		$this->CTAR_TITULO_BREVE = $CTAR_TITULO_BREVE;
		$this->CTAR_NUMERO_ESATANDAR = $CTAR_NUMERO_ESATANDAR;
		$this->CTAR_COMENTARIO = $CTAR_COMENTARIO;
		$this->CTAR_SOPORTE = $CTAR_SOPORTE;
		$this->CTAR_ANIO_CONSULTA = $CTAR_ANIO_CONSULTA;
		$this->CTAR_MES_CONSULTA = $CTAR_MES_CONSULTA;
		$this->CTAR_DIA_CONSULTA = $CTAR_DIA_CONSULTA;
		$this->CTAR_URL = $CTAR_URL;
		$this->CTAR_DOI = $CTAR_DOI;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from cita_tipo_articulo_revista where CITA_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->CITA_CVE = $row["CITA_CVE"];
			$this->CTAR_MES = $row["CTAR_MES"];
			$this->CTAR_NOMBRE_REVISTA = $row["CTAR_NOMBRE_REVISTA"];
			$this->CTAR_VOLUMEN = $row["CTAR_VOLUMEN"];
			$this->CTAR_NUMERO = $row["CTAR_NUMERO"];
			$this->CTAR_CIUDAD = $row["CTAR_CIUDAD"];
			$this->CTAR_DIA = $row["CTAR_DIA"];
			$this->CTAR_PAGINAS = $row["CTAR_PAGINAS"];
			$this->CTAR_EDITORIAL = $row["CTAR_EDITORIAL"];
			$this->CTAR_TITULO_BREVE = $row["CTAR_TITULO_BREVE"];
			$this->CTAR_NUMERO_ESATANDAR = $row["CTAR_NUMERO_ESATANDAR"];
			$this->CTAR_COMENTARIO = $row["CTAR_COMENTARIO"];
			$this->CTAR_SOPORTE = $row["CTAR_SOPORTE"];
			$this->CTAR_ANIO_CONSULTA = $row["CTAR_ANIO_CONSULTA"];
			$this->CTAR_MES_CONSULTA = $row["CTAR_MES_CONSULTA"];
			$this->CTAR_DIA_CONSULTA = $row["CTAR_DIA_CONSULTA"];
			$this->CTAR_URL = $row["CTAR_URL"];
			$this->CTAR_DOI = $row["CTAR_DOI"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM cita_tipo_articulo_revista WHERE CITA_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE cita_tipo_articulo_revista set CTAR_MES = \"$this->CTAR_MES\", CTAR_NOMBRE_REVISTA = \"$this->CTAR_NOMBRE_REVISTA\", CTAR_VOLUMEN = \"$this->CTAR_VOLUMEN\", CTAR_NUMERO = \"$this->CTAR_NUMERO\", CTAR_CIUDAD = \"$this->CTAR_CIUDAD\", CTAR_DIA = \"$this->CTAR_DIA\", CTAR_PAGINAS = \"$this->CTAR_PAGINAS\", CTAR_EDITORIAL = \"$this->CTAR_EDITORIAL\", CTAR_TITULO_BREVE = \"$this->CTAR_TITULO_BREVE\", CTAR_NUMERO_ESATANDAR = \"$this->CTAR_NUMERO_ESATANDAR\", CTAR_COMENTARIO = \"$this->CTAR_COMENTARIO\", CTAR_SOPORTE = \"$this->CTAR_SOPORTE\", CTAR_ANIO_CONSULTA = \"$this->CTAR_ANIO_CONSULTA\", CTAR_MES_CONSULTA = \"$this->CTAR_MES_CONSULTA\", CTAR_DIA_CONSULTA = \"$this->CTAR_DIA_CONSULTA\", CTAR_URL = \"$this->CTAR_URL\", CTAR_DOI = \"$this->CTAR_DOI\" where CITA_CVE = \"$this->CITA_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into cita_tipo_articulo_revista (CTAR_MES, CTAR_NOMBRE_REVISTA, CTAR_VOLUMEN, CTAR_NUMERO, CTAR_CIUDAD, CTAR_DIA, CTAR_PAGINAS, CTAR_EDITORIAL, CTAR_TITULO_BREVE, CTAR_NUMERO_ESATANDAR, CTAR_COMENTARIO, CTAR_SOPORTE, CTAR_ANIO_CONSULTA, CTAR_MES_CONSULTA, CTAR_DIA_CONSULTA, CTAR_URL, CTAR_DOI) values (\"$this->CTAR_MES\", \"$this->CTAR_NOMBRE_REVISTA\", \"$this->CTAR_VOLUMEN\", \"$this->CTAR_NUMERO\", \"$this->CTAR_CIUDAD\", \"$this->CTAR_DIA\", \"$this->CTAR_PAGINAS\", \"$this->CTAR_EDITORIAL\", \"$this->CTAR_TITULO_BREVE\", \"$this->CTAR_NUMERO_ESATANDAR\", \"$this->CTAR_COMENTARIO\", \"$this->CTAR_SOPORTE\", \"$this->CTAR_ANIO_CONSULTA\", \"$this->CTAR_MES_CONSULTA\", \"$this->CTAR_DIA_CONSULTA\", \"$this->CTAR_URL\", \"$this->CTAR_DOI\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT CITA_CVE from cita_tipo_articulo_revista order by $column $order");
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
	 * @return CTAR_MES - varchar(20)
	 */
	public function getCTAR_MES(){
		return $this->CTAR_MES;
	}

	/**
	 * @return CTAR_NOMBRE_REVISTA - varchar(20)
	 */
	public function getCTAR_NOMBRE_REVISTA(){
		return $this->CTAR_NOMBRE_REVISTA;
	}

	/**
	 * @return CTAR_VOLUMEN - varchar(20)
	 */
	public function getCTAR_VOLUMEN(){
		return $this->CTAR_VOLUMEN;
	}

	/**
	 * @return CTAR_NUMERO - int(11)
	 */
	public function getCTAR_NUMERO(){
		return $this->CTAR_NUMERO;
	}

	/**
	 * @return CTAR_CIUDAD - varchar(20)
	 */
	public function getCTAR_CIUDAD(){
		return $this->CTAR_CIUDAD;
	}

	/**
	 * @return CTAR_DIA - varchar(20)
	 */
	public function getCTAR_DIA(){
		return $this->CTAR_DIA;
	}

	/**
	 * @return CTAR_PAGINAS - int(11)
	 */
	public function getCTAR_PAGINAS(){
		return $this->CTAR_PAGINAS;
	}

	/**
	 * @return CTAR_EDITORIAL - char(18)
	 */
	public function getCTAR_EDITORIAL(){
		return $this->CTAR_EDITORIAL;
	}

	/**
	 * @return CTAR_TITULO_BREVE - varchar(20)
	 */
	public function getCTAR_TITULO_BREVE(){
		return $this->CTAR_TITULO_BREVE;
	}

	/**
	 * @return CTAR_NUMERO_ESATANDAR - varchar(20)
	 */
	public function getCTAR_NUMERO_ESATANDAR(){
		return $this->CTAR_NUMERO_ESATANDAR;
	}

	/**
	 * @return CTAR_COMENTARIO - mediumtext
	 */
	public function getCTAR_COMENTARIO(){
		return $this->CTAR_COMENTARIO;
	}

	/**
	 * @return CTAR_SOPORTE - varchar(20)
	 */
	public function getCTAR_SOPORTE(){
		return $this->CTAR_SOPORTE;
	}

	/**
	 * @return CTAR_ANIO_CONSULTA - int(11)
	 */
	public function getCTAR_ANIO_CONSULTA(){
		return $this->CTAR_ANIO_CONSULTA;
	}

	/**
	 * @return CTAR_MES_CONSULTA - varchar(20)
	 */
	public function getCTAR_MES_CONSULTA(){
		return $this->CTAR_MES_CONSULTA;
	}

	/**
	 * @return CTAR_DIA_CONSULTA - varchar(20)
	 */
	public function getCTAR_DIA_CONSULTA(){
		return $this->CTAR_DIA_CONSULTA;
	}

	/**
	 * @return CTAR_URL - varchar(200)
	 */
	public function getCTAR_URL(){
		return $this->CTAR_URL;
	}

	/**
	 * @return CTAR_DOI - varchar(20)
	 */
	public function getCTAR_DOI(){
		return $this->CTAR_DOI;
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
	public function setCTAR_MES($CTAR_MES){
		$this->CTAR_MES = $CTAR_MES;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setCTAR_NOMBRE_REVISTA($CTAR_NOMBRE_REVISTA){
		$this->CTAR_NOMBRE_REVISTA = $CTAR_NOMBRE_REVISTA;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setCTAR_VOLUMEN($CTAR_VOLUMEN){
		$this->CTAR_VOLUMEN = $CTAR_VOLUMEN;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setCTAR_NUMERO($CTAR_NUMERO){
		$this->CTAR_NUMERO = $CTAR_NUMERO;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setCTAR_CIUDAD($CTAR_CIUDAD){
		$this->CTAR_CIUDAD = $CTAR_CIUDAD;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setCTAR_DIA($CTAR_DIA){
		$this->CTAR_DIA = $CTAR_DIA;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setCTAR_PAGINAS($CTAR_PAGINAS){
		$this->CTAR_PAGINAS = $CTAR_PAGINAS;
	}

	/**
	 * @param Type: char(18)
	 */
	public function setCTAR_EDITORIAL($CTAR_EDITORIAL){
		$this->CTAR_EDITORIAL = $CTAR_EDITORIAL;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setCTAR_TITULO_BREVE($CTAR_TITULO_BREVE){
		$this->CTAR_TITULO_BREVE = $CTAR_TITULO_BREVE;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setCTAR_NUMERO_ESATANDAR($CTAR_NUMERO_ESATANDAR){
		$this->CTAR_NUMERO_ESATANDAR = $CTAR_NUMERO_ESATANDAR;
	}

	/**
	 * @param Type: mediumtext
	 */
	public function setCTAR_COMENTARIO($CTAR_COMENTARIO){
		$this->CTAR_COMENTARIO = $CTAR_COMENTARIO;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setCTAR_SOPORTE($CTAR_SOPORTE){
		$this->CTAR_SOPORTE = $CTAR_SOPORTE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setCTAR_ANIO_CONSULTA($CTAR_ANIO_CONSULTA){
		$this->CTAR_ANIO_CONSULTA = $CTAR_ANIO_CONSULTA;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setCTAR_MES_CONSULTA($CTAR_MES_CONSULTA){
		$this->CTAR_MES_CONSULTA = $CTAR_MES_CONSULTA;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setCTAR_DIA_CONSULTA($CTAR_DIA_CONSULTA){
		$this->CTAR_DIA_CONSULTA = $CTAR_DIA_CONSULTA;
	}

	/**
	 * @param Type: varchar(200)
	 */
	public function setCTAR_URL($CTAR_URL){
		$this->CTAR_URL = $CTAR_URL;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setCTAR_DOI($CTAR_DOI){
		$this->CTAR_DOI = $CTAR_DOI;
	}

    /**
     * Close mysql connection
     */
	public function endcita_tipo_articulo_revista(){
		$this->connection->CloseMysql();
	}

}