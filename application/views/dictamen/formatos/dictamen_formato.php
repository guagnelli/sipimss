<?php 	defined('BASEPATH') OR exit('No direct script access allowed');	?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <style type="text/css">
            *,*:before,*:after {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            }
            html {
              margin: 0;
            }
            body {
              font-family: "Arial", serif;
              font-size: 7px;
              margin: 10mm 12mm 10mm 12mm;
            }
            .texto-titulo{
                font-size: 1.2em;
            }
            .texto-negrita{
                font-weight: 900;
            }
            .texto-chico{
                font-size: 0.8em;
            }
            .td-texto-centrado{
                text-align: center;
            }
            hr {
              page-break-after: always;
              border: 1;
              margin: 0;
              padding: 0;
            }
            .border-top{
                border-top: 0.5px solid #c0c0c0;
            }
            .border-bottom{
                border-bottom: 0.5px solid #c0c0c0 !important;
            }
            .table_fath {
                border-collapse: collapse;
                border: 0.5px solid #c0c0c0;
                }

            .table {
                border-collapse: collapse;
                border: 0.5px solid #c0c0c0;
                }
            .table th, .table td {
                border: 0.5px solid #c0c0c0;
            }
            
            .header,
            .footer {
                width: 100%;
                position: fixed;
            }
            .header {
                top: 0px;
            }
            .footer {
                bottom: 0px;
            }
            .pagenum:before {
                content: counter(page);
            }

        </style>
    </head>
    <body>              
        <table width="100%" class="table_fath" style="margin-bottom: 5px;">
            <tr id="fila_encabezado">
              <td>
                  <img style="width: 40%" src="<?= base_url() ?>assets/img/logo_imssprintv1.jpg">
              </td>
            </tr>
        </table>
        <table width="100%" class="table_fath" style="margin-bottom: 5px;">
            <tr>
                <td  class="td-texto-centrado texto-negrita">
                    <p style="margin: 0 ">INSTITUTO MEXICANO DEL SEGURO SOCIAL</p>
                    <!--<p style="margin: 0 ">DIRECCIÓN DE PRESTACIONES MÉDICAS</p>-->
                    <p style="margin: 0 ">DIRECCIÓN DE PRESTACIONES MÉDICAS</p>
                    <p style="margin: 0 ">UNIDAD DE EDUCACIÓN, INVESTIGACIÓN Y POLÍTICAS DE SALUD</p>
                    <p style="margin: 0 ">COORDINACIÓ DE EDUCACIÓN EN SALUD</p>
                </td>
            </tr>
            <tr>
                <td class="td-texto-centrado texto-negrita border-top" >
                    Dictamen de evaluación curricular docente
                </td>                
            </tr>
        </table>
        <table width="100%" id="tabla_padre" class="table_fath">
            
            
            <tr id="fila_cuerpo">
              <td>
                <table width="100%" id="tabla_dictamen">
                  <tr id="datos_personales">
                    <td>
                      <table width="100%" id="tabla_datos_personal">
                        <tr>
                          <td>Nombre: </td>
                          <td>No. de Expediente: </td>
                        </tr>
                        <tr>
                          <td>Fecha de evaluación: </td>
                          <td>Delegación: </td>
                        </tr>
                        <tr>
                          <td>Adscripción: </td>
                          <td></td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                  <tr id="datos_formacion">
                    <td class="border-bottom">1. FORMACIÓN DOCENTE. 
                        <br><br>
                    </td>
                  </tr>
                  <tr id="actividad_docente">
                    <td>2. ACTIVIDADES DOCENTES.
                        <br><span>Número de años de actividad ininterrumpida dentro del IMSS:</span>
                        <table width="100%" class="table" id="tabla_actividad" style="border-bottom: 0px solid white !important;">
                            <tr style="text-align:center">
                                <td rowspan="2">Modalidad</td>
                              <td colspan="2">Número de cursos</td>
                              <td rowspan="2">Puntos</td>
                            </tr>
                            <tr style="text-align:center">
                              <td>Hasta un semestre</td>
                              <td>Hasta un año</td>
                            </tr>
                            <tr>
                              <td>Formación</td>
                              <td></td>
                              <td></td>
                              <td></td>
                            </tr>
                            <tr>
                              <td>Educación continua</td>
                              <td></td>
                              <td></td>
                              <td></td>
                            </tr>
                            <tr style="border: 0 solid white !important;">
                                <td colspan="4" style="border: 0 solid white; border-bottom: 0 solid white;">
                                    <table style="float: right; width: 100%; border-width: 0px">
                                        <tr>
                                            <td style="border-width: 0px; text-align: right;">SUBTOTAL: </td>
                                            <td style="border-width: 0px; text-align: center
                                                ; border-bottom: 0.5px solid #c0c0c0">  </td> <!-- subtotal -->
                                        </tr>
                                    </table>
                                </td>
                            </tr >
                        </table >
                        <!--<div style="text-align:right" id="subtotal">SUBTOTAL <small>__________________</small></div>-->
                    </td>
                  </tr>
                  <tr id="direccion_tesis">
                    <td>3. DIRECCIÓN DE TESIS.
                        <table width="100%" class="table" id="tabla_actividad">                        
                            <tr>
                              <td>Nivel</td>
                              <td>Técnico</td>
                              <td>Licenciatura</td>
                              <td>Especialidad</td>
                              <td>Maestría</td>
                              <td>Doctorado</td>
                            </tr>
                            <tr>
                              <td>Número</td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                            </tr>
                            <tr style="border: 0 solid white !important;">
                                <td colspan="6" style="border: 0 solid white; border-bottom: 0 solid white;">
                                    <table style="float: right; width: 100%; border-width: 0px">
                                        <tr>
                                            <td style="border-width: 0px; text-align: right;">SUBTOTAL: </td>
                                            <td style="border-width: 0px; text-align: center
                                                ; border-bottom: 0.5px solid #c0c0c0">  </td> <!-- subtotal -->
                                        </tr>
                                    </table>
                                </td>
                            </tr >
                        </table>
                        <!--<div style="text-align:right" id="subtotal">SUBTOTAL <small>__________________</small></div>-->
                    </td>
                  </tr>
                  <tr id="actividad_investigacion_educa">
                    <td>4. ACTIVIDADES DE INVESTIGACIÓN EDUCATIVA.
                        <table width="100%" class="table" id="tabla_actividad">
                            <tr style="text-align:center">
                              <td rowspan="2">Tipo</td>
                              <td rowspan="2">Instrumentos de evaluación</td>
                              <td rowspan="2">Presentaciones en foros</td>
                              <td colspan="2" width="40%">Artículos</td>
                              <td rowspan="2">Capítulos de libros</td>
                              <td rowspan="2">Libros completos</td>
                            </tr>
                            <tr style="text-align:center">
                              <td>Hasta un semestre</td>
                              <td>Hasta un año</td>
                            </tr>
                            <tr>
                              <td>Número</td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                            </tr>
                            <tr style="border: 0 solid white !important;">
                                <td colspan="7" style="border: 0 solid white; border-bottom: 0 solid white;">
                                    <table style="float: right; width: 100%; border-width: 0px">
                                        <tr>
                                            <td style="border-width: 0px; text-align: right;">SUBTOTAL: </td>
                                            <td style="border-width: 0px; text-align: center
                                                ; border-bottom: 0.5px solid #c0c0c0">  </td> <!-- subtotal -->
                                        </tr>
                                    </table>
                                </td>
                            </tr >
                        </table>
                        <!--<div style="text-align:right" id="subtotal">SUBTOTAL <small>__________________</small></div>-->
                    </td>
                  </tr>
                  <tr id="elab_material_educa">
                    <td>5. ELABORACIÓN DE MATERIAL EDUCATIVO.
                        <table width="100%" class="table" id="tabla_actividad">                        
                            <tr>
                              <td>Tipo</td>
                              <td>Antologías o manuales educativos</td>
                              <td>Digitales</td>
                              <td>Puntos</td>
                            </tr>
                            <tr>
                              <td>Número</td>
                              <td></td>
                              <td></td>
                              <td></td>
                            </tr>
                            <tr style="border: 0 solid white !important;">
                                <td colspan="4" style="border: 0 solid white; border-bottom: 0 solid white;">
                                    <table style="float: right; width: 100%; border-width: 0px">
                                        <tr>
                                            <td style="border-width: 0px; text-align: right;">SUBTOTAL: </td>
                                            <td style="border-width: 0px; text-align: center
                                                ; border-bottom: 0.5px solid #c0c0c0">  </td> <!-- subtotal -->
                                        </tr>
                                    </table>
                                </td>
                            </tr >
                        </table>
                        <!--<div style="text-align:right" id="subtotal">SUBTOTAL <small>__________________</small></div>-->
                    </td>
                  </tr>
                  <tr id="comisiones">
                    <td>6. COMISIONES.
