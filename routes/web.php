<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Site\HomeController;
use \App\Http\Controllers\Site\RegisterController;
use \App\Http\Controllers\Site\AuthController;
use \App\Http\Controllers\Admin\DashboardController;
use \App\Http\Controllers\Admin\Offers\OffersController;
use \App\Http\Controllers\Admin\Employee\EmployeeController;
use \App\Http\Controllers\Admin\Affiliates\AffiliatesController;
use \App\Http\Controllers\Admin\Shippers\ShipperController;
use \App\Http\Controllers\Admin\Bids\BidController;
use \App\Http\Middleware\AuthEmployee;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware(['guest:employees', 'prevent-back-history'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/cadastrar', [RegisterController::class, 'registerAccount'])->name('register.account');
    Route::post('/cadastrar/do', [RegisterController::class, 'doRegisterAccount'])->name('register.account.do');
});

// Admin Routes
Route::post('/doLogin', [AuthController::class, 'doLogin'])->name('admin.doLogin');

Route::middleware(['auth.employee', 'prevent-back-history'])->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/dashboard/cadastrar-funcionario', [EmployeeController::class, 'index'])->name('admin.dashboard.employees.create');
    Route::post('/dashboard/cadastrar-funcionarios/cadastrar', [EmployeeController::class, 'storeEmployees'])->name('admin.dashboard.employees.store');
    Route::get('/dashboard/funcionarios', [EmployeeController::class, 'showEmployees'])->name('admin.dashboard.employees.show');
    Route::get('/dashboard/editar-funcionarios/{id}', [EmployeeController::class, 'editEmployees'])->name('admin.dashboard.employees.edit');
    Route::get('/dashboard/apagar-funcionarios/delete/{id}', [EmployeeController::class, 'deleteEmployees'])->name('admin.dashboard.employees.delete');
    Route::post('/dashboard/editar-funcionarios/editar/{id}', [EmployeeController::class, 'updateEmployees'])->name('admin.dashboard.employees.update');
    Route::get('/logout', [AuthController::class, 'logout'])->name('admin.logout');
});

Route::middleware(['auth.employee', 'prevent-back-history', 'can:embarcadora'])->group(function(){
    Route::get('/dashboard/cadastrar-oferta', [OffersController::class, 'index'])->name('admin.dashboard.offers.create');
    Route::get('/dashboard/editar-oferta/{id}', [OffersController::class, 'editOffers'])->name('admin.dashboard.offers.edit');
    Route::post('/dashboard/editar-oferta/editar/{id}', [OffersController::class, 'updateOffers'])->name('admin.dashboard.offers.update');
    Route::get('/dashboard/apagar-oferta/delete/{id}', [OffersController::class, 'deleteOffers'])->name('admin.dashboard.offers.delete');
    Route::post('/dashboard/cadastrar-oferta/cadastrar', [OffersController::class, 'registerOffers'])->name('admin.dashboard.offers.store');
    Route::get('/dashboard/ofertas', [OffersController::class, 'showOffers'])->name('admin.dashboard.offers.show');
    Route::get('/dashboard/afiliados', [AffiliatesController::class, 'index'])->name('admin.dashboard.affiliates');
    Route::get('/dashboard/lances', [BidController::class, 'showBid'])->name('admin.dashboard.bid.show');
    Route::get('/dashboard/lances/definir-vencedor/{id}', [BidController::class, 'defineWinner'])->name('admin.dashboard.bid.defineWinner');
});

Route::middleware(['auth.employee', 'prevent-back-history', 'can:transportadora'])->group(function(){
    Route::get('/dashboard/embarcadoras', [ShipperController::class, 'index'])->name('admin.dashboard.shipper.show');
    Route::get('/dashboard/embarcadoras/afiliar/{id}', [ShipperController::class, 'storeAffiliation'])->name('admin.dashboard.shipper.store');
    Route::get('/dashboard/embarcadoras/afiliar/delete/{id}', [ShipperController::class, 'deleteAffiliation'])->name('admin.dashboard.shipper.delete');
    Route::get('/dashboard/ver-ofertas', [OffersController::class, 'seeOffers'])->name('admin.dashboard.shipper.see-offers');
    Route::get('/dashboard/adicionar-lance/{id}', [BidController::class, 'addBid'])->name('admin.dashboard.bid.add');
    Route::post('/dashboard/adicionar-lance/cadastrar/{id}', [BidController::class, 'storeBid'])->name('admin.dashboard.bid.add');
    Route::get('/dashboard/minhas-ofertas', [OffersController::class, 'winnerOffers'])->name('admin.dashboard.shipper.winnerOffers');
});
