<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NotificationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. HALAMAN DEPAN (LANDING PAGE)
// 🔥 PERBAIKAN: Logika harus di dalam Route::get, gak boleh telanjang di luar.
Route::get('/', function () {
    // Ambil 3 event terbaru aja buat pajangan di Home
    $latestEvents = Event::with('organizer')->latest()->take(3)->get();

    // Hitung statistik buat pamer
    $stats = [
        'events' => Event::count(),
        'volunteers' => \App\Models\User::where('role', 'volunteer')->count(),
        'organizers' => \App\Models\User::where('role', 'organizer')->count(),
    ];

    return view('welcome', compact('latestEvents', 'stats'));
});

// 2. AUTHENTICATION (Login/Register)
Auth::routes();

// 3. PUBLIC EVENT LIST (Index aman ditaruh diatas)
Route::get('/events', [EventController::class, 'index'])->name('events.index');

// 4. GROUP MIDDLEWARE (Harus Login)
Route::middleware(['auth'])->group(function () {

    // 🔥 PERBAIKAN: Pakai HomeController biar Dashboard Statistik Organizer muncul!
    // Kalau pakai function redirect doang, fitur dashboard yang kita capek-capek bikin gak bakal kelihatan.
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // --- CRUD EVENT (ORGANIZER) ---
    // PENTING: 'create' harus dibaca duluan sebelum '{event}'
    Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::get('/organizer/events', [EventController::class, 'myEvents'])->name('organizer.events');

    // Edit & Update & Delete
    Route::post('/events/{event}/cancel', [ApplicationController::class, 'cancelEvent'])->name('events.cancel');
    Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::put('/events/{event}', [EventController::class, 'update'])->name('events.update');
    Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');

    // --- APPLICATION ROUTES ---
    Route::post('/events/{id}/apply', [ApplicationController::class, 'store'])->name('applications.store');
    Route::patch('/applications/{application}', [ApplicationController::class, 'updateStatus'])->name('applications.update');
    Route::get('/my-applications', [ApplicationController::class, 'history'])->name('applications.history');

    // Chat Message Route
    Route::post('/applications/{application}/message', [ApplicationController::class, 'sendMessage'])->name('applications.message');

    // -- ADMIN DASHBOARD ---
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::delete('/admin/users/{user}', [AdminController::class, 'deleteUser'])->name('admin.user.delete');
    Route::delete('/admin/events/{event}', [AdminController::class, 'deleteEvent'])->name('admin.event.delete');
    Route::prefix('admin')->name('admin.')->group(function () {
        // Dashboard (Sudah ada)
        Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'index'])->name('dashboard');

        // Kelola Users
        Route::get('/users', [App\Http\Controllers\AdminController::class, 'manageUsers'])->name('users');
        Route::delete('/users/{id}', [App\Http\Controllers\AdminController::class, 'deleteUser'])->name('user.delete');

        // Kelola Events
        Route::get('/events', [App\Http\Controllers\AdminController::class, 'manageEvents'])->name('events');
        Route::delete('/events/{id}', [App\Http\Controllers\AdminController::class, 'deleteEvent'])->name('event.delete');
    });
    // --- PROFILE SETTINGS ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // --- NOTIFICATION READ ---
    Route::get('/notifications/{id}', function ($id) {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $notification = $user->notifications()->findOrFail($id);
        $notification->markAsRead();

        return redirect($notification->data['url']);
    })->name('notifications.read');
});

// 5. PUBLIC DETAIL EVENT (WILDCARD)
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');

Route::get('/applications/{application}/message', function () {
    return back()->with('warning', 'Eits, jangan refresh halaman saat kirim pesan ya!');
});
// Pesan udah dikirim di belakang kok :) Silakan lanjutkan chatting.

Route::post('/notifications/mark-all-read', [App\Http\Controllers\NotificationController::class, 'markAllRead'])->name('notifications.readAll');
Route::middleware(['auth'])->group(function () {
    // Route untuk tombol "Tandai semua dibaca"
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllRead'])
        ->name('notifications.readAll');

    // Route untuk klik satu notifikasi (opsional, jika pakai link khusus)
    Route::get('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])
        ->name('notifications.read');
    // Route untuk tandai chat sudah dibaca
    Route::post('/applications/{application}/mark-read', [App\Http\Controllers\ApplicationController::class, 'markChatRead'])->name('applications.markRead');
});

Route::get('/applications/{application}/certificate', [ApplicationController::class, 'certificate'])->name('applications.certificate');

// Route Cetak Sertifikat
Route::get('/certificate/{application}', [App\Http\Controllers\ApplicationController::class, 'printCertificate'])
    ->name('certificate.print');
// ==========================================

// Route Darurat buat benerin akun
Route::get('/fix-my-role', function() {
    $user = \App\Models\User::where('email', 'organizer@volunteam.com')->first();
    if($user) {
        $user->role = 'organizer';
        $user->save();
        return "Role updated to Organizer! Silakan login ulang.";
    }
    return "User not found.";
});