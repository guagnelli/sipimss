--Modificaciones 10 de agosto de 2016

alter table comprobante add column com_extension varchar(5);

ALTER TABLE `sipimss.`empleado` 
DROP FOREIGN KEY `empleado_ibfk_7`;
ALTER TABLE `sipimss`.`empleado` 
ADD CONSTRAINT `fk_empleaod_usuario`
  FOREIGN KEY (`USUARIO_CVE`)
  REFERENCES `sipimss`.`usuario` (`USUARIO_CVE`)
  ON DELETE SET NULL
  ON UPDATE CASCADE;


alter table empleado 
    add column emp_is_actual numeric(1),
    add column emp_fch_ingreso date,
    add column emp_fch_creacion timestamp,
    add column emp_fch_nac date,
    modify emp_matricula varchar(25);
    
alter table usuario 
    add constraint uq_matricula
    UNIQUE(usu_matricula),
    add constraint uq_matricula_mail
    UNIQUE(usu_matricula,usu_correo);
    
alter table usuario
    drop foreign key usuario_ibfk_3,
    drop foreign key usuario_ibfk_5,
    drop foreign key usuario_ibfk_6,
    drop foreign key usuario_ibfk_7,
    drop foreign key usuario_ibfk_9;

alter table usuario drop column categoria_cve;
alter table usuario drop column adscripcion_cve;
alter table usuario drop column tip_contratacion_cve;
alter table usuario drop column presupuestal_adscripcion_cve;
alter table usuario drop column edo_laboral_cve;
alter table usuario drop column rol_desempenia_cve;
alter table usuario drop column usu_genero;
alter table usuario drop column usu_tel_laboral;
alter table usuario drop column usu_correo_alternativo;
alter table usuario drop column cestado_civil_cve;
alter table usuario drop column delegacion_cve;
alter table usuario drop column usu_antiguedad;

alter table ctipo_material
    add column "TIP_MAT_OPCION" varchar(25);
    
    
    
/* finn de modificaciones ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

/* ********************modificaciónes 05/08/2016  HORA DE INSERSION A LAS SIGUIENTES ENTIADES  **************************************/
ALTER TABLE `emp_actividad_docente` ADD FECHA_INSERSION TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL AFTER `TIP_FOR_PROF_CVE`;  /*Campo agregado a la tabla "emp_actividad_docente" */
ALTER TABLE `emp_materia_educativo` ADD FECHA_INSERSION TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL AFTER `MATERIA_EDUCATIVO_CVE`;
ALTER TABLE `emp_act_inv_edu` ADD FECHA_INSERSION TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL AFTER `TIP_ACT_DOC_CVE`;
ALTER TABLE `emp_for_personal_continua_salud` ADD FECHA_INSERSION TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL AFTER `TIP_FORM_SALUD_CVE`;
ALTER TABLE `emp_formacion_profesional` ADD FECHA_INSERSION TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL AFTER `EFO_ANIO_CURSO`;
ALTER TABLE `emp_beca` ADD FECHA_INSERSION TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL AFTER `BECA_INTERRIMPIDA_CVE`;
ALTER TABLE `emp_comision` ADD FECHA_INSERSION TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL AFTER `EC_FCH_FIN`;
ALTER TABLE `emp_educacion_distancia` ADD FECHA_INSERSION TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL AFTER `ACT_DOC_GRAL_CVE`;
ALTER TABLE `emp_esp_medica` ADD FECHA_INSERSION TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL AFTER `TIP_ACT_DOC_CVE`;
ALTER TABLE `emp_ciclos_clinicos` ADD FECHA_INSERSION TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL AFTER `ECC_FCH_FIN`;
ALTER TABLE `actividad_docente_gral` ADD FECHA_INSERSION TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL AFTER `TIP_ACT_DOC_PRINCIPAL_CVE`;
/* finn de modificaciones ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,


/* ********************modificaciónes 06/08/2016   **************************************/
ALTER TABLE comprobante MODIFY COLUMN COM_NOMBRE varchar(250) NULL;    /* CAMBIA EL TAMAÑO O LONGITUD DE 20 TO 250*/
/* finn de modificaciones ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

/* ********************modificaciónes 08/08/2016   **************************************/
ALTER TABLE `ctipo_comision` ADD `IS_COMISION_ACADEMICA` INT(10)  DEFAULT 1 NOT NULL AFTER `TIP_COM_NOMBRE`;   /* Agrega campo que identifique si es una comisión academica o laboral*/

/* finn de modificaciones ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

/* ********************modificaciónes 09/08/2016   **************************************/
ALTER TABLE `emp_materia_educativo` ADD NOMBRE_MATERIAL_EDUCATIVO varchar(100) NOT NULL AFTER `EMPLEADO_CVE`;
ALTER TABLE `ctipo_material` DROP TIP_MAT_TIPO;  /*Elimina tipo de material, por que debe ser un campo tipo intdex int(11)*/
/*Agrega campo para hacer una recursividad*/
ALTER TABLE ctipo_material ADD TIP_MAT_TIPO INT(11) NULL AFTER `TIP_MAT_NOMBRE`;
CREATE INDEX XIF15CTIP_MATERIAL ON ctipo_material (TIP_MAT_TIPO);  /* Se vuelve index el campo */
ALTER TABLE `ctipo_material` ADD CONSTRAINT `ctipo_material_padre_ctmfk`   /* Asigna llave foranía*/
FOREIGN KEY (`TIP_MAT_TIPO`) REFERENCES `ctipo_material`(`TIP_MATERIAL_CVE`) ON DELETE RESTRICT ON UPDATE RESTRICT;

/* finn de modificaciones ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

/* ********************modificació®¥³ 11/08/2016   **************************************/
ALTER TABLE `comprobante` ADD FECHA_INSERSION TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL AFTER `com_extension`;
ALTER TABLE csubtipo_formacion_profesional MODIFY COLUMN SUB_FOR_PRO_NOMBRE varchar(50) NULL;
ALTER TABLE csubtipo_formacion_salud MODIFY COLUMN SUBTIP_NOMBRE varchar(50) NULL;

/* Agrega relacion "ctipo_formacion_profesional" a la tabla "csubtipo_formacion_profesional" */   
ALTER TABLE `csubtipo_formacion_profesional` ADD `TIP_FOR_PROF_CVE` INT(11) NULL AFTER `SUB_FOR_PRO_NOMBRE`;  /*Campo agregado a la tabla "csubtipo_formacion_profesional"*/
CREATE INDEX XIF10SUBTIPO_FORMACION_PROFESIONAL ON csubtipo_formacion_profesional (TIP_FOR_PROF_CVE);  /* Se vuelve index el campo */
ALTER TABLE `csubtipo_formacion_profesional` ADD CONSTRAINT `csubtipo_formacion_profesional_cdfpfk`   /* Asigna llave foranî¡ª*/
FOREIGN KEY (`TIP_FOR_PROF_CVE`) REFERENCES `ctipo_formacion_profesional`(`TIP_FOR_PROF_CVE`) ON DELETE RESTRICT ON UPDATE RESTRICT;


/* eLIMINA CONSTRAIN "ctipo_formacion_profesional" CON "csubtipo_formacion_profesional"*/
ALTER TABLE `ctipo_formacion_profesional` DROP FOREIGN KEY `ctipo_formacion_profesional_ibfk_1`; 
ALTER TABLE `ctipo_formacion_profesional` DROP `SUB_FOR_PRO_CVE`; 

ALTER TABLE emp_comision MODIFY COLUMN EC_ANIO int(11) NULL; 

/* finn de modificaciones ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

/* ********************modificació®¥³ 11/08/2016   **************************************/
/* Agrega relacion "ctipo_curso" a la tabla "emp_comision" */   
ALTER TABLE `emp_comision` ADD `TIP_CURSO_CVE` INT(11) NULL AFTER `FECHA_INSERSION`;  /*Campo agregado a la tabla "emp_comision"*/
CREATE INDEX XIF6EMP_COMISION ON emp_comision (TIP_CURSO_CVE);  /* Se vuelve index el campo */
ALTER TABLE `emp_comision` ADD CONSTRAINT `emp_comision_ibfk_6`   /* Asigna llave foranî¡ª*/
FOREIGN KEY (`TIP_CURSO_CVE`) REFERENCES `ctipo_curso`(`TIP_CURSO_CVE`) ON DELETE RESTRICT ON UPDATE RESTRICT;

/* Agrega relacion "ctipo_curso" a la tabla "ccurso" */    
ALTER TABLE `emp_comision` ADD `CURSO_CVE` INT(11) NULL AFTER `TIP_CURSO_CVE`;  /*Campo agregado a la tabla "emp_comision"*/
CREATE INDEX XIF7EMP_COMISION ON emp_comision (CURSO_CVE);  /* Se vuelve index el campo */
ALTER TABLE `emp_comision` ADD CONSTRAINT `emp_comision_ibfk_7`   /* Asigna llave foranî¡ª*/
FOREIGN KEY (`CURSO_CVE`) REFERENCES `ccurso`(`CURSO_CVE`) ON DELETE RESTRICT ON UPDATE RESTRICT;
/* finn de modificaciones ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

/* ********************modificaci 13/08/2016   **************************************/
ALTER TABLE sipimss.ctipo_material MODIFY COLUMN TIP_MAT_OPCION varchar(30) NULL; /*Cambio en tamano de tipo de dato 20 to 50 6-16-2016  */
/* finn de modificaciones ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

/* ********************modificaci 14/08/2016   **************************************/
ALTER TABLE sipimss.csubtipo_formacion_salud MODIFY COLUMN SUBTIP_NOMBRE varchar(100) NULL;  /*Cabio de longitud de 50 to 100*/

ALTER TABLE `emp_for_personal_continua_salud` DROP FOREIGN KEY `emp_for_personal_continua_salud_ibfk_3`; 
ALTER TABLE emp_for_personal_continua_salud DROP TIP_FORM_SALUD_CVE;

ALTER TABLE `emp_for_personal_continua_salud` ADD `CSUBTIP_FORM_SALUD_CVE` INT(11) NULL AFTER `FECHA_INSERSION`;  /*Campo agregado a la tabla "emp_comision"*/
CREATE INDEX XIF10EMP_FOR_PERSONAL_CONTINUA_SALUD ON emp_for_personal_continua_salud (CSUBTIP_FORM_SALUD_CVE);  /* Se vuelve index el campo */
ALTER TABLE `emp_for_personal_continua_salud` ADD CONSTRAINT `emp_for_personal_continua_salud_efcsfk_10`   /* Asigna llave foranî¡ª*/
FOREIGN KEY (`CSUBTIP_FORM_SALUD_CVE`) REFERENCES `csubtipo_formacion_salud`(`CSUBTIP_FORM_SALUD_CVE`) ON DELETE RESTRICT ON UPDATE RESTRICT;
/*Cambios efectuados por jesusu DÃ­as, ajuste de campos en entidad "emp_for_personal_continua_salud"*/
ALTER TABLE `emp_for_personal_continua_salud` CHANGE `EFPCS_FCH_FIN` `EFPCS_FCH_FIN` DATE NULL DEFAULT NULL, CHANGE `EFPCS_FOR_INICIAL` `EFPCS_FOR_INICIAL` BOOLEAN NULL DEFAULT NULL;
ALTER TABLE `emp_for_personal_continua_salud` DROP `EFPCS_ANIO`, DROP `EFPCS_DURACION`;
/* finn de modificaciones ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

/* ********************modificaci 15/08/2016   ****************************************/
ALTER TABLE sipimss_20160815.emp_for_personal_continua_salud MODIFY COLUMN CSUBTIP_FORM_SALUD_CVE int(11) NULL;  /*Modifica para que se a null la llave*/

ALTER TABLE `emp_for_personal_continua_salud` ADD `TIP_FORM_SALUD_CVE` INT(11) NULL AFTER `CSUBTIP_FORM_SALUD_CVE`;  /*Campo agregado a la tabla "emp_comision"*/
CREATE INDEX XIF11EMP_FOR_PERSONAL_CONTINUA_SALUD ON emp_for_personal_continua_salud (TIP_FORM_SALUD_CVE);  /* Se vuelve index el campo */
ALTER TABLE `emp_for_personal_continua_salud` ADD CONSTRAINT `emp_for_personal_continua_salud_efcsfk_11`   /* Asigna llave foranî¡ª*/
FOREIGN KEY (`TIP_FORM_SALUD_CVE`) REFERENCES `ctipo_formacion_salud`(`TIP_FORM_SALUD_CVE`) ON DELETE RESTRICT ON UPDATE RESTRICT;

/* finn de modificaciones ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

/* ********************modificaci 16/08/2016   ****************************************/
/*Agraga nueva entidad */
CREATE TABLE `rform_prof_tematica` (
  `RFORM_PROF_TEMATICA_CVE` int(11) NOT NULL AUTO_INCREMENT,
  `TEMATICA_CVE` int(11) DEFAULT NULL,
  `EMP_FORMACION_PROFESIONAL_CVE` int(10) DEFAULT NULL,
  PRIMARY KEY (`RFORM_PROF_TEMATICA_CVE`),
  UNIQUE KEY `XPKRFORM_PROF_TEMATICA_CVE` (`RFORM_PROF_TEMATICA_CVE`),
  KEY `XIF14EMP_FORMACION_PROFESIONAL_CVE` (`EMP_FORMACION_PROFESIONAL_CVE`),
  KEY `XIF10TEMATICA_CVE` (`TEMATICA_CVE`),
  CONSTRAINT `emp_formacion_profesional_efpfrk` FOREIGN KEY (`EMP_FORMACION_PROFESIONAL_CVE`) REFERENCES `emp_formacion_profesional` (`EMP_FORMACION_PROFESIONAL_CVE`),
  CONSTRAINT `ctematica_ctmrfk` FOREIGN KEY (`TEMATICA_CVE`) REFERENCES `ctematica` (`TEMATICA_CVE`),
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
/* Elimina relaciÃ³n entre "ctematica" y "emp_formacion_profesional"*/
ALTER TABLE `emp_formacion_profesional` DROP FOREIGN KEY `emp_formacion_profesional_ibfk_1`;
ALTER TABLE `emp_formacion_profesional` DROP TEMATICA_CVE;
/* Agrega a la entidad "emplead" la relacion con "cejercicio_profesional;"*/
ALTER TABLE `empleado` ADD `emp_eje_pro_cve` INT(11) NULL AFTER `delegacion_cve`;  /*Campo agregado a la tabla "emp_comision"*/
CREATE INDEX XIF12_EMPLEADO ON empleado (emp_eje_pro_cve);  /* Se vuelve index el campo */
ALTER TABLE `empleado` ADD CONSTRAINT `cejercicio_profesional_cjpfk_12`   /* Asigna llave foranî¡ª*/
FOREIGN KEY (`emp_eje_pro_cve`) REFERENCES `cejercicio_profesional`(`eje_pro_cve`) ON DELETE RESTRICT ON UPDATE RESTRICT;

/* finn de modificaciones ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

/* ********************modificaci 17/08/2016   ****************************************/
ALTER TABLE `emp_educacion_distancia` DROP FOREIGN KEY `emp_educacion_distancia_ibfk_4`; /* Rompe la llave foranea*/
ALTER TABLE emp_educacion_distancia MODIFY COLUMN CURSO_CVE varchar(50) NOT NULL;
ALTER TABLE emp_educacion_distancia DROP CURSO_CVE;
ALTER TABLE `emp_formacion_profesional` ADD `CLAVE_CURSO` varchar(50) NOT NULL AFTER `COMPROBANTE_CVE`

ALTER TABLE `emp_formacion_profesional` ADD `SUB_FOR_PRO_CVE` INT(11) NULL AFTER `FECHA_INSERSION`;  /*Campo agregado a la tabla "emp_comision"*/
CREATE INDEX XIF11EMP_FORMACION_PROFESIONAL ON emp_formacion_profesional (SUB_FOR_PRO_CVE);  /* Se vuelve index el campo */
ALTER TABLE `emp_formacion_profesional` ADD CONSTRAINT `emp_formacion_profesional_csfpfk_15`   /* Asigna llave foranî¡ª*/
FOREIGN KEY (`SUB_FOR_PRO_CVE`) REFERENCES `csubtipo_formacion_profesional`(`SUB_FOR_PRO_CVE`) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `emp_educacion_distancia` ADD `IS_CURSO_TUTURIZADO` BOOLEAN NOT NULL AFTER `FECHA_INSERSION`;
/* finn de modificaciones ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

/* *
ALTER TABLE `emp_esp_medica` CHANGE COLUMN `EMP_ESP_MEDICA_CVE` `EMP_ESP_MEDICA_CVE` INT(10) NULL;  /* cambia nombre a columna 
ALTER TABLE `emp_esp_medica` CHANGE `EMP_ESP_MEDICA_CVE` `EMP_ESP_MEDICA_CVE` INT(10) NULL;
*/

call bitacora_ejecuta_historico(272, 'NULL', '11.32.41.86', '/sipimss_censo/index.php/registro', 
NULL, '{"usuario":{"insert":272},"empleado":{"insert":9}}', '272,9', '{"usuario":{"USU_MATRICULA":"311091476","DELEGACION_CVE":"09","USU_CORREO":"leyhlani@gmail.com","USU_CONTRASENIA":"3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2","USU_NOMBRE":"LEYLANI","USU_PATERNO":"GARCIA","USU_MATERNO":"BA&UELOS","USU_GENERO":"F","USU_CURP":"GABL800219MDFRXY08","ADSCRIPCION_CVE":"09NC012520","CATEGORIA_CVE":"35312180","ESTADO_USUARIO_CVE":1,"USU_FCH_REGISTRO":"04\/05\/2015"},"empleado":{"EMP_NOMBRE":"LEYLANI","EMP_APE_PATERNO":"GARCIA","EMP_APE_MATERNO":"BA&UELOS","EMP_MATRICULA":"311091476","EMP_CURP":"GABL800219MDFRXY08","DELEGACION_CVE":"09","USUARIO_CVE":272,"ADSCRIPCION_CVE":"09NC012520","EMP_GENERO":"F","EMP_EMAIL":"leyhlani@gmail.com"}}', @res );

{"usuario":{"USU_MATRICULA":"311091476","DELEGACION_CVE":"09","USU_CORREO":"leylanyh@gmail.com","USU_CONTRASENIA":"3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2","USU_NOMBRE":"LEYLANI","USU_PATERNO":"GARCIA","USU_MATERNO":"BA&UELOS","USU_GENERO":"F","USU_CURP":"GABL800219MDFRXY08","ADSCRIPCION_CVE":"09NC012520","CATEGORIA_CVE":"35312180","ESTADO_USUARIO_CVE":1,"USU_FCH_REGISTRO":"04/05/2015"},"empleado":{"USUARIO_CVE":276,"EMP_MATRICULA":"311091476"}}

------------------------------17_08_206----------------------------------
/* ********************modificaciónes 04/08/2016 **************************************/
	/* Crear la tabla de tipo de unidad medica, es decir, UMAE, DEIS, CAME*/
CREATE TABLE sipimss.ctipo_unidad_adscripcion (
TIPO_UNIDAD_ADSCRIPCION_CVE INT NOT null AUTO_INCREMENT,
DESCRIPCION_TIPO_UNIDAD VARCHAR(30) NOT NULL,
CONSTRAINT `PRIMARY` PRIMARY KEY (TIPO_UNIDAD_ADSCRIPCION_CVE)
);
CREATE UNIQUE INDEX XPKCTIPO_UNIDAD_ADSCRIPCION ON sipimss.ctipo_unidad_adscripcion (TIPO_UNIDAD_ADSCRIPCION_CVE);

ALTER TABLE `cunidad` DROP `UNI_DESC`; /* ELIMINA CAMPO, no se ocupa */

/* Agrega relacion con tipoo de unidad UMAE, DEIS ***/
ALTER TABLE `cunidad` ADD `TIPO_UNIDAD_ADSCRIPCION_CVE` INT(11) NULL AFTER `DELEGACION_CVE`;  /*Campo agregado a la tabla "cunidad" */
CREATE INDEX XIF3CUNIDAD_ADS ON cunidad (TIPO_UNIDAD_ADSCRIPCION_CVE);  /* Se vuelve index el campo */
ALTER TABLE `cunidad` ADD CONSTRAINT `cunidad_cufk`   /* Asigna llave foranía*/
FOREIGN KEY (`TIPO_UNIDAD_ADSCRIPCION_CVE`) REFERENCES `ctipo_unidad_adscripcion`(`TIPO_UNIDAD_ADSCRIPCION_CVE`) ON DELETE RESTRICT ON UPDATE RESTRICT;

----------------------------17-08-2016-----------------------
CREATE TABLE EMP_ORGANICO AS
SELECT EMP_MATRICULA, CATEGORIA_CVE,ADSCRIPCION_CVE,DELEGACION_CVE,PRESUPUESTAL_ADSCRIPCION_CVE,TIP_CONTRATACION_CVE,EDO_LABORAL_CVE,
EMP_EMAIL,EMP_TEL_LABORAL,EMP_TEL_PARTICULAR,CESTADO_CIVIL_CVE,
EMP_IS_ACTUAL AS EMP_ACTUAL
FROM EMPLEADO;

alter table empleado 
    add constraint uq_empleado_matricula
    unique(emp_matricula);

CREATE TABLE EMP_ORGANICO (
  EMP_ORGANICO_CVE INTEGER NOT NULL,
  EMP_MATRICULA varchar(25) CHARACTER SET utf8 DEFAULT NULL,
  CATEGORIA_CVE int(11) DEFAULT NULL,
  ADSCRIPCION_CVE varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  DELEGACION_CVE char(2) CHARACTER SET utf8 DEFAULT NULL,
  PRESUPUESTAL_ADSCRIPCION_CVE varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  TIP_CONTRATACION_CVE int(11) DEFAULT NULL,
  EDO_LABORAL_CVE int(11) DEFAULT NULL,
  EMP_EMAIL varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  EMP_TEL_LABORAL int(11) DEFAULT NULL,
  EMP_TEL_PARTICULAR int(11) DEFAULT NULL,
  CESTADO_CIVIL_CVE int(11) DEFAULT NULL,
  FCH_REGISTRO DATETIME DEFAULT NOW(), 
  FCH_CAMBIO DATETIME NULL,
  EMP_ACTUAL decimal(1,0) DEFAULT NULL,
    CONSTRAINT FK_EMP_ORGANICO_EMPLEADO
        FOREIGN KEY(EMP_MATRICULA)
        REFERENCES EMPLEADO(emp_matricula),
    CONSTRAINT PK_EMP_ORGANICO
    PRIMARY KEY(EMP_ORGANICO_CVE)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE EMP_BECA
ADD COLUMN IS_LOADED NUMERIC(1) DEFAULT 0 COMMENT 'EL REGISTRO SE CARGÓ POR SISTEMA O POR USUARIO 0->NO, 1->SI';

ALTER TABLE EMP_ACT_INV_EDU
ADD COLUMN IS_LOADED NUMERIC(1) DEFAULT 0 COMMENT 'EL REGISTRO SE CARGÓ POR SISTEMA O POR USUARIO 0->NO, 1->SI';

ALTER TABLE EMP_FORMACION_PROFESIONAL
ADD COLUMN IS_LOADED NUMERIC(1) DEFAULT 0 COMMENT 'EL REGISTRO SE CARGÓ POR SISTEMA O POR USUARIO 0->NO, 1->SI';

ALTER TABLE EMP_EDUCACION_DISTANCIA
ADD COLUMN IS_LOADED NUMERIC(1) DEFAULT 0 COMMENT 'EL REGISTRO SE CARGÓ POR SISTEMA O POR USUARIO 0->NO, 1->SI';

--------------19/08/2016--------------
ALTER TABLE conv_periodo_horas
DROP FOREIGN key `conv_periodo_horas_ibfk_4`;

ALTER TABLE evaluacion_curso_for_profesonal
DROP FOREIGN key `evaluacion_curso_for_profesonal_ibfk_2`;

ALTER TABLE hist_efp_validacion_curso
DROP FOREIGN KEY hist_efp_validacion_curso_ibfk_1;

ALTER TABLE sipimss_20160815.rform_prof_tematica
DROP FOREIGN KEY emp_formacion_profesional_efpfrk; 


ALTER TABLE sipimss_20160815.emp_formacion_profesional 
MODIFY COLUMN EMP_FORMACION_PROFESIONAL_CVE int NOT NULL AUTO_INCREMENT;

ALTER TABLE conv_periodo_horas ADD
CONSTRAINT `conv_periodo_horas_ibfk_4` 
FOREIGN KEY (`EMP_FORMACION_PROFESIONAL_CVE`) 
REFERENCES `emp_formacion_profesional` (`EMP_FORMACION_PROFESIONAL_CVE`);

ALTER TABLE evaluacion_curso_for_profesonal ADD
CONSTRAINT `evaluacion_curso_for_profesonal_ibfk_2` 
FOREIGN KEY (`EMP_FORMACION_PROFESIONAaL_CVE`) 
REFERENCES `emp_formacion_profesional` (`EMP_FORMACION_PROFESIONAL_CVE`);

ALTER TABLE hist_efp_validacion_curso ADD
  CONSTRAINT `hist_efp_validacion_curso_ibfk_1` 
  FOREIGN KEY (`EMP_FORMACION_PROFESIONAL_CVE`) 
  REFERENCES `emp_formacion_profesional` (`EMP_FORMACION_PROFESIONAL_CVE`);
  
ALTER TABLE sipimss_20160815.rform_prof_tematica ADD
CONSTRAINT `emp_formacion_profesional_efpfrk` 
FOREIGN KEY (`EMP_FORMACION_PROFESIONAL_CVE`) 
REFERENCES `emp_formacion_profesional` (`EMP_FORMACION_PROFESIONAL_CVE`);

/* Elimina relación entre "ctematica" y "emp_formacion_profesional"*/
ALTER TABLE `emp_formacion_profesional` DROP FOREIGN KEY `emp_formacion_profesional_ibfk_1`;
ALTER TABLE `emp_formacion_profesional` DROP TEMATICA_CVE;
/* Agrega a la entidad "emplead" la relacion con "cejercicio_profesional;"*/
ALTER TABLE `empleado` ADD `emp_eje_pro_cve` INT(11) NULL AFTER `delegacion_cve`;  /*Campo agregado a la tabla "emp_comision"*/
CREATE INDEX XIF12_EMPLEADO ON empleado (emp_eje_pro_cve);  /* Se vuelve index el campo */
ALTER TABLE `empleado` ADD CONSTRAINT `cejercicio_profesional_cjpfk_12`   /* Asigna llave foran*/
FOREIGN KEY (`emp_eje_pro_cve`) REFERENCES `cejercicio_profesional`(`eje_pro_cve`) ON DELETE RESTRICT ON UPDATE RESTRICT;


--------------23/08/2016----LEAS----------
CREATE TABLE `validacion_gral` (
  `VALIDACION_GRAL_CVE` int(11) NULL AUTO_INCREMENT,
  `VAL_CONV_CVE` int(11) DEFAULT NULL,
  `EMPLEADO_CVE` int(10) DEFAULT NULL,
  PRIMARY KEY (`VALIDACION_GRAL_CVE`),
  UNIQUE KEY `XPKRVALIDACION_GRAL_CVE` (`VALIDACION_GRAL_CVE`),
  KEY `XIF011VAL_CONV_CVE` (`VAL_CONV_CVE`),
  KEY `XIF012EMPLEADO_CVE` (`EMPLEADO_CVE`),
  CONSTRAINT `validacion_convocatoria_rvgrfk` FOREIGN KEY (`VAL_CONV_CVE`) REFERENCES `validacion_convocatoria` (`VAL_CON_CVE`),
  CONSTRAINT `empleado_rvgrfk` FOREIGN KEY (`EMPLEADO_CVE`) REFERENCES `empleado` (`EMPLEADO_CVE`),
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
/*Elimina la relacion "validacion_convocatoria" con "hist_validacion" */
ALTER TABLE hist_validacion DROP FOREIGN KEY hist_validacion_ibfk_1;
ALTER TABLE hist_validacion DROP VAL_CON_CVE;

/*Elimina la relacion "empleado" con "hist_validacion" */
ALTER TABLE hist_validacion DROP FOREIGN KEY hist_validacion_ibfk_4;
ALTER TABLE hist_validacion DROP EMPLEADO_CVE;

ALTER TABLE `hist_validacion` ADD `VALIDACION_GRAL_CVE` INT(11) NOT NULL AFTER `EMPLEADO_CVE`;  /*Campo agregado a la tabla "hist_validacion"*/
CREATE INDEX XIF012_HIST_VALIDACION ON hist_validacion (VALIDACION_GRAL_CVE);  /* Se vuelve index el campo */
ALTER TABLE `hist_validacion` ADD CONSTRAINT `validacion_gral_rhvfk_012`   /* Asigna llave foranea*/
FOREIGN KEY (`VALIDACION_GRAL_CVE`) REFERENCES `validacion_gral`(`VALIDACION_GRAL_CVE`) ON DELETE RESTRICT ON UPDATE RESTRICT;

/*Campos agregaos a las entidades "hist" de validación*/
ALTER TABLE `hist_beca_validacion_curso` ADD `IS_VALIDO_PROFESIONALIZACION` boolean NOT NULL default 0;
ALTER TABLE `hist_comision_validacion_curso` ADD `IS_VALIDO_PROFESIONALIZACION` boolean NOT NULL default 0;
ALTER TABLE `hist_eaid_validacion_curso` ADD `IS_VALIDO_PROFESIONALIZACION` boolean NOT NULL default 0;
ALTER TABLE `hist_ecc_validacion_curso` ADD `IS_VALIDO_PROFESIONALIZACION` boolean NOT NULL default 0;
ALTER TABLE `hist_edd_validacion_curso` ADD `IS_VALIDO_PROFESIONALIZACION` boolean NOT NULL default 0;
ALTER TABLE `hist_edis_validacion_curso` ADD `IS_VALIDO_PROFESIONALIZACION` boolean NOT NULL default 0;
ALTER TABLE `hist_eem_validacion_curso` ADD `IS_VALIDO_PROFESIONALIZACION` boolean NOT NULL default 0;
ALTER TABLE `hist_efp_validacion_curso` ADD `IS_VALIDO_PROFESIONALIZACION` boolean NOT NULL default 0;
ALTER TABLE `hist_efpd_validacion_curso` ADD `IS_VALIDO_PROFESIONALIZACION` boolean NOT NULL default 0;
ALTER TABLE `hist_fpcs_validacion_curso` ADD `IS_VALIDO_PROFESIONALIZACION` boolean NOT NULL default 0;
ALTER TABLE `hist_me_validacion_curso` ADD `IS_VALIDO_PROFESIONALIZACION` boolean NOT NULL default 0;

ALTER TABLE `hist_beca_validacion_curso` DROP `IS_VALIDO_PROFESIONALIZACION` ;
ALTER TABLE `hist_comision_validacion_curso` DROP `IS_VALIDO_PROFESIONALIZACION` ;
ALTER TABLE `hist_eaid_validacion_curso` DROP `IS_VALIDO_PROFESIONALIZACION` ;
ALTER TABLE `hist_ecc_validacion_curso` DROP `IS_VALIDO_PROFESIONALIZACION` ;
ALTER TABLE `hist_edd_validacion_curso` DROP `IS_VALIDO_PROFESIONALIZACION` ;
ALTER TABLE `hist_edis_validacion_curso` DROP `IS_VALIDO_PROFESIONALIZACION` ;
ALTER TABLE `hist_eem_validacion_curso` DROP `IS_VALIDO_PROFESIONALIZACION` ;
ALTER TABLE `hist_efp_validacion_curso` DROP `IS_VALIDO_PROFESIONALIZACION` ;
ALTER TABLE `hist_efpd_validacion_curso` DROP `IS_VALIDO_PROFESIONALIZACION` ;
ALTER TABLE `hist_fpcs_validacion_curso` DROP `IS_VALIDO_PROFESIONALIZACION` ;
ALTER TABLE `hist_me_validacion_curso` DROP `IS_VALIDO_PROFESIONALIZACION` ;

ALTER TABLE `emp_beca` ADD `IS_VALIDO_PROFESIONALIZACION` boolean NOT NULL default 0;
ALTER TABLE `emp_comision` ADD `IS_VALIDO_PROFESIONALIZACION` boolean NOT NULL default 0;
ALTER TABLE `emp_act_inv_edu` ADD `IS_VALIDO_PROFESIONALIZACION` boolean NOT NULL default 0;
ALTER TABLE `emp_ciclos_clinicos` ADD `IS_VALIDO_PROFESIONALIZACION` boolean NOT NULL default 0;
ALTER TABLE `emp_educacion_distancia` ADD `IS_VALIDO_PROFESIONALIZACION` boolean NOT NULL default 0;
ALTER TABLE `emp_desa_inv_salud` ADD `IS_VALIDO_PROFESIONALIZACION` boolean NOT NULL default 0;
ALTER TABLE `emp_esp_medica` ADD `IS_VALIDO_PROFESIONALIZACION` boolean NOT NULL default 0;
ALTER TABLE `emp_formacion_profesional` ADD `IS_VALIDO_PROFESIONALIZACION` boolean NOT NULL default 0;
ALTER TABLE `emp_actividad_docente` ADD `IS_VALIDO_PROFESIONALIZACION` boolean NOT NULL default 0;
ALTER TABLE `emp_for_personal_continua_salud` ADD `IS_VALIDO_PROFESIONALIZACION` boolean NOT NULL default 0;
ALTER TABLE `emp_materia_educativo` ADD `IS_VALIDO_PROFESIONALIZACION` boolean NOT NULL default 0;

ALTER TABLE `hist_validacion` ADD `IS_ACTUAL` boolean NOT NULL default 1;
ALTER TABLE `cdepartamento` ADD `IS_UNIDAD_VALIDACION` boolean NOT NULL default 0;





/*TIPO DE UNIDAD DE VALIDACION (No llevada a cabo)ºº¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡ **/
CREATE TABLE `ctipo_unidad_validacion` (
  `TIPO_UNIDAD_VALIDACION_CVE` int(11) NULL AUTO_INCREMENT,
  `TP_UNIDAD_NOMBRE` VARCHAR(30) DEFAULT NULL,
  PRIMARY KEY (`TIPO_UNIDAD_VALIDACION_CVE`)
  ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

/*----------------2016/08/25------------------------*/
ALTER TABLE hist_beca_validacion_curso MODIFY COLUMN VAL_CUR_FCH TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL ;
ALTER TABLE hist_comision_validacion_curso MODIFY COLUMN VAL_CUR_FCH TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL ;
ALTER TABLE hist_eaid_validacion_curso MODIFY COLUMN VAL_CUR_FCH TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL ;
ALTER TABLE hist_ecc_validacion_curso MODIFY COLUMN VAL_CUR_FCH TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL ;
ALTER TABLE hist_edd_validacion_curso MODIFY COLUMN VAL_CUR_FCH TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL ;
ALTER TABLE hist_edis_validacion_curso MODIFY COLUMN VAL_CUR_FCH TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL ;
ALTER TABLE hist_eem_validacion_curso MODIFY COLUMN VAL_CUR_FCH TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL ;
ALTER TABLE hist_efp_validacion_curso MODIFY COLUMN VAL_CUR_FCH TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL ;
ALTER TABLE hist_efpd_validacion_curso MODIFY COLUMN VAL_CUR_FCH TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL;
ALTER TABLE hist_fpcs_validacion_curso MODIFY COLUMN VAL_CUR_FCH TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL ;
ALTER TABLE hist_me_validacion_curso MODIFY COLUMN VAL_CUR_FCH TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL ;


/*----------------2016/08/29------------------------*/
ALTER TABLE sipimss_pdos.modulo MODIFY COLUMN IS_CONTROLADOR int(1) DEFAULT 0 NOT NULL; /*Cambia tipo de dato a int de "1" para distinguir entre un controlador = 1, un controlador de tareas = 2, un hijo de controlador  = 0*/

/*----------------2016/09/05------------------------*/
ALTER TABLE cestado_evaluacion MODIFY COLUMN EST_EVA_NOMBRE varchar(50) NOT NULL;
ALTER TABLE sipimss_20160829.cestado_validacion MODIFY COLUMN EST_VALIDA_DESC varchar(50) NULL;
ALTER TABLE sipimss_20160905.cestado_validacion MODIFY COLUMN EST_VALIDA_DESC varchar(50) NULL;


/*****************2016/09/02*************************/
--Creación de tablas
DROP TABLE IF EXISTS `bono_emp_can_bono`;
DROP table if exists bono_cestado_bono;
DROP table if exists bono_can_bono_reg;
DROP table if exists bono_convocatoria_bono;
DROP table if exists bono_ctipo_evaluacion;
DROP table if exists bono_cadmin_bonos;
DROP table if exists ini_ses_int;
DROP table if exists bono_act_edu_dist;

CREATE TABLE `bono_cestado_bono` (
  `est_bono_cve` int(11) NOT NULL AUTO_INCREMENT,
  `est_nombre` varchar(50) NOT NULL,
  `est_estado_nombre` varchar(30) NOT NULL,
  `est_orden` int(2) NOT NULL,
  constraint pk_cestado_bono
  PRIMARY KEY (`est_bono_cve`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

CREATE TABLE `bono_emp_can_bono` (
  `emp_can_cve` int(11) NOT NULL AUTO_INCREMENT,
  `empleado_cve` int(11) NOT NULL,
  `can_periodo_bono` int(4) NOT NULL,
  `can_sum_act` smallint(3) NOT NULL,
  `can_estado` smallint(1) NOT NULL DEFAULT '0',
  `can_tot_pro_eva` decimal(3,1) NOT NULL DEFAULT '0.0',
  `can_correo` varchar(100) NOT NULL,
  `conv_bono_cve` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`emp_can_cve`),
  CONSTRAINT `FK_EMPCANBONO` 
  FOREIGN KEY (`empleado_cve`) 
  REFERENCES `empleado` (`empleado_cve`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `bono_can_bono_reg` (
  `reg_bono_cve` int(11) NOT NULL AUTO_INCREMENT,
  `emp_can_cve` int(11) NOT NULL,
  `est_bono_cve` int(11) NOT NULL,
  `reg_fecha` datetime DEFAULT CURRENT_TIMESTAMP,
  `reg_promedio` decimal(5,2) DEFAULT NULL,
  `reg_msg` varchar(150) DEFAULT NULL,
  `tar_cve` int(11) DEFAULT NULL,
  `accion_tarjeton` tinyint(1) NOT NULL DEFAULT '0',
  `act_cve` int(11) DEFAULT NULL,
  `accion_actuacion` tinyint(1) NOT NULL DEFAULT '0',
  constraint pk_reg_bono_cve
  PRIMARY KEY (`reg_bono_cve`),
  CONSTRAINT `cbr_eb_fk` 
  FOREIGN KEY (`est_bono_cve`) 
  REFERENCES `bono_cestado_bono` (`est_bono_cve`),
  CONSTRAINT `cbr_ecb_fk` 
  FOREIGN KEY (`emp_can_cve`) 
  REFERENCES `bono_emp_can_bono` (`emp_can_cve`),
  CONSTRAINT `cbr_tar_fk` 
  FOREIGN KEY (`tar_cve`) 
  REFERENCES `tarjeton` (`tarjeton_cve`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `bono_convocatoria_bono` (
  `conv_bono_cve` int(11) NOT NULL AUTO_INCREMENT,
  `nom_bono` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `f_ini_carga_datos` datetime NOT NULL,
  `f_fin_carga_datos` datetime NOT NULL,
  `max_beneficiados` int(4) NOT NULL,
  `anio_bono` year(4) NOT NULL,
  `status_bono` smallint(1) NOT NULL,
  PRIMARY KEY (`conv_bono_cve`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `bono_ctipo_evaluacion` (
  `tipo_eva_cve` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_eva_nombre` varchar(100) NOT NULL,
  `id_regla_evaluacion` int(11) NOT NULL COMMENT 'PK logica viene de tabla reglas evaluacion',
  PRIMARY KEY (`tipo_eva_cve`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

CREATE TABLE `bono_cadmin_bonos` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `usr_matricula` varchar(20) NOT NULL,
  `usr_nombre` varchar(60) NOT NULL,
  `usr_paterno` varchar(60) NOT NULL,
  `usr_materno` varchar(60) DEFAULT NULL,
  `usr_correo` varchar(80) NOT NULL,
  `usr_activo` decimal(1,0) NOT NULL DEFAULT '1',
  `usr_passwd` char(128) NOT NULL,
  `usr_rol_admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

CREATE TABLE `ini_ses_int` (
  `usr_matricula` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `bono_act_edu_dist` (
  `act_cve` int(11) NOT NULL AUTO_INCREMENT,
  `cur_edu_dist_cve` int(11) NOT NULL,
  `tipo_eva_cve` int(11) NOT NULL,
  `act_promedio` decimal(5,2) DEFAULT NULL,
  PRIMARY KEY (`act_cve`),
  CONSTRAINT `act_edu_dist_ctipo_evaluacion_fk` 
  FOREIGN KEY (`tipo_eva_cve`) 
  REFERENCES `bono_ctipo_evaluacion` (`tipo_eva_cve`),
  CONSTRAINT `act_edu_dist_emp_educacion_distancia_fk` 
  FOREIGN KEY (`cur_edu_dist_cve`) 
  REFERENCES `emp_educacion_distancia` (`EMP_EDU_DISTANCIA_CVE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*******************2016/09/03************************/
alter table emp_formacion_profesional add
column efp_aplica_ecd numeric(1) default 0;

INSERT INTO `sipimss_20160903`.`modulo`
(`MOD_NOMBRE`,
`MOD_RUTA`,
`MOD_EST_CVE`,
`IS_CONTROLADOR`)
VALUES
('Evaluación de carrera docente','solicitar_evaluacion',1,1);

-------------------2016/09/07------------------------------
ALTER TABLE `crol_desempenia` ADD `ROL_MDL_CVE` bigint NOT NULL ;
ALTER TABLE `ccurso` ADD column `CVE_CURSO_FUENTE` bigint NOT NULL ;
