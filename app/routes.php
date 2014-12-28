<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
 

Route::get('/', function()
{
	return Redirect::to('/es');
});


	/* ESPAÑOL  */
    Route::group(array('prefix' => 'es'), function () {

    	Route::get('/', function()
		{
			return View::make('inicio');
		});

	     Route::get('contacto', function(){
				return View::make('nosotros.contacto');
		});	

	    Route::get('nosotros/mision', function(){
			return View::make('nosotros.mision');
		});

		Route::group(array('prefix' => 'departamentos'), function(){

			Route::get('{dpto}/{opcion}', 'DepartamentosController@dptoinfo');

			Route::get('{dpto}/locales/{localdpto}', 'DepartamentosController@dptlocal');

			Route::get('{dpto}','DepartamentosController@view');			
			
		});

	});

	/* INGLES  */
    Route::group(array('prefix' => 'en'), function () {

    	Route::get('/', function()
		{
			return View::make('lenguajes.en.inicio');
		});

	     Route::get('contacto', function(){
				return View::make('nosotros.contacto');
		});	

	    Route::get('nosotros/mision', function(){
			return View::make('nosotros.mision');
		});

		Route::group(array('prefix' => 'departament'), function(){

			Route::get('{dpto}/{opcion}', 'InglesController@dptoinfo');

			Route::get('{dpto}/place/{localdpto}', 'InglesController@dptlocal');

			Route::get('{dpto}','InglesController@view');			
			
		});

	});

	
	/*Administrador*/
    Route::group(array('prefix' => 'administrador'), function () {

    	Route::get('/', function()
			{
				return View::make('admin');
			});
    	
    	Route::group(array('prefix'=>'Slider'), function(){
    		
    		Route::get('/', 'AdminController@SliderDpto');
    		
    		Route::get('/Show/{departamento}', 'AdminController@SliderDptoShow');

    		Route::get('/Add', 'AdminController@SliderDptoAdd');

    		Route::post('/Add', 'AdminController@SliderDptoNew');

    		Route::get('/Del/{departamento}/{id}', 'AdminController@SliderDptoDel');
    	});

    	Route::group(array('prefix'=>'Info'), function(){

    		Route::get('/Show/{opcion}','AdminController@Info');
    		Route::get('/Show/{opcion}/{departamento}','AdminController@InfoDepartamento');
    		Route::get('/Edit/{opcion}/{departamento}/{id}','AdminController@InfoEdit');
    		Route::get('/Add','AdminController@InfoAdd');
    		Route::post('/Add','AdminController@InfoNew');
    		Route::post('/Update/{opcion}/{departamento}/{id}','AdminController@InfoUpdate');
    		Route::post('/Update/General/{id}','AdminController@InfoUpdateGeneral');
    		Route::post('/traduccion/{idioma}/{id}','AdminController@InfoTraduccion');
    		Route::get('/Del/{opcion}/{departamento}/{info}','AdminController@InfoDel');

    	});    	
    	
    	Route::group(array('prefix'=>'Locales'), function(){

    		Route::get('/Show/{local}','AdminController@Locales');
    		Route::get('/Show/{local}/{departamento}','AdminController@LocalesDpto');
    		Route::get('/Edit/{local}/{departamento}/{id}','AdminController@LocalesEdit');
    		Route::post('/Update/{opcion}/{departamento}/{id}','AdminController@LocalesUpdate');
    		Route::post('/Update/General/{id}','AdminController@LocalesUpdateGeneral');
    		Route::post('/traduccion/{idioma}/{id}','AdminController@LocalesTraduccion');
    		Route::get('/Del/{opcion}/{departamento}/{info}','AdminController@LocalesDel');
    		Route::get('/Add','AdminController@LocalesAdd');
    		Route::post('/Add','AdminController@LocalesNew');

    	});

	});


Route::post('contacto/enviar', function(){

	$data = "el usuario ".Input::get('nombre')." ".Input::get('apellido')." <br> con correo: " .Input::get('email')." <br> de la ciudad de: ".Input::get('ciudad')."<br> telefono: ". Input::get('telefono')."<br> escribio este mensaje: <br>".Input::get('mensaje');
		
		
	Mail::send('emails.welcome',  array('data'=>$data), function($message){
	    $message->to('email', 'Cliente')->subject('info contacto');
	});

	Session::flash('message', 'Mensaje Enviado');
	return Redirect::back();
});


