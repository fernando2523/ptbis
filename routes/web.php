<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\asset\AssetController;
use App\Http\Controllers\fuel\FuelController;
use App\Http\Controllers\fuel\FuelTakeController;
use App\Http\Controllers\fuel\FuelRefillController;
use App\Http\Controllers\vehicle\VehicleController;
use App\Http\Controllers\location\LocationController;
// use App\Http\Controllers\land\LandOwnerController;
use App\Http\Controllers\hauling\HaulingController;
use App\Http\Controllers\barging\BargingController;
use App\Http\Controllers\employee\EmployeeController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\preparation\PreparationController;
use App\Http\Controllers\hourmeter\HourmeterController;
use App\Http\Controllers\stockore\StockoreController;
use App\Http\Controllers\production\ProductionController;
use App\Http\Controllers\vendor\VendorController;
use App\Http\Controllers\daily\DailyActivityController;

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

Route::get('/', function () {

    return view('login');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
Route::any('/load_data', [App\Http\Controllers\HomeController::class, 'load_data']);
Route::any('/load_data_barging', [App\Http\Controllers\HomeController::class, 'load_data_barging']);

Route::any('/load_hauling', [App\Http\Controllers\hauling\HaulingController::class, 'load_hauling']);
Route::any('/load_barging', [App\Http\Controllers\barging\BargingController::class, 'load_barging']);

Route::any('/load_production', [ProductionController::class, 'load_production']);
// Route::get('dashboard', [DashboardController::class, 'index'])->middleware('auth');
// Asset ROUTE
// route::get('/register', [RegisterController::class, 'register'])->name('register');
route::any('/setting/changepassword/{id}', [ChangePasswordController::class, 'changepassword'])->middleware('auth');
route::any('/setting/editsetting/{id}', [ChangePasswordController::class, 'editsetting'])->middleware('auth');
route::get('/setting/setting', [ChangePasswordController::class, 'setting'])->middleware('auth');

route::get('/asset', [AssetController::class, 'assets'])->middleware('auth');

route::any('/asset/assets', [AssetController::class, 'store'])->middleware('auth');
route::resource('assets', AssetController::class)->middleware('auth');


route::any('/assets/{id}', [AssetController::class, 'store'])->middleware('auth');
Route::get('/datatable', [AssetController::class, 'datatable'])->middleware('auth');
route::any('/restock/{id}', [AssetController::class, 'update']);
route::any('/outstockact/{id}', [AssetController::class, 'outstockact'])->middleware('auth');
route::any('/editact/{id}', [AssetController::class, 'editact'])->middleware('auth');
route::any('/edithistoryact/{id}', [AssetController::class, 'edithistoryact'])->middleware('auth');
// route::any('/outstock/{id}', [AssetController::class, 'outstock']);
route::any('/destroy/{id}', [AssetController::class, 'destroy'])->middleware('auth');
route::any('/destroyhistory/{id}', [AssetController::class, 'destroyhistory'])->middleware('auth');
route::get('/asset/history', [AssetController::class, 'historyasset'])->middleware('auth');
Route::get('/datatablehistory', [AssetController::class, 'datatablehistory'])->middleware('auth');

// // History ROUTE
// route::get('/assets-history', [AssetHistoryController::class, 'assetshistory']);
// // route::get('/create', [AssetHistoryController::class, 'create']);
// route::resource('assetshistory', AssetHistoryController::class);
// // route::any('/edit/{id}', [AssetHistoryController::class, 'edit']);

// FUEL ROUTE
route::any('/fuel/fuel', [FuelController::class, 'store'])->middleware('auth');
route::get('/fuel', [FuelController::class, 'fuel'])->middleware('auth');
Route::get('/datatablefuel', [FuelController::class, 'datatablefuel'])->middleware('auth');
Route::get('/datatablefuelhistory', [FuelController::class, 'datatablefuelhistory'])->middleware('auth');
route::get('/fuel/history', [FuelController::class, 'historyasset'])->middleware('auth');
route::any('/fuel/restock/{id}', [FuelController::class, 'update'])->middleware('auth');
route::any('/fuel/retur/{id}', [FuelController::class, 'retur'])->middleware('auth');
route::any('/fuel/outstockact', [FuelController::class, 'outstockact'])->middleware('auth');
route::any('/fuel/editact/{id}', [FuelController::class, 'editact'])->middleware('auth');
route::any('/fuel/destroy/{id}', [FuelController::class, 'destroy'])->middleware('auth');
route::any('/fuel/edithistoryact/{id}', [FuelController::class, 'edithistoryact'])->middleware('auth');
route::any('/fuel/destroyhistory/{id}', [FuelController::class, 'destroyhistory'])->middleware('auth');

route::get('/fuel-delivery', [FuelTakeController::class, 'fueldelivery'])->middleware('auth');
Route::get('/datatablefuel_stocker', [FuelTakeController::class, 'datatablefuel_stocker'])->middleware('auth');
Route::get('/datatablefuel_sender', [FuelTakeController::class, 'datatablefuel_sender'])->middleware('auth');
Route::get('/datatablefuel_receiver', [FuelTakeController::class, 'datatablefuel_receiver'])->middleware('auth');
route::any('/store', [FuelTakeController::class, 'store'])->middleware('auth');
route::any('/fueldelivery/destroy/{id}', [FuelTakeController::class, 'destroy'])->middleware('auth');
// route::any('/update/{id_stock}', [FuelTakeController::class, 'update']);
Route::any('/load_barcode/{qr_code}', [FuelTakeController::class, 'load_barcode'])->middleware('auth');

route::get('/fuel-refill', [FuelRefillController::class, 'fuelrefill'])->middleware('auth');
Route::get('/datatablefuel_refill', [FuelRefillController::class, 'datatablefuel_refill'])->middleware('auth');
route::any('/fuel-refill/store', [FuelRefillController::class, 'store'])->middleware('auth');
route::any('/fuel-refill/destroy/{id}', [FuelRefillController::class, 'destroy'])->middleware('auth');

route::get('/vehicle/vehicles', [VehicleController::class, 'vehicle'])->middleware('auth');
Route::get('/datatablevehicle', [VehicleController::class, 'datatablevehicle'])->middleware('auth');
Route::get('/datatablevehicle_exp', [VehicleController::class, 'datatablevehicle_exp'])->middleware('auth');
Route::get('/datatablevehicle_hour', [VehicleController::class, 'datatablevehicle_hour'])->middleware('auth');
Route::get('/datatablevehicle_ritase', [VehicleController::class, 'datatablevehicle_ritase'])->middleware('auth');
route::any('/vehicle/vehicles/store', [VehicleController::class, 'store'])->middleware('auth');
route::any('/vehicles/editact/{id}', [VehicleController::class, 'editact'])->middleware('auth');
route::any('/vehicles/destroy/{id}', [VehicleController::class, 'destroy'])->middleware('auth');
route::get('/vehicle/history', [VehicleController::class, 'historyasset'])->middleware('auth');
route::any('/vehicle/edithistoryact/{id}', [VehicleController::class, 'edithistoryact'])->middleware('auth');
route::get('/vehicle/view_pdf/{path}', [VehicleController::class, 'view_pdf'])->middleware('auth');
route::any('/vehicles/contractact/{id}', [VehicleController::class, 'contractact'])->middleware('auth');

// route::get('/land/lands', [LandOwnerController::class, 'land'])->middleware('auth');
// Route::get('/datatableland', [LandOwnerController::class, 'datatableland'])->middleware('auth');
// route::any('/land/lands/store', [LandOwnerController::class, 'store'])->middleware('auth');
// route::any('/lands/editact/{id}', [LandOwnerController::class, 'editact'])->middleware('auth');
// route::any('/lands/destroy/{id}', [LandOwnerController::class, 'destroy'])->middleware('auth');
// route::get('/land/view_pdf/{path}', [LandOwnerController::class, 'view_pdf'])->middleware('auth');

route::get('/vendor/vendors', [VendorController::class, 'vendor'])->middleware('auth');

route::get('/location/locations', [LocationController::class, 'location'])->middleware('auth');
Route::get('/datatablelocation', [LocationController::class, 'datatablelocation'])->middleware('auth');
route::any('/location/locations/store', [LocationController::class, 'store'])->middleware('auth');
route::any('/locations/editact/{id}', [LocationController::class, 'editact'])->middleware('auth');
route::any('/locations/destroy/{id}', [LocationController::class, 'destroy'])->middleware('auth');

// route::get('/hauling/haulings', [RitaseController::class, 'hauling'])->middleware('auth');

route::get('/employee/employees', [EmployeeController::class, 'employees'])->middleware('auth');
route::any('/employee/employees/store', [EmployeeController::class, 'store'])->middleware('auth');
route::any('/employee/employees/cari', [EmployeeController::class, 'cari'])->middleware('auth');
route::any('/register', [RegisterController::class, 'register'])->middleware('auth');
route::any('/employees/destroy/{id}', [EmployeeController::class, 'destroy'])->middleware('auth');
route::any('/employees/destroy_employee/{id}', [EmployeeController::class, 'destroy_employee'])->middleware('auth');
route::any('/employees/editact/{id}', [EmployeeController::class, 'editact'])->middleware('auth');
route::get('/layouts/main', [EmployeeController::class, 'main'])->middleware('auth');

route::get('/preparation/preparations', [PreparationController::class, 'preparation'])->middleware('auth');
Route::get('/datatablepreparation', [PreparationController::class, 'datatablepreparation'])->middleware('auth');
Route::get('/datatablepreparationanalysis', [PreparationController::class, 'datatablepreparationanalysis'])->middleware('auth');
route::any('/preparation/editact/{id}', [PreparationController::class, 'editact'])->middleware('auth');
route::any('/preparation/edit_analysis_act/{id}', [PreparationController::class, 'edit_analysis_act'])->middleware('auth');
route::any('/preparation/statusact/{id}', [PreparationController::class, 'statusact'])->middleware('auth');
route::any('/preparation/destroy/{id}', [PreparationController::class, 'destroy'])->middleware('auth');
route::any('/preparation/destroyanalysis/{id}', [PreparationController::class, 'destroyanalysis'])->middleware('auth');
route::any('/preparation/store', [PreparationController::class, 'store'])->middleware('auth');

route::get('/hourmeter/hourmeters', [HourmeterController::class, 'hourmeter'])->middleware('auth');
route::any('/hourmeter/hourmeters/cari', [HourmeterController::class, 'cari'])->middleware('auth');
route::get('/hourmeter/hm-report', [HourmeterController::class, 'hmreport'])->middleware('auth');
Route::get('/datatablehourmeter', [HourmeterController::class, 'datatablehourmeter'])->middleware('auth');

route::get('/hauling/haulings', [HaulingController::class, 'hauling'])->middleware('auth');
// route::get('/hauling/ritasedetail/{id}', [HaulingController::class, 'ritasedetail'])->middleware('auth');
route::get('/hauling/detail', [HaulingController::class, 'detail'])->middleware('auth');
Route::get('/datatablehauling', [HaulingController::class, 'datatablehauling'])->middleware('auth');
route::any('/hauling/editact/{id}', [HaulingController::class, 'editact'])->middleware('auth');
route::any('/hauling/destroy/{id}', [HaulingController::class, 'destroy'])->middleware('auth');

route::get('/barging/bargings', [BargingController::class, 'barging'])->middleware('auth');
route::get('/barging/ritase/{id}', [BargingController::class, 'ritase'])->middleware('auth');
route::any('/barging/bargings/store', [BargingController::class, 'store'])->middleware('auth');
route::get('/barging/detail', [BargingController::class, 'detail'])->middleware('auth');
Route::get('/datatablebarging', [BargingController::class, 'datatablebarging'])->middleware('auth');
route::any('/barging/editact/{id}', [BargingController::class, 'editact'])->middleware('auth');
route::any('/barging/destroy/{id}', [BargingController::class, 'destroy'])->middleware('auth');
route::any('/barging/statusact/{id}', [BargingController::class, 'statusact'])->middleware('auth');
route::any('/barging/destroybarg/{id}', [BargingController::class, 'destroybarg'])->middleware('auth');

route::get('/stockore/stockores', [StockoreController::class, 'stockore'])->middleware('auth');
route::any('/stockore/stockores/store', [StockoreController::class, 'store'])->middleware('auth');

route::get('/production/productions', [ProductionController::class, 'production'])->middleware('auth');
route::get('/production/detail/{id}', [ProductionController::class, 'detail'])->middleware('auth');



route::any('/hauling/ritase/{id}', [HaulingController::class, 'ritase'])->middleware('auth');

route::any('/vendor/vendors/store', [VendorController::class, 'store'])->middleware('auth');

route::get('/daily/dailys', [DailyActivityController::class, 'daily'])->middleware('auth');
route::get('/datatabledaily', [DailyActivityController::class, 'datatabledaily'])->middleware('auth');
route::any('/daily/dailys/store', [DailyActivityController::class, 'store'])->middleware('auth');
route::any('/daily/editact/{id}', [DailyActivityController::class, 'editact'])->middleware('auth');
route::any('/daily/destroy/{id}', [DailyActivityController::class, 'destroy'])->middleware('auth');
