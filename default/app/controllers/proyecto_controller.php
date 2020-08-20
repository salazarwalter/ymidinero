<?php

/**
 * Controller por defecto si no se usa el routes
 *
 */
class ProyectoController extends AppController
{

    public function index() {
        $this->titulo ="PROYECTOS";
        $pro = new Xproyecto();
        $this->lista = $pro->lista();
        $this->linkMovi =PUBLIC_PATH."../../detalle/index/";
    }
    
}
