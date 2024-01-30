<?php

use App\Http\Controllers\CorrectionController;
use App\Http\Controllers\CourController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DomaineController;
use App\Http\Controllers\EpreuveController;
use App\Http\Controllers\ExerciceController;
use App\Http\Controllers\MatiereController;
use App\Http\Controllers\NiveauController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\SiteController;

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

// Route::get('/ex', function () {
//     return view('DASHBOARD/PAGES/createExercice');
// });



Route::get('/', function () {
    return view('auth.login');
});
Route::get('/a', function () {
    return view('SITE.PAGES.accueil');
});

// Authentification et vérification de compte

Auth::routes(['verify' => true] );

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('home');

// routes de domaine
Route::middleware('auth')->group(function () {
    Route::get('/admin/layout/domaine/create',[DomaineController::class, 'create'])->name('domaines.create');
    Route::post('/admin/layout/domaine/store',[DomaineController::class, 'store'])->name('domaines.store');
    Route::get('/admin/layout/domaine/index',[DomaineController::class, 'index'])->name('domaines.index');
    Route::get('/admin/layout/domaine/destroy/{id}',[DomaineController::class, 'destroy'])->name('domaines.destroy');
    Route::get('/admin/layout/domaine/edit/{id}',[DomaineController::class, 'edit'])->name('domaines.edit');
    Route::put('/admin/layout/domaine/update/{id}',[DomaineController::class, 'update'])->name('domaines.update');
});

//routes de niveau
Route::middleware('auth')->group(function () {
    Route::get('/admin/layout/niveau/create',[NiveauController::class, 'create'])->name('niveaux.create');
    Route::post('/admin/layout/niveau/store',[NiveauController::class, 'store'])->name('niveaux.store');
    Route::get('/admin/layout/niveau/index',[NiveauController::class, 'index'])->name('niveaux.index');
    Route::get('/admin/layout/niveau/destroy/{id}',[NiveauController::class, 'destroy'])->name('niveaux.destroy');
    Route::get('/admin/layout/niveau/edit/{id}',[NiveauController::class, 'edit'])->name('niveaux.edit');
    Route::put('/admin/layout/niveau/update/{id}',[NiveauController::class, 'update'])->name('niveaux.update');
});

//routes de matiere
Route::middleware('auth')->group(function () {
    Route::get('/admin/layout/matiere/create',[MatiereController::class, 'create'])->name('matieres.create');
    Route::post('/admin/layout/matiere/store',[MatiereController::class, 'store'])->name('matieres.store');
    Route::get('/admin/layout/matiere/index',[MatiereController::class, 'index'])->name('matieres.index');
    Route::get('/admin/layout/matiere/destroy/{id}',[MatiereController::class, 'destroy'])->name('matieres.destroy');
    Route::get('/admin/layout/matiere/edit/{id}',[MatiereController::class, 'edit'])->name('matieres.edit');
    Route::put('/admin/layout/matiere/update/{id}',[MatiereController::class, 'update'])->name('matieres.update');
});

//routes de cours
Route::middleware('auth')->group(function () {
    Route::get('/admin/layout/cours/create',[CourController::class, 'create'])->name('cours.create');
    Route::post('/admin/layout/cours/store',[CourController::class, 'store'])->name('cours.store');
    Route::get('/admin/layout/cours/index',[CourController::class, 'index'])->name('cours.index');
    Route::get('/admin/layout/cours/destroy/{id}',[CourController::class, 'destroy'])->name('cours.destroy');
    Route::get('/admin/layout/cours/edit/{id}',[CourController::class, 'edit'])->name('cours.edit');
    Route::put('/admin/layout/cours/update/{id}',[CourController::class, 'update'])->name('cours.update');
    // Route::get('/admin/layout/cours/show/{id}',[CourController::class, 'show'])->name('cours.show');
});

