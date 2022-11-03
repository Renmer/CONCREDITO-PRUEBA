<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Helpers\DomicilioHelper;

class DomicilioModel extends Model
{
    use HasFactory;
    use DomicilioHelper;

    protected $tabla = 'prospecto_domicilio';
    private $_catalogo;

    /* Metodos del modelo */

    /*Funcion para regresar todos los registros*/

    function buscar_prospecto_domicilio(){

        $resultado = DB::connection($this->connection)
            ->table($this->tabla)
            ->where('borrado', '=', 0)
            ->get();
        
        $_contador = 0;
        $arreglo_resultado = array();

        foreach ($resultado as $fila)
        {
            $arreglo_resultado[$_contador] = new self();
            $arreglo_resultado[$_contador] -> set_domicilio_id( $fila->domicilio_id );
            $arreglo_resultado[$_contador] -> set_calle( $fila -> calle );
            $arreglo_resultado[$_contador] -> set_numero( $fila -> numero );
            $arreglo_resultado[$_contador] -> set_colonia( $fila -> colonia );
            $arreglo_resultado[$_contador] -> set_codigo_postal( $fila -> codigo_postal );
                
            $_contador ++;
        }
        return $arreglo_resultado;
    }

    /* Funcion para buscar registros por llave primaria*/
    function buscar_prospecto_domicilio_id($busqueda_value){

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
            $arreglo_resultado[$_contador] -> set_domicilio_id( $fila -> domicilio_id );
            $arreglo_resultado[$_contador] -> set_prospecto_id( $fila -> prospecto_id );
            $arreglo_resultado[$_contador] -> set_calle( $fila -> calle );
            $arreglo_resultado[$_contador] -> set_numero( $fila -> numero );
            $arreglo_resultado[$_contador] -> set_colonia( $fila -> colonia );
            $arreglo_resultado[$_contador] -> set_codigo_postal( $fila -> codigo_postal );
                
            $_contador ++;
        }
        return $arreglo_resultado;
    }

    /* Funcion para guardar datos*/
    function guardar_prospecto_domicilio($objeto_prospecto) {
        $this->_catalogo = $objeto_prospecto;

        $resultado = DB::connection($this->connection)
            ->table($this->tabla)
            ->insertGetId([
            'prospecto_id' => $this->_catalogo->get_prospecto_id(),
            'calle' => $this->_catalogo->get_calle(),
            'numero' => $this->_catalogo->get_numero(),
            'colonia' => $this->_catalogo->get_colonia(),
            'codigo_postal' => $this->_catalogo->get_codigo_postal(),
            'borrado' => 0
            ]);
        
        return $resultado;
    }

    /*Funcion para borrar registro*/ 
    function borrar_prospecto_domicilio($objeto_prospecto) {
        $this->_catalogo = $objeto_prospecto;

        $resultado = DB::connection($this->connection)
            ->table($this->tabla)
            ->where([
                ['domicilio_id', $this->_catalogo->get_domicilio_id()],
            ])
            ->update([
                'borrado' => 1
            ]);

        return $resultado;
    }
}
?>