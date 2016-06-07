<?php

/**
 * Archivo que contiene los textos del sistema
 * Contrucción del índice.
 * 	- Archivo fuente: interface_
 * 	- Modulo: login
 *  - Controlador: login
 *  - Identificador único del texto dentro del arreglo: texto_bienvenida
 * 		Ej:
 * 			$lang['interface_login']['login']['texto_bienvenida'] = 'Bienvenido al sistema SIPIMSS';
 * 			$lang['interface_login']['login']['texto_usuario'] = 'Usuario:';
 * 			$lang['interface_login']['login']['texto_contrasenia'] = 'Contraseña:';
 * 			$lang['interface_censo']['formacion']['texto_bienvenida'] = '...';
 * 			$lang['interface_censo']['actividad']['texto_bienvenida'] = '...';
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (http://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2015, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	http://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

//$lang['interface_'][''][''] = '';
//$lang['interface']['registro']['texto_bienvenida'] = 'Hola mundo';
$lang['interface'] = array(
    'registro' => array(
        'lbl_bienvenido' => 'Bienvenido',
        'lbl_formulario' => 'Registro de docentes al censo de profesores',
        'lbl_campos_obligatorios' => 'Campos obligatorios',
        'lbl_matricula' => 'Matrícula',
        'plh_matricula' => 'Introduzca su matrícula',
        'lbl_delegacion' => 'Delegación',
        'plh_delegacion' => 'Seleccione su delegación',
        'lbl_contrasenia' => 'Contraseña',
        'plh_contrasenia' => 'Introduzca una contraseña',
        'lbl_confirma_contrasenia' => 'Confirmar contraseña',
        'plh_confirma_contrasenia' => 'Confirme su contraseña',
        'lbl_correo' => 'Correo electrónico',
        'plh_correo' => 'Introduzca su correo electronico',
        'lbl_captcha' => 'Codigo de seguridad',
        'plh_captcha' => 'Escriba el texto de la imágen',
        'plh_btn_guardar' => 'Registrar'
    ),
    'login' => array(
        'lbl_formulario' => 'Iniciar sesión',
        'er_no_usuario' => 'No se encontró registro del usuario',
        'er_contrasenia_incorrecta' => 'La contraseña del usuario es incorrecta',
        'er_general' => 'Datos incorrectos'
    ),
    //perfil string values
    'perfil' => array(
        'lbl_titulo_seccion' => 'Mi perfil',
        'lbl_informacion_general' => 'Información general',
        'lbl_formacion' => 'Formación',
        'lbl_formacion_personal_salud' => 'Formación del personal de salud',
        'lbl_formacion_docente' => 'Formación docente',
        'lbl_becas_comisiones' => 'Becas y comisiones laborales',
        'lbl_actividad' => 'Actividad docente',
        'lbl_comisiones_academicas' => 'Comisiones academicas',
        'lbl_elaboracion_material' => 'Elaboración de material educativo',
        'lbl_informacion_general_informacion_personal' => 'Información personal',
        'lbl_informacion_general_apellido_paterno' => 'Apellido paterno',
        'plh_informacion_general_apellido_paterno' => 'Introduzca su apellido paterno',
        'lbl_informacion_general_apellido_materno' => 'Apellido materno',
        'plh_informacion_general_apellido_materno' => 'Introduzca su apellido materno',
        'lbl_informacion_general_nombre' => 'Nombre',
        'plh_informacion_general_nombre' => 'Introduzca su nombre',
        'lbl_informacion_general_edad' => 'Edad',
        'plh_informacion_general_edad' => 'Introduzca su edad',
        'lbl_informacion_general_genero' => 'Género',
        'plh_informacion_general_genero' => 'Seleccione su género',
        'lbl_informacion_general_estado_civil' => 'Estado civil',
        'plh_informacion_general_estado_civil' => 'Seleccione su estado civil',
        'lbl_informacion_general_telefono_particular' => 'Teléfono particular',
        'plh_informacion_general_telefono_particular' => 'Introduzca su teléfono particular',
        'lbl_informacion_general_telefono_laboral' => 'Teléfono laboral',
        'plh_informacion_general_telefono_laboral' => 'Introduzca su teléfono laboral',
        'lbl_informacion_general_correo_electronico' => 'Correo electrónico',
        'plh_informacion_general_correo_electronico' => 'Introduzca su correo electrónico',
        'lbl_informacion_general_empleos_actuales' => 'Número de empleos actuales fuera del IMSS',
        'plh_informacion_general_empleos_actuales' => 'Introduzca su número de empleos actuales fuera del IMSS',
        'btn_informacion_general_editar_nombre' => 'Editar nombre',
        'btn_informacion_general_guardar_informacion_personal' => 'Guardar información personal',        
        'lbl_informacion_general_informacion_imss' => 'Información IMSS',        
        'lbl_informacion_general_matricula' => 'Matrícula',
        'lbl_informacion_general_delegacion' => 'Delegación',
        'lbl_informacion_general_nombre_categoria' => 'Nombre de la categoría/Puesto',
        'lbl_informacion_general_clave_categoria' => 'Clave de la categoría/Puesto',
        'lbl_informacion_general_nombre_area_adscripcion' => 'Nombre del área de adscripción',
        'lbl_informacion_general_nombre_unidad_adscripcion' => 'Nombre de la unidad de adscripción',
        'lbl_informacion_general_nombre_clave_adscripcion' => 'Clave de adscripción',
        'lbl_informacion_general_antiguedad' => 'Antigüedad',
        'lbl_informacion_general_antiguedad_anios' => 'Años',
        'lbl_informacion_general_antiguedad_quincenas' => 'Quincenas',
        'lbl_informacion_general_antiguedad_dias' => 'Días',
        'lbl_informacion_general_tipo_contratacion' => 'Tipo de contratación',
        'lbl_informacion_general_estatus_empleado' => 'Estatus del empleado',
        'lbl_informacion_general_clave_presupuestal' => 'Clave presupuestal',
        'lbl_informacion_general_curp' => 'CURP',
    ),
);




//$lang['interface_registro_profesor'] = 'Impresión de texto prueba';
//$lang['interface_otro_mensaje'] = '&lsaquo; Primero';
