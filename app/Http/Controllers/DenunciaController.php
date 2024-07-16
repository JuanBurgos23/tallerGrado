<?php

namespace App\Http\Controllers;

use App\Notifications\SmsNotificacion;
use Illuminate\Http\Request;
use App\Models\denuncia;
use App\Models\denunciante;
use App\Models\User;
use App\Notifications\DenunciaRegistrada;
use App\Models\oficial;
use App\Models\fiscal;
use App\Events\DenunciaRegistradaN;
use App\Notifications\DenunciaNotification;
use App\Models\denunciado;
use App\Models\victima;
use App\Models\ubicacion;
use App\Models\delito;
use App\Models\evidencia;
use Illuminate\Support\Facades\Auth;
use App\Events\NewNotification;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Events\NewDenunciaRegistered;
use App\Notifications\NotificacionReal;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NotiDenuncua;
use App\Notifications\UsuarioCorreoDenuncia;




class DenunciaController extends Controller
{
    public function store(Request $request)
    {
        $denuncia = new denuncia;
        $denuncia->lugar_hecho = $request->lugar_hecho;
        $denuncia->fecha_hecho = $request->fecha_hecho;
        $denuncia->hora_hecho = $request->hora_hecho;
        $denuncia->instrumento_utilizado = $request->instrumento_utilizado;
        $denuncia->declaracion = $request->declaracion;
        $denuncia->id_ubicacion = $request->id_ubicacion;
        $denuncia->id_denunciante = $request->id_denunciante;
        $denuncia->id_oficial = $request->id_oficial;
        $denuncia->id_fiscal = $request->id_fiscal;
        $denuncia->save();

    }

    public function index()
    {
        $denuncia = denuncia::all();
        $delitos = delito::all();

        return view('pages.denuncia', compact('denuncia', 'delitos'));
    }

    //reporte grafico
    public function reporte()
    {
        $delitos = Delito::withCount('denuncias')->get();

        return view('dashboard.index', compact('delitos'));
    }
    public function mostrar()
    {
        $denuncia = denuncia::with('denunciante', 'denunciados', 'oficial', 'fiscal')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('pages.mostrar_denuncia', compact('denuncia'));
    }