//routes de epreuve
Route::middleware('auth')->group(function () {
    Route::get('/admin/layout/epreuves/create',[EpreuveController::class, 'create'])->name('epreuves.create');
    Route::post('/admin/layout/epreuves/store',[EpreuveController::class, 'store'])->name('epreuves.store');
    Route::get('/admin/layout/epreuves/index',[EpreuveController::class, 'index'])->name('epreuves.index');
    Route::get('/admin/layout/epreuves/destroy/{id}',[EpreuveController::class, 'destroy'])->name('epreuves.destroy');
    Route::get('/admin/layout/epreuves/edit/{id}',[EpreuveController::class, 'edit'])->name('epreuves.edit');
    Route::put('/admin/layout/epreuves/update/{id}',[EpreuveController::class, 'update'])->name('epreuves.update');
});

//routes de exercice
Route::middleware('auth')->group(function () {
    Route::get('/admin/layout/exercices/create',[ExerciceController::class, 'create'])->name('exercices.create');
    Route::post('/admin/layout/exercices/store',[ExerciceController::class, 'store'])->name('exercices.store');
    Route::get('/admin/layout/exercices/index',[ExerciceController::class, 'index'])->name('exercices.index');
    Route::get('/admin/layout/exercices/destroy/{id}',[ExerciceController::class, 'destroy'])->name('exercices.destroy');
    Route::get('/admin/layout/exercices/edit/{id}',[ExerciceController::class, 'edit'])->name('exercices.edit');
    Route::put('/admin/layout/exercices/update/{id}',[ExerciceController::class, 'update'])->name('exercices.update');
});

//routes de correction
Route::middleware('auth')->group(function () {
    Route::get('/admin/layout/corrections/create/{id}',[CorrectionController::class, 'create'])->name('corrections.create');
    Route::get('/admin/layout/corrections/create2/{id}',[CorrectionController::class, 'create2'])->name('corrections.create2');
    Route::post('/admin/layout/corrections/store/{id}',[CorrectionController::class, 'store'])->name('corrections.store');
    Route::post('/admin/layout/corrections/store2/{id}',[CorrectionController::class, 'store2'])->name('corrections.store2');
    Route::get('/admin/layout/corrections/index',[CorrectionController::class, 'index'])->name('corrections.index');
    Route::get('/admin/layout/corrections/destroy/{id}',[CorrectionController::class, 'destroy'])->name('corrections.destroy');
    Route::get('/admin/layout/corrections/edit/{id}',[CorrectionController::class, 'edit'])->name('corrections.edit');
    Route::put('/admin/layout/corrections/update/{id}',[CorrectionController::class, 'update'])->name('corrections.update');
});

//routes de accueil
Route::get('/site/layout/accueil/',[SiteController::class, 'indexAccueil'])->name('accueils.indexAccueil');
Route::get('/site/layout/accueil2/',[SiteController::class, 'indexAccueilCours'])->name('accueils.indexAccueilCours');
Route::get('/site/layout/accueil3/',[SiteController::class, 'indexAccueilDevoir'])->name('accueils.indexAccueilDevoir');
Route::get('/site/layout/accueil4/',[SiteController::class, 'indexAccueilDevoir2'])->name('accueils.indexAccueilDevoir2');
Route::get('/site/layout/accueil5/{id}',[SiteController::class, 'indexAccueilCoursDetail'])->name('accueils.indexAccueilCoursDetail');
Route::get('/site/layout/accueil6/{id}',[SiteController::class, 'indexAccueilDevoirDetail'])->name('accueils.indexAccueilDevoirDetail');
Route::get('/site/layout/accueil7/{id}',[SiteController::class, 'indexAccueilDevoirDetail2'])->name('accueils.indexAccueilDevoirDetail2');

Route::middleware('auth')->group(function () {
    Route::post('/fedapay-webhookCours', [PaiementController::class, 'webhook'])->name('fedapay.webhook');
    // Route::post('/fedapay-webhookEpreuve', [PaiementController::class, 'webhook2'])->name('fedapay.webhook2');
});

