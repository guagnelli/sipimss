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

Class tabulador_edu_continua {

	private $TABU_EDU_CONTINUA_CVE; //int(11)
	private $TEC_TIPO_CURSO; //varchar(20)
	private $TEC_PRESENCIAL_RANGO_1; //varchar(20)
	private $TEC_PRECENCIAL_RANGO_2; //varchar(20)
	private $TEC_PRECENCIAL_RANGO_3; //varchar(20)
	private $TEC_MIXTA_RANGO_1; //varchar(20)
	private $TEC_MIXTA_RANGO_2; //varchar(20)
	private $TEC_MIXTA_RANGO_3; //varchar(20)
	private $TEC_LINEA_RANGO_1; //varchar(20)
	private $TEC_LINEA_RANGO_2; //varchar(20)
	private $TEC_LINEA_RANGO_3; //varchar(20)
	private $TEC_PRE_RANGO_1_PUNTOS; //int(11)
	private $TEC_PRE_RANGO_2_PUNTOS; //int(11)
	private $TEC_PRE_RANGO_3_PUNTOS; //int(11)
	private $TEC_MIX_RANGO_1_PUNTOS; //int(11)
	private $TEC_MIX_RANGO_3_PUNTOS; //int(11)
	private $TEC_MIX_RANGO_2_PUNTOS; //int(11)
	private $TEC_LINEA_RANGO_1_PUNTOS; //int(11)
	private $TEC_LINEA_RANGO_2_PUNTOS; //int(11)
	private $TEC_LINEA_RANGO_3_PUNTOS; //int(11)
	private $connection;

	public function tabulador_edu_continua(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_tabulador_edu_continua($TEC_TIPO_CURSO,$TEC_PRESENCIAL_RANGO_1,$TEC_PRECENCIAL_RANGO_2,$TEC_PRECENCIAL_RANGO_3,$TEC_MIXTA_RANGO_1,$TEC_MIXTA_RANGO_2,$TEC_MIXTA_RANGO_3,$TEC_LINEA_RANGO_1,$TEC_LINEA_RANGO_2,$TEC_LINEA_RANGO_3,$TEC_PRE_RANGO_1_PUNTOS,$TEC_PRE_RANGO_2_PUNTOS,$TEC_PRE_RANGO_3_PUNTOS,$TEC_MIX_RANGO_1_PUNTOS,$TEC_MIX_RANGO_3_PUNTOS,$TEC_MIX_RANGO_2_PUNTOS,$TEC_LINEA_RANGO_1_PUNTOS,$TEC_LINEA_RANGO_2_PUNTOS,$TEC_LINEA_RANGO_3_PUNTOS){
		$this->TEC_TIPO_CURSO = $TEC_TIPO_CURSO;
		$this->TEC_PRESENCIAL_RANGO_1 = $TEC_PRESENCIAL_RANGO_1;
		$this->TEC_PRECENCIAL_RANGO_2 = $TEC_PRECENCIAL_RANGO_2;
		$this->TEC_PRECENCIAL_RANGO_3 = $TEC_PRECENCIAL_RANGO_3;
		$this->TEC_MIXTA_RANGO_1 = $TEC_MIXTA_RANGO_1;
		$this->TEC_MIXTA_RANGO_2 = $TEC_MIXTA_RANGO_2;
		$this->TEC_MIXTA_RANGO_3 = $TEC_MIXTA_RANGO_3;
		$this->TEC_LINEA_RANGO_1 = $TEC_LINEA_RANGO_1;
		$this->TEC_LINEA_RANGO_2 = $TEC_LINEA_RANGO_2;
		$this->TEC_LINEA_RANGO_3 = $TEC_LINEA_RANGO_3;
		$this->TEC_PRE_RANGO_1_PUNTOS = $TEC_PRE_RANGO_1_PUNTOS;
		$this->TEC_PRE_RANGO_2_PUNTOS = $TEC_PRE_RANGO_2_PUNTOS;
		$this->TEC_PRE_RANGO_3_PUNTOS = $TEC_PRE_RANGO_3_PUNTOS;
		$this->TEC_MIX_RANGO_1_PUNTOS = $TEC_MIX_RANGO_1_PUNTOS;
		$this->TEC_MIX_RANGO_3_PUNTOS = $TEC_MIX_RANGO_3_PUNTOS;
		$this->TEC_MIX_RANGO_2_PUNTOS = $TEC_MIX_RANGO_2_PUNTOS;
		$this->TEC_LINEA_RANGO_1_PUNTOS = $TEC_LINEA_RANGO_1_PUNTOS;
		$this->TEC_LINEA_RANGO_2_PUNTOS = $TEC_LINEA_RANGO_2_PUNTOS;
		$this->TEC_LINEA_RANGO_3_PUNTOS = $TEC_LINEA_RANGO_3_PUNTOS;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from tabulador_edu_continua where TABU_EDU_CONTINUA_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->TABU_EDU_CONTINUA_CVE = $row["TABU_EDU_CONTINUA_CVE"];
			$this->TEC_TIPO_CURSO = $row["TEC_TIPO_CURSO"];
			$this->TEC_PRESENCIAL_RANGO_1 = $row["TEC_PRESENCIAL_RANGO_1"];
			$this->TEC_PRECENCIAL_RANGO_2 = $row["TEC_PRECENCIAL_RANGO_2"];
			$this->TEC_PRECENCIAL_RANGO_3 = $row["TEC_PRECENCIAL_RANGO_3"];
			$this->TEC_MIXTA_RANGO_1 = $row["TEC_MIXTA_RANGO_1"];
			$this->TEC_MIXTA_RANGO_2 = $row["TEC_MIXTA_RANGO_2"];
			$this->TEC_MIXTA_RANGO_3 = $row["TEC_MIXTA_RANGO_3"];
			$this->TEC_LINEA_RANGO_1 = $row["TEC_LINEA_RANGO_1"];
			$this->TEC_LINEA_RANGO_2 = $row["TEC_LINEA_RANGO_2"];
			$this->TEC_LINEA_RANGO_3 = $row["TEC_LINEA_RANGO_3"];
			$this->TEC_PRE_RANGO_1_PUNTOS = $row["TEC_PRE_RANGO_1_PUNTOS"];
			$this->TEC_PRE_RANGO_2_PUNTOS = $row["TEC_PRE_RANGO_2_PUNTOS"];
			$this->TEC_PRE_RANGO_3_PUNTOS = $row["TEC_PRE_RANGO_3_PUNTOS"];
			$this->TEC_MIX_RANGO_1_PUNTOS = $row["TEC_MIX_RANGO_1_PUNTOS"];
			$this->TEC_MIX_RANGO_3_PUNTOS = $row["TEC_MIX_RANGO_3_PUNTOS"];
			$this->TEC_MIX_RANGO_2_PUNTOS = $row["TEC_MIX_RANGO_2_PUNTOS"];
			$this->TEC_LINEA_RANGO_1_PUNTOS = $row["TEC_LINEA_RANGO_1_PUNTOS"];
			$this->TEC_LINEA_RANGO_2_PUNTOS = $row["TEC_LINEA_RANGO_2_PUNTOS"];
			$this->TEC_LINEA_RANGO_3_PUNTOS = $row["TEC_LINEA_RANGO_3_PUNTOS"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM tabulador_edu_continua WHERE TABU_EDU_CONTINUA_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE tabulador_edu_continua set TEC_TIPO_CURSO = \"$this->TEC_TIPO_CURSO\", TEC_PRESENCIAL_RANGO_1 = \"$this->TEC_PRESENCIAL_RANGO_1\", TEC_PRECENCIAL_RANGO_2 = \"$this->TEC_PRECENCIAL_RANGO_2\", TEC_PRECENCIAL_RANGO_3 = \"$this->TEC_PRECENCIAL_RANGO_3\", TEC_MIXTA_RANGO_1 = \"$this->TEC_MIXTA_RANGO_1\", TEC_MIXTA_RANGO_2 = \"$this->TEC_MIXTA_RANGO_2\", TEC_MIXTA_RANGO_3 = \"$this->TEC_MIXTA_RANGO_3\", TEC_LINEA_RANGO_1 = \"$this->TEC_LINEA_RANGO_1\", TEC_LINEA_RANGO_2 = \"$this->TEC_LINEA_RANGO_2\", TEC_LINEA_RANGO_3 = \"$this->TEC_LINEA_RANGO_3\", TEC_PRE_RANGO_1_PUNTOS = \"$this->TEC_PRE_RANGO_1_PUNTOS\", TEC_PRE_RANGO_2_PUNTOS = \"$this->TEC_PRE_RANGO_2_PUNTOS\", TEC_PRE_RANGO_3_PUNTOS = \"$this->TEC_PRE_RANGO_3_PUNTOS\", TEC_MIX_RANGO_1_PUNTOS = \"$this->TEC_MIX_RANGO_1_PUNTOS\", TEC_MIX_RANGO_3_PUNTOS = \"$this->TEC_MIX_RANGO_3_PUNTOS\", TEC_MIX_RANGO_2_PUNTOS = \"$this->TEC_MIX_RANGO_2_PUNTOS\", TEC_LINEA_RANGO_1_PUNTOS = \"$this->TEC_LINEA_RANGO_1_PUNTOS\", TEC_LINEA_RANGO_2_PUNTOS = \"$this->TEC_LINEA_RANGO_2_PUNTOS\", TEC_LINEA_RANGO_3_PUNTOS = \"$this->TEC_LINEA_RANGO_3_PUNTOS\" where TABU_EDU_CONTINUA_CVE = \"$this->TABU_EDU_CONTINUA_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into tabulador_edu_continua (TEC_TIPO_CURSO, TEC_PRESENCIAL_RANGO_1, TEC_PRECENCIAL_RANGO_2, TEC_PRECENCIAL_RANGO_3, TEC_MIXTA_RANGO_1, TEC_MIXTA_RANGO_2, TEC_MIXTA_RANGO_3, TEC_LINEA_RANGO_1, TEC_LINEA_RANGO_2, TEC_LINEA_RANGO_3, TEC_PRE_RANGO_1_PUNTOS, TEC_PRE_RANGO_2_PUNTOS, TEC_PRE_RANGO_3_PUNTOS, TEC_MIX_RANGO_1_PUNTOS, TEC_MIX_RANGO_3_PUNTOS, TEC_MIX_RANGO_2_PUNTOS, TEC_LINEA_RANGO_1_PUNTOS, TEC_LINEA_RANGO_2_PUNTOS, TEC_LINEA_RANGO_3_PUNTOS) values (\"$this->TEC_TIPO_CURSO\", \"$this->TEC_PRESENCIAL_RANGO_1\", \"$this->TEC_PRECENCIAL_RANGO_2\", \"$this->TEC_PRECENCIAL_RANGO_3\", \"$this->TEC_MIXTA_RANGO_1\", \"$this->TEC_MIXTA_RANGO_2\", \"$this->TEC_MIXTA_RANGO_3\", \"$this->TEC_LINEA_RANGO_1\", \"$this->TEC_LINEA_RANGO_2\", \"$this->TEC_LINEA_RANGO_3\", \"$this->TEC_PRE_RANGO_1_PUNTOS\", \"$this->TEC_PRE_RANGO_2_PUNTOS\", \"$this->TEC_PRE_RANGO_3_PUNTOS\", \"$this->TEC_MIX_RANGO_1_PUNTOS\", \"$this->TEC_MIX_RANGO_3_PUNTOS\", \"$this->TEC_MIX_RANGO_2_PUNTOS\", \"$this->TEC_LINEA_RANGO_1_PUNTOS\", \"$this->TEC_LINEA_RANGO_2_PUNTOS\", \"$this->TEC_LINEA_RANGO_3_PUNTOS\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT TABU_EDU_CONTINUA_CVE from tabulador_edu_continua order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["TABU_EDU_CONTINUA_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return TABU_EDU_CONTINUA_CVE - int(11)
	 */
	public function getTABU_EDU_CONTINUA_CVE(){
		return $this->TABU_EDU_CONTINUA_CVE;
	}

	/**
	 * @return TEC_TIPO_CURSO - varchar(20)
	 */
	public function getTEC_TIPO_CURSO(){
		return $this->TEC_TIPO_CURSO;
	}

	/**
	 * @return TEC_PRESENCIAL_RANGO_1 - varchar(20)
	 */
	public function getTEC_PRESENCIAL_RANGO_1(){
		return $this->TEC_PRESENCIAL_RANGO_1;
	}

	/**
	 * @return TEC_PRECENCIAL_RANGO_2 - varchar(20)
	 */
	public function getTEC_PRECENCIAL_RANGO_2(){
		return $this->TEC_PRECENCIAL_RANGO_2;
	}

	/**
	 * @return TEC_PRECENCIAL_RANGO_3 - varchar(20)
	 */
	public function getTEC_PRECENCIAL_RANGO_3(){
		return $this->TEC_PRECENCIAL_RANGO_3;
	}

	/**
	 * @return TEC_MIXTA_RANGO_1 - varchar(20)
	 */
	public function getTEC_MIXTA_RANGO_1(){
		return $this->TEC_MIXTA_RANGO_1;
	}

	/**
	 * @return TEC_MIXTA_RANGO_2 - varchar(20)
	 */
	public function getTEC_MIXTA_RANGO_2(){
		return $this->TEC_MIXTA_RANGO_2;
	}

	/**
	 * @return TEC_MIXTA_RANGO_3 - varchar(20)
	 */
	public function getTEC_MIXTA_RANGO_3(){
		return $this->TEC_MIXTA_RANGO_3;
	}

	/**
	 * @return TEC_LINEA_RANGO_1 - varchar(20)
	 */
	public function getTEC_LINEA_RANGO_1(){
		return $this->TEC_LINEA_RANGO_1;
	}

	/**
	 * @return TEC_LINEA_RANGO_2 - varchar(20)
	 */
	public function getTEC_LINEA_RANGO_2(){
		return $this->TEC_LINEA_RANGO_2;
	}

	/**
	 * @return TEC_LINEA_RANGO_3 - varchar(20)
	 */
	public function getTEC_LINEA_RANGO_3(){
		return $this->TEC_LINEA_RANGO_3;
	}

	/**
	 * @return TEC_PRE_RANGO_1_PUNTOS - int(11)
	 */
	public function getTEC_PRE_RANGO_1_PUNTOS(){
		return $this->TEC_PRE_RANGO_1_PUNTOS;
	}

	/**
	 * @return TEC_PRE_RANGO_2_PUNTOS - int(11)
	 */
	public function getTEC_PRE_RANGO_2_PUNTOS(){
		return $this->TEC_PRE_RANGO_2_PUNTOS;
	}

	/**
	 * @return TEC_PRE_RANGO_3_PUNTOS - int(11)
	 */
	public function getTEC_PRE_RANGO_3_PUNTOS(){
		return $this->TEC_PRE_RANGO_3_PUNTOS;
	}

	/**
	 * @return TEC_MIX_RANGO_1_PUNTOS - int(11)
	 */
	public function getTEC_MIX_RANGO_1_PUNTOS(){
		return $this->TEC_MIX_RANGO_1_PUNTOS;
	}

	/**
	 * @return TEC_MIX_RANGO_3_PUNTOS - int(11)
	 */
	public function getTEC_MIX_RANGO_3_PUNTOS(){
		return $this->TEC_MIX_RANGO_3_PUNTOS;
	}

	/**
	 * @return TEC_MIX_RANGO_2_PUNTOS - int(11)
	 */
	public function getTEC_MIX_RANGO_2_PUNTOS(){
		return $this->TEC_MIX_RANGO_2_PUNTOS;
	}

	/**
	 * @return TEC_LINEA_RANGO_1_PUNTOS - int(11)
	 */
	public function getTEC_LINEA_RANGO_1_PUNTOS(){
		return $this->TEC_LINEA_RANGO_1_PUNTOS;
	}

	/**
	 * @return TEC_LINEA_RANGO_2_PUNTOS - int(11)
	 */
	public function getTEC_LINEA_RANGO_2_PUNTOS(){
		return $this->TEC_LINEA_RANGO_2_PUNTOS;
	}

	/**
	 * @return TEC_LINEA_RANGO_3_PUNTOS - int(11)
	 */
	public function getTEC_LINEA_RANGO_3_PUNTOS(){
		return $this->TEC_LINEA_RANGO_3_PUNTOS;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTABU_EDU_CONTINUA_CVE($TABU_EDU_CONTINUA_CVE){
		$this->TABU_EDU_CONTINUA_CVE = $TABU_EDU_CONTINUA_CVE;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setTEC_TIPO_CURSO($TEC_TIPO_CURSO){
		$this->TEC_TIPO_CURSO = $TEC_TIPO_CURSO;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setTEC_PRESENCIAL_RANGO_1($TEC_PRESENCIAL_RANGO_1){
		$this->TEC_PRESENCIAL_RANGO_1 = $TEC_PRESENCIAL_RANGO_1;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setTEC_PRECENCIAL_RANGO_2($TEC_PRECENCIAL_RANGO_2){
		$this->TEC_PRECENCIAL_RANGO_2 = $TEC_PRECENCIAL_RANGO_2;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setTEC_PRECENCIAL_RANGO_3($TEC_PRECENCIAL_RANGO_3){
		$this->TEC_PRECENCIAL_RANGO_3 = $TEC_PRECENCIAL_RANGO_3;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setTEC_MIXTA_RANGO_1($TEC_MIXTA_RANGO_1){
		$this->TEC_MIXTA_RANGO_1 = $TEC_MIXTA_RANGO_1;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setTEC_MIXTA_RANGO_2($TEC_MIXTA_RANGO_2){
		$this->TEC_MIXTA_RANGO_2 = $TEC_MIXTA_RANGO_2;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setTEC_MIXTA_RANGO_3($TEC_MIXTA_RANGO_3){
		$this->TEC_MIXTA_RANGO_3 = $TEC_MIXTA_RANGO_3;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setTEC_LINEA_RANGO_1($TEC_LINEA_RANGO_1){
		$this->TEC_LINEA_RANGO_1 = $TEC_LINEA_RANGO_1;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setTEC_LINEA_RANGO_2($TEC_LINEA_RANGO_2){
		$this->TEC_LINEA_RANGO_2 = $TEC_LINEA_RANGO_2;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setTEC_LINEA_RANGO_3($TEC_LINEA_RANGO_3){
		$this->TEC_LINEA_RANGO_3 = $TEC_LINEA_RANGO_3;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTEC_PRE_RANGO_1_PUNTOS($TEC_PRE_RANGO_1_PUNTOS){
		$this->TEC_PRE_RANGO_1_PUNTOS = $TEC_PRE_RANGO_1_PUNTOS;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTEC_PRE_RANGO_2_PUNTOS($TEC_PRE_RANGO_2_PUNTOS){
		$this->TEC_PRE_RANGO_2_PUNTOS = $TEC_PRE_RANGO_2_PUNTOS;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTEC_PRE_RANGO_3_PUNTOS($TEC_PRE_RANGO_3_PUNTOS){
		$this->TEC_PRE_RANGO_3_PUNTOS = $TEC_PRE_RANGO_3_PUNTOS;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTEC_MIX_RANGO_1_PUNTOS($TEC_MIX_RANGO_1_PUNTOS){
		$this->TEC_MIX_RANGO_1_PUNTOS = $TEC_MIX_RANGO_1_PUNTOS;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTEC_MIX_RANGO_3_PUNTOS($TEC_MIX_RANGO_3_PUNTOS){
		$this->TEC_MIX_RANGO_3_PUNTOS = $TEC_MIX_RANGO_3_PUNTOS;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTEC_MIX_RANGO_2_PUNTOS($TEC_MIX_RANGO_2_PUNTOS){
		$this->TEC_MIX_RANGO_2_PUNTOS = $TEC_MIX_RANGO_2_PUNTOS;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTEC_LINEA_RANGO_1_PUNTOS($TEC_LINEA_RANGO_1_PUNTOS){
		$this->TEC_LINEA_RANGO_1_PUNTOS = $TEC_LINEA_RANGO_1_PUNTOS;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTEC_LINEA_RANGO_2_PUNTOS($TEC_LINEA_RANGO_2_PUNTOS){
		$this->TEC_LINEA_RANGO_2_PUNTOS = $TEC_LINEA_RANGO_2_PUNTOS;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTEC_LINEA_RANGO_3_PUNTOS($TEC_LINEA_RANGO_3_PUNTOS){
		$this->TEC_LINEA_RANGO_3_PUNTOS = $TEC_LINEA_RANGO_3_PUNTOS;
	}

    /**
     * Close mysql connection
     */
	public function endtabulador_edu_continua(){
		$this->connection->CloseMysql();
	}

}