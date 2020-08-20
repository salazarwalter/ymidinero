<?php

/**
 * Controller por defecto si no se usa el routes
 *
 */
class UsuarioController extends AppController
{

    public function ingresar()
    {
    	View::template("default_login");
    	if(Input::hasPost("usuario")){
    		$usu = Input::post("usuario") ;
    		$cla = Input::post("clave") ;
    		$obj = new Xusuario();
    		if($obj->ingresar($usu, $cla)){
    			switch (Auth::get("rol")) {
    				case 'U':
    					Redirect::to("usuario/panel");
    					break;
    				case 'A':
    					Redirect::to("admin/novedades");
    					break;
    				
    				default:
    					Redirect::to("usuario/salir");
    					die();
    					break;
    			}
    		}
    	}
    }
    public function salir(){
    	Auth::destroy_identity();
    	Redirect::to("../../");
    }

    public function panel(){
    	$this->titulo = "PANEL ADMINISTRACION";
    	
    }

    public function clave(){
    	$this->titulo = "CAMBIAR CLAVE";
    	if(Input::hasPost("clave1")){
    		$cla1 = Input::post("clave1");
    		$cla2 = Input::post("clave2");
    		$cla3 = Input::post("clave3");
    		// print_r($_POST);
    		// die();
    		$usu = new Xusuario();
    		if($usu->clave($cla1, $cla2, $cla3 )){
    			Flash::valid("La clave se cambi&oacute; exitosamente");
    			Redirect::to("usuario/clave");
    			Flash::valid("La clave se cambi&oacute; exitosamente");
    		}
    	}
    }

    public function datosp(){
    	$this->titulo = "MIS DATOS";
   		$per = new Xpersona();
 		
    	if(Input::hasPost("a")){
    		$vec = Input::post("a");
    		// print_r($vec);
    		// die();

    		if($per->datosp($vec )){
    			Flash::valid("Actualizaci&oacute;n exitosa");
    			Redirect::to("usuario/datosp");
    			// Flash::valid("Actualizaci&oacute;n exitosa");
    		}
    	}
    	else{
    		$this->a = $per->find_first("xusuario_id=".Auth::get("id"));
    	}
    }
    public function foto()
    {
    	$this->titulo = "CAMBIAR FOTO";
  		$usu = new Xusuario();
		if(Input::hasPost("a")){
            $vector = Input::post("a");
            if($usu->cambiarFoto()){
                Flash::valid("Foto Actualizada Correctamente . . .");
                //Redirect::to("../../usuario/foto");
            }
        }  		
  		$this->a = $usu->hallarFoto();

    }
    
}
