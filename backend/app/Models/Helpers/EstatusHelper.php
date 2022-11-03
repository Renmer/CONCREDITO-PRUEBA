<?php
namespace App\Models\Helpers;
trait EstatusHelper
{
    private $_solicitud_id;
    private $_prospecto_id;
    private $_estatus;
    private $_observaciones;
    private $_borrado;


    /* --> Metodos set de la tabla informacion_prospecto <--*/
    public function set_solicitud_id ( $solicitud_id )
    {
        $this->_solicitud_id = $solicitud_id;
    }

    public function set_prospecto_id ( $prospecto_id )
    {
        $this->_prospecto_id = $prospecto_id;
    }

    public function set_estatus ( $estatus )
    {
        $this->_estatus = $estatus;
    }

    public function set_observaciones ( $observaciones )
    {
        $this->_observaciones = $observaciones;
    }

    public function set_borrado ( $borrado )
    {
        $this->_borrado = $borrado;
    }

    /*--> Metodos get de la tabla informacion_prospecto <--*/
    public function get_solicitud_id ()
    {
        return $this->_solicitud_id;
    }

    public function get_prospecto_id ()
    {
        return $this->_prospecto_id;
    }

    public function get_estatus ()
    {
        return $this->_estatus;
    }

    public function get_observaciones ()
    {
        return $this->_observaciones;
    }

    public function get_borrado ()
    {
        return $this->_borrado;
    }


    
}
?>