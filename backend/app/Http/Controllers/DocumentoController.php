<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\DocumentoModel;
use Illuminate\Support\Facades\Storage;

class DocumentoController extends Controller
{
    public function store(Request $request)
    {
        return \response()->download($request->input('url'));

    }
    public function show($id)
    {

        // $contenido = file_get_contents($ruta);
        // $download_link = link_to_asset($ruta);
        // return \response ($contenido)->withHeaders([
        //     'Content-Type'=> mime_content_type($ruta)
        // ]);
        return \response()->download('C:\\Users\\franc\\Documents\\GitHub\\Prueba CONCREDITO\\backend\\storage\\app\\Documentos/prospecto33/1500057220165.jpg');
    }

}
?>