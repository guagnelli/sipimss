<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Clase que gestiona el login
 * @version 	: 1.0.0
 * @autor 		: Mr. Guag
 * fecha: 29/09/2016
 */
class Expediente_model extends MY_Model {
	private   $config;
	protected $bloque_secciones;
	protected $seccion;
	protected $language;
	function __construct(){
		parent::__construct();
		$this->setArray();

	}
	/*$this->bloque = array(
			"orden"=>"",
			"fields_labels"=>array("curso"=>"","tipo_curso"=>""),
            "secciones"=>array()
		);*/
	function setArray(){
		//Formacion
		$this->config = array(
			Enum_sec::B_FORMACION =>array(
				//formacion en salud
				Enum_sec::S_FOR_PERSONAL_CONTINUA_SALUD=>array(
		            "acronimo"=>"fs",
		            "entidad"=>"emp_for_personal_continua_salud",
		            "fields"=>array(
	            		"lbl_".Enum_sec::S_FOR_PERSONAL_CONTINUA_SALUD."_nombre"=>"SUBTIP_NOMBRE",
	            		"lbl".Enum_sec::S_FOR_PERSONAL_CONTINUA_SALUD."_tipo_curso"=>"TIP_FORM_SALUD_NOMBRE"
	            	),
	            	"model"=>"Formacion_model",
		            "pk"=>"FPCS_CVE",
		            "functions"=>array(
		            	"get"=>"get_formacion_salud",
		            )
	        	),
	        	//formacion docente
				Enum_sec::S_FORMACION_PROFESIONAL=>array(
			        "acronimo"=>"fp",
			        "entidad"=>"emp_formacion_profesional",
			        "fields"=>array( 
			        	"lbl_".Enum_sec::S_FORMACION_PROFESIONAL."_nombre"=>"SUB_FOR_PRO_NOMBRE",
			        	"lbl_".Enum_sec::S_FORMACION_PROFESIONAL."_tipo"=>"TIP_FOR_PRO_NOMBRE"
			        ),
			        "pk"=>"EMP_FORMACION_PROFESIONAL_CVE",
			        "model"=>"Formacion_model",
			        "functions"=>array(
			        	"get"=>"get_formacion_docente",
			        )
			    ),
			),
			Enum_sec::B_ACTIVIDAD_DOCENTE=>array(
				Enum_sec::S_EDUCACION_DISTANCIA=>array(
					"acronimo"=>"ed",
			        "entidad"=>"",
			        "fields"=>array( 
			        	"lbl_".Enum_sec::S_EDUCACION_DISTANCIA."_nombre"=>"",
			        	"lbl_".Enum_sec::S_EDUCACION_DISTANCIA."_tipo"=>""
			        ),
			        "pk"=>"",
			        "model"=>"",
			        "functions"=>array(
			        	"get"=>"",
			        )
				),
				Enum_sec::S_ESP_MEDICA=>array(
					"acronimo"=>"",
			        "entidad"=>"",
			        "fields"=>array( 
			        	"lbl_".Enum_sec::S_ESP_MEDICA."_nombre"=>"",
			        	"lbl_".Enum_sec::S_ESP_MEDICA."_tipo"=>""
			        ),
			        "pk"=>"",
			        "model"=>"",
			        "functions"=>array(
			        	"get"=>"",
			        )
				),
				Enum_sec::S_ACTIVIDAD_DOCENTE=>array(
					"acronimo"=>"ad",
			        "entidad"=>"emp_actividad_docente",
			        "fields"=>array( 
			        	"lbl_".Enum_sec::S_ACTIVIDAD_DOCENTE."_nombre"=>"nom_curso",
			        	"lbl_".Enum_sec::S_ACTIVIDAD_DOCENTE."_tipo"=>"nombre_tp_actividad"
			        ),
			        "pk"=>"cve_actividad_docente",
			        "model"=>"Actividad_docente_model",
			        "functions"=>array(
			        	"get"=>"get_actividades_docente",
			        	"view"=>"carga_datos_actividad",
			        )
				),
			),
			Enum_sec::B_BECAS_COMISIONES_LABORALES=>array(
				Enum_sec::S_BECAS_LABORALES=>array(
					"acronimo"=>"cl",
			        "entidad"=>"emp_beca",
			        "fields"=>array( 
			        	"lbl_".Enum_sec::S_ACTIVIDAD_DOCENTE."_nombre"=>"nom_beca",
			        	"lbl_".Enum_sec::S_ACTIVIDAD_DOCENTE."_tipo"=>"nom_motivo_beca"
			        ),
			        "pk"=>"emp_beca_cve",
			        "model"=>"Becas_comisiones_laborales_model",
			        "functions"=>array(
			        	"get"=>"get_lista_becas",
			        	// "view"=>"carga_datos_editar_beca",
			        )
				),
				Enum_sec::S_COMISIONES_LABORALES=>array(
					"acronimo"=>"cl",
			        "entidad"=>"emp_beca",
			        "fields"=>array( 
			        	"lbl_".Enum_sec::S_COMISIONES_LABORALES."_nombre"=>"nom_beca",
			        	"lbl_".Enum_sec::S_COMISIONES_LABORALES."_tipo"=>"nom_motivo_beca"
			        ),
			        "pk"=>"emp_beca_cve",
			        "model"=>"Becas_comisiones_laborales_model",
			        "functions"=>array(
			        	"get"=>"get_lista_comisiones",
			        	// "view"=>"carga_datos_editar_beca",
			        )
				),
			),
			Enum_sec::B_COMISIONES_ACADEMICAS=>array(
				Enum_sec::S_COMISIONES_ACADEMICAS=>array(
					"acronimo"=>"ca",
			        "entidad"=>"emp_comision",
			        "fields"=>array( 
			        	"lbl_".Enum_sec::S_COMISIONES_ACADEMICAS."_nombre"=>"COM_ARE_NOMBRE",
			        	"lbl_".Enum_sec::S_COMISIONES_ACADEMICAS."_tipo"=>"TIP_COM_NOMBRE"
			        ),
			        "pk"=>"EMP_COMISION_CVE",
			        "model"=>"Comision_academica_model",
			        "functions"=>array(
			        	"get"=>"get_comision_academica",
			        	//"ver_datos"=>"comision_academica_detalle",
			        )
				),
			),
			Enum_sec::B_INVESTIGACION_EDUCATIVA=>array(
				Enum_sec::S_DESA_INV_SALUD=>array(
					"acronimo"=>"is",
			        "entidad"=>"emp_desa_inv_salud",
			        "fields"=>array( 
			        	"lbl_".Enum_sec::S_DESA_INV_SALUD."_nombre"=>"nombre_investigacion",
			        	"lbl_".Enum_sec::S_DESA_INV_SALUD."_tipo"=>"tpad_nombre"
			        ),
			        "pk"=>"cve_investigacion",
			        "model"=>"Investigacion_docente_model",
			        "functions"=>array(
			        	"get"=>"get_lista_datos_investigacion_docente",
			        	//"ver_datos"=>"carga_datos_investigacion"
			        )
				),
			),
			Enum_sec::B_DIRECCION_TESIS=>array(
				Enum_sec::S_DIRECCION_TESIS=>array(
					"acronimo"=>"dt",
			        "entidad"=>"emp_comision",
			        "fields"=>array( 
			        	"lbl_".Enum_sec::S_DIRECCION_TESIS."_nombre"=>"NIV_ACA_NOMBRE",
			        	"lbl_".Enum_sec::S_DIRECCION_TESIS."_tipo"=>"COM_ARE_NOMBRE"
			        ),
			        "pk"=>"EMP_COMISION_CVE",
			        "model"=>"Direccion_tesis_model",
			        "functions"=>array(
			        	"get"=>"get_lista_datos_direccion_tesis",
			        	// "view"=>"direccion_tesis_detalle"
			        )
				),
			),
			Enum_sec::B_MATERIAL_EDUCATIVO=>array(
				Enum_sec::S_MATERIA_EDUCATIVO=>array(
					"acronimo"=>"me",
			        "entidad"=>"emp_materia_educativo",
			        "fields"=>array( 
			        	"lbl_".Enum_sec::S_MATERIA_EDUCATIVO."_nombre"=>"nombre_material",
			        	"lbl_".Enum_sec::S_MATERIA_EDUCATIVO."_tipo"=>"opt_tipo_material"
			        ),
			        "pk"=>"emp_material_educativo_cve",
			        "model"=>"Material_educativo_model",
			        "functions"=>array(
			        	"get"=>"get_lista_material_educativo",
			        	//"view"=>"carga_datos_editar_material_educativo"
			        )
				),
			),
		);
	}
	/**
     * Clase que gestiona el login
     * @version     : 1.2.2
     * @autor       : Mr. Guag
     * @date: 26/09/2016
     * @attributes: 
     *              $empleado_cve: Id del empleado
     *              $validado: si es nulo ignora la condición; si es TRUE busca todos los registros validados, 
     *                          si es FALSE busca todos los registros sin validación.
     *              $where: debe ir con el formato array("campo"=>valor)
     * @returns: Mixed array()
     * @comments: Usa el archivo de configuración con el arreglo asosiativo
     *               $config["get_secciones"]
     *               @acronimo : clave diminutiva para identificar el curso
     *               @entidad : Nombre de la entidad en la base de datos
     *               @curso : Nombre del curso o campo de donde se optiene el nombre del curso
     *               @tipo_curso: Tipo de curso 
     *               @pk : Llave primaria de la entidad en base de datos
     *               @model : nombre del modelo 
     *               @function : nombre de la funcion que regresa los datos de la sección
     */
    function getAll($empleado_cve = null, $validado = null, $where = null) {
        if (is_null($empleado_cve)) {
            throw new Exception('Id de usuario nulo');
        }

        //información del profesor
        $params = array("conditions"=>array("empleado_cve"=>$empleado_cve));

        $this->load->model("Empleado_model", "emp");
        $data["empleado"] = $this->emp->getEmpECD($params);

        if (!is_null($validado)) {
            if (is_bool($validado)) {
                $parametros["conditions"]["IS_VALIDO_PROFESIONALIZACION"]=$validado;
            } else {
                throw new Exception('La función espera un valor booleano');
            }
        }
        
        $this->lang->load('interface', 'spanish');

        //Etiquetas
        $data["string_value"] = $this->lang->line('interface_secd') + $this->lang->line('interface')["secciones"];
        // $data["cfg_actividad"] = $this->config->item("get_secciones");
        //$secciones = $this->config->item("secciones_model");
        $data["cfg_actividad"] = $this->config;
        //pr($bloque_seccion);
        foreach($data["cfg_actividad"] as $b_key=>$secciones){
        	foreach($secciones as $key => $seccion) {
        		// echo $b_key."--".$key;
        		// pr($seccion);
	            $params["conditions"] = (isset($where[$key]) && !is_null($where[$key])) ? 	array_merge($params["conditions"], $where[$key]) : $params["conditions"];
	            
	            if($seccion["model"]!=""){
	            	$this->load->model($seccion["model"], $seccion["acronimo"]);
		            $res = $this->{$seccion["acronimo"]}->$seccion["functions"]["get"]($params);
		            //unset($seccion["model"]);
		            //unset($seccion["functions"]);
		            if (!empty($res)) {
	    	                $data["bloques"]["bloque_".$b_key]["seccion_".$key] = $res;
	    	                $data["bloques"]["labels"][$seccion["acronimo"]] = "lbl_" . $seccion["acronimo"] . "_titulo";
		            }
	            }
	        }
	    }
        return $data;
    }

