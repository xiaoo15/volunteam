<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;   // Tambahan Import
use App\Http\Controllers\ProfileController; // Tambahan Import
use App\Http\Controllers\NotificationController; // Tambahan Import

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. HALAMAN DEPAN
Route::get('/', [EventController::class, 'index'])->name('root');

// 2. AUTHENTICATION (Login/Register)
Auth::routes();

// 3. PUBLIC EVENT LIST (Index aman ditaruh diatas)
Route::get('/events', [EventController::class, 'index'])->name('events.index');

// 4. GROUP MIDDLEWARE (Harus Login)
Route::middleware(['auth'])->group(function () {

    Route::get('/home', function () {
        return redirect()->route('events.index');
    })->name('home');

    // --- CRUD EVENT (ORGANIZER) ---
    // PENTING: 'create' harus dibaca duluan sebelum '{event}'
    Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::get('/organizer/events', [EventController::class, 'myEvents'])->name('organizer.events');

    // Edit & Update & Delete
    Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::put('/events/{event}', [EventController::class, 'update'])->name('events.update');
    Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');

    // --- APPLICATION ROUTES ---
    Route::post('/events/{id}/apply', [ApplicationController::class, 'store'])->name('applications.store');
    Route::patch('/applications/{application}', [ApplicationController::class, 'updateStatus'])->name('applications.update');
    Route::get('/my-applications', [ApplicationController::class, 'history'])->name('applications.history');
    Route::get('/certificate/{application}', [ApplicationController::class, 'generateCertificate'])->name('certificate.download');

    // -- ADMIN DASHBOARD ---
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::delete('/admin/users/{user}', [AdminController::class, 'deleteUser'])->name('admin.user.delete');
    Route::delete('/admin/events/{event}', [AdminController::class, 'deleteEvent'])->name('admin.event.delete');

    // --- PROFILE SETTINGS ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // --- NOTIFICATION READ ---
    Route::get('/notifications/{id}', function ($id) {
        /** @var \App\Models\User $user */ // <--- TAMBAHAN AJAIB BIAR EDITOR GAK MERAH
        $user = Auth::user();

        $notification = $user->notifications()->findOrFail($id);
        $notification->markAsRead(); 
        
        return redirect($notification->data['url']); 
    })->name('notifications.read');
});

// 5. PUBLIC DETAIL EVENT (WILDCARD)
// Taruh PALING BAWAH biar gak "makan" route lain (kayak /create atau /edit)
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');
