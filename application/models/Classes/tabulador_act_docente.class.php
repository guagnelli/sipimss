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

Class tabulador_act_docente {

	private $TABU_ACT_DOCENTE_CVE; //int(11)
	private $TAD_TIPO_CURSO; //varchar(20)
	private $TAD_PRESENCIAL_RANGO_1; //varchar(20)
	private $TAD_PRECENCIAL_RANGO_2; //varchar(20)
	private $TAD_PRECENCIAL_RANGO_3; //varchar(20)
	private $TAD_MIXTA_RANGO_1; //varchar(20)
	private $TAD_MIXTA_RANGO_2; //varchar(20)
	private $TAD_MIXTA_RANGO_3; //varchar(20)
	private $TAD_LINEA_RANGO_1; //varchar(20)
	private $TAD_LINEA_RANGO_2; //varchar(20)
	private $TAD_LINEA_RANGO_3; //varchar(20)
	private $TAD_PRE_RANGO_1_PUNTOS; //int(11)
	private $TAD_PRE_RANGO_2_PUNTOS; //int(11)
	private $TAD_PRE_RANGO_3_PUNTOS; //int(11)
	private $TAD_MIX_RANGO_1_PUNTOS; //int(11)
	private $TAD_MIX_RANGO_3_PUNTOS; //int(11)
	private $TAD_MIX_RANGO_2_PUNTOS; //int(11)
	private $TAD_LINEA_RANGO_1_PUNTOS; //int(11)
	private $TAD_LINEA_RANGO_2_PUNTOS; //int(11)
	private $TAD_LINEA_RANGO_3_PUNTOS; //int(11)
	private $connection;

	public function tabulador_act_docente(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_tabulador_act_docente($TAD_TIPO_CURSO,$TAD_PRESENCIAL_RANGO_1,$TAD_PRECENCIAL_RANGO_2,$TAD_PRECENCIAL_RANGO_3,$TAD_MIXTA_RANGO_1,$TAD_MIXTA_RANGO_2,$TAD_MIXTA_RANGO_3,$TAD_LINEA_RANGO_1,$TAD_LINEA_RANGO_2,$TAD_LINEA_RANGO_3,$TAD_PRE_RANGO_1_PUNTOS,$TAD_PRE_RANGO_2_PUNTOS,$TAD_PRE_RANGO_3_PUNTOS,$TAD_MIX_RANGO_1_PUNTOS,$TAD_MIX_RANGO_3_PUNTOS,$TAD_MIX_RANGO_2_PUNTOS,$TAD_LINEA_RANGO_1_PUNTOS,$TAD_LINEA_RANGO_2_PUNTOS,$TAD_LINEA_RANGO_3_PUNTOS){
		$this->TAD_TIPO_CURSO = $TAD_TIPO_CURSO;
		$this->TAD_PRESENCIAL_RANGO_1 = $TAD_PRESENCIAL_RANGO_1;
		$this->TAD_PRECENCIAL_RANGO_2 = $TAD_PRECENCIAL_RANGO_2;
		$this->TAD_PRECENCIAL_RANGO_3 = $TAD_PRECENCIAL_RANGO_3;
		$this->TAD_MIXTA_RANGO_1 = $TAD_MIXTA_RANGO_1;
		$this->TAD_MIXTA_RANGO_2 = $TAD_MIXTA_RANGO_2;
		$this->TAD_MIXTA_RANGO_3 = $TAD_MIXTA_RANGO_3;
		$this->TAD_LINEA_RANGO_1 = $TAD_LINEA_RANGO_1;
		$this->TAD_LINEA_RANGO_2 = $TAD_LINEA_RANGO_2;
		$this->TAD_LINEA_RANGO_3 = $TAD_LINEA_RANGO_3;
		$this->TAD_PRE_RANGO_1_PUNTOS = $TAD_PRE_RANGO_1_PUNTOS;
		$this->TAD_PRE_RANGO_2_PUNTOS = $TAD_PRE_RANGO_2_PUNTOS;
		$this->TAD_PRE_RANGO_3_PUNTOS = $TAD_PRE_RANGO_3_PUNTOS;
		$this->TAD_MIX_RANGO_1_PUNTOS = $TAD_MIX_RANGO_1_PUNTOS;
		$this->TAD_MIX_RANGO_3_PUNTOS = $TAD_MIX_RANGO_3_PUNTOS;
		$this->TAD_MIX_RANGO_2_PUNTOS = $TAD_MIX_RANGO_2_PUNTOS;
		$this->TAD_LINEA_RANGO_1_PUNTOS = $TAD_LINEA_RANGO_1_PUNTOS;
		$this->TAD_LINEA_RANGO_2_PUNTOS = $TAD_LINEA_RANGO_2_PUNTOS;
		$this->TAD_LINEA_RANGO_3_PUNTOS = $TAD_LINEA_RANGO_3_PUNTOS;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from tabulador_act_docente where TABU_ACT_DOCENTE_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->TABU_ACT_DOCENTE_CVE = $row["TABU_ACT_DOCENTE_CVE"];
			$this->TAD_TIPO_CURSO = $row["TAD_TIPO_CURSO"];
			$this->TAD_PRESENCIAL_RANGO_1 = $row["TAD_PRESENCIAL_RANGO_1"];
			$this->TAD_PRECENCIAL_RANGO_2 = $row["TAD_PRECENCIAL_RANGO_2"];
			$this->TAD_PRECENCIAL_RANGO_3 = $row["TAD_PRECENCIAL_RANGO_3"];
			$this->TAD_MIXTA_RANGO_1 = $row["TAD_MIXTA_RANGO_1"];
			$this->TAD_MIXTA_RANGO_2 = $row["TAD_MIXTA_RANGO_2"];
			$this->TAD_MIXTA_RANGO_3 = $row["TAD_MIXTA_RANGO_3"];
			$this->TAD_LINEA_RANGO_1 = $row["TAD_LINEA_RANGO_1"];
			$this->TAD_LINEA_RANGO_2 = $row["TAD_LINEA_RANGO_2"];
			$this->TAD_LINEA_RANGO_3 = $row["TAD_LINEA_RANGO_3"];
			$this->TAD_PRE_RANGO_1_PUNTOS = $row["TAD_PRE_RANGO_1_PUNTOS"];
			$this->TAD_PRE_RANGO_2_PUNTOS = $row["TAD_PRE_RANGO_2_PUNTOS"];
			$this->TAD_PRE_RANGO_3_PUNTOS = $row["TAD_PRE_RANGO_3_PUNTOS"];
			$this->TAD_MIX_RANGO_1_PUNTOS = $row["TAD_MIX_RANGO_1_PUNTOS"];
			$this->TAD_MIX_RANGO_3_PUNTOS = $row["TAD_MIX_RANGO_3_PUNTOS"];
			$this->TAD_MIX_RANGO_2_PUNTOS = $row["TAD_MIX_RANGO_2_PUNTOS"];
			$this->TAD_LINEA_RANGO_1_PUNTOS = $row["TAD_LINEA_RANGO_1_PUNTOS"];
			$this->TAD_LINEA_RANGO_2_PUNTOS = $row["TAD_LINEA_RANGO_2_PUNTOS"];
			$this->TAD_LINEA_RANGO_3_PUNTOS = $row["TAD_LINEA_RANGO_3_PUNTOS"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM tabulador_act_docente WHERE TABU_ACT_DOCENTE_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE tabulador_act_docente set TAD_TIPO_CURSO = \"$this->TAD_TIPO_CURSO\", TAD_PRESENCIAL_RANGO_1 = \"$this->TAD_PRESENCIAL_RANGO_1\", TAD_PRECENCIAL_RANGO_2 = \"$this->TAD_PRECENCIAL_RANGO_2\", TAD_PRECENCIAL_RANGO_3 = \"$this->TAD_PRECENCIAL_RANGO_3\", TAD_MIXTA_RANGO_1 = \"$this->TAD_MIXTA_RANGO_1\", TAD_MIXTA_RANGO_2 = \"$this->TAD_MIXTA_RANGO_2\", TAD_MIXTA_RANGO_3 = \"$this->TAD_MIXTA_RANGO_3\", TAD_LINEA_RANGO_1 = \"$this->TAD_LINEA_RANGO_1\", TAD_LINEA_RANGO_2 = \"$this->TAD_LINEA_RANGO_2\", TAD_LINEA_RANGO_3 = \"$this->TAD_LINEA_RANGO_3\", TAD_PRE_RANGO_1_PUNTOS = \"$this->TAD_PRE_RANGO_1_PUNTOS\", TAD_PRE_RANGO_2_PUNTOS = \"$this->TAD_PRE_RANGO_2_PUNTOS\", TAD_PRE_RANGO_3_PUNTOS = \"$this->TAD_PRE_RANGO_3_PUNTOS\", TAD_MIX_RANGO_1_PUNTOS = \"$this->TAD_MIX_RANGO_1_PUNTOS\", TAD_MIX_RANGO_3_PUNTOS = \"$this->TAD_MIX_RANGO_3_PUNTOS\", TAD_MIX_RANGO_2_PUNTOS = \"$this->TAD_MIX_RANGO_2_PUNTOS\", TAD_LINEA_RANGO_1_PUNTOS = \"$this->TAD_LINEA_RANGO_1_PUNTOS\", TAD_LINEA_RANGO_2_PUNTOS = \"$this->TAD_LINEA_RANGO_2_PUNTOS\", TAD_LINEA_RANGO_3_PUNTOS = \"$this->TAD_LINEA_RANGO_3_PUNTOS\" where TABU_ACT_DOCENTE_CVE = \"$this->TABU_ACT_DOCENTE_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into tabulador_act_docente (TAD_TIPO_CURSO, TAD_PRESENCIAL_RANGO_1, TAD_PRECENCIAL_RANGO_2, TAD_PRECENCIAL_RANGO_3, TAD_MIXTA_RANGO_1, TAD_MIXTA_RANGO_2, TAD_MIXTA_RANGO_3, TAD_LINEA_RANGO_1, TAD_LINEA_RANGO_2, TAD_LINEA_RANGO_3, TAD_PRE_RANGO_1_PUNTOS, TAD_PRE_RANGO_2_PUNTOS, TAD_PRE_RANGO_3_PUNTOS, TAD_MIX_RANGO_1_PUNTOS, TAD_MIX_RANGO_3_PUNTOS, TAD_MIX_RANGO_2_PUNTOS, TAD_LINEA_RANGO_1_PUNTOS, TAD_LINEA_RANGO_2_PUNTOS, TAD_LINEA_RANGO_3_PUNTOS) values (\"$this->TAD_TIPO_CURSO\", \"$this->TAD_PRESENCIAL_RANGO_1\", \"$this->TAD_PRECENCIAL_RANGO_2\", \"$this->TAD_PRECENCIAL_RANGO_3\", \"$this->TAD_MIXTA_RANGO_1\", \"$this->TAD_MIXTA_RANGO_2\", \"$this->TAD_MIXTA_RANGO_3\", \"$this->TAD_LINEA_RANGO_1\", \"$this->TAD_LINEA_RANGO_2\", \"$this->TAD_LINEA_RANGO_3\", \"$this->TAD_PRE_RANGO_1_PUNTOS\", \"$this->TAD_PRE_RANGO_2_PUNTOS\", \"$this->TAD_PRE_RANGO_3_PUNTOS\", \"$this->TAD_MIX_RANGO_1_PUNTOS\", \"$this->TAD_MIX_RANGO_3_PUNTOS\", \"$this->TAD_MIX_RANGO_2_PUNTOS\", \"$this->TAD_LINEA_RANGO_1_PUNTOS\", \"$this->TAD_LINEA_RANGO_2_PUNTOS\", \"$this->TAD_LINEA_RANGO_3_PUNTOS\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT TABU_ACT_DOCENTE_CVE from tabulador_act_docente order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["TABU_ACT_DOCENTE_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return TABU_ACT_DOCENTE_CVE - int(11)
	 */
	public function getTABU_ACT_DOCENTE_CVE(){
		return $this->TABU_ACT_DOCENTE_CVE;
	}

	/**
	 * @return TAD_TIPO_CURSO - varchar(20)
	 */
	public function getTAD_TIPO_CURSO(){
		return $this->TAD_TIPO_CURSO;
	}

	/**
	 * @return TAD_PRESENCIAL_RANGO_1 - varchar(20)
	 */
	public function getTAD_PRESENCIAL_RANGO_1(){
		return $this->TAD_PRESENCIAL_RANGO_1;
	}

	/**
	 * @return TAD_PRECENCIAL_RANGO_2 - varchar(20)
	 */
	public function getTAD_PRECENCIAL_RANGO_2(){
		return $this->TAD_PRECENCIAL_RANGO_2;
	}

	/**
	 * @return TAD_PRECENCIAL_RANGO_3 - varchar(20)
	 */
	public function getTAD_PRECENCIAL_RANGO_3(){
		return $this->TAD_PRECENCIAL_RANGO_3;
	}

	/**
	 * @return TAD_MIXTA_RANGO_1 - varchar(20)
	 */
	public function getTAD_MIXTA_RANGO_1(){
		return $this->TAD_MIXTA_RANGO_1;
	}

	/**
	 * @return TAD_MIXTA_RANGO_2 - varchar(20)
	 */
	public function getTAD_MIXTA_RANGO_2(){
		return $this->TAD_MIXTA_RANGO_2;
	}

	/**
	 * @return TAD_MIXTA_RANGO_3 - varchar(20)
	 */
	public function getTAD_MIXTA_RANGO_3(){
		return $this->TAD_MIXTA_RANGO_3;
	}

	/**
	 * @return TAD_LINEA_RANGO_1 - varchar(20)
	 */
	public function getTAD_LINEA_RANGO_1(){
		return $this->TAD_LINEA_RANGO_1;
	}

	/**
	 * @return TAD_LINEA_RANGO_2 - varchar(20)
	 */
	public function getTAD_LINEA_RANGO_2(){
		return $this->TAD_LINEA_RANGO_2;
	}

	/**
	 * @return TAD_LINEA_RANGO_3 - varchar(20)
	 */
	public function getTAD_LINEA_RANGO_3(){
		return $this->TAD_LINEA_RANGO_3;
	}

	/**
	 * @return TAD_PRE_RANGO_1_PUNTOS - int(11)
	 */
	public function getTAD_PRE_RANGO_1_PUNTOS(){
		return $this->TAD_PRE_RANGO_1_PUNTOS;
	}

	/**
	 * @return TAD_PRE_RANGO_2_PUNTOS - int(11)
	 */
	public function getTAD_PRE_RANGO_2_PUNTOS(){
		return $this->TAD_PRE_RANGO_2_PUNTOS;
	}

	/**
	 * @return TAD_PRE_RANGO_3_PUNTOS - int(11)
	 */
	public function getTAD_PRE_RANGO_3_PUNTOS(){
		return $this->TAD_PRE_RANGO_3_PUNTOS;
	}

	/**
	 * @return TAD_MIX_RANGO_1_PUNTOS - int(11)
	 */
	public function getTAD_MIX_RANGO_1_PUNTOS(){
		return $this->TAD_MIX_RANGO_1_PUNTOS;
	}

	/**
	 * @return TAD_MIX_RANGO_3_PUNTOS - int(11)
	 */
	public function getTAD_MIX_RANGO_3_PUNTOS(){
		return $this->TAD_MIX_RANGO_3_PUNTOS;
	}

	/**
	 * @return TAD_MIX_RANGO_2_PUNTOS - int(11)
	 */
	public function getTAD_MIX_RANGO_2_PUNTOS(){
		return $this->TAD_MIX_RANGO_2_PUNTOS;
	}

	/**
	 * @return TAD_LINEA_RANGO_1_PUNTOS - int(11)
	 */
	public function getTAD_LINEA_RANGO_1_PUNTOS(){
		return $this->TAD_LINEA_RANGO_1_PUNTOS;
	}

	/**
	 * @return TAD_LINEA_RANGO_2_PUNTOS - int(11)
	 */
	public function getTAD_LINEA_RANGO_2_PUNTOS(){
		return $this->TAD_LINEA_RANGO_2_PUNTOS;
	}

	/**
	 * @return TAD_LINEA_RANGO_3_PUNTOS - int(11)
	 */
	public function getTAD_LINEA_RANGO_3_PUNTOS(){
		return $this->TAD_LINEA_RANGO_3_PUNTOS;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTABU_ACT_DOCENTE_CVE($TABU_ACT_DOCENTE_CVE){
		$this->TABU_ACT_DOCENTE_CVE = $TABU_ACT_DOCENTE_CVE;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setTAD_TIPO_CURSO($TAD_TIPO_CURSO){
		$this->TAD_TIPO_CURSO = $TAD_TIPO_CURSO;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setTAD_PRESENCIAL_RANGO_1($TAD_PRESENCIAL_RANGO_1){
		$this->TAD_PRESENCIAL_RANGO_1 = $TAD_PRESENCIAL_RANGO_1;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setTAD_PRECENCIAL_RANGO_2($TAD_PRECENCIAL_RANGO_2){
		$this->TAD_PRECENCIAL_RANGO_2 = $TAD_PRECENCIAL_RANGO_2;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setTAD_PRECENCIAL_RANGO_3($TAD_PRECENCIAL_RANGO_3){
		$this->TAD_PRECENCIAL_RANGO_3 = $TAD_PRECENCIAL_RANGO_3;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setTAD_MIXTA_RANGO_1($TAD_MIXTA_RANGO_1){
		$this->TAD_MIXTA_RANGO_1 = $TAD_MIXTA_RANGO_1;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setTAD_MIXTA_RANGO_2($TAD_MIXTA_RANGO_2){
		$this->TAD_MIXTA_RANGO_2 = $TAD_MIXTA_RANGO_2;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setTAD_MIXTA_RANGO_3($TAD_MIXTA_RANGO_3){
		$this->TAD_MIXTA_RANGO_3 = $TAD_MIXTA_RANGO_3;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setTAD_LINEA_RANGO_1($TAD_LINEA_RANGO_1){
		$this->TAD_LINEA_RANGO_1 = $TAD_LINEA_RANGO_1;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setTAD_LINEA_RANGO_2($TAD_LINEA_RANGO_2){
		$this->TAD_LINEA_RANGO_2 = $TAD_LINEA_RANGO_2;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setTAD_LINEA_RANGO_3($TAD_LINEA_RANGO_3){
		$this->TAD_LINEA_RANGO_3 = $TAD_LINEA_RANGO_3;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTAD_PRE_RANGO_1_PUNTOS($TAD_PRE_RANGO_1_PUNTOS){
		$this->TAD_PRE_RANGO_1_PUNTOS = $TAD_PRE_RANGO_1_PUNTOS;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTAD_PRE_RANGO_2_PUNTOS($TAD_PRE_RANGO_2_PUNTOS){
		$this->TAD_PRE_RANGO_2_PUNTOS = $TAD_PRE_RANGO_2_PUNTOS;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTAD_PRE_RANGO_3_PUNTOS($TAD_PRE_RANGO_3_PUNTOS){
		$this->TAD_PRE_RANGO_3_PUNTOS = $TAD_PRE_RANGO_3_PUNTOS;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTAD_MIX_RANGO_1_PUNTOS($TAD_MIX_RANGO_1_PUNTOS){
		$this->TAD_MIX_RANGO_1_PUNTOS = $TAD_MIX_RANGO_1_PUNTOS;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTAD_MIX_RANGO_3_PUNTOS($TAD_MIX_RANGO_3_PUNTOS){
		$this->TAD_MIX_RANGO_3_PUNTOS = $TAD_MIX_RANGO_3_PUNTOS;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTAD_MIX_RANGO_2_PUNTOS($TAD_MIX_RANGO_2_PUNTOS){
		$this->TAD_MIX_RANGO_2_PUNTOS = $TAD_MIX_RANGO_2_PUNTOS;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTAD_LINEA_RANGO_1_PUNTOS($TAD_LINEA_RANGO_1_PUNTOS){
		$this->TAD_LINEA_RANGO_1_PUNTOS = $TAD_LINEA_RANGO_1_PUNTOS;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTAD_LINEA_RANGO_2_PUNTOS($TAD_LINEA_RANGO_2_PUNTOS){
		$this->TAD_LINEA_RANGO_2_PUNTOS = $TAD_LINEA_RANGO_2_PUNTOS;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTAD_LINEA_RANGO_3_PUNTOS($TAD_LINEA_RANGO_3_PUNTOS){
		$this->TAD_LINEA_RANGO_3_PUNTOS = $TAD_LINEA_RANGO_3_PUNTOS;
	}

    /**
     * Close mysql connection
     */
	public function endtabulador_act_docente(){
		$this->connection->CloseMysql();
	}

}