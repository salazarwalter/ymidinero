<?php 

/**
 * 
 */
class Xpersona extends ActiveRecord
{
	
	public function datosp($vec){
    		$vec["nombre"]   = trim($vec["nombre"] );
    		$vec["apellido"] = trim($vec["apellido"] );
    		$vec["mail"]     = trim($vec["mail"] );
    		$vec["celular"]  = trim($vec["celular"] );

    		if($vec["mail"]){
				if (!filter_var($vec["mail"], FILTER_VALIDATE_EMAIL)) {
	    			Flash::error("EMail ingresado No v&aacute;lido");
	    			return false;
				}    			
    		}
    	$obj = $this->find_first("xusuario_id =".Auth::get("id"))	;
    	$vec["xusuario_id"] = $obj->xusuario_id ;
    	$vec["superadmin"]  = $obj->superadmin ;
    	$vec["id"]          = $obj->id ;

    	if(!$obj->update($vec)){
   			Flash::error("Error Desconocido");
		return false;
    	}

       return true;         
	}

public function initialize(){
	$this->validates_presence_of("nombre",array("message"=>"Debe Ingresar el Nombre"));;
	$this->validates_presence_of("apellido",array("message"=>"Debe Ingresar el Apellido"));;
	$this->validates_presence_of("mail",array("message"=>"Debe Ingresar el EMail"));;
	$this->validates_presence_of("celular",array("message"=>"Debe Ingresar el Celular"));;
}


}
 ?>