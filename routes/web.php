<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\RoutingController;
use Illuminate\Support\Facades\Auth;


///////////////////// Admin ///////////////////////////

use App\Http\Controllers\Admin\AccountTypeController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\PersonController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\PersonLeaveController;
use App\Http\Controllers\Admin\RoleController;





use App\Http\Controllers\Admin\SettingController;




/*KeywordController
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/





Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

Auth::routes();
Route::group(['prefix'=>'dashboard','middleware'=>['auth','is_admin']],function (){


   Route::get('{first}/{second}/{third}', [RoutingController::class, 'thirdLevel'])->name('third');
   Route::get('{first}/{second}', [RoutingController::class, 'secondLevel'])->name('second');
   Route::get('{any}', [RoutingController::class, 'root'])->name('any');



   
   //////////////////  accounttype ///////////////////
   Route::get('{first}/{second}/{third}/accounttype', [AccountTypeController::class, 'index'])->name('accounttypeIndex');
   

   //////////////////  companies ///////////////////
   Route::get('{first}/{second}/{third}/companies', [CompanyController::class, 'index'])->name('companiesIndex');
   Route::get('{first}/{second}/{third}/companies/create', [CompanyController::class, 'create'])->name('companiesCreate');
   Route::post('{first}/{second}/{third}/companies/store', [CompanyController::class, 'store'])->name('companiesStore');
   Route::get('{first}/{second}/{third}/companies/show/{id}', [CompanyController::class, 'show'])->name('companiesShow');
   Route::get('{first}/{second}/{third}/companies/edit/{id}', [CompanyController::class, 'edit'])->name('companiesEdit');
   Route::POST('{first}/{second}/{third}/companies/update', [CompanyController::class, 'update'])->name('companiesUpdate');
   Route::get('{first}/{second}/{third}/companies/destroy/{id}', [CompanyController::class, 'destroy'])->name('companiesDestroy');
   Route::post('{first}/{second}/{third}/companies/companyactive/{id}', [CompanyController::class, 'companyactive'])->name('companiesactive');  

   
    //////////////////  users ///////////////////
    Route::get('{first}/{second}/{third}/users', [UserController::class, 'index'])->name('usersIndex');
    Route::get('{first}/{second}/{third}/users/create', [UserController::class, 'create'])->name('usersCreate');
    Route::post('{first}/{second}/{third}/users/store', [UserController::class, 'store'])->name('usersStore');
    Route::get('{first}/{second}/{third}/users/show/{id}', [UserController::class, 'show'])->name('usersShow');
    Route::get('{first}/{second}/{third}/users/edit/{id}', [UserController::class, 'edit'])->name('usersEdit');
    Route::POST('{first}/{second}/{third}/users/update', [UserController::class, 'update'])->name('usersUpdate');
    Route::get('{first}/{second}/{third}/users/destroy/{id}', [UserController::class, 'destroy'])->name('usersDestroy');
    Route::POST('{first}/{second}/{third}/users/password', [UserController::class, 'password'])->name('usersPassword');
    Route::get('{first}/{second}/{third}/users/changepassword/{id}', [UserController::class, 'changepassword'])->name('changepassword');
    Route::post('{first}/{second}/{third}/users/updatechangepassword', [UserController::class, 'updatechangepassword'])->name('updatechangepassword');
    Route::post('{first}/{second}/{third}/users/useractive/{id}', [UserController::class, 'useractive'])->name('useractive');  
   

    //////////////////  employees ///////////////////
   Route::get('{first}/{second}/{third}/employees', [EmployeeController::class, 'index'])->name('employeesIndex');
   Route::get('{first}/{second}/{third}/employees/create', [EmployeeController::class, 'create'])->name('employeesCreate');
   Route::post('{first}/{second}/{third}/employees/store', [EmployeeController::class, 'store'])->name('employeesStore');
   Route::get('{first}/{second}/{third}/employees/show/{id}', [EmployeeController::class, 'show'])->name('employeesShow');
   Route::get('{first}/{second}/{third}/employees/edit/{id}', [EmployeeController::class, 'edit'])->name('employeesEdit');
   Route::POST('{first}/{second}/{third}/employees/update', [EmployeeController::class, 'update'])->name('employeesUpdate');
   Route::get('{first}/{second}/{third}/employees/destroy/{id}', [EmployeeController::class, 'destroy'])->name('employeesDestroy');
   Route::post('/employees/{employeeId}/update-attendance-person', [EmployeeController::class, 'attendancePerson'])->name('update-attendance-person');
   Route::get('/projects/search', [EmployeeController::class, 'search'])->name('projectssearch');

   
    //////////////////  persons ///////////////////
    Route::get('{first}/{second}/{third}/persons', [PersonController::class, 'index'])->name('personsIndex');
    Route::get('{first}/{second}/{third}/persons/create', [PersonController::class, 'create'])->name('personsCreate');
    Route::post('{first}/{second}/{third}/persons/store', [PersonController::class, 'store'])->name('personsStore');
    Route::get('{first}/{second}/{third}/persons/show/{id}', [PersonController::class, 'show'])->name('personsShow');
    Route::get('{first}/{second}/{third}/persons/edit/{id}', [PersonController::class, 'edit'])->name('personsEdit');
    Route::POST('{first}/{second}/{third}/persons/update', [PersonController::class, 'update'])->name('personsUpdate');
    Route::get('{first}/{second}/{third}/persons/destroy/{id}', [PersonController::class, 'destroy'])->name('personsDestroy');
 

     //////////////////  projects ///////////////////
     Route::get('{first}/{second}/{third}/projects', [ProjectController::class, 'index'])->name('projectsIndex');
     Route::get('{first}/{second}/{third}/projects/create', [ProjectController::class, 'create'])->name('projectsCreate');
     Route::post('{first}/{second}/{third}/projects/store', [ProjectController::class, 'store'])->name('projectsStore');
     Route::get('{first}/{second}/{third}/projects/show/{id}', [ProjectController::class, 'show'])->name('projectsShow');
     Route::get('{first}/{second}/{third}/projects/edit/{id}', [ProjectController::class, 'edit'])->name('projectsEdit');
     Route::POST('{first}/{second}/{third}/projects/update', [ProjectController::class, 'update'])->name('projectsUpdate');
     Route::get('{first}/{second}/{third}/projects/destroy/{id}', [ProjectController::class, 'destroy'])->name('projectsDestroy');
     Route::post('/projects/{projectId}/assign-person', [ProjectController::class, 'assignPerson'])->name('assign-person');
     Route::delete('/projects/{projectId}/remove-person/{personId}', [ProjectController::class, 'removePerson'])->name('remove-person');
 
    
    //////////////////  personleaves ///////////////////
    Route::get('{first}/{second}/{third}/personleaves', [PersonLeaveController::class, 'index'])->name('personleavesIndex');
    Route::get('{first}/{second}/{third}/personleaves/create', [PersonLeaveController::class, 'create'])->name('personleavesCreate');
    Route::post('{first}/{second}/{third}/personleaves/store', [PersonLeaveController::class, 'store'])->name('personleavesStore');
    Route::get('{first}/{second}/{third}/personleaves/show/{id}', [PersonLeaveController::class, 'show'])->name('personleavesShow');
    Route::patch('/person_leaves/{id}/updateStatus', [PersonLeaveController::class, 'updateStatus'])->name('person_leaves.updateStatus');

    //////////////////  personleaves ///////////////////
    Route::get('{first}/{second}/{third}/roles', [RoleController::class, 'index'])->name('rolesIndex');
    Route::get('{first}/{second}/{third}/roles/create', [RoleController::class, 'create'])->name('rolesCreate');
    Route::post('{first}/{second}/{third}/roles/store', [RoleController::class, 'store'])->name('rolesStore');
    Route::get('{first}/{second}/{third}/roles/edit/{id}', [RoleController::class, 'edit'])->name('rolesEdit');
    Route::POST('{first}/{second}/{third}/roles/update', [RoleController::class, 'update'])->name('rolesUpdate');

    
     
   ////////////////// settings ///////////////////
   Route::get('{first}/{second}/{third}/settings', [SettingController::class, 'index'])->name('settingsIndex');
   Route::get('{first}/{second}/{third}/settings/create', [SettingController::class, 'create'])->name('settingsCreate');
   Route::post('{first}/{second}/{third}/settings/store', [SettingController::class, 'store'])->name('settingsStore');
   Route::get('{first}/{second}/{third}/settings/show', [SettingController::class, 'show'])->name('settingsShow');
   Route::get('{first}/{second}/{third}/settings/edit/{id}', [SettingController::class, 'edit'])->name('settingsEdit');
   Route::POST('{first}/{second}/{third}/settings/update', [SettingController::class, 'update'])->name('settingsUpdate');
   Route::get('{first}/{second}/{third}/settings/destroy/{id}', [SettingController::class, 'destroy'])->name('settingsDestroy'); 
   

   
});
