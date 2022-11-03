<?php
namespace App\Models\Helpers;
trait DomicilioHelper
{
    private $_domicilio_id;
    private $_prospecto_id;
    private $_calle;
    private $_numero;
    private $_colonia;
    private $_codigo_postal;
    private $_borrado;

    /* --> Metodos set de la tabla informacion_prospecto <--*/
    public function set_domicilio_id ( $domicilio_id )
    {
        $this->_domicilio_id = $domicilio_id;
    }

    public function set_prospecto_id ( $prospecto_id )
    {
        $this->_prospecto_id = $prospecto_id;
    }

    public function set_calle ( $calle )
    {
        $this->_calle = $calle;
    }

    public function set_numero ( $numero )
    {
        $this->_numero = $numero;
    }

    public function set_colonia ( $colonia )
    {
        $this->_colonia = $colonia;
    }

    public function set_codigo_postal ( $codigo_postal )
    {
        $this->_codigo_postal = $codigo_postal;
    }
    
    public function set_borrado ( $borrado )
    {
        $this->_borrado = $borrado;
    }

    /*--> Metodos get de la tabla informacion_prospecto <--*/
    public function get_domicilio_id ()
    {
        return $this->_domicilio_id;
    }

    public function get_prospecto_id ()
    {
        return $this->_prospecto_id;
    }

    public function get_calle ()
    {
        return $this->_calle;
    }

    public function get_numero ()
    {
        return $this->_numero;
    }

    public function get_colonia ()
    {
        return $this->_colonia;
    }

    public function get_codigo_postal ()
    {
        return $this->_codigo_postal;
    }

    public function get_borrado ()
    {
        return $this->_borrado;
    }


    
}
?>