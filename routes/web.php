<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request; // Import the Request class
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


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
    return view('welcome');
});

Route::view("/register", "register")->name("registerpage");

Route::post("/register", function (Request $request) {
    $validator = Validator::make($request->all(), [
        'email' => 'required|email|unique:users,email',

        'password' => 'required|min:6|confirmed', // Use the 'confirmed' rule
        'terms' => 'required|accepted',
    ]);
    if ($validator->fails()) {
        // Redirect back with input and validation errors
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    } else {

        $register = new  User();
        $register->email = $request->input('email');


        $register->password = Hash::make($request->input("password"));

        $register->save();

        return redirect()->route('loginpage');
    }
})->name("registercontroller");
Route::post("/login", function (Request $request) {

    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:6',


    ]);

    if (Auth::attempt($credentials)) {

        return redirect()->route("home");
    } else {

        return redirect()->back()
            ->withErrors([
                'email' => 'The provided credentials are incorrect.',
                'password' => 'The provided credentials are incorrect.',
            ])
            ->withInput(); // Preserve input data

    }
})->name("login");

Route::view("/home", "home")->name("home");



Route::view("/login", "loginpage")->name("loginpage");
