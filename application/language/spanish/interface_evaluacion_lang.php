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
$lang['interface_evaluacion'] = array(
    'convocatoria_evaluacion' => array(
        'buscador' => array(
            'titulo' => 'Administrar fechas de evaluación',
            'proxima_evaluacion' => 'Próxima evaluación:',
            'agregar_convocatoria' => 'Agregar fecha',
            'tab_head_fecha_fin_registro' => 'Fecha fin de registro docente',
            'tab_head_fecha_fin_validacion1' => 'Fin validación 1',
            'tab_head_fecha_fin_validacion2' => 'Fin validación 2',
            'tab_head_fecha_dictamen' => 'Dictamen',
            'tab_head_fecha_inconformidad' => 'Inconformidad',
            'titulo_agregar' => 'Agregar convocatoria',
            'eliminacion_imposible' => 'Imposible eliminar la convocatoria, tiene dictamen(es) asociado(s). Eliminelos primero.'
        ),
        'agregar' => array(
            'titulo_agregar' => 'Administrar convocatoria',
            'tab_head_fecha_fin_registro' => 'Fecha fin de registro docente',
            'tab_head_fecha_fin_validacion1' => 'Fecha fin validación 1',
            'tab_head_fecha_fin_validacion2' => 'Fecha fin validación 2',
        ),
        'model' => array(
            'insercion' => 'Se ha insertado correctamente la información.',
            'actualizacion' => 'Se ha actualizado correctamente la información.',
            'eliminacion' => 'Se ha eliminado correctamente.',
            'error' => 'Ocurrió un error, por favor intentelo de nuevo más tarde.',
        ),
        'buscador_dictamen' => array(
            'titulo_dictamen' => 'Administrar dictamen',
            'agregar_dictamen' => 'Agregar dictamen',
            'tab_head_fecha_inicia_evaluacion' => 'Fecha inicio de evaluación',
            'tab_head_fecha_fin_evaluacion' => 'Fecha final de evaluación',
            'tab_head_fecha_fin_inconformidad' => 'Fecha final de inconformidad',
        ),
        'general' => array(
            'acciones' => 'Acciones',
            'editar' => 'Editar',
            'eliminar' => 'Eliminar',
            'enviar' => 'Enviar',
            'cancelar' => 'Cancelar',
            'no_existe_datos' => 'No existen datos.',
            'confirmar_eliminacion' => 'Confirme que realmente desea eliminar los datos',
            'compare_date' => 'El campo %s debería ser menor o igual que el campo predecesor.',
        ),
    ),
    'evaluacion' => array(
        'docente' => array(
            'titulo' => 'Evaluación de carrera docente institucional',
        ),
        'model' => array(
            'insercion' => 'Se ha insertado correctamente la información.',
            'actualizacion' => 'Se ha actualizado correctamente la información.',
            'eliminacion' => 'Se ha eliminado correctamente.',
            'error' => 'Ocurrió un error, por favor intentelo de nuevo más tarde.',
        ),
    )
);
//$lang['interface_registro_profesor'] = 'Impresión de texto prueba';
//$lang['interface_otro_mensaje'] = '&lsaquo; Primero';
