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
Route::post('refresh-csrf', function() {
    return csrf_token();
});
Route::get('/migratecolumnasdoc', 'migrateController@migratecolumnasdoc');
Route::get('/migratecolumns', 'migrateController@migratecolumns');
Route::get('/getusersonline', 'migrateController@getUsersOnline');
Route::get('/migrateusers', 'migrateController@migrateUsers');
Route::get('/migrateuserspassword', 'migrateController@migrateUsersPassword');
Route::get('/migratesubscriberdatacomex', 'migrateController@migrateSubscriberDatacomex');
Route::get('/migratesubscribernegocios', 'migrateController@migrateSubscriberNegocios');
Route::get('/migratesubscribersemanario', 'migrateController@migrateSubscriberSemanario');
Route::get('/migratenegocios', 'migrateController@migrateNegocios');
Route::get('/migratecomexperu', 'migrateController@migrateComexPeru');
Route::get('/migraterevistacomex', 'migrateController@migrateRevistaComex');
Route::get('/migratedatacomex', 'migrateController@migrateDataComex');
Route::get('/migrateagrocomex', 'migrateController@migrateAgroComex');
Route::get('/migratememoria', 'migrateController@migratememoria');
Route::get('/createdocument', 'migrateController@createDocument');
Route::get('/migratecompanies', 'migrateController@migrateCompanies');
Route::get('/migratecompaniestype', 'migrateController@migrateCompaniesType');
Route::get('/migrateseminars', 'migrateController@migrateSeminars');
Route::get('/migrateinscription', 'migrateController@migrateInscription');
Route::get('/encriptpass', 'migrateController@encriptpass');

Route::get('/pago30dias', 'PagoController@index');
Route::get('{idioma}/pago30dias', 'PagoController@index');
//*/

Route::get('/tester', 'TesterController@index');
Route::get('/notificacion', 'NotificationController@index');
Route::get('admin/enviarnotificaciones', 'NotificacionesController@create');
Route::post('/savenotificacion', 'NotificacionesController@store');
Route::post('/sendnotificaciones', 'NotificacionesController@send');


Route::get('/busquedageneral', 'FrontController@search');
Route::get('{idioma}/busquedageneral', 'FrontController@search');
Route::get('/', 'FrontController@index');
Route::post('/removeboletin', 'FrontController@removeboletin');
Route::post('/removenotification', 'FrontController@removenotification');
Route::post('/sendmail', 'FrontController@mail');
Route::get('/articulosjson', 'FrontController@articulosJson');
// Route::get('/mailevento', 'FrontController@emailEvento');
Route::get('/nosotros', 'nosotrosController@index');
Route::get('/servicios', 'serviciosController@index');
Route::get('/servicioconsultotiaempresarial', 'servicioconsultotiaempresarialController@index');
Route::get('/serviciopoliticaspublicas', 'serviciopoliticaspublicasController@index');
Route::get('/servicioabtc', 'servicioabtcController@index');
Route::get('/servicioestudioseconomicos', 'servicioestudioseconomicosController@index');
Route::get('/servicioasuntoscorporativos', 'servicioasuntosinternacionalesController@index');
Route::get('/servicioalasociado', 'servicioalasociadoController@index');
Route::get('/serviciopublicaciones', 'serviciopublicacionesController@index');
Route::get('/serviciocomunicacion', 'serviciocomunicacionController@index');
Route::get('/eventos', 'eventosController@index');
Route::get('/articulos', 'articulosController@index');
Route::post('/selecttags', 'articulosController@selectTags');
Route::post('/selectcategories', 'articulosController@selectCategories');
Route::post('/getarticles', 'articulosController@getArticles');
Route::get('/socios', 'sociosController@index');
Route::get('/oportunidadescomerciales', 'oportunidadescomercialesController@index');
Route::post('/sendproblematic', 'obstaculoscomercialesController@sendproblematic');
Route::get('/obstaculoscomerciales', 'obstaculoscomercialesController@index');
Route::get('/dyb', 'dybController@index');
Route::get('/publicaciones', 'servicioListadoPublicacionesController@index');
Route::post('/subscriptionpublication', 'servicioListadoPublicacionesController@subscriptionpublication');
Route::post('/subscriptionnegocios', 'servicioListadoPublicacionesController@subscriptionnegocios');
Route::get('/servicioCertificacionOrigen', 'servicioCertificacionOrigenController@index');
Route::get('/foro', 'eventoListadoPublicacionesController@index');

// Route::get('/', function () {
//     return view('welcome');
// });
//admin
Route::post('/admin/articulos/publisharticle', 'adminArticulosController@publishArticle');
Route::post('/admin/articulos/delete', 'adminArticulosController@deleteArticle');
Route::post('/admin/articulos/changeprivacity', 'adminArticulosController@changePrivacity');
Route::post('/admin/articulos/updatepublicationdate', 'adminArticulosController@updatePublicationDate');
Route::post('/admin/articulos/deleteimg', 'adminArticulosController@deleteImg');
Route::post('/admin/articulos/newimageftp', 'adminArticulosController@newimageftp');
Route::get('/admin/articulos/getimagenesfolder', 'adminArticulosController@getImagenesFolder');
Route::resource('/admin/articulos', 'adminArticulosController');

