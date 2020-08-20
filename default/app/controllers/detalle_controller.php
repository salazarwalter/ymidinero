<?php

/**
 * Controller por defecto si no se usa el routes
 *
 */
class DetalleController extends AppController
{

    public function index($proy_id) {
        $this->titulo ="MOVIMIENTOS";
        $pro = new Xproyecto();
        $this->a = $pro->find_first("id = $proy_id AND xusuario_id= ".Auth::get("id"));
        $deta = new Xdetalle();
        $this->lista = $deta->lista($proy_id);
        $this->linkVolver =PUBLIC_PATH."../../proyecto/";
        $this->linkAdd =PUBLIC_PATH."../../detalle/add/$proy_id";
    }
    public function add($proy_id) {
        $this->titulo ="AGREGAR DETALLE";
        $pro = new Xproyecto();
        $this->a = $pro->find_first("id = $proy_id AND xusuario_id= ".Auth::get("id"));
    }    
}
