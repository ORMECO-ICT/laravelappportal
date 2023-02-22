<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    // $users = DB::table('users')->where([
    //     ['status', '=', '1'],
    //     ['subscribed', '<>', '1'],
    // ])->get();

    // $modules = DB::connection('default_database')->table('user_portals')
    //     ->leftJoin('portals', 'portals.id', '=', 'app_module_id')
    //     ->where('user_id', Auth::user()->id)
    //     ->where([
    //             ['user_id', '=', Auth::user()->id],
    //             ['portals.code', '<>', config('app.title')],
    //         ])
    //     ->get();

    // dd($request);
    // dd($request->session()->get('username'));

    $portals = DB::connection('default_database')->table('user_portals')
    ->leftJoin('portals', 'portals.id', '=', 'portal_id')
    ->where('user_id', Auth::user()->id)
    ->get();

    if($portals){
        foreach($portals as $portal){
            if($portal->code == config('app.title')){
                return view('home', compact('portals'));
            }
        }
    }
    return view('unauthorized');

})->middleware('auth');


// Route::view('/', 'home')->middleware('auth');

// Route::view('/lock', 'auth.lock');
Route::get('/lock', function(){
    if(!Auth::user()){
        return redirect('login');
    }
    $user = Auth::user();
    return view('auth.lock', compact('user'));
});
