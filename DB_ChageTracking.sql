--Modificaciones 10 de agosto de 2016

alter table comprobante add column com_extension varchar(5);

ALTER TABLE `sipimss`.`empleado` 
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