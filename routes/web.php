<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CategoryController;

// ============ ROUTES PUBLIQUES (SANS AUTHENTIFICATION) ============

// Middleware 'guest': accessible SEULEMENT si non connecté
Route::middleware('guest')->group(function () {
    
    // Register: affiche et traite l'inscription
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    
    // Login: affiche et traite la connexion
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// ============ ROUTES PROTÉGÉES (AUTHENTIFICATION REQUISE) ============

// Middleware 'auth': accessible SEULEMENT si connecté
Route::middleware('auth')->group(function () {
    
    // Logout: déconnecte l'utilisateur
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Dashboard: page d'accueil connectée
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    
    // Affiche tous les événements (avec recherche et filtre)
    Route::get('/events', [EventController::class, 'index'])->name('events.index');
    
    // Affiche les détails d'un événement
    Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');
    
    // S'inscrire à un événement
    Route::post('/events/{event}/register', [EventController::class, 'register'])->name('events.register');
    
    // Se désinscrire d'un événement
    Route::post('/events/{event}/unregister', [EventController::class, 'unregister'])->name('events.unregister');
    
    // Affiche mes inscriptions
    Route::get('/my-registrations', [EventController::class, 'myRegistrations'])->name('events.my-registrations');
    
    // ============ ROUTES ADMIN ============
    
    // Middleware 'auth' + contrôle admin manuellement
    Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
        
        // ============ GESTION DES CATÉGORIES ============
        
        // Affiche toutes les catégories
        Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
        
        // Affiche le formulaire de création
        Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
        
        // Traite la création
        Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
        
        // Affiche le formulaire de modification
        Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        
        // Traite la modification
        Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
        
        // Supprime une catégorie
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
        
        // ============ GESTION DES ÉVÉNEMENTS ============
        
        // Affiche tous les événements (admin)
        Route::get('/events', [EventController::class, 'adminIndex'])->name('events.index');
        
        // Affiche le formulaire de création
        Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
        
        // Traite la création
        Route::post('/events', [EventController::class, 'store'])->name('events.store');
        
        // Affiche le formulaire de modification
        Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
        
        // Traite la modification
        Route::put('/events/{event}', [EventController::class, 'update'])->name('events.update');
        
        // Supprime un événement
        Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');

        // ============ GESTION DES INSCRIPTIONS ==========
        Route::get('/registrations', [EventController::class, 'adminRegistrations'])->name('registrations.index');
    });
});

// ============ ROUTE ACCUEIL ============

// Page d'accueil (accessible sans authentification) - Affiche tous les événements
Route::get('/', [EventController::class, 'homeIndex'])->name('home');
