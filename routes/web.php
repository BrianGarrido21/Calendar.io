<?php

use App\Http\Controllers\Api\EventController as ApiEventController;
use App\Http\Controllers\Api\TagController as ApiTagController;
use App\Http\Controllers\Api\TaskController as ApiTaskController;
use App\Http\Controllers\Api\UserController as ApiUserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\CollaborationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',

])->group(function () {

    // ---------------- API ----------------
    Route::prefix('api')->group(function () {
        Route::apiResource('tags', ApiTagController::class);
        Route::apiResource('tasks', ApiTaskController::class);

        // API collaborations (no tocamos aquí)
        Route::post('events/{event}/collaborations', [ApiEventController::class, 'storeCollaboration']);
        Route::put('events/{event}/collaborations/{collaboration}', [ApiEventController::class, 'updateCollaboration']);
        Route::delete('events/{event}/collaborations/{collaboration}', [ApiEventController::class, 'destroyCollaboration']);
        Route::apiResource('users', ApiUserController::class);
        Route::apiResource('events', ApiEventController::class);
    });

    // ---------------- Dashboard / Calendar ----------------
    Route::get('/', [CalendarController::class, 'index'])->name('calendar.index');

    // ---------------- Eventos ----------------
    Route::resource('events', EventController::class)
        // ⛔️ Proteger sólo las rutas de edición, actualización y borrado para el propietario
        ->except(['index', 'show', 'create', 'store'])
        ->middleware('owner');

    // La creación y almacenamiento de eventos sí pueden ser generales (sin 'owner')
    Route::get('events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('events', [EventController::class, 'store'])->name('events.store');
    Route::get('events', [EventController::class, 'index'])->name('events.index');
    Route::get('events/{event}', [EventController::class, 'show'])->name('events.show');

    // ---------------- Collaboraciones ----------------
    // ⚠️ Proteger la gestión de colaboraciones (añadir, eliminar, actualizar) para el propietario
    Route::middleware('owner')->group(function () {
        Route::get('/events/{event}/collaborations', [CollaborationController::class, 'createCollaborations'])->name('events.createCollaborations');
        Route::post('/events/{event}/collaborations', [CollaborationController::class, 'storeCollaboration'])->name('events.storeCollaboration');
        Route::put('/events/{event}/collaborations/{collaboration}', [EventController::class, 'updateCollaboration'])->name('events.updateCollaboration');
    });

    // ---------------- Tareas ----------------
    // ⚠️ Proteger edición, actualización y borrado para el propietario del evento
    Route::resource('tasks', TaskController::class)
        ->except(['index', 'show', 'create', 'store'])
        ->middleware('owner');

    // Las rutas de creación, almacenamiento, listado y visualización de tareas están abiertas a usuarios autenticados
    Route::get('tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('tasks/{task}', [TaskController::class, 'show'])->name('tasks.show');


    // ---------------- Usuarios ---------------

    Route::middleware('is_admin')->group(function () {
        Route::resource('users', UserController::class);
        Route::resource('tags', TagController::class);
    });

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});