    public function registrarDenuncia(Request $request)
    {
        // Buscar el denunciante por el número de CI o crear uno nuevo si no existe
        $denunciante = Denunciante::firstOrCreate(
            ['ci' => $request->ci],
            [
                'nombre' => $request->nombreDenunciante,
                'paterno' => $request->paterno,
                'materno' => $request->materno,
                'sexo' => $request->sexo,
                'domicilio' => $request->domicilio,
                'telefono' => $request->telefono,
                'edad' => $request->edad,
                'estado_civil' => $request->estado_civil,
                'fecha_nac' => $request->fecha_nac,
                'nacionalidad' => $request->nacionalidad,
                'natural_de' => $request->natural_de,
                'ocupacion' => $request->ocupacion,
            ]
        );

        // Obtener el ID del denunciante
        $idDenunciante = $denunciante->id;

        //obetener el ID de la ubicacion
        $ubicacion = new ubicacion();
        $ubicacion->latitud = $request->latitud;
        $ubicacion->longitud = $request->longitud;
        $ubicacion->save();
        $idUbicacion = $ubicacion->id;

        // Guardar detalles de la denuncia
        $denuncia = new denuncia;
        $denuncia->lugar_hecho = $request->lugar_hecho;
        $denuncia->fecha_hecho = $request->fecha_hecho;
        $denuncia->hora_hecho = $request->hora_hecho;
        $denuncia->instrumento_utilizado = $request->instrumento_utilizado;
        $denuncia->declaracion = $request->declaracion;
        $denuncia->id_ubicacion = $idUbicacion;
        $denuncia->id_denunciante = $idDenunciante;
        $denuncia->id_oficial = $request->id_oficial;
        $denuncia->id_fiscal = $request->id_fiscal;
        $denuncia->estado = 'Pendiente';
        $denuncia->id_user = Auth::id(); // Asigna el ID del usuario autenticado
        $denuncia->save();

        // Obtener los dos últimos dígitos del año actual
        $yearSuffix = date('y');

        // Actualizar el valor del campo 'caso'
        $denuncia->caso = "{$denuncia->id}/{$yearSuffix}";
        $denuncia->save();

        //DENUNCIADOS
        // Validar los datos del request, incluyendo los denunciados
        $request->validate([
            'denunciados' => 'required|array',
            'denunciados.*.nombre' => 'required|string',
            'denunciados.*.apellidos' => 'nullable|string',
            'denunciados.*.ci' => 'nullable|string',
            'denunciados.*.fecha_nac' => 'nullable|date',
            'denunciados.*.sexo' => 'nullable|string',
            'denunciados.*.estado_civil' => 'nullable|string',
            'denunciados.*.edad' => 'nullable|integer',
            'denunciados.*.nacionalidad' => 'nullable|string',
            'denunciados.*.descripcion' => 'nullable|string',
            // Otras reglas de validación según sea necesario
        ]);

        // Array para almacenar los IDs de los denunciados relacionados
        $denunciados_ids = [];

        // Registrar cada denunciado asociado a la denuncia
        foreach ($request->denunciados as $denunciadoData) {
            // Si se proporciona el número de CI, buscar si el denunciado ya existe por número de CI
            if (!empty($denunciadoData['ci'])) {
                $denunciadoExistente = Denunciado::where('ci', $denunciadoData['ci'])->first();
            } else {
                $denunciadoExistente = null;
            }

            if ($denunciadoExistente) {
                // Si el denunciado ya existe, asociarlo con la denuncia actual
                $denuncia->denunciados()->attach($denunciadoExistente->id);
                $denunciados_ids[] = $denunciadoExistente->id;
            } else {
                // Si el denunciado no existe o no se proporciona el CI, crear uno nuevo y asociarlo
                $denunciado = new Denunciado();
                // Asignar los valores del request al nuevo denunciado
                $denunciado->nombre = $denunciadoData['nombre'];
                $denunciado->apellidos = $denunciadoData['apellidos'] ?? null;
                $denunciado->ci = $denunciadoData['ci'] ?? null;
                $denunciado->fecha_nac = $denunciadoData['fecha_nac'] ?? null;
                $denunciado->estado_civil = $denunciadoData['estado_civil'] ?? null;
                $denunciado->sexo = $denunciadoData['sexo'] ?? null;
                $denunciado->edad = $denunciadoData['edad'] ?? null;
                $denunciado->nacionalidad = $denunciadoData['nacionalidad'] ?? null;
                $denunciado->descripcion = $denunciadoData['descripcion'] ?? null;
                // Guardar el nuevo denunciado
                $denunciado->save();
                // Relacionar el nuevo denunciado con la denuncia
                $denuncia->denunciados()->attach($denunciado->id);
                $denunciados_ids[] = $denunciado->id;
            }
        }

        //VICTIMAS
        // Validar los datos del request, incluyendo las víctimas
        $request->validate([
            'victimas' => 'required|array',
            'victimas.*.nombre' => 'required|string',
            'victimas.*.apellidos' => 'nullable|string',
            'victimas.*.ci' => 'nullable|string',
            'victimas.*.fecha_nac' => 'nullable|date',
            'victimas.*.sexo' => 'nullable|string',
            'victimas.*.estado_civil' => 'nullable|string',
            'victimas.*.ocupacion' => 'nullable|string',
            'victimas.*.edad' => 'nullable|integer',
            'victimas.*.nacionalidad' => 'nullable|string',
            // Otras reglas de validación según sea necesario
        ]);

        // Array para almacenar los IDs de las víctimas relacionadas
        $victimas_ids = [];

        // Registrar cada víctima asociada a la denuncia
        foreach ($request->victimas as $victimaData) {
            // Si se proporciona el número de CI, buscar si la víctima ya existe por número de CI
            if (!empty($victimaData['ci'])) {
                $victimaExistente = Victima::where('ci', $victimaData['ci'])->first();
            } else {
                $victimaExistente = null;
            }

            if ($victimaExistente) {
                // Si la víctima ya existe, asociarla con la denuncia actual
                $denuncia->victimas()->attach($victimaExistente->id);
                $victimas_ids[] = $victimaExistente->id;
            } else {
                // Si la víctima no existe o no se proporciona el CI, crear una nueva y asociarla
                $victima = new Victima();
                // Asignar los valores del request a la nueva víctima
                $victima->nombre = $victimaData['nombre'];
                $victima->apellidos = $victimaData['apellidos'] ?? null;
                $victima->ci = $victimaData['ci'] ?? null;
                $victima->fecha_nac = $victimaData['fecha_nac'] ?? null;
                $victima->estado_civil = $victimaData['estado_civil'] ?? null;
                $victima->ocupacion = $victimaData['ocupacion'] ?? null;
                $victima->sexo = $victimaData['sexo'] ?? null;
                $victima->edad = $victimaData['edad'] ?? null;
                $victima->nacionalidad = $victimaData['nacionalidad'] ?? null;
                // Guardar la nueva víctima
                $victima->save();
                // Relacionar la nueva víctima con la denuncia
                $denuncia->victimas()->attach($victima->id);
                $victimas_ids[] = $victima->id;
            }
        }


        //registrar delito

        // Obtener los delitos seleccionados del formulario
        $delitosSeleccionados = explode(',', $request->input('delitos'));

        // Iterar sobre los delitos seleccionados y asociarlos con la denuncia en la tabla 'delito_denuncia'
        foreach ($delitosSeleccionados as $delitoId) {
            // Relacionar el delito con la denuncia
            $delito = delito::findOrFail($delitoId);
            $denuncia->delitos()->attach($delito->id);
        }


        // Guardar las evidencias
        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $file) {
                $evidencia = new Evidencia();

                $destinoPath = 'archivos_evidencia/';
                $filename = time() . '-' . $file->getClientOriginalName();
                $uploadSuccess = $file->move($destinoPath, $filename);

                // Guarda la ruta en la base de datos solo si la subida fue exitosa
                if ($uploadSuccess) {
                    $evidencia->path = $destinoPath . $filename;
                    $evidencia->save();

                    // Asociar la evidencia a la denuncia
                    $denuncia->evidencias()->attach($evidencia->id);
                }
            }
        }


        //enviar notificacion
        $oficiales = User::role('empleado')->get();

        foreach ($oficiales as $oficial) {
            $oficial->notify(new DenunciaRegistrada($denuncia, $denunciante));
        }

        if (auth()->check()) {
            $user = auth()->user();
            $userName = $user->name; // Asumiendo que el nombre del usuario está almacenado en la columna 'name'

            $user->notify(new NotificacionReal($userName));
        }

        /*Emitir evento
        event(new DenunciaRegistradaN($denuncia));*/

        // Despacha el evento

        event(new NewNotification($denuncia));

        $delitos = delito::all();

        // Emitir evento de broadcasting actualizar la vista de notificaciones
        event(new NewDenunciaRegistered($denuncia, $denunciante));


        $user = Auth::user();
        if ($user->hasRole('empleado')) {
            return redirect()->route('mostrarDenunciaNot', $denuncia->id)->with('success', 'Su Denuncia ha Sido Registrada.!!');
        } elseif ($user->hasRole('usuario')) {
            return redirect()->route('denuncia')->with('success', 'Su Denuncia ha Sido Enviada Espere una respuesta por Correo.!!');
        } else {
            // Manejar cualquier otro caso, por ejemplo si el usuario no tiene rol definido
            return redirect()->back()->with('error', 'No se puede determinar el rol del usuario.');
        }
    }


    public function show($id)
    {
        $denuncia = denuncia::with('denunciante', 'ubicacion', 'denunciados')->findOrFail($id);
        $oficiales = oficial::all();
        $fiscales = fiscal::all();

        return view('pages.mostrarDenunciaNot', compact('denuncia', 'oficiales', 'fiscales'));
    }

    public function update(Request $request, $id)
    {
        // Encuentra la denuncia
        $denuncia = denuncia::findOrFail($id);

        // Encuentra el oficial solo si se ha actualizado en la solicitud
        if ($request->has('id_oficial')) {
            $oficial = oficial::findOrFail($request->id_oficial);
            $oficial->estado = 'Ocupado';
            $oficial->save();

            // Envía la notificación al oficial por correo
            Notification::send($oficial, new NotiDenuncua($denuncia));


        }

        // Encuentra el fiscal solo si se ha actualizado en la solicitud
        if ($request->has('id_fiscal')) {
            $fiscal = fiscal::findOrFail($request->id_fiscal);
            $fiscal->estado = 'Ocupado';
            $fiscal->save();

            // Envía la notificación al fiscal por correo
            Notification::send($fiscal, new NotiDenuncua($denuncia));

        }

        // Encuentra el usuario que registró la denuncia
        $usuarioRegistrador = User::find($denuncia->id_user);

        // Asegúrate de que el usuario exista antes de enviar la notificación
        if ($usuarioRegistrador) {
            Notification::send($usuarioRegistrador, new UsuarioCorreoDenuncia($denuncia, $oficial, $fiscal));
        }

        // Actualiza la denuncia
        $denuncia->update($request->only('id_oficial', 'id_fiscal', 'estado', 'declaracion_formal'));

        return redirect()->route('mostrarDenunciaNot', $denuncia->id)->with('success', 'Denuncia actualizada con éxito');
    }


    ///detalle de la denuncia
    public function detalleDen($id)
    {
        $denuncia = denuncia::with('denunciante', 'ubicacion', 'denunciados')->findOrFail($id);
        $oficiales = oficial::all();
        $fiscales = fiscal::all();
        return view('pages.detalleDenuncia', compact('denuncia', 'oficiales', 'fiscales'));
    }
    public function detalleHistorial($id)
    {
        $denuncia = denuncia::with('denunciante', 'ubicacion', 'denunciados')->findOrFail($id);
        $oficiales = oficial::all();
        $fiscales = fiscal::all();
        return view('pages.detalle_historial', compact('denuncia', 'oficiales', 'fiscales'));
    }
    public function detalleUpdate(Request $request, $id)
    {
        $denuncia = denuncia::findOrFail($id);

        // Actualiza los campos 'id_oficial' y 'id_fiscal'
        $denuncia->update($request->only('id_oficial', 'id_fiscal'));

        // Actualiza el estado solo si se proporciona en el formulario
        if ($request->has('estado')) {
            $denuncia->estado = $request->estado;
        }

        // Actualiza la declaración formal solo si se proporciona en el formulario
        if ($request->has('declaracion_formal')) {
            $denuncia->declaracion_formal = $request->declaracion_formal;
        }

        // Guarda los cambios en la denuncia
        $denuncia->save();

        // Si el estado de la denuncia es "Finalizado", cambia el estado del Oficial y del Fiscal a "Disponible"
        if ($denuncia->estado == 'Finalizado') {
            if ($denuncia->id_oficial) {
                $oficial = Oficial::find($denuncia->id_oficial);
                if ($oficial) {
                    $oficial->estado = 'Disponible';
                    $oficial->save();
                }
            }

            if ($denuncia->id_fiscal) {
                $fiscal = Fiscal::find($denuncia->id_fiscal);
                if ($fiscal) {
                    $fiscal->estado = 'Disponible';
                    $fiscal->save();
                }
            }
        }

        return redirect()->route('detalle_den', $denuncia->id)->with('success', 'Denuncia actualizada con éxito');
    }


    public function generarPDF($id)
    {
        $denuncia = denuncia::with('denunciante', 'ubicacion', 'denunciados')->findOrFail($id);
        $oficiales = oficial::all();
        $fiscales = fiscal::all();

        // Cargar la vista Blade en una variable con los datos necesarios
        $html = view('pages.pdf.denuncia_pdf', compact('denuncia', 'oficiales', 'fiscales'))->render();

        // Configurar Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);

        // Renderizar el PDF
        $dompdf->render();

        // Obtener el contenido del PDF como una cadena
        $output = $dompdf->output();

        // Mostrar la vista previa del PDF en una página web
        return response()->view('pages.pdf.denuncia_pdf', compact('denuncia', 'oficiales', 'fiscales', 'output'));
    }

    //historial
    public function historial()
    {
        // Obtener el usuario autenticado
        $usuario = Auth::user();

        // Obtener las denuncias hechas por el usuario con las relaciones necesarias
        $denuncias = denuncia::with('denunciante', 'denunciados', 'oficial', 'fiscal')
            ->where('id_user', $usuario->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Pasar las denuncias a la vista
        return view('pages.historial', compact('denuncias'));
    }

    ///buscar denuncia
    public function buscarDenuncia(Request $request)
    {
        $caso = $request->input('caso');
        $ci = $request->input('ci');

        // Inicializa la consulta de denuncias sin orden específico
        $query = denuncia::with(['denunciante', 'denunciados', 'oficial', 'fiscal']);

        // Aplica filtros según los parámetros recibidos
        if ($caso) {
            // Filtra exactamente por el número de caso
            $query->where('caso', '=', $caso);
        } elseif ($ci) {
            // Filtra por el CI del denunciado
            $query->whereHas('denunciados', function ($query) use ($ci) {
                $query->where('ci', 'like', "%$ci%");
            });
        }

        // Ordena por fecha de creación descendente si no hay filtros aplicados
        $query->orderBy('created_at', 'desc');

        // Pagina los resultados y asegura que los parámetros de búsqueda se mantengan en la paginación
        $denuncia = $query->paginate(10)->appends($request->except('page'));

        return view('pages.mostrar_denuncia', compact('denuncia'));
    }

}




/*
// Guardar las evidencias
if ($request->hasFile('imagenes')) {
    foreach ($request->file('imagenes') as $archivo) {
        $rutaArchivo = $archivo->store('archivos_evidencia');

        // Crear la evidencia y obtener su ID
        $evidencia = Evidencia::create([
            'path' => $rutaArchivo,
        ]);

        // Guardar la relación en la tabla pivote 'evidencia_denuncia'
        $denuncia->evidencias()->attach($evidencia->id);
    }
}
*/
