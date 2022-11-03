<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Helpers\DocumentoHelper;

class DocumentoModel extends Model
{
    use HasFactory;
    use DocumentoHelper;

    protected $tabla = 'prospecto_documento';
    private $_catalogo;

    /* Metodos del modelo */

    /*Funcion para regresar todos los registros*/

    function buscar_prospecto_documento(){

        $resultado = DB::connection($this->connection)
            ->table($this->tabla)
            ->where('borrado', '=', 0)
            ->get();
        
        $_contador = 0;
        $arreglo_resultado = array();

        foreach ($resultado as $fila)
        {
            $arreglo_resultado[$_contador] = new self();
            $arreglo_resultado[$_contador] -> set_documento_id( $fila->documento_id );
            $arreglo_resultado[$_contador] -> set_prospecto_id( $fila -> prospecto_id );
            $arreglo_resultado[$_contador] -> set_nombre_documento( $fila -> nombre_documento );
            $arreglo_resultado[$_contador] -> set_ruta( $fila -> ruta );
                
            $_contador ++;
        }
        return $arreglo_resultado;
    }

    /* Funcion para buscar registros por llave primaria*/
    function buscar_prospecto_documento_id($busqueda_value){

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
            $arreglo_resultado[$_contador] -> set_documento_id( $fila -> documento_id );
            $arreglo_resultado[$_contador] -> set_prospecto_id( $fila -> prospecto_id );
            $arreglo_resultado[$_contador] -> set_nombre_documento( $fila -> nombre_documento );
            $arreglo_resultado[$_contador] -> set_ruta( $fila -> ruta );
            
            $_contador ++;
        }
        return $arreglo_resultado;
    }

    /* Funcion para guardar datos*/
    function guardar_prospecto_documento($objeto_prospecto) {
        $this->_catalogo = $objeto_prospecto;

        $resultado = DB::connection($this->connection)
            ->table($this->tabla)
            ->insertGetId([
            'prospecto_id' => $this->_catalogo->get_prospecto_id(),
            'nombre_documento' => $this->_catalogo->get_nombre_documento(),
            'ruta' => $this->_catalogo->get_ruta(),
            'borrado' => 0
            ]);
        
        return $resultado;
    }

    /*Funcion para borrar registro*/ 
    function borrar_prospecto_documento($objeto_prospecto) {
        $this->_catalogo = $objeto_prospecto;

        $resultado = DB::connection($this->connection)
            ->table($this->tabla)
            ->where([
                ['documento_id', $this->_catalogo->get_documento_id()],
            ])
            ->update([
                'borrado' => 1
            ]);

        return $resultado;
    }
}
?>