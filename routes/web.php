<?php

use Illuminate\Support\Facades\Route;

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

    echo "Starting Importing Process... <br><br>";

    $import = new \App\Imports\AssociationImport();

    echo "Import in Process <br><br>";

    \Maatwebsite\Excel\Facades\Excel::import($import, storage_path('app/files/EOSD_SSCI_IMPLEMENTATION_TASKS_FOR_ASSOCIATIONS_V1.xlsx'));

    return 'Successfully Imported';
});