    function setFunctions($bloque=null,$seccion=null,$funcs = array()){
		if(is_null($bloque) && is_null($seccion)){
			foreach ($this->config as $b_key => $bloque) {
				foreach ($bloque as $key => $seccion) {
					$this->config[$b_key][$key] = $funcs;
				}		
			}
		}
		elseif(is_null($bloque) && !is_null($seccion)){
			foreach ($this->config as $b_key => $bloque) {
				$this->config[$b_key][$seccion] = $funcs;
			}
		}elseif(!is_null($bloque) && is_null($seccion)){
			foreach ($this->config[$bloque] as $key => $seccion) {
				$this->config[$bloque][$key] = $funcs;
			}
		}
		else{
			$this->config[$bloque][$seccion] = $funcs;
		}
    	
    }

    function setCampos($bloque=null,$seccion=null,$campos = array()){
    	if(is_null($bloque) && is_null($seccion)){
			foreach ($this->config as $b_key => $bloque) {
				foreach ($bloque as $key => $seccion) {
					$this->config[$b_key][$key] = $campos;
				}		
			}
		}
		elseif(is_null($bloque) && !is_null($seccion)){
			foreach ($this->config as $b_key => $bloque) {
				$this->config[$b_key][$seccion] = $campos;
			}
		}elseif(!is_null($bloque) && is_null($seccion)){
			foreach ($this->config[$bloque] as $key => $seccion) {
				$this->config[$bloque][$key] = $campos;
			}
		}
		else{
			$this->config[$bloque][$seccion] = $campos;
		}
    }

}
?>