<?php
namespace dimensoes;

class Data{
    public $data;
    public $dia;
    public $mes;
    public $ano;
    public $semanaAno;
    public $bimestre;
    public $trimestre;
    public $semestre;
    
    public function setData($data){
        $this->data = $data;
        $this->dia = date('d', strtotime($data));
        $this->mes = date('m', strtotime($data));
        $this->ano = date('y', strtotime($data));
        $this->semanaAno = date('W', strtotime($data));

        $this->bimestre = (date('m', strtotime($data)) <3 ) ? 1: (date('m', strtotime($data)) <5) ? 2: (date('m', strtotime($data)) <7 ) ? 3 : (date('m', strtotime($data)) <9 ) ? 4: (date('m', strtotime($data)) <11 ) ? 5:6;

        $this->trimestre = (date('m', strtotime($data)) <4 ) ? 1: (date('m', strtotime($data)) <7) ? 2: (date('m', strtotime($data)) <11 ) ? 3 : 4;
        
        $this->semestre = (date('m', strtotime($data)) <7 ) ? 1: 2;
    }
}


?>