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

Class cdepartamento {

	private $departamento_cve; //char(10)
	private $cve_unidad_atencion; //int(11)
	private $des_unidad_atencion; //varchar(80)
	private $ind_medica; //smallint(6)
	private $cve_organo_control; //char(2)
	private $nom_organo_control; //varchar(80)
	private $cve_departamento; //char(4)
	private $nom_normativa; //varchar(60)
	private $nom_dependencia; //varchar(200)
	private $ref_ubicacion; //varchar(200)
	private $cve_delegacion; //char(2)
	private $nom_delegacion; //varchar(30)
	private $cve_depto_adscripcion_padre; //char(10)
	private $dep_nombre; //varchar(50)
	private $cve_nivel_atencion; //smallint(6)
	private $des_nivel_atencion; //varchar(20)
	private $ind_imss_oport; //smallint(6)
	private $ind_umae; //smallint(6)
	private $id_tipo_adscripcion; //int(11)
	private $dpt_rama; //longtext
	private $presupuestal_cve; //varchar(20)
	private $pre_nombre; //varchar(50)
	private $IS_UNIDAD_VALIDACION; //tinyint(1)
	private $connection;

	public function cdepartamento(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_cdepartamento($cve_unidad_atencion,$des_unidad_atencion,$ind_medica,$cve_organo_control,$nom_organo_control,$cve_departamento,$nom_normativa,$nom_dependencia,$ref_ubicacion,$cve_delegacion,$nom_delegacion,$cve_depto_adscripcion_padre,$dep_nombre,$cve_nivel_atencion,$des_nivel_atencion,$ind_imss_oport,$ind_umae,$id_tipo_adscripcion,$dpt_rama,$presupuestal_cve,$pre_nombre,$IS_UNIDAD_VALIDACION){
		$this->cve_unidad_atencion = $cve_unidad_atencion;
		$this->des_unidad_atencion = $des_unidad_atencion;
		$this->ind_medica = $ind_medica;
		$this->cve_organo_control = $cve_organo_control;
		$this->nom_organo_control = $nom_organo_control;
		$this->cve_departamento = $cve_departamento;
		$this->nom_normativa = $nom_normativa;
		$this->nom_dependencia = $nom_dependencia;
		$this->ref_ubicacion = $ref_ubicacion;
		$this->cve_delegacion = $cve_delegacion;
		$this->nom_delegacion = $nom_delegacion;
		$this->cve_depto_adscripcion_padre = $cve_depto_adscripcion_padre;
		$this->dep_nombre = $dep_nombre;
		$this->cve_nivel_atencion = $cve_nivel_atencion;
		$this->des_nivel_atencion = $des_nivel_atencion;
		$this->ind_imss_oport = $ind_imss_oport;
		$this->ind_umae = $ind_umae;
		$this->id_tipo_adscripcion = $id_tipo_adscripcion;
		$this->dpt_rama = $dpt_rama;
		$this->presupuestal_cve = $presupuestal_cve;
		$this->pre_nombre = $pre_nombre;
		$this->IS_UNIDAD_VALIDACION = $IS_UNIDAD_VALIDACION;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from cdepartamento where departamento_cve = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->departamento_cve = $row["departamento_cve"];
			$this->cve_unidad_atencion = $row["cve_unidad_atencion"];
			$this->des_unidad_atencion = $row["des_unidad_atencion"];
			$this->ind_medica = $row["ind_medica"];
			$this->cve_organo_control = $row["cve_organo_control"];
			$this->nom_organo_control = $row["nom_organo_control"];
			$this->cve_departamento = $row["cve_departamento"];
			$this->nom_normativa = $row["nom_normativa"];
			$this->nom_dependencia = $row["nom_dependencia"];
			$this->ref_ubicacion = $row["ref_ubicacion"];
			$this->cve_delegacion = $row["cve_delegacion"];
			$this->nom_delegacion = $row["nom_delegacion"];
			$this->cve_depto_adscripcion_padre = $row["cve_depto_adscripcion_padre"];
			$this->dep_nombre = $row["dep_nombre"];
			$this->cve_nivel_atencion = $row["cve_nivel_atencion"];
			$this->des_nivel_atencion = $row["des_nivel_atencion"];
			$this->ind_imss_oport = $row["ind_imss_oport"];
			$this->ind_umae = $row["ind_umae"];
			$this->id_tipo_adscripcion = $row["id_tipo_adscripcion"];
			$this->dpt_rama = $row["dpt_rama"];
			$this->presupuestal_cve = $row["presupuestal_cve"];
			$this->pre_nombre = $row["pre_nombre"];
			$this->IS_UNIDAD_VALIDACION = $row["IS_UNIDAD_VALIDACION"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM cdepartamento WHERE departamento_cve = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE cdepartamento set cve_unidad_atencion = \"$this->cve_unidad_atencion\", des_unidad_atencion = \"$this->des_unidad_atencion\", ind_medica = \"$this->ind_medica\", cve_organo_control = \"$this->cve_organo_control\", nom_organo_control = \"$this->nom_organo_control\", cve_departamento = \"$this->cve_departamento\", nom_normativa = \"$this->nom_normativa\", nom_dependencia = \"$this->nom_dependencia\", ref_ubicacion = \"$this->ref_ubicacion\", cve_delegacion = \"$this->cve_delegacion\", nom_delegacion = \"$this->nom_delegacion\", cve_depto_adscripcion_padre = \"$this->cve_depto_adscripcion_padre\", dep_nombre = \"$this->dep_nombre\", cve_nivel_atencion = \"$this->cve_nivel_atencion\", des_nivel_atencion = \"$this->des_nivel_atencion\", ind_imss_oport = \"$this->ind_imss_oport\", ind_umae = \"$this->ind_umae\", id_tipo_adscripcion = \"$this->id_tipo_adscripcion\", dpt_rama = \"$this->dpt_rama\", presupuestal_cve = \"$this->presupuestal_cve\", pre_nombre = \"$this->pre_nombre\", IS_UNIDAD_VALIDACION = \"$this->IS_UNIDAD_VALIDACION\" where departamento_cve = \"$this->departamento_cve\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into cdepartamento (cve_unidad_atencion, des_unidad_atencion, ind_medica, cve_organo_control, nom_organo_control, cve_departamento, nom_normativa, nom_dependencia, ref_ubicacion, cve_delegacion, nom_delegacion, cve_depto_adscripcion_padre, dep_nombre, cve_nivel_atencion, des_nivel_atencion, ind_imss_oport, ind_umae, id_tipo_adscripcion, dpt_rama, presupuestal_cve, pre_nombre, IS_UNIDAD_VALIDACION) values (\"$this->cve_unidad_atencion\", \"$this->des_unidad_atencion\", \"$this->ind_medica\", \"$this->cve_organo_control\", \"$this->nom_organo_control\", \"$this->cve_departamento\", \"$this->nom_normativa\", \"$this->nom_dependencia\", \"$this->ref_ubicacion\", \"$this->cve_delegacion\", \"$this->nom_delegacion\", \"$this->cve_depto_adscripcion_padre\", \"$this->dep_nombre\", \"$this->cve_nivel_atencion\", \"$this->des_nivel_atencion\", \"$this->ind_imss_oport\", \"$this->ind_umae\", \"$this->id_tipo_adscripcion\", \"$this->dpt_rama\", \"$this->presupuestal_cve\", \"$this->pre_nombre\", \"$this->IS_UNIDAD_VALIDACION\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT departamento_cve from cdepartamento order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["departamento_cve"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return departamento_cve - char(10)
	 */
	public function getdepartamento_cve(){
		return $this->departamento_cve;
	}

	/**
	 * @return cve_unidad_atencion - int(11)
	 */
	public function getcve_unidad_atencion(){
		return $this->cve_unidad_atencion;
	}

	/**
	 * @return des_unidad_atencion - varchar(80)
	 */
	public function getdes_unidad_atencion(){
		return $this->des_unidad_atencion;
	}

	/**
	 * @return ind_medica - smallint(6)
	 */
	public function getind_medica(){
		return $this->ind_medica;
	}

	/**
	 * @return cve_organo_control - char(2)
	 */
	public function getcve_organo_control(){
		return $this->cve_organo_control;
	}

	/**
	 * @return nom_organo_control - varchar(80)
	 */
	public function getnom_organo_control(){
		return $this->nom_organo_control;
	}

	/**
	 * @return cve_departamento - char(4)
	 */
	public function getcve_departamento(){
		return $this->cve_departamento;
	}

	/**
	 * @return nom_normativa - varchar(60)
	 */
	public function getnom_normativa(){
		return $this->nom_normativa;
	}

	/**
	 * @return nom_dependencia - varchar(200)
	 */
	public function getnom_dependencia(){
		return $this->nom_dependencia;
	}

	/**
	 * @return ref_ubicacion - varchar(200)
	 */
	public function getref_ubicacion(){
		return $this->ref_ubicacion;
	}

	/**
	 * @return cve_delegacion - char(2)
	 */
	public function getcve_delegacion(){
		return $this->cve_delegacion;
	}

	/**
	 * @return nom_delegacion - varchar(30)
	 */
	public function getnom_delegacion(){
		return $this->nom_delegacion;
	}

	/**
	 * @return cve_depto_adscripcion_padre - char(10)
	 */
	public function getcve_depto_adscripcion_padre(){
		return $this->cve_depto_adscripcion_padre;
	}

	/**
	 * @return dep_nombre - varchar(50)
	 */
	public function getdep_nombre(){
		return $this->dep_nombre;
	}

	/**
	 * @return cve_nivel_atencion - smallint(6)
	 */
	public function getcve_nivel_atencion(){
		return $this->cve_nivel_atencion;
	}

	/**
	 * @return des_nivel_atencion - varchar(20)
	 */
	public function getdes_nivel_atencion(){
		return $this->des_nivel_atencion;
	}

	/**
	 * @return ind_imss_oport - smallint(6)
	 */
	public function getind_imss_oport(){
		return $this->ind_imss_oport;
	}

	/**
	 * @return ind_umae - smallint(6)
	 */
	public function getind_umae(){
		return $this->ind_umae;
	}

	/**
	 * @return id_tipo_adscripcion - int(11)
	 */
	public function getid_tipo_adscripcion(){
		return $this->id_tipo_adscripcion;
	}

	/**
	 * @return dpt_rama - longtext
	 */
	public function getdpt_rama(){
		return $this->dpt_rama;
	}

	/**
	 * @return presupuestal_cve - varchar(20)
	 */
	public function getpresupuestal_cve(){
		return $this->presupuestal_cve;
	}

	/**
	 * @return pre_nombre - varchar(50)
	 */
	public function getpre_nombre(){
		return $this->pre_nombre;
	}

	/**
	 * @return IS_UNIDAD_VALIDACION - tinyint(1)
	 */
	public function getIS_UNIDAD_VALIDACION(){
		return $this->IS_UNIDAD_VALIDACION;
	}

	/**
	 * @param Type: char(10)
	 */
	public function setdepartamento_cve($departamento_cve){
		$this->departamento_cve = $departamento_cve;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setcve_unidad_atencion($cve_unidad_atencion){
		$this->cve_unidad_atencion = $cve_unidad_atencion;
	}

	/**
	 * @param Type: varchar(80)
	 */
	public function setdes_unidad_atencion($des_unidad_atencion){
		$this->des_unidad_atencion = $des_unidad_atencion;
	}

	/**
	 * @param Type: smallint(6)
	 */
	public function setind_medica($ind_medica){
		$this->ind_medica = $ind_medica;
	}

	/**
	 * @param Type: char(2)
	 */
	public function setcve_organo_control($cve_organo_control){
		$this->cve_organo_control = $cve_organo_control;
	}

	/**
	 * @param Type: varchar(80)
	 */
	public function setnom_organo_control($nom_organo_control){
		$this->nom_organo_control = $nom_organo_control;
	}

	/**
	 * @param Type: char(4)
	 */
	public function setcve_departamento($cve_departamento){
		$this->cve_departamento = $cve_departamento;
	}

	/**
	 * @param Type: varchar(60)
	 */
	public function setnom_normativa($nom_normativa){
		$this->nom_normativa = $nom_normativa;
	}

	/**
	 * @param Type: varchar(200)
	 */
	public function setnom_dependencia($nom_dependencia){
		$this->nom_dependencia = $nom_dependencia;
	}

	/**
	 * @param Type: varchar(200)
	 */
	public function setref_ubicacion($ref_ubicacion){
		$this->ref_ubicacion = $ref_ubicacion;
	}

	/**
	 * @param Type: char(2)
	 */
	public function setcve_delegacion($cve_delegacion){
		$this->cve_delegacion = $cve_delegacion;
	}

	/**
	 * @param Type: varchar(30)
	 */
	public function setnom_delegacion($nom_delegacion){
		$this->nom_delegacion = $nom_delegacion;
	}

	/**
	 * @param Type: char(10)
	 */
	public function setcve_depto_adscripcion_padre($cve_depto_adscripcion_padre){
		$this->cve_depto_adscripcion_padre = $cve_depto_adscripcion_padre;
	}

	/**
	 * @param Type: varchar(50)
	 */
	public function setdep_nombre($dep_nombre){
		$this->dep_nombre = $dep_nombre;
	}

	/**
	 * @param Type: smallint(6)
	 */
	public function setcve_nivel_atencion($cve_nivel_atencion){
		$this->cve_nivel_atencion = $cve_nivel_atencion;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setdes_nivel_atencion($des_nivel_atencion){
		$this->des_nivel_atencion = $des_nivel_atencion;
	}

	/**
	 * @param Type: smallint(6)
	 */
	public function setind_imss_oport($ind_imss_oport){
		$this->ind_imss_oport = $ind_imss_oport;
	}

	/**
	 * @param Type: smallint(6)
	 */
	public function setind_umae($ind_umae){
		$this->ind_umae = $ind_umae;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setid_tipo_adscripcion($id_tipo_adscripcion){
		$this->id_tipo_adscripcion = $id_tipo_adscripcion;
	}

	/**
	 * @param Type: longtext
	 */
	public function setdpt_rama($dpt_rama){
		$this->dpt_rama = $dpt_rama;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setpresupuestal_cve($presupuestal_cve){
		$this->presupuestal_cve = $presupuestal_cve;
	}

	/**
	 * @param Type: varchar(50)
	 */
	public function setpre_nombre($pre_nombre){
		$this->pre_nombre = $pre_nombre;
	}

	/**
	 * @param Type: tinyint(1)
	 */
	public function setIS_UNIDAD_VALIDACION($IS_UNIDAD_VALIDACION){
		$this->IS_UNIDAD_VALIDACION = $IS_UNIDAD_VALIDACION;
	}

    /**
     * Close mysql connection
     */
	public function endcdepartamento(){
		$this->connection->CloseMysql();
	}

}