<?php 

/**
 * 
 */
class Xdetalle extends ActiveRecord
{
	
public function initialize(){
	$this->validates_presence_of("detalle_descrip",array("message"=>"Debe Ingresar el Detalle"));;
	$this->validates_presence_of("detalle_monto",array("message"=>"Debe Ingresar el Monto"));;

	$this->validates_numericality_of("detalle_monto",array("message"=>"El Monto debe ser Numerico"));;
//	$this->validates_presence_of("mail",array("message"=>"Debe Ingresar el EMail"));;
//	$this->validates_presence_of("celular",array("message"=>"Debe Ingresar el Celular"));;
}

public function lista($proy_id) {
    return $this->find("xproyecto_id= $proy_id");
}

}
 ?>