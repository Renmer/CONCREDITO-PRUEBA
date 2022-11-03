<?php
namespace App\Models\Helpers;
trait ProspectoHelper
{
    private $_prospecto_id;
    private $_nombre;
    private $_apellido_paterno;
    private $_apellido_materno;
    private $_telefono;
    private $_rfc;
    private $_borrado;

    /* --> Metodos set de la tabla informacion_prospecto <--*/
    public function set_prospecto_id ( $prospecto_id )
    {
        $this->_prospecto_id = $prospecto_id;
    }

    public function set_nombre ( $nombre )
    {
        $this->_nombre = $nombre;
    }

    public function set_apellido_paterno ( $apellido_paterno )
    {
        $this->_apellido_paterno = $apellido_paterno;
    }

    public function set_apellido_materno ( $apellido_materno )
    {
        $this->_apellido_materno = $apellido_materno;
    }

    public function set_telefono ( $telefono )
    {
        $this->_telefono = $telefono;
    }

    public function set_rfc ( $rfc )
    {
        $this->_rfc = $rfc;
    }
    
    public function set_borrado ( $borrado )
    {
        $this->_borrado = $borrado;
    }

    /*--> Metodos get de la tabla informacion_prospecto <--*/
    public function get_prospecto_id ()
    {
        return $this->_prospecto_id;
    }

    public function get_nombre ()
    {
        return $this->_nombre;
    }

    public function get_apellido_paterno ()
    {
        return $this->_apellido_paterno;
    }

    public function get_apellido_materno ()
    {
        return $this->_apellido_materno;
    }

    public function get_telefono ()
    {
        return $this->_telefono;
    }

    public function get_rfc ()
    {
        return $this->_rfc;
    }

    public function get_borrado ()
    {
        return $this->_borrado;
    }


    
}
?>