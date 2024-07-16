<?php

use App\Http\Controllers\MensajeUserController;
use App\Http\Controllers\UsuarioEmpController;
use App\Http\Controllers\VictimaController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\DenuncianteController;
use App\Http\Controllers\FiscalController;
use App\Http\Controllers\OficialController;
use App\Http\Controllers\DenunciaController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\DelitoController;
use App\Http\Middleware\CheckRole;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\BackupController;


Route::get('/', function () {
    return redirect('sign-in');
})->middleware('guest');
//denuncia
Route::get('denuncia', [DenunciaController::class, 'index'])->name('denuncia')->middleware('auth');
Route::get('/dashboard', [DenunciaController::class, 'reporte'])->middleware('auth')->name('dashboard')->middleware('checkRole:admin');
Route::get('sign-up', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('sign-up', [RegisterController::class, 'store'])->middleware('guest');
Route::get('sign-in', [SessionsController::class, 'create'])->middleware('guest')->name('login');
Route::post('sign-in', [SessionsController::class, 'store'])->middleware('guest');
Route::post('verify', [SessionsController::class, 'show'])->middleware('guest');
Route::post('reset-password', [SessionsController::class, 'update'])->middleware('guest')->name('password.update');
Route::get('verify', function () {
    return view('sessions.password.verify');
})->middleware('guest')->name('verify');
Route::get('/reset-password/{token}', function ($token) {
    return view('sessions.password.reset', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('sign-out', [SessionsController::class, 'destroy'])->middleware('auth')->name('logout');
Route::get('profile', [ProfileController::class, 'create'])->middleware('auth')->name('profile');
Route::post('user-profile', [ProfileController::class, 'update'])->middleware('auth');
Route::group(['middleware' => 'auth'], function () {
    Route::get('billing', function () {
        return view('pages.billing');
    })->name('billing')->middleware('checkRole:admin');
    Route::get('oficial_register', function () {
        return view('pages.oficial_register');
    })->name('oficial_register');
    Route::get('tables', function () {
        return view('pages.tables');
    })->name('tables');
    Route::get('rtl', function () {
        return view('pages.rtl');
    })->name('rtl')->middleware('checkRole:admin');
    Route::get('virtual-reality', function () {
        return view('pages.virtual-reality');
    })->name('virtual-reality')->middleware('checkRole:admin');

    Route::get('static-sign-in', function () {
        return view('pages.static-sign-in');
    })->name('static-sign-in');
    Route::get('static-sign-up', function () {
        return view('pages.static-sign-up');
    })->name('static-sign-up');
    Route::get('user-management', [RegisterController::class, 'index', 'accederATabla'])->name('user-management')->middleware('checkRole:admin');
    Route::get('user-profile', [MensajeUserController::class, 'mostrar'])->name('user-profile');



    Route::get('tables', [DenuncianteController::class, 'index'])->name('tables')->middleware('checkRole:admin,empleado');

    Route::get('denunciantes/{id}/edit', [DenuncianteController::class, 'edit'])->name('denunciantes.edit')->middleware('checkRole:admin');
    Route::put('denunciantes/{denunciante}', [DenuncianteController::class, 'update'])->name('denunciantes.update')->middleware('checkRole:admin');


    Route::get('editar_denunciante', function () {
        return view('pages.editar_denunciante');
    })->name('editar_denunciante')->middleware('checkRole:admin');

    Route::post('editar-denunciante', [DenuncianteController::class, 'store'])->middleware('auth')->middleware('checkRole:admin');



    //rutas paara oficial
    Route::post('oficial-register', [OficialController::class, 'store'])->middleware('auth')->middleware('checkRole:admin');
    Route::get('oficiales', [OficialController::class, 'index'])->name('mostrar_oficial')->middleware('checkRole:admin');
    Route::put('oficiales/update/{id}', [OficialController::class, 'update'])->name('actualizar_oficial')->middleware('checkRole:admin');
    Route::get('oficiales/edit/{id}', [OficialController::class, 'edit'])->name('editar_oficial')->middleware('checkRole:admin');

    //usuario
    Route::delete('oficiales/destroy/{id}', [RegisterController::class, 'destroy'])->name('eliminar_usuario');

    //ruta pra fiscal
    Route::post('agregar-fiscal', [FiscalController::class, 'store'])->middleware('auth')->middleware('checkRole:admin');
    Route::get('fiscales', [FiscalController::class, 'index'])->name('mostrar_fiscal')->middleware('checkRole:admin');
    Route::put('fiscales/update/{id}', [FiscalController::class, 'update'])->name('actualizar_fiscal')->middleware('checkRole:admin');
    Route::get('fiscales/edit/{id}', [FiscalController::class, 'edit'])->name('editar_fiscal')->middleware('checkRole:admin');

    //ruta para delito
    Route::post('agregar-delito', [DelitoController::class, 'store'])->middleware('auth')->name('agregarDelito')->middleware('checkRole:admin');
    Route::get('delito', [DelitoController::class, 'index'])->name('mostrar_delito')->middleware('checkRole:admin');
    Route::put('delito/update/{id}', [DelitoController::class, 'update'])->name('actualizar_delito')->middleware('checkRole:admin');
    Route::get('delito/edit/{id}', [DelitoController::class, 'edit'])->name('editar_delito')->middleware('checkRole:admin');


    Route::get('registrar-denuncia', [DenunciaController::class, 'mostrarDelito'])->name('mostrarDelito');
    //denuncia

    Route::get('denuncias', [DenunciaController::class, 'mostrar'])->name('mostrar_denuncia')->middleware('checkRole:admin,empleado');
    Route::post('registrar-denuncia', [DenunciaController::class, 'registrarDenuncia']);

    //mostrar delitos
    Route::get('mostrar-delito', [DenunciaController::class, 'mostrarDelito'])->name('mostrarDelito')->middleware('checkRole:admin');

    //detalle de la denuncia
    Route::get('/denuncias/detalle/{id}', [DenunciaController::class, 'detalleDen'])->name('detalle_den')->middleware('checkRole:admin,empleado');
    Route::put('denuncias/detalle/{id}', [DenunciaController::class, 'detalleUpdate'])->name('detalleDen.update')->middleware('checkRole:admin,empleado');

    //para ver la denuncia de la notificacion
    Route::get('/denuncias/{id}', [DenunciaController::class, 'show'])->name('mostrarDenunciaNot')->middleware('checkRole:empleado');
    Route::put('denuncias/{id}', [DenunciaController::class, 'update'])->name('denuncias.update')->middleware('checkRole:empleado');



    //rol
    Route::get('rol', [RoleController::class, 'showAssignRoleForm'])->name('asignar_rol')->middleware('checkRole:admin');
    Route::post('assign-role', [RoleController::class, 'assignRole'])->name('agregar_rol')->middleware('checkRole:admin');

    //notifcacion
    Route::get('notificaciones', [NotificationController::class, 'index'])->name('notifications')->middleware('checkRole:empleado');
    Route::get('notificaciones/{id}', [NotificationController::class, 'show'])->name('notificaciones.show')->middleware('checkRole:empleado');

    //mail
    //Route::get('/send-test-email', [MailController::class, 'sendTestEmail']);



    //PDF
    Route::get('denuncia/{id}/pdf', 'App\Http\Controllers\DenunciaController@generarPDF')->name('denuncia.pdf')->middleware('checkRole:empleado,admin');

    //historial
    Route::get('historial', [DenunciaController::class, 'historial'])->name('historial')->middleware('checkRole:usuario');
    Route::get('historial/detalle/{id}', [DenunciaController::class, 'detalleHistorial'])->name('detalle_historial')->middleware('checkRole:usuario');

    //correo felcc.com
    Route::get('/contacto', [ContactoController::class, 'index'])->name('email_admin')->middleware('checkRole:admin');
    Route::post('/contacto', [ContactoController::class, 'store'])->name('contactoStore')->middleware('checkRole:admin');
    Route::get('/correoOficial', [ContactoController::class, 'correoOficial'])->name('mensajesOficial')->middleware('checkRole:admin');



    //victimas
    // Route::get('victima', [VictimaController::class, 'mostrar'])->name('mostrar_victima')->middleware('checkRole:admin|empleado');

    //buscar denuncia
    Route::get('/buscar_denuncia', [DenunciaController::class, 'buscarDenuncia'])->name('buscar_denuncia');

    //ver mensajes
    Route::get('/mensajeUser/{id}', [MensajeUserController::class, 'show'])->name('mensajeUser.show');
    Route::post('/mensajeUser/{id}/markAsRead', [MensajeUserController::class, 'markAsRead'])->name('mensajeUser.markAsRead');
    Route::get('/mensajesUser', [MensajeUserController::class, 'mostrar'])->name('mensajesUser');

    //crear backup
    Route::get('/backup', [BackupController::class, 'index'])->name('backup.index')->middleware('checkRole:admin');
    Route::get('/backup/create', [BackupController::class, 'createBackup'])->name('backup.create')->middleware('checkRole:admin');

    //registrar usuario empleado
    Route::get('/empleado', [UsuarioEmpController::class, 'index'])->name('mostrar_UserEmpleado')->middleware('checkRole:admin');
    Route::post('/empleado/create', [UsuarioEmpController::class, 'store'])->name('empleado.create')->middleware('checkRole:admin');
    // Ruta para mostrar el formulario de edición de un usuario específico
    Route::get('/empleado/edit/{id}', [UsuarioEmpController::class, 'edit'])->name('empleado.edit')->middleware('checkRole:admin');

    // Ruta para actualizar los datos de un usuario específico
    Route::put('/empleado/update/{id}', [UsuarioEmpController::class, 'update'])->name('empleado.update')->middleware('checkRole:admin');

});