<!--                        <p>
                            Número (por periodos anuales): <small>______________________________</small>          
                            <span style="text-align:right" id="subtotal">SUBTOTAL <small>__________________</small></span><br>
                            <div style="text-align:right" id="subtotal"> <strong>PUNTOS TOTALES:</strong> <small>__________________</small></div>
                        </p>                        -->
                        <table>
                            <tr>
                                <td>
                                    
                                </td>
                                <td>
                                    
                                </td>
                                <td>
                                    
                                </td>
                                <td>
                                    
                                </td>
                            </tr>
                        </table>
                    </td>
                  </tr>
                  <tr id="dictamen">
                    <td class="border-bottom">                        
                        <strong>DICTAMEN:</strong>
                        <br>
                        <span>Observaciones: <small>______________________________________________________________</small></span>
                        <br>
                    </td>
                  </tr>
                  <tr id="titulo_academico">
                    <td style="text-align:center">
                        <strong>GRUPO ACADÉMICO PARA LA EVALUACIÓN CURRICULAR DOCENTE</strong>
                    </td>
                  </tr>
                  <tr id="firma_vocales_1">
                    <td>
                      <table width="100%" id="firma_vocal_1">
                        <tr>
                          <td class="border-bottom">&nbsp;</td>
                          <td style="width:20px">&nbsp;</td>
                          <td class="border-bottom">&nbsp;</td>
                        </tr>
                        <tr style="text-align:center">
                          <td>Vocal Dr.</td>
                          <td style="width:20px"></td>
                          <td>Vocal Dr.</td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                  <tr id="firma_vocales_2">
                    <td> 
                      <table width="100%" id="firma_vocal_2">
                        <tr>
                          <td class="border-bottom">&nbsp;</td>
                          <td style="width:20px">&nbsp;</td>
                          <td class="border-bottom">&nbsp;</td>
                        </tr>
                        <tr style="text-align:center">
                          <td>Vocal Dr.</td>
                          <td style="width:20px"></td>
                          <td>Secretaria Dra.</td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                  <tr id="firma_presidente" style="text-align:center">
                    <td>
                      <table width="100%" style="text-align:center" id="firma_presi">
                        <tr>
                          <td><small>______________________________________________</small></td>
                        </tr>
                        <tr>
                          <td>Presidente Dr.</td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
        </table>
        <!--
        <br><br>
        <div class="row">
        	<div class="jumbotron"><div class="container"> <p class="text_center">No se encontraron datos registrados con esta busqueda</p> </div></div>
        </div>-->
        
    </body>
</html>

