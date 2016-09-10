create table stg_sied_cursos(
    id_curso bigint not null,
    anio char(4)not null,
    clave_curso varchar(255) not null,
    nombre_curso varchar(255) not null,
    fecha_inicio date,
    fecha_fin date,
    horas_curso integer,
    tutorizado numeric(1),
    tipo_curso_id numeric(2) not null,
    tipo_curso varchar(25)not null,
    constraint pk_id_curso
    primary key(id_curso)
);

LOAD DATA LOCAL INFILE 'sied_curso_1.csv' INTO TABLE stg_sied_cursos
FIELDS TERMINATED BY ',' 
ENCLOSED BY '"' 
LINES TERMINATED BY '\n'
IGNORE 1 LINES
(id_curso, anio, clave_curso, nombre_curso, fecha_inicio,horas_curso,tutorizado,tipo_curso_id,tipo_curso);
