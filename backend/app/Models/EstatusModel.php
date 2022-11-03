<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Helpers\EstatusHelper;

class EstatusModel extends Model
{
    use HasFactory;
    use EstatusHelper;

    protected $tabla = 'prospecto_estatus';
    private $_catalogo;

    /* Metodos del modelo */

    /*Funcion para regresar todos los registros*/

    function buscar_prospecto_estatus(){

        $resultado = DB::connection($this->connection)
            ->table($this->tabla)
            ->where('borrado', '=', 0)
            ->get();
        
        $_contador = 0;
        $arreglo_resultado = array();

        foreach ($resultado as $fila)
        {
            $arreglo_resultado[$_contador] = new self();
            $arreglo_resultado[$_contador] -> set_solicitud_id( $fila->solicitud_id );
            $arreglo_resultado[$_contador] -> set_estatus( $fila -> estatus );
            $arreglo_resultado[$_contador] -> set_observaciones( $fila -> observaciones );
            $_contador ++;
        }
        return $arreglo_resultado;
    }

    /* Funcion para buscar registros por llave primaria*/
    function buscar_prospecto_estatus_id($busqueda_value){

        $array_where = array(
            ['borrado', '=', 0]
        );
		$array_where[] = ['prospecto_id', '=', $busqueda_value];

        $resultado = DB::connection($this->connection)
            ->table($this->tabla)
            ->where($array_where)
            ->get();
        
        $_contador = 0;
        $arreglo_resultado = array();

        foreach ($resultado as $fila)
        {
            $arreglo_resultado[$_contador] = new self();
            $arreglo_resultado[$_contador] -> set_solicitud_id( $fila -> solicitud_id );
            $arreglo_resultado[$_contador] -> set_prospecto_id( $fila -> prospecto_id );
            $arreglo_resultado[$_contador] -> set_estatus( $fila -> estatus );
            $arreglo_resultado[$_contador] -> set_observaciones( $fila -> observaciones );
                
            $_contador ++;
        }
        return $arreglo_resultado;
    }

    /* Funcion para guardar datos*/
    function guardar_prospecto_estatus($objeto_prospecto) {
        $this->_catalogo = $objeto_prospecto;

        $resultado = DB::connection($this->connection)
            ->table($this->tabla)
            ->insertGetId([
            'prospecto_id' => $this->_catalogo->get_prospecto_id(),
            'estatus' => 'Enviado',
            'observaciones' => null,
            'borrado' => 0
            ]);
        
        return $resultado;
    }

    /*Funcion para borrar registro*/ 
    function borrar_prospecto_estatus($objeto_prospecto) {
        $this->_catalogo = $objeto_prospecto;

        $resultado = DB::connection($this->connection)
            ->table($this->tabla)
            ->where([
                ['solicitud_id', $this->_catalogo->get_solicitud_id()],
            ])
            ->update([
                'borrado' => 1
            ]);

        return $resultado;
    }
    /*Funcion para actualizar registro*/ 
    function actualizar_prospecto_estatus($objeto_prospecto) {
        $this->_catalogo = $objeto_prospecto;

        $resultado = DB::connection($this->connection)
            ->table($this->tabla)
            ->where([
                ['prospecto_id', $this->_catalogo->get_prospecto_id()],
            ])
            ->update([
                'estatus' => $this->_catalogo->get_estatus(),
                'observaciones' => $this->_catalogo->get_observaciones()
            ]);

        return $resultado;
    }
}
?>