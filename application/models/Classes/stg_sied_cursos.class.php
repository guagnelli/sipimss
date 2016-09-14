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

Class stg_sied_cursos {

	private $id_curso; //bigint(20)
	private $anio; //char(4)
	private $clave_curso; //varchar(255)
	private $nombre_curso; //varchar(255)
	private $fecha_inicio; //date
	private $fecha_fin; //date
	private $horas_curso; //int(11)
	private $tutorizado; //decimal(1,0)
	private $tipo_curso_id; //decimal(2,0)
	private $tipo_curso; //varchar(25)
	private $connection;

	public function stg_sied_cursos(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_stg_sied_cursos($anio,$clave_curso,$nombre_curso,$fecha_inicio,$fecha_fin,$horas_curso,$tutorizado,$tipo_curso_id,$tipo_curso){
		$this->anio = $anio;
		$this->clave_curso = $clave_curso;
		$this->nombre_curso = $nombre_curso;
		$this->fecha_inicio = $fecha_inicio;
		$this->fecha_fin = $fecha_fin;
		$this->horas_curso = $horas_curso;
		$this->tutorizado = $tutorizado;
		$this->tipo_curso_id = $tipo_curso_id;
		$this->tipo_curso = $tipo_curso;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from stg_sied_cursos where id_curso = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->id_curso = $row["id_curso"];
			$this->anio = $row["anio"];
			$this->clave_curso = $row["clave_curso"];
			$this->nombre_curso = $row["nombre_curso"];
			$this->fecha_inicio = $row["fecha_inicio"];
			$this->fecha_fin = $row["fecha_fin"];
			$this->horas_curso = $row["horas_curso"];
			$this->tutorizado = $row["tutorizado"];
			$this->tipo_curso_id = $row["tipo_curso_id"];
			$this->tipo_curso = $row["tipo_curso"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM stg_sied_cursos WHERE id_curso = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE stg_sied_cursos set anio = \"$this->anio\", clave_curso = \"$this->clave_curso\", nombre_curso = \"$this->nombre_curso\", fecha_inicio = \"$this->fecha_inicio\", fecha_fin = \"$this->fecha_fin\", horas_curso = \"$this->horas_curso\", tutorizado = \"$this->tutorizado\", tipo_curso_id = \"$this->tipo_curso_id\", tipo_curso = \"$this->tipo_curso\" where id_curso = \"$this->id_curso\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into stg_sied_cursos (anio, clave_curso, nombre_curso, fecha_inicio, fecha_fin, horas_curso, tutorizado, tipo_curso_id, tipo_curso) values (\"$this->anio\", \"$this->clave_curso\", \"$this->nombre_curso\", \"$this->fecha_inicio\", \"$this->fecha_fin\", \"$this->horas_curso\", \"$this->tutorizado\", \"$this->tipo_curso_id\", \"$this->tipo_curso\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT id_curso from stg_sied_cursos order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["id_curso"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return id_curso - bigint(20)
	 */
	public function getid_curso(){
		return $this->id_curso;
	}

	/**
	 * @return anio - char(4)
	 */
	public function getanio(){
		return $this->anio;
	}

	/**
	 * @return clave_curso - varchar(255)
	 */
	public function getclave_curso(){
		return $this->clave_curso;
	}

	/**
	 * @return nombre_curso - varchar(255)
	 */
	public function getnombre_curso(){
		return $this->nombre_curso;
	}

	/**
	 * @return fecha_inicio - date
	 */
	public function getfecha_inicio(){
		return $this->fecha_inicio;
	}

	/**
	 * @return fecha_fin - date
	 */
	public function getfecha_fin(){
		return $this->fecha_fin;
	}

	/**
	 * @return horas_curso - int(11)
	 */
	public function gethoras_curso(){
		return $this->horas_curso;
	}

	/**
	 * @return tutorizado - decimal(1,0)
	 */
	public function gettutorizado(){
		return $this->tutorizado;
	}

	/**
	 * @return tipo_curso_id - decimal(2,0)
	 */
	public function gettipo_curso_id(){
		return $this->tipo_curso_id;
	}

	/**
	 * @return tipo_curso - varchar(25)
	 */
	public function gettipo_curso(){
		return $this->tipo_curso;
	}

	/**
	 * @param Type: bigint(20)
	 */
	public function setid_curso($id_curso){
		$this->id_curso = $id_curso;
	}

	/**
	 * @param Type: char(4)
	 */
	public function setanio($anio){
		$this->anio = $anio;
	}

	/**
	 * @param Type: varchar(255)
	 */
	public function setclave_curso($clave_curso){
		$this->clave_curso = $clave_curso;
	}

	/**
	 * @param Type: varchar(255)
	 */
	public function setnombre_curso($nombre_curso){
		$this->nombre_curso = $nombre_curso;
	}

	/**
	 * @param Type: date
	 */
	public function setfecha_inicio($fecha_inicio){
		$this->fecha_inicio = $fecha_inicio;
	}

	/**
	 * @param Type: date
	 */
	public function setfecha_fin($fecha_fin){
		$this->fecha_fin = $fecha_fin;
	}

	/**
	 * @param Type: int(11)
	 */
	public function sethoras_curso($horas_curso){
		$this->horas_curso = $horas_curso;
	}

	/**
	 * @param Type: decimal(1,0)
	 */
	public function settutorizado($tutorizado){
		$this->tutorizado = $tutorizado;
	}

	/**
	 * @param Type: decimal(2,0)
	 */
	public function settipo_curso_id($tipo_curso_id){
		$this->tipo_curso_id = $tipo_curso_id;
	}

	/**
	 * @param Type: varchar(25)
	 */
	public function settipo_curso($tipo_curso){
		$this->tipo_curso = $tipo_curso;
	}

    /**
     * Close mysql connection
     */
	public function endstg_sied_cursos(){
		$this->connection->CloseMysql();
	}

}