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

Class tabulador_edu_distancia {

	private $TUTOR_DIPLO_RANGO_1; //varchar(20)
	private $TUTOR_DIPLO_RANGO_2; //varchar(20)
	private $TUTOR_DIPLO_RANGO_3; //varchar(20)
	private $TUTOR_PROF_TEC_RANGO_1; //varchar(20)
	private $TUTOR_PROF_TEC_RANGO_2; //varchar(20)
	private $TUTOR_PROF_TEC_RANGO_3; //varchar(20)
	private $TUTOR_POSTEC_RANGO_1; //varchar(20)
	private $TUTOR_POSTEC_RANGO_2; //varchar(20)
	private $TUTOR_POSTEC_RANGO_3; //varchar(20)
	private $COOR_TUTO_FOR_RANGO_1; //varchar(20)
	private $COOR_TUTO_FOR_RANGO_2; //varchar(20)
	private $COOR_TUTO_FOR_RANGO_3; //varchar(20)
	private $COOR_CUR_FOR_RANGO_1; //varchar(20)
	private $COOR_CUR_FOR_RANGO_2; //varchar(20)
	private $COOR_CUR_FOR_RANGO_3; //varchar(20)
	private $COOR_TUTO_CUR_INT_RANGO_1; //char(18)
	private $COOR_TUTO_CUR_INT_RANGO_2; //varchar(20)
	private $COOR_TUTO_CUR_INT_RANGO_3; //char(18)
	private $COOR_CUR_CUR_INT_RANGO_1; //varchar(20)
	private $COOR_CUR_CUR_INT_RANGO_2; //varchar(20)
	private $COOR_CUR_CUR_INT_RANGO_3; //varchar(20)
	private $TUTOR_DIPLO_RANGO_1_PUNTOS; //int(11)
	private $TUTOR_DIPLO_RANGO_2_PUNTOS; //int(11)
	private $TUTOR_DIPLO_RANGO_3_PUNTOS; //varchar(20)
	private $TUTOR_PROF_TEC_RANGO_1_PUNTOS; //int(11)
	private $TUTOR_PROF_TEC_RANGO_2_PUNTOS; //int(11)
	private $TUTOR_PROF_TEC_RANGO_3_PUNTOS; //int(11)
	private $TUTOR_POSTEC_RANGO_1_PUNTOS; //int(11)
	private $TUTOR_POSTEC_RANGO_2_PUNTOS; //int(11)
	private $TUTOR_POSTEC_RANGO_3_PUNTOS; //int(11)
	private $COOR_TUTO_FOR_RANGO_1_PUNTOS; //int(11)
	private $COOR_TUTO_FOR_RANGO_2_PUNTOS; //int(11)
	private $COOR_TUTO_FOR_RANGO_3_PUNTOS; //int(11)
	private $COOR_CUR_FOR_RANGO_1_PUNTOS; //int(11)
	private $COOR_CUR_FOR_RANGO_2_PUNTOS; //int(11)
	private $COOR_CUR_FOR_RANGO_3_PUNTOS; //int(11)
	private $COOR_TUTO_CUR_RANGO_1_PUNTOS; //int(11)
	private $COOR_TUTO_CUR_RANGO_2_PUNTOS; //int(11)
	private $COOR_TUTO_CUR_RANGO_3_PUNTOS; //int(11)
	private $COOR_CUR_CUR_INT_RANGO_1_PUNTOS; //int(11)
	private $COOR_CUR_CUR_INT_RANGO_2_PUNTOS; //int(11)
	private $COOR_CUR_CUR_INT_RANGO_3_PUNTOS; //int(11)
	private $connection;

	public function tabulador_edu_distancia(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_tabulador_edu_distancia($TUTOR_DIPLO_RANGO_1,$TUTOR_DIPLO_RANGO_2,$TUTOR_DIPLO_RANGO_3,$TUTOR_PROF_TEC_RANGO_1,$TUTOR_PROF_TEC_RANGO_2,$TUTOR_PROF_TEC_RANGO_3,$TUTOR_POSTEC_RANGO_1,$TUTOR_POSTEC_RANGO_2,$TUTOR_POSTEC_RANGO_3,$COOR_TUTO_FOR_RANGO_1,$COOR_TUTO_FOR_RANGO_2,$COOR_TUTO_FOR_RANGO_3,$COOR_CUR_FOR_RANGO_1,$COOR_CUR_FOR_RANGO_2,$COOR_CUR_FOR_RANGO_3,$COOR_TUTO_CUR_INT_RANGO_1,$COOR_TUTO_CUR_INT_RANGO_2,$COOR_TUTO_CUR_INT_RANGO_3,$COOR_CUR_CUR_INT_RANGO_1,$COOR_CUR_CUR_INT_RANGO_2,$COOR_CUR_CUR_INT_RANGO_3,$TUTOR_DIPLO_RANGO_1_PUNTOS,$TUTOR_DIPLO_RANGO_2_PUNTOS,$TUTOR_DIPLO_RANGO_3_PUNTOS,$TUTOR_PROF_TEC_RANGO_1_PUNTOS,$TUTOR_PROF_TEC_RANGO_2_PUNTOS,$TUTOR_PROF_TEC_RANGO_3_PUNTOS,$TUTOR_POSTEC_RANGO_1_PUNTOS,$TUTOR_POSTEC_RANGO_2_PUNTOS,$TUTOR_POSTEC_RANGO_3_PUNTOS,$COOR_TUTO_FOR_RANGO_1_PUNTOS,$COOR_TUTO_FOR_RANGO_2_PUNTOS,$COOR_TUTO_FOR_RANGO_3_PUNTOS,$COOR_CUR_FOR_RANGO_1_PUNTOS,$COOR_CUR_FOR_RANGO_2_PUNTOS,$COOR_CUR_FOR_RANGO_3_PUNTOS,$COOR_TUTO_CUR_RANGO_1_PUNTOS,$COOR_TUTO_CUR_RANGO_2_PUNTOS,$COOR_TUTO_CUR_RANGO_3_PUNTOS,$COOR_CUR_CUR_INT_RANGO_1_PUNTOS,$COOR_CUR_CUR_INT_RANGO_2_PUNTOS,$COOR_CUR_CUR_INT_RANGO_3_PUNTOS){
		$this->TUTOR_DIPLO_RANGO_1 = $TUTOR_DIPLO_RANGO_1;
		$this->TUTOR_DIPLO_RANGO_2 = $TUTOR_DIPLO_RANGO_2;
		$this->TUTOR_DIPLO_RANGO_3 = $TUTOR_DIPLO_RANGO_3;
		$this->TUTOR_PROF_TEC_RANGO_1 = $TUTOR_PROF_TEC_RANGO_1;
		$this->TUTOR_PROF_TEC_RANGO_2 = $TUTOR_PROF_TEC_RANGO_2;
		$this->TUTOR_PROF_TEC_RANGO_3 = $TUTOR_PROF_TEC_RANGO_3;
		$this->TUTOR_POSTEC_RANGO_1 = $TUTOR_POSTEC_RANGO_1;
		$this->TUTOR_POSTEC_RANGO_2 = $TUTOR_POSTEC_RANGO_2;
		$this->TUTOR_POSTEC_RANGO_3 = $TUTOR_POSTEC_RANGO_3;
		$this->COOR_TUTO_FOR_RANGO_1 = $COOR_TUTO_FOR_RANGO_1;
		$this->COOR_TUTO_FOR_RANGO_2 = $COOR_TUTO_FOR_RANGO_2;
		$this->COOR_TUTO_FOR_RANGO_3 = $COOR_TUTO_FOR_RANGO_3;
		$this->COOR_CUR_FOR_RANGO_1 = $COOR_CUR_FOR_RANGO_1;
		$this->COOR_CUR_FOR_RANGO_2 = $COOR_CUR_FOR_RANGO_2;
		$this->COOR_CUR_FOR_RANGO_3 = $COOR_CUR_FOR_RANGO_3;
		$this->COOR_TUTO_CUR_INT_RANGO_1 = $COOR_TUTO_CUR_INT_RANGO_1;
		$this->COOR_TUTO_CUR_INT_RANGO_2 = $COOR_TUTO_CUR_INT_RANGO_2;
		$this->COOR_TUTO_CUR_INT_RANGO_3 = $COOR_TUTO_CUR_INT_RANGO_3;
		$this->COOR_CUR_CUR_INT_RANGO_1 = $COOR_CUR_CUR_INT_RANGO_1;
		$this->COOR_CUR_CUR_INT_RANGO_2 = $COOR_CUR_CUR_INT_RANGO_2;
		$this->COOR_CUR_CUR_INT_RANGO_3 = $COOR_CUR_CUR_INT_RANGO_3;
		$this->TUTOR_DIPLO_RANGO_1_PUNTOS = $TUTOR_DIPLO_RANGO_1_PUNTOS;
		$this->TUTOR_DIPLO_RANGO_2_PUNTOS = $TUTOR_DIPLO_RANGO_2_PUNTOS;
		$this->TUTOR_DIPLO_RANGO_3_PUNTOS = $TUTOR_DIPLO_RANGO_3_PUNTOS;
		$this->TUTOR_PROF_TEC_RANGO_1_PUNTOS = $TUTOR_PROF_TEC_RANGO_1_PUNTOS;
		$this->TUTOR_PROF_TEC_RANGO_2_PUNTOS = $TUTOR_PROF_TEC_RANGO_2_PUNTOS;
		$this->TUTOR_PROF_TEC_RANGO_3_PUNTOS = $TUTOR_PROF_TEC_RANGO_3_PUNTOS;
		$this->TUTOR_POSTEC_RANGO_1_PUNTOS = $TUTOR_POSTEC_RANGO_1_PUNTOS;
		$this->TUTOR_POSTEC_RANGO_2_PUNTOS = $TUTOR_POSTEC_RANGO_2_PUNTOS;
		$this->TUTOR_POSTEC_RANGO_3_PUNTOS = $TUTOR_POSTEC_RANGO_3_PUNTOS;
		$this->COOR_TUTO_FOR_RANGO_1_PUNTOS = $COOR_TUTO_FOR_RANGO_1_PUNTOS;
		$this->COOR_TUTO_FOR_RANGO_2_PUNTOS = $COOR_TUTO_FOR_RANGO_2_PUNTOS;
		$this->COOR_TUTO_FOR_RANGO_3_PUNTOS = $COOR_TUTO_FOR_RANGO_3_PUNTOS;
		$this->COOR_CUR_FOR_RANGO_1_PUNTOS = $COOR_CUR_FOR_RANGO_1_PUNTOS;
		$this->COOR_CUR_FOR_RANGO_2_PUNTOS = $COOR_CUR_FOR_RANGO_2_PUNTOS;
		$this->COOR_CUR_FOR_RANGO_3_PUNTOS = $COOR_CUR_FOR_RANGO_3_PUNTOS;
		$this->COOR_TUTO_CUR_RANGO_1_PUNTOS = $COOR_TUTO_CUR_RANGO_1_PUNTOS;
		$this->COOR_TUTO_CUR_RANGO_2_PUNTOS = $COOR_TUTO_CUR_RANGO_2_PUNTOS;
		$this->COOR_TUTO_CUR_RANGO_3_PUNTOS = $COOR_TUTO_CUR_RANGO_3_PUNTOS;
		$this->COOR_CUR_CUR_INT_RANGO_1_PUNTOS = $COOR_CUR_CUR_INT_RANGO_1_PUNTOS;
		$this->COOR_CUR_CUR_INT_RANGO_2_PUNTOS = $COOR_CUR_CUR_INT_RANGO_2_PUNTOS;
		$this->COOR_CUR_CUR_INT_RANGO_3_PUNTOS = $COOR_CUR_CUR_INT_RANGO_3_PUNTOS;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from tabulador_edu_distancia where TUTOR_DIPLO_RANGO_1 = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->TUTOR_DIPLO_RANGO_1 = $row["TUTOR_DIPLO_RANGO_1"];
			$this->TUTOR_DIPLO_RANGO_2 = $row["TUTOR_DIPLO_RANGO_2"];
			$this->TUTOR_DIPLO_RANGO_3 = $row["TUTOR_DIPLO_RANGO_3"];
			$this->TUTOR_PROF_TEC_RANGO_1 = $row["TUTOR_PROF_TEC_RANGO_1"];
			$this->TUTOR_PROF_TEC_RANGO_2 = $row["TUTOR_PROF_TEC_RANGO_2"];
			$this->TUTOR_PROF_TEC_RANGO_3 = $row["TUTOR_PROF_TEC_RANGO_3"];
			$this->TUTOR_POSTEC_RANGO_1 = $row["TUTOR_POSTEC_RANGO_1"];
			$this->TUTOR_POSTEC_RANGO_2 = $row["TUTOR_POSTEC_RANGO_2"];
			$this->TUTOR_POSTEC_RANGO_3 = $row["TUTOR_POSTEC_RANGO_3"];
			$this->COOR_TUTO_FOR_RANGO_1 = $row["COOR_TUTO_FOR_RANGO_1"];
			$this->COOR_TUTO_FOR_RANGO_2 = $row["COOR_TUTO_FOR_RANGO_2"];
			$this->COOR_TUTO_FOR_RANGO_3 = $row["COOR_TUTO_FOR_RANGO_3"];
			$this->COOR_CUR_FOR_RANGO_1 = $row["COOR_CUR_FOR_RANGO_1"];
			$this->COOR_CUR_FOR_RANGO_2 = $row["COOR_CUR_FOR_RANGO_2"];
			$this->COOR_CUR_FOR_RANGO_3 = $row["COOR_CUR_FOR_RANGO_3"];
			$this->COOR_TUTO_CUR_INT_RANGO_1 = $row["COOR_TUTO_CUR_INT_RANGO_1"];
			$this->COOR_TUTO_CUR_INT_RANGO_2 = $row["COOR_TUTO_CUR_INT_RANGO_2"];
			$this->COOR_TUTO_CUR_INT_RANGO_3 = $row["COOR_TUTO_CUR_INT_RANGO_3"];
			$this->COOR_CUR_CUR_INT_RANGO_1 = $row["COOR_CUR_CUR_INT_RANGO_1"];
			$this->COOR_CUR_CUR_INT_RANGO_2 = $row["COOR_CUR_CUR_INT_RANGO_2"];
			$this->COOR_CUR_CUR_INT_RANGO_3 = $row["COOR_CUR_CUR_INT_RANGO_3"];
			$this->TUTOR_DIPLO_RANGO_1_PUNTOS = $row["TUTOR_DIPLO_RANGO_1_PUNTOS"];
			$this->TUTOR_DIPLO_RANGO_2_PUNTOS = $row["TUTOR_DIPLO_RANGO_2_PUNTOS"];
			$this->TUTOR_DIPLO_RANGO_3_PUNTOS = $row["TUTOR_DIPLO_RANGO_3_PUNTOS"];
			$this->TUTOR_PROF_TEC_RANGO_1_PUNTOS = $row["TUTOR_PROF_TEC_RANGO_1_PUNTOS"];
			$this->TUTOR_PROF_TEC_RANGO_2_PUNTOS = $row["TUTOR_PROF_TEC_RANGO_2_PUNTOS"];
			$this->TUTOR_PROF_TEC_RANGO_3_PUNTOS = $row["TUTOR_PROF_TEC_RANGO_3_PUNTOS"];
			$this->TUTOR_POSTEC_RANGO_1_PUNTOS = $row["TUTOR_POSTEC_RANGO_1_PUNTOS"];
			$this->TUTOR_POSTEC_RANGO_2_PUNTOS = $row["TUTOR_POSTEC_RANGO_2_PUNTOS"];
			$this->TUTOR_POSTEC_RANGO_3_PUNTOS = $row["TUTOR_POSTEC_RANGO_3_PUNTOS"];
			$this->COOR_TUTO_FOR_RANGO_1_PUNTOS = $row["COOR_TUTO_FOR_RANGO_1_PUNTOS"];
			$this->COOR_TUTO_FOR_RANGO_2_PUNTOS = $row["COOR_TUTO_FOR_RANGO_2_PUNTOS"];
			$this->COOR_TUTO_FOR_RANGO_3_PUNTOS = $row["COOR_TUTO_FOR_RANGO_3_PUNTOS"];
			$this->COOR_CUR_FOR_RANGO_1_PUNTOS = $row["COOR_CUR_FOR_RANGO_1_PUNTOS"];
			$this->COOR_CUR_FOR_RANGO_2_PUNTOS = $row["COOR_CUR_FOR_RANGO_2_PUNTOS"];
			$this->COOR_CUR_FOR_RANGO_3_PUNTOS = $row["COOR_CUR_FOR_RANGO_3_PUNTOS"];
			$this->COOR_TUTO_CUR_RANGO_1_PUNTOS = $row["COOR_TUTO_CUR_RANGO_1_PUNTOS"];
			$this->COOR_TUTO_CUR_RANGO_2_PUNTOS = $row["COOR_TUTO_CUR_RANGO_2_PUNTOS"];
			$this->COOR_TUTO_CUR_RANGO_3_PUNTOS = $row["COOR_TUTO_CUR_RANGO_3_PUNTOS"];
			$this->COOR_CUR_CUR_INT_RANGO_1_PUNTOS = $row["COOR_CUR_CUR_INT_RANGO_1_PUNTOS"];
			$this->COOR_CUR_CUR_INT_RANGO_2_PUNTOS = $row["COOR_CUR_CUR_INT_RANGO_2_PUNTOS"];
			$this->COOR_CUR_CUR_INT_RANGO_3_PUNTOS = $row["COOR_CUR_CUR_INT_RANGO_3_PUNTOS"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM tabulador_edu_distancia WHERE TUTOR_DIPLO_RANGO_1 = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE tabulador_edu_distancia set TUTOR_DIPLO_RANGO_1 = \"$this->TUTOR_DIPLO_RANGO_1\", TUTOR_DIPLO_RANGO_2 = \"$this->TUTOR_DIPLO_RANGO_2\", TUTOR_DIPLO_RANGO_3 = \"$this->TUTOR_DIPLO_RANGO_3\", TUTOR_PROF_TEC_RANGO_1 = \"$this->TUTOR_PROF_TEC_RANGO_1\", TUTOR_PROF_TEC_RANGO_2 = \"$this->TUTOR_PROF_TEC_RANGO_2\", TUTOR_PROF_TEC_RANGO_3 = \"$this->TUTOR_PROF_TEC_RANGO_3\", TUTOR_POSTEC_RANGO_1 = \"$this->TUTOR_POSTEC_RANGO_1\", TUTOR_POSTEC_RANGO_2 = \"$this->TUTOR_POSTEC_RANGO_2\", TUTOR_POSTEC_RANGO_3 = \"$this->TUTOR_POSTEC_RANGO_3\", COOR_TUTO_FOR_RANGO_1 = \"$this->COOR_TUTO_FOR_RANGO_1\", COOR_TUTO_FOR_RANGO_2 = \"$this->COOR_TUTO_FOR_RANGO_2\", COOR_TUTO_FOR_RANGO_3 = \"$this->COOR_TUTO_FOR_RANGO_3\", COOR_CUR_FOR_RANGO_1 = \"$this->COOR_CUR_FOR_RANGO_1\", COOR_CUR_FOR_RANGO_2 = \"$this->COOR_CUR_FOR_RANGO_2\", COOR_CUR_FOR_RANGO_3 = \"$this->COOR_CUR_FOR_RANGO_3\", COOR_TUTO_CUR_INT_RANGO_1 = \"$this->COOR_TUTO_CUR_INT_RANGO_1\", COOR_TUTO_CUR_INT_RANGO_2 = \"$this->COOR_TUTO_CUR_INT_RANGO_2\", COOR_TUTO_CUR_INT_RANGO_3 = \"$this->COOR_TUTO_CUR_INT_RANGO_3\", COOR_CUR_CUR_INT_RANGO_1 = \"$this->COOR_CUR_CUR_INT_RANGO_1\", COOR_CUR_CUR_INT_RANGO_2 = \"$this->COOR_CUR_CUR_INT_RANGO_2\", COOR_CUR_CUR_INT_RANGO_3 = \"$this->COOR_CUR_CUR_INT_RANGO_3\", TUTOR_DIPLO_RANGO_1_PUNTOS = \"$this->TUTOR_DIPLO_RANGO_1_PUNTOS\", TUTOR_DIPLO_RANGO_2_PUNTOS = \"$this->TUTOR_DIPLO_RANGO_2_PUNTOS\", TUTOR_DIPLO_RANGO_3_PUNTOS = \"$this->TUTOR_DIPLO_RANGO_3_PUNTOS\", TUTOR_PROF_TEC_RANGO_1_PUNTOS = \"$this->TUTOR_PROF_TEC_RANGO_1_PUNTOS\", TUTOR_PROF_TEC_RANGO_2_PUNTOS = \"$this->TUTOR_PROF_TEC_RANGO_2_PUNTOS\", TUTOR_PROF_TEC_RANGO_3_PUNTOS = \"$this->TUTOR_PROF_TEC_RANGO_3_PUNTOS\", TUTOR_POSTEC_RANGO_1_PUNTOS = \"$this->TUTOR_POSTEC_RANGO_1_PUNTOS\", TUTOR_POSTEC_RANGO_2_PUNTOS = \"$this->TUTOR_POSTEC_RANGO_2_PUNTOS\", TUTOR_POSTEC_RANGO_3_PUNTOS = \"$this->TUTOR_POSTEC_RANGO_3_PUNTOS\", COOR_TUTO_FOR_RANGO_1_PUNTOS = \"$this->COOR_TUTO_FOR_RANGO_1_PUNTOS\", COOR_TUTO_FOR_RANGO_2_PUNTOS = \"$this->COOR_TUTO_FOR_RANGO_2_PUNTOS\", COOR_TUTO_FOR_RANGO_3_PUNTOS = \"$this->COOR_TUTO_FOR_RANGO_3_PUNTOS\", COOR_CUR_FOR_RANGO_1_PUNTOS = \"$this->COOR_CUR_FOR_RANGO_1_PUNTOS\", COOR_CUR_FOR_RANGO_2_PUNTOS = \"$this->COOR_CUR_FOR_RANGO_2_PUNTOS\", COOR_CUR_FOR_RANGO_3_PUNTOS = \"$this->COOR_CUR_FOR_RANGO_3_PUNTOS\", COOR_TUTO_CUR_RANGO_1_PUNTOS = \"$this->COOR_TUTO_CUR_RANGO_1_PUNTOS\", COOR_TUTO_CUR_RANGO_2_PUNTOS = \"$this->COOR_TUTO_CUR_RANGO_2_PUNTOS\", COOR_TUTO_CUR_RANGO_3_PUNTOS = \"$this->COOR_TUTO_CUR_RANGO_3_PUNTOS\", COOR_CUR_CUR_INT_RANGO_1_PUNTOS = \"$this->COOR_CUR_CUR_INT_RANGO_1_PUNTOS\", COOR_CUR_CUR_INT_RANGO_2_PUNTOS = \"$this->COOR_CUR_CUR_INT_RANGO_2_PUNTOS\", COOR_CUR_CUR_INT_RANGO_3_PUNTOS = \"$this->COOR_CUR_CUR_INT_RANGO_3_PUNTOS\" where TUTOR_DIPLO_RANGO_1 = \"$this->TUTOR_DIPLO_RANGO_1\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into tabulador_edu_distancia (TUTOR_DIPLO_RANGO_1, TUTOR_DIPLO_RANGO_2, TUTOR_DIPLO_RANGO_3, TUTOR_PROF_TEC_RANGO_1, TUTOR_PROF_TEC_RANGO_2, TUTOR_PROF_TEC_RANGO_3, TUTOR_POSTEC_RANGO_1, TUTOR_POSTEC_RANGO_2, TUTOR_POSTEC_RANGO_3, COOR_TUTO_FOR_RANGO_1, COOR_TUTO_FOR_RANGO_2, COOR_TUTO_FOR_RANGO_3, COOR_CUR_FOR_RANGO_1, COOR_CUR_FOR_RANGO_2, COOR_CUR_FOR_RANGO_3, COOR_TUTO_CUR_INT_RANGO_1, COOR_TUTO_CUR_INT_RANGO_2, COOR_TUTO_CUR_INT_RANGO_3, COOR_CUR_CUR_INT_RANGO_1, COOR_CUR_CUR_INT_RANGO_2, COOR_CUR_CUR_INT_RANGO_3, TUTOR_DIPLO_RANGO_1_PUNTOS, TUTOR_DIPLO_RANGO_2_PUNTOS, TUTOR_DIPLO_RANGO_3_PUNTOS, TUTOR_PROF_TEC_RANGO_1_PUNTOS, TUTOR_PROF_TEC_RANGO_2_PUNTOS, TUTOR_PROF_TEC_RANGO_3_PUNTOS, TUTOR_POSTEC_RANGO_1_PUNTOS, TUTOR_POSTEC_RANGO_2_PUNTOS, TUTOR_POSTEC_RANGO_3_PUNTOS, COOR_TUTO_FOR_RANGO_1_PUNTOS, COOR_TUTO_FOR_RANGO_2_PUNTOS, COOR_TUTO_FOR_RANGO_3_PUNTOS, COOR_CUR_FOR_RANGO_1_PUNTOS, COOR_CUR_FOR_RANGO_2_PUNTOS, COOR_CUR_FOR_RANGO_3_PUNTOS, COOR_TUTO_CUR_RANGO_1_PUNTOS, COOR_TUTO_CUR_RANGO_2_PUNTOS, COOR_TUTO_CUR_RANGO_3_PUNTOS, COOR_CUR_CUR_INT_RANGO_1_PUNTOS, COOR_CUR_CUR_INT_RANGO_2_PUNTOS, COOR_CUR_CUR_INT_RANGO_3_PUNTOS) values (\"$this->TUTOR_DIPLO_RANGO_1\", \"$this->TUTOR_DIPLO_RANGO_2\", \"$this->TUTOR_DIPLO_RANGO_3\", \"$this->TUTOR_PROF_TEC_RANGO_1\", \"$this->TUTOR_PROF_TEC_RANGO_2\", \"$this->TUTOR_PROF_TEC_RANGO_3\", \"$this->TUTOR_POSTEC_RANGO_1\", \"$this->TUTOR_POSTEC_RANGO_2\", \"$this->TUTOR_POSTEC_RANGO_3\", \"$this->COOR_TUTO_FOR_RANGO_1\", \"$this->COOR_TUTO_FOR_RANGO_2\", \"$this->COOR_TUTO_FOR_RANGO_3\", \"$this->COOR_CUR_FOR_RANGO_1\", \"$this->COOR_CUR_FOR_RANGO_2\", \"$this->COOR_CUR_FOR_RANGO_3\", \"$this->COOR_TUTO_CUR_INT_RANGO_1\", \"$this->COOR_TUTO_CUR_INT_RANGO_2\", \"$this->COOR_TUTO_CUR_INT_RANGO_3\", \"$this->COOR_CUR_CUR_INT_RANGO_1\", \"$this->COOR_CUR_CUR_INT_RANGO_2\", \"$this->COOR_CUR_CUR_INT_RANGO_3\", \"$this->TUTOR_DIPLO_RANGO_1_PUNTOS\", \"$this->TUTOR_DIPLO_RANGO_2_PUNTOS\", \"$this->TUTOR_DIPLO_RANGO_3_PUNTOS\", \"$this->TUTOR_PROF_TEC_RANGO_1_PUNTOS\", \"$this->TUTOR_PROF_TEC_RANGO_2_PUNTOS\", \"$this->TUTOR_PROF_TEC_RANGO_3_PUNTOS\", \"$this->TUTOR_POSTEC_RANGO_1_PUNTOS\", \"$this->TUTOR_POSTEC_RANGO_2_PUNTOS\", \"$this->TUTOR_POSTEC_RANGO_3_PUNTOS\", \"$this->COOR_TUTO_FOR_RANGO_1_PUNTOS\", \"$this->COOR_TUTO_FOR_RANGO_2_PUNTOS\", \"$this->COOR_TUTO_FOR_RANGO_3_PUNTOS\", \"$this->COOR_CUR_FOR_RANGO_1_PUNTOS\", \"$this->COOR_CUR_FOR_RANGO_2_PUNTOS\", \"$this->COOR_CUR_FOR_RANGO_3_PUNTOS\", \"$this->COOR_TUTO_CUR_RANGO_1_PUNTOS\", \"$this->COOR_TUTO_CUR_RANGO_2_PUNTOS\", \"$this->COOR_TUTO_CUR_RANGO_3_PUNTOS\", \"$this->COOR_CUR_CUR_INT_RANGO_1_PUNTOS\", \"$this->COOR_CUR_CUR_INT_RANGO_2_PUNTOS\", \"$this->COOR_CUR_CUR_INT_RANGO_3_PUNTOS\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT TUTOR_DIPLO_RANGO_1 from tabulador_edu_distancia order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["TUTOR_DIPLO_RANGO_1"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return TUTOR_DIPLO_RANGO_1 - varchar(20)
	 */
	public function getTUTOR_DIPLO_RANGO_1(){
		return $this->TUTOR_DIPLO_RANGO_1;
	}

	/**
	 * @return TUTOR_DIPLO_RANGO_2 - varchar(20)
	 */
	public function getTUTOR_DIPLO_RANGO_2(){
		return $this->TUTOR_DIPLO_RANGO_2;
	}

	/**
	 * @return TUTOR_DIPLO_RANGO_3 - varchar(20)
	 */
	public function getTUTOR_DIPLO_RANGO_3(){
		return $this->TUTOR_DIPLO_RANGO_3;
	}

	/**
	 * @return TUTOR_PROF_TEC_RANGO_1 - varchar(20)
	 */
	public function getTUTOR_PROF_TEC_RANGO_1(){
		return $this->TUTOR_PROF_TEC_RANGO_1;
	}

	/**
	 * @return TUTOR_PROF_TEC_RANGO_2 - varchar(20)
	 */
	public function getTUTOR_PROF_TEC_RANGO_2(){
		return $this->TUTOR_PROF_TEC_RANGO_2;
	}

	/**
	 * @return TUTOR_PROF_TEC_RANGO_3 - varchar(20)
	 */
	public function getTUTOR_PROF_TEC_RANGO_3(){
		return $this->TUTOR_PROF_TEC_RANGO_3;
	}

	/**
	 * @return TUTOR_POSTEC_RANGO_1 - varchar(20)
	 */
	public function getTUTOR_POSTEC_RANGO_1(){
		return $this->TUTOR_POSTEC_RANGO_1;
	}

	/**
	 * @return TUTOR_POSTEC_RANGO_2 - varchar(20)
	 */
	public function getTUTOR_POSTEC_RANGO_2(){
		return $this->TUTOR_POSTEC_RANGO_2;
	}

	/**
	 * @return TUTOR_POSTEC_RANGO_3 - varchar(20)
	 */
	public function getTUTOR_POSTEC_RANGO_3(){
		return $this->TUTOR_POSTEC_RANGO_3;
	}

	/**
	 * @return COOR_TUTO_FOR_RANGO_1 - varchar(20)
	 */
	public function getCOOR_TUTO_FOR_RANGO_1(){
		return $this->COOR_TUTO_FOR_RANGO_1;
	}

	/**
	 * @return COOR_TUTO_FOR_RANGO_2 - varchar(20)
	 */
	public function getCOOR_TUTO_FOR_RANGO_2(){
		return $this->COOR_TUTO_FOR_RANGO_2;
	}

	/**
	 * @return COOR_TUTO_FOR_RANGO_3 - varchar(20)
	 */
	public function getCOOR_TUTO_FOR_RANGO_3(){
		return $this->COOR_TUTO_FOR_RANGO_3;
	}

	/**
	 * @return COOR_CUR_FOR_RANGO_1 - varchar(20)
	 */
	public function getCOOR_CUR_FOR_RANGO_1(){
		return $this->COOR_CUR_FOR_RANGO_1;
	}

	/**
	 * @return COOR_CUR_FOR_RANGO_2 - varchar(20)
	 */
	public function getCOOR_CUR_FOR_RANGO_2(){
		return $this->COOR_CUR_FOR_RANGO_2;
	}

	/**
	 * @return COOR_CUR_FOR_RANGO_3 - varchar(20)
	 */
	public function getCOOR_CUR_FOR_RANGO_3(){
		return $this->COOR_CUR_FOR_RANGO_3;
	}

	/**
	 * @return COOR_TUTO_CUR_INT_RANGO_1 - char(18)
	 */
	public function getCOOR_TUTO_CUR_INT_RANGO_1(){
		return $this->COOR_TUTO_CUR_INT_RANGO_1;
	}

	/**
	 * @return COOR_TUTO_CUR_INT_RANGO_2 - varchar(20)
	 */
	public function getCOOR_TUTO_CUR_INT_RANGO_2(){
		return $this->COOR_TUTO_CUR_INT_RANGO_2;
	}

	/**
	 * @return COOR_TUTO_CUR_INT_RANGO_3 - char(18)
	 */
	public function getCOOR_TUTO_CUR_INT_RANGO_3(){
		return $this->COOR_TUTO_CUR_INT_RANGO_3;
	}

	/**
	 * @return COOR_CUR_CUR_INT_RANGO_1 - varchar(20)
	 */
	public function getCOOR_CUR_CUR_INT_RANGO_1(){
		return $this->COOR_CUR_CUR_INT_RANGO_1;
	}

	/**
	 * @return COOR_CUR_CUR_INT_RANGO_2 - varchar(20)
	 */
	public function getCOOR_CUR_CUR_INT_RANGO_2(){
		return $this->COOR_CUR_CUR_INT_RANGO_2;
	}

	/**
	 * @return COOR_CUR_CUR_INT_RANGO_3 - varchar(20)
	 */
	public function getCOOR_CUR_CUR_INT_RANGO_3(){
		return $this->COOR_CUR_CUR_INT_RANGO_3;
	}

	/**
	 * @return TUTOR_DIPLO_RANGO_1_PUNTOS - int(11)
	 */
	public function getTUTOR_DIPLO_RANGO_1_PUNTOS(){
		return $this->TUTOR_DIPLO_RANGO_1_PUNTOS;
	}

	/**
	 * @return TUTOR_DIPLO_RANGO_2_PUNTOS - int(11)
	 */
	public function getTUTOR_DIPLO_RANGO_2_PUNTOS(){
		return $this->TUTOR_DIPLO_RANGO_2_PUNTOS;
	}

	/**
	 * @return TUTOR_DIPLO_RANGO_3_PUNTOS - varchar(20)
	 */
	public function getTUTOR_DIPLO_RANGO_3_PUNTOS(){
		return $this->TUTOR_DIPLO_RANGO_3_PUNTOS;
	}

	/**
	 * @return TUTOR_PROF_TEC_RANGO_1_PUNTOS - int(11)
	 */
	public function getTUTOR_PROF_TEC_RANGO_1_PUNTOS(){
		return $this->TUTOR_PROF_TEC_RANGO_1_PUNTOS;
	}

	/**
	 * @return TUTOR_PROF_TEC_RANGO_2_PUNTOS - int(11)
	 */
	public function getTUTOR_PROF_TEC_RANGO_2_PUNTOS(){
		return $this->TUTOR_PROF_TEC_RANGO_2_PUNTOS;
	}

	/**
	 * @return TUTOR_PROF_TEC_RANGO_3_PUNTOS - int(11)
	 */
	public function getTUTOR_PROF_TEC_RANGO_3_PUNTOS(){
		return $this->TUTOR_PROF_TEC_RANGO_3_PUNTOS;
	}

	/**
	 * @return TUTOR_POSTEC_RANGO_1_PUNTOS - int(11)
	 */
	public function getTUTOR_POSTEC_RANGO_1_PUNTOS(){
		return $this->TUTOR_POSTEC_RANGO_1_PUNTOS;
	}

	/**
	 * @return TUTOR_POSTEC_RANGO_2_PUNTOS - int(11)
	 */
	public function getTUTOR_POSTEC_RANGO_2_PUNTOS(){
		return $this->TUTOR_POSTEC_RANGO_2_PUNTOS;
	}

	/**
	 * @return TUTOR_POSTEC_RANGO_3_PUNTOS - int(11)
	 */
	public function getTUTOR_POSTEC_RANGO_3_PUNTOS(){
		return $this->TUTOR_POSTEC_RANGO_3_PUNTOS;
	}

	/**
	 * @return COOR_TUTO_FOR_RANGO_1_PUNTOS - int(11)
	 */
	public function getCOOR_TUTO_FOR_RANGO_1_PUNTOS(){
		return $this->COOR_TUTO_FOR_RANGO_1_PUNTOS;
	}

	/**
	 * @return COOR_TUTO_FOR_RANGO_2_PUNTOS - int(11)
	 */
	public function getCOOR_TUTO_FOR_RANGO_2_PUNTOS(){
		return $this->COOR_TUTO_FOR_RANGO_2_PUNTOS;
	}

	/**
	 * @return COOR_TUTO_FOR_RANGO_3_PUNTOS - int(11)
	 */
	public function getCOOR_TUTO_FOR_RANGO_3_PUNTOS(){
		return $this->COOR_TUTO_FOR_RANGO_3_PUNTOS;
	}

	/**
	 * @return COOR_CUR_FOR_RANGO_1_PUNTOS - int(11)
	 */
	public function getCOOR_CUR_FOR_RANGO_1_PUNTOS(){
		return $this->COOR_CUR_FOR_RANGO_1_PUNTOS;
	}

	/**
	 * @return COOR_CUR_FOR_RANGO_2_PUNTOS - int(11)
	 */
	public function getCOOR_CUR_FOR_RANGO_2_PUNTOS(){
		return $this->COOR_CUR_FOR_RANGO_2_PUNTOS;
	}

	/**
	 * @return COOR_CUR_FOR_RANGO_3_PUNTOS - int(11)
	 */
	public function getCOOR_CUR_FOR_RANGO_3_PUNTOS(){
		return $this->COOR_CUR_FOR_RANGO_3_PUNTOS;
	}

	/**
	 * @return COOR_TUTO_CUR_RANGO_1_PUNTOS - int(11)
	 */
	public function getCOOR_TUTO_CUR_RANGO_1_PUNTOS(){
		return $this->COOR_TUTO_CUR_RANGO_1_PUNTOS;
	}

	/**
	 * @return COOR_TUTO_CUR_RANGO_2_PUNTOS - int(11)
	 */
	public function getCOOR_TUTO_CUR_RANGO_2_PUNTOS(){
		return $this->COOR_TUTO_CUR_RANGO_2_PUNTOS;
	}

	/**
	 * @return COOR_TUTO_CUR_RANGO_3_PUNTOS - int(11)
	 */
	public function getCOOR_TUTO_CUR_RANGO_3_PUNTOS(){
		return $this->COOR_TUTO_CUR_RANGO_3_PUNTOS;
	}

	/**
	 * @return COOR_CUR_CUR_INT_RANGO_1_PUNTOS - int(11)
	 */
	public function getCOOR_CUR_CUR_INT_RANGO_1_PUNTOS(){
		return $this->COOR_CUR_CUR_INT_RANGO_1_PUNTOS;
	}

	/**
	 * @return COOR_CUR_CUR_INT_RANGO_2_PUNTOS - int(11)
	 */
	public function getCOOR_CUR_CUR_INT_RANGO_2_PUNTOS(){
		return $this->COOR_CUR_CUR_INT_RANGO_2_PUNTOS;
	}

	/**
	 * @return COOR_CUR_CUR_INT_RANGO_3_PUNTOS - int(11)
	 */
	public function getCOOR_CUR_CUR_INT_RANGO_3_PUNTOS(){
		return $this->COOR_CUR_CUR_INT_RANGO_3_PUNTOS;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setTUTOR_DIPLO_RANGO_1($TUTOR_DIPLO_RANGO_1){
		$this->TUTOR_DIPLO_RANGO_1 = $TUTOR_DIPLO_RANGO_1;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setTUTOR_DIPLO_RANGO_2($TUTOR_DIPLO_RANGO_2){
		$this->TUTOR_DIPLO_RANGO_2 = $TUTOR_DIPLO_RANGO_2;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setTUTOR_DIPLO_RANGO_3($TUTOR_DIPLO_RANGO_3){
		$this->TUTOR_DIPLO_RANGO_3 = $TUTOR_DIPLO_RANGO_3;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setTUTOR_PROF_TEC_RANGO_1($TUTOR_PROF_TEC_RANGO_1){
		$this->TUTOR_PROF_TEC_RANGO_1 = $TUTOR_PROF_TEC_RANGO_1;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setTUTOR_PROF_TEC_RANGO_2($TUTOR_PROF_TEC_RANGO_2){
		$this->TUTOR_PROF_TEC_RANGO_2 = $TUTOR_PROF_TEC_RANGO_2;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setTUTOR_PROF_TEC_RANGO_3($TUTOR_PROF_TEC_RANGO_3){
		$this->TUTOR_PROF_TEC_RANGO_3 = $TUTOR_PROF_TEC_RANGO_3;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setTUTOR_POSTEC_RANGO_1($TUTOR_POSTEC_RANGO_1){
		$this->TUTOR_POSTEC_RANGO_1 = $TUTOR_POSTEC_RANGO_1;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setTUTOR_POSTEC_RANGO_2($TUTOR_POSTEC_RANGO_2){
		$this->TUTOR_POSTEC_RANGO_2 = $TUTOR_POSTEC_RANGO_2;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setTUTOR_POSTEC_RANGO_3($TUTOR_POSTEC_RANGO_3){
		$this->TUTOR_POSTEC_RANGO_3 = $TUTOR_POSTEC_RANGO_3;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setCOOR_TUTO_FOR_RANGO_1($COOR_TUTO_FOR_RANGO_1){
		$this->COOR_TUTO_FOR_RANGO_1 = $COOR_TUTO_FOR_RANGO_1;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setCOOR_TUTO_FOR_RANGO_2($COOR_TUTO_FOR_RANGO_2){
		$this->COOR_TUTO_FOR_RANGO_2 = $COOR_TUTO_FOR_RANGO_2;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setCOOR_TUTO_FOR_RANGO_3($COOR_TUTO_FOR_RANGO_3){
		$this->COOR_TUTO_FOR_RANGO_3 = $COOR_TUTO_FOR_RANGO_3;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setCOOR_CUR_FOR_RANGO_1($COOR_CUR_FOR_RANGO_1){
		$this->COOR_CUR_FOR_RANGO_1 = $COOR_CUR_FOR_RANGO_1;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setCOOR_CUR_FOR_RANGO_2($COOR_CUR_FOR_RANGO_2){
		$this->COOR_CUR_FOR_RANGO_2 = $COOR_CUR_FOR_RANGO_2;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setCOOR_CUR_FOR_RANGO_3($COOR_CUR_FOR_RANGO_3){
		$this->COOR_CUR_FOR_RANGO_3 = $COOR_CUR_FOR_RANGO_3;
	}

	/**
	 * @param Type: char(18)
	 */
	public function setCOOR_TUTO_CUR_INT_RANGO_1($COOR_TUTO_CUR_INT_RANGO_1){
		$this->COOR_TUTO_CUR_INT_RANGO_1 = $COOR_TUTO_CUR_INT_RANGO_1;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setCOOR_TUTO_CUR_INT_RANGO_2($COOR_TUTO_CUR_INT_RANGO_2){
		$this->COOR_TUTO_CUR_INT_RANGO_2 = $COOR_TUTO_CUR_INT_RANGO_2;
	}

	/**
	 * @param Type: char(18)
	 */
	public function setCOOR_TUTO_CUR_INT_RANGO_3($COOR_TUTO_CUR_INT_RANGO_3){
		$this->COOR_TUTO_CUR_INT_RANGO_3 = $COOR_TUTO_CUR_INT_RANGO_3;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setCOOR_CUR_CUR_INT_RANGO_1($COOR_CUR_CUR_INT_RANGO_1){
		$this->COOR_CUR_CUR_INT_RANGO_1 = $COOR_CUR_CUR_INT_RANGO_1;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setCOOR_CUR_CUR_INT_RANGO_2($COOR_CUR_CUR_INT_RANGO_2){
		$this->COOR_CUR_CUR_INT_RANGO_2 = $COOR_CUR_CUR_INT_RANGO_2;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setCOOR_CUR_CUR_INT_RANGO_3($COOR_CUR_CUR_INT_RANGO_3){
		$this->COOR_CUR_CUR_INT_RANGO_3 = $COOR_CUR_CUR_INT_RANGO_3;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTUTOR_DIPLO_RANGO_1_PUNTOS($TUTOR_DIPLO_RANGO_1_PUNTOS){
		$this->TUTOR_DIPLO_RANGO_1_PUNTOS = $TUTOR_DIPLO_RANGO_1_PUNTOS;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTUTOR_DIPLO_RANGO_2_PUNTOS($TUTOR_DIPLO_RANGO_2_PUNTOS){
		$this->TUTOR_DIPLO_RANGO_2_PUNTOS = $TUTOR_DIPLO_RANGO_2_PUNTOS;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setTUTOR_DIPLO_RANGO_3_PUNTOS($TUTOR_DIPLO_RANGO_3_PUNTOS){
		$this->TUTOR_DIPLO_RANGO_3_PUNTOS = $TUTOR_DIPLO_RANGO_3_PUNTOS;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTUTOR_PROF_TEC_RANGO_1_PUNTOS($TUTOR_PROF_TEC_RANGO_1_PUNTOS){
		$this->TUTOR_PROF_TEC_RANGO_1_PUNTOS = $TUTOR_PROF_TEC_RANGO_1_PUNTOS;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTUTOR_PROF_TEC_RANGO_2_PUNTOS($TUTOR_PROF_TEC_RANGO_2_PUNTOS){
		$this->TUTOR_PROF_TEC_RANGO_2_PUNTOS = $TUTOR_PROF_TEC_RANGO_2_PUNTOS;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTUTOR_PROF_TEC_RANGO_3_PUNTOS($TUTOR_PROF_TEC_RANGO_3_PUNTOS){
		$this->TUTOR_PROF_TEC_RANGO_3_PUNTOS = $TUTOR_PROF_TEC_RANGO_3_PUNTOS;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTUTOR_POSTEC_RANGO_1_PUNTOS($TUTOR_POSTEC_RANGO_1_PUNTOS){
		$this->TUTOR_POSTEC_RANGO_1_PUNTOS = $TUTOR_POSTEC_RANGO_1_PUNTOS;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTUTOR_POSTEC_RANGO_2_PUNTOS($TUTOR_POSTEC_RANGO_2_PUNTOS){
		$this->TUTOR_POSTEC_RANGO_2_PUNTOS = $TUTOR_POSTEC_RANGO_2_PUNTOS;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTUTOR_POSTEC_RANGO_3_PUNTOS($TUTOR_POSTEC_RANGO_3_PUNTOS){
		$this->TUTOR_POSTEC_RANGO_3_PUNTOS = $TUTOR_POSTEC_RANGO_3_PUNTOS;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setCOOR_TUTO_FOR_RANGO_1_PUNTOS($COOR_TUTO_FOR_RANGO_1_PUNTOS){
		$this->COOR_TUTO_FOR_RANGO_1_PUNTOS = $COOR_TUTO_FOR_RANGO_1_PUNTOS;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setCOOR_TUTO_FOR_RANGO_2_PUNTOS($COOR_TUTO_FOR_RANGO_2_PUNTOS){
		$this->COOR_TUTO_FOR_RANGO_2_PUNTOS = $COOR_TUTO_FOR_RANGO_2_PUNTOS;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setCOOR_TUTO_FOR_RANGO_3_PUNTOS($COOR_TUTO_FOR_RANGO_3_PUNTOS){
		$this->COOR_TUTO_FOR_RANGO_3_PUNTOS = $COOR_TUTO_FOR_RANGO_3_PUNTOS;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setCOOR_CUR_FOR_RANGO_1_PUNTOS($COOR_CUR_FOR_RANGO_1_PUNTOS){
		$this->COOR_CUR_FOR_RANGO_1_PUNTOS = $COOR_CUR_FOR_RANGO_1_PUNTOS;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setCOOR_CUR_FOR_RANGO_2_PUNTOS($COOR_CUR_FOR_RANGO_2_PUNTOS){
		$this->COOR_CUR_FOR_RANGO_2_PUNTOS = $COOR_CUR_FOR_RANGO_2_PUNTOS;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setCOOR_CUR_FOR_RANGO_3_PUNTOS($COOR_CUR_FOR_RANGO_3_PUNTOS){
		$this->COOR_CUR_FOR_RANGO_3_PUNTOS = $COOR_CUR_FOR_RANGO_3_PUNTOS;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setCOOR_TUTO_CUR_RANGO_1_PUNTOS($COOR_TUTO_CUR_RANGO_1_PUNTOS){
		$this->COOR_TUTO_CUR_RANGO_1_PUNTOS = $COOR_TUTO_CUR_RANGO_1_PUNTOS;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setCOOR_TUTO_CUR_RANGO_2_PUNTOS($COOR_TUTO_CUR_RANGO_2_PUNTOS){
		$this->COOR_TUTO_CUR_RANGO_2_PUNTOS = $COOR_TUTO_CUR_RANGO_2_PUNTOS;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setCOOR_TUTO_CUR_RANGO_3_PUNTOS($COOR_TUTO_CUR_RANGO_3_PUNTOS){
		$this->COOR_TUTO_CUR_RANGO_3_PUNTOS = $COOR_TUTO_CUR_RANGO_3_PUNTOS;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setCOOR_CUR_CUR_INT_RANGO_1_PUNTOS($COOR_CUR_CUR_INT_RANGO_1_PUNTOS){
		$this->COOR_CUR_CUR_INT_RANGO_1_PUNTOS = $COOR_CUR_CUR_INT_RANGO_1_PUNTOS;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setCOOR_CUR_CUR_INT_RANGO_2_PUNTOS($COOR_CUR_CUR_INT_RANGO_2_PUNTOS){
		$this->COOR_CUR_CUR_INT_RANGO_2_PUNTOS = $COOR_CUR_CUR_INT_RANGO_2_PUNTOS;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setCOOR_CUR_CUR_INT_RANGO_3_PUNTOS($COOR_CUR_CUR_INT_RANGO_3_PUNTOS){
		$this->COOR_CUR_CUR_INT_RANGO_3_PUNTOS = $COOR_CUR_CUR_INT_RANGO_3_PUNTOS;
	}

    /**
     * Close mysql connection
     */
	public function endtabulador_edu_distancia(){
		$this->connection->CloseMysql();
	}

}