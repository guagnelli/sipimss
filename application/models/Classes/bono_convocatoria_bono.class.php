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

Class bono_convocatoria_bono {

	private $conv_bono_cve; //int(11)
	private $nom_bono; //varchar(100)
	private $f_ini_carga_datos; //datetime
	private $f_fin_carga_datos; //datetime
	private $max_beneficiados; //int(4)
	private $anio_bono; //year(4)
	private $status_bono; //smallint(1)
	private $connection;

	public function bono_convocatoria_bono(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_bono_convocatoria_bono($nom_bono,$f_ini_carga_datos,$f_fin_carga_datos,$max_beneficiados,$anio_bono,$status_bono){
		$this->nom_bono = $nom_bono;
		$this->f_ini_carga_datos = $f_ini_carga_datos;
		$this->f_fin_carga_datos = $f_fin_carga_datos;
		$this->max_beneficiados = $max_beneficiados;
		$this->anio_bono = $anio_bono;
		$this->status_bono = $status_bono;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from bono_convocatoria_bono where conv_bono_cve = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->conv_bono_cve = $row["conv_bono_cve"];
			$this->nom_bono = $row["nom_bono"];
			$this->f_ini_carga_datos = $row["f_ini_carga_datos"];
			$this->f_fin_carga_datos = $row["f_fin_carga_datos"];
			$this->max_beneficiados = $row["max_beneficiados"];
			$this->anio_bono = $row["anio_bono"];
			$this->status_bono = $row["status_bono"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM bono_convocatoria_bono WHERE conv_bono_cve = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE bono_convocatoria_bono set nom_bono = \"$this->nom_bono\", f_ini_carga_datos = \"$this->f_ini_carga_datos\", f_fin_carga_datos = \"$this->f_fin_carga_datos\", max_beneficiados = \"$this->max_beneficiados\", anio_bono = \"$this->anio_bono\", status_bono = \"$this->status_bono\" where conv_bono_cve = \"$this->conv_bono_cve\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into bono_convocatoria_bono (nom_bono, f_ini_carga_datos, f_fin_carga_datos, max_beneficiados, anio_bono, status_bono) values (\"$this->nom_bono\", \"$this->f_ini_carga_datos\", \"$this->f_fin_carga_datos\", \"$this->max_beneficiados\", \"$this->anio_bono\", \"$this->status_bono\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT conv_bono_cve from bono_convocatoria_bono order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["conv_bono_cve"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return conv_bono_cve - int(11)
	 */
	public function getconv_bono_cve(){
		return $this->conv_bono_cve;
	}

	/**
	 * @return nom_bono - varchar(100)
	 */
	public function getnom_bono(){
		return $this->nom_bono;
	}

	/**
	 * @return f_ini_carga_datos - datetime
	 */
	public function getf_ini_carga_datos(){
		return $this->f_ini_carga_datos;
	}

	/**
	 * @return f_fin_carga_datos - datetime
	 */
	public function getf_fin_carga_datos(){
		return $this->f_fin_carga_datos;
	}

	/**
	 * @return max_beneficiados - int(4)
	 */
	public function getmax_beneficiados(){
		return $this->max_beneficiados;
	}

	/**
	 * @return anio_bono - year(4)
	 */
	public function getanio_bono(){
		return $this->anio_bono;
	}

	/**
	 * @return status_bono - smallint(1)
	 */
	public function getstatus_bono(){
		return $this->status_bono;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setconv_bono_cve($conv_bono_cve){
		$this->conv_bono_cve = $conv_bono_cve;
	}

	/**
	 * @param Type: varchar(100)
	 */
	public function setnom_bono($nom_bono){
		$this->nom_bono = $nom_bono;
	}

	/**
	 * @param Type: datetime
	 */
	public function setf_ini_carga_datos($f_ini_carga_datos){
		$this->f_ini_carga_datos = $f_ini_carga_datos;
	}

	/**
	 * @param Type: datetime
	 */
	public function setf_fin_carga_datos($f_fin_carga_datos){
		$this->f_fin_carga_datos = $f_fin_carga_datos;
	}

	/**
	 * @param Type: int(4)
	 */
	public function setmax_beneficiados($max_beneficiados){
		$this->max_beneficiados = $max_beneficiados;
	}

	/**
	 * @param Type: year(4)
	 */
	public function setanio_bono($anio_bono){
		$this->anio_bono = $anio_bono;
	}

	/**
	 * @param Type: smallint(1)
	 */
	public function setstatus_bono($status_bono){
		$this->status_bono = $status_bono;
	}

    /**
     * Close mysql connection
     */
	public function endbono_convocatoria_bono(){
		$this->connection->CloseMysql();
	}

}