Route::post('/admin/publicaciones/deletepublication', 'adminPublicacionesController@deletePublication');
Route::resource('/admin/publicaciones', 'adminPublicacionesController');
Route::post('/admin/tags/deletetag', 'adminTagsController@deleteTag');
Route::resource('/admin/tags', 'adminTagsController');
Route::get('/admin/seminars/{idseminario}/nuevapresentacion', 'adminSeminarsController@newpresentacion');
Route::post('/admin/seminars/savedocumentos', 'adminSeminarsController@savedocumentos');
Route::get('/admin/seminars/editpresentacion/{id}', 'adminSeminarsController@editpresentacion');
Route::post('/admin/seminars/updatepresentacion', 'adminSeminarsController@updatepresentacion');
Route::get('/admin/seminars/deletepresentacion/{id}', 'adminSeminarsController@deletepresentacion');
Route::resource('/admin/seminars', 'adminSeminarsController');
Route::post('/admin/cumbres/deletesummit', 'adminCumbresController@deleteSummit');
Route::resource('/admin/cumbres', 'adminCumbresController');
Route::resource('/admin/usuarios', 'adminUsuariosController');
Route::resource('/admin/empresas', 'adminEmpresasController');
Route::resource('/admin/inscripciones', 'adminInscriptionsController');
Route::resource('/admin/contactos', 'adminContactsController');
Route::post('/admin/sliders/deleteslider', 'adminSlidersController@deleteSlider');
Route::resource('/admin/sliders', 'adminSlidersController');
Route::resource('/admin/suscriptores', 'adminSubscribersController');
Route::get('/admin/inscripciones', 'adminInscripcionesController@index');
Route::get('/admin/datacomexsubcripciones', 'adminSubscribersDatacomexController@index');
Route::get('/admin/semanariosubcripciones', 'adminSubscribersSemanarioController@index');
Route::get('/admin/negociossubcripciones', 'adminSubscribersNegociosController@index');
Route::get('/admin/inscripciones', 'adminInscriptionsController@index');
Route::get('/admin/obstaculosalcomercio', 'adminObsComercioController@index');


Route::get('articulo/{titulo}', 'articulosController@show');
Route::get('{idioma}/', 'FrontController@index');
Route::get('{idioma}/nosotros', 'nosotrosController@index');
Route::get('{idioma}/servicios', 'serviciosController@index');
Route::get('{idioma}/servicioconsultotiaempresarial', 'servicioconsultotiaempresarialController@index');
Route::get('{idioma}/serviciopoliticaspublicas', 'serviciopoliticaspublicasController@index');
Route::get('{idioma}/servicioabtc', 'servicioabtcController@index');
Route::get('{idioma}/servicioestudioseconomicos', 'servicioestudioseconomicosController@index');
Route::get('{idioma}/servicioasuntoscorporativos', 'servicioasuntosinternacionalesController@index');
Route::get('{idioma}/servicioalasociado', 'servicioalasociadoController@index');
Route::get('{idioma}/serviciopublicaciones', 'serviciopublicacionesController@index');
Route::get('{idioma}/serviciocomunicacion', 'serviciocomunicacionController@index');
Route::get('{idioma}/eventos', 'eventosController@index');
Route::get('{idioma}/articulos', 'articulosController@index');
Route::get('{idioma}/publicaciones', 'servicioListadoPublicacionesController@index');
Route::get('{idioma}/articulo/{titulo}', 'articulosController@show');



Route::post('{idioma}/selecttags', 'articulosController@selectTags');
Route::post('{idioma}/selectcategories', 'articulosController@selectCategories');
Route::post('{idioma}/getarticles', 'articulosController@getArticles');
Route::get('{idioma}/socios', 'sociosController@index');

Route::get('{idioma}/oportunidadescomerciales', 'oportunidadescomercialesController@index');
Route::get('{idioma}/obstaculoscomerciales', 'obstaculoscomercialesController@index');
Route::get('{idioma}/dyb', 'dybController@index');
Route::get('{idioma}/publicaciones', 'servicioListadoPublicacionesController@index');
Route::post('{idioma}/subscriptionpublication', 'servicioListadoPublicacionesController@subscriptionpublication');
Route::post('{idioma}/subscriptionnegocios', 'servicioListadoPublicacionesController@subscriptionnegocios');
Route::get('{idioma}/servicioCertificacionOrigen', 'servicioCertificacionOrigenController@index');
Route::get('{idioma}/foro', 'eventoListadoPublicacionesController@index');



// Auth::routes();
Route::post('/login', 'Auth\LoginController@showFormLogin');

Route::post('/login', 'Auth\LoginController@login')->name('login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
Route::post('/subscription', 'FrontController@storeSubscriber')->name('subscription');

Route::get('/home', 'HomeController@index')->name('home');



Route::post('/eventos', 'eventosController@save_subscription');


Route::get('salir',function(){
  Auth::logout();
  return redirect('/');
});
