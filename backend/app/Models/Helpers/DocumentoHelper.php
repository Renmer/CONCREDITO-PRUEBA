<?php
namespace App\Models\Helpers;
trait DocumentoHelper
{
    private $_documento_id;
    private $_prospecto_id;
    private $_nombre_documento;
    private $_ruta;
    private $_borrado;


    /* --> Metodos set de la tabla informacion_prospecto <--*/
    public function set_documento_id ( $documento_id )
    {
        $this->_documento_id = $documento_id;
    }

    public function set_prospecto_id ( $prospecto_id )
    {
        $this->_prospecto_id = $prospecto_id;
    }

    public function set_nombre_documento ( $nombre_documento )
    {
        $this->_nombre_documento = $nombre_documento;
    }

    public function set_ruta ( $ruta )
    {
        $this->_ruta = $ruta;
    }

    public function set_borrado ( $borrado )
    {
        $this->_borrado = $borrado;
    }

    /*--> Metodos get de la tabla informacion_prospecto <--*/
    public function get_documento_id ()
    {
        return $this->_documento_id;
    }

    public function get_prospecto_id ()
    {
        return $this->_prospecto_id;
    }

    public function get_nombre_documento ()
    {
        return $this->_nombre_documento;
    }

    public function get_ruta ()
    {
        return $this->_ruta;
    }

    public function get_borrado ()
    {
        return $this->_borrado;
    }


    
}
?>