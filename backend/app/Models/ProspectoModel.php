<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Helpers\ProspectoHelper;

class ProspectoModel extends Model
{
    use HasFactory;
    use ProspectoHelper;

    protected $tabla = 'prospecto_informacion';
    private $_catalogo;

    /* Metodos del modelo */

    /*Funcion para regresar todos los registros*/

    function buscar_prospecto_informacion(){

        $resultado = DB::connection($this->connection)
            ->table($this->tabla)
            ->where('borrado', '=', 0)
            ->get();
        
        $_contador = 0;
        $arreglo_resultado = array();

        foreach ($resultado as $fila)
        {
            $arreglo_resultado[$_contador] = new self();
            $arreglo_resultado[$_contador] -> set_prospecto_id( $fila->prospecto_id );
            $arreglo_resultado[$_contador] -> set_nombre( $fila -> nombre );
            $arreglo_resultado[$_contador] -> set_apellido_paterno( $fila -> apellido_paterno );
            $arreglo_resultado[$_contador] -> set_apellido_materno( $fila -> apellido_materno );
            $arreglo_resultado[$_contador] -> set_telefono( $fila -> telefono );
            $arreglo_resultado[$_contador] -> set_rfc( $fila -> rfc );
                
            $_contador ++;
        }
        return $arreglo_resultado;
    }

    /* Funcion para buscar registros por llave primaria*/
    function buscar_prospecto_informacion_id($busqueda_value){

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
            $arreglo_resultado[$_contador] -> set_prospecto_id( $fila -> prospecto_id );
            $arreglo_resultado[$_contador] -> set_nombre( $fila -> nombre );
            $arreglo_resultado[$_contador] -> set_apellido_paterno( $fila -> apellido_paterno );
            $arreglo_resultado[$_contador] -> set_apellido_materno( $fila -> apellido_materno );
            $arreglo_resultado[$_contador] -> set_telefono( $fila -> telefono );
            $arreglo_resultado[$_contador] -> set_rfc( $fila -> rfc );
                
            $_contador ++;
        }
        return $arreglo_resultado;
    }

    /* Funcion para guardar datos*/
    function guardar_prospecto_informacion($objeto_prospecto) {
        $this->_catalogo = $objeto_prospecto;

        $resultado = DB::connection($this->connection)
            ->table($this->tabla)
            ->insertGetId([
            'nombre' => $this->_catalogo->get_nombre(),
            'apellido_paterno' => $this->_catalogo->get_apellido_paterno(),
            'apellido_materno' => $this->_catalogo->get_apellido_materno(),
            'telefono' => $this->_catalogo->get_telefono(),
            'rfc' => $this->_catalogo->get_rfc(),
            'borrado' => 0
            ]);
        
        return $resultado;
    }

    /*Funcion para borrar registro*/ 
    function borrar_prospecto_informacion($objeto_prospecto) {
        $this->_catalogo = $objeto_prospecto;

        $resultado = DB::connection($this->connection)
            ->table($this->tabla)
            ->where([
                ['prospecto_id', $this->_catalogo->get_prospecto_id()],
            ])
            ->update([
                'borrado' => 1
            ]);

        return $resultado;
    }
}
?>