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

Class rist_categoria {

	private $id_cat; //int(11)
	private $nom_categoria; //varchar(60)
	private $des_clave; //varchar(15)
	private $cve_tipo_categoria; //decimal(11,0)
	private $nom_tipo_cat; //varchar(40)
	private $connection;

	public function rist_categoria(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_rist_categoria($id_cat,$nom_categoria,$cve_tipo_categoria,$nom_tipo_cat){
		$this->id_cat = $id_cat;
		$this->nom_categoria = $nom_categoria;
		$this->cve_tipo_categoria = $cve_tipo_categoria;
		$this->nom_tipo_cat = $nom_tipo_cat;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from rist_categoria where des_clave = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->id_cat = $row["id_cat"];
			$this->nom_categoria = $row["nom_categoria"];
			$this->des_clave = $row["des_clave"];
			$this->cve_tipo_categoria = $row["cve_tipo_categoria"];
			$this->nom_tipo_cat = $row["nom_tipo_cat"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM rist_categoria WHERE des_clave = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE rist_categoria set id_cat = \"$this->id_cat\", nom_categoria = \"$this->nom_categoria\", cve_tipo_categoria = \"$this->cve_tipo_categoria\", nom_tipo_cat = \"$this->nom_tipo_cat\" where des_clave = \"$this->des_clave\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into rist_categoria (id_cat, nom_categoria, cve_tipo_categoria, nom_tipo_cat) values (\"$this->id_cat\", \"$this->nom_categoria\", \"$this->cve_tipo_categoria\", \"$this->nom_tipo_cat\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT des_clave from rist_categoria order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["des_clave"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return id_cat - int(11)
	 */
	public function getid_cat(){
		return $this->id_cat;
	}

	/**
	 * @return nom_categoria - varchar(60)
	 */
	public function getnom_categoria(){
		return $this->nom_categoria;
	}

	/**
	 * @return des_clave - varchar(15)
	 */
	public function getdes_clave(){
		return $this->des_clave;
	}

	/**
	 * @return cve_tipo_categoria - decimal(11,0)
	 */
	public function getcve_tipo_categoria(){
		return $this->cve_tipo_categoria;
	}

	/**
	 * @return nom_tipo_cat - varchar(40)
	 */
	public function getnom_tipo_cat(){
		return $this->nom_tipo_cat;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setid_cat($id_cat){
		$this->id_cat = $id_cat;
	}

	/**
	 * @param Type: varchar(60)
	 */
	public function setnom_categoria($nom_categoria){
		$this->nom_categoria = $nom_categoria;
	}

	/**
	 * @param Type: varchar(15)
	 */
	public function setdes_clave($des_clave){
		$this->des_clave = $des_clave;
	}

	/**
	 * @param Type: decimal(11,0)
	 */
	public function setcve_tipo_categoria($cve_tipo_categoria){
		$this->cve_tipo_categoria = $cve_tipo_categoria;
	}

	/**
	 * @param Type: varchar(40)
	 */
	public function setnom_tipo_cat($nom_tipo_cat){
		$this->nom_tipo_cat = $nom_tipo_cat;
	}

    /**
     * Close mysql connection
     */
	public function endrist_categoria(){
		$this->connection->CloseMysql();
	}

}