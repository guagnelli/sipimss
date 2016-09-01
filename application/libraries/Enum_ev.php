<?php

abstract class MyEnum_ev {

    final public function __construct($value = null) {
        $c = new ReflectionClass($this);
        if (!in_array($value, $c->getConstants())) {
            throw IllegalArgumentException();
        }
        $this->value = $value;
    }

    final public function buscar($value = null) {
        $text = $this->getTextoEnum($value);
        $this->texto = $text;
    }

    final public function __toString() {
        return $this->value;
    }

    function getTextoEnum($value = null) {
        return "";
    }

}

class Enum_ev extends MyEnum_ev {

    const
            __default = 0,
            Inicio = 1,
            Incompleta = 2,
            Completa = 3,
            Por_validar_n1 = 4,
            En_revision_n1 = 5,
            Correccion_docente = 6,
            Val_n1_por_validar_n2 = 7,
            En_revision_n2 = 8,
            Correccion_n1 = 9,
            Val_n2_por_validar_profesionalizacion = 10,
            En_revision_profesionalizacion = 11,
            Correccion_n2 = 12,
            Validado = 13

    ;
    /*
      guardar actuación (evaluaciones)
      corregir

     */
}
