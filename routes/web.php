<?php

use App\Http\Controllers\AnnonceController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Models\Annonce;

Route::get('/', function () {
    return view('home', [
        'dernieresAnnonces' => Annonce::with('imagePrincipale')
            ->where('statut', 'active')
            ->latest()
            ->take(3)
            ->get(),
        'totalAnnonces' => Annonce::where('statut', 'active')->count(),
        'totalVilles' => Annonce::where('statut', 'active')->distinct('ville')->count('ville'),
        'categories' => [
            'maison' => 'Maisons',
            'appartement' => 'Appartements',
            'terrain' => 'Terrains',
            'boutique' => 'Boutiques',
        ],
    ]);
});

// Visible par tout le monde (visiteurs et connectés)
Route::get('annonces', [AnnonceController::class, 'index'])->name('annonces.index');
Route::get('annonces/{annonce}', [AnnonceController::class, 'show'])->name('annonces.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Réservé aux utilisateurs connectés
    Route::get('annonces/create', [AnnonceController::class, 'create'])->name('annonces.create');
    Route::post('annonces', [AnnonceController::class, 'store'])->name('annonces.store');
    Route::get('annonces/{annonce}/edit', [AnnonceController::class, 'edit'])->name('annonces.edit');
    Route::put('annonces/{annonce}', [AnnonceController::class, 'update'])->name('annonces.update');
    Route::delete('annonces/{annonce}', [AnnonceController::class, 'destroy'])->name('annonces.destroy');
});

require __DIR__ . '/auth.php';
