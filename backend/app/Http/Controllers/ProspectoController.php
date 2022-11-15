<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\ProspectoModel;
use App\Models\DomicilioModel;
use App\Models\EstatusModel;
use App\Models\DocumentoModel;
use Illuminate\Support\Facades\Storage;

class ProspectoController extends Controller
{
    public function index()
    {
        $catalogo_prospecto = new ProspectoModel();
        $catalogo_estatus = new EstatusModel();

        $prospecto = $catalogo_prospecto->buscar_prospecto_informacion();

        $_prospecto = array();
        $_contador = 0;
        
        if( count($prospecto) > 0 )
        {
            foreach($prospecto as $objeto)
            {
                $_prospecto[$_contador]['prospecto_id'] = $objeto->get_prospecto_id();
                $_prospecto[$_contador]['nombre'] = $objeto->get_nombre();
                $_prospecto[$_contador]['apellido_paterno'] = $objeto->get_apellido_paterno();
                $_prospecto[$_contador]['apellido_materno'] = $objeto->get_apellido_materno();
                $estatus = $catalogo_estatus->buscar_prospecto_estatus_id($objeto->get_prospecto_id());
                $_prospecto[$_contador]['estatus'] = $estatus[0]->get_estatus();
                $_prospecto[$_contador]['observaciones'] = $estatus[0]->get_observaciones();

                $_contador++;
            }
        }
        else
        {
            $_prospecto = '';
        }
        return \response($_prospecto);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'string|max:20|required',
            'apellido_paterno' => 'string|max:20|required',
            'telefono' => 'string|max:14|required',
            'rfc' => 'string|max:13|required',
            'calle' => 'string|max:20|required',
            'numero' => 'string|max:5|required',
            'colonia' => 'string|max:20|required',
            'codigo_postal' => 'string|max:5|required',
        ]);

        $catalogo_prospecto = new ProspectoModel();
        $catalogo_prospecto->set_nombre($request->nombre);
        $catalogo_prospecto->set_apellido_paterno($request->apellido_paterno);
        $catalogo_prospecto->set_apellido_materno($request->apellido_materno);
        $catalogo_prospecto->set_telefono($request->telefono);
        $catalogo_prospecto->set_rfc($request->rfc);
        $registro_prospecto = $catalogo_prospecto->guardar_prospecto_informacion($catalogo_prospecto);

        $catalogo_domicilio = new DomicilioModel();
        $catalogo_domicilio->set_prospecto_id($registro_prospecto);
        $catalogo_domicilio->set_calle($request->calle);
        $catalogo_domicilio->set_numero($request->numero);
        $catalogo_domicilio->set_colonia($request->colonia);
        $catalogo_domicilio->set_codigo_postal($request->codigo_postal);
        $registro_domicilio = $catalogo_domicilio->guardar_prospecto_domicilio($catalogo_domicilio);

        $catalogo_estatus = new EstatusModel();
        $catalogo_estatus->set_prospecto_id($registro_prospecto);
        $registro_estatus = $catalogo_estatus->guardar_prospecto_estatus($catalogo_estatus);

        $docs = $request->documentos;
        foreach ($docs as $documento){
            $catalogo_documento = new DocumentoModel();
            $catalogo_documento->set_prospecto_id($registro_prospecto);
            $nombre = $documento->getClientOriginalName();
            $catalogo_documento->set_nombre_documento($nombre);
            $catalogo_documento->set_ruta('Documentos/prospecto'."$registro_prospecto".'/'."$nombre");
            $registro_documento = $catalogo_documento->guardar_prospecto_documento($catalogo_documento);
            $documento->storeAs('Documentos/prospecto'."$registro_prospecto",$nombre);
        }
        
        if( $registro_prospecto && $registro_domicilio && $registro_estatus)
        {
            return \response ("Datos registrados correctamente",201);
        }
        else
        {
            return \response ("No se pudieron guardar los datos");
        }

    }

    public function show($id)
    {
        $catalogo_prospecto = new ProspectoModel();
        $catalogo_domicilio = new DomicilioModel();
        $catalogo_estatus = new EstatusModel();
        $catalogo_documento = new DocumentoModel();

        $registro_prospecto = $catalogo_prospecto->buscar_prospecto_informacion_id($id);
        $registro_domicilio = $catalogo_domicilio->buscar_prospecto_domicilio_id($id);
        $registro_estatus = $catalogo_estatus->buscar_prospecto_estatus_id($id);
        $registro_documento = $catalogo_documento->buscar_prospecto_documento_id($id);

        $_prospecto['prospecto_id'] = $registro_prospecto[0]->get_prospecto_id();
        $_prospecto['nombre'] = $registro_prospecto[0]->get_nombre();
        $_prospecto['apellido_paterno'] = $registro_prospecto[0]->get_apellido_paterno();
        $_prospecto['apellido_materno'] = $registro_prospecto[0]->get_apellido_materno();
        $_prospecto['telefono'] = $registro_prospecto[0]->get_telefono();
        $_prospecto['rfc'] = $registro_prospecto[0]->get_rfc();

        $_prospecto['calle'] = $registro_domicilio[0]->get_calle();
        $_prospecto['numero'] = $registro_domicilio[0]->get_numero();
        $_prospecto['colonia'] = $registro_domicilio[0]->get_colonia();
        $_prospecto['codigo_postal'] = $registro_domicilio[0]->get_codigo_postal();

        $_prospecto['estatus'] = $registro_estatus[0]->get_estatus();
        $_prospecto['observaciones'] = $registro_estatus[0]->get_observaciones();

        $contador = 0;
        foreach($registro_documento as $documento){
            $ruta = Storage::disk('local')->path($documento->get_ruta());
            $_prospecto['documento'][$contador]['nombre'] = $documento->get_nombre_documento();
            $_prospecto['documento'][$contador]['ruta'] = $ruta;
            $contador++;
        }

        return \response ($_prospecto);
    }

    public function destroy($id)
    {
        
        $catalogo_prospecto = new ProspectoModel();
        $catalogo_prospecto->set_prospecto_id($id);
        if( $catalogo_prospecto->borrar_informacion_prospecto($catalogo_prospecto) )
        {
            return \response('eliminado!') ;
        }
        else{
            return \response('No se pudo eliminar!' ) ;
        }
        
    }

}
?>