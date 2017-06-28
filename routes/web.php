<?php


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

/*Route::get('blade', function () {
    return view('child',['nombre' => 'Christian Araque']);
});

Route::get('/', function () {
    return view('contenidoVentana');
});

Route::get('/login', function () {
    return view('login');
});

Route::get("/nombre/{nombre}", function($nombre){
    print "Mi nombre es $nombre";
});
*/

Route::get('/', function () {
    return view('login');
});

Route::get('/login',['as' => 'login', 'uses'=>'LoginController@home']);
Route::post('/loginUser',
            ['middleware'=>['validateFormulary'],
             'uses'=>'LoginController@login']);

Route::match(['get', 'post'],'/register','RegisterController@home');

Route::get('/recovery','RecoveryAccountController@home');
Route::post('/recoveryAccount',
        ['middleware'=>['validateFormulary'],
        'uses'=> 'RecoveryAccountController@recoverUserAccount']);


Route::post('/registerUser',
            ['middleware'=>['validateFormulary'],
             'uses'=> 'RegisterController@registerUser']);

Route::get('/activateAccount/{stream}',
          ['middleware'=>['activationAccount'],
          'uses'=> 'ActivationAccountController@validateActivationStream']);


////////// Contenido de páginas //////////////
Route::get('{username}/content',['as' => 'content', 'uses'=>'ContentController@getContentView']);
Route::get('{username}/home',['as' => 'home', 'uses'=>'PrincipalController@home']);
Route::get('{username}/myprofile',['as' => 'myProfile', 'uses'=>'PrincipalController@home']);

Route::post('{username}/myprofile/update',
    ['middleware'=>['validateFormulary'],
        'uses'=>'ProfileController@update']);