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

    $user = User::where('email', $request->email)->first();

    if ($user) {
        // User exists, now check the password
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route("home");
        } else {
            // Password is incorrect
            return redirect()->back()
                ->withErrors([
                    'password' => 'The provided password is incorrect.',
                ])
                ->withInput(); // Preserve input data
        }
    } else {
        // User does not exist
        return redirect()->back()
            ->withErrors([
                'email' => 'No user found with that email address.',
            ])
            ->withInput(); // Preserve input data
    }
})->name("login");

Route::view("/home", "home")->name("home");



Route::view("/login", "loginpage")->name("loginpage");
Route::get("/logout", function () {

    Auth::logout();
    return redirect()->route('loginpage');
})->name('logout');
