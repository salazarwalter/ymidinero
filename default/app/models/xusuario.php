<?php 

/**
 * 
 */
class Xusuario extends ActiveRecord
{
	public static $FOTO_ANONIMO ="anonimo128.png";
	public static $PATH_ANONIMO =PUBLIC_PATH."img/upload/";
	
	public function ingresar($usu, $cla){
    		$usu = trim($usu);
    		$cla = trim($cla);
    		if(!$usu || !$cla){
    			Flash::error("Usuario/Clave Obligatorios");
    			return false;
    		}

    		$usu = base64_encode($usu);
    		$cla = base64_encode($cla);

 			$auth = new Auth("model", "class: xusuario", "usu: $usu", "cla: $cla");
            if ($auth->authenticate())
                {
                    Flash::valid("Bienvenido al sistema");
                } 
                else 
                {
                    Flash::error("Usuario/Clave no se corresponden");
                    return false;
                }    		
       return true;         
	}

	public function clave($cla1, $cla2, $cla3 ){
		$cla1 = trim($cla1);
		$cla2 = trim($cla2);
		$cla3 = trim($cla3);
		if(!$cla1 ||!$cla2 || !$cla3 ){
			Flash::error("Las claves no pueden ser vac&iacute;as");
			return FALSE;
		}

		if(strlen($cla1)<8 ||strlen($cla2)<8 || strlen($cla3)<8 ){
			Flash::error("Las claves deben tener al menos 8 caracteres");
			return FALSE;
		}

		if($cla2!=$cla3 ){
			Flash::error("Las nuevas claves deben ser iguales ");
			return FALSE;
		}

		$cla1Encript = base64_encode($cla1);
		if($cla1Encript != Auth::get("cla")){
			Flash::error("Clave de Usuario Actual Diferente. ");
			return FALSE;
		}

		$cla2 = base64_encode($cla2);
		$obj = $this->find_first("id=".Auth::get("id"));
		$obj->cla = $cla2;
		if(!$obj->update()){
			Flash::error("Error Desconocido. No se pudo Cambiar la Clave ");
			return FALSE;
		}
		return TRUE;
	}

public function hallarFoto()
{

  		$a = $this->find_first("id = ".Auth::get("id"));
  		if($a->foto)
  		{
  			$a->fotox = Xusuario::$PATH_ANONIMO.$a->foto;
  		}else {
  			$a->fotox = Xusuario::$PATH_ANONIMO.Xusuario::$FOTO_ANONIMO;
  		}
  		return $a;
}

 function cambiarFoto(){

 		if(empty($_FILES)){
 			Flash::error("Debe subir una imagen Valida");
 			return FALSE;
 		}
        $archivo = Upload::factory('imagen', 'image'); 
 		// print_r($_FILES);
 		// die();
        $archivo->setExtensions(array('jpg', 'png', 'gif','jpeg'));//le asignamos las extensiones a permitir
       // $archivo->addPath("/perfiles");
            if ($archivo->isUploaded()) {
                if ($name=$archivo->saveRandom()) {
                    $usu=$this->find_by_id(Auth::get("id"));
                    $usu->foto           = $name;
                    return $usu->save();
                }
            }else{
                    Flash::warning('No se ha Podido Subir la imagen...!!!');
            }
         
        return FALSE;
    }

}
 ?